<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="3M Veículos: veículos selecionados, financiamento com parceiros e atendimento rápido pelo WhatsApp."
    />
    <title>3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260627-contato-vendedores" />
    <link rel="stylesheet" href="/css/home-premium.css?v=20260625-card-beneficios-fix" />
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
          <h2 data-home="heroTitulo">
            Seu próximo carro, sem complicação
          </h2>
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
              href="https://wa.me/554730123333"
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

        <div class="hero-showcase" id="destaque-home"></div>
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
          <a href="carros.html" class="btn-primary" data-home="estoqueBotao"
            >Ver estoque completo</a
          >
        </div>

        <div class="home-veiculos-grid" id="home-veiculos-grid"></div>

        <div class="home-vendedor-mes" id="home-vendedor-mes"></div>
        <div class="home-vendedores-contato" id="home-vendedores-contato"></div>
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

        <div class="home-veiculos-acoes">
          <a href="depoimentos.html" class="btn-primary"
            >Ver todos depoimentos</a
          >
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
        <p>
          <span data-loja-endereco>CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094</span> |
          <span data-loja-horario>Segunda a sábado, das 8h às 18h</span>
        </p>

        <a
          href="https://wa.me/554730123333"
          class="btn-primary"
          target="_blank"
          data-whatsapp-link
        >
          <span data-home="contatoBotao">Chamar no WhatsApp</span>
        </a>
      </div>
    </section>

    <footer>
      <p>2026 3M Veículos - Todos os direitos reservados</p>
    </footer>

    <a
      href="https://wa.me/554730123333"
      class="whatsapp-fixo"
      target="_blank"
      aria-label="Chamar 3M Veículos no WhatsApp"
      data-whatsapp-link
    >
      <svg viewBox="0 0 32 32" aria-hidden="true">
        <path
          d="M16 3C8.8 3 3 8.7 3 15.8c0 2.4.7 4.8 2 6.8L3.7 29l6.6-1.7c1.8 1 3.8 1.5 5.8 1.5 7.2 0 13-5.7 13-12.8S23.2 3 16 3Zm0 23.6c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.9 1 1-3.8-.2-.4c-1.1-1.7-1.7-3.7-1.7-5.8C5.8 10.1 10.4 5.4 16 5.4s10.2 4.7 10.2 10.4S21.6 26.6 16 26.6Zm5.6-8.1c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.5-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5-.1-.2-.7-1.7-1-2.3-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1.1 1.1-1.1 2.6s1.1 3 1.3 3.2c.2.2 2.2 3.4 5.4 4.7.8.3 1.4.5 1.8.7.8.2 1.5.2 2.1.1.6-.1 1.8-.7 2.1-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"
        />
      </svg>
    </a>

    <script src="/js/config.js?v=20260625-cep-global"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/depoimentos.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/parcerias.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260627-contato-vendedores"></script>
    <script data-site-script data-src="/js/home.js?v=20260627-contato-vendedores"></script>
    <script src="/js/site-menu.js?v=20260623-mobile-menu-1"></script>
  </body>
</html>













