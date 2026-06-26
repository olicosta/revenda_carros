<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="admin-role" content="{{ auth()->user()->role ?? 'gestor' }}" />
    <title>Painel Admin - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260626-resumo-clicavel" />
  </head>
  <body>
    <header class="topo">
      <div class="container nav">
        <a href="index.html" class="logo" aria-label="3M Veículos">
          <img src="/img/logo-3m-veiculos.jpg" alt="" />
          <span>3M <small>Admin</small></span>
        </a>

        <nav class="admin-top-actions">
          <div class="notificacoes-admin">
            <button type="button" class="notificacoes-botao" id="abrir-notificacoes" aria-label="Abrir notificações" aria-expanded="false" aria-controls="painel-notificacoes">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" />
                <path d="M10 21h4" />
              </svg>
              <span id="notificacoes-contador" class="notificacoes-contador" hidden>0</span>
            </button>
            <section class="notificacoes-painel" id="painel-notificacoes" hidden>
              <header>
                <div><span class="admin-eyebrow">Agenda</span><h3>Pendências</h3></div>
                <span id="notificacoes-resumo">Tudo em dia</span>
              </header>
              <div id="lista-notificacoes" class="notificacoes-lista"></div>
              <button type="button" class="notificacoes-ver-clientes" id="notificacoes-ver-clientes">Ver todos os clientes</button>
            </section>
          </div>
          <form method="post" action="{{ route('logout') }}" class="admin-logout-form">
            @csrf
            <button type="submit" class="btn-logout">Sair</button>
          </form>
        </nav>
      </div>
    </header>

    <section class="admin">
      <div class="container">
        <div class="admin-tabs" aria-label="Navegação do painel">
          <button type="button" class="admin-tab" data-admin-tab="veiculos" aria-label="Veículos" title="Veículos">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M5 16h14l-1.8-5.2A3 3 0 0 0 14.4 9H9.6a3 3 0 0 0-2.8 1.8z" /><path d="M6 16v2M18 16v2" /><path d="M7.5 18.5h.1M16.4 18.5h.1" /></svg>
            </span>
            <span class="admin-tab-label">Veículos</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="financeiro" aria-label="Financeiro" title="Financeiro">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 3v18" /><path d="M16 7.5c0-1.4-1.8-2.5-4-2.5s-4 1.1-4 2.5 1.8 2.5 4 2.5 4 1.1 4 2.5-1.8 2.5-4 2.5-4-1.1-4-2.5" /></svg>
            </span>
            <span class="admin-tab-label">Financeiro</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="clientes" aria-label="Clientes" title="Clientes">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3" /><path d="M5 19a7 7 0 0 1 14 0" /><path d="M16 4l2 2 3-3" /></svg>
            </span>
            <span class="admin-tab-label">Clientes</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="vendedores" aria-label="Vendedores" title="Vendedores">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3" /><path d="M3 19a6 6 0 0 1 12 0" /><circle cx="17" cy="10" r="2" /><path d="M16 15a5 5 0 0 1 5 4" /></svg>
            </span>
            <span class="admin-tab-label">Vendedores</span>
          </button>
          <button type="button" class="admin-tab ativa" data-admin-tab="resumo" aria-label="Resumo" title="Resumo">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z" /></svg>
            </span>
            <span class="admin-tab-label">Resumo</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="loja" aria-label="Loja" title="Loja">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 11h16l-2-5H6z" /><path d="M6 11v7h12v-7" /><path d="M9 18v-4h6v4" /></svg>
            </span>
            <span class="admin-tab-label">Loja</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="instagram" aria-label="Instagram" title="Instagram">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M8 7h8a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-6a3 3 0 0 1 3-3z" /><path d="M9 6l1-2h4l1 2" /><circle cx="12" cy="13" r="3" /></svg>
            </span>
            <span class="admin-tab-label">Instagram</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="depoimentos" aria-label="Depoimentos" title="Depoimentos">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M7 5h10a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H9l-5 3V8a3 3 0 0 1 3-3z" /><path d="M8 10h8M8 14h5" /></svg>
            </span>
            <span class="admin-tab-label">Depoimentos</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="parcerias" aria-label="Parcerias" title="Parcerias">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M7 12l3 3 7-7" /><path d="M5 5h14v14H5z" /></svg>
            </span>
            <span class="admin-tab-label">Parcerias</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="relatorios" aria-label="Relatórios" title="Relatórios">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M6 20V10M12 20V4M18 20v-7" /><path d="M4 20h16" /></svg>
            </span>
            <span class="admin-tab-label">Relatórios</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="visitas" aria-label="Visitas" title="Visitas">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 17l5-5 4 4 7-9" /><path d="M20 7v6h-6" /></svg>
            </span>
            <span class="admin-tab-label">Visitas</span>
          </button>
          <button type="button" class="admin-tab" data-admin-tab="sistema" aria-label="Sistema" title="Sistema">
            <span class="admin-tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" /><path d="M4 12h2M18 12h2M12 4v2M12 18v2M6.3 6.3l1.4 1.4M16.3 16.3l1.4 1.4M17.7 6.3l-1.4 1.4M7.7 16.3l-1.4 1.4" /></svg>
            </span>
            <span class="admin-tab-label">Sistema</span>
          </button>
        </div>

        <div class="admin-tab-panel ativo" data-admin-panel="resumo">
          <h2>Resumo do painel</h2>

          <div class="dashboard-grid dashboard-resumo-grid">
            <article class="dashboard-card resumo-card resumo-card-total resumo-card-clicavel ativo" data-resumo-card="estoque" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M5 16h14l-1.8-5.2A3 3 0 0 0 14.4 9H9.6a3 3 0 0 0-2.8 1.8z" /><path d="M6 16v2M18 16v2" /></svg>
                </span>
                <small>Estoque</small>
              </div>
              <strong id="dash-total-veiculos">0</strong>
              <span>Total de veículos</span>
              <p>Cadastrados no painel</p>
            </article>
            <article class="dashboard-card dashboard-ok resumo-card resumo-card-disponiveis resumo-card-clicavel" data-resumo-card="disponiveis" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M7 12l3 3 7-7" /><path d="M5 5h14v14H5z" /></svg>
                </span>
                <small>Prontos</small>
              </div>
              <strong id="dash-disponiveis">0</strong>
              <span>Disponíveis</span>
              <p>Prontos para negociação</p>
            </article>
            <article class="dashboard-card dashboard-alerta resumo-card resumo-card-reservados resumo-card-clicavel" data-resumo-card="reservados" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M8 4h8v4H8z" /><path d="M6 8h12v12H6z" /><path d="M9 13h6" /></svg>
                </span>
                <small>Atenção</small>
              </div>
              <strong id="dash-reservados">0</strong>
              <span>Reservados</span>
              <p>Em tratativa com cliente</p>
            </article>
            <article class="dashboard-card dashboard-vendido resumo-card resumo-card-vendidos resumo-card-clicavel" data-resumo-card="vendidos" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M12 3v18" /><path d="M16 7.5c0-1.4-1.8-2.5-4-2.5s-4 1.1-4 2.5 1.8 2.5 4 2.5 4 1.1 4 2.5-1.8 2.5-4 2.5-4-1.1-4-2.5" /></svg>
                </span>
                <small>Vendas</small>
              </div>
              <strong id="dash-vendidos">0</strong>
              <span>Vendidos</span>
              <p>Fechados no estoque</p>
            </article>
            <article class="dashboard-card resumo-card resumo-card-ofertas resumo-card-clicavel" data-resumo-card="ofertas" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M4 17l5-5 4 4 7-9" /><path d="M20 7v6h-6" /></svg>
                </span>
                <small>Campanhas</small>
              </div>
              <strong id="dash-ofertas">0</strong>
              <span>Ofertas ativas</span>
              <p>Destaques comerciais</p>
            </article>
            <article class="dashboard-card resumo-card resumo-card-depoimentos resumo-card-clicavel" data-resumo-card="depoimentos" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M7 5h10a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H9l-5 3V8a3 3 0 0 1 3-3z" /><path d="M8 10h8M8 14h5" /></svg>
                </span>
                <small>Prova social</small>
              </div>
              <strong id="dash-depoimentos">0</strong>
              <span>Depoimentos</span>
              <p>Clientes publicados</p>
            </article>
            <article class="dashboard-card resumo-card resumo-card-parcerias resumo-card-clicavel" data-resumo-card="parcerias" role="button" tabindex="0" aria-controls="resumo-detalhes-lista">
              <div class="resumo-card-topo">
                <span class="resumo-card-icone" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M5 12h4l2 7 4-14 2 7h2" /></svg>
                </span>
                <small>Crédito</small>
              </div>
              <strong id="dash-parcerias">0</strong>
              <span>Parcerias visíveis</span>
              <p>Bancos exibidos no site</p>
            </article>
          </div>

          <section class="resumo-detalhes-card" aria-live="polite">
            <div class="resumo-detalhes-topo">
              <div>
                <span class="admin-eyebrow" id="resumo-detalhes-etiqueta">Estoque</span>
                <h3 id="resumo-detalhes-titulo">Veículos cadastrados</h3>
                <p id="resumo-detalhes-texto">Clique nos cards acima para conferir os dados filtrados.</p>
              </div>
              <button type="button" class="btn-cancelar btn-visivel" id="resumo-detalhes-acao">
                Abrir módulo
              </button>
            </div>
            <div class="resumo-detalhes-lista" id="resumo-detalhes-lista"></div>
          </section>

          <div class="dashboard-acoes">
            <button type="button" class="btn-primary" data-admin-atalho="veiculos">
              Cadastrar veículo
            </button>
            <button type="button" class="btn-cancelar btn-visivel" data-admin-atalho="loja">
              Editar loja
            </button>
            <button type="button" class="btn-cancelar btn-visivel" data-admin-atalho="depoimentos">
              Novo depoimento
            </button>
            <button type="button" class="btn-cancelar btn-visivel" data-admin-atalho="parcerias">
              Nova parceria
            </button>
            <button type="button" class="btn-cancelar btn-visivel" data-admin-atalho="financeiro">
              Ver financeiro
            </button>
            <button type="button" class="btn-cancelar btn-visivel" data-admin-atalho="sistema">
              Backup e senha
            </button>
          </div>

          <div class="executivo-grid">
            <section class="financeiro-relatorio">
              <div class="financeiro-relatorio-topo">
                <div>
                  <span class="admin-eyebrow">Hoje</span>
                  <h3>Atenção rápida</h3>
                </div>
              </div>
              <div id="dash-alertas-executivos" class="analytics-lista"></div>
            </section>

            <section class="financeiro-relatorio">
              <div class="financeiro-relatorio-topo">
                <div>
                  <span class="admin-eyebrow">Clientes</span>
                  <h3>Próximos contatos</h3>
                </div>
              </div>
              <div id="dash-proximos-contatos" class="analytics-lista"></div>
            </section>

            <section class="financeiro-relatorio">
              <div class="financeiro-relatorio-topo">
                <div>
                  <span class="admin-eyebrow">Estoque</span>
                  <h3>Carros parados</h3>
                </div>
              </div>
              <div id="dash-estoque-parado" class="analytics-lista"></div>
            </section>
          </div>
        </div>

        <div class="admin-tab-panel" data-admin-panel="loja">
          <h2>Identidade da loja</h2>

        <form id="form-loja" class="admin-form">
          <div class="form-grid">
            <input type="text" id="loja-nome" placeholder="Nome da loja" required />
            <input type="text" id="loja-subtitulo" placeholder="Subtítulo" />
            <input type="text" id="loja-whatsapp" placeholder="WhatsApp com DDD" />
            <input type="text" id="loja-endereco" placeholder="Endereço da loja" />
            <input type="text" id="loja-horario" placeholder="Horário de atendimento" />
            <input type="text" id="loja-instagram" placeholder="Instagram" />
            <input type="email" id="loja-email" placeholder="E-mail" />
          </div>

          <textarea
            id="loja-sobre"
            rows="4"
            placeholder="Texto sobre a loja"
          ></textarea>

          <label class="upload-box">
            Selecionar logo da loja
            <input type="file" id="loja-logo-file" accept="image/*" />
          </label>

          <img
            id="loja-logo-preview"
            class="preview-img preview-logo-loja"
            alt="Pré-visualização da logo da loja"
          />

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary">Salvar identidade</button>
            <button type="button" class="btn-cancelar btn-visivel" id="reset-loja">
              Restaurar identidade padrão
            </button>
          </div>
        </form>

        <h2>Mensagem do WhatsApp dos veículos</h2>

        <form id="form-mensagem-whatsapp" class="admin-form">
          <textarea
            id="loja-mensagem-veiculo"
            rows="8"
            placeholder="Mensagem enviada no WhatsApp ao cliente clicar em um veículo"
          ></textarea>

          <p class="admin-ajuda">
            Variáveis disponíveis: {nome}, {marca}, {modelo}, {ano}, {km},
            {cambio}, {tipo}, {cor}, {combustivel}, {preco}, {status},
            {portas}, {placaFinal}, {blindado}
          </p>

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary">Salvar mensagem</button>
          </div>
        </form>

        </div>

        <div class="admin-tab-panel" data-admin-panel="veiculos">

        <h2 id="admin-form-titulo">Cadastrar veículo</h2>

        <form id="form-carro" class="admin-form">
          <input type="hidden" id="carro-id" />

          <div class="form-grid">
            <select id="marca" required>
              <option value="">Marca</option>
            </select>
            <input type="text" id="modelo" placeholder="Modelo" required />
            <input type="number" id="ano" placeholder="Ano" required />
            <input type="text" id="km" placeholder="Km" required />
            <select id="cambio" required>
              <option value="">Câmbio</option>
              <option value="Automático">Automático</option>
              <option value="Manual">Manual</option>
            </select>
            <select id="tipo" required>
              <option value="">Tipo</option>
              <option value="Hatch">Hatch</option>
              <option value="Sedan">Sedan</option>
              <option value="SUV">SUV</option>
              <option value="Pickup">Pickup</option>
              <option value="Utilitario">Utilitário</option>
              <option value="Esportivo">Esportivo</option>
              <option value="Outros">Outros</option>
            </select>
            <select id="status" required>
              <option value="Disponível">Disponível</option>
              <option value="Reservado">Reservado</option>
              <option value="Vendido">Vendido</option>
            </select>
            <input type="text" id="preco" placeholder="Preço" required />
            <input type="date" id="data-entrada" title="Data de entrada no estoque" />
            <select id="preparacao-status">
              <option value="Aguardando revisão">Aguardando revisão</option>
              <option value="Em preparação">Em preparação</option>
              <option value="Pronto para fotos">Pronto para fotos</option>
              <option value="Anunciado">Anunciado</option>
              <option value="Pronto para venda">Pronto para venda</option>
            </select>
            <select id="checklist-anuncio">
              <option value="Pendente">Checklist do anúncio pendente</option>
              <option value="Completo">Checklist do anúncio completo</option>
            </select>
            <input type="text" id="combustivel" placeholder="Combustível" />
            <input type="text" id="cor" placeholder="Cor" />
            <input type="number" id="portas" placeholder="Portas" />
            <input type="text" id="placa-final" placeholder="Final da placa" />
            <input type="text" id="preco-compra" placeholder="Preço de compra" />
            <input type="text" id="custo-preparacao" placeholder="Custo de preparação" />
            <input type="text" id="comissao-percentual" placeholder="Taxa comissão vendedor (%)" />
            <input type="text" id="comissao" placeholder="Comissão vendedor R$" />
            <input type="text" id="taxas" placeholder="Taxas" />
            <input type="text" id="valor-venda" placeholder="Preço de venda" />
            <input type="date" id="data-venda" title="Data da venda" />
            <select id="vendedor-venda">
              <option value="">Vendedor da venda</option>
            </select>
            <input
              type="text"
              id="opcionais"
              placeholder="Opcionais separados por vírgula"
            />
          </div>

          <div class="lucro-form-card">
            <span>Lucro obtido</span>
            <strong id="lucro-formulario">R$ 0</strong>
            <small>Preço de venda - compra - preparação - comissão do vendedor - taxas</small>
          </div>

          <textarea
            id="descricao"
            placeholder="Descrição do veículo"
            rows="4"
          ></textarea>

          <textarea
            id="galeria-urls"
            placeholder="Fotos extras do veículo por URL, uma por linha. Ex: frente, traseira, interior, painel"
            rows="3"
          ></textarea>

          <label class="upload-box">
            Selecionar imagem do veículo
            <input type="file" id="imagem-file" accept="image/*" />
          </label>

          <img
            id="preview-img"
            class="preview-img"
            alt="Pré-visualização da imagem"
          />

          <label class="upload-box">
            Selecionar fotos extras da galeria
            <input type="file" id="galeria-files" accept="image/*" multiple />
          </label>

          <div id="galeria-preview-admin" class="galeria-preview-admin"></div>

          <h3>Pré-visualização do card</h3>
          <div id="preview-card-carro" class="preview-card-carro"></div>

          <label class="check-oferta">
            <input type="checkbox" id="oferta" />
            Marcar como oferta
          </label>

          <label class="check-oferta">
            <input type="checkbox" id="destaque" />
            Destacar na home
          </label>

          <label class="check-oferta">
            <input type="checkbox" id="blindado" />
            Veículo blindado
          </label>

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary" id="btn-salvar">
              Cadastrar veículo
            </button>
            <button type="button" class="btn-cancelar" id="btn-cancelar">
              Cancelar edição
            </button>
          </div>
        </form>

        <h3>Veículos cadastrados</h3>
        <div class="admin-filtros">
          <input
            type="text"
            id="busca-admin-carros"
            placeholder="Buscar por nome, marca, modelo, status, tipo, cor ou ano"
            class="input-busca"
          />
          <select id="status-admin-carros">
            <option value="">Todos os status</option>
            <option value="Disponível">Disponível</option>
            <option value="Reservado">Reservado</option>
            <option value="Vendido">Vendido</option>
          </select>
        </div>
        <div id="lista-admin" class="admin-lista"></div>
        <div id="paginacao-veiculos" class="paginacao-admin" aria-label="Paginação dos veículos"></div>

        </div>

        <div class="admin-tab-panel" data-admin-panel="instagram">
          <h2>Posts e anúncios para Instagram</h2>

          <div class="instagram-admin-grid">
            <form class="admin-form instagram-form" id="form-instagram">
              <div class="form-grid">
                <select id="instagram-carro">
                  <option value="">Selecione um veículo</option>
                </select>
                <select id="instagram-formato">
                  <option value="feed">Feed quadrado</option>
                  <option value="story">Story vertical</option>
                </select>
                <select id="instagram-tom">
                  <option value="direto">Chamada direta</option>
                  <option value="premium">Mais premium</option>
                  <option value="urgente">Oferta/urgência</option>
                </select>
                <select id="instagram-cor">
                  <option value="amarelo">Campanha amarela</option>
                  <option value="verde">Campanha verde</option>
                  <option value="vermelho">Campanha vermelha</option>
                  <option value="azul">Campanha azul</option>
                </select>
                <input type="text" id="instagram-titulo" placeholder="Título da arte" />
                <input type="text" id="instagram-cta" placeholder="Chamada do botão" />
              </div>

              <label>
                Legenda pronta
                <textarea id="instagram-legenda" rows="10"></textarea>
              </label>

              <div class="admin-form-acoes">
                <button type="button" class="btn-cancelar btn-visivel" id="instagram-atualizar">
                  Atualizar arte
                </button>
                <button type="button" class="btn-primary" id="instagram-copiar">
                  Copiar legenda
                </button>
                <button type="button" class="btn-cancelar btn-visivel" id="instagram-baixar">
                  Baixar arte
                </button>
                <a href="https://wa.me/5547999999999" class="btn-cancelar btn-visivel" id="instagram-whatsapp" target="_blank" data-whatsapp-link>
                  Enviar para equipe
                </a>
              </div>

              <p id="instagram-retorno" class="admin-retorno"></p>
            </form>

            <div class="instagram-preview-card">
              <canvas id="instagram-canvas" width="1080" height="1080"></canvas>
            </div>
          </div>
        </div>

        <div class="admin-tab-panel" data-admin-panel="depoimentos">

        <h2 id="depoimento-form-titulo">Cadastrar depoimento</h2>

        <form id="form-depoimento" class="admin-form">
          <input type="hidden" id="depoimento-id" />

          <div class="form-grid">
            <input
              type="text"
              id="depoimento-cliente"
              placeholder="Nome do cliente"
              required
            />
            <input
              type="text"
              id="depoimento-veiculo"
              placeholder="Veículo comprado"
              required
            />
          </div>

          <textarea
            id="depoimento-texto"
            placeholder="Texto do depoimento"
            rows="4"
            required
          ></textarea>

          <label class="upload-box">
            Selecionar foto da entrega
            <input type="file" id="depoimento-file" accept="image/*" />
          </label>

          <img
            id="depoimento-preview"
            class="preview-img preview-entrega"
            alt="Pré-visualização da foto da entrega"
          />

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary" id="btn-depoimento-salvar">
              Cadastrar depoimento
            </button>
            <button
              type="button"
              class="btn-cancelar"
              id="btn-depoimento-cancelar"
            >
              Cancelar edição
            </button>
          </div>
        </form>

        <h3>Depoimentos cadastrados</h3>
        <div id="lista-depoimentos-admin" class="admin-lista"></div>

        </div>

        <div class="admin-tab-panel" data-admin-panel="parcerias">

        <h2 id="parceria-form-titulo">Cadastrar parceria</h2>

        <form id="form-parceria" class="admin-form">
          <input type="hidden" id="parceria-id" />

          <div class="form-grid">
            <input
              type="text"
              id="parceria-nome"
              placeholder="Nome do banco ou financeira"
              required
            />
          </div>

          <label class="check-oferta">
            <input type="checkbox" id="parceria-ativo" checked />
            Exibir na home
          </label>

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary" id="btn-parceria-salvar">
              Cadastrar parceria
            </button>
            <button
              type="button"
              class="btn-cancelar"
              id="btn-parceria-cancelar"
            >
              Cancelar edição
            </button>
          </div>
        </form>

        <h3>Parcerias cadastradas</h3>
        <div id="lista-parcerias-admin" class="admin-lista"></div>

        </div>

        <div class="admin-tab-panel" data-admin-panel="financeiro">
          <div class="financeiro-cabecalho financeiro-hero">
            <div>
              <span class="admin-eyebrow">Gestão financeira</span>
              <h2>Painel financeiro</h2>
              <p>
                Controle caixa, recebíveis, saídas e resultado da operação em uma visão única.
              </p>
            </div>

            <div class="financeiro-cabecalho-acoes">
              <a href="financiamento-dados.html" class="btn-primary" target="_blank">
                Formulário bancário
              </a>
              <button type="button" class="btn-cancelar btn-visivel" id="copiar-link-financiamento">
                Copiar link
              </button>
            </div>
          </div>
          <p class="admin-retorno" id="retorno-link-financiamento" aria-live="polite"></p>

          <div class="admin-form financeiro-controles financeiro-toolbar">
            <div class="financeiro-filtro">
              <label>
                Período de venda
                <input type="month" id="financeiro-mes" />
              </label>
            </div>
            <div class="admin-form-acoes">
              <button type="button" class="btn-primary" id="exportar-financeiro">
                Exportar CSV
              </button>
              <button type="button" class="btn-cancelar btn-visivel" id="limpar-financeiro">
                Limpar filtro
              </button>
            </div>
          </div>

          <div class="financeiro-menu" aria-label="Menu financeiro">
            <button type="button" class="financeiro-menu-btn ativo" data-finance-view-target="resumo">Resumo</button>
            <button type="button" class="financeiro-menu-btn" data-finance-view-target="saidas">Saídas</button>
            <button type="button" class="financeiro-menu-btn" data-finance-view-target="entradas">Entradas</button>
          </div>

          <div class="financeiro-view ativo" data-finance-view="resumo">
            <div class="financeiro-kpis financeiro-kpis-principais">
              <article class="dashboard-card dashboard-ok financeiro-kpi-card financeiro-kpi-principal financeiro-cor-resultado">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">↗</span>
                  <span>Resultado líquido</span>
                </div>
                <strong id="fin-resultado-liquido">R$ 0</strong>
                <small id="fin-resultado-info">Lucro bruto - saídas</small>
              </article>
              <article class="dashboard-card financeiro-kpi-card financeiro-cor-entrada">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">R$</span>
                  <span>Receita vendida</span>
                </div>
                <strong id="fin-total-vendido">R$ 0</strong>
                <small id="fin-vendas">0 venda(s) no período</small>
              </article>
              <article class="dashboard-card dashboard-alerta financeiro-kpi-card financeiro-cor-lucro">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">%</span>
                  <span>Lucro bruto</span>
                </div>
                <strong id="fin-lucro">R$ 0</strong>
                <small id="fin-margem">Margem de 0%</small>
              </article>
              <article class="dashboard-card dashboard-vendido financeiro-kpi-card financeiro-cor-saida">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">−</span>
                  <span>Saídas</span>
                </div>
                <strong id="fin-saidas">R$ 0</strong>
                <small id="fin-saidas-qtd">0 gasto(s) no período</small>
              </article>
            </div>

            <section class="financeiro-grafico-card">
              <div class="financeiro-grafico-info">
                <span class="admin-eyebrow">Composição do período</span>
                <h3>Distribuição financeira</h3>
                <p id="fin-grafico-resumo">Receitas, custos, saídas e valores pendentes no período.</p>
              </div>
              <div class="financeiro-grafico-conteudo">
                <div
                  class="financeiro-pizza"
                  id="fin-grafico-pizza"
                  role="img"
                  aria-label="Gráfico de pizza da composição financeira"
                >
                  <span id="fin-grafico-centro">R$ 0</span>
                </div>
                <div class="financeiro-grafico-legenda" id="fin-grafico-legenda"></div>
              </div>
            </section>

            <div class="financeiro-kpis financeiro-kpis-secundarios">
              <article class="dashboard-card financeiro-kpi-card financeiro-cor-estoque">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">◆</span>
                  <span>Estoque anunciado</span>
                </div>
                <strong id="fin-total-estoque">R$ 0</strong>
                <small id="fin-estoque-unidades">0 veículo(s) disponíveis</small>
              </article>
              <article class="dashboard-card financeiro-kpi-card financeiro-cor-ticket">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">∅</span>
                  <span>Ticket médio</span>
                </div>
                <strong id="fin-ticket">R$ 0</strong>
                <small id="fin-custos">Custos: R$ 0</small>
              </article>
              <article class="dashboard-card financeiro-kpi-card financeiro-cor-caixa">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">+</span>
                  <span>Entrada em caixa</span>
                </div>
                <strong id="fin-caixa-recebido">R$ 0</strong>
                <small>Dinheiro, Pix, banco ou financiamento</small>
              </article>
              <article class="dashboard-card dashboard-alerta financeiro-kpi-card financeiro-cor-troca">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">⇄</span>
                  <span>Valor em trocas</span>
                </div>
                <strong id="fin-total-trocas">R$ 0</strong>
                <small id="fin-trocas-qtd">0 troca(s) no período</small>
              </article>
              <article class="dashboard-card financeiro-kpi-card financeiro-cor-receber">
                <div class="financeiro-kpi-topo">
                  <span class="financeiro-kpi-icone">!</span>
                  <span>Saldo a receber</span>
                </div>
                <strong id="fin-saldo-receber">R$ 0</strong>
                <small>Valores ainda não recebidos</small>
              </article>
            </div>

            <div class="financeiro-resumo-grid">
              <section class="financeiro-relatorio financeiro-caixa-card">
                <div class="financeiro-relatorio-topo">
                  <div>
                    <span class="admin-eyebrow">Caixa</span>
                    <h3>Relatório de caixa</h3>
                  </div>
                  <p id="fin-caixa-resumo">Entradas, trocas, saídas e líquido do período.</p>
                </div>

                <div id="lista-caixa-financeiro" class="financeiro-breakdown financeiro-breakdown-caixa"></div>
              </section>

              <section class="financeiro-relatorio financeiro-alertas">
                <div class="financeiro-relatorio-topo">
                  <div>
                    <span class="admin-eyebrow">Conferência</span>
                    <h3>Alertas financeiros</h3>
                  </div>
                  <p>Diferenças que merecem atenção antes de fechar o caixa.</p>
                </div>

                <div id="lista-alertas-financeiros" class="analytics-lista"></div>
              </section>
            </div>
          </div>

          <div class="financeiro-view" data-finance-view="saidas">
            <div class="financeiro-operacao-grid">
              <form id="form-saida-financeira" class="admin-form financeiro-saida-form">
                <span class="admin-eyebrow">Saídas</span>
                <h3>Lançar gasto</h3>

                <div class="form-grid">
                  <label>
                    Data
                    <input type="date" id="saida-data" required />
                  </label>
                  <label>
                    Categoria
                    <select id="saida-categoria" required>
                      <option value="">Selecione</option>
                      <option value="Preparação">Preparação</option>
                      <option value="Mecânica">Mecânica</option>
                      <option value="Documentação">Documentação</option>
                      <option value="Marketing">Marketing</option>
                      <option value="Comissão">Comissão</option>
                      <option value="Operacional">Operacional</option>
                      <option value="Outros">Outros</option>
                    </select>
                  </label>
                  <label>
                    Valor
                    <input type="text" id="saida-valor" placeholder="R$ 0" required />
                  </label>
                  <label>
                    Descrição
                    <input type="text" id="saida-descricao" placeholder="Ex: anúncio Meta Ads" required />
                  </label>
                  <label>
                    Forma de pagamento
                    <select id="saida-pagamento">
                      <option value="Pix">Pix</option>
                      <option value="Dinheiro">Dinheiro</option>
                      <option value="Cartão">Cartão</option>
                      <option value="Boleto">Boleto</option>
                      <option value="Transferência">Transferência</option>
                    </select>
                  </label>
                  <label>
                    Vincular ao veículo
                    <select id="saida-veiculo">
                      <option value="">Gasto geral da loja</option>
                    </select>
                  </label>
                  <label>
                    Responsável
                    <input type="text" id="saida-responsavel" placeholder="Nome de quem lançou" />
                  </label>
                </div>

                <textarea
                  id="saida-observacao"
                  rows="3"
                  placeholder="Observações internas"
                ></textarea>

                <div class="admin-form-acoes">
                  <button type="submit" class="btn-primary">Lançar saída</button>
                </div>
              </form>

              <section class="financeiro-relatorio financeiro-saidas-card">
                <div class="financeiro-relatorio-topo">
                  <div>
                    <span class="admin-eyebrow">Controle</span>
                    <h3>Gastos lançados</h3>
                  </div>
                  <p id="fin-resumo-saidas">Mostrando todas as saídas.</p>
                </div>

                <div id="lista-saidas-financeiras" class="admin-lista financeiro-lista"></div>
              </section>
            </div>
          </div>

          <div class="financeiro-view" data-finance-view="entradas">
            <div class="financeiro-operacao-grid">
              <section class="financeiro-relatorio">
                <div class="financeiro-relatorio-topo">
                  <div>
                    <span class="admin-eyebrow">Recebíveis</span>
                    <h3>Contas a receber</h3>
                  </div>
                  <p id="fin-receber-resumo">Vendas com saldo pendente.</p>
                </div>

                <div id="lista-contas-receber" class="admin-lista financeiro-lista"></div>
              </section>

              <section class="financeiro-relatorio financeiro-vendas-card">
                <div class="financeiro-relatorio-topo">
                  <div>
                    <span class="admin-eyebrow">Entradas</span>
                    <h3>Vendas registradas</h3>
                  </div>
                  <p id="fin-resumo-periodo">Mostrando todas as vendas registradas.</p>
                </div>

                <div id="lista-financeiro" class="admin-lista financeiro-lista"></div>
              </section>
            </div>
          </div>
        </div>

        <div class="admin-tab-panel" data-admin-panel="vendedores">
          <div class="financeiro-cabecalho">
            <div>
              <span class="admin-eyebrow">Equipe comercial</span>
              <h2>Vendedores e comissões</h2>
              <p>
                Cadastre vendedores e acompanhe vendas, comissão total e desempenho
                individual.
              </p>
            </div>
          </div>

          <div class="financeiro-kpis">
            <article class="dashboard-card financeiro-kpi-card">
              <span>Vendedores ativos</span>
              <strong id="vend-total-ativos">0</strong>
              <small>Equipe disponível para vendas</small>
            </article>
            <article class="dashboard-card dashboard-ok financeiro-kpi-card">
              <span>Comissões no período</span>
              <strong id="vend-total-comissoes">R$ 0</strong>
              <small id="vend-total-vendas">0 venda(s) vinculadas</small>
            </article>
            <article class="dashboard-card dashboard-alerta financeiro-kpi-card">
              <span>Maior comissão</span>
              <strong id="vend-maior-comissao">R$ 0</strong>
              <small id="vend-destaque">Nenhum vendedor no período</small>
            </article>
          </div>

          <div class="financeiro-saidas-grid">
            <form id="form-vendedor" class="admin-form financeiro-saida-form">
              <input type="hidden" id="vendedor-id" />
              <span class="admin-eyebrow">Cadastro</span>
              <h3 id="vendedor-form-titulo">Cadastrar vendedor</h3>

              <div class="form-grid">
                <label>
                  Nome
                  <input type="text" id="vendedor-nome" placeholder="Nome do vendedor" required />
                </label>
                <label>
                  WhatsApp
                  <input type="text" id="vendedor-whatsapp" placeholder="(00) 00000-0000" />
                </label>
                <label>
                  Comissão padrão
                  <input type="text" id="vendedor-comissao-padrao" placeholder="Ex: R$ 500" />
                </label>
                <label>
                  Regra padrão
                  <select id="vendedor-comissao-tipo">
                    <option value="fixa">Valor fixo</option>
                    <option value="percentualVenda">Percentual da venda</option>
                    <option value="percentualLucro">Percentual do lucro</option>
                  </select>
                </label>
                <label>
                  Percentual padrão
                  <input type="text" id="vendedor-comissao-percentual" placeholder="Ex: 1,5%" />
                </label>
              </div>

              <label class="check-oferta">
                <input type="checkbox" id="vendedor-ativo" checked />
                Vendedor ativo
              </label>

              <div class="admin-form-acoes">
                <button type="submit" class="btn-primary" id="btn-vendedor-salvar">
                  Salvar vendedor
                </button>
                <button type="button" class="btn-cancelar" id="btn-vendedor-cancelar">
                  Cancelar edição
                </button>
              </div>
            </form>

            <section class="financeiro-relatorio comissoes-relatorio">
              <div class="financeiro-relatorio-topo">
                <div>
                  <span class="admin-eyebrow">Comissões</span>
                  <h3>Resumo por vendedor</h3>
                </div>
                <div class="comissoes-resumo-acoes">
                  <p id="vend-resumo-periodo">Usa o mesmo filtro de mês do financeiro.</p>
                  <button type="button" class="btn-primary" id="abrir-historico-comissoes">
                    Histórico de comissões
                  </button>
                </div>
              </div>

              <div id="lista-comissoes-vendedores" class="comissoes-resumo-compacto"></div>
            </section>
          </div>

          <section class="financeiro-relatorio">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Equipe</span>
                <h3>Vendedores cadastrados</h3>
              </div>
            </div>

            <div id="lista-vendedores-admin" class="admin-lista"></div>
          </section>
        </div>

        <div class="admin-tab-panel" data-admin-panel="clientes">
          <div class="financeiro-cabecalho">
            <div>
              <span class="admin-eyebrow">Funil comercial</span>
              <h2>Clientes e oportunidades</h2>
              <p>
                Registre interessados, acompanhe o estágio de atendimento e evite perder negociações.
              </p>
            </div>
            <div class="financeiro-cabecalho-acoes">
              <button type="button" class="btn-primary" id="clientes-topo-novo-cliente">
                + Cadastrar novo cliente
              </button>
            </div>
          </div>

          <div class="financeiro-kpis">
            <article class="dashboard-card financeiro-kpi-card">
              <span>Leads ativos</span>
              <strong id="lead-total-ativos">0</strong>
              <small>Novos, atendimento e proposta</small>
            </article>
            <article class="dashboard-card dashboard-ok financeiro-kpi-card">
              <span>Propostas</span>
              <strong id="lead-total-propostas">0</strong>
              <small>Clientes em negociação</small>
            </article>
            <article class="dashboard-card dashboard-alerta financeiro-kpi-card">
              <span>Fechados</span>
              <strong id="lead-total-fechados">0</strong>
              <small>Oportunidades convertidas</small>
            </article>
            <article class="dashboard-card financeiro-kpi-card cliente-kpi-atrasado">
              <span>Retornos atrasados</span>
              <strong id="lead-total-atrasados">0</strong>
              <small>Clientes que precisam de atenção</small>
            </article>
          </div>

          <section class="central-atendimento" aria-label="Central de atendimento">
            <div class="central-atendimento-topo">
              <div>
                <span class="admin-eyebrow">Central de atendimento</span>
                <h3>Prioridades do dia</h3>
                <p>Veja rapidamente quem precisa de retorno e qual ação tomar agora.</p>
              </div>
              <button type="button" class="btn-primary" id="central-novo-cliente">
                + Novo cliente
              </button>
            </div>

            <div class="central-atendimento-grid">
              <article class="central-mini-card central-card-hoje">
                <span>Retornos hoje</span>
                <strong id="central-retornos-hoje">0</strong>
                <small>Contatos agendados para hoje</small>
              </article>
              <article class="central-mini-card central-card-atrasado">
                <span>Atrasados</span>
                <strong id="central-retornos-atrasados">0</strong>
                <small>Precisam de atenção imediata</small>
              </article>
              <article class="central-mini-card central-card-novos">
                <span>Novos</span>
                <strong id="central-clientes-novos">0</strong>
                <small>Entraram recentemente</small>
              </article>
              <article class="central-mini-card central-card-propostas">
                <span>Propostas</span>
                <strong id="central-propostas-abertas">0</strong>
                <small>Negociações em andamento</small>
              </article>
            </div>

            <div class="central-prioridades">
              <div class="central-prioridades-topo">
                <h4>Lista rápida de prioridades</h4>
                <span id="central-prioridades-resumo">Tudo em dia</span>
              </div>
              <div id="central-lista-prioridades" class="central-lista-prioridades"></div>
            </div>
          </section>

          <div class="clientes-toolbar">
            <label class="clientes-busca">
              <span>Buscar cliente</span>
              <input
                type="search"
                id="lead-busca"
                placeholder="Nome, WhatsApp, veículo ou observação"
              />
            </label>
            <label>
              <span>Etapa</span>
              <select id="lead-filtro-status">
                <option value="">Todas as etapas</option>
                <option value="Novo">Novo</option>
                <option value="Em atendimento">Em atendimento</option>
                <option value="Proposta">Proposta</option>
                <option value="Fechado">Fechado</option>
                <option value="Perdido">Perdido</option>
              </select>
            </label>
            <label>
              <span>Próximo contato</span>
              <select id="lead-filtro-contato">
                <option value="">Todos</option>
                <option value="atrasados">Atrasados</option>
                <option value="hoje">Hoje</option>
                <option value="proximos">Próximos</option>
                <option value="sem-data">Sem data</option>
              </select>
            </label>
            <button type="button" class="btn-cancelar btn-visivel" id="lead-limpar-filtros">
              Limpar filtros
            </button>
          </div>

          <div class="cliente-form-modal-anchor">
            <form id="form-lead" class="admin-form financeiro-saida-form">
              <input type="hidden" id="lead-id" />
              <div class="lead-modal-hero">
                <div>
                  <span class="admin-eyebrow">Cadastro</span>
                  <h3 id="lead-form-titulo">Cadastrar cliente</h3>
                  <p>Centralize os dados do atendimento, interesse e próximos passos do cliente.</p>
                </div>
              </div>

              <div class="lead-form-secoes">
                <section class="lead-form-secao">
                  <div class="lead-form-secao-topo">
                    <span>01</span>
                    <div>
                      <h4>Dados principais</h4>
                      <p>Informações essenciais para contato e identificação.</p>
                    </div>
                  </div>
                  <div class="form-grid">
                    <label>
                      Nome
                      <input type="text" id="lead-nome" placeholder="Nome do cliente" required />
                    </label>
                    <label>
                      WhatsApp
                      <input type="text" id="lead-whatsapp" placeholder="(00) 00000-0000" required />
                    </label>
                    <label>
                      E-mail
                      <input type="email" id="lead-email" placeholder="cliente@email.com" />
                    </label>
                    <label>
                      CPF
                      <input
                        type="text"
                        id="lead-cpf"
                        placeholder="000.000.000-00"
                        inputmode="numeric"
                        maxlength="14"
                      />
                    </label>
                    <label>
                      Data de nascimento
                      <input type="date" id="lead-data-nascimento" />
                    </label>
                    <label class="cliente-consentimento">
                      <input type="checkbox" id="lead-consentimento" />
                      Cliente autorizou armazenamento dos dados e contato
                    </label>
                  </div>
                </section>

                <section class="lead-form-secao">
                  <div class="lead-form-secao-topo">
                    <span>02</span>
                    <div>
                      <h4>Endereço e perfil</h4>
                      <p>Dados úteis para negociação, proposta e financiamento.</p>
                    </div>
                  </div>
                  <div class="form-grid">
                    <label>
                      CEP
                      <input
                        type="text"
                        id="lead-cep"
                        placeholder="00000-000"
                        inputmode="numeric"
                        maxlength="9"
                        data-cep
                        data-cep-endereco="lead-endereco"
                        data-cep-bairro="lead-bairro"
                        data-cep-cidade="lead-cidade"
                        data-cep-estado="lead-estado"
                      />
                    </label>
                    <label>
                      Endereço
                      <input type="text" id="lead-endereco" placeholder="Rua, avenida ou travessa" />
                    </label>
                    <label>
                      Número
                      <input type="text" id="lead-numero" placeholder="Nº" />
                    </label>
                    <label>
                      Complemento
                      <input type="text" id="lead-complemento" placeholder="Apto, bloco, referência" />
                    </label>
                    <label>
                      Bairro
                      <input type="text" id="lead-bairro" placeholder="Bairro" />
                    </label>
                    <label>
                      Cidade
                      <input type="text" id="lead-cidade" placeholder="Cidade" />
                    </label>
                    <label>
                      UF
                      <input
                        type="text"
                        id="lead-estado"
                        placeholder="UF"
                        maxlength="2"
                      />
                    </label>
                    <label>
                      Profissão
                      <input type="text" id="lead-profissao" placeholder="Profissão ou ocupação" />
                    </label>
                    <label>
                      Renda mensal aproximada
                      <input
                        type="text"
                        id="lead-renda-mensal"
                        placeholder="R$ 0"
                        inputmode="numeric"
                        data-moeda
                      />
                    </label>
                    <label>
                      Origem
                      <select id="lead-origem">
                        <option value="Site">Site</option>
                        <option value="Instagram">Instagram</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Indicação">Indicação</option>
                        <option value="Loja física">Loja física</option>
                        <option value="Outro">Outro</option>
                      </select>
                    </label>
                  </div>
                </section>

                <section class="lead-form-secao">
                  <div class="lead-form-secao-topo">
                    <span>03</span>
                    <div>
                      <h4>Atendimento</h4>
                      <p>Defina interesse, responsável, etapa e o próximo contato.</p>
                    </div>
                  </div>
                  <div class="form-grid">
                    <label>
                      Veículo de interesse
                      <select id="lead-veiculo">
                        <option value="">Sem veículo definido</option>
                      </select>
                    </label>
                    <label>
                      Vendedor responsável
                      <select id="lead-vendedor">
                        <option value="">Sem responsável</option>
                      </select>
                    </label>
                    <label>
                      Status
                      <select id="lead-status">
                        <option value="Novo">Novo</option>
                        <option value="Em atendimento">Em atendimento</option>
                        <option value="Proposta">Proposta</option>
                        <option value="Fechado">Fechado</option>
                        <option value="Perdido">Perdido</option>
                      </select>
                    </label>
                    <label>
                      Temperatura
                      <select id="lead-temperatura">
                        <option value="Frio">Frio</option>
                        <option value="Morno" selected>Morno</option>
                        <option value="Quente">Quente</option>
                      </select>
                    </label>
                    <label>
                      Motivo da perda
                      <select id="lead-motivo-perda">
                        <option value="">Não se aplica</option>
                        <option value="Preço">Preço</option>
                        <option value="Crédito não aprovado">Crédito não aprovado</option>
                        <option value="Comprou em outra loja">Comprou em outra loja</option>
                        <option value="Veículo indisponível">Veículo indisponível</option>
                        <option value="Desistiu da compra">Desistiu da compra</option>
                        <option value="Sem retorno">Sem retorno</option>
                        <option value="Outro">Outro</option>
                      </select>
                    </label>
                    <label>
                      Próximo contato
                      <input type="date" id="lead-proximo-contato" />
                    </label>
                    <label>
                      Próxima tarefa
                      <input type="text" id="lead-tarefa" placeholder="Ex.: enviar simulação" />
                    </label>
                    <label>
                      Prazo da tarefa
                      <input type="datetime-local" id="lead-prazo-tarefa" />
                    </label>
                  </div>
                </section>
              </div>

              <section class="lead-form-secao lead-form-observacoes">
                <div class="lead-form-secao-topo">
                  <span>04</span>
                  <div>
                    <h4>Observações</h4>
                    <p>Registre contexto do atendimento e novas interações.</p>
                  </div>
                </div>
                <div class="lead-textareas-grid">
                  <label>
                    Observações do atendimento
                    <textarea id="lead-observacao" rows="4" placeholder="Ex.: cliente busca SUV automático, prefere entrada baixa e retorno à tarde."></textarea>
                  </label>
                  <label>
                    Nova interação
                    <textarea id="lead-interacao" rows="4" placeholder="Ex.: simulação enviada e retorno combinado para sexta-feira."></textarea>
                  </label>
                </div>
              </section>

              <div class="admin-form-acoes">
                <button type="submit" class="btn-primary" id="btn-lead-salvar">
                  Salvar cliente
                </button>
                <button type="button" class="btn-cancelar" id="btn-lead-cancelar">
                  Cancelar edição
                </button>
              </div>
            </form>
          </div>

          <section class="financeiro-relatorio clientes-pipeline-card">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Pipeline</span>
                <h3>Resumo do funil</h3>
              </div>
              <p>Quantidade de oportunidades por etapa.</p>
            </div>

            <div id="lista-funil-clientes" class="analytics-lista"></div>
          </section>

          <section class="financeiro-relatorio">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Atendimentos</span>
                <h3>Clientes cadastrados</h3>
              </div>
            </div>

            <div id="lista-leads-admin" class="admin-lista"></div>
            <div id="paginacao-clientes" class="paginacao-admin" aria-label="Paginação dos clientes"></div>
          </section>

          <section class="financeiro-relatorio">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Kanban</span>
                <h3>Pipeline comercial</h3>
              </div>
              <p>Arraste os clientes entre as etapas para atualizar o atendimento.</p>
            </div>
            <div id="kanban-clientes" class="clientes-kanban"></div>
          </section>

          <section class="financeiro-relatorio">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Crédito</span>
                <h3>Solicitações de financiamento</h3>
              </div>
              <p>Analise propostas, confira documentos e atualize o cliente.</p>
            </div>
            <div id="lista-solicitacoes-financiamento" class="admin-lista"></div>
          </section>
        </div>

        <div class="admin-tab-panel" data-admin-panel="relatorios">
          <div class="financeiro-cabecalho">
            <div>
              <span class="admin-eyebrow">Gestão</span>
              <h2>Relatórios e histórico</h2>
              <p>
                Exporte dados úteis para conferência e acompanhe alterações importantes dos veículos.
              </p>
            </div>
          </div>

          <section class="financeiro-relatorio relatorios-export-card">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Exportações</span>
                <h3>Arquivos CSV</h3>
              </div>
              <p>Compatível com Excel, Google Sheets e sistemas externos.</p>
            </div>

            <div class="relatorios-grid">
              <button type="button" class="btn-primary" id="exportar-estoque">Exportar estoque</button>
              <button type="button" class="btn-primary" id="exportar-vendas">Exportar vendas</button>
              <button type="button" class="btn-primary" id="exportar-comissoes">Exportar comissões</button>
              <button type="button" class="btn-primary" id="exportar-recebiveis">Exportar contas a receber</button>
              <button type="button" class="btn-primary" id="exportar-clientes">Exportar clientes</button>
              <button type="button" class="btn-primary" id="exportar-historico">Exportar histórico</button>
            </div>
          </section>

          <section class="financeiro-relatorio">
            <div class="financeiro-relatorio-topo">
              <div>
                <span class="admin-eyebrow">Linha do tempo</span>
                <h3>Histórico do veículo</h3>
              </div>
              <p>Vendas, alterações, gastos, troca e status ficam registrados aqui.</p>
            </div>

            <div class="form-grid historico-filtro">
              <label>
                Veículo
                <select id="historico-veiculo">
                  <option value="">Todos os veículos</option>
                </select>
              </label>
            </div>

            <div id="lista-historico-veiculos" class="admin-lista financeiro-lista"></div>
          </section>
        </div>

        <div class="admin-tab-panel" data-admin-panel="visitas">
          <h2>Controle de visitas</h2>

          <div class="dashboard-grid">
            <article class="dashboard-card">
              <span>Visitas totais</span>
              <strong id="visitas-total">0</strong>
            </article>
            <article class="dashboard-card dashboard-ok">
              <span>Sessões</span>
              <strong id="visitas-sessoes">0</strong>
            </article>
            <article class="dashboard-card dashboard-alerta">
              <span>Tempo médio</span>
              <strong id="visitas-tempo">0s</strong>
            </article>
            <article class="dashboard-card">
              <span>Hoje</span>
              <strong id="visitas-hoje">0</strong>
            </article>
          </div>

          <div class="analytics-grid">
            <section class="admin-form analytics-card">
              <div class="analytics-card-header">
                <h3>Últimos 7 dias</h3>
                <button type="button" class="btn-cancelar btn-visivel" id="limpar-visitas">
                  Limpar dados
                </button>
              </div>
              <div class="analytics-barras" id="grafico-visitas"></div>
            </section>

            <section class="admin-form analytics-card">
              <h3>Páginas mais vistas</h3>
              <div class="analytics-lista" id="paginas-mais-vistas"></div>
            </section>

            <section class="admin-form analytics-card">
              <h3>Veículos mais acessados</h3>
              <div class="analytics-lista" id="veiculos-mais-vistos"></div>
            </section>

            <section class="admin-form analytics-card">
              <h3>Últimas visitas</h3>
              <div class="analytics-lista" id="ultimas-visitas"></div>
            </section>
          </div>

          <p class="admin-ajuda">
            As visitas são consolidadas no banco da aplicação. Os dados são operacionais e não
            substituem uma plataforma especializada de analytics.
          </p>
        </div>

        <div class="admin-tab-panel" data-admin-panel="sistema">
          <h2>Perfil de acesso</h2>

          <div class="admin-form">
            <p class="admin-ajuda">
              Este é o perfil real do usuário logado. O gestor acessa tudo; os demais perfis veem apenas as áreas autorizadas.
            </p>
            <div class="form-grid">
              <label>
                Perfil atual
                <select id="perfil-admin" disabled>
                  <option value="gestor">Gestor</option>
                  <option value="vendedor">Vendedor</option>
                  <option value="financeiro">Financeiro</option>
                  <option value="estoque">Estoque</option>
                  <option value="marketing">Marketing</option>
                </select>
              </label>
            </div>
          </div>

          <h2>Segurança do admin</h2>

          <form id="form-seguranca" class="admin-form">
            <div class="form-grid">
              <input
                type="text"
                id="seguranca-usuario-atual"
                placeholder="Usuário atual"
                autocomplete="username"
                required
              />
              <input
                type="password"
                id="seguranca-senha-atual"
                placeholder="Senha atual"
                autocomplete="current-password"
                required
              />
              <input
                type="text"
                id="seguranca-novo-usuario"
                placeholder="Novo usuário"
                autocomplete="username"
                required
              />
              <input
                type="password"
                id="seguranca-nova-senha"
                placeholder="Nova senha"
                autocomplete="new-password"
                required
              />
              <input
                type="password"
                id="seguranca-confirmar-senha"
                placeholder="Confirmar nova senha"
                autocomplete="new-password"
                required
              />
            </div>

            <p id="seguranca-retorno" class="admin-retorno"></p>

            <div class="admin-form-acoes">
              <button type="submit" class="btn-primary">Salvar novo acesso</button>
            </div>
          </form>

          <h2>Backup dos dados</h2>

          <div class="admin-form">
            <p class="admin-ajuda">
              Exporte um arquivo de backup para guardar os dados do estoque,
              depoimentos, parcerias, loja e configurações do painel.
            </p>

            <div class="admin-form-acoes">
              <button type="button" class="btn-primary" id="exportar-backup">
                Exportar backup
              </button>
              <label class="btn-cancelar btn-visivel importar-backup">
                Importar backup
                <input type="file" id="importar-backup" accept="application/json" />
              </label>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <p>2026 3M Veículos - Todos os direitos reservados</p>
    </footer>

    <div class="admin-modal" id="modal-venda" aria-hidden="true">
      <div class="admin-modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-venda-titulo">
        <div class="admin-modal-header">
          <div>
            <span class="admin-eyebrow">Registrar venda</span>
            <h3 id="modal-venda-titulo">Concluir venda do veículo</h3>
            <p id="modal-venda-veiculo">Informe os dados comerciais da venda.</p>
          </div>
          <button type="button" class="admin-modal-fechar" id="fechar-modal-venda" aria-label="Fechar">
            ×
          </button>
        </div>

        <form id="form-modal-venda" class="admin-modal-form">
          <div class="form-grid">
            <label>
              Vendedor que fez a venda
              <select id="modal-venda-vendedor" required></select>
            </label>
            <label>
              Valor final da venda
              <input type="text" id="modal-venda-valor" required />
            </label>
            <label>
              Taxa de comissão (%)
              <input type="text" id="modal-venda-taxa" placeholder="Ex: 1,5" />
            </label>
            <label>
              Comissão do vendedor
              <input type="text" id="modal-venda-comissao" required />
            </label>
            <label>
              Recebeu carro na troca?
              <select id="modal-venda-tem-troca">
                <option value="Não">Não</option>
                <option value="Sim">Sim</option>
              </select>
            </label>
            <label>
              Dinheiro/financiamento recebido
              <input type="text" id="modal-venda-valor-recebido" />
            </label>
            <label class="campo-troca-venda">
              Carro recebido na troca
              <input type="text" id="modal-venda-troca-veiculo" placeholder="Ex: Onix LT 2019" />
            </label>
            <label class="campo-troca-venda">
              Valor avaliado da troca
              <input type="text" id="modal-venda-troca-valor" />
            </label>
            <label>
              Saldo a receber
              <input type="text" id="modal-venda-saldo" />
            </label>
          </div>

          <label class="check-oferta modal-venda-troca-check campo-troca-venda">
            <input type="checkbox" id="modal-venda-cadastrar-troca" checked />
            Cadastrar carro recebido na troca como estoque
          </label>

          <p class="admin-ajuda">
            A troca entra como parte do pagamento e, se cadastrada no estoque, entra com custo de aquisição igual ao valor avaliado.
          </p>

          <div class="admin-form-acoes">
            <button type="submit" class="btn-primary">Registrar como vendido</button>
            <button type="button" class="btn-cancelar btn-visivel" id="cancelar-modal-venda">
              Cancelar
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="admin-modal cliente-modal" id="modal-cliente" aria-hidden="true">
      <div class="admin-modal-card cliente-modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-cliente-nome">
        <div class="admin-modal-header">
          <div>
            <span class="admin-eyebrow">Ficha completa</span>
            <h3 id="modal-cliente-nome">Cliente</h3>
            <p id="modal-cliente-resumo">Dados e histórico do atendimento.</p>
          </div>
          <button type="button" class="admin-modal-fechar" id="fechar-modal-cliente" aria-label="Fechar">×</button>
        </div>

        <div class="cliente-modal-conteudo">
          <div class="cliente-modal-acoes">
            <button type="button" class="btn-primary" id="cliente-modal-whatsapp">WhatsApp</button>
            <a class="btn-cancelar btn-visivel" id="cliente-modal-ligar" href="#">Ligar</a>
            <button type="button" class="btn-cancelar btn-visivel" id="cliente-modal-tarefa">Nova tarefa</button>
            <button type="button" class="btn-cancelar btn-visivel" id="cliente-modal-editar">Editar cadastro</button>
          </div>

          <section class="cliente-modal-secao">
            <div class="cliente-modal-secao-titulo">
              <div><span class="admin-eyebrow">Cadastro</span><h4>Informações do cliente</h4></div>
              <span class="cliente-status" id="cliente-modal-status">Novo</span>
            </div>
            <div class="cliente-ficha-grid" id="cliente-modal-dados"></div>
          </section>

          <section class="cliente-modal-secao">
            <div class="cliente-modal-secao-titulo">
              <div><span class="admin-eyebrow">Crédito</span><h4>Financiamentos</h4></div>
            </div>
            <div id="cliente-modal-financiamentos" class="cliente-financiamentos-lista"></div>
          </section>

          <section class="cliente-modal-secao">
            <div class="cliente-modal-secao-titulo">
              <div><span class="admin-eyebrow">Atendimento</span><h4>Registrar interação</h4></div>
            </div>
            <form id="form-comunicacao-cliente" class="cliente-comunicacao-form">
              <div class="form-grid">
                <label>Canal
                  <select id="cliente-comunicacao-canal">
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Telefone">Telefone</option>
                    <option value="E-mail">E-mail</option>
                    <option value="Anotação">Anotação</option>
                  </select>
                </label>
                <label>Direção
                  <select id="cliente-comunicacao-direcao">
                    <option value="Saída">Saída</option>
                    <option value="Entrada">Entrada</option>
                  </select>
                </label>
              </div>
              <label>Resumo da interação
                <textarea id="cliente-comunicacao-mensagem" rows="3" maxlength="5000" required placeholder="Ex.: simulação enviada e retorno combinado para sexta-feira."></textarea>
              </label>
              <div class="admin-form-acoes">
                <button type="submit" class="btn-primary">Salvar no histórico</button>
              </div>
              <p class="admin-retorno" id="cliente-comunicacao-retorno" aria-live="polite"></p>
            </form>
          </section>

          <section class="cliente-modal-secao">
            <div class="cliente-modal-secao-titulo">
              <div><span class="admin-eyebrow">Linha do tempo</span><h4>Histórico de contatos</h4></div>
            </div>
            <div id="cliente-modal-historico" class="cliente-historico-lista"></div>
          </section>
        </div>
      </div>
    </div>

    <div class="admin-modal comissoes-modal" id="modal-comissoes" aria-hidden="true">
      <div class="admin-modal-card comissoes-modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-comissoes-titulo">
        <div class="admin-modal-header">
          <div>
            <span class="admin-eyebrow">Equipe comercial</span>
            <h3 id="modal-comissoes-titulo">Histórico de comissões</h3>
            <p id="modal-comissoes-periodo">Todas as vendas registradas.</p>
          </div>
          <button type="button" class="admin-modal-fechar" id="fechar-modal-comissoes" aria-label="Fechar">×</button>
        </div>
        <div class="comissoes-modal-conteudo">
          <div class="comissoes-modal-filtros">
            <label>Vendedor
              <select id="filtro-historico-comissoes">
                <option value="">Todos os vendedores</option>
              </select>
            </label>
            <div class="comissoes-modal-total">
              <span>Total exibido</span>
              <strong id="historico-comissoes-total">R$ 0</strong>
            </div>
          </div>
          <div id="historico-comissoes-lista" class="historico-comissoes-lista"></div>
        </div>
      </div>
    </div>

    <script src="/js/config.js?v=20260625-cep-global"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/depoimentos.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/parcerias.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260621-banco"></script>
    <script data-site-script data-src="/js/admin.js?v=20260626-resumo-clicavel"></script>
  </body>
</html>














