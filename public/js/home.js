const destaqueHome = document.getElementById("destaque-home");
const baseCarrosHome = carregarCarros();
const carrosDisponiveisHome = baseCarrosHome.filter(function (carro) {
  return carro.status !== "Vendido";
});
const carrosOfertaHome = carrosDisponiveisHome.filter(function (carro) {
  return carro.oferta === true;
});

const carroDestaque =
  carrosOfertaHome[0] ||
  carrosDisponiveisHome.find(function (carro) {
    return carro.destaque === true;
  }) ||
  carrosDisponiveisHome[0];

function montarIndicadoresOfertas(indiceAtual, total) {
  if (total <= 1) return "";

  let html = '<div class="showcase-indicadores" aria-label="Ofertas em destaque">';

  for (let i = 0; i < total; i += 1) {
    html +=
      '<button type="button" aria-label="Ver oferta ' +
      (i + 1) +
      '" class="' +
      (i === indiceAtual ? "ativo" : "") +
      '" data-oferta-indice="' +
      i +
      '"></button>';
  }

  return html + "</div>";
}

function htmlOfertaDestaque(carro, indice, total) {
  const mensagem = mensagemVeiculo(carro);
  const idDestaque = Number(carro.id) || 0;
  const totalOfertas = Number(total) || 1;
  const indiceAtual = Number(indice) || 0;
  const textoContador =
    totalOfertas > 1 ? "Oferta " + (indiceAtual + 1) + " de " + totalOfertas : "Pronto para negociar";

  return (
    '<div class="showcase-topline"><span>Ofertas</span><strong>' +
    escaparHTML(textoContador) +
    "</strong></div>" +
    '<div class="showcase-img"><img src="' +
    escaparAtributo(carro.imagem) +
    '" alt="' +
    escaparAtributo(carro.nome) +
    '" decoding="async" fetchpriority="high"></div>' +
    '<div class="showcase-card">' +
    '<span class="showcase-badge">Oferta em destaque</span>' +
    "<h3>" +
    escaparHTML(carro.nome) +
    "</h3>" +
    "<p>" +
    escaparHTML(textoCarro(carro)) +
    "</p>" +
    '<div class="showcase-price"><span>Preço anunciado</span><strong>' +
    escaparHTML(carro.preco) +
    "</strong></div>" +
    '<div class="showcase-actions"><a href="detalhes.html?id=' +
    idDestaque +
    '" class="btn-primary">Ver oferta</a>' +
    '<a href="' +
    escaparAtributo(criarLinkWhatsApp(mensagem)) +
    '" class="btn-whatsapp destaque-whats" target="_blank" rel="noopener">WhatsApp</a></div>' +
    montarIndicadoresOfertas(indiceAtual, totalOfertas) +
    "</div>"
  );
}

let timerOfertasHome = null;

function vincularIndicadoresOfertas(carros) {
  if (!destaqueHome) return;

  destaqueHome.querySelectorAll("[data-oferta-indice]").forEach(function (botao) {
    botao.addEventListener("click", function () {
      const indice = Number(botao.dataset.ofertaIndice) || 0;
      renderizarOfertaDestaque(carros, indice);
      reiniciarTimerOfertas(carros);
    });
  });
}

function renderizarOfertaDestaque(carros, indice) {
  if (!destaqueHome || !carros.length) return;

  const total = carros.length;
  const indiceSeguro = ((indice % total) + total) % total;
  const carro = carros[indiceSeguro];
  const htmlDestaque = htmlOfertaDestaque(carro, indiceSeguro, total);
  const aplicarHtml = function () {
    destaqueHome.innerHTML = htmlDestaque;
    destaqueHome.dataset.hidratado = "true";
    destaqueHome.dataset.ofertaAtual = String(indiceSeguro);
    vincularIndicadoresOfertas(carros);
  };

  if (carro.imagem) {
    const preload = new Image();
    preload.decoding = "async";
    preload.onload = aplicarHtml;
    preload.onerror = aplicarHtml;
    preload.src = carro.imagem;
  } else {
    aplicarHtml();
  }
}

function reiniciarTimerOfertas(carros) {
  if (timerOfertasHome) {
    window.clearInterval(timerOfertasHome);
  }

  if (!carros || carros.length <= 1 || !destaqueHome) return;

  timerOfertasHome = window.setInterval(function () {
    const indiceAtual = Number(destaqueHome.dataset.ofertaAtual || 0);
    renderizarOfertaDestaque(carros, indiceAtual + 1);
  }, 5200);
}

if (destaqueHome && carroDestaque) {
  const carrosTelao = carrosOfertaHome.length > 0 ? carrosOfertaHome : [carroDestaque];

  if (!destaqueHome.dataset.hidratado) {
    renderizarOfertaDestaque(carrosTelao, 0);
    reiniciarTimerOfertas(carrosTelao);
  }
}

const listaDepoimentosHome = document.getElementById("lista-depoimentos-home");
const depoimentosPrev = document.getElementById("depoimentos-prev");
const depoimentosNext = document.getElementById("depoimentos-next");
const homeVeiculosGrid = document.getElementById("home-veiculos-grid");
const homeVendedorMes = document.getElementById("home-vendedor-mes");
const listaParceriasHome = document.getElementById("lista-parcerias-home");

const logosBancos = {
  santander: "https://logo.clearbit.com/santander.com.br",
  bradesco: "https://logo.clearbit.com/bradesco.com.br",
  itau: "https://logo.clearbit.com/itau.com.br",
  "banco do brasil": "https://logo.clearbit.com/bb.com.br",
  caixa: "https://logo.clearbit.com/caixa.gov.br",
  "bv financeira": "https://logo.clearbit.com/bv.com.br",
  bv: "https://logo.clearbit.com/bv.com.br",
};

function chaveBanco(nome) {
  return String(nome || "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase()
    .replace(/\s+/g, " ")
    .trim();
}

function montarCardBanco(parceria) {
  const nome = parceria.nome || "";
  const logo = logosBancos[chaveBanco(nome)];
  const imagemLogo = logo
    ? '<img src="' +
      escaparAtributo(logo) +
      '" alt="Logo ' +
      escaparAtributo(nome) +
      '" loading="lazy" onerror="this.style.display=\'none\'">' 
    : "";

  return (
    '<div class="banco-card">' +
    imagemLogo +
    "<span>" +
    escaparHTML(nome) +
    "</span>" +
    "</div>"
  );
}

if (listaParceriasHome) {
  const parcerias = carregarParcerias().filter(function (parceria) {
    return parceria.ativo;
  });

  listaParceriasHome.innerHTML = parcerias
    .map(function (parceria) {
      return montarCardBanco(parceria);
    })
    .join("");
}

if (homeVeiculosGrid) {
  const veiculosHome = carrosDisponiveisHome
    .sort(function (a, b) {
      return Number(b.destaque) - Number(a.destaque) || Number(b.oferta) - Number(a.oferta);
    })
    .slice(0, 4);

  homeVeiculosGrid.innerHTML = veiculosHome
    .map(function (carro) {
      const idCarro = Number(carro.id) || 0;

      return (
        '<article class="carro-card card-clicavel" onclick="abrirDetalhesCarro(' +
        idCarro +
        ')">' +
        '<div class="carro-img-box">' +
        (carro.oferta ? '<span class="badge-oferta">OFERTA</span>' : "") +
        (carro.status !== "Disponível"
          ? '<span class="badge-status">' + escaparHTML(carro.status) + "</span>"
          : "") +
        '<img src="' +
        escaparAtributo(carro.imagem) +
        '" alt="' +
        escaparAtributo(carro.nome) +
        '" loading="lazy">' +
        "</div>" +
        '<div class="carro-info">' +
        '<div class="selos-comerciais">' +
        montarSelosComerciais(carro) +
        "</div>" +
        "<h3>" +
        escaparHTML(carro.nome) +
        "</h3>" +
        "<p>" +
        escaparHTML(textoCarro(carro)) +
        "</p>" +
        '<p class="carro-meta">' +
        escaparHTML(carro.tipo) +
        " | " +
        escaparHTML(carro.cor) +
        "</p>" +
        "<strong>" +
        escaparHTML(carro.preco) +
        "</strong>" +
        '<div class="carro-acoes">' +
        '<a href="detalhes.html?id=' +
        idCarro +
        '" class="btn-primary" onclick="event.stopPropagation()">Detalhes</a>' +
        '<a href="' +
        escaparAtributo(criarLinkWhatsApp(mensagemVeiculo(carro))) +
        '" class="btn-whatsapp" target="_blank" onclick="event.stopPropagation()">WhatsApp</a>' +
        "</div>" +
        "</div>" +
        "</article>"
      );
    })
    .join("");
}

function mesAtualLocal() {
  const hoje = new Date();
  const mes = String(hoje.getMonth() + 1).padStart(2, "0");

  return hoje.getFullYear() + "-" + mes;
}

function iniciaisNome(nome) {
  return String(nome || "Equipe 3M")
    .split(" ")
    .filter(Boolean)
    .slice(0, 2)
    .map(function (parte) {
      return parte.slice(0, 1).toUpperCase();
    })
    .join("");
}

function montarFotoVendedorHome(vendedor, nome) {
  if (vendedor && vendedor.foto) {
    return (
      '<img src="' +
      escaparAtributo(vendedor.foto) +
      '" alt="Foto de ' +
      escaparAtributo(nome || vendedor.nome || "vendedor") +
      '">'
    );
  }

  return escaparHTML(iniciaisNome(nome || (vendedor && vendedor.nome)));
}

function renderizarVendedorMesHome() {
  if (!homeVendedorMes) return;

  const mes = mesAtualLocal();
  const vendasMes = baseCarrosHome.filter(function (carro) {
    return carro.status === "Vendido" && String(carro.dataVenda || "").slice(0, 7) === mes;
  });
  const resumo = {};

  vendasMes.forEach(function (carro) {
    const nome = carro.vendedorNome || "Equipe 3M";

    if (!resumo[nome]) {
      resumo[nome] = {
        nome: nome,
        vendas: 0,
        valor: 0,
      };
    }

    resumo[nome].vendas += 1;
    resumo[nome].valor += Number(carro.valorVenda) || precoNumero(carro.preco);
  });

  const destaque = Object.values(resumo).sort(function (a, b) {
    return b.vendas - a.vendas || b.valor - a.valor;
  })[0];
  const vendedorContato = destaque ? buscarVendedorPublicoPorNome(destaque.nome) : null;

  if (!destaque) {
    const vendedorAtivo = carregarVendedoresPublicos()[0];
    const nomeFallback = vendedorAtivo ? vendedorAtivo.nome : "Equipe 3M";

    homeVendedorMes.innerHTML =
      '<article class="vendedor-mes-card vendedor-mes-card-vazio">' +
      '<div class="vendedor-mes-avatar">' +
      montarFotoVendedorHome(vendedorAtivo, nomeFallback) +
      "</div>" +
      '<div><span>Atendimento em destaque</span>' +
      "<h3>" +
      escaparHTML(nomeFallback) +
      "</h3>" +
      '<p>Equipe pronta para ajudar você a encontrar o carro ideal.</p></div>' +
      "</article>";
    return;
  }

  homeVendedorMes.innerHTML =
    '<article class="vendedor-mes-card">' +
    '<div class="vendedor-mes-avatar">' +
    montarFotoVendedorHome(vendedorContato, destaque.nome) +
    "</div>" +
    "<div><span>Vendedor do mês</span>" +
    "<h3>" +
    escaparHTML(destaque.nome) +
    "</h3>" +
    '<p>Destaque em atendimento e negociações neste mês.</p></div>' +
    "</article>";
}

renderizarVendedorMesHome();

function abrirDetalhesCarro(id) {
  window.location.href = "detalhes.html?id=" + id;
}

if (listaDepoimentosHome) {
  const depoimentos = carregarDepoimentos();

  listaDepoimentosHome.innerHTML = depoimentos
    .map(function (depoimento) {
      const imagemDepoimento = depoimento.imagem || "/img/logo-3m-veiculos.jpg";

      return (
        '<article class="depoimento-card">' +
        '<div class="depoimento-foto-box">' +
        '<img class="foto-entrega" src="' +
        escaparAtributo(imagemDepoimento) +
        '" alt="Foto da entrega do veículo para ' +
        escaparAtributo(depoimento.cliente) +
        '" loading="lazy" onerror="this.src=\'/img/logo-3m-veiculos.jpg\'">' +
        '<div class="cliente-info">' +
        "<strong>" +
        escaparHTML(depoimento.cliente) +
        "</strong>" +
        "</div>" +
        "</div>" +
        "</article>"
      );
    })
    .join("");

  function rolarDepoimentos(direcao) {
    const card = listaDepoimentosHome.querySelector(".depoimento-card");
    const distancia = card ? card.offsetWidth + 26 : 360;

    listaDepoimentosHome.scrollBy({
      left: distancia * direcao,
      behavior: "smooth",
    });
  }

  function atualizarBotoesDepoimentos() {
    const temRolagem =
      listaDepoimentosHome.scrollWidth > listaDepoimentosHome.clientWidth + 4;
    const estaNoInicio = listaDepoimentosHome.scrollLeft <= 4;
    const estaNoFim =
      listaDepoimentosHome.scrollLeft + listaDepoimentosHome.clientWidth >=
      listaDepoimentosHome.scrollWidth - 4;

    depoimentosPrev.disabled = !temRolagem || estaNoInicio;
    depoimentosNext.disabled = !temRolagem || estaNoFim;
  }

  if (depoimentosPrev && depoimentosNext) {
    depoimentosPrev.addEventListener("click", function () {
      rolarDepoimentos(-1);
    });

    depoimentosNext.addEventListener("click", function () {
      rolarDepoimentos(1);
    });

    listaDepoimentosHome.addEventListener("scroll", atualizarBotoesDepoimentos);
    window.addEventListener("resize", atualizarBotoesDepoimentos);
    setTimeout(atualizarBotoesDepoimentos, 100);
  }
}


