<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Detalhes do veículo selecionado na 3M Veículos."
    />
    <title>Detalhes do Veículo - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260729-whatsapp-mobile-baixo" />
    <link rel="stylesheet" href="/css/detalhes-premium.css?v=20260729-detail-grid" />
    <link rel="stylesheet" href="/css/site-menu.css?v=20260729-menu-icon-center" />
  </head>
  <body>
    <header class="topo">
      <div class="container nav">
        <a href="index.html" class="logo" aria-label="3M Veículos">
          <img src="/img/logo-3m-veiculos.jpg" alt="" />
          <span>3M <small>Veículos</small></span>
        </a>
        <button
          type="button"
          class="menu-mobile-toggle"
          aria-expanded="false"
          aria-controls="site-nav"
          data-menu-toggle
        >
          <span></span>
          <span></span>
          <span></span>
          Menu
        </button>

        <nav id="site-nav" class="site-nav" data-site-nav>
          <a href="index.html">Início</a>
          <a href="carros.html">Veículos</a>
          <a href="sobre.html">Sobre</a>
          <a href="financiamento.html">Financiamento</a>
          <a href="depoimentos.html">Depoimentos</a>
          <a href="admin.html">Admin</a>
        </nav>
      </div>
    </header>

    <section class="detalhes">
      <div class="container" id="detalhe-carro"></div>
    </section>

    <footer>
      <p>2026 3M Veículos - Todos os direitos reservados</p>
    </footer>

    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260729-whatsapp-empresa"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260721-sem-favoritos"></script>
    <script data-site-script data-src="/js/detalhes.js?v=20260721-ctas-plus"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>













