<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Conheça a 3M Veículos, endereço, horário e canais de atendimento."
    />
    <title>Sobre - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260810-footer-sobre-cache" />
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

    <section class="sobre-loja">
      <div class="container sobre-grid">
        <div>
          <span class="badge">Nossa loja</span>
          <h2>Atendimento direto, estoque organizado e negociação transparente</h2>
          <p data-loja-sobre>
            Somos uma revenda multimarcas focada em veículos selecionados,
            atendimento direto e negociação transparente do primeiro contato até
            a entrega.
          </p>

          <div class="sobre-acoes">
            <a href="carros.html" class="btn-primary">Ver estoque</a>
            <a
              href="https://wa.me/554796207774"
              class="btn-secondary btn-secondary-dark"
              target="_blank"
              data-whatsapp-link
            >
              Falar com a loja
            </a>
          </div>
        </div>

        <div class="sobre-info">
          <div>
            <strong>Endereço</strong>
            <span data-loja-endereco>Rua Campos Sales, 293 - Centro II, Vila Ferroviária, Mafra - SC, 89300-094</span>
            <a href="#" target="_blank" data-mapa-link>Ver no mapa</a>
          </div>
          <div>
            <strong>Horário</strong>
            <span data-loja-horario>Segunda a Sexta, das 8h30 às 18h. Sábado 08h30 às 12h</span>
          </div>
          <div>
            <strong>Contato</strong>
            <span data-loja-instagram>@3mveiculos</span>
            <a href="#" data-email-link data-loja-email>contato@3mveiculos.com.br</a>
          </div>
        </div>
      </div>
    </section>

    <section class="contato contato-modern">
      <div class="container">
        <h2>Quer visitar ou falar com a equipe?</h2>
        <p>
          <span data-loja-endereco>Rua Campos Sales, 293 - Centro II, Vila Ferroviária, Mafra - SC, 89300-094</span> |
          <span data-loja-horario>Segunda a Sexta, das 8h30 às 18h. Sábado 08h30 às 12h</span>
        </p>
        <a href="https://wa.me/554796207774" class="btn-primary" target="_blank" data-whatsapp-link>
          Chamar no WhatsApp
        </a>
      </div>
    </section>

    @include('site.partials.footer')

    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260811-loader-paralelo"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>














