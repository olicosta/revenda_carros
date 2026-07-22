const lojaConfig = {
  nome: "3M Veículos",
  subtitulo: "Revenda de Veículos",
  whatsapp: "3012-3333",
  endereco: "CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094",
  horario: "Segunda a sábado, das 8h às 18h",
  instagram: "@3mveiculos",
  email: "contato@3mveiculos.com.br",
  sobre:
    "Somos uma revenda multimarcas focada em veículos selecionados, atendimento direto e negociação transparente do primeiro contato até a entrega.",
  logo: "img/logo-3m-veiculos.jpg",
  mensagemVeiculo:
    "Olá, tenho interesse neste veículo:\n\nModelo: {nome}\nAno: {ano}\nKm: {km}\nCâmbio: {cambio}\nTipo: {tipo}\nCor: {cor}\nCombustível: {combustivel}\nPreço: {preco}\nStatus: {status}",
};

const alertaNativo = window.alert.bind(window);
const confirmarNativo = window.confirm.bind(window);

function criarModalSistema(opcoes) {
  if (!document.body) {
    return Promise.resolve(false);
  }

  const overlay = document.createElement("div");
  overlay.className = "sistema-modal-overlay";
  overlay.setAttribute("role", "presentation");

  const card = document.createElement("section");
  card.className = "sistema-modal-card";
  card.setAttribute("role", "dialog");
  card.setAttribute("aria-modal", "true");

  const icone = document.createElement("span");
  icone.className = "sistema-modal-icone";
  icone.textContent = opcoes.icone || "!";

  const conteudo = document.createElement("div");
  conteudo.className = "sistema-modal-conteudo";

  const titulo = document.createElement("h3");
  titulo.textContent = opcoes.titulo || "Atenção";

  const mensagem = document.createElement("p");
  mensagem.textContent = opcoes.mensagem || "";

  conteudo.appendChild(titulo);
  conteudo.appendChild(mensagem);

  let input = null;
  if (opcoes.tipo === "prompt") {
    input = document.createElement("input");
    input.className = "sistema-modal-input";
    input.value = opcoes.valor || "";
    input.readOnly = opcoes.somenteLeitura === true;
    conteudo.appendChild(input);
  }

  const acoes = document.createElement("div");
  acoes.className = "sistema-modal-acoes";

  const botaoConfirmar = document.createElement("button");
  botaoConfirmar.type = "button";
  botaoConfirmar.className = "sistema-modal-confirmar";
  botaoConfirmar.textContent = opcoes.confirmarTexto || "OK";

  const botaoCancelar = document.createElement("button");
  botaoCancelar.type = "button";
  botaoCancelar.className = "sistema-modal-cancelar";
  botaoCancelar.textContent = opcoes.cancelarTexto || "Cancelar";

  if (opcoes.tipo !== "alerta") {
    acoes.appendChild(botaoCancelar);
  }
  acoes.appendChild(botaoConfirmar);

  card.appendChild(icone);
  card.appendChild(conteudo);
  card.appendChild(acoes);
  overlay.appendChild(card);
  document.body.appendChild(overlay);
  document.body.classList.add("sistema-modal-aberto");

  return new Promise(function (resolve) {
    let resolvido = false;

    function fechar(valor) {
      if (resolvido) return;
      resolvido = true;
      document.body.classList.remove("sistema-modal-aberto");
      overlay.remove();
      document.removeEventListener("keydown", aoTeclar);
      resolve(valor);
    }

    function aoTeclar(evento) {
      if (evento.key === "Escape") {
        fechar(opcoes.tipo === "alerta");
      }

      if (evento.key === "Enter" && document.activeElement !== botaoCancelar) {
        fechar(input ? input.value : true);
      }
    }

    botaoConfirmar.addEventListener("click", function () {
      fechar(input ? input.value : true);
    });

    botaoCancelar.addEventListener("click", function () {
      fechar(false);
    });

    overlay.addEventListener("click", function (evento) {
      if (evento.target === overlay) {
        fechar(opcoes.tipo === "alerta");
      }
    });

    document.addEventListener("keydown", aoTeclar);

    setTimeout(function () {
      if (input) {
        input.focus();
        input.select();
        return;
      }

      botaoConfirmar.focus();
    }, 0);
  });
}

function avisar(mensagem, titulo) {
  if (!document.body) {
    alertaNativo(mensagem);
    return Promise.resolve(true);
  }

  return criarModalSistema({
    tipo: "alerta",
    titulo: titulo || "Aviso",
    mensagem: mensagem,
    icone: "i",
    confirmarTexto: "Entendi",
  }).catch(function () {
    alertaNativo(mensagem);
  });
}

function confirmar(mensagem, titulo) {
  if (!document.body) {
    return Promise.resolve(confirmarNativo(mensagem));
  }

  return criarModalSistema({
    tipo: "confirmar",
    titulo: titulo || "Confirmar ação",
    mensagem: mensagem,
    icone: "?",
    confirmarTexto: "Confirmar",
    cancelarTexto: "Cancelar",
  });
}

function solicitarTexto(mensagem, valor, titulo) {
  return criarModalSistema({
    tipo: "prompt",
    titulo: titulo || "Copiar informação",
    mensagem: mensagem,
    valor: valor || "",
    somenteLeitura: true,
    icone: "↗",
    confirmarTexto: "OK",
    cancelarTexto: "Fechar",
  });
}

window.avisar = avisar;
window.confirmar = confirmar;
window.solicitarTexto = solicitarTexto;
window.alert = function (mensagem) {
  avisar(String(mensagem || ""));
};

const homeConteudoPadrao = {
  heroBadge: "3M Veículos",
  heroTitulo: "Seu próximo carro, sem complicação",
  heroTexto:
    "Encontre veículos selecionados, compare opções com facilidade e fale direto pelo WhatsApp para tirar dúvidas, negociar e avançar com segurança.",
  heroBotaoEstoque: "Ver veículos",
  heroBotaoContato: "Falar com a equipe",
  servico1Titulo: "Compra, venda, troca e financia",
  servico1Texto: "Negociação completa para você sair de carro novo",
  servico2Titulo: "Financiamento",
  servico2Texto: "Atendimento com bancos e financeiras parceiras",
  servico3Titulo: "Avaliação",
  servico3Texto: "Análise do veículo e proposta personalizada",
  estoqueEtiqueta: "Estoque selecionado",
  estoqueTitulo: "Ofertas e recém-chegados",
  estoqueTexto: "Confira alguns veículos em destaque no estoque da 3M Veículos.",
  estoqueBotao: "Ver estoque completo",
  beneficiosTitulo: "Por que escolher a 3M Veículos?",
  beneficio1Icone: "OK",
  beneficio1Titulo: "Veículos revisados",
  beneficio1Texto: "Carros selecionados com procedência, histórico e apresentação clara.",
  beneficio2Icone: "R$",
  beneficio2Titulo: "Financiamento facilitado",
  beneficio2Texto: "Contato direto com bancos e financeiras parceiras da loja.",
  beneficio3Icone: "WA",
  beneficio3Titulo: "Atendimento direto",
  beneficio3Texto: "Negociação ágil pelo WhatsApp, sem burocracia desnecessária.",
  financiamentoEtiqueta: "Crédito rápido",
  financiamentoTitulo: "Financiamento com bancos parceiros",
  financiamentoTexto: "Simule sua proposta com as principais instituições financeiras.",
  depoimentosEtiqueta: "Clientes satisfeitos",
  depoimentosTitulo: "Quem comprou recomenda",
  depoimentosTexto: "Experiências reais de quem encontrou o veículo ideal.",
  contatoTitulo: "Pronto para escolher seu próximo carro?",
  contatoTexto: "Fale agora com a equipe 3M Veículos e receba uma proposta personalizada.",
  contatoBotao: "Chamar no WhatsApp",
};

const marcasDisponiveis = [
  "Agrale",
  "Alfa Romeo",
  "Audi",
  "Avatr",
  "BMW",
  "BYD",
  "Caoa Chery",
  "Changan",
  "Chery",
  "Chevrolet",
  "Chrysler",
  "Citroen",
  "Denza",
  "Dodge",
  "Ferrari",
  "Fiat",
  "Ford",
  "Foton",
  "Geely",
  "GWM",
  "Haval",
  "Honda",
  "Hyundai",
  "Iveco",
  "JAC",
  "Jaguar",
  "Jeep",
  "Jetour",
  "Kia",
  "Land Rover",
  "Leapmotor",
  "Lexus",
  "Maserati",
  "Mercedes-Benz",
  "MG Motor",
  "Mini",
  "Mitsubishi",
  "Nissan",
  "Omoda Jaecoo",
  "Peugeot",
  "Porsche",
  "RAM",
  "Renault",
  "Subaru",
  "Suzuki",
  "Toyota",
  "Troller",
  "Volkswagen",
  "Volvo",
  "Zeekr",
];

const marcaAnterior = ["Nor", "berto Multimarcas"].join("");
const logoAnterior = ["img/logo-", "nor", "berto.svg"].join("");
const marcasAntigas = [marcaAnterior, "Prime Motors", "AutoPrime Veiculos", "AutoPrime"];
const logosAntigas = [logoAnterior];
window.siteDataCache = window.siteDataCache || {};

function buscarJsonSite(caminho) {
  return fetch(caminho, {
    headers: { Accept: "application/json" },
    credentials: "same-origin",
  }).then(function (resposta) {
    if (!resposta.ok) throw new Error("Falha ao carregar " + caminho);
    return resposta.json();
  });
}

function carregarDadosSite() {
  if (window.location.protocol === "file:") {
    return Promise.resolve(window.siteDataCache);
  }

  const autenticado = Boolean(document.querySelector('meta[name="csrf-token"]'));
  const requisicoes = [
    buscarJsonSite("/api/site/bootstrap"),
    autenticado ? buscarJsonSite("/api/analytics") : Promise.resolve(null),
  ];

  return Promise.allSettled(requisicoes).then(function (resultados) {
    const valor = function (indice) {
      return resultados[indice].status === "fulfilled"
        ? resultados[indice].value
        : null;
    };
    const bootstrap = valor(0);
    const analytics = valor(1);
    const settings = bootstrap && bootstrap.data
      ? { data: bootstrap.data.settings }
      : null;
    const vehicles = bootstrap && bootstrap.data
      ? { data: bootstrap.data.vehicles }
      : null;
    const testimonials = bootstrap && bootstrap.data
      ? { data: bootstrap.data.testimonials }
      : null;
    const partners = bootstrap && bootstrap.data
      ? { data: bootstrap.data.partners }
      : null;
    const sellers = bootstrap && bootstrap.data
      ? { data: bootstrap.data.sellers }
      : null;

    if (settings && settings.data) {
      window.siteDataCache.settings = settings.data;
      if (settings.data.store) {
        localStorage.setItem("lojaConfig", JSON.stringify({ ...lojaConfig, ...settings.data.store }));
      }
      if (settings.data.home) {
        localStorage.setItem("homeConteudo", JSON.stringify({ ...homeConteudoPadrao, ...settings.data.home }));
      }
    }
    if (vehicles && Array.isArray(vehicles.data) && vehicles.data.length > 0) {
      window.siteDataCache.vehicles = vehicles.data;
      localStorage.setItem("carros", JSON.stringify(vehicles.data));
    }
    if (
      testimonials &&
      Array.isArray(testimonials.data) &&
      testimonials.data.length > 0
    ) {
      window.siteDataCache.testimonials = testimonials.data;
      localStorage.setItem("depoimentos", JSON.stringify(testimonials.data));
    }
    if (partners && Array.isArray(partners.data) && partners.data.length > 0) {
      window.siteDataCache.partners = partners.data;
      localStorage.setItem("parcerias", JSON.stringify(partners.data));
    }
    if (sellers && Array.isArray(sellers.data)) {
      window.siteDataCache.sellers = sellers.data;
      localStorage.setItem("vendedoresPublicos", JSON.stringify(sellers.data));
    }
    if (analytics && analytics.data) {
      window.siteDataCache.analytics = analytics.data;
      localStorage.setItem("analyticsSitePrime", JSON.stringify(analytics.data));
    }

    return window.siteDataCache;
  });
}

window.siteDataReady = carregarDadosSite();

function substituirMarcasAntigas(valor) {
  if (typeof valor !== "string") return valor;

  return marcasAntigas.reduce(function (texto, marca) {
    return texto.split(marca).join(lojaConfig.nome);
  }, valor);
}

function criarLinkWhatsApp(mensagem) {
  const config = carregarConfigLoja();

  return criarLinkWhatsAppNumero(config.whatsapp, mensagem);
}

function normalizarNumeroWhatsApp(numero) {
  let digitos = String(numero || "").replace(/\D/g, "");

  if (digitos.length === 8 || digitos.length === 9) {
    digitos = "47" + digitos;
  }

  if (digitos.length === 10 || digitos.length === 11) {
    digitos = "55" + digitos;
  }

  return digitos;
}

function criarLinkWhatsAppNumero(numero, mensagem) {
  const digitos = normalizarNumeroWhatsApp(numero);
  const texto = mensagem ? "?text=" + encodeURIComponent(mensagem) : "";

  return "https://wa.me/" + digitos + texto;
}

function escaparHTML(valor) {
  return String(valor || "")
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;");
}

function escaparAtributo(valor) {
  return escaparHTML(valor).replace(/`/g, "&#96;");
}

function atualizarMeta(seletor, atributo, valor) {
  if (!valor) return;

  let meta = document.head.querySelector(seletor);

  if (!meta) {
    meta = document.createElement("meta");

    if (seletor.includes("property=")) {
      meta.setAttribute("property", seletor.match(/"([^"]+)"/)[1]);
    } else {
      meta.setAttribute("name", seletor.match(/"([^"]+)"/)[1]);
    }

    document.head.appendChild(meta);
  }

  meta.setAttribute(atributo, valor);
}

function aplicarSeoBasico() {
  const config = carregarConfigLoja();
  const descricao =
    document.querySelector('meta[name="description"]')?.content ||
    config.sobre;
  const urlAtual = window.location.href.split("#")[0];
  const imagemAbsoluta = new URL(config.logo, window.location.href).href;

  if (!document.querySelector('link[rel="icon"]')) {
    const favicon = document.createElement("link");
    favicon.rel = "icon";
    favicon.href = config.logo;
    document.head.appendChild(favicon);
  }

  if (!document.querySelector('link[rel="canonical"]')) {
    const canonical = document.createElement("link");
    canonical.rel = "canonical";
    canonical.href = urlAtual;
    document.head.appendChild(canonical);
  }

  atualizarMeta('meta[property="og:title"]', "content", document.title);
  atualizarMeta('meta[property="og:description"]', "content", descricao);
  atualizarMeta('meta[property="og:type"]', "content", "website");
  atualizarMeta('meta[property="og:url"]', "content", urlAtual);
  atualizarMeta('meta[property="og:image"]', "content", imagemAbsoluta);
  atualizarMeta('meta[name="twitter:card"]', "content", "summary_large_image");
  atualizarMeta('meta[name="twitter:title"]', "content", document.title);
  atualizarMeta('meta[name="twitter:description"]', "content", descricao);
  atualizarMeta('meta[name="twitter:image"]', "content", imagemAbsoluta);
}

function atualizarSeoPagina(titulo, descricao, imagem) {
  const imagemAbsoluta = imagem ? new URL(imagem, window.location.href).href : "";

  if (titulo) {
    document.title = titulo;
    atualizarMeta('meta[property="og:title"]', "content", titulo);
    atualizarMeta('meta[name="twitter:title"]', "content", titulo);
  }

  if (descricao) {
    atualizarMeta('meta[name="description"]', "content", descricao);
    atualizarMeta('meta[property="og:description"]', "content", descricao);
    atualizarMeta('meta[name="twitter:description"]', "content", descricao);
  }

  if (imagemAbsoluta) {
    atualizarMeta('meta[property="og:image"]', "content", imagemAbsoluta);
    atualizarMeta('meta[name="twitter:image"]', "content", imagemAbsoluta);
  }
}

function carregarAnalyticsSite() {
  if (
    window.siteDataCache.analytics &&
    Array.isArray(window.siteDataCache.analytics.visitas)
  ) {
    return window.siteDataCache.analytics;
  }

  try {
    const dados = JSON.parse(localStorage.getItem("analyticsSitePrime"));

    if (dados && Array.isArray(dados.visitas)) {
      return dados;
    }
  } catch (error) {
    localStorage.removeItem("analyticsSitePrime");
  }

  return {
    visitas: [],
  };
}

function salvarAnalyticsSite(dados) {
  dados.visitas = dados.visitas.slice(-1500);
  window.siteDataCache.analytics = dados;
  localStorage.setItem("analyticsSitePrime", JSON.stringify(dados));

  if (
    window.location.protocol !== "file:" &&
    document.querySelector('meta[name="csrf-token"]')
  ) {
    requisicaoAnalyticsApiAssincrona("PUT", "/api/analytics/sync", {
      visitas: dados.visitas,
    });
  }
}

function limparAnalyticsSite() {
  localStorage.removeItem("analyticsSitePrime");

  if (window.location.protocol !== "file:") {
    requisicaoAnalyticsApiAssincrona("DELETE", "/api/analytics");
  }
}

function nomePaginaAnalytics() {
  const caminho = window.location.pathname.split("/").pop() || "index.html";
  const nomes = {
    "index.html": "Início",
    "carros.html": "Veículos",
    "detalhes.html": "Detalhes do veículo",
    "sobre.html": "Sobre",
    "financiamento.html": "Financiamento",
    "depoimentos.html": "Depoimentos",
  };

  return nomes[caminho] || document.title || caminho;
}

function registrarAnalyticsSite() {
  if (window.analyticsSiteRegistrado) return;

  const caminho = window.location.pathname.split("/").pop() || "index.html";
  const paginaSemExtensao = caminho.replace(/\.html$/i, "");

  if (paginaSemExtensao === "admin" || paginaSemExtensao === "login") {
    return;
  }

  window.analyticsSiteRegistrado = true;

  const dados = carregarAnalyticsSite();
  const params = new URLSearchParams(window.location.search);
  const visitaId = Date.now() + "-" + Math.random().toString(16).slice(2);
  const sessao =
    sessionStorage.getItem("analyticsSessaoPrime") ||
    Date.now() + "-" + Math.random().toString(16).slice(2);
  const inicio = Date.now();

  sessionStorage.setItem("analyticsSessaoPrime", sessao);

  const visita = {
    id: visitaId,
    sessao: sessao,
    pagina: caminho,
    titulo: nomePaginaAnalytics(),
    url: window.location.pathname + window.location.search,
    veiculoId: caminho === "detalhes.html" ? Number(params.get("id")) || null : null,
    inicio: inicio,
    duracao: 0,
  };

  dados.visitas.push(visita);

  dados.visitas = dados.visitas.slice(-1500);
  window.siteDataCache.analytics = dados;
  localStorage.setItem("analyticsSitePrime", JSON.stringify(dados));
  requisicaoAnalyticsApiAssincrona("POST", "/api/analytics/visits", visita);

  let duracaoEnviada = -1;

  function atualizarDuracao() {
    const analytics = carregarAnalyticsSite();
    const visita = analytics.visitas.find(function (item) {
      return item.id === visitaId;
    });

    if (!visita) return;

    visita.duracao = Math.max(visita.duracao || 0, Math.round((Date.now() - inicio) / 1000));
    if (visita.duracao === duracaoEnviada) return;

    duracaoEnviada = visita.duracao;
    analytics.visitas = analytics.visitas.slice(-1500);
    window.siteDataCache.analytics = analytics;
    localStorage.setItem("analyticsSitePrime", JSON.stringify(analytics));
    requisicaoAnalyticsApiAssincrona(
      "PUT",
      "/api/analytics/visits/" + encodeURIComponent(visitaId),
      { duracao: visita.duracao }
    );
  }

  window.addEventListener("pagehide", atualizarDuracao);
  document.addEventListener("visibilitychange", function () {
    if (document.visibilityState === "hidden") {
      atualizarDuracao();
    }
  });
}

function requisicaoAnalyticsApiAssincrona(metodo, caminho, dados) {
  if (window.location.protocol === "file:") return Promise.resolve(null);

  const headers = { Accept: "application/json" };
  const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

  if (dados !== undefined) headers["Content-Type"] = "application/json";
  if (tokenCsrf) headers["X-CSRF-TOKEN"] = tokenCsrf.content;

  return fetch(caminho, {
    method: metodo,
    headers: headers,
    body: dados === undefined ? undefined : JSON.stringify(dados),
    credentials: "same-origin",
    keepalive: true,
  }).catch(function () {
    return null;
  });
}

function aplicarMelhoriasGlobais() {
  const paginaAtual =
    window.location.pathname.split("/").pop() || "index.html";
  const paginaAdmin = document.body.classList.contains("admin-page");

  document.querySelectorAll(".nav").forEach(function (navContainer) {
    const menu = navContainer.querySelector("nav");

    if (
      paginaAdmin ||
      !menu ||
      navContainer.querySelector(".menu-toggle") ||
      navContainer.querySelector("[data-menu-toggle]")
    ) return;

    const botaoMenu = document.createElement("button");
    botaoMenu.type = "button";
    botaoMenu.className = "menu-toggle";
    botaoMenu.setAttribute("aria-label", "Abrir menu");
    botaoMenu.setAttribute("aria-expanded", "false");
    botaoMenu.innerHTML =
      '<span aria-hidden="true"></span>' +
      '<span aria-hidden="true"></span>' +
      '<span aria-hidden="true"></span>';

    navContainer.insertBefore(botaoMenu, menu);

    botaoMenu.addEventListener("click", function () {
      const aberto = navContainer.classList.toggle("menu-aberto");
      botaoMenu.setAttribute("aria-expanded", String(aberto));
      botaoMenu.setAttribute("aria-label", aberto ? "Fechar menu" : "Abrir menu");
    });

    menu.querySelectorAll("a, button").forEach(function (item) {
      item.addEventListener("click", function () {
        navContainer.classList.remove("menu-aberto");
        botaoMenu.setAttribute("aria-expanded", "false");
        botaoMenu.setAttribute("aria-label", "Abrir menu");
      });
    });

    document.addEventListener("keydown", function (evento) {
      if (evento.key === "Escape") {
        navContainer.classList.remove("menu-aberto");
        botaoMenu.setAttribute("aria-expanded", "false");
        botaoMenu.setAttribute("aria-label", "Abrir menu");
      }
    });
  });

  document.querySelectorAll(".nav nav a").forEach(function (link) {
    const href = link.getAttribute("href");

    if (href === paginaAtual) {
      link.classList.add("ativo");
      link.setAttribute("aria-current", "page");
    }
  });

  document.querySelectorAll('a[target="_blank"]').forEach(function (link) {
    const relAtual = link.getAttribute("rel") || "";
    const relPartes = relAtual.split(" ").filter(Boolean);

    ["noopener", "noreferrer"].forEach(function (valor) {
      if (relPartes.indexOf(valor) === -1) {
        relPartes.push(valor);
      }
    });

    link.setAttribute("rel", relPartes.join(" "));
  });

  document.addEventListener(
    "error",
    function (evento) {
      const elemento = evento.target;

      if (elemento.tagName !== "IMG" || elemento.dataset.fallbackAplicado) {
        return;
      }

      elemento.dataset.fallbackAplicado = "true";
      elemento.src =
        "data:image/svg+xml;charset=UTF-8," +
        encodeURIComponent(
          '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 700 450"><rect width="700" height="450" fill="#e2e8f0"/><text x="350" y="225" text-anchor="middle" dominant-baseline="middle" fill="#475569" font-family="Arial" font-size="28" font-weight="700">Imagem indisponível</text></svg>'
        );
    },
    true
  );
}

function carregarConfigLoja() {
  const configuracoesApi = window.siteDataCache.settings;

  if (configuracoesApi && configuracoesApi.store) {
    const configApi = {
      ...lojaConfig,
      ...configuracoesApi.store,
    };

    localStorage.setItem("lojaConfig", JSON.stringify(configApi));
    return configApi;
  }

  try {
    const salva = JSON.parse(localStorage.getItem("lojaConfig"));

    if (salva) {
      if (
        typeof salva.mensagemVeiculo === "string" &&
        (salva.mensagemVeiculo.includes("{descricao}") ||
          salva.mensagemVeiculo.includes("Descricao:"))
      ) {
        salva.mensagemVeiculo = lojaConfig.mensagemVeiculo;
        localStorage.setItem("lojaConfig", JSON.stringify(salva));
      }

      return {
        ...lojaConfig,
        ...salva,
      };
    }
  } catch (error) {
    localStorage.removeItem("lojaConfig");
  }

  return lojaConfig;
}

function salvarConfigLoja(config) {
  const atualizada = {
    ...carregarConfigLoja(),
    ...config,
  };

  localStorage.setItem("lojaConfig", JSON.stringify(atualizada));
  salvarConfiguracoesApi({ store: atualizada });
}

function restaurarConfigLoja() {
  localStorage.removeItem("lojaConfig");
  salvarConfiguracoesApi({ store: lojaConfig });
}

function carregarConteudoHome() {
  const configuracoesApi = window.siteDataCache.settings;

  if (configuracoesApi && configuracoesApi.home) {
    const conteudoApi = {
      ...homeConteudoPadrao,
      ...configuracoesApi.home,
    };

    localStorage.setItem("homeConteudo", JSON.stringify(conteudoApi));
    return conteudoApi;
  }

  try {
    const salvo = JSON.parse(localStorage.getItem("homeConteudo"));

    if (salvo) {
      Object.keys(salvo).forEach(function (chave) {
        salvo[chave] = substituirMarcasAntigas(salvo[chave]);
      });

      [
        "heroBadge",
        "estoqueTexto",
        "beneficiosTitulo",
        "contatoTexto",
      ].forEach(function (chave) {
        salvo[chave] = homeConteudoPadrao[chave];
      });

      if (
        salvo.heroTitulo ===
        "Seu próximo veículo com uma experiência mais simples"
      ) {
        salvo.heroTitulo = homeConteudoPadrao.heroTitulo;
      }

      if (
        salvo.heroTexto ===
        "Estoque organizado, atendimento direto e uma vitrine digital pronta para transformar interessados em contatos pelo WhatsApp."
      ) {
        salvo.heroTexto = homeConteudoPadrao.heroTexto;
      }

      return {
        ...homeConteudoPadrao,
        ...salvo,
      };
    }
  } catch (error) {
    localStorage.removeItem("homeConteudo");
  }

  return homeConteudoPadrao;
}

function salvarConteudoHome(conteudo) {
  const atualizado = {
    ...carregarConteudoHome(),
    ...conteudo,
  };

  localStorage.setItem("homeConteudo", JSON.stringify(atualizado));
  salvarConfiguracoesApi({ home: atualizado });
}

function restaurarConteudoHome() {
  localStorage.removeItem("homeConteudo");
  salvarConfiguracoesApi({ home: homeConteudoPadrao });
}

function salvarConfiguracoesApi(configuracoes) {
  if (window.location.protocol === "file:") return null;

  return requisicaoAnalyticsApiAssincrona(
    "PUT",
    "/api/site/settings",
    configuracoes
  );
}

function aplicarConteudoHome() {
  const conteudo = carregarConteudoHome();

  document.querySelectorAll("[data-home]").forEach(function (elemento) {
    const chave = elemento.dataset.home;

    if (conteudo[chave] !== undefined) {
      elemento.textContent = conteudo[chave];
    }
  });
}

function aplicarConfigLoja() {
  const config = carregarConfigLoja();
  const primeiroNome = config.nome.split(" ")[0] || config.nome;
  const restanteNome = config.nome.split(" ").slice(1).join(" ") || config.subtitulo;

  document.title = document.title.replace(
    new RegExp(marcasAntigas.join("|"), "g"),
    config.nome
  );

  document.querySelectorAll(".logo").forEach(function (logo) {
    logo.setAttribute("aria-label", config.nome);
    logo.innerHTML =
      '<img src="' +
      escaparAtributo(config.logo) +
      '" alt="Logo ' +
      escaparAtributo(config.nome) +
      '">' +
      "<span>" +
      escaparHTML(primeiroNome) +
      " <small>" +
      escaparHTML(restanteNome) +
      "</small></span>";
  });

  document.querySelectorAll("[data-loja-nome]").forEach(function (elemento) {
    elemento.textContent = config.nome;
  });

  document.querySelectorAll("[data-loja-subtitulo]").forEach(function (elemento) {
    elemento.textContent = config.subtitulo;
  });

  document.querySelectorAll("[data-loja-endereco]").forEach(function (elemento) {
    elemento.textContent = config.endereco;
  });

  document.querySelectorAll("[data-loja-horario]").forEach(function (elemento) {
    elemento.textContent = config.horario;
  });

  document.querySelectorAll("[data-loja-instagram]").forEach(function (elemento) {
    elemento.textContent = config.instagram;
  });

  document.querySelectorAll("[data-loja-email]").forEach(function (elemento) {
    elemento.textContent = config.email;
  });

  document.querySelectorAll("[data-loja-sobre]").forEach(function (elemento) {
    elemento.textContent = config.sobre;
  });

  document.querySelectorAll("[data-email-link]").forEach(function (link) {
    link.href = "mailto:" + config.email;
  });

  document.querySelectorAll("[data-mapa-link]").forEach(function (link) {
    link.href =
      "https://www.google.com/maps/search/?api=1&query=" +
      encodeURIComponent(config.endereco);
  });

  document.querySelectorAll("[data-mapa-iframe]").forEach(function (iframe) {
    const mapaUrl =
      "https://www.google.com/maps?q=" +
      encodeURIComponent(config.endereco) +
      "&output=embed";

    iframe.dataset.src = mapaUrl;

    if (iframe.dataset.carregado === "true") {
      iframe.src = mapaUrl;
    }
  });

  prepararMapasSobDemanda();

  document.querySelectorAll("[data-whatsapp-link]").forEach(function (link) {
    link.href = criarLinkWhatsApp(link.dataset.whatsappMensagem || "");
  });
}

function carregarMapaIframe(iframe) {
  if (!iframe || iframe.dataset.carregado === "true") return;

  const mapaUrl = iframe.dataset.src;
  if (!mapaUrl) return;

  iframe.src = mapaUrl;
  iframe.dataset.carregado = "true";

  const container = iframe.closest("[data-mapa-container]");
  if (container) {
    container.classList.add("mapa-carregado");
  }
}

function prepararMapasSobDemanda() {
  const iframesMapa = Array.from(document.querySelectorAll("[data-mapa-iframe]"));

  if (!iframesMapa.length) return;

  document.querySelectorAll("[data-carregar-mapa]").forEach(function (botao) {
    botao.addEventListener(
      "click",
      function () {
        const container = botao.closest("[data-mapa-container]");
        carregarMapaIframe(container && container.querySelector("[data-mapa-iframe]"));
      },
      { once: true }
    );
  });

  if (!("IntersectionObserver" in window)) return;

  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;

        carregarMapaIframe(entry.target);
        observer.unobserve(entry.target);
      });
    },
    {
      rootMargin: "420px 0px",
      threshold: 0.01,
    }
  );

  iframesMapa.forEach(function (iframe) {
    observer.observe(iframe);
  });
}

function formatarCep(valor) {
  const numeros = String(valor || "").replace(/\D/g, "").slice(0, 8);

  if (numeros.length > 5) {
    return numeros.slice(0, 5) + "-" + numeros.slice(5);
  }

  return numeros;
}

const camposMoedaIds = [
  "preco",
  "preco-compra",
  "custo-preparacao",
  "comissao",
  "taxas",
  "valor-venda",
  "saida-valor",
  "vendedor-comissao-padrao",
  "modal-venda-valor",
  "modal-venda-comissao",
  "modal-venda-valor-recebido",
  "modal-venda-troca-valor",
  "modal-venda-saldo",
  "fin-entrada",
  "full-conjuge-renda",
  "full-renda",
  "full-valor-veiculo",
  "full-entrada",
  "full-parcela",
  "filtro-preco-min",
  "filtro-preco-max",
];

function formatarMoedaCampo(valor) {
  const numero = Number(String(valor || "").replace(/\D/g, ""));

  if (!numero) return "";

  return numero.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
    maximumFractionDigits: 0,
  });
}

function formatarCampoMoedaValor(valor) {
  return formatarMoedaCampo(valor);
}

function inicializarCamposMoeda() {
  camposMoedaIds.forEach(function (id) {
    const campo = document.getElementById(id);

    if (!campo) return;

    campo.placeholder = "R$ 0";
    campo.inputMode = "numeric";
    campo.dataset.campoMoeda = "true";

    if (campo.value) {
      campo.value = formatarMoedaCampo(campo.value);
    }

    campo.addEventListener("focus", function () {
      if (!campo.value) {
        campo.value = "R$ ";
      }
    });

    campo.addEventListener("input", function () {
      const formatado = formatarMoedaCampo(campo.value);
      campo.value = formatado || "R$ ";
    });

    campo.addEventListener("blur", function () {
      if (!campo.value.replace(/\D/g, "")) {
        campo.value = "";
      }
    });
  });
}

function preencherCampoPorId(id, valor) {
  if (!id || !valor) return;

  const campo = document.getElementById(id);
  if (!campo) return;

  campo.value = campo.dataset.campoMoeda ? formatarMoedaCampo(valor) : valor;
  campo.dispatchEvent(new Event("input", { bubbles: true }));
  campo.dispatchEvent(new Event("change", { bubbles: true }));
}

function aplicarEnderecoPorCep(campoCep, endereco) {
  preencherCampoPorId(campoCep.dataset.cepEndereco, endereco.logradouro);
  preencherCampoPorId(campoCep.dataset.cepBairro, endereco.bairro);
  preencherCampoPorId(campoCep.dataset.cepCidade, endereco.localidade);
  preencherCampoPorId(
    campoCep.dataset.cepUf || campoCep.dataset.cepEstado,
    endereco.uf
  );
}

function inicializarBuscaCep() {
  const camposCep = document.querySelectorAll("[data-cep]");

  camposCep.forEach(function (campoCep) {
    let ultimoCepBuscado = "";

    function buscarEnderecoCep() {
      campoCep.value = formatarCep(campoCep.value);

      const cep = campoCep.value.replace(/\D/g, "");
      if (cep.length !== 8 || cep === ultimoCepBuscado) return;

      ultimoCepBuscado = cep;
      campoCep.classList.add("campo-carregando");

      fetch("https://viacep.com.br/ws/" + cep + "/json/")
        .then(function (resposta) {
          if (!resposta.ok) {
            throw new Error("CEP não encontrado");
          }

          return resposta.json();
        })
        .then(function (dados) {
          if (dados.erro) {
            throw new Error("CEP não encontrado");
          }

          aplicarEnderecoPorCep(campoCep, dados);
        })
        .catch(function () {
          ultimoCepBuscado = "";
        })
        .finally(function () {
          campoCep.classList.remove("campo-carregando");
        });
    }

    campoCep.addEventListener("input", buscarEnderecoCep);
    campoCep.addEventListener("blur", buscarEnderecoCep);
    campoCep.addEventListener("change", buscarEnderecoCep);
  });
}

function carregarScriptsDaPagina() {
  const scripts = Array.from(
    document.querySelectorAll("script[data-site-script]")
  );

  return scripts.reduce(function (fila, scriptOriginal) {
    return fila.then(function () {
      return new Promise(function (resolve, reject) {
        const script = document.createElement("script");
        script.src = scriptOriginal.dataset.src;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
      });
    });
  }, Promise.resolve());
}

function inicializarSite() {
  if (window.siteInicializado) return Promise.resolve();

  window.siteInicializado = true;
  aplicarConfigLoja();
  aplicarConteudoHome();
  aplicarSeoBasico();
  aplicarMelhoriasGlobais();
  inicializarBuscaCep();
  inicializarCamposMoeda();

  return carregarScriptsDaPagina().then(registrarAnalyticsSite);
}

document.addEventListener("DOMContentLoaded", function () {
  window.siteDataReady
    .catch(function () {
      return window.siteDataCache;
    })
    .then(inicializarSite)
    .catch(function (erro) {
      window.siteInicializado = false;
      console.error("Não foi possível inicializar completamente a página.", erro);
    });
});

