(function () {
  const toggle = document.querySelector("[data-menu-toggle]");
  const nav = document.querySelector("[data-site-nav]");

  if (!toggle || !nav) {
    return;
  }

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
