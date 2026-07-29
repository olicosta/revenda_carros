<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Catálogo de veículos 3M Veículos com filtros por marca, câmbio, preço e ordenação."
    />
    <title>Veículos - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260729-whatsapp-mobile-baixo" />
    <link rel="stylesheet" href="/css/catalogo-mobile.css?v=20260729-busca-mobile" />
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

    <section class="area-catalogo">
      <div class="container catalogo-intro">
        <span>Estoque 3M Veículos</span>
        <h1>Encontre seu próximo veículo</h1>
        <p>Pesquise, compare e fale diretamente com nossa equipe.</p>
      </div>

      <div class="container catalogo-layout">
        <div class="catalogo-filtro-overlay" data-catalogo-filtro-overlay></div>

        <aside class="filtros-lateral" id="filtros-catalogo" aria-label="Filtros do catálogo">
          <div class="filtros-topo">
            <div>
              <span>Busca rápida</span>
              <h3>Filtrar veículos</h3>
            </div>
            <button
              type="button"
              class="filtros-fechar-mobile"
              data-catalogo-filtro-fechar
              aria-label="Fechar filtros"
            >
              ×
            </button>
          </div>

          <input
            type="text"
            id="filtro-busca"
            placeholder="Buscar por nome, modelo ou cor..."
            class="input-busca"
            aria-label="Buscar veículo por nome, modelo ou cor"
          />

          <div class="filtros-principais">
            <select id="filtro-marca">
              <option value="">Todas as marcas</option>
            </select>

            <label>
              <span>Faixa de preço</span>
              <select id="filtro-faixa-preco">
                <option value="">Todas as faixas</option>
                <option value="0-50000">Até R$ 50 mil</option>
                <option value="50000-80000">R$ 50 mil a R$ 80 mil</option>
                <option value="80000-120000">R$ 80 mil a R$ 120 mil</option>
                <option value="120000-999999999">Acima de R$ 120 mil</option>
              </select>
            </label>
            <label>
              <span>A partir do ano</span>
              <select id="filtro-ano-min">
                <option value="">Todos</option>
              </select>
            </label>

            <select id="ordenar-preco">
              <option value="">Ordenar por destaque</option>
              <option value="destaques">Destaques primeiro</option>
              <option value="disponiveis">Disponíveis primeiro</option>
              <option value="preco-menor">Menor preço</option>
              <option value="preco-maior">Maior preço</option>
              <option value="ano-maior">Mais novos</option>
              <option value="ano-menor">Mais antigos</option>
              <option value="km-menor">Menor km</option>
            </select>
          </div>

          <div class="filtros-atalhos">
            <label class="check-filtro">
              <input type="checkbox" id="filtro-oferta" />
              Ofertas
            </label>

            <label class="check-filtro">
              <input type="checkbox" id="filtro-disponivel" />
              Disponíveis
            </label>
          </div>

          <details class="filtros-avancados">
            <summary>Mais filtros</summary>

            <div class="filtros-grid">
              <select id="filtro-cambio">
                <option value="">Todos os câmbios</option>
              </select>

              <select id="filtro-combustivel">
                <option value="">Todos os combustíveis</option>
              </select>

              <select id="filtro-cor">
                <option value="">Todas as cores</option>
              </select>

              <select id="filtro-tipo">
                <option value="">Todos os tipos</option>
              </select>

              <select id="filtro-status">
                <option value="">Todos os status</option>
              </select>
            </div>

            <div class="range-filtros">
              <label>
                Ano final
                <select id="filtro-ano-max">
                  <option value="">Todos</option>
                </select>
              </label>
              <label>
                Preço mínimo
                <input type="text" id="filtro-preco-min" placeholder="R$ 0" />
              </label>
              <label>
                Preço máximo
                <input type="text" id="filtro-preco-max" placeholder="R$ 0" />
              </label>
              <label>
                Km máximo
                <input type="number" id="filtro-km-max" placeholder="Ex: 50000" />
              </label>
            </div>

            <div class="filtros-atalhos filtros-atalhos-avancados">
              <label class="check-filtro">
                <input type="checkbox" id="filtro-blindado" />
                Blindados
              </label>
            </div>
          </details>

          <div class="filtros-acoes-mobile">
            <button type="button" id="aplicar-filtros-mobile" class="btn-primary">
              Ver veículos
            </button>
            <button id="limpar-filtros" class="btn-limpar">Limpar filtros</button>
          </div>
        </aside>

        <div class="resultado-area">
          <label class="catalogo-busca-mobile" for="filtro-busca-mobile">
            <span>Buscar veículo</span>
            <input
              type="text"
              id="filtro-busca-mobile"
              placeholder="Digite modelo, marca ou cor..."
              autocomplete="off"
              aria-label="Buscar veículo por modelo, marca ou cor"
            />
          </label>

          <div class="catalogo-toolbar">
            <div>
              <span>Estoque disponível</span>
              <p id="contador-resultados">0 veículos encontrados</p>
            </div>
            <button
              type="button"
              class="catalogo-filtro-toggle catalogo-filtro-toggle-inline"
              data-catalogo-filtro-toggle
              aria-expanded="false"
              aria-controls="filtros-catalogo"
            >
              Filtrar
            </button>
          </div>
          <div id="filtros-ativos" class="filtros-ativos" aria-live="polite"></div>
          <div class="grid-carros" id="lista-carros"></div>
        </div>
      </div>
    </section>

    <footer>
      <p>2026 3M Veículos - Todos os direitos reservados</p>
    </footer>

    <script src="/js/config.js?v=20260729-whatsapp-empresa"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260721-sem-favoritos"></script>
    <script data-site-script data-src="/js/catalogo.js?v=20260729-busca-mobile"></script>
    <script src="/js/site-menu.js?v=20260623-menu-publico-1"></script>
  </body>
</html>













