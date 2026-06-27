const destaqueHome = document.getElementById("destaque-home");
const baseCarrosHome = carregarCarros();
const carrosDisponiveisHome = baseCarrosHome.filter(function (carro) {
  return carro.status !== "Vendido";
});

const carroDestaque =
  carrosDisponiveisHome.find(function (carro) {
    return carro.oferta === true && carro.status !== "Vendido";
  }) ||
  carrosDisponiveisHome.find(function (carro) {
    return carro.destaque === true;
  }) ||
  carrosDisponiveisHome[0];

if (destaqueHome && carroDestaque) {
  const mensagem = mensagemVeiculo(carroDestaque);
  const idDestaque = Number(carroDestaque.id) || 0;

  destaqueHome.innerHTML =
    '<div class="showcase-topline"><span>Selecionado pela equipe</span><strong>Pronto para negociar</strong></div>' +
    '<div class="showcase-img"></div>' +
    '<div class="showcase-card">' +
    '<span class="showcase-badge">Oferta em destaque</span>' +
    "<h3>" +
    escaparHTML(carroDestaque.nome) +
    "</h3>" +
    "<p>" +
    escaparHTML(textoCarro(carroDestaque)) +
    "</p>" +
    "<strong>" +
    escaparHTML(carroDestaque.preco) +
    "</strong>" +
    '<div class="showcase-actions"><a href="detalhes.html?id=' +
    idDestaque +
    '" class="btn-primary">Ver oferta</a>' +
    '<a href="' +
    escaparAtributo(criarLinkWhatsApp(mensagem)) +
    '" class="btn-whatsapp destaque-whats" target="_blank">WhatsApp</a></div>' +
    "</div>";

  destaqueHome.querySelector(".showcase-img").style.backgroundImage =
    'url("' + String(carroDestaque.imagem || "").replace(/"/g, "%22") + '")';
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

  if (!destaque) {
    homeVendedorMes.innerHTML =
      '<article class="vendedor-mes-card vendedor-mes-card-vazio">' +
      '<div class="vendedor-mes-avatar">3M</div>' +
      '<div><span>Atendimento em destaque</span>' +
      '<h3>Equipe pronta para ajudar</h3>' +
      '<p>Fale com a 3M Veículos para encontrar o carro ideal ou iniciar uma negociação.</p></div>' +
      '<a href="' +
      escaparAtributo(criarLinkWhatsApp("Olá! Gostaria de falar com a equipe da 3M Veículos.")) +
      '" class="btn-whatsapp" target="_blank">Falar com a equipe</a>' +
      "</article>";
    return;
  }

  homeVendedorMes.innerHTML =
    '<article class="vendedor-mes-card">' +
    '<div class="vendedor-mes-avatar">' +
    escaparHTML(iniciaisNome(destaque.nome)) +
    "</div>" +
    "<div><span>Vendedor do mês</span>" +
    "<h3>" +
    escaparHTML(destaque.nome) +
    "</h3>" +
    "<p>" +
    destaque.vendas +
    " venda(s) no mês · " +
    escaparHTML(formatarMoeda(destaque.valor)) +
    " em negócios registrados.</p></div>" +
    '<a href="' +
    escaparAtributo(criarLinkWhatsApp("Olá! Gostaria de falar com o vendedor em destaque da 3M Veículos.")) +
    '" class="btn-whatsapp" target="_blank">Falar com a equipe</a>' +
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
      return (
        '<article class="depoimento-card">' +
        '<img class="foto-entrega" src="' +
        escaparAtributo(depoimento.imagem) +
        '" alt="Foto da entrega do veículo para ' +
        escaparAtributo(depoimento.cliente) +
        '" loading="lazy">' +
        '<div class="cliente-info">' +
        "<div>" +
        "<strong>" +
        escaparHTML(depoimento.cliente) +
        "</strong>" +
        "<span>Comprou " +
        escaparHTML(depoimento.veiculo) +
        "</span>" +
        "</div>" +
        "</div>" +
        "<p>" +
        '"' +
        escaparHTML(depoimento.texto) +
        '"' +
        "</p>" +
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


