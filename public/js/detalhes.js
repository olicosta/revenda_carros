const params = new URLSearchParams(window.location.search);
const id = Number(params.get("id"));
const container = document.getElementById("detalhe-carro");

const carrosDetalhes = carregarCarros();
const carro = carrosDetalhes.find(function (item) {
  return Number(item.id) === id;
});

function criarItemFicha(rotulo, valor) {
  return (
    "<span><b>" +
    escaparHTML(rotulo) +
    "</b>" +
    escaparHTML(valor || "-") +
    "</span>"
  );
}

async function copiarLinkVeiculo() {
  const link = window.location.href;

  if (navigator.clipboard) {
    navigator.clipboard.writeText(link);
    alert("Link do veículo copiado.");
    return;
  }

  await solicitarTexto("Copie o link do veículo:", link, "Link do veículo");
}

function compartilharVeiculo(nome) {
  const dados = {
    title: nome,
    text: "Confira este veículo:",
    url: window.location.href,
  };

  if (navigator.share) {
    navigator.share(dados);
    return;
  }

  copiarLinkVeiculo();
}

if (container && carro) {
  const mensagem = mensagemVeiculo(carro);
  const galeria = carro.galeria || [carro.imagem];
  const nomeSeguro = escaparHTML(carro.nome);
  const nomeAtributo = escaparAtributo(carro.nome);
  const idCarroAtual = Number(carro.id) || 0;
  const descricaoSeo =
    carro.nome + " " + textoCarro(carro) + " por " + carro.preco + " na 3M Veículos.";
  const relacionados = carrosDetalhes
    .filter(function (item) {
      return Number(item.id) !== Number(carro.id) && item.status !== "Vendido";
    })
    .slice(0, 3);
  const botaoContato =
    carro.status === "Vendido"
      ? '<span class="btn-indisponivel detalhe-indisponivel">Vendido</span>'
      : '<a href="' +
        escaparAtributo(criarLinkWhatsApp(mensagem)) +
        '" class="btn-whatsapp" target="_blank">Falar no WhatsApp</a>';
  const linkWhatsAppContato = criarLinkWhatsApp(mensagem);
  const linkFinanciamento =
    "financiamento.html?veiculo=" +
    encodeURIComponent(carro.nome + " - " + carro.preco);
  const badgeStatusDetalhe =
    carro.status !== "Vendido"
      ? '<span class="badge-status detalhe-status">' +
        escaparHTML(carro.status) +
        "</span>"
      : "";

  atualizarSeoPagina(
    carro.nome + " - 3M Veículos",
    descricaoSeo,
    carro.imagem
  );

  container.innerHTML =
    '<div class="detalhe-card">' +
    '<div class="detalhe-galeria">' +
    '<div class="galeria-principal">' +
    '<img src="' +
    escaparAtributo(galeria[0]) +
    '" class="detalhe-img" id="imagem-principal" alt="' +
    nomeAtributo +
    '">' +
    '<button type="button" class="galeria-btn galeria-prev" id="galeria-prev" aria-label="Foto anterior">&lsaquo;</button>' +
    '<button type="button" class="galeria-btn galeria-next" id="galeria-next" aria-label="Próxima foto">&rsaquo;</button>' +
    '<button type="button" class="galeria-full" id="galeria-full" aria-label="Ver foto em tela cheia">Tela cheia</button>' +
    (carro.status === "Vendido" ? '<span class="carimbo-vendido">VENDIDO</span>' : "") +
    '<span class="galeria-contador" id="galeria-contador">1 / ' +
    galeria.length +
    "</span>" +
    "</div>" +
    '<div class="galeria-miniaturas">' +
    galeria
      .map(function (imagem, index) {
        return (
          '<button type="button" class="miniatura' +
          (index === 0 ? " ativa" : "") +
          '" data-index="' +
          index +
          '"><img src="' +
          escaparAtributo(imagem) +
          '" alt="Foto ' +
          (index + 1) +
          " de " +
          nomeAtributo +
          '"></button>'
        );
      })
      .join("") +
    "</div>" +
    "</div>" +
    '<div class="detalhe-info">' +
    '<div class="detalhe-badges">' +
    (carro.oferta ? '<span class="badge-oferta detalhe-oferta">OFERTA</span>' : "") +
    badgeStatusDetalhe +
    "</div>" +
    '<div class="detalhe-resumo">' +
    "<h2>" +
    nomeSeguro +
    "</h2>" +
    '<p class="detalhe-meta">' +
    escaparHTML(textoCarro(carro)) +
    "</p>" +
    '<div class="detalhe-confiança">' +
    '<span>Procedência conferida</span>' +
    '<span>Atendimento direto</span>' +
    '<span>Financiamento disponível</span>' +
    "</div>" +
    '<div class="detalhe-preco-box">' +
    '<span>Preço anunciado</span>' +
    "<h3>" +
    escaparHTML(carro.preco) +
    "</h3>" +
    "</div>" +
    '<p class="detalhe-descricao">' +
    escaparHTML(carro.descricao) +
    "</p>" +
    "</div>" +
    '<details class="detalhe-bloco detalhe-ficha-card">' +
    '<summary class="detalhe-ficha-toggle"><span>Ficha técnica</span><small>Ver especificações</small></summary>' +
    '<div class="detalhe-specs">' +
    criarItemFicha("Marca", carro.marca) +
    criarItemFicha("Tipo", carro.tipo) +
    criarItemFicha("Cor", carro.cor) +
    criarItemFicha("Combustível", carro.combustivel) +
    criarItemFicha("Portas", carro.portas) +
    criarItemFicha("Placa final", carro.placaFinal) +
    criarItemFicha("Blindado", carro.blindado ? "Sim" : "Não") +
    criarItemFicha("Status", carro.status) +
    "</div>" +
    "</details>" +
    '<div class="detalhe-bloco detalhe-bloco-acoes">' +
    '<h4 class="detalhe-subtitulo">Atendimento</h4>' +
    '<div class="detalhe-acoes">' +
    '<div class="detalhe-acoes-principais">' +
    botaoContato +
    '<a href="' +
    escaparAtributo(linkFinanciamento) +
    '" class="btn-primary btn-financiar-detalhe">Financiar este veículo</a>' +
    "</div>" +
    '<div class="detalhe-acoes-secundarias">' +
    '<button type="button" class="btn-secondary btn-secondary-dark" id="btn-compartilhar-veiculo">Compartilhar</button>' +
    '<button type="button" class="btn-secondary btn-secondary-dark" id="btn-copiar-veiculo">Copiar link</button>' +
    "</div>" +
    '<a href="carros.html" class="btn-secondary btn-secondary-dark detalhe-voltar">Voltar ao estoque</a>' +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    '<section class="relacionados">' +
    "<h3>Você também pode gostar</h3>" +
    '<div class="home-veiculos-grid">' +
    relacionados
      .map(function (item) {
        const idRelacionado = Number(item.id) || 0;

        return (
          '<article class="carro-card card-clicavel" onclick="window.location.href=\'detalhes.html?id=' +
          idRelacionado +
          '\'">' +
          '<div class="carro-img-box">' +
          '<img src="' +
          escaparAtributo(item.imagem) +
          '" alt="' +
          escaparAtributo(item.nome) +
          '"></div>' +
          '<div class="carro-info"><h3>' +
          escaparHTML(item.nome) +
          "</h3><p>" +
          escaparHTML(textoCarro(item)) +
          "</p><strong>" +
          escaparHTML(item.preco) +
          '</strong><a href="detalhes.html?id=' +
          idRelacionado +
          '" class="btn-primary" onclick="event.stopPropagation()">Detalhes</a></div></article>'
        );
      })
      .join("") +
    "</div>" +
    "</section>";

  document.body.insertAdjacentHTML(
    "beforeend",
    '<div class="galeria-lightbox" id="galeria-lightbox">' +
      '<button type="button" class="lightbox-fechar" id="lightbox-fechar">Fechar</button>' +
      '<img src="' +
      escaparAtributo(galeria[0]) +
      '" id="lightbox-img" alt="Foto ampliada de ' +
      nomeAtributo +
      '">' +
    "</div>"
  );

  document.body.insertAdjacentHTML(
    "beforeend",
    '<div class="detalhe-cta-mobile">' +
      '<div><span>Preço anunciado</span><strong>' +
      escaparHTML(carro.preco) +
      "</strong></div>" +
      (carro.status === "Vendido"
        ? '<span class="btn-indisponivel">Vendido</span>'
        : '<a href="' +
          escaparAtributo(linkWhatsAppContato) +
          '" class="btn-whatsapp" target="_blank">WhatsApp</a>') +
    "</div>"
  );

  let fotoAtual = 0;
  const imagemPrincipal = document.getElementById("imagem-principal");
  const contadorGaleria = document.getElementById("galeria-contador");
  const botaoAnterior = document.getElementById("galeria-prev");
  const botaoProximo = document.getElementById("galeria-next");
  const botaoTelaCheia = document.getElementById("galeria-full");
  const lightbox = document.getElementById("galeria-lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const lightboxFechar = document.getElementById("lightbox-fechar");
  const miniaturas = document.querySelectorAll(".miniatura");
  const btnCompartilhar = document.getElementById("btn-compartilhar-veiculo");
  const btnCopiar = document.getElementById("btn-copiar-veiculo");

  function mostrarFoto(index) {
    fotoAtual = (index + galeria.length) % galeria.length;
    imagemPrincipal.src = galeria[fotoAtual];
    lightboxImg.src = galeria[fotoAtual];
    contadorGaleria.textContent = fotoAtual + 1 + " / " + galeria.length;

    miniaturas.forEach(function (item) {
      item.classList.remove("ativa");
    });

    if (miniaturas[fotoAtual]) {
      miniaturas[fotoAtual].classList.add("ativa");
      miniaturas[fotoAtual].scrollIntoView({
        behavior: "smooth",
        inline: "center",
        block: "nearest",
      });
    }
  }

  function abrirLightbox() {
    lightbox.classList.add("ativo");
    document.body.classList.add("lightbox-aberto");
    lightboxFechar.focus();
  }

  function fecharLightbox() {
    lightbox.classList.remove("ativo");
    document.body.classList.remove("lightbox-aberto");
    imagemPrincipal.focus();
  }

  miniaturas.forEach(function (botao) {
    botao.addEventListener("click", function () {
      mostrarFoto(Number(botao.dataset.index));
    });
  });

  botaoAnterior.addEventListener("click", function () {
    mostrarFoto(fotoAtual - 1);
  });

  botaoProximo.addEventListener("click", function () {
    mostrarFoto(fotoAtual + 1);
  });

  imagemPrincipal.tabIndex = 0;
  imagemPrincipal.addEventListener("click", abrirLightbox);
  imagemPrincipal.addEventListener("keydown", function (evento) {
    if (evento.key === "Enter" || evento.key === " ") {
      evento.preventDefault();
      abrirLightbox();
    }
  });

  botaoTelaCheia.addEventListener("click", abrirLightbox);

  lightboxFechar.addEventListener("click", fecharLightbox);

  lightbox.addEventListener("click", function (e) {
    if (e.target === lightbox) {
      fecharLightbox();
    }
  });

  document.addEventListener("keydown", function (evento) {
    if (evento.key === "ArrowLeft") {
      mostrarFoto(fotoAtual - 1);
    }

    if (evento.key === "ArrowRight") {
      mostrarFoto(fotoAtual + 1);
    }

    if (evento.key === "Escape" && lightbox.classList.contains("ativo")) {
      fecharLightbox();
    }
  });

  if (galeria.length <= 1) {
    botaoAnterior.disabled = true;
    botaoProximo.disabled = true;
  }

  if (btnCompartilhar) {
    btnCompartilhar.addEventListener("click", function () {
      compartilharVeiculo(carro.nome);
    });
  }

  if (btnCopiar) {
    btnCopiar.addEventListener("click", copiarLinkVeiculo);
  }
} else if (container) {
  container.innerHTML =
    '<p class="sem-resultados">Carro não encontrado. <a href="carros.html">Voltar para veículos</a></p>';
}

