(function () {
  const toggle = document.querySelector("[data-menu-toggle]");
  const nav = document.querySelector("[data-site-nav]");

  if (!toggle || !nav) {
    return;
  }

  function obterPagina(caminho) {
    const partes = caminho.split("/").filter(Boolean);
    return (partes.pop() || "index").replace(/\.html$/, "");
  }

  function obterSecao(pagina) {
    const secoes = {
      veiculos: "carros",
      detalhes: "carros",
    };

    return secoes[pagina] || pagina;
  }

  const secaoAtual = obterSecao(obterPagina(window.location.pathname));

  nav.querySelectorAll("a[href]").forEach(function (link) {
    const destino = new URL(link.getAttribute("href"), window.location.href);
    const secaoDestino = obterSecao(obterPagina(destino.pathname));
    const ativo = secaoDestino === secaoAtual;

    link.classList.toggle("ativo", ativo);

    if (ativo) {
      link.setAttribute("aria-current", "page");
    } else {
      link.removeAttribute("aria-current");
    }
  });

  function fecharMenu() {
    document.body.classList.remove("menu-mobile-aberto");
    toggle.setAttribute("aria-expanded", "false");
  }

  function abrirMenu() {
    document.body.classList.add("menu-mobile-aberto");
    toggle.setAttribute("aria-expanded", "true");
  }

  toggle.addEventListener("click", function () {
    if (document.body.classList.contains("menu-mobile-aberto")) {
      fecharMenu();
      return;
    }

    abrirMenu();
  });

  nav.addEventListener("click", function (event) {
    if (event.target.closest("a")) {
      fecharMenu();
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      fecharMenu();
    }
  });

  document.addEventListener("click", function (event) {
    if (!document.body.classList.contains("menu-mobile-aberto")) {
      return;
    }

    if (event.target.closest("[data-site-nav], [data-menu-toggle]")) {
      return;
    }

    fecharMenu();
  });
})();
