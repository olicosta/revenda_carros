<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Depoimentos de clientes que compraram veículos na 3M Veículos."
    />
    <title>Depoimentos - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260805-gallery-lightbox" />
    <link rel="stylesheet" href="/css/site-menu.css?v=20260729-menu-icon-align" />
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

    <section class="depoimentos depoimentos-pagina">
      <div class="container">
        <div class="section-header">
          <span data-home="depoimentosEtiqueta">Clientes satisfeitos</span>
          <h2 data-home="depoimentosTitulo">Quem comprou recomenda</h2>
          <p data-home="depoimentosTexto">
            Experiências reais de quem encontrou o veículo ideal.
          </p>
        </div>

        <div class="depoimentos-carousel">
          <button
            type="button"
            class="carousel-btn carousel-prev"
            id="depoimentos-prev"
            aria-label="Ver depoimentos anteriores"
          >
            &lsaquo;
          </button>

          <div class="depoimentos-grid" id="lista-depoimentos-home"></div>

          <button
            type="button"
            class="carousel-btn carousel-next"
            id="depoimentos-next"
            aria-label="Ver mais depoimentos"
          >
            &rsaquo;
          </button>
        </div>
      </div>
    </section>

    <section class="contato contato-modern">
      <div class="container">
        <h2>Gostou do atendimento?</h2>
        <p>Veja o estoque disponível e fale com a equipe.</p>
        <a href="carros.html" class="btn-primary">Ver veículos</a>
      </div>
    </section>

    @include('site.partials.footer')

    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260805-admin-panel-guard"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/depoimentos.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/parcerias.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260628-depoimentos-foto"></script>
    <script data-site-script data-src="/js/home.js?v=20260805-foto-sem-legenda"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>













