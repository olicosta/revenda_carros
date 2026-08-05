<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Financiamento automotivo com atendimento direto da 3M Veículos pelo WhatsApp."
    />
    <title>Financiamento - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260805-footer-links-text" />
    <link rel="stylesheet" href="/css/financiamento-premium.css?v=20260805-card-align" />
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

    <main>
      <section class="finance-hero finance-hero-simple finance-premium-hero">
        <div class="container finance-hero-grid">
          <div class="finance-hero-copy">
            <span>Financiamento automotivo</span>
            <h1>Financie seu próximo carro com orientação da 3M Veículos</h1>
            <p>
              Envie um interesse rápido, converse com nossa equipe e receba orientação
              para avançar com segurança na simulação com bancos parceiros.
            </p>
            <div class="finance-hero-actions">
              <a href="#interesse-financiamento" class="btn-primary">Simular atendimento</a>
              <a href="carros.html" class="btn-secondary">Ver veículos</a>
            </div>

            <div class="finance-trust-row" aria-label="Vantagens do atendimento">
              <span>Resposta rápida</span>
              <span>Bancos parceiros</span>
              <span>Sem compromisso</span>
            </div>
          </div>

          <aside class="finance-status-card" aria-label="Resumo do financiamento">
            <span class="finance-card-kicker">Atendimento guiado</span>
            <strong>Você não precisa fazer tudo sozinho</strong>
            <p>
              A loja entende seu perfil, confirma o veículo desejado e orienta quais
              dados serão necessários para a pré-análise.
            </p>
            <a href="#interesse-financiamento" class="btn-primary">Começar agora</a>
          </aside>
        </div>
      </section>

      <section class="finance-steps finance-steps-premium">
        <div class="container">
          <div class="section-header">
            <span>Processo simples</span>
            <h2>Como funciona</h2>
            <p>Um caminho curto para sair da dúvida e receber atendimento personalizado.</p>
          </div>

          <div class="finance-step-grid">
            <article>
              <strong>1</strong>
              <h3>Envie seus dados</h3>
              <p>Nome, WhatsApp, veículo de interesse e entrada aproximada.</p>
            </article>
            <article>
              <strong>2</strong>
              <h3>Confirmamos seu perfil</h3>
              <p>A equipe entende sua necessidade, prazo e possibilidade de troca.</p>
            </article>
            <article>
              <strong>3</strong>
              <h3>Orientamos a análise</h3>
              <p>Você recebe o próximo passo para simulação com bancos parceiros.</p>
            </article>
            <article>
              <strong>4</strong>
              <h3>Avance com segurança</h3>
              <p>Com as opções em mãos, você escolhe o melhor caminho.</p>
            </article>
          </div>
        </div>
      </section>

      <section class="finance-page" id="interesse-financiamento">
        <div class="container finance-layout finance-layout-interest">
          <section class="finance-form-card">
            <div class="finance-card-header">
              <span>Interesse inicial</span>
              <h2>Receba atendimento para financiar</h2>
              <p>Preencha o essencial agora. A equipe retorna pelo WhatsApp para conduzir a simulação.</p>
            </div>

            <form id="form-financiamento-interesse" class="finance-form finance-form-interest">
              <label>
                Nome completo
                <input type="text" id="fin-nome" placeholder="Seu nome" required />
              </label>

              <label>
                WhatsApp
                <input type="tel" id="fin-telefone" placeholder="(00) 00000-0000" required />
              </label>

              <label>
                Veículo de interesse
                <select id="fin-veiculo">
                  <option value="">Ainda não escolhi</option>
                </select>
              </label>

              <label>
                Entrada aproximada
                <input type="text" id="fin-entrada" placeholder="Ex: R$ 20.000" />
              </label>

              <label>
                Tem carro para troca?
                <select id="fin-tem-troca">
                  <option value="Não">Não</option>
                  <option value="Sim">Sim</option>
                </select>
              </label>

              <label>
                Qual carro na troca?
                <input type="text" id="fin-carro-troca" placeholder="Ex: Onix 2019 LT" />
              </label>

              <button type="submit" class="btn-whatsapp finance-submit">
                Enviar interesse pelo WhatsApp
              </button>
            </form>
          </section>

          <aside class="finance-side">
            <div class="finance-info-card finance-benefits-card">
              <span class="finance-icon">✓</span>
              <h3>Por que simular com a 3M?</h3>
              <ul>
                <li>Atendimento humano e direto pelo WhatsApp.</li>
                <li>Ajuda para escolher entrada e prazo.</li>
                <li>Possibilidade de avaliar veículo na troca.</li>
                <li>Simulação sem compromisso inicial.</li>
              </ul>
            </div>

            <div class="finance-info-card">
              <span class="finance-icon">R$</span>
              <h3>Bancos parceiros</h3>
              <div class="bancos-grid bancos-grid-compacto" id="lista-parcerias-home"></div>
            </div>
          </aside>
        </div>
      </section>

    </main>

    @include('site.partials.footer')

    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260805-admin-panel-guard"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/parcerias.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260621-banco"></script>
    <script data-site-script data-src="/js/home.js?v=20260625-sem-favoritos"></script>
    <script data-site-script data-src="/js/financiamento.js?v=20260618-performance"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>













