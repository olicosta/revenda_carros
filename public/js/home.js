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

function iconeWhatsAppCard() {
  return (
    '<svg class="card-action-svg card-action-svg-whatsapp" aria-hidden="true" viewBox="0 0 32 32" focusable="false">' +
    '<path d="M16.03 4.5c-6.25 0-11.34 5.08-11.34 11.33 0 2 .52 3.94 1.52 5.65L4.6 27.5l6.16-1.57a11.28 11.28 0 0 0 5.27 1.29c6.25 0 11.33-5.08 11.33-11.34S22.28 4.5 16.03 4.5Zm0 20.78c-1.67 0-3.29-.44-4.71-1.28l-.34-.2-3.65.93.97-3.56-.22-.37a9.4 9.4 0 0 1-1.45-4.97 9.42 9.42 0 1 1 9.4 9.45Zm5.18-7.06c-.28-.14-1.67-.82-1.93-.91-.26-.1-.45-.14-.64.14-.19.28-.73.91-.9 1.1-.16.19-.33.21-.61.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.41-1.68-1.57-1.96-.16-.28-.02-.43.12-.57.13-.12.28-.33.42-.49.14-.16.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.55-.47-.48-.64-.49h-.55c-.19 0-.49.07-.75.35-.26.28-.98.96-.98 2.34s1 2.71 1.14 2.9c.14.19 1.97 3.01 4.77 4.22.67.29 1.19.46 1.59.59.67.21 1.28.18 1.76.11.54-.08 1.67-.68 1.9-1.34.23-.66.23-1.22.16-1.34-.07-.12-.26-.19-.54-.33Z"/>' +
    "</svg>"
  );
}

function iconeDetalhesCard() {
  return (
    '<svg class="card-action-svg card-action-svg-detail" aria-hidden="true" viewBox="0 0 24 24" focusable="false">' +
    '<path d="M12 5.25c5.05 0 8.35 4.28 9.42 5.88.35.53.35 1.21 0 1.74-1.07 1.6-4.37 5.88-9.42 5.88s-8.35-4.28-9.42-5.88a1.55 1.55 0 0 1 0-1.74C3.65 9.53 6.95 5.25 12 5.25Zm0 2C7.98 7.25 5.2 10.6 4.29 12c.91 1.4 3.69 4.75 7.71 4.75s6.8-3.35 7.71-4.75c-.91-1.4-3.69-4.75-7.71-4.75Zm0 2.05A2.7 2.7 0 1 1 12 14.7a2.7 2.7 0 0 1 0-5.4Z"/>' +
    "</svg>"
  );
}

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
        '" class="btn-primary card-action-icon" title="Ver detalhes" aria-label="Ver detalhes" onclick="event.stopPropagation()">' +
        iconeDetalhesCard() +
        "</a>" +
        '<a href="' +
        escaparAtributo(criarLinkWhatsApp(mensagemVeiculo(carro))) +
        '" class="btn-whatsapp card-action-icon" target="_blank" rel="noopener" title="Chamar no WhatsApp" aria-label="Chamar no WhatsApp" onclick="event.stopPropagation()">' +
        iconeWhatsAppCard() +
        "</a>" +
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


