<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="3M Veículos: veículos selecionados, financiamento com parceiros e atendimento rápido pelo WhatsApp."
    />
    <title>3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260810-footer-sobre-cache" />
    <link rel="stylesheet" href="/css/home-premium.css?v=20260729-contato-centralizado" />
    <link rel="stylesheet" href="/css/site-menu.css?v=20260729-menu-icon-align" />
    <link rel="preconnect" href="https://images.unsplash.com" />
    <link
      rel="preload"
      as="image"
      href="https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=900&q=80"
      imagesrcset="https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=900&q=80"
      fetchpriority="high"
    />
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

    <section class="hero hero-modern">
      <div class="container hero-grid">
        <div class="hero-text">
          <span class="badge" data-home="heroBadge">3M Veículos</span>
          <h1 data-home="heroTitulo">
            Seu próximo carro, sem complicação
          </h1>
          <p data-home="heroTexto">
            Encontre veículos selecionados, compare opções com facilidade e fale
            direto pelo WhatsApp para tirar dúvidas, negociar e avançar com
            segurança.
          </p>

          <div class="hero-buttons">
            <a
              href="carros.html"
              class="btn-primary"
              data-home="heroBotaoEstoque"
              >Ver veículos</a
            >
            <a
              href="https://wa.me/554796207774"
              class="btn-secondary"
              target="_blank"
              data-whatsapp-link
            >
              <span data-home="heroBotaoContato">Falar com a equipe</span>
            </a>
          </div>

          <div class="hero-servicos">
            <div>
              <small>01</small>
              <strong data-home="servico1Titulo"
                >Compra, venda, troca e financia</strong
              >
              <span data-home="servico1Texto"
                >Negociação completa para você sair de carro novo</span
              >
            </div>
            <div>
              <small>02</small>
              <strong data-home="servico2Titulo">Financiamento</strong>
              <span data-home="servico2Texto"
                >Atendimento com bancos e financeiras parceiras</span
              >
            </div>
            <div>
              <small>03</small>
              <strong data-home="servico3Titulo">Avaliação</strong>
              <span data-home="servico3Texto"
                >Análise do veículo e proposta personalizada</span
              >
            </div>
          </div>
        </div>

        <div class="hero-showcase hero-showcase-loading" id="destaque-home" aria-live="polite">
          <div class="showcase-topline">
            <span>Ofertas</span>
            <strong>Pronto para negociar</strong>
          </div>
          <div class="showcase-img showcase-img-placeholder"></div>
          <div class="showcase-card">
            <span class="showcase-badge">Ofertas em destaque</span>
            <h3>Carregando ofertas</h3>
            <p>Buscando os veículos disponíveis no estoque.</p>
            <div class="showcase-price">
              <span>Preço anunciado</span>
              <strong>Consulte</strong>
            </div>
            <div class="showcase-actions">
              <a href="carros.html" class="btn-primary">Ver estoque</a>
              <a
                href="https://wa.me/554796207774"
                class="btn-whatsapp destaque-whats"
                target="_blank"
                rel="noopener"
                data-whatsapp-link
              >WhatsApp</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="home-veiculos">
      <div class="container">
        <div class="section-header home-veiculos-topo">
          <div>
            <span data-home="estoqueEtiqueta">Estoque selecionado</span>
            <h2 data-home="estoqueTitulo">Ofertas e recém-chegados</h2>
            <p data-home="estoqueTexto">
              Confira alguns veículos em destaque no estoque da 3M Veículos.
            </p>
          </div>
        </div>

        <div class="home-veiculos-grid" id="home-veiculos-grid"></div>

        <div class="home-veiculos-acoes">
          <a href="carros.html" class="btn-primary" data-home="estoqueBotao"
            >Ver estoque completo</a
          >
        </div>

        <div class="home-vendedor-mes" id="home-vendedor-mes"></div>
      </div>
    </section>

    <section class="destaques">
      <div class="container">
        <h2 data-home="beneficiosTitulo">Por que escolher a 3M Veículos?</h2>

        <div class="cards">
          <div class="card">
            <span class="card-icon" data-home="beneficio1Icone">OK</span>
            <h3 data-home="beneficio1Titulo">Veículos revisados</h3>
            <p data-home="beneficio1Texto">
              Carros selecionados com procedência, histórico e apresentação
              clara.
            </p>
          </div>

          <div class="card">
            <span class="card-icon" data-home="beneficio2Icone">R$</span>
            <h3 data-home="beneficio2Titulo">Financiamento facilitado</h3>
            <p data-home="beneficio2Texto">
              Contato direto com bancos e financeiras parceiras da loja.
            </p>
          </div>

          <div class="card">
            <span class="card-icon" data-home="beneficio3Icone">WA</span>
            <h3 data-home="beneficio3Titulo">Atendimento direto</h3>
            <p data-home="beneficio3Texto">
              Negociação ágil pelo WhatsApp, sem burocracia desnecessária.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="depoimentos" class="depoimentos depoimentos-home-resumo">
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

    <section id="contato" class="contato contato-modern">
      <div class="container">
        <h2 data-home="contatoTitulo">
          Pronto para escolher seu próximo carro?
        </h2>
        <p data-home="contatoTexto">
          Fale agora com a equipe 3M Veículos e receba uma proposta
          personalizada.
        </p>

        <a
          href="https://wa.me/554796207774"
          class="btn-primary"
          target="_blank"
          data-whatsapp-link
        >
          <span data-home="contatoBotao">Chamar no WhatsApp</span>
        </a>
      </div>
    </section>

    <section class="localizacao-home" id="localizacao">
      <div class="container localizacao-grid">
        <div class="localizacao-info">
          <span class="badge">Localização</span>
          <h2>Venha conhecer a 3M Veículos</h2>
          <p>
            Estamos em
            <strong data-loja-endereco>CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094</strong>
          </p>
          <a href="#" class="btn-primary" target="_blank" rel="noopener" data-mapa-link>
            Abrir rota no Google Maps
          </a>
        </div>
      </div>
    </section>

    @include('site.partials.footer')

    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260810-sobre-cache"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/depoimentos.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/parcerias.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260721-sem-favoritos"></script>
    <script data-site-script data-src="/js/home.js?v=20260805-foto-sem-legenda"></script>
    <script src="/js/site-menu.js?v=20260623-mobile-menu-1"></script>
  </body>
</html>













