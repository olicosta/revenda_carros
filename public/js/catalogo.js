const lista = document.getElementById("lista-carros");
const contadorResultados = document.getElementById("contador-resultados");
const filtroBusca = document.getElementById("filtro-busca");
const filtroMarca = document.getElementById("filtro-marca");
const filtroCambio = document.getElementById("filtro-cambio");
const filtroCombustivel = document.getElementById("filtro-combustivel");
const filtroCor = document.getElementById("filtro-cor");
const filtroTipo = document.getElementById("filtro-tipo");
const filtroStatus = document.getElementById("filtro-status");
const filtroAnoMin = document.getElementById("filtro-ano-min");
const filtroAnoMax = document.getElementById("filtro-ano-max");
const filtroFaixaPreco = document.getElementById("filtro-faixa-preco");
const filtroPrecoMin = document.getElementById("filtro-preco-min");
const filtroPrecoMax = document.getElementById("filtro-preco-max");
const filtroKmMax = document.getElementById("filtro-km-max");
const filtroOferta = document.getElementById("filtro-oferta");
const filtroDisponivel = document.getElementById("filtro-disponivel");
const filtroBlindado = document.getElementById("filtro-blindado");
const ordenarPreco = document.getElementById("ordenar-preco");
const limparFiltros = document.getElementById("limpar-filtros");
const filtrosAtivos = document.getElementById("filtros-ativos");
const catalogoResumo = document.getElementById("catalogo-resumo");
const filtrosAvancados = document.querySelector(".filtros-avancados");
const botoesAbrirFiltrosMobile = document.querySelectorAll("[data-catalogo-filtro-toggle]");
const botaoFecharFiltrosMobile = document.querySelector("[data-catalogo-filtro-fechar]");
const overlayFiltrosMobile = document.querySelector("[data-catalogo-filtro-overlay]");
const botaoAplicarFiltrosMobile = document.getElementById("aplicar-filtros-mobile");
const resumoFiltrosMobile = document.getElementById("resumo-filtros-mobile");

const todosCarros = carregarCarros();
let filtrosInicializados = false;

function preencherSelect(select, valores) {
  valores
    .filter(function (valor) {
      return valor && valor !== "-";
    })
    .filter(function (valor, index, listaValores) {
      return listaValores.indexOf(valor) === index;
    })
    .sort()
    .forEach(function (valor) {
      const option = document.createElement("option");
      option.value = valor;
      option.textContent = valor;
      select.appendChild(option);
    });
}

function preencherAnos() {
  const anoAtual = new Date().getFullYear();
  const anosEstoque = todosCarros.map(function (carro) {
    return Number(carro.ano);
  });
  const menorAnoEstoque = Math.min.apply(null, anosEstoque);
  const anoInicial = Math.min(menorAnoEstoque || anoAtual - 25, anoAtual - 25);

  for (let ano = anoAtual + 1; ano >= anoInicial; ano--) {
    const optionMin = document.createElement("option");
    const optionMax = document.createElement("option");

    optionMin.value = ano;
    optionMin.textContent = ano;
    optionMax.value = ano;
    optionMax.textContent = ano;

    filtroAnoMin.appendChild(optionMin);
    filtroAnoMax.appendChild(optionMax);
  }
}

function preencherFiltros() {
  const marcasEstoque = todosCarros.map(function (carro) {
    return carro.marca;
  });

  preencherSelect(
    filtroMarca,
    marcasDisponiveis.concat(marcasEstoque)
  );

  preencherSelect(
    filtroCambio,
    todosCarros.map(function (carro) {
      return carro.cambio;
    })
  );

  preencherSelect(
    filtroCombustivel,
    todosCarros.map(function (carro) {
      return carro.combustivel;
    })
  );

  preencherSelect(
    filtroCor,
    todosCarros.map(function (carro) {
      return carro.cor;
    })
  );

  preencherSelect(
    filtroTipo,
    todosCarros.map(function (carro) {
      return carro.tipo;
    })
  );

  preencherSelect(
    filtroStatus,
    todosCarros.map(function (carro) {
      return carro.status;
    })
  );
}

function kmNumero(km) {
  return Number(String(km).replace(/\D/g, ""));
}

function normalizarTexto(texto) {
  return String(texto || "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase();
}

function carroCombinaBusca(carro, termo) {
  const texto = [
    carro.nome,
    carro.marca,
    carro.modelo,
    carro.cor,
    carro.combustivel,
    carro.cambio,
    carro.tipo,
    carro.status,
    carro.ano,
  ].join(" ");

  return normalizarTexto(texto).includes(normalizarTexto(termo));
}

function pesoStatus(carro) {
  if (carro.status === "Disponível") return 0;
  if (carro.status === "Reservado") return 1;
  return 2;
}

function ordenarDestaques(a, b) {
  return (
    pesoStatus(a) - pesoStatus(b) ||
    Number(b.destaque) - Number(a.destaque) ||
    Number(b.oferta) - Number(a.oferta) ||
    Number(b.ano) - Number(a.ano)
  );
}

function renderizar(listaCarros) {
  lista.innerHTML = "";
  contadorResultados.textContent =
    listaCarros.length + " de " + todosCarros.length + " veículo(s)";
  renderizarResumoCatalogo(listaCarros);

  if (resumoFiltrosMobile) {
    resumoFiltrosMobile.textContent = listaCarros.length + " encontrados";
  }

  if (listaCarros.length === 0) {
    lista.innerHTML =
      '<p class="sem-resultados">Nenhum carro encontrado. Ajuste os filtros para ver mais opções.</p>';
    return;
  }

  const cards = listaCarros.map(function (carro) {
    const idCarro = Number(carro.id) || 0;
    const badge = carro.oferta ? '<span class="badge-oferta">OFERTA</span>' : "";
    const badgeStatus =
      carro.status !== "Disponível" && carro.status !== "Vendido"
        ? '<span class="badge-status">' + escaparHTML(carro.status) + "</span>"
        : "";
    const carimboVendido =
      carro.status === "Vendido" ? '<span class="carimbo-vendido">VENDIDO</span>' : "";
    const mensagem = mensagemVeiculo(carro);
    const botaoWhatsapp =
      carro.status === "Vendido"
        ? '<span class="btn-indisponivel">Vendido</span>'
        : '<a href="' +
          escaparAtributo(criarLinkWhatsApp(mensagem)) +
          '" class="btn-whatsapp" target="_blank" rel="noopener" onclick="event.stopPropagation()">WhatsApp</a>';

    return (
      '<article class="carro-card card-clicavel ' +
      (carro.status === "Vendido" ? "carro-vendido" : "") +
      '" tabindex="0" role="link" aria-label="Ver detalhes de ' +
      escaparAtributo(carro.nome) +
      '" onclick="abrirDetalhesCarro(' +
      idCarro +
      ')" onkeydown="if(event.key === \'Enter\') abrirDetalhesCarro(' +
      idCarro +
      ')">' +
      '<div class="carro-img-box">' +
      badge +
      badgeStatus +
      carimboVendido +
      '<img src="' +
      escaparAtributo(carro.imagem) +
      '" alt="' +
      escaparAtributo(carro.nome) +
      '" loading="lazy" decoding="async">' +
      "</div>" +
      '<div class="carro-info">' +
      "<h3>" +
      escaparHTML(carro.nome) +
      "</h3>" +
      "<p>" +
      escaparHTML(textoCarro(carro)) +
      "</p>" +
      '<p class="carro-meta">' +
      escaparHTML(carro.combustivel) +
      " | " +
      escaparHTML(carro.cor) +
      " | " +
      escaparHTML(carro.tipo) +
      "</p>" +
      "<strong>" +
      escaparHTML(carro.preco) +
      "</strong>" +
      '<div class="carro-acoes">' +
      '<a href="detalhes.html?id=' +
      idCarro +
      '" class="btn-primary" onclick="event.stopPropagation()">Ver detalhes</a>' +
      botaoWhatsapp +
      "</div>" +
      "</div>" +
      "</article>"
    );
  });

  lista.innerHTML = cards.join("");
}

function renderizarResumoCatalogo(listaCarros) {
  if (!catalogoResumo) return;

  const disponiveis = listaCarros.filter(function (carro) {
    return carro.status === "Disponível";
  }).length;
  const ofertas = listaCarros.filter(function (carro) {
    return carro.oferta === true;
  }).length;
  const precos = listaCarros.map(function (carro) {
    return precoNumero(carro.preco);
  }).filter(Boolean);
  const menorPreco = precos.length ? Math.min.apply(null, precos) : 0;
  const maiorPreco = precos.length ? Math.max.apply(null, precos) : 0;
  const faixa = menorPreco && maiorPreco
    ? formatarMoeda(menorPreco) + " até " + formatarMoeda(maiorPreco)
    : "Sem faixa definida";

  catalogoResumo.innerHTML =
    '<article><span>Disponíveis</span><strong>' +
    disponiveis +
    "</strong></article>" +
    '<article><span>Ofertas</span><strong>' +
    ofertas +
    "</strong></article>" +
    '<article><span>Faixa de preço</span><strong>' +
    escaparHTML(faixa) +
    "</strong></article>";
}

function abrirDetalhesCarro(id) {
  window.location.href = "detalhes.html?id=" + id;
}

function obterFiltrosAtuais() {
  return {
    busca: filtroBusca.value.trim(),
    marca: filtroMarca.value,
    cambio: filtroCambio.value,
    combustivel: filtroCombustivel.value,
    cor: filtroCor.value,
    tipo: filtroTipo.value,
    status: filtroStatus.value,
    anoMin: filtroAnoMin.value,
    anoMax: filtroAnoMax.value,
    faixaPreco: filtroFaixaPreco.value,
    precoMin: filtroPrecoMin.value,
    precoMax: filtroPrecoMax.value,
    kmMax: filtroKmMax.value,
    oferta: filtroOferta.checked,
    disponivel: filtroDisponivel.checked,
    blindado: filtroBlindado.checked,
    ordem: ordenarPreco.value,
  };
}

function atualizarUrlFiltros(filtros) {
  if (!filtrosInicializados) return;

  const params = new URLSearchParams();

  Object.keys(filtros).forEach(function (chave) {
    const valor = filtros[chave];

    if (valor === true) {
      params.set(chave, "1");
    } else if (valor && valor !== false) {
      params.set(chave, valor);
    }
  });

  const query = params.toString();
  const novaUrl = window.location.pathname + (query ? "?" + query : "");
  window.history.replaceState(null, "", novaUrl);
}

function criarChipFiltro(rotulo, valor, limpar) {
  const botao = document.createElement("button");
  botao.type = "button";
  botao.className = "filtro-chip";
  botao.innerHTML =
    "<span>" +
    escaparHTML(rotulo) +
    "</span>" +
    (valor ? "<strong>" + escaparHTML(valor) + "</strong>" : "") +
    '<small aria-hidden="true">×</small>';
  botao.setAttribute("aria-label", "Remover filtro " + rotulo);
  botao.addEventListener("click", function () {
    limpar();
    aplicarFiltros();
  });

  return botao;
}

function renderizarFiltrosAtivos(filtros) {
  filtrosAtivos.innerHTML = "";

  const chips = [
    filtros.busca && criarChipFiltro("Busca", filtros.busca, function () {
      filtroBusca.value = "";
    }),
    filtros.marca && criarChipFiltro("Marca", filtros.marca, function () {
      filtroMarca.value = "";
    }),
    filtros.cambio && criarChipFiltro("Câmbio", filtros.cambio, function () {
      filtroCambio.value = "";
    }),
    filtros.combustivel && criarChipFiltro("Combustível", filtros.combustivel, function () {
      filtroCombustivel.value = "";
    }),
    filtros.cor && criarChipFiltro("Cor", filtros.cor, function () {
      filtroCor.value = "";
    }),
    filtros.tipo && criarChipFiltro("Tipo", filtros.tipo, function () {
      filtroTipo.value = "";
    }),
    filtros.status && criarChipFiltro("Status", filtros.status, function () {
      filtroStatus.value = "";
    }),
    filtros.anoMin && criarChipFiltro("Ano inicial", filtros.anoMin, function () {
      filtroAnoMin.value = "";
    }),
    filtros.anoMax && criarChipFiltro("Ano final", filtros.anoMax, function () {
      filtroAnoMax.value = "";
    }),
    filtros.faixaPreco && criarChipFiltro("Faixa", filtroFaixaPreco.options[filtroFaixaPreco.selectedIndex].text, function () {
      filtroFaixaPreco.value = "";
    }),
    filtros.precoMin && criarChipFiltro("Preço mínimo", formatarMoeda(precoNumero(filtros.precoMin)), function () {
      filtroPrecoMin.value = "";
    }),
    filtros.precoMax && criarChipFiltro("Preço máximo", formatarMoeda(precoNumero(filtros.precoMax)), function () {
      filtroPrecoMax.value = "";
    }),
    filtros.kmMax && criarChipFiltro("Km máximo", filtros.kmMax, function () {
      filtroKmMax.value = "";
    }),
    filtros.oferta && criarChipFiltro("Ofertas", "", function () {
      filtroOferta.checked = false;
    }),
    filtros.disponivel && criarChipFiltro("Disponíveis", "", function () {
      filtroDisponivel.checked = false;
    }),
    filtros.blindado && criarChipFiltro("Blindados", "", function () {
      filtroBlindado.checked = false;
    }),
    filtros.ordem && criarChipFiltro("Ordenação", ordenarPreco.options[ordenarPreco.selectedIndex].text, function () {
      ordenarPreco.value = "";
    }),
  ].filter(Boolean);

  chips.forEach(function (chip) {
    filtrosAtivos.appendChild(chip);
  });
}

function aplicarFiltros() {
  let filtrados = todosCarros.slice();
  const filtros = obterFiltrosAtuais();
  const anoMin = Number(filtros.anoMin);
  const anoMax = Number(filtros.anoMax);
  const faixaPreco = filtros.faixaPreco
    .split("-")
    .map(function (valor) {
      return Number(valor);
    });
  const precoMin = precoNumero(filtros.precoMin) || faixaPreco[0];
  const precoMax = precoNumero(filtros.precoMax) || faixaPreco[1];
  const kmMax = Number(filtros.kmMax);

  if (filtros.busca !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carroCombinaBusca(carro, filtros.busca);
    });
  }

  if (filtros.marca !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.marca === filtros.marca;
    });
  }

  if (filtros.cambio !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.cambio === filtros.cambio;
    });
  }

  if (filtros.combustivel !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.combustivel === filtros.combustivel;
    });
  }

  if (filtros.cor !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.cor === filtros.cor;
    });
  }

  if (filtros.tipo !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.tipo === filtros.tipo;
    });
  }

  if (filtros.status !== "") {
    filtrados = filtrados.filter(function (carro) {
      return carro.status === filtros.status;
    });
  }

  if (anoMin) {
    filtrados = filtrados.filter(function (carro) {
      return Number(carro.ano) >= anoMin;
    });
  }

  if (anoMax) {
    filtrados = filtrados.filter(function (carro) {
      return Number(carro.ano) <= anoMax;
    });
  }

  if (precoMin) {
    filtrados = filtrados.filter(function (carro) {
      return precoNumero(carro.preco) >= precoMin;
    });
  }

  if (precoMax) {
    filtrados = filtrados.filter(function (carro) {
      return precoNumero(carro.preco) <= precoMax;
    });
  }

  if (kmMax) {
    filtrados = filtrados.filter(function (carro) {
      return kmNumero(carro.km) <= kmMax;
    });
  }

  if (filtros.oferta) {
    filtrados = filtrados.filter(function (carro) {
      return carro.oferta === true;
    });
  }

  if (filtros.disponivel) {
    filtrados = filtrados.filter(function (carro) {
      return carro.status === "Disponível";
    });
  }

  if (filtros.blindado) {
    filtrados = filtrados.filter(function (carro) {
      return carro.blindado === true;
    });
  }

  if (filtros.ordem === "") {
    filtrados.sort(ordenarDestaques);
  }

  if (filtros.ordem === "preco-menor") {
    filtrados.sort(function (a, b) {
      return precoNumero(a.preco) - precoNumero(b.preco);
    });
  }

  if (filtros.ordem === "preco-maior") {
    filtrados.sort(function (a, b) {
      return precoNumero(b.preco) - precoNumero(a.preco);
    });
  }

  if (filtros.ordem === "ano-maior") {
    filtrados.sort(function (a, b) {
      return Number(b.ano) - Number(a.ano);
    });
  }

  if (filtros.ordem === "ano-menor") {
    filtrados.sort(function (a, b) {
      return Number(a.ano) - Number(b.ano);
    });
  }

  if (filtros.ordem === "km-menor") {
    filtrados.sort(function (a, b) {
      return kmNumero(a.km) - kmNumero(b.km);
    });
  }

  if (filtros.ordem === "destaques") {
    filtrados.sort(ordenarDestaques);
  }

  if (filtros.ordem === "disponiveis") {
    filtrados.sort(function (a, b) {
      return pesoStatus(a) - pesoStatus(b) || Number(b.ano) - Number(a.ano);
    });
  }

  renderizarFiltrosAtivos(filtros);
  atualizarUrlFiltros(filtros);
  renderizar(filtrados);
}

function limparTodosFiltros() {
  filtroBusca.value = "";
  filtroMarca.value = "";
  filtroCambio.value = "";
  filtroCombustivel.value = "";
  filtroCor.value = "";
  filtroTipo.value = "";
  filtroStatus.value = "";
  filtroAnoMin.value = "";
  filtroAnoMax.value = "";
  filtroFaixaPreco.value = "";
  filtroPrecoMin.value = "";
  filtroPrecoMax.value = "";
  filtroKmMax.value = "";
  filtroOferta.checked = false;
  filtroDisponivel.checked = false;
  filtroBlindado.checked = false;
  ordenarPreco.value = "";
  aplicarFiltros();
}

function carregarFiltrosDaUrl() {
  const params = new URLSearchParams(window.location.search);

  [
    ["busca", filtroBusca],
    ["marca", filtroMarca],
    ["cambio", filtroCambio],
    ["combustivel", filtroCombustivel],
    ["cor", filtroCor],
    ["tipo", filtroTipo],
    ["status", filtroStatus],
    ["anoMin", filtroAnoMin],
    ["anoMax", filtroAnoMax],
    ["faixaPreco", filtroFaixaPreco],
    ["precoMin", filtroPrecoMin],
    ["precoMax", filtroPrecoMax],
    ["kmMax", filtroKmMax],
    ["ordem", ordenarPreco],
  ].forEach(function (item) {
    const valor = params.get(item[0]);

    if (valor !== null) {
      item[1].value = valor;
    }
  });

  filtroOferta.checked = params.get("oferta") === "1";
  filtroDisponivel.checked = params.get("disponivel") === "1";
  filtroBlindado.checked = params.get("blindado") === "1";

  if (
    filtrosAvancados &&
    [
      "cambio",
      "combustivel",
      "cor",
      "tipo",
      "status",
      "anoMax",
      "precoMin",
      "precoMax",
      "kmMax",
      "blindado",
    ].some(function (chave) {
      return params.has(chave);
    })
  ) {
    filtrosAvancados.open = true;
  }
}

[
  filtroBusca,
  filtroMarca,
  filtroCambio,
  filtroCombustivel,
  filtroCor,
  filtroTipo,
  filtroStatus,
  filtroAnoMin,
  filtroAnoMax,
  filtroFaixaPreco,
  filtroPrecoMin,
  filtroPrecoMax,
  filtroKmMax,
  filtroOferta,
  filtroDisponivel,
  filtroBlindado,
  ordenarPreco,
].forEach(function (campo) {
  campo.addEventListener("input", aplicarFiltros);
  campo.addEventListener("change", aplicarFiltros);
});

limparFiltros.addEventListener("click", limparTodosFiltros);

function atualizarEstadoBotoesFiltrosMobile(aberto) {
  botoesAbrirFiltrosMobile.forEach(function (botao) {
    botao.setAttribute("aria-expanded", String(aberto));
  });
}

function abrirFiltrosMobile() {
  document.body.classList.add("catalogo-filtros-aberto");
  atualizarEstadoBotoesFiltrosMobile(true);
}

function fecharFiltrosMobile() {
  document.body.classList.remove("catalogo-filtros-aberto");
  atualizarEstadoBotoesFiltrosMobile(false);
}

botoesAbrirFiltrosMobile.forEach(function (botao) {
  botao.addEventListener("click", abrirFiltrosMobile);
});

if (botaoFecharFiltrosMobile) {
  botaoFecharFiltrosMobile.addEventListener("click", fecharFiltrosMobile);
}

if (overlayFiltrosMobile) {
  overlayFiltrosMobile.addEventListener("click", fecharFiltrosMobile);
}

if (botaoAplicarFiltrosMobile) {
  botaoAplicarFiltrosMobile.addEventListener("click", fecharFiltrosMobile);
}

document.addEventListener("keydown", function (evento) {
  if (evento.key === "Escape") {
    fecharFiltrosMobile();
  }
});

preencherFiltros();
preencherAnos();
carregarFiltrosDaUrl();
filtrosInicializados = true;
aplicarFiltros();


