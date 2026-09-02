<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta name="description" content="Termos de Uso da 3M Veículos." />
    <title>Termos de Uso - 3M Veículos</title>
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

        <button type="button" class="menu-mobile-toggle" aria-expanded="false" aria-controls="site-nav" data-menu-toggle>
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
        </nav>
      </div>
    </header>

    <main class="legal-page">
      <section class="container legal-card">
        <span>Termos</span>
        <h1>Termos de Uso</h1>
        <p>
          As informações dos veículos anunciados podem sofrer alterações de preço,
          disponibilidade, quilometragem, opcionais e condições comerciais sem aviso
          prévio.
        </p>
        <p>
          O envio de interesse pelo site não garante aprovação de financiamento,
          reserva automática do veículo ou fechamento da negociação. Todas as
          condições são confirmadas diretamente pela equipe da 3M Veículos.
        </p>
        <p>
          Ao utilizar o site, o cliente declara estar ciente de que o atendimento
          poderá ocorrer por WhatsApp, telefone ou e-mail, conforme os dados
          informados voluntariamente.
        </p>
      </section>
    </main>

    @include('site.partials.footer')
    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260811-marcas-motos"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>
