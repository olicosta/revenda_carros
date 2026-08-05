<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta name="description" content="Política de Privacidade da 3M Veículos." />
    <title>Política de Privacidade - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260805-localizacao-simples" />
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
          <a href="admin.html">Admin</a>
        </nav>
      </div>
    </header>

    <main class="legal-page">
      <section class="container legal-card">
        <span>Privacidade</span>
        <h1>Política de Privacidade</h1>
        <p>
          A 3M Veículos utiliza os dados informados no site apenas para atendimento,
          negociação de veículos, análise de interesse, simulação de financiamento e
          contato comercial solicitado pelo cliente.
        </p>
        <p>
          Informações como nome, WhatsApp, e-mail, veículo de interesse, dados de
          financiamento e documentos enviados são acessadas somente pela equipe
          autorizada da revenda e por parceiros necessários para conduzir a
          solicitação.
        </p>
        <p>
          O cliente pode solicitar correção, atualização ou exclusão de seus dados
          entrando em contato pelos canais oficiais da loja.
        </p>
      </section>
    </main>

    @include('site.partials.footer')
    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260805-admin-panel-guard"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>
