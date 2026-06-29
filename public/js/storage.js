function carregarCarros() {
  const respostaApi = Array.isArray(window.siteDataCache.vehicles)
    ? { data: window.siteDataCache.vehicles }
    : null;

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("carros", JSON.stringify(respostaApi.data));
      snapshotCarrosPersistidos = copiarListaCarros(respostaApi.data);
      return respostaApi.data.map(normalizarCarro);
    }

    // Se o banco estiver vazio, preserva o estoque salvo no navegador.
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("carros"));

    if (Array.isArray(salvos)) {
      snapshotCarrosPersistidos = copiarListaCarros(salvos);
      return salvos.map(normalizarCarro);
    }
  } catch (error) {
    localStorage.removeItem("carros");
  }

  snapshotCarrosPersistidos = copiarListaCarros(carros);
  return carros.map(normalizarCarro);
}

let snapshotCarrosPersistidos = [];
let filaPersistenciaCarros = Promise.resolve();

function salvarCarros(listaCarros) {
  localStorage.setItem("carros", JSON.stringify(listaCarros));
  const anterior = snapshotCarrosPersistidos;
  const proximo = copiarListaCarros(listaCarros);
  snapshotCarrosPersistidos = proximo;

  if (
    window.location.protocol === "file:" ||
    !document.querySelector('meta[name="csrf-token"]')
  ) {
    return;
  }

  const anterioresPorId = new Map(
    anterior.map(function (carro) {
      return [Number(carro.id), carro];
    })
  );
  const proximosPorId = new Map(
    proximo.map(function (carro) {
      return [Number(carro.id), carro];
    })
  );
  const operacoes = [];

  proximo.forEach(function (carro) {
    const id = Number(carro.id);
    const existente = anterioresPorId.get(id);

    if (!existente) {
      operacoes.push({ metodo: "POST", caminho: "", dados: carro });
    } else if (JSON.stringify(existente) !== JSON.stringify(carro)) {
      operacoes.push({
        metodo: "PUT",
        caminho: "/" + encodeURIComponent(id),
        dados: carro,
      });
    }
  });

  anterior.forEach(function (carro) {
    const id = Number(carro.id);

    if (id && !proximosPorId.has(id)) {
      operacoes.push({
        metodo: "DELETE",
        caminho: "/" + encodeURIComponent(id),
      });
    }
  });

  operacoes.forEach(enfileirarPersistenciaCarro);
}

function copiarListaCarros(lista) {
  return JSON.parse(JSON.stringify(Array.isArray(lista) ? lista : []));
}

function enfileirarPersistenciaCarro(operacao) {
  filaPersistenciaCarros = filaPersistenciaCarros
    .then(function () {
      return requisicaoVeiculosApiAssincrona(
        operacao.metodo,
        operacao.caminho,
        operacao.dados
      );
    })
    .then(function (resposta) {
      if (!resposta || !resposta.data) return;

      const salvos = JSON.parse(localStorage.getItem("carros") || "[]");
      const atualizados = salvos.map(function (carro) {
        return Number(carro.id) === Number(resposta.data.id)
          ? resposta.data
          : carro;
      });

      localStorage.setItem("carros", JSON.stringify(atualizados));
      snapshotCarrosPersistidos = snapshotCarrosPersistidos.map(function (carro) {
        return Number(carro.id) === Number(resposta.data.id)
          ? resposta.data
          : carro;
      });
    })
    .catch(function (error) {
      console.error("Falha ao persistir veículo:", error);
      window.dispatchEvent(
        new CustomEvent("persistenciaVeiculosFalhou", {
          detail: { mensagem: error.message },
        })
      );
    });
}

function requisicaoVeiculosApiAssincrona(metodo, caminho, dados) {
  const headers = {
    Accept: "application/json",
  };
  const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

  if (dados !== undefined) {
    headers["Content-Type"] = "application/json";
  }

  if (tokenCsrf) {
    headers["X-CSRF-TOKEN"] = tokenCsrf.content;
  }

  return fetch("/api/vehicles" + (caminho || ""), {
    method: metodo,
    headers: headers,
    body: dados === undefined ? undefined : JSON.stringify(dados),
    credentials: "same-origin",
  }).then(function (resposta) {
    if (!resposta.ok) {
      return resposta
        .json()
        .catch(function () {
          return {};
        })
        .then(function (erro) {
          throw new Error(erro.message || "Erro " + resposta.status);
        });
    }

    return resposta.status === 204 ? {} : resposta.json();
  });
}

function carregarFavoritosVeiculos() {
  try {
    const favoritos = JSON.parse(localStorage.getItem("favoritosVeiculos"));

    if (Array.isArray(favoritos)) {
      return favoritos.map(Number).filter(Boolean);
    }
  } catch (error) {
    localStorage.removeItem("favoritosVeiculos");
  }

  return [];
}

function salvarFavoritosVeiculos(favoritos) {
  localStorage.setItem("favoritosVeiculos", JSON.stringify(favoritos));
}

function carroFavorito(id) {
  return carregarFavoritosVeiculos().indexOf(Number(id)) !== -1;
}

function montarBotaoFavorito(id, extraClasse) {
  const idCarro = Number(id) || 0;
  const ativo = carroFavorito(idCarro);
  const texto = ativo ? "Favorito" : "Favoritar";

  return (
    '<button type="button" class="btn-favorito ' +
    (extraClasse || "") +
    (ativo ? " ativo" : "") +
    '" data-favorito-id="' +
    idCarro +
    '" aria-pressed="' +
    ativo +
    '" aria-label="' +
    texto +
    ' veículo" title="' +
    texto +
    '" onclick="event.stopPropagation(); alternarFavoritoVeiculo(' +
    idCarro +
    ')"><span aria-hidden="true">&hearts;</span><span class="favorito-texto">' +
    texto +
    "</span></button>"
  );
}

function atualizarBotoesFavoritos(id) {
  const ativo = carroFavorito(id);
  const texto = ativo ? "Favorito" : "Favoritar";

  document
    .querySelectorAll('[data-favorito-id="' + Number(id) + '"]')
    .forEach(function (botao) {
      botao.classList.toggle("ativo", ativo);
      botao.setAttribute("aria-pressed", String(ativo));
      botao.setAttribute("aria-label", texto + " veículo");
      botao.setAttribute("title", texto);

      const textoBotao = botao.querySelector(".favorito-texto");

      if (textoBotao) {
        textoBotao.textContent = texto;
      }
    });
}

function alternarFavoritoVeiculo(id) {
  const idCarro = Number(id);
  let favoritos = carregarFavoritosVeiculos();

  if (!idCarro) return false;

  if (favoritos.indexOf(idCarro) === -1) {
    favoritos.push(idCarro);
  } else {
    favoritos = favoritos.filter(function (favorito) {
      return favorito !== idCarro;
    });
  }

  salvarFavoritosVeiculos(favoritos);
  atualizarBotoesFavoritos(idCarro);

  window.dispatchEvent(
    new CustomEvent("favoritosVeiculosAtualizados", {
      detail: { id: idCarro, favorito: carroFavorito(idCarro) },
    })
  );

  return carroFavorito(idCarro);
}

function carregarDepoimentos() {
  const respostaApi = Array.isArray(window.siteDataCache.testimonials)
    ? { data: window.siteDataCache.testimonials }
    : null;

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("depoimentos", JSON.stringify(respostaApi.data));
      localStorage.setItem("depoimentosVersao", "2");
      return respostaApi.data.map(normalizarDepoimento);
    }

    return [];
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("depoimentos"));
    const versaoDepoimentos = localStorage.getItem("depoimentosVersao");

    if (Array.isArray(salvos)) {
      let listaDepoimentos = salvos;

      if (
        versaoDepoimentos !== "2" &&
        salvos.length > 0 &&
        salvos.length < depoimentosPadrao.length
      ) {
        const idsSalvos = salvos.map(function (depoimento) {
          return Number(depoimento.id);
        });

        const depoimentosNovos = depoimentosPadrao.filter(function (depoimento) {
          return idsSalvos.indexOf(Number(depoimento.id)) === -1;
        });

        listaDepoimentos = salvos.concat(depoimentosNovos);
        localStorage.setItem("depoimentos", JSON.stringify(listaDepoimentos));
      }

      localStorage.setItem("depoimentosVersao", "2");
      return listaDepoimentos.map(normalizarDepoimento);
    }
  } catch (error) {
    localStorage.removeItem("depoimentos");
  }

  return depoimentosPadrao.map(normalizarDepoimento);
}

function salvarDepoimentos(listaDepoimentos) {
  localStorage.setItem("depoimentos", JSON.stringify(listaDepoimentos));

  requisicaoConteudoApi("PUT", "/testimonials/sync", {
    testimonials: listaDepoimentos,
  }).then(function (respostaApi) {
    if (respostaApi && Array.isArray(respostaApi.data)) {
      window.siteDataCache.testimonials = respostaApi.data;
      localStorage.setItem("depoimentos", JSON.stringify(respostaApi.data));
    }
  });
}

function carregarParcerias() {
  const respostaApi = Array.isArray(window.siteDataCache.partners)
    ? { data: window.siteDataCache.partners }
    : null;

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("parcerias", JSON.stringify(respostaApi.data));
      return respostaApi.data.map(normalizarParceria);
    }

    return [];
  }

  try {
    const salvas = JSON.parse(localStorage.getItem("parcerias"));

    if (Array.isArray(salvas)) {
      return salvas.map(normalizarParceria);
    }
  } catch (error) {
    localStorage.removeItem("parcerias");
  }

  return parceriasPadrao.map(normalizarParceria);
}

function salvarParcerias(listaParcerias) {
  localStorage.setItem("parcerias", JSON.stringify(listaParcerias));

  requisicaoConteudoApi("PUT", "/partners/sync", {
    partners: listaParcerias,
  }).then(function (respostaApi) {
    if (respostaApi && Array.isArray(respostaApi.data)) {
      window.siteDataCache.partners = respostaApi.data;
      localStorage.setItem("parcerias", JSON.stringify(respostaApi.data));
    }
  });
}

function normalizarVendedorPublico(vendedor) {
  return {
    id: Number(vendedor.id) || 0,
    nome: vendedor.nome || vendedor.name || "Vendedor 3M",
    whatsapp: vendedor.whatsapp || vendedor.phone || "",
    email: vendedor.email || "",
    foto: vendedor.foto || vendedor.image || vendedor.imagem || "",
    ativo: vendedor.ativo !== false && vendedor.active !== false && vendedor.status !== "Inativo",
  };
}

function carregarVendedoresPublicos() {
  const respostaApi = Array.isArray(window.siteDataCache.sellers)
    ? { data: window.siteDataCache.sellers }
    : null;

  if (respostaApi && Array.isArray(respostaApi.data)) {
    localStorage.setItem("vendedoresPublicos", JSON.stringify(respostaApi.data));
    return respostaApi.data.map(normalizarVendedorPublico).filter(function (vendedor) {
      return vendedor.ativo;
    });
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("vendedoresPublicos"));

    if (Array.isArray(salvos)) {
      return salvos.map(normalizarVendedorPublico).filter(function (vendedor) {
        return vendedor.ativo;
      });
    }
  } catch (error) {
    localStorage.removeItem("vendedoresPublicos");
  }

  try {
    const vendedoresPainel = JSON.parse(localStorage.getItem("vendedores"));

    if (Array.isArray(vendedoresPainel)) {
      return vendedoresPainel.map(normalizarVendedorPublico).filter(function (vendedor) {
        return vendedor.ativo;
      });
    }
  } catch (error) {
    localStorage.removeItem("vendedores");
  }

  return [];
}

function buscarVendedorPublicoPorNome(nome) {
  const nomeBusca = String(nome || "").trim().toLowerCase();

  if (!nomeBusca) return null;

  return (
    carregarVendedoresPublicos().find(function (vendedor) {
      return String(vendedor.nome || "").trim().toLowerCase() === nomeBusca;
    }) || null
  );
}

function requisicaoConteudoApi(metodo, caminho, dados) {
  if (window.location.protocol === "file:") return Promise.resolve(null);

  const headers = { Accept: "application/json" };
  const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

  if (dados !== undefined) headers["Content-Type"] = "application/json";
  if (tokenCsrf) headers["X-CSRF-TOKEN"] = tokenCsrf.content;

  return fetch("/api/site" + caminho, {
    method: metodo,
    headers: headers,
    body: dados === undefined ? undefined : JSON.stringify(dados),
    credentials: "same-origin",
  })
    .then(function (resposta) {
      if (!resposta.ok) return null;
      return resposta.status === 204 ? {} : resposta.json();
    })
    .catch(function () {
      return null;
    });
}

function restaurarDadosPadrao(tipo) {
  if (tipo === "carros" || tipo === "todos") {
    localStorage.removeItem("carros");
  }

  if (tipo === "depoimentos" || tipo === "todos") {
    localStorage.removeItem("depoimentos");
    localStorage.removeItem("depoimentosVersao");
  }

  if (tipo === "parcerias" || tipo === "todos") {
    localStorage.removeItem("parcerias");
  }
}

function precoNumero(preco) {
  return Number(String(preco).replace(/\D/g, ""));
}

function formatarMoeda(valor) {
  const numero = Number(valor) || 0;

  return numero.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
    maximumFractionDigits: 0,
  });
}

function textoCarro(carro) {
  return carro.ano + " | " + carro.km + " | " + normalizarCambio(carro.cambio);
}

function mensagemVeiculo(carro) {
  const config = carregarConfigLoja();
  const template = config.mensagemVeiculo || lojaConfig.mensagemVeiculo;

  return template.replace(/\{(\w+)\}/g, function (_, chave) {
    const valores = {
      nome: carro.nome,
      marca: carro.marca,
      modelo: carro.modelo,
      ano: carro.ano,
      km: carro.km,
      cambio: normalizarCambio(carro.cambio),
      tipo: carro.tipo,
      cor: carro.cor,
      combustivel: carro.combustivel,
      preco: carro.preco,
      status: carro.status,
      descricao: carro.descricao,
      portas: carro.portas,
      placaFinal: carro.placaFinal,
      blindado: carro.blindado ? "Sim" : "Não",
    };

    return valores[chave] || "";
  });
}

function normalizarCarro(carro) {
  const nome = carro.nome || "";
  const partesNome = nome.split(" ");
  const marca = carro.marca || partesNome[0] || "";
  const modelo = carro.modelo || partesNome.slice(1).join(" ") || nome;

  return {
    ...carro,
    marca: marca,
    modelo: modelo,
    nome: nome || marca + " " + modelo,
    cambio: normalizarCambio(carro.cambio),
    combustivel: carro.combustivel || "-",
    cor: carro.cor || "-",
    tipo: carro.tipo || "Outros",
    status: normalizarStatus(carro.status),
    portas: carro.portas || "-",
    placaFinal: carro.placaFinal || "-",
    precoCompra: Number(carro.precoCompra) || 0,
    custoPreparacao: Number(carro.custoPreparacao) || 0,
    comissaoPercentual: Number(carro.comissaoPercentual) || 0,
    comissao: Number(carro.comissao) || 0,
    taxas: Number(carro.taxas) || 0,
    valorVenda: Number(carro.valorVenda) || 0,
    dataVenda: carro.dataVenda || "",
    vendedorId: carro.vendedorId || "",
    vendedorNome: carro.vendedorNome || "",
    temTroca: Boolean(carro.temTroca),
    trocaVeiculo: carro.trocaVeiculo || "",
    trocaValor: Number(carro.trocaValor) || 0,
    valorRecebido: Number(carro.valorRecebido) || 0,
    saldoReceber: Number(carro.saldoReceber) || 0,
    trocaEstoqueId: carro.trocaEstoqueId || "",
    origem: carro.origem || "",
    origemTrocaVendaId: carro.origemTrocaVendaId || "",
    origemTrocaVeiculo: carro.origemTrocaVeiculo || "",
    blindado: Boolean(carro.blindado),
    destaque: carro.destaque !== undefined ? Boolean(carro.destaque) : Boolean(carro.oferta),
    descricao:
      carro.descricao ||
      "Veículo revisado, com procedência e pronto para negociação.",
    opcionais: Array.isArray(carro.opcionais) ? carro.opcionais : [],
    galeria:
      Array.isArray(carro.galeria) && carro.galeria.length > 0
        ? carro.galeria
        : [carro.imagem],
  };
}

function normalizarCambio(cambio) {
  const valor = String(cambio || "");
  const semAcentos = valor.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

  if (semAcentos.toLowerCase().includes("auto")) {
    return "Automático";
  }

  return semAcentos || "-";
}

function normalizarStatus(status) {
  const valor = String(status || "");
  const semAcentos = valor.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

  if (semAcentos.toLowerCase() === "disponivel") {
    return "Disponível";
  }

  return valor || "Disponível";
}

function normalizarDepoimento(depoimento) {
  return {
    id: depoimento.id || Date.now(),
    cliente: depoimento.cliente || "Cliente 3M Veículos",
    veiculo: depoimento.veiculo || "Entrega 3M Veículos",
    texto:
      depoimento.texto ||
      "Atendimento rápido, transparente e com todo suporte na compra.",
    imagem:
      depoimento.imagem ||
      "https://via.placeholder.com/700x450?text=Foto+da+entrega",
  };
}

function normalizarParceria(parceria) {
  return {
    id: parceria.id || Date.now(),
    nome: parceria.nome || "Parceiro financeiro",
    ativo: parceria.ativo !== false,
  };
}

