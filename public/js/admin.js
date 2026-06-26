const form = document.getElementById("form-carro");
const listaAdmin = document.getElementById("lista-admin");
const paginacaoVeiculos = document.getElementById("paginacao-veiculos");
const inputFile = document.getElementById("imagem-file");
const previewImg = document.getElementById("preview-img");
const inputGaleriaFiles = document.getElementById("galeria-files");
const previewGaleriaAdmin = document.getElementById("galeria-preview-admin");
const previewCardCarro = document.getElementById("preview-card-carro");
const selectMarca = document.getElementById("marca");
const formLoja = document.getElementById("form-loja");
const formMensagemWhatsapp = document.getElementById("form-mensagem-whatsapp");
const inputLogoLoja = document.getElementById("loja-logo-file");
const previewLogoLoja = document.getElementById("loja-logo-preview");
const buscaAdminCarros = document.getElementById("busca-admin-carros");
const statusAdminCarros = document.getElementById("status-admin-carros");
const btnCancelar = document.getElementById("btn-cancelar");
const btnSalvar = document.getElementById("btn-salvar");
const tituloForm = document.getElementById("admin-form-titulo");
const formDepoimento = document.getElementById("form-depoimento");
const listaDepoimentosAdmin = document.getElementById("lista-depoimentos-admin");
const inputDepoimentoFile = document.getElementById("depoimento-file");
const previewDepoimento = document.getElementById("depoimento-preview");
const btnDepoimentoCancelar = document.getElementById("btn-depoimento-cancelar");
const btnDepoimentoSalvar = document.getElementById("btn-depoimento-salvar");
const tituloFormDepoimento = document.getElementById("depoimento-form-titulo");
const formParceria = document.getElementById("form-parceria");
const listaParceriasAdmin = document.getElementById("lista-parcerias-admin");
const btnParceriaCancelar = document.getElementById("btn-parceria-cancelar");
const btnParceriaSalvar = document.getElementById("btn-parceria-salvar");
const tituloFormParceria = document.getElementById("parceria-form-titulo");
const resetLoja = document.getElementById("reset-loja");
const btnLogout = document.getElementById("btn-logout");
const adminTabs = document.querySelectorAll("[data-admin-tab]");
const adminPanels = document.querySelectorAll("[data-admin-panel]");
const adminAtalhos = document.querySelectorAll("[data-admin-atalho]");
const btnAbrirNotificacoes = document.getElementById("abrir-notificacoes");
const painelNotificacoes = document.getElementById("painel-notificacoes");
const contadorNotificacoes = document.getElementById("notificacoes-contador");
const resumoNotificacoes = document.getElementById("notificacoes-resumo");
const listaNotificacoes = document.getElementById("lista-notificacoes");
const btnNotificacoesVerClientes = document.getElementById("notificacoes-ver-clientes");
const financeiroMenuBtns = document.querySelectorAll("[data-finance-view-target]");
const financeiroViews = document.querySelectorAll("[data-finance-view]");
const formSeguranca = document.getElementById("form-seguranca");
const segurancaRetorno = document.getElementById("seguranca-retorno");
const btnExportarBackup = document.getElementById("exportar-backup");
const inputImportarBackup = document.getElementById("importar-backup");
const listaFinanceiro = document.getElementById("lista-financeiro");
const filtroFinanceiroMes = document.getElementById("financeiro-mes");
const btnExportarFinanceiro = document.getElementById("exportar-financeiro");
const btnLimparFinanceiro = document.getElementById("limpar-financeiro");
const btnCopiarLinkFinanciamento = document.getElementById("copiar-link-financiamento");
const retornoLinkFinanciamento = document.getElementById("retorno-link-financiamento");
const resumoPeriodoFinanceiro = document.getElementById("fin-resumo-periodo");
const formSaidaFinanceira = document.getElementById("form-saida-financeira");
const listaSaidasFinanceiras = document.getElementById("lista-saidas-financeiras");
const resumoSaidasFinanceiras = document.getElementById("fin-resumo-saidas");
const listaAlertasFinanceiros = document.getElementById("lista-alertas-financeiros");
const graficoPizzaFinanceiro = document.getElementById("fin-grafico-pizza");
const graficoCentroFinanceiro = document.getElementById("fin-grafico-centro");
const graficoLegendaFinanceiro = document.getElementById("fin-grafico-legenda");
const graficoResumoFinanceiro = document.getElementById("fin-grafico-resumo");
const formVendedor = document.getElementById("form-vendedor");
const listaVendedoresAdmin = document.getElementById("lista-vendedores-admin");
const listaComissoesVendedores = document.getElementById("lista-comissoes-vendedores");
const btnVendedorCancelar = document.getElementById("btn-vendedor-cancelar");
const btnVendedorSalvar = document.getElementById("btn-vendedor-salvar");
const tituloFormVendedor = document.getElementById("vendedor-form-titulo");
const selectVendedorVenda = document.getElementById("vendedor-venda");
const resumoPeriodoVendedores = document.getElementById("vend-resumo-periodo");
const btnAbrirHistoricoComissoes = document.getElementById("abrir-historico-comissoes");
const modalComissoes = document.getElementById("modal-comissoes");
const btnFecharModalComissoes = document.getElementById("fechar-modal-comissoes");
const filtroHistoricoComissoes = document.getElementById("filtro-historico-comissoes");
const listaHistoricoComissoes = document.getElementById("historico-comissoes-lista");
const totalHistoricoComissoes = document.getElementById("historico-comissoes-total");
const periodoHistoricoComissoes = document.getElementById("modal-comissoes-periodo");
const modalVenda = document.getElementById("modal-venda");
const formModalVenda = document.getElementById("form-modal-venda");
const modalVendaVeiculo = document.getElementById("modal-venda-veiculo");
const selectModalVendaVendedor = document.getElementById("modal-venda-vendedor");
const inputModalVendaValor = document.getElementById("modal-venda-valor");
const inputModalVendaTaxa = document.getElementById("modal-venda-taxa");
const inputModalVendaComissao = document.getElementById("modal-venda-comissao");
const selectModalVendaTemTroca = document.getElementById("modal-venda-tem-troca");
const inputModalVendaValorRecebido = document.getElementById("modal-venda-valor-recebido");
const inputModalVendaTrocaVeiculo = document.getElementById("modal-venda-troca-veiculo");
const inputModalVendaTrocaValor = document.getElementById("modal-venda-troca-valor");
const inputModalVendaSaldo = document.getElementById("modal-venda-saldo");
const checkModalVendaCadastrarTroca = document.getElementById("modal-venda-cadastrar-troca");
const btnFecharModalVenda = document.getElementById("fechar-modal-venda");
const btnCancelarModalVenda = document.getElementById("cancelar-modal-venda");
const modalCliente = document.getElementById("modal-cliente");
const btnFecharModalCliente = document.getElementById("fechar-modal-cliente");
const modalClienteNome = document.getElementById("modal-cliente-nome");
const modalClienteResumo = document.getElementById("modal-cliente-resumo");
const modalClienteStatus = document.getElementById("cliente-modal-status");
const modalClienteDados = document.getElementById("cliente-modal-dados");
const modalClienteFinanciamentos = document.getElementById("cliente-modal-financiamentos");
const modalClienteHistorico = document.getElementById("cliente-modal-historico");
const btnModalClienteWhatsapp = document.getElementById("cliente-modal-whatsapp");
const linkModalClienteLigar = document.getElementById("cliente-modal-ligar");
const btnModalClienteTarefa = document.getElementById("cliente-modal-tarefa");
const btnModalClienteEditar = document.getElementById("cliente-modal-editar");
const formComunicacaoCliente = document.getElementById("form-comunicacao-cliente");
const retornoComunicacaoCliente = document.getElementById("cliente-comunicacao-retorno");
const lucroFormulario = document.getElementById("lucro-formulario");
const selectInstagramCarro = document.getElementById("instagram-carro");
const selectInstagramFormato = document.getElementById("instagram-formato");
const selectInstagramTom = document.getElementById("instagram-tom");
const selectInstagramCor = document.getElementById("instagram-cor");
const inputInstagramTitulo = document.getElementById("instagram-titulo");
const inputInstagramCta = document.getElementById("instagram-cta");
const textareaInstagramLegenda = document.getElementById("instagram-legenda");
const btnInstagramAtualizar = document.getElementById("instagram-atualizar");
const btnInstagramCopiar = document.getElementById("instagram-copiar");
const btnInstagramBaixar = document.getElementById("instagram-baixar");
const linkInstagramWhatsapp = document.getElementById("instagram-whatsapp");
const retornoInstagram = document.getElementById("instagram-retorno");
const canvasInstagram = document.getElementById("instagram-canvas");
const visitasTotal = document.getElementById("visitas-total");
const visitasSessoes = document.getElementById("visitas-sessoes");
const visitasTempo = document.getElementById("visitas-tempo");
const visitasHoje = document.getElementById("visitas-hoje");
const dashAlertasExecutivos = document.getElementById("dash-alertas-executivos");
const dashProximosContatos = document.getElementById("dash-proximos-contatos");
const dashEstoqueParado = document.getElementById("dash-estoque-parado");
const graficoVisitas = document.getElementById("grafico-visitas");
const paginasMaisVistas = document.getElementById("paginas-mais-vistas");
const veiculosMaisVistos = document.getElementById("veiculos-mais-vistos");
const ultimasVisitas = document.getElementById("ultimas-visitas");
const btnLimparVisitas = document.getElementById("limpar-visitas");
const selectSaidaVeiculo = document.getElementById("saida-veiculo");
const listaCaixaFinanceiro = document.getElementById("lista-caixa-financeiro");
const listaContasReceber = document.getElementById("lista-contas-receber");
const resumoReceberFinanceiro = document.getElementById("fin-receber-resumo");
const formLead = document.getElementById("form-lead");
const listaLeadsAdmin = document.getElementById("lista-leads-admin");
const paginacaoClientes = document.getElementById("paginacao-clientes");
const listaFunilClientes = document.getElementById("lista-funil-clientes");
const selectLeadVeiculo = document.getElementById("lead-veiculo");
const selectLeadVendedor = document.getElementById("lead-vendedor");
const btnLeadCancelar = document.getElementById("btn-lead-cancelar");
const btnLeadSalvar = document.getElementById("btn-lead-salvar");
const tituloFormLead = document.getElementById("lead-form-titulo");
const inputLeadBusca = document.getElementById("lead-busca");
const selectLeadFiltroStatus = document.getElementById("lead-filtro-status");
const selectLeadFiltroContato = document.getElementById("lead-filtro-contato");
const btnLeadLimparFiltros = document.getElementById("lead-limpar-filtros");
const btnClientesTopoNovoCliente = document.getElementById("clientes-topo-novo-cliente");
const btnCentralNovoCliente = document.getElementById("central-novo-cliente");
const centralRetornosHoje = document.getElementById("central-retornos-hoje");
const centralRetornosAtrasados = document.getElementById("central-retornos-atrasados");
const centralClientesNovos = document.getElementById("central-clientes-novos");
const centralPropostasAbertas = document.getElementById("central-propostas-abertas");
const centralPrioridadesResumo = document.getElementById("central-prioridades-resumo");
const centralListaPrioridades = document.getElementById("central-lista-prioridades");
const kanbanClientes = document.getElementById("kanban-clientes");
const listaSolicitacoesFinanciamento = document.getElementById("lista-solicitacoes-financiamento");
const selectHistoricoVeiculo = document.getElementById("historico-veiculo");
const listaHistoricoVeiculos = document.getElementById("lista-historico-veiculos");
const btnExportarEstoque = document.getElementById("exportar-estoque");
const btnExportarVendas = document.getElementById("exportar-vendas");
const btnExportarComissoes = document.getElementById("exportar-comissoes");
const btnExportarRecebiveis = document.getElementById("exportar-recebiveis");
const btnExportarClientes = document.getElementById("exportar-clientes");
const btnExportarHistorico = document.getElementById("exportar-historico");
const selectPerfilAdmin = document.getElementById("perfil-admin");
const metaAdminRole = document.querySelector('meta[name="admin-role"]');

let imagemBase64 = "";
let galeriaUploadBase64 = [];
let imagemDepoimentoBase64 = "";
let logoLojaBase64 = "";
let snapshotSaidasFinanceiras = [];
let snapshotVendedores = [];
let snapshotLeads = [];
const filasCrudAdmin = {};
let carrosAdmin = carregarCarros();
let depoimentosAdmin = carregarDepoimentos();
let parceriasAdmin = carregarParcerias();
let saidasFinanceiras = carregarSaidasFinanceiras();
let vendedoresAdmin = carregarVendedores();
let leadsAdmin = carregarLeadsAdmin();
let historicoVeiculosAdmin = carregarHistoricoVeiculos();
let solicitacoesFinanciamentoAdmin = [];
let vendaPendenteId = null;
let clienteModalId = null;
let paginaVeiculos = 1;
let paginaClientes = 1;
let itensPorPaginaVeiculos = 6;
let itensPorPaginaClientes = 6;

function renderizarPaginacao(elemento, total, pagina, porPagina, tipo) {
  if (!elemento) return;

  const totalPaginas = Math.max(1, Math.ceil(total / porPagina));
  const inicio = total ? (pagina - 1) * porPagina + 1 : 0;
  const fim = Math.min(pagina * porPagina, total);

  elemento.innerHTML =
    '<div class="paginacao-resumo">Mostrando <strong>' +
    inicio +
    "–" +
    fim +
    "</strong> de <strong>" +
    total +
    '</strong></div><label>Por página <select onchange="alterarItensPorPagina(\'' +
    tipo +
    "', this.value)\">" +
    [6, 12, 24]
      .map(function (quantidade) {
        return (
          '<option value="' +
          quantidade +
          '"' +
          (porPagina === quantidade ? " selected" : "") +
          ">" +
          quantidade +
          "</option>"
        );
      })
      .join("") +
    '</select></label><div class="paginacao-acoes">' +
    '<button type="button" onclick="mudarPagina(\'' +
    tipo +
    "', -1)\"" +
    (pagina <= 1 ? " disabled" : "") +
    ">Anterior</button><span>Página " +
    pagina +
    " de " +
    totalPaginas +
    '</span><button type="button" onclick="mudarPagina(\'' +
    tipo +
    "', 1)\"" +
    (pagina >= totalPaginas ? " disabled" : "") +
    ">Próxima</button></div>";
}

function alterarItensPorPagina(tipo, valor) {
  const quantidade = Number(valor) || 6;

  if (tipo === "veiculos") {
    itensPorPaginaVeiculos = quantidade;
    paginaVeiculos = 1;
    renderizarAdmin();
    return;
  }

  itensPorPaginaClientes = quantidade;
  paginaClientes = 1;
  renderizarClientes();
}

function mudarPagina(tipo, direcao) {
  if (tipo === "veiculos") {
    paginaVeiculos = Math.max(1, paginaVeiculos + Number(direcao));
    renderizarAdmin();
    listaAdmin.scrollIntoView({ behavior: "smooth", block: "start" });
    return;
  }

  paginaClientes = Math.max(1, paginaClientes + Number(direcao));
  renderizarClientes();
  listaLeadsAdmin.scrollIntoView({ behavior: "smooth", block: "start" });
}

function notificacoesClientes() {
  const agora = new Date();
  const hoje = agora.toISOString().slice(0, 10);
  const notificacoes = [];

  leadsAdmin.forEach(function (lead) {
    if (lead.status === "Fechado" || lead.status === "Perdido") return;

    if (lead.proximoContato && lead.proximoContato <= hoje) {
      notificacoes.push({
        id: Number(lead.id),
        tipo: lead.proximoContato < hoje ? "Retorno atrasado" : "Retorno hoje",
        detalhe: formatarDataBR(lead.proximoContato),
        prioridade: lead.proximoContato < hoje ? 0 : 1,
        data: lead.proximoContato,
        nome: lead.nome,
      });
    }

    if (lead.prazoTarefa) {
      const prazo = new Date(lead.prazoTarefa);

      if (!Number.isNaN(prazo.getTime()) && prazo <= agora) {
        notificacoes.push({
          id: Number(lead.id),
          tipo: "Tarefa vencida",
          detalhe:
            (lead.tarefa ? lead.tarefa + " · " : "") +
            prazo.toLocaleString("pt-BR"),
          prioridade: 0,
          data: prazo.toISOString(),
          nome: lead.nome,
        });
      }
    }
  });

  return notificacoes.sort(function (a, b) {
    if (a.prioridade !== b.prioridade) return a.prioridade - b.prioridade;
    return String(a.data).localeCompare(String(b.data));
  });
}

function renderizarNotificacoes() {
  if (!listaNotificacoes) return;

  const notificacoes = notificacoesClientes();
  contadorNotificacoes.textContent = String(notificacoes.length);
  contadorNotificacoes.hidden = notificacoes.length === 0;
  resumoNotificacoes.textContent = notificacoes.length
    ? notificacoes.length + " pendência(s)"
    : "Tudo em dia";
  btnAbrirNotificacoes.classList.toggle("tem-pendencias", notificacoes.length > 0);
  listaNotificacoes.innerHTML = notificacoes.length
    ? notificacoes
        .slice(0, 8)
        .map(function (item) {
          return (
            '<button type="button" class="notificacao-item prioridade-' +
            item.prioridade +
            '" onclick="abrirNotificacaoCliente(' +
            item.id +
            ')"><span>' +
            escaparHTML(item.tipo) +
            "</span><strong>" +
            escaparHTML(item.nome || "Cliente") +
            "</strong><small>" +
            escaparHTML(item.detalhe) +
            "</small></button>"
          );
        })
        .join("")
    : '<p class="notificacoes-vazio">Nenhum retorno ou tarefa vencida.</p>';
}

function alternarPainelNotificacoes(forcarAberto) {
  if (!painelNotificacoes) return;

  const abrir =
    typeof forcarAberto === "boolean"
      ? forcarAberto
      : painelNotificacoes.hidden;
  painelNotificacoes.hidden = !abrir;
  btnAbrirNotificacoes.setAttribute("aria-expanded", String(abrir));
}

function abrirNotificacaoCliente(id) {
  alternarPainelNotificacoes(false);
  abrirAbaAdmin("clientes");
  abrirFichaCliente(id);
}

const cadastrosRecolhiveis = [
  {
    formId: "form-carro",
    label: "Cadastrar novo veículo",
    titleId: "admin-form-titulo",
  },
  {
    formId: "form-lead",
    label: "Cadastrar novo cliente",
    modal: true,
    hideTrigger: true,
  },
  {
    formId: "form-vendedor",
    label: "Cadastrar novo vendedor",
  },
  {
    formId: "form-depoimento",
    label: "Cadastrar novo depoimento",
    titleId: "depoimento-form-titulo",
  },
  {
    formId: "form-parceria",
    label: "Cadastrar nova parceria",
    titleId: "parceria-form-titulo",
  },
  {
    formId: "form-saida-financeira",
    label: "Cadastrar nova saída",
  },
];

function configurarCadastrosRecolhiveis() {
  cadastrosRecolhiveis.forEach(function (config) {
    const formulario = document.getElementById(config.formId);

    if (!formulario || formulario.closest(".cadastro-recolhivel")) return;

    const wrapper = document.createElement("section");
    const botao = document.createElement("button");
    const titulo = config.titleId
      ? document.getElementById(config.titleId)
      : null;

    wrapper.className = config.modal
      ? "cadastro-recolhivel cadastro-recolhivel-modal"
      : "cadastro-recolhivel";
    wrapper.dataset.cadastro = config.formId;
    botao.type = "button";
    botao.className = "btn-primary cadastro-recolhivel-botao";
    botao.textContent = config.label;
    botao.setAttribute("aria-expanded", "false");
    botao.setAttribute("aria-controls", config.formId);

    formulario.parentNode.insertBefore(wrapper, formulario);
    if (!config.hideTrigger) wrapper.appendChild(botao);
    if (titulo) wrapper.appendChild(titulo);

    if (config.modal) {
      const overlay = document.createElement("div");
      const card = document.createElement("div");
      const botaoFechar = document.createElement("button");

      overlay.className = "cadastro-modal-overlay";
      overlay.setAttribute("aria-hidden", "true");
      card.className = "cadastro-modal-card";
      card.setAttribute("role", "dialog");
      card.setAttribute("aria-modal", "true");
      card.setAttribute("aria-labelledby", "lead-form-titulo");
      botaoFechar.type = "button";
      botaoFechar.className = "admin-modal-fechar cadastro-modal-fechar";
      botaoFechar.setAttribute("aria-label", "Fechar cadastro");
      botaoFechar.textContent = "×";

      wrapper.appendChild(overlay);
      overlay.appendChild(card);
      card.appendChild(botaoFechar);
      card.appendChild(formulario);

      overlay.addEventListener("click", function (evento) {
        if (evento.target === overlay) fecharCadastroAdmin(config.formId);
      });
      botaoFechar.addEventListener("click", function () {
        fecharCadastroAdmin(config.formId);
      });
    } else {
      wrapper.appendChild(formulario);
    }

    formulario.hidden = true;
    if (titulo) titulo.hidden = true;

    if (!config.hideTrigger) {
      botao.addEventListener("click", function () {
        const aberto = wrapper.classList.contains("aberto");

        if (aberto) {
          fecharCadastroAdmin(config.formId);
        } else {
          abrirCadastroAdmin(config.formId);
        }
      });
    }
  });
}

function abrirCadastroAdmin(formId) {
  const wrapper = document.querySelector(
    '.cadastro-recolhivel[data-cadastro="' + formId + '"]'
  );

  if (!wrapper) return;

  const formulario = document.getElementById(formId);
  const botao = wrapper.querySelector(".cadastro-recolhivel-botao");
  const titulo = wrapper.querySelector("h2");
  const overlay = wrapper.querySelector(".cadastro-modal-overlay");
  const config = cadastrosRecolhiveis.find(function (item) {
    return item.formId === formId;
  });

  wrapper.classList.add("aberto");
  formulario.hidden = false;
  if (overlay) overlay.setAttribute("aria-hidden", "false");
  if (titulo) titulo.hidden = false;
  if (botao) {
    botao.textContent = config && config.modal ? config.label : "Fechar cadastro";
    botao.setAttribute("aria-expanded", "true");
  }
  if (config && config.modal) {
    document.body.classList.add("modal-aberto");
  } else {
    wrapper.scrollIntoView({ behavior: "smooth", block: "start" });
  }

  const primeiroCampo = formulario.querySelector(
    'input:not([type="hidden"]), select, textarea'
  );
  if (primeiroCampo) primeiroCampo.focus({ preventScroll: true });
}

function fecharCadastroAdmin(formId) {
  const wrapper = document.querySelector(
    '.cadastro-recolhivel[data-cadastro="' + formId + '"]'
  );

  if (!wrapper) return;

  const config = cadastrosRecolhiveis.find(function (item) {
    return item.formId === formId;
  });
  const formulario = document.getElementById(formId);
  const botao = wrapper.querySelector(".cadastro-recolhivel-botao");
  const titulo = wrapper.querySelector("h2");
  const overlay = wrapper.querySelector(".cadastro-modal-overlay");

  wrapper.classList.remove("aberto");
  formulario.hidden = true;
  if (overlay) overlay.setAttribute("aria-hidden", "true");
  if (titulo) titulo.hidden = true;
  if (botao) {
    botao.textContent = config ? config.label : "Abrir cadastro";
    botao.setAttribute("aria-expanded", "false");
  }
  if (config && config.modal) document.body.classList.remove("modal-aberto");
}

function renderizarSolicitacoesFinanciamento() {
  if (!listaSolicitacoesFinanciamento) return;

  if (!solicitacoesFinanciamentoAdmin.length) {
    listaSolicitacoesFinanciamento.innerHTML =
      '<p class="sem-resultados">Nenhuma solicitação de financiamento recebida.</p>';
    return;
  }

  listaSolicitacoesFinanciamento.innerHTML = solicitacoesFinanciamentoAdmin
    .map(function (item) {
      const documentos = Array.isArray(item.documents) ? item.documents : [];
      return (
        '<article class="admin-item financiamento-admin-card">' +
        '<div><h4>' + escaparHTML(item.customer_name || "Cliente") + '</h4>' +
        '<p>' + escaparHTML(item.cpf || "") + " · " + escaparHTML(item.phone || "") + '</p>' +
        '<small>Protocolo: <strong>' + escaparHTML(item.protocol || "Não gerado") + '</strong></small>' +
        '<small>' + documentos.length + ' documento(s) enviado(s)</small></div>' +
        '<label>Status<select onchange="atualizarStatusFinanciamento(' + Number(item.id) + ', this.value)">' +
        ["Recebida", "Em análise", "Documentação pendente", "Aprovada", "Recusada"]
          .map(function (status) {
            return '<option value="' + status + '"' +
              (item.status === status ? " selected" : "") + ">" + status + "</option>";
          }).join("") +
        '</select></label></article>'
      );
    })
    .join("");
}

async function carregarSolicitacoesFinanciamento() {
  if (!listaSolicitacoesFinanciamento) return;

  try {
    const resposta = await fetch("/api/financing-applications", {
      headers: { Accept: "application/json" },
    });
    if (!resposta.ok) throw new Error();
    solicitacoesFinanciamentoAdmin = (await resposta.json()).data || [];
    renderizarSolicitacoesFinanciamento();
    if (clienteModalId) {
      const leadAberto = leadsAdmin.find(function (lead) {
        return Number(lead.id) === Number(clienteModalId);
      });
      if (leadAberto) renderizarFinanciamentosCliente(leadAberto);
    }
  } catch (error) {
    listaSolicitacoesFinanciamento.innerHTML =
      '<p class="sem-resultados">Não foi possível carregar as solicitações.</p>';
  }
}

async function atualizarStatusFinanciamento(id, status) {
  const resposta = await fetch("/api/financing-applications/" + id, {
    method: "PUT",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
    },
    body: JSON.stringify({ status: status }),
  });

  if (!resposta.ok) {
    alert("Não foi possível atualizar a análise.");
    return;
  }

  await carregarSolicitacoesFinanciamento();
}

function gerarIdUnico(listas) {
  const ids = listas
    .flat()
    .map(function (item) {
      return Number(item.id) || 0;
    });
  let id = Date.now();

  while (ids.indexOf(id) !== -1) {
    id += 1;
  }

  return id;
}

function preencherMarcasAdmin() {
  marcasDisponiveis.forEach(function (marca) {
    const option = document.createElement("option");
    option.value = marca;
    option.textContent = marca;
    selectMarca.appendChild(option);
  });
}

function atualizarDashboardTexto(id, valor) {
  const elemento = document.getElementById(id);

  if (elemento) {
    elemento.textContent = valor;
  }
}

function hexParaRgbCss(hex) {
  const limpo = String(hex || "").replace("#", "");

  if (limpo.length !== 6) return "";

  return [
    parseInt(limpo.slice(0, 2), 16),
    parseInt(limpo.slice(2, 4), 16),
    parseInt(limpo.slice(4, 6), 16),
  ].join(", ");
}

function getMetricColor(type, value) {
  const numericValue = Number(value) || 0;

  if (type === "resultadoLiquido") {
    if (numericValue > 0) return "#16A34A";
    if (numericValue < 0) return "#DC2626";
    return "#64748B";
  }

  if (type === "receitaVendida") {
    return "#2563EB";
  }

  if (type === "lucroBruto") {
    if (numericValue > 0) return "#15803D";
    if (numericValue < 0) return "#DC2626";
    return "#64748B";
  }

  if (type === "saidas") {
    return "#DC2626";
  }

  if (type === "estoqueAnunciado") {
    return "#475569";
  }

  if (type === "ticketMedio") {
    return "#2563EB";
  }

  if (type === "entradaCaixa") {
    return numericValue > 0 ? "#16A34A" : "#64748B";
  }

  if (type === "valorTrocas") {
    return numericValue > 0 ? "#EA580C" : "#64748B";
  }

  if (type === "saldoReceber") {
    return numericValue > 0 ? "#D97706" : "#64748B";
  }

  return "#2563EB";
}

function aplicarCorMetricaFinanceira(id, type, value) {
  const elemento = document.getElementById(id);

  if (!elemento) return;

  const cor = getMetricColor(type, value);
  const card = elemento.closest(".financeiro-kpi-card");
  const corRgb = hexParaRgbCss(cor);

  elemento.style.color = cor;

  if (card) {
    card.style.setProperty("--fin-kpi", cor);
    if (corRgb) {
      card.style.setProperty("--fin-kpi-rgb", corRgb);
    }
  }
}

function requisicaoAdminApi(metodo, caminho, dados) {
  if (window.location.protocol === "file:") return null;

  try {
    const requisicao = new XMLHttpRequest();
    requisicao.open(metodo, "/api" + caminho, false);
    requisicao.setRequestHeader("Accept", "application/json");

    if (dados !== undefined) {
      requisicao.setRequestHeader("Content-Type", "application/json");

      const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

      if (tokenCsrf) {
        requisicao.setRequestHeader("X-CSRF-TOKEN", tokenCsrf.content);
      }
    }

    requisicao.send(dados === undefined ? null : JSON.stringify(dados));

    if (requisicao.status < 200 || requisicao.status >= 300) {
      return null;
    }

    return requisicao.responseText ? JSON.parse(requisicao.responseText) : {};
  } catch (error) {
    return null;
  }
}

function requisicaoLaravel(metodo, caminho, dados) {
  try {
    const requisicao = new XMLHttpRequest();
    requisicao.open(metodo, caminho, false);
    requisicao.setRequestHeader("Accept", "application/json");
    requisicao.setRequestHeader("Content-Type", "application/json");

    const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

    if (tokenCsrf) {
      requisicao.setRequestHeader("X-CSRF-TOKEN", tokenCsrf.content);
    }

    requisicao.send(JSON.stringify(dados || {}));

    let resposta = {};

    if (requisicao.responseText) {
      resposta = JSON.parse(requisicao.responseText);
    }

    return {
      ok: requisicao.status >= 200 && requisicao.status < 300,
      data: resposta,
    };
  } catch (error) {
    return {
      ok: false,
      data: { message: "Não foi possível comunicar com o servidor." },
    };
  }
}

function carregarSaidasFinanceiras() {
  const respostaApi = requisicaoAdminApi("GET", "/finance/expenses");

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("saidasFinanceiras", JSON.stringify(respostaApi.data));
      snapshotSaidasFinanceiras = copiarListaAdmin(respostaApi.data);
      return respostaApi.data;
    }

    try {
      const locais = JSON.parse(localStorage.getItem("saidasFinanceiras"));

      if (Array.isArray(locais) && locais.length > 0) {
        const importacao = requisicaoAdminApi("PUT", "/finance/expenses/sync", {
          expenses: locais,
        });

        if (importacao && Array.isArray(importacao.data)) {
          snapshotSaidasFinanceiras = copiarListaAdmin(importacao.data);
          return importacao.data;
        }
      }
    } catch (error) {
      localStorage.removeItem("saidasFinanceiras");
    }
  }

  try {
    const salvas = JSON.parse(localStorage.getItem("saidasFinanceiras"));
    snapshotSaidasFinanceiras = copiarListaAdmin(salvas);
    return Array.isArray(salvas) ? salvas : [];
  } catch (error) {
    localStorage.removeItem("saidasFinanceiras");
    return [];
  }
}

function salvarSaidasFinanceiras() {
  localStorage.setItem("saidasFinanceiras", JSON.stringify(saidasFinanceiras));
  persistirListaAdminCrud(
    "saidasFinanceiras",
    "/finance/expenses",
    snapshotSaidasFinanceiras,
    saidasFinanceiras
  );
  snapshotSaidasFinanceiras = copiarListaAdmin(saidasFinanceiras);
}

function carregarVendedores() {
  const respostaApi = requisicaoAdminApi("GET", "/finance/sellers");

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("vendedores", JSON.stringify(respostaApi.data));
      snapshotVendedores = copiarListaAdmin(respostaApi.data);
      return respostaApi.data;
    }

    try {
      const locais = JSON.parse(localStorage.getItem("vendedores"));

      if (Array.isArray(locais) && locais.length > 0) {
        const importacao = requisicaoAdminApi("PUT", "/finance/sellers/sync", {
          sellers: locais,
        });

        if (importacao && Array.isArray(importacao.data)) {
          snapshotVendedores = copiarListaAdmin(importacao.data);
          return importacao.data;
        }
      }
    } catch (error) {
      localStorage.removeItem("vendedores");
    }
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("vendedores"));
    snapshotVendedores = copiarListaAdmin(salvos);
    return Array.isArray(salvos) ? salvos : [];
  } catch (error) {
    localStorage.removeItem("vendedores");
    return [];
  }
}

function salvarVendedores() {
  localStorage.setItem("vendedores", JSON.stringify(vendedoresAdmin));
  persistirListaAdminCrud(
    "vendedores",
    "/finance/sellers",
    snapshotVendedores,
    vendedoresAdmin
  );
  snapshotVendedores = copiarListaAdmin(vendedoresAdmin);
}

function carregarLeadsAdmin() {
  const respostaApi = requisicaoAdminApi("GET", "/leads");

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("leadsClientes", JSON.stringify(respostaApi.data));
      snapshotLeads = copiarListaAdmin(respostaApi.data);
      return respostaApi.data;
    }

    try {
      const locais = JSON.parse(localStorage.getItem("leadsClientes"));

      if (Array.isArray(locais) && locais.length > 0) {
        const importacao = requisicaoAdminApi("PUT", "/leads/sync", {
          leads: locais,
        });

        if (importacao && Array.isArray(importacao.data)) {
          snapshotLeads = copiarListaAdmin(importacao.data);
          return importacao.data;
        }
      }
    } catch (error) {
      localStorage.removeItem("leadsClientes");
    }
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("leadsClientes"));
    snapshotLeads = copiarListaAdmin(salvos);
    return Array.isArray(salvos) ? salvos : [];
  } catch (error) {
    localStorage.removeItem("leadsClientes");
    return [];
  }
}

function salvarLeadsAdmin() {
  localStorage.setItem("leadsClientes", JSON.stringify(leadsAdmin));
  persistirListaAdminCrud(
    "leadsClientes",
    "/leads",
    snapshotLeads,
    leadsAdmin
  );
  snapshotLeads = copiarListaAdmin(leadsAdmin);
}

function copiarListaAdmin(lista) {
  return JSON.parse(JSON.stringify(Array.isArray(lista) ? lista : []));
}

function persistirListaAdminCrud(chave, caminhoBase, anterior, proximo) {
  if (window.location.protocol === "file:") return;

  const anterioresPorId = new Map(
    anterior.map(function (item) {
      return [Number(item.id), item];
    })
  );
  const proximosPorId = new Map(
    proximo.map(function (item) {
      return [Number(item.id), item];
    })
  );
  const operacoes = [];

  proximo.forEach(function (item) {
    const id = Number(item.id);
    const existente = anterioresPorId.get(id);

    if (!existente) {
      operacoes.push({ metodo: "POST", caminho: caminhoBase, dados: item });
    } else if (JSON.stringify(existente) !== JSON.stringify(item)) {
      operacoes.push({
        metodo: "PUT",
        caminho: caminhoBase + "/" + encodeURIComponent(id),
        dados: item,
      });
    }
  });

  anterior.forEach(function (item) {
    const id = Number(item.id);

    if (id && !proximosPorId.has(id)) {
      operacoes.push({
        metodo: "DELETE",
        caminho: caminhoBase + "/" + encodeURIComponent(id),
      });
    }
  });

  operacoes.forEach(function (operacao) {
    enfileirarCrudAdmin(chave, operacao);
  });
}

function enfileirarCrudAdmin(chave, operacao) {
  filasCrudAdmin[chave] = (filasCrudAdmin[chave] || Promise.resolve())
    .then(function () {
      return requisicaoAdminApiAssincrona(
        operacao.metodo,
        operacao.caminho,
        operacao.dados
      );
    })
    .then(function (resposta) {
      if (!resposta || !resposta.data) return;

      const salvos = JSON.parse(localStorage.getItem(chave) || "[]");
      const atualizados = salvos.map(function (item) {
        return Number(item.id) === Number(resposta.data.id)
          ? resposta.data
          : item;
      });

      localStorage.setItem(chave, JSON.stringify(atualizados));
    })
    .catch(function (error) {
      console.error("Falha ao persistir " + chave + ":", error);
      window.dispatchEvent(
        new CustomEvent("persistenciaAdminFalhou", {
          detail: { recurso: chave, mensagem: error.message },
        })
      );
    });
}

function requisicaoAdminApiAssincrona(metodo, caminho, dados) {
  const headers = {
    Accept: "application/json",
  };
  const tokenCsrf = document.querySelector('meta[name="csrf-token"]');

  if (dados !== undefined) {
    headers["Content-Type"] = "application/json";
  }

  if (tokenCsrf) {
    headers["X-CSRF-TOKEN"] = tokenCsrf.content;
  }

  return fetch("/api" + caminho, {
    method: metodo,
    headers: headers,
    body: dados === undefined ? undefined : JSON.stringify(dados),
    credentials: "same-origin",
  }).then(function (resposta) {
    if (!resposta.ok) {
      return resposta
        .json()
        .catch(function () {
          return {};
        })
        .then(function (erro) {
          throw new Error(erro.message || "Erro " + resposta.status);
        });
    }

    return resposta.status === 204 ? {} : resposta.json();
  });
}

function carregarHistoricoVeiculos() {
  const respostaApi = requisicaoAdminApi("GET", "/vehicle-histories");

  if (respostaApi && Array.isArray(respostaApi.data)) {
    if (respostaApi.data.length > 0) {
      localStorage.setItem("historicoVeiculos", JSON.stringify(respostaApi.data));
      return respostaApi.data;
    }

    try {
      const locais = JSON.parse(localStorage.getItem("historicoVeiculos"));

      if (Array.isArray(locais) && locais.length > 0) {
        const importacao = requisicaoAdminApi("PUT", "/vehicle-histories/sync", {
          histories: locais,
        });

        if (importacao && Array.isArray(importacao.data)) {
          return importacao.data;
        }
      }
    } catch (error) {
      localStorage.removeItem("historicoVeiculos");
    }
  }

  try {
    const salvos = JSON.parse(localStorage.getItem("historicoVeiculos"));
    return Array.isArray(salvos) ? salvos : [];
  } catch (error) {
    localStorage.removeItem("historicoVeiculos");
    return [];
  }
}

function salvarHistoricoVeiculos() {
  localStorage.setItem("historicoVeiculos", JSON.stringify(historicoVeiculosAdmin));

  const respostaApi = requisicaoAdminApi("PUT", "/vehicle-histories/sync", {
    histories: historicoVeiculosAdmin,
  });

  if (respostaApi && Array.isArray(respostaApi.data)) {
    historicoVeiculosAdmin = respostaApi.data;
    localStorage.setItem("historicoVeiculos", JSON.stringify(historicoVeiculosAdmin));
  }
}

function registrarHistoricoVeiculo(carroId, tipo, descricao, extras) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(carroId);
  });
  const registro = {
    id: gerarIdUnico([historicoVeiculosAdmin, carrosAdmin, saidasFinanceiras, leadsAdmin]),
    carroId: Number(carroId) || "",
    carroNome: carro ? carro.nome : extras && extras.carroNome ? extras.carroNome : "",
    tipo: tipo,
    descricao: descricao,
    data: new Date().toISOString(),
    extras: extras || {},
  };

  historicoVeiculosAdmin.unshift(registro);
  salvarHistoricoVeiculos();
}

function saidaNoMesFinanceiro(saida, mes) {
  if (!mes) return true;

  return String(saida.data || "").slice(0, 7) === mes;
}

function formatarDataBR(data) {
  if (!data) return "Sem data";

  const partes = String(data).split("-");

  if (partes.length !== 3) return data;

  return partes[2] + "/" + partes[1] + "/" + partes[0];
}

function diasDesde(data) {
  if (!data) return 0;

  const inicio = new Date(data + "T00:00:00");
  const hoje = new Date();

  if (Number.isNaN(inicio.getTime())) return 0;

  return Math.max(Math.floor((hoje - inicio) / 86400000), 0);
}

function listarResumo(container, itens, vazio) {
  if (!container) return;

  container.innerHTML = itens.length
    ? itens
        .map(function (item) {
          return (
            '<div class="analytics-lista-item">' +
            '<span class="analytics-nome">' +
            escaparHTML(item.rotulo) +
            "</span>" +
            "<strong>" +
            escaparHTML(item.valor) +
            "</strong>" +
            "</div>"
          );
        })
        .join("")
    : '<div class="analytics-lista-item"><span class="analytics-nome">' +
      escaparHTML(vazio) +
      "</span></div>";
}

function renderizarDashboard() {
  const disponiveis = carrosAdmin.filter(function (carro) {
    return carro.status === "Disponível";
  }).length;
  const reservados = carrosAdmin.filter(function (carro) {
    return carro.status === "Reservado";
  }).length;
  const vendidos = carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido";
  }).length;
  const ofertas = carrosAdmin.filter(function (carro) {
    return carro.oferta && carro.status !== "Vendido";
  }).length;
  const parceriasVisiveis = parceriasAdmin.filter(function (parceria) {
    return parceria.ativo;
  }).length;

  atualizarDashboardTexto("dash-total-veiculos", carrosAdmin.length);
  atualizarDashboardTexto("dash-disponiveis", disponiveis);
  atualizarDashboardTexto("dash-reservados", reservados);
  atualizarDashboardTexto("dash-vendidos", vendidos);
  atualizarDashboardTexto("dash-ofertas", ofertas);
  atualizarDashboardTexto("dash-depoimentos", depoimentosAdmin.length);
  atualizarDashboardTexto("dash-parcerias", parceriasVisiveis);
  renderizarNotificacoes();

  const mesAtual = new Date().toISOString().slice(0, 7);
  const vendidosMes = carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido" && carroNoMesFinanceiro(carro, mesAtual);
  });
  const saldoReceber = vendidosMes.reduce(function (total, carro) {
    return total + (Number(carro.saldoReceber) || 0);
  }, 0);
  const lucroMes = vendidosMes.reduce(function (total, carro) {
    return total + lucroCarro(carro);
  }, 0);
  const alertas = [];
  const backupUltimo = localStorage.getItem("ultimoBackupAdmin");

  if (saldoReceber > 0) {
    alertas.push({ rotulo: "Saldo a receber no mês", valor: formatarMoeda(saldoReceber) });
  }

  if (lucroMes < 0) {
    alertas.push({ rotulo: "Resultado do mês negativo", valor: formatarMoeda(lucroMes) });
  }

  if (!backupUltimo || diasDesde(backupUltimo) >= 7) {
    alertas.push({ rotulo: "Backup recomendado", valor: backupUltimo ? diasDesde(backupUltimo) + " dias" : "Nunca feito" });
  }

  const preparacaoPendente = carrosAdmin.filter(function (carro) {
    return carro.status !== "Vendido" && carro.preparacaoStatus !== "Pronto para venda";
  }).length;

  if (preparacaoPendente) {
    alertas.push({ rotulo: "Veículos em preparação", valor: String(preparacaoPendente) });
  }

  listarResumo(dashAlertasExecutivos, alertas, "Nenhum alerta crítico agora.");

  const hoje = new Date().toISOString().slice(0, 10);
  const proximos = leadsAdmin
    .filter(function (lead) {
      return lead.proximoContato && lead.status !== "Fechado" && lead.status !== "Perdido";
    })
    .sort(function (a, b) {
      return String(a.proximoContato).localeCompare(String(b.proximoContato));
    })
    .slice(0, 5)
    .map(function (lead) {
      return {
        rotulo: lead.nome + (lead.proximoContato < hoje ? " (atrasado)" : ""),
        valor: formatarDataBR(lead.proximoContato),
      };
    });

  listarResumo(dashProximosContatos, proximos, "Nenhum próximo contato agendado.");

  const parados = carrosAdmin
    .filter(function (carro) {
      return carro.status !== "Vendido";
    })
    .map(function (carro) {
      return {
        carro: carro,
        dias: diasDesde(carro.dataEntrada || carro.criadoEm || ""),
      };
    })
    .filter(function (item) {
      return item.dias >= 30;
    })
    .sort(function (a, b) {
      return b.dias - a.dias;
    })
    .slice(0, 5)
    .map(function (item) {
      return { rotulo: item.carro.nome, valor: item.dias + " dias" };
    });

  listarResumo(dashEstoqueParado, parados, "Nenhum veículo parado há mais de 30 dias.");
}

function carroInstagramSelecionado() {
  const id = Number(selectInstagramCarro.value);

  return (
    carrosAdmin.find(function (carro) {
      return Number(carro.id) === id;
    }) ||
    carrosAdmin.find(function (carro) {
      return carro.status !== "Vendido";
    }) ||
    carrosAdmin[0]
  );
}

function preencherCarrosInstagram() {
  if (!selectInstagramCarro) return;

  const valorAtual = selectInstagramCarro.value;
  selectInstagramCarro.innerHTML = '<option value="">Selecione um veículo</option>';

  carrosAdmin.forEach(function (carro) {
    const option = document.createElement("option");
    option.value = carro.id;
    option.textContent = carro.nome + " - " + carro.preco;
    selectInstagramCarro.appendChild(option);
  });

  if (
    valorAtual &&
    carrosAdmin.some(function (carro) {
      return Number(carro.id) === Number(valorAtual);
    })
  ) {
    selectInstagramCarro.value = valorAtual;
  } else if (carrosAdmin[0]) {
    selectInstagramCarro.value = carrosAdmin[0].id;
  }

  atualizarCamposInstagram(carroInstagramSelecionado());
}

function corInstagram() {
  const cores = {
    amarelo: {
      destaque: "#facc15",
      botao: "#facc15",
      textoBotao: "#111827",
      selo: "#dc2626",
    },
    verde: {
      destaque: "#22c55e",
      botao: "#22c55e",
      textoBotao: "#052e16",
      selo: "#16a34a",
    },
    vermelho: {
      destaque: "#ef4444",
      botao: "#ef4444",
      textoBotao: "#ffffff",
      selo: "#b91c1c",
    },
    azul: {
      destaque: "#38bdf8",
      botao: "#38bdf8",
      textoBotao: "#082f49",
      selo: "#0369a1",
    },
  };

  return cores[selectInstagramCor.value] || cores.amarelo;
}

function chamadaPadraoInstagram(carro) {
  const tom = selectInstagramTom.value;

  if (tom === "premium") {
    return "VEÍCULO SELECIONADO";
  }

  if (tom === "urgente") {
    return carro.oferta ? "OFERTA DA SEMANA" : "CONSULTE CONDIÇÕES";
  }

  return "CHAME NO WHATSAPP";
}

function atualizarCamposInstagram(carro) {
  if (!carro) return;

  inputInstagramTitulo.value = carro.nome;
  inputInstagramCta.value = chamadaPadraoInstagram(carro);
  textareaInstagramLegenda.value = legendaInstagram(carro);
}

function legendaInstagram(carro) {
  const tom = selectInstagramTom.value;
  const cta = inputInstagramCta.value.trim() || chamadaPadraoInstagram(carro);
  const config = carregarConfigLoja();
  const linhasBase = [
    carro.nome,
    "",
    "Ano: " + carro.ano,
    "Km: " + carro.km,
    "Câmbio: " + carro.cambio,
    "Combustível: " + carro.combustivel,
    "Cor: " + carro.cor,
    "Preço: " + carro.preco,
  ];
  const chamada =
    tom === "premium"
      ? "Uma opção selecionada para quem busca qualidade, procedência e apresentação impecável."
      : tom === "urgente"
        ? "Oferta disponível por tempo limitado. Chame agora e consulte as condições."
        : "Gostou? Chame a equipe e receba mais fotos, vídeo e condições de negociação.";

  return [
    carro.nome,
    "",
    chamada,
    "",
    linhasBase.slice(2).join("\n"),
    "",
    cta + ".",
    "Atendimento pelo WhatsApp.",
    config.instagram ? config.instagram : "",
    "",
    "#carros #seminovos #veiculos #multimarcas #financiamento #troca #automoveis",
  ]
    .filter(function (linha) {
      return linha !== "";
    })
    .join("\n");
}

function quebrarTextoCanvas(ctx, texto, x, y, larguraMax, alturaLinha, maxLinhas) {
  const palavras = String(texto).split(" ");
  let linha = "";
  let linhas = 0;

  for (let i = 0; i < palavras.length; i++) {
    const teste = linha + palavras[i] + " ";

    if (ctx.measureText(teste).width > larguraMax && i > 0) {
      ctx.fillText(linha.trim(), x, y);
      linha = palavras[i] + " ";
      y += alturaLinha;
      linhas += 1;

      if (linhas >= maxLinhas - 1) break;
    } else {
      linha = teste;
    }
  }

  if (linha && linhas < maxLinhas) {
    ctx.fillText(linha.trim(), x, y);
  }
}

function vendedorPorId(id) {
  return vendedoresAdmin.find(function (vendedor) {
    return Number(vendedor.id) === Number(id);
  });
}

function preencherVendedoresVenda() {
  if (!selectVendedorVenda) return;

  const valorAtual = selectVendedorVenda.value;
  selectVendedorVenda.innerHTML = '<option value="">Vendedor da venda</option>';

  vendedoresAdmin
    .filter(function (vendedor) {
      return vendedor.ativo !== false;
    })
    .forEach(function (vendedor) {
      const option = document.createElement("option");
      option.value = vendedor.id;
      option.textContent = vendedor.nome;
      selectVendedorVenda.appendChild(option);
    });

  if (
    valorAtual &&
    Array.from(selectVendedorVenda.options).some(function (option) {
      return option.value === valorAtual;
    })
  ) {
    selectVendedorVenda.value = valorAtual;
  }
}

function preencherSelectsVeiculosOperacionais() {
  const opcoes = carrosAdmin
    .slice()
    .sort(function (a, b) {
      return String(a.nome || "").localeCompare(String(b.nome || ""));
    })
    .map(function (carro) {
      return (
        '<option value="' +
        escaparAtributo(carro.id) +
        '">' +
        escaparHTML(carro.nome) +
        " - " +
        escaparHTML(carro.status || "Sem status") +
        "</option>"
      );
    })
    .join("");

  if (selectSaidaVeiculo) {
    const valorAtual = selectSaidaVeiculo.value;
    selectSaidaVeiculo.innerHTML =
      '<option value="">Gasto geral da loja</option>' + opcoes;
    selectSaidaVeiculo.value = valorAtual;
  }

  if (selectLeadVeiculo) {
    const valorAtual = selectLeadVeiculo.value;
    selectLeadVeiculo.innerHTML =
      '<option value="">Sem veículo definido</option>' + opcoes;
    selectLeadVeiculo.value = valorAtual;
  }

  if (selectHistoricoVeiculo) {
    const valorAtual = selectHistoricoVeiculo.value;
    selectHistoricoVeiculo.innerHTML =
      '<option value="">Todos os veículos</option>' + opcoes;
    selectHistoricoVeiculo.value = valorAtual;
  }
}

function carregarImagemCanvas(src) {
  return new Promise(function (resolve) {
    const img = new Image();
    img.crossOrigin = "anonymous";

    img.onload = function () {
      resolve(img);
    };

    img.onerror = function () {
      resolve(null);
    };

    img.src = src;
  });
}

function ajustarFonteCanvas(ctx, texto, tamanhoInicial, tamanhoMinimo, larguraMax, peso) {
  let tamanho = tamanhoInicial;

  do {
    ctx.font = (peso || "900") + " " + tamanho + "px Arial";
    tamanho -= 1;
  } while (ctx.measureText(texto).width > larguraMax && tamanho > tamanhoMinimo);
}

function desenharImagemCapa(ctx, img, x, y, largura, altura) {
  const escala = Math.max(largura / img.width, altura / img.height);
  const larguraFinal = img.width * escala;
  const alturaFinal = img.height * escala;

  ctx.drawImage(
    img,
    x + (largura - larguraFinal) / 2,
    y + (altura - alturaFinal) / 2,
    larguraFinal,
    alturaFinal
  );
}

async function renderizarInstagram() {
  if (!canvasInstagram) return;

  const carro = carroInstagramSelecionado();
  const formato = selectInstagramFormato.value;
  const largura = 1080;
  const altura = formato === "story" ? 1920 : 1080;
  const ctx = canvasInstagram.getContext("2d");
  const config = carregarConfigLoja();
  const tema = corInstagram();
  const tituloArte = inputInstagramTitulo.value.trim() || (carro && carro.nome) || "";
  const ctaArte = inputInstagramCta.value.trim() || (carro ? chamadaPadraoInstagram(carro) : "");

  canvasInstagram.width = largura;
  canvasInstagram.height = altura;

  ctx.fillStyle = "#020617";
  ctx.fillRect(0, 0, largura, altura);

  if (!carro) {
    ctx.fillStyle = "#facc15";
    ctx.font = "700 44px Arial";
    ctx.fillText("Cadastre um veículo para gerar a arte.", 72, 160);
    textareaInstagramLegenda.value = "";
    return;
  }

  const imagem = await carregarImagemCanvas(carro.imagem);
  const imagemAltura = formato === "story" ? 1040 : 650;

  if (imagem) {
    desenharImagemCapa(ctx, imagem, 0, 0, largura, imagemAltura);
    ctx.fillStyle = "rgba(2, 6, 23, 0.42)";
    ctx.fillRect(0, 0, largura, imagemAltura);
  } else {
    ctx.fillStyle = "#1e293b";
    ctx.fillRect(0, 0, largura, imagemAltura);
  }

  const gradiente = ctx.createLinearGradient(0, imagemAltura - 220, 0, imagemAltura + 120);
  gradiente.addColorStop(0, "rgba(2, 6, 23, 0)");
  gradiente.addColorStop(1, "#020617");
  ctx.fillStyle = gradiente;
  ctx.fillRect(0, imagemAltura - 220, largura, 360);

  ctx.fillStyle = tema.destaque;
  ctx.fillRect(72, 72, 210, 10);
  ctx.font = "900 34px Arial";
  ctx.fillText(config.nome.toUpperCase(), 72, 132);

  if (carro.oferta || selectInstagramTom.value === "urgente") {
    const ofertaX = formato === "story" ? 700 : 760;
    const ofertaLargura = formato === "story" ? 308 : 248;
    const seloTexto = carro.oferta ? "OFERTA" : "CHAME JÁ";

    ctx.fillStyle = tema.selo;
    ctx.fillRect(ofertaX, 72, ofertaLargura, 72);
    ctx.fillStyle = "#ffffff";
    ctx.font = "900 34px Arial";
    ctx.textAlign = "center";
    ctx.fillText(seloTexto, ofertaX + ofertaLargura / 2, 120);
    ctx.textAlign = "left";
  }

  const layoutInstagram =
    formato === "story"
      ? {
          tituloY: 1120,
          precoY: 1390,
          metaY1: 1475,
          metaY2: 1530,
          ctaY: altura - 190,
          ctaAltura: 88,
          ctaFonte: "900 34px Arial",
          ctaTextoY: altura - 134,
        }
      : {
          tituloY: 690,
          precoY: 825,
          metaY1: 900,
          metaY2: 948,
          ctaY: 980,
          ctaAltura: 68,
          ctaFonte: "900 25px Arial",
          ctaTextoY: 1024,
        };

  ctx.fillStyle = "#ffffff";
  ctx.font = formato === "story" ? "900 66px Arial" : "900 58px Arial";
  quebrarTextoCanvas(ctx, tituloArte, 72, layoutInstagram.tituloY, 936, 68, 2);

  ctx.fillStyle = tema.destaque;
  ctx.font = formato === "story" ? "900 62px Arial" : "900 52px Arial";
  ctx.fillText(carro.preco, 72, layoutInstagram.precoY);

  ctx.fillStyle = "#e5e7eb";
  ctx.font = formato === "story" ? "700 32px Arial" : "700 28px Arial";
  ctx.fillText(
    carro.ano + "  |  " + carro.km + "  |  " + carro.cambio,
    72,
    layoutInstagram.metaY1
  );
  ctx.fillText(
    carro.combustivel + "  |  " + carro.cor + "  |  " + carro.tipo,
    72,
    layoutInstagram.metaY2
  );

  ctx.fillStyle = tema.botao;
  ctx.fillRect(72, layoutInstagram.ctaY, 936, layoutInstagram.ctaAltura);
  ctx.fillStyle = tema.textoBotao;
  ctx.textAlign = "center";
  ajustarFonteCanvas(
    ctx,
    ctaArte.toUpperCase(),
    formato === "story" ? 34 : 25,
    18,
    840,
    "900"
  );
  ctx.fillText(
    ctaArte.toUpperCase(),
    largura / 2,
    layoutInstagram.ctaTextoY
  );
  ctx.textAlign = "left";

  linkInstagramWhatsapp.href = criarLinkWhatsApp(
    "Olá, quero publicar ou impulsionar este anúncio no Instagram:\n\n" +
      textareaInstagramLegenda.value
  );
}

function mostrarRetornoInstagram(texto, tipo) {
  retornoInstagram.textContent = texto;
  retornoInstagram.className =
    "admin-retorno " +
    (tipo === "erro" ? "admin-retorno-erro" : "admin-retorno-sucesso");
}

function formatarTempoAnalytics(segundos) {
  const total = Math.round(Number(segundos) || 0);
  const minutos = Math.floor(total / 60);
  const resto = total % 60;

  if (minutos <= 0) return resto + "s";

  return minutos + "m " + resto + "s";
}

function dataAnalytics(timestamp) {
  return new Date(timestamp).toISOString().slice(0, 10);
}

function incrementarMapa(mapa, chave, valor) {
  mapa[chave] = (mapa[chave] || 0) + (valor || 1);
}

function ordenarMapa(mapa) {
  return Object.keys(mapa)
    .map(function (chave) {
      return {
        chave: chave,
        valor: mapa[chave],
      };
    })
    .sort(function (a, b) {
      return b.valor - a.valor;
    });
}

function nomeVeiculoAnalytics(id) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  return carro ? carro.nome : "Veículo #" + id;
}

function renderizarListaAnalytics(container, itens, vazio) {
  if (!container) return;

  if (itens.length === 0) {
    container.innerHTML = '<p class="sem-resultados">' + vazio + "</p>";
    return;
  }

  container.innerHTML = itens
    .map(function (item) {
      return (
        '<div class="analytics-lista-item">' +
        "<span>" +
        escaparHTML(item.rotulo) +
        "</span>" +
        "<strong>" +
        escaparHTML(item.valor) +
        "</strong>" +
        "</div>"
      );
    })
    .join("");
}

function renderizarAnalyticsAdmin() {
  if (!graficoVisitas) return;

  const analytics = carregarAnalyticsSite();
  const visitas = analytics.visitas || [];
  const hoje = dataAnalytics(Date.now());
  const sessoes = visitas
    .map(function (visita) {
      return visita.sessao;
    })
    .filter(function (sessao, index, lista) {
      return sessao && lista.indexOf(sessao) === index;
    });
  const duracaoMedia = visitas.length
    ? visitas.reduce(function (total, visita) {
        return total + (Number(visita.duracao) || 0);
      }, 0) / visitas.length
    : 0;
  const paginas = {};
  const veiculos = {};
  const porDia = {};
  const dias = [];

  for (let i = 6; i >= 0; i--) {
    const data = new Date();
    data.setDate(data.getDate() - i);
    const chave = data.toISOString().slice(0, 10);
    dias.push(chave);
    porDia[chave] = 0;
  }

  visitas.forEach(function (visita) {
    incrementarMapa(paginas, visita.titulo || visita.pagina);

    if (visita.veiculoId) {
      incrementarMapa(veiculos, visita.veiculoId);
    }

    const dia = dataAnalytics(visita.inicio);

    if (porDia[dia] !== undefined) {
      porDia[dia] += 1;
    }
  });

  visitasTotal.textContent = visitas.length;
  visitasSessoes.textContent = sessoes.length;
  visitasTempo.textContent = formatarTempoAnalytics(duracaoMedia);
  visitasHoje.textContent = visitas.filter(function (visita) {
    return dataAnalytics(visita.inicio) === hoje;
  }).length;

  const maiorDia = Math.max.apply(null, dias.map(function (dia) {
    return porDia[dia];
  })) || 1;

  graficoVisitas.innerHTML = dias
    .map(function (dia) {
      const altura = Math.max(8, Math.round((porDia[dia] / maiorDia) * 150));
      const rotulo = dia.slice(5).split("-").reverse().join("/");

      return (
        '<div class="analytics-barra-item">' +
        '<div class="analytics-barra-valor">' +
        porDia[dia] +
        "</div>" +
        '<div class="analytics-barra" style="height:' +
        altura +
        'px"></div>' +
        "<span>" +
        rotulo +
        "</span>" +
        "</div>"
      );
    })
    .join("");

  renderizarListaAnalytics(
    paginasMaisVistas,
    ordenarMapa(paginas).slice(0, 6).map(function (item) {
      return {
        rotulo: item.chave,
        valor: item.valor + " visitas",
      };
    }),
    "Nenhuma página registrada ainda."
  );

  renderizarListaAnalytics(
    veiculosMaisVistos,
    ordenarMapa(veiculos).slice(0, 6).map(function (item) {
      return {
        rotulo: nomeVeiculoAnalytics(item.chave),
        valor: item.valor + " acessos",
      };
    }),
    "Nenhum veículo acessado ainda."
  );

  renderizarListaAnalytics(
    ultimasVisitas,
    visitas
      .slice(-8)
      .reverse()
      .map(function (visita) {
        return {
          rotulo: visita.titulo || visita.pagina,
          valor: new Date(visita.inicio).toLocaleString("pt-BR") + " | " + formatarTempoAnalytics(visita.duracao),
        };
      }),
    "Nenhuma visita registrada ainda."
  );
}

function abrirAbaAdmin(nomeAba) {
  adminTabs.forEach(function (tab) {
    tab.classList.toggle("ativa", tab.dataset.adminTab === nomeAba);
  });

  adminPanels.forEach(function (panel) {
    panel.classList.toggle("ativo", panel.dataset.adminPanel === nomeAba);
  });
}

function abasPermitidasPerfil(perfil) {
  if (perfil === "vendedor") {
    return ["resumo", "clientes", "sistema"];
  }

  if (perfil === "financeiro") {
    return ["resumo", "financeiro", "vendedores", "relatorios", "sistema"];
  }

  if (perfil === "estoque") {
    return ["resumo", "veiculos", "relatorios", "sistema"];
  }

  if (perfil === "marketing") {
    return ["resumo", "loja", "instagram", "depoimentos", "parcerias", "visitas", "sistema"];
  }

  return [
    "resumo",
    "loja",
    "veiculos",
    "instagram",
    "depoimentos",
    "parcerias",
    "financeiro",
    "vendedores",
    "clientes",
    "relatorios",
    "visitas",
    "sistema",
  ];
}

function aplicarPerfilAdmin() {
  const perfil = (metaAdminRole && metaAdminRole.content) || "gestor";
  const permitidas = abasPermitidasPerfil(perfil);

  if (selectPerfilAdmin) {
    selectPerfilAdmin.value = perfil;
  }

  adminTabs.forEach(function (tab) {
    tab.hidden = permitidas.indexOf(tab.dataset.adminTab) === -1;
  });

  const abaAtual = Array.from(adminPanels).find(function (panel) {
    return panel.classList.contains("ativo");
  });

  if (abaAtual && permitidas.indexOf(abaAtual.dataset.adminPanel) === -1) {
    abrirAbaAdmin(permitidas[0]);
  }
}

function reduzirImagem(file, callback) {
  const reader = new FileReader();

  reader.onload = function (e) {
    const img = new Image();
    img.src = e.target.result;

    img.onload = function () {
      const canvas = document.createElement("canvas");
      const maxWidth = 700;
      const scale = Math.min(1, maxWidth / img.width);

      canvas.width = img.width * scale;
      canvas.height = img.height * scale;

      const ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

      callback(canvas.toDataURL("image/jpeg", 0.75));
    };
  };

  reader.readAsDataURL(file);
}

function reduzirImagemPromise(file) {
  return new Promise(function (resolve) {
    reduzirImagem(file, resolve);
  });
}

function carregarFormularioLoja() {
  const config = carregarConfigLoja();

  document.getElementById("loja-nome").value = config.nome;
  document.getElementById("loja-subtitulo").value = config.subtitulo;
  document.getElementById("loja-whatsapp").value = config.whatsapp;
  document.getElementById("loja-endereco").value = config.endereco;
  document.getElementById("loja-horario").value = config.horario;
  document.getElementById("loja-instagram").value = config.instagram;
  document.getElementById("loja-email").value = config.email;
  document.getElementById("loja-sobre").value = config.sobre;
  document.getElementById("loja-mensagem-veiculo").value = config.mensagemVeiculo;
  previewLogoLoja.src = config.logo;
  previewLogoLoja.style.display = "block";
  logoLojaBase64 = "";
}

function formatarPreco(valor) {
  const numero = Number(String(valor).replace(/\D/g, ""));

  if (!numero) return "R$ 0";

  return numero.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
    maximumFractionDigits: 0,
  });
}

function numeroFinanceiro(id) {
  return Number(String(document.getElementById(id).value).replace(/\D/g, ""));
}

function numeroPercentual(id) {
  const valor = String(document.getElementById(id).value || "")
    .replace(",", ".")
    .replace(/[^\d.]/g, "");

  return Number(valor) || 0;
}

function calcularComissaoPorTaxa(valorVenda, taxa) {
  return Math.round((Number(valorVenda) || 0) * ((Number(taxa) || 0) / 100));
}

function calcularComissaoPadraoVendedor(vendedor, carro, valorVenda) {
  if (!vendedor) return 0;

  const tipo = vendedor.comissaoTipo || "fixa";
  const percentual = Number(vendedor.comissaoPercentualPadrao) || 0;

  if (tipo === "percentualVenda" && percentual) {
    return calcularComissaoPorTaxa(valorVenda, percentual);
  }

  if (tipo === "percentualLucro" && percentual) {
    const lucroBase =
      (Number(valorVenda) || 0) -
      (Number(carro.precoCompra) || 0) -
      (Number(carro.custoPreparacao) || 0) -
      totalSaidasVinculadasAoVeiculo(carro.id) -
      (Number(carro.taxas) || 0);

    return calcularComissaoPorTaxa(Math.max(lucroBase, 0), percentual);
  }

  return Number(vendedor.comissaoPadrao) || 0;
}

function lucroCarro(carro) {
  const valorVenda = Number(carro.valorVenda) || precoNumero(carro.preco);

  if (carro.status !== "Vendido") return 0;

  return valorVenda - custoTotalCarro(carro);
}

function valorCaixaVenda(carro) {
  const valorVenda = Number(carro.valorVenda) || precoNumero(carro.preco);
  const valorTroca = Number(carro.trocaValor) || 0;
  const saldoReceber = Number(carro.saldoReceber) || 0;

  if (carro.valorRecebido !== undefined && carro.valorRecebido !== "") {
    return Number(carro.valorRecebido) || 0;
  }

  return Math.max(valorVenda - valorTroca - saldoReceber, 0);
}

function saidasVinculadasAoVeiculo(carroId, mes) {
  return saidasFinanceiras.filter(function (saida) {
    return Number(saida.veiculoId) === Number(carroId) && saidaNoMesFinanceiro(saida, mes || "");
  });
}

function totalSaidasVinculadasAoVeiculo(carroId, mes) {
  return saidasVinculadasAoVeiculo(carroId, mes).reduce(function (total, saida) {
    return total + (Number(saida.valor) || 0);
  }, 0);
}

function custoTotalCarro(carro, mes) {
  return (
    (Number(carro.precoCompra) || 0) +
    (Number(carro.custoPreparacao) || 0) +
    totalSaidasVinculadasAoVeiculo(carro.id, mes) +
    (Number(carro.comissao) || 0) +
    (Number(carro.taxas) || 0)
  );
}

function montarAlertasFinanceiros(vendidos) {
  const alertas = [];

  vendidos.forEach(function (carro) {
    const valorVenda = Number(carro.valorVenda) || precoNumero(carro.preco);
    const composicao =
      valorCaixaVenda(carro) +
      (Number(carro.trocaValor) || 0) +
      (Number(carro.saldoReceber) || 0);

    if (!carro.vendedorId) {
      alertas.push(carro.nome + ": venda sem vendedor vinculado.");
    }

    if (!carro.dataVenda) {
      alertas.push(carro.nome + ": venda sem data registrada.");
    }

    if (Math.abs(valorVenda - composicao) > 1) {
      alertas.push(
        carro.nome +
          ": valor da venda não fecha com caixa + troca + saldo a receber."
      );
    }

    if (carro.temTroca && Number(carro.trocaValor) && !carro.trocaEstoqueId) {
      alertas.push(
        carro.nome + ": troca informada, mas carro recebido não foi vinculado ao estoque."
      );
    }
    if (Number(carro.custoPreparacao) && totalSaidasVinculadasAoVeiculo(carro.id)) {
      alertas.push(
        carro.nome +
          ": possui preparo manual e saídas vinculadas; confira se não houve custo duplicado."
      );
    }
  });

  carrosAdmin.forEach(function (carro) {
    if (carro.origem === "Troca" && !Number(carro.precoCompra)) {
      alertas.push(carro.nome + ": carro de troca sem custo de aquisição.");
    }
  });

  return alertas;
}

function renderizarLucroFormulario() {
  if (!lucroFormulario) return;

  const valorVenda = numeroFinanceiro("valor-venda");
  const taxaComissao = numeroPercentual("comissao-percentual");
  const inputComissao = document.getElementById("comissao");

  if (valorVenda && taxaComissao && !inputComissao.value) {
    inputComissao.value = formatarCampoMoedaValor(
      calcularComissaoPorTaxa(valorVenda, taxaComissao)
    );
  }

  const lucro =
    valorVenda -
    numeroFinanceiro("preco-compra") -
    numeroFinanceiro("custo-preparacao") -
    numeroFinanceiro("comissao") -
    numeroFinanceiro("taxas");

  lucroFormulario.textContent = formatarMoeda(lucro);
  lucroFormulario.classList.toggle("lucro-negativo", lucro < 0);
}

function carroNoMesFinanceiro(carro, mes) {
  if (!mes) return true;

  return String(carro.dataVenda || "").slice(0, 7) === mes;
}

function formatarPercentual(valor) {
  return valor.toLocaleString("pt-BR", {
    maximumFractionDigits: 1,
    minimumFractionDigits: 0,
  });
}

function limparFormulario() {
  form.reset();
  document.getElementById("carro-id").value = "";
  imagemBase64 = "";
  galeriaUploadBase64 = [];
  previewImg.src = "";
  previewImg.style.display = "none";
  document.getElementById("data-entrada").value = new Date().toISOString().slice(0, 10);
  document.getElementById("preparacao-status").value = "Aguardando revisão";
  document.getElementById("checklist-anuncio").value = "Pendente";
  renderizarGaleriaAdmin();
  renderizarPreviewCard();
  btnSalvar.textContent = "Cadastrar veículo";
  tituloForm.textContent = "Cadastrar veículo";
  btnCancelar.style.display = "none";
  fecharCadastroAdmin("form-carro");
}

function limparFormularioDepoimento() {
  formDepoimento.reset();
  document.getElementById("depoimento-id").value = "";
  imagemDepoimentoBase64 = "";
  previewDepoimento.src = "";
  previewDepoimento.style.display = "none";
  btnDepoimentoSalvar.textContent = "Cadastrar depoimento";
  tituloFormDepoimento.textContent = "Cadastrar depoimento";
  btnDepoimentoCancelar.style.display = "none";
  fecharCadastroAdmin("form-depoimento");
}

function limparFormularioParceria() {
  formParceria.reset();
  document.getElementById("parceria-id").value = "";
  document.getElementById("parceria-ativo").checked = true;
  btnParceriaSalvar.textContent = "Cadastrar parceria";
  tituloFormParceria.textContent = "Cadastrar parceria";
  btnParceriaCancelar.style.display = "none";
  fecharCadastroAdmin("form-parceria");
}

function montarCarro(idExistente) {
  const marca = selectMarca.value.trim();
  const modelo = document.getElementById("modelo").value.trim();
  const vendedorSelecionado = vendedorPorId(document.getElementById("vendedor-venda").value);
  const carroExistente = carrosAdmin.find(function (carro) {
    return Number(carro.id) === Number(idExistente);
  });
  const fotosExtras = document
    .getElementById("galeria-urls")
    .value.split("\n")
    .map(function (url) {
      return url.trim();
    })
    .filter(Boolean);
  const imagemPrincipal =
    imagemBase64 ||
    (carroExistente && carroExistente.imagem) ||
    "https://via.placeholder.com/700x450?text=Sem+imagem";

  return {
    id: idExistente
      ? Number(idExistente)
      : gerarIdUnico([carrosAdmin, depoimentosAdmin, parceriasAdmin]),
    marca: marca,
    modelo: modelo,
    nome: marca + " " + modelo,
    ano: document.getElementById("ano").value,
    km: document.getElementById("km").value,
    cambio: document.getElementById("cambio").value,
    tipo: document.getElementById("tipo").value,
    status: document.getElementById("status").value,
    combustivel: document.getElementById("combustivel").value || "-",
    cor: document.getElementById("cor").value || "-",
    portas: document.getElementById("portas").value || "-",
    placaFinal: document.getElementById("placa-final").value || "-",
    dataEntrada:
      document.getElementById("data-entrada").value ||
      (carroExistente && carroExistente.dataEntrada) ||
      new Date().toISOString().slice(0, 10),
    preparacaoStatus: document.getElementById("preparacao-status").value,
    checklistAnuncio: document.getElementById("checklist-anuncio").value,
    precoCompra: numeroFinanceiro("preco-compra"),
    custoPreparacao: numeroFinanceiro("custo-preparacao"),
    comissaoPercentual: numeroPercentual("comissao-percentual"),
    comissao: numeroFinanceiro("comissao"),
    taxas: numeroFinanceiro("taxas"),
    valorVenda: numeroFinanceiro("valor-venda"),
    dataVenda: document.getElementById("data-venda").value,
    vendedorId: vendedorSelecionado ? vendedorSelecionado.id : "",
    vendedorNome: vendedorSelecionado ? vendedorSelecionado.nome : "",
    temTroca: carroExistente ? Boolean(carroExistente.temTroca) : false,
    trocaVeiculo: carroExistente ? carroExistente.trocaVeiculo || "" : "",
    trocaValor: carroExistente ? Number(carroExistente.trocaValor) || 0 : 0,
    valorRecebido: carroExistente ? Number(carroExistente.valorRecebido) || 0 : 0,
    saldoReceber: carroExistente ? Number(carroExistente.saldoReceber) || 0 : 0,
    trocaEstoqueId: carroExistente ? carroExistente.trocaEstoqueId || "" : "",
    origem: carroExistente ? carroExistente.origem || "" : "",
    origemTrocaVendaId: carroExistente ? carroExistente.origemTrocaVendaId || "" : "",
    origemTrocaVeiculo: carroExistente ? carroExistente.origemTrocaVeiculo || "" : "",
    blindado: document.getElementById("blindado").checked,
    destaque: document.getElementById("destaque").checked,
    descricao:
      document.getElementById("descricao").value ||
      "Veículo revisado, com procedência e pronto para negociação.",
    opcionais: document
      .getElementById("opcionais")
      .value.split(",")
      .map(function (item) {
        return item.trim();
      })
      .filter(Boolean),
    preco: formatarPreco(document.getElementById("preco").value),
    imagem: imagemPrincipal,
    galeria: [imagemPrincipal].concat(galeriaUploadBase64, fotosExtras),
    oferta: document.getElementById("oferta").checked,
  };
}

function montarPreviaCarro() {
  const marca = selectMarca.value || "Marca";
  const modelo = document.getElementById("modelo").value.trim() || "Modelo";
  const preco = document.getElementById("preco").value.trim();
  const imagem =
    imagemBase64 ||
    previewImg.getAttribute("src") ||
    "https://via.placeholder.com/700x450?text=Sem+imagem";

  return {
    nome: marca + " " + modelo,
    ano: document.getElementById("ano").value || "Ano",
    km: document.getElementById("km").value || "Km",
    cambio: document.getElementById("cambio").value || "Câmbio",
    tipo: document.getElementById("tipo").value || "Tipo",
    status: document.getElementById("status").value || "Disponível",
    combustivel: document.getElementById("combustivel").value || "-",
    cor: document.getElementById("cor").value || "-",
    preco: preco ? formatarPreco(preco) : "R$ 0",
    imagem: imagem,
    oferta: document.getElementById("oferta").checked,
  };
}

function renderizarPreviewCard() {
  const carro = montarPreviaCarro();
  const badge = carro.oferta ? '<span class="badge-oferta">OFERTA</span>' : "";
  const badgeStatus =
    carro.status !== "Disponível"
      ? '<span class="badge-status">' + escaparHTML(carro.status) + "</span>"
      : "";

  previewCardCarro.innerHTML =
    '<article class="carro-card preview-card-admin ' +
    (carro.status === "Vendido" ? "carro-vendido" : "") +
    '">' +
    '<div class="carro-img-box">' +
    badge +
    badgeStatus +
    '<img src="' +
    escaparAtributo(carro.imagem) +
    '" alt="Prévia do veículo">' +
    "</div>" +
    '<div class="carro-info">' +
    "<h3>" +
    escaparHTML(carro.nome) +
    "</h3>" +
    "<p>" +
    escaparHTML(textoCarro(carro)) +
    "</p>" +
    '<p class="carro-meta">' +
    escaparHTML(carro.combustivel) +
    " | " +
    escaparHTML(carro.cor) +
    " | " +
    escaparHTML(carro.tipo) +
    "</p>" +
    "<strong>" +
    escaparHTML(carro.preco) +
    "</strong>" +
    '<div class="carro-acoes">' +
    '<span class="btn-primary">Detalhes</span>' +
    '<span class="btn-whatsapp">WhatsApp</span>' +
    "</div>" +
    "</div>" +
    "</article>";
}

function renderizarGaleriaAdmin() {
  if (galeriaUploadBase64.length === 0) {
    previewGaleriaAdmin.innerHTML =
      '<p class="admin-ajuda">Nenhuma foto extra selecionada.</p>';
    return;
  }

  previewGaleriaAdmin.innerHTML = galeriaUploadBase64
    .map(function (imagem, index) {
      return (
        '<div class="galeria-preview-item">' +
        '<img src="' +
        escaparAtributo(imagem) +
        '" alt="Foto extra ' +
        (index + 1) +
        '">' +
        '<button type="button" onclick="removerFotoGaleria(' +
        index +
        ')">Remover</button>' +
        "</div>"
      );
    })
    .join("");
}

function removerFotoGaleria(index) {
  galeriaUploadBase64.splice(index, 1);
  renderizarGaleriaAdmin();
}

function renderizarAdmin() {
  renderizarDashboard();
  renderizarFinanceiro();
  renderizarVendedores();
  preencherVendedoresLead();
  renderizarClientes();
  renderizarHistoricoVeiculos();
  renderizarAnalyticsAdmin();
  preencherVendedoresVenda();
  preencherSelectsVeiculosOperacionais();
  preencherCarrosInstagram();
  renderizarInstagram();
  listaAdmin.innerHTML = "";
  const termo = normalizarTextoAdmin(buscaAdminCarros.value);
  const statusFiltro = statusAdminCarros.value;
  const carrosFiltrados = carrosAdmin.filter(function (carro) {
    const texto = normalizarTextoAdmin(
      [
        carro.nome,
        carro.marca,
        carro.modelo,
        carro.status,
        carro.tipo,
        carro.cor,
        carro.ano,
      ].join(" ")
    );

    const combinaBusca = termo === "" || texto.includes(termo);
    const combinaStatus = statusFiltro === "" || carro.status === statusFiltro;

    return combinaBusca && combinaStatus;
  });

  if (carrosFiltrados.length === 0) {
    listaAdmin.innerHTML =
      '<p class="sem-resultados">Nenhum veículo encontrado no admin.</p>';
    renderizarPaginacao(
      paginacaoVeiculos,
      0,
      1,
      itensPorPaginaVeiculos,
      "veiculos"
    );
    return;
  }

  const totalPaginasVeiculos = Math.max(
    1,
    Math.ceil(carrosFiltrados.length / itensPorPaginaVeiculos)
  );
  paginaVeiculos = Math.min(paginaVeiculos, totalPaginasVeiculos);
  const inicioVeiculos = (paginaVeiculos - 1) * itensPorPaginaVeiculos;

  carrosFiltrados
    .slice(inicioVeiculos, inicioVeiculos + itensPorPaginaVeiculos)
    .forEach(function (carro) {
    const idCarro = Number(carro.id) || 0;

    listaAdmin.innerHTML +=
      '<article class="admin-item admin-item-veiculo ' +
      (carro.status === "Vendido" ? "admin-item-vendido" : "") +
      '">' +
      (carro.status === "Vendido" ? '<span class="carimbo-vendido admin-carimbo-vendido">VENDIDO</span>' : "") +
      '<img src="' +
      escaparAtributo(carro.imagem) +
      '" alt="' +
      escaparAtributo(carro.nome) +
      '">' +
      '<div class="admin-veiculo-info">' +
      "<h4>" +
      escaparHTML(carro.nome) +
      "</h4>" +
      "<p>" +
      escaparHTML(textoCarro(carro)) +
      "</p>" +
      "<p>" +
      escaparHTML(carro.tipo) +
      " | " +
      escaparHTML(carro.status) +
      "</p>" +
      "<strong>" +
      escaparHTML(carro.preco) +
      "</strong>" +
      "<p>" +
      (carro.oferta ? "Oferta ativa" : "Sem oferta") +
      "</p>" +
      '<div class="financeiro-item-meta">' +
      "<span>Preparação: " +
      escaparHTML(carro.preparacaoStatus || "Não informado") +
      "</span>" +
      "<span>Anúncio: " +
      escaparHTML(carro.checklistAnuncio || "Pendente") +
      "</span>" +
      (carro.dataEntrada ? "<span>Estoque: " + diasDesde(carro.dataEntrada) + " dias</span>" : "") +
      "</div>" +
      "</div>" +
      '<div class="admin-acoes">' +
      '<button type="button" class="btn-status" onclick="alterarStatusCarro(' +
      idCarro +
      ', \'Disponível\')">Disponível</button>' +
      '<button type="button" class="btn-status" onclick="alterarStatusCarro(' +
      idCarro +
      ', \'Reservado\')">Reservado</button>' +
      '<button type="button" class="btn-vendido" onclick="alterarStatusCarro(' +
      idCarro +
      ', \'Vendido\')">Vendido</button>' +
      '<button type="button" class="btn-editar" onclick="editarCarro(' +
      idCarro +
      ')">Editar</button>' +
      '<button type="button" class="btn-editar" onclick="duplicarCarro(' +
      idCarro +
      ')">Duplicar</button>' +
      '<button type="button" class="btn-editar" onclick="gerarPropostaVeiculo(' +
      idCarro +
      ')">Proposta</button>' +
      '<button type="button" class="btn-status" onclick="marcarChecklistCompleto(' +
      idCarro +
      ')">Checklist ok</button>' +
      '<button type="button" class="btn-excluir" onclick="excluirCarro(' +
      idCarro +
      ')">Excluir</button>' +
      "</div>" +
      "</article>";
  });

  renderizarPaginacao(
    paginacaoVeiculos,
    carrosFiltrados.length,
    paginaVeiculos,
    itensPorPaginaVeiculos,
    "veiculos"
  );
}

function normalizarTextoAdmin(texto) {
  return String(texto || "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase();
}

function formatarNumeroCampo(valor) {
  return formatarCampoMoedaValor(valor);
}

function preencherVendedoresModalVenda(vendedorAtualId) {
  if (!selectModalVendaVendedor) return;

  const vendedoresAtivos = vendedoresAdmin.filter(function (vendedor) {
    return vendedor.ativo !== false;
  });

  selectModalVendaVendedor.innerHTML =
    '<option value="">Selecione quem realizou a venda</option>';

  vendedoresAtivos.forEach(function (vendedor) {
    const option = document.createElement("option");
    option.value = vendedor.id;
    option.textContent = vendedor.nome;
    selectModalVendaVendedor.appendChild(option);
  });

  if (vendedorAtualId) {
    selectModalVendaVendedor.value = vendedorAtualId;
  } else if (vendedoresAtivos.length === 1) {
    selectModalVendaVendedor.value = vendedoresAtivos[0].id;
  }
}

function recalcularComissaoModalVenda() {
  if (!inputModalVendaValor || !inputModalVendaTaxa || !inputModalVendaComissao) {
    return;
  }

  const valorVenda = Number(String(inputModalVendaValor.value).replace(/\D/g, ""));
  const taxa =
    Number(
      String(inputModalVendaTaxa.value)
        .replace(",", ".")
        .replace(/[^\d.]/g, "")
    ) || 0;

  if (valorVenda && taxa) {
    inputModalVendaComissao.value = formatarCampoMoedaValor(
      calcularComissaoPorTaxa(valorVenda, taxa)
    );
  }
}

function atualizarResumoTrocaModalVenda() {
  if (!inputModalVendaValor || !inputModalVendaValorRecebido) return;

  const valorVenda = Number(String(inputModalVendaValor.value).replace(/\D/g, ""));
  const valorTroca = Number(String(inputModalVendaTrocaValor.value).replace(/\D/g, ""));
  const valorRecebidoAtual = Number(
    String(inputModalVendaValorRecebido.value).replace(/\D/g, "")
  );

  if (selectModalVendaTemTroca.value === "Não") {
    modalVenda.classList.add("sem-troca");
    inputModalVendaTrocaVeiculo.value = "";
    inputModalVendaTrocaValor.value = "";
    inputModalVendaSaldo.value = "";
    inputModalVendaValorRecebido.value = formatarCampoMoedaValor(valorVenda);
    checkModalVendaCadastrarTroca.checked = false;
    return;
  }

  modalVenda.classList.remove("sem-troca");
  if (!checkModalVendaCadastrarTroca.checked && !inputModalVendaTrocaVeiculo.value) {
    checkModalVendaCadastrarTroca.checked = true;
  }

  if (!valorRecebidoAtual && valorVenda) {
    inputModalVendaValorRecebido.value = formatarCampoMoedaValor(
      Math.max(valorVenda - valorTroca, 0)
    );
  }

  const valorRecebido = Number(
    String(inputModalVendaValorRecebido.value).replace(/\D/g, "")
  );
  const saldo = Math.max(valorVenda - valorTroca - valorRecebido, 0);
  inputModalVendaSaldo.value = saldo ? formatarCampoMoedaValor(saldo) : "";
}

function criarVeiculoTrocaSeNecessario(venda, carroVendido) {
  if (
    !venda.temTroca ||
    !venda.cadastrarTroca ||
    !venda.trocaVeiculo ||
    !venda.trocaValor
  ) {
    return "";
  }

  if (carroVendido.trocaEstoqueId) {
    return carroVendido.trocaEstoqueId;
  }

  const partes = venda.trocaVeiculo.trim().split(" ");
  const marca = partes[0] || "Veículo";
  const modelo = partes.slice(1).join(" ") || "recebido na troca";
  const idTroca = gerarIdUnico([
    carrosAdmin,
    depoimentosAdmin,
    parceriasAdmin,
    vendedoresAdmin,
    saidasFinanceiras,
  ]);

  carrosAdmin.push({
    id: idTroca,
    marca: marca,
    modelo: modelo,
    nome: venda.trocaVeiculo.trim(),
    ano: "",
    km: "",
    cambio: "-",
    tipo: "Outros",
    status: "Disponível",
    combustivel: "-",
    cor: "-",
    portas: "-",
    placaFinal: "-",
    dataEntrada: new Date().toISOString().slice(0, 10),
    preparacaoStatus: "Aguardando revisão",
    checklistAnuncio: "Pendente",
    precoCompra: venda.trocaValor,
    custoPreparacao: 0,
    comissaoPercentual: 0,
    comissao: 0,
    taxas: 0,
    valorVenda: 0,
    dataVenda: "",
    vendedorId: "",
    vendedorNome: "",
    blindado: false,
    destaque: false,
    descricao:
      "Veículo recebido na troca da venda de " + carroVendido.nome + ".",
    opcionais: [],
    preco: formatarMoeda(venda.trocaValor),
    imagem: "https://via.placeholder.com/700x450?text=Carro+recebido+na+troca",
    galeria: ["https://via.placeholder.com/700x450?text=Carro+recebido+na+troca"],
    oferta: false,
    origem: "Troca",
    origemTrocaVendaId: carroVendido.id,
    origemTrocaVeiculo: carroVendido.nome,
  });

  registrarHistoricoVeiculo(
    idTroca,
    "Entrada por troca",
    "Veículo incluído no estoque como troca da venda de " + carroVendido.nome + ".",
    { vendaOrigemId: carroVendido.id, valorAvaliacao: venda.trocaValor }
  );

  return idTroca;
}

function abrirModalVenda(carro) {
  if (!modalVenda || !formModalVenda) return;

  vendaPendenteId = Number(carro.id);
  modalVendaVeiculo.textContent = carro.nome + " - " + carro.preco;
  preencherVendedoresModalVenda(carro.vendedorId);
  inputModalVendaValor.value = formatarNumeroCampo(
    carro.valorVenda || precoNumero(carro.preco)
  );
  inputModalVendaTaxa.value = carro.comissaoPercentual || "";
  inputModalVendaComissao.value = formatarCampoMoedaValor(carro.comissao);
  selectModalVendaTemTroca.value = carro.temTroca ? "Sim" : "Não";
  inputModalVendaValorRecebido.value = formatarCampoMoedaValor(
    carro.valorRecebido || valorCaixaVenda(carro)
  );
  inputModalVendaTrocaVeiculo.value = carro.trocaVeiculo || "";
  inputModalVendaTrocaValor.value = formatarCampoMoedaValor(carro.trocaValor);
  inputModalVendaSaldo.value = formatarCampoMoedaValor(carro.saldoReceber);
  checkModalVendaCadastrarTroca.checked = !carro.trocaEstoqueId;
  atualizarResumoTrocaModalVenda();
  modalVenda.classList.add("ativo");
  modalVenda.setAttribute("aria-hidden", "false");
  document.body.classList.add("modal-aberto");
  selectModalVendaVendedor.focus();
}

function fecharModalVenda() {
  if (!modalVenda) return;

  vendaPendenteId = null;
  modalVenda.classList.remove("ativo");
  modalVenda.setAttribute("aria-hidden", "true");
  document.body.classList.remove("modal-aberto");
}

function registrarVendaPendente() {
  const carroVenda = carrosAdmin.find(function (carro) {
    return Number(carro.id) === Number(vendaPendenteId);
  });
  const vendedorSelecionado = vendedorPorId(selectModalVendaVendedor.value);

  if (!carroVenda || !vendedorSelecionado) {
    alert("Selecione um vendedor para registrar a venda.");
    return;
  }

  const hoje = new Date().toISOString().slice(0, 10);
  const valorVenda =
    Number(String(inputModalVendaValor.value).replace(/\D/g, "")) ||
    precoNumero(carroVenda.preco);
  const taxaComissao =
    Number(
      String(inputModalVendaTaxa.value)
        .replace(",", ".")
        .replace(/[^\d.]/g, "")
    ) || 0;
  const comissao =
    Number(String(inputModalVendaComissao.value).replace(/\D/g, "")) ||
    calcularComissaoPorTaxa(valorVenda, taxaComissao) ||
    calcularComissaoPadraoVendedor(vendedorSelecionado, carroVenda, valorVenda) ||
    0;
  const temTroca = selectModalVendaTemTroca.value === "Sim";
  const trocaVeiculo = temTroca ? inputModalVendaTrocaVeiculo.value.trim() : "";
  const trocaValor = temTroca
    ? Number(String(inputModalVendaTrocaValor.value).replace(/\D/g, "")) || 0
    : 0;
  const valorRecebido =
    Number(String(inputModalVendaValorRecebido.value).replace(/\D/g, "")) ||
    Math.max(valorVenda - trocaValor, 0);
  const saldoReceber =
    Number(String(inputModalVendaSaldo.value).replace(/\D/g, "")) ||
    Math.max(valorVenda - trocaValor - valorRecebido, 0);

  if (temTroca && (!trocaVeiculo || !trocaValor)) {
    alert("Informe o carro recebido na troca e o valor avaliado.");
    return;
  }

  const venda = {
    temTroca: temTroca,
    trocaVeiculo: trocaVeiculo,
    trocaValor: trocaValor,
    valorRecebido: valorRecebido,
    saldoReceber: saldoReceber,
    cadastrarTroca: checkModalVendaCadastrarTroca.checked,
  };
  const trocaEstoqueId = criarVeiculoTrocaSeNecessario(venda, carroVenda);

  carrosAdmin = carrosAdmin.map(function (carro) {
    if (Number(carro.id) !== Number(vendaPendenteId)) return carro;

    return {
      ...carro,
      status: "Vendido",
      destaque: false,
      dataVenda: carro.dataVenda || hoje,
      valorVenda: valorVenda,
      comissaoPercentual: taxaComissao,
      comissao: comissao,
      vendedorId: vendedorSelecionado.id,
      vendedorNome: vendedorSelecionado.nome,
      temTroca: temTroca,
      trocaVeiculo: trocaVeiculo,
      trocaValor: trocaValor,
      valorRecebido: valorRecebido,
      saldoReceber: saldoReceber,
      trocaEstoqueId: trocaEstoqueId || carro.trocaEstoqueId || "",
    };
  });

  salvarCarros(carrosAdmin);
  registrarHistoricoVeiculo(
    vendaPendenteId,
    "Venda",
    "Venda registrada para " + vendedorSelecionado.nome + " por " + formatarMoeda(valorVenda) + ".",
    {
      valorVenda: valorVenda,
      vendedor: vendedorSelecionado.nome,
      trocaValor: trocaValor,
      saldoReceber: saldoReceber,
    }
  );
  fecharModalVenda();
  renderizarAdmin();
}

function alterarStatusCarro(id, status) {
  const carroVenda = carrosAdmin.find(function (carro) {
    return Number(carro.id) === Number(id);
  });

  if (!carroVenda) return;

  if (status === "Vendido") {
    abrirModalVenda(carroVenda);
    return;
  }

  carrosAdmin = carrosAdmin.map(function (carro) {
    if (Number(carro.id) === Number(id)) {
      return {
        ...carro,
        status: status,
      };
    }

    return carro;
  });

  salvarCarros(carrosAdmin);
  registrarHistoricoVeiculo(
    id,
    "Status",
    "Status alterado para " + status + ".",
    { status: status }
  );
  renderizarAdmin();
}

function renderizarGraficoFinanceiro(dados) {
  if (!graficoPizzaFinanceiro || !graficoLegendaFinanceiro) return;

  const itens = [
    {
      nome: "Receita recebida",
      valor: Math.max(0, Number(dados.caixaRecebido) || 0),
      cor: "#2563eb",
    },
    {
      nome: "Trocas",
      valor: Math.max(0, Number(dados.trocas) || 0),
      cor: "#f97316",
    },
    {
      nome: "Saídas",
      valor: Math.max(0, Number(dados.saidas) || 0),
      cor: "#ef4444",
    },
    {
      nome: "A receber",
      valor: Math.max(0, Number(dados.aReceber) || 0),
      cor: "#eab308",
    },
  ];
  const total = itens.reduce(function (soma, item) {
    return soma + item.valor;
  }, 0);

  if (!total) {
    graficoPizzaFinanceiro.style.background =
      "conic-gradient(#e2e8f0 0deg 360deg)";
    if (graficoCentroFinanceiro) graficoCentroFinanceiro.textContent = "R$ 0";
    if (graficoResumoFinanceiro) {
      graficoResumoFinanceiro.textContent =
        "Sem movimentação suficiente para montar o gráfico deste período.";
    }
    graficoLegendaFinanceiro.innerHTML =
      '<p class="sem-resultados">Sem dados financeiros no período.</p>';
    return;
  }

  let anguloAtual = 0;
  const fatias = itens
    .filter(function (item) {
      return item.valor > 0;
    })
    .map(function (item) {
      const graus = (item.valor / total) * 360;
      const fatia =
        item.cor + " " + anguloAtual + "deg " + (anguloAtual + graus) + "deg";
      anguloAtual += graus;
      return fatia;
    });

  graficoPizzaFinanceiro.style.background =
    "conic-gradient(" + fatias.join(", ") + ")";
  if (graficoCentroFinanceiro) {
    graficoCentroFinanceiro.textContent = formatarMoeda(total);
  }
  if (graficoResumoFinanceiro) {
    graficoResumoFinanceiro.textContent =
      "Total movimentado no gráfico: " + formatarMoeda(total) + ".";
  }
  graficoLegendaFinanceiro.innerHTML = itens
    .map(function (item) {
      const percentual = total ? (item.valor / total) * 100 : 0;

      return (
        '<div class="financeiro-legenda-item">' +
        '<span style="--legenda-cor:' +
        item.cor +
        '"></span>' +
        "<div><strong>" +
        escaparHTML(item.nome) +
        "</strong><small>" +
        formatarMoeda(item.valor) +
        " · " +
        formatarPercentual(percentual) +
        "%</small></div></div>"
      );
    })
    .join("");
}

function renderizarFinanceiro() {
  if (!listaFinanceiro) return;

  const mes = filtroFinanceiroMes.value;
  const disponiveis = carrosAdmin.filter(function (carro) {
    return carro.status !== "Vendido";
  });
  const vendidos = carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido" && carroNoMesFinanceiro(carro, mes);
  });
  const saidasFiltradas = saidasFinanceiras.filter(function (saida) {
    return saidaNoMesFinanceiro(saida, mes);
  });
  const totalEstoque = disponiveis.reduce(function (total, carro) {
    return total + precoNumero(carro.preco);
  }, 0);
  const totalVendido = vendidos.reduce(function (total, carro) {
    return total + (Number(carro.valorVenda) || precoNumero(carro.preco));
  }, 0);
  const totalCaixaRecebido = vendidos.reduce(function (total, carro) {
    return total + valorCaixaVenda(carro);
  }, 0);
  const totalTrocas = vendidos.reduce(function (total, carro) {
    return total + (Number(carro.trocaValor) || 0);
  }, 0);
  const totalSaldoReceber = vendidos.reduce(function (total, carro) {
    return total + (Number(carro.saldoReceber) || 0);
  }, 0);
  const quantidadeTrocas = vendidos.filter(function (carro) {
    return carro.temTroca && Number(carro.trocaValor);
  }).length;
  const lucroTotal = vendidos.reduce(function (total, carro) {
    return total + lucroCarro(carro);
  }, 0);
  const custosTotal = vendidos.reduce(function (total, carro) {
    return total + custoTotalCarro(carro);
  }, 0);
  const ticketMedio = vendidos.length ? totalVendido / vendidos.length : 0;
  const margem = totalVendido ? (lucroTotal / totalVendido) * 100 : 0;
  const totalSaidas = saidasFiltradas.reduce(function (total, saida) {
    return total + (Number(saida.valor) || 0);
  }, 0);
  const totalSaidasGerais = saidasFiltradas.reduce(function (total, saida) {
    return total + (saida.veiculoId ? 0 : Number(saida.valor) || 0);
  }, 0);
  const resultadoLiquido = lucroTotal - totalSaidasGerais;

  atualizarDashboardTexto("fin-total-estoque", formatarMoeda(totalEstoque));
  atualizarDashboardTexto("fin-total-vendido", formatarMoeda(totalVendido));
  atualizarDashboardTexto("fin-lucro", formatarMoeda(lucroTotal));
  atualizarDashboardTexto("fin-ticket", formatarMoeda(ticketMedio));
  atualizarDashboardTexto(
    "fin-estoque-unidades",
    disponiveis.length + " veículo(s) disponíveis"
  );
  atualizarDashboardTexto("fin-vendas", vendidos.length + " venda(s) no período");
  atualizarDashboardTexto("fin-margem", "Margem de " + formatarPercentual(margem) + "%");
  atualizarDashboardTexto("fin-custos", "Custos: " + formatarMoeda(custosTotal));
  atualizarDashboardTexto("fin-saidas", formatarMoeda(totalSaidas));
  atualizarDashboardTexto(
    "fin-saidas-qtd",
    saidasFiltradas.length + " gasto(s) no período"
  );
  atualizarDashboardTexto("fin-resultado-liquido", formatarMoeda(resultadoLiquido));
  atualizarDashboardTexto("fin-caixa-recebido", formatarMoeda(totalCaixaRecebido));
  atualizarDashboardTexto("fin-total-trocas", formatarMoeda(totalTrocas));
  atualizarDashboardTexto("fin-trocas-qtd", quantidadeTrocas + " troca(s) no período");
  atualizarDashboardTexto("fin-saldo-receber", formatarMoeda(totalSaldoReceber));
  atualizarDashboardTexto(
    "fin-resultado-info",
    resultadoLiquido >= 0 ? "Operação positiva no período" : "Saídas acima do lucro bruto"
  );
  aplicarCorMetricaFinanceira("fin-resultado-liquido", "resultadoLiquido", resultadoLiquido);
  aplicarCorMetricaFinanceira("fin-total-vendido", "receitaVendida", totalVendido);
  aplicarCorMetricaFinanceira("fin-lucro", "lucroBruto", lucroTotal);
  aplicarCorMetricaFinanceira("fin-saidas", "saidas", totalSaidas);
  aplicarCorMetricaFinanceira("fin-total-estoque", "estoqueAnunciado", totalEstoque);
  aplicarCorMetricaFinanceira("fin-ticket", "ticketMedio", ticketMedio);
  aplicarCorMetricaFinanceira("fin-caixa-recebido", "entradaCaixa", totalCaixaRecebido);
  aplicarCorMetricaFinanceira("fin-total-trocas", "valorTrocas", totalTrocas);
  aplicarCorMetricaFinanceira("fin-saldo-receber", "saldoReceber", totalSaldoReceber);
  renderizarGraficoFinanceiro({
    caixaRecebido: totalCaixaRecebido,
    trocas: totalTrocas,
    saidas: totalSaidas,
    aReceber: totalSaldoReceber,
  });

  if (listaCaixaFinanceiro) {
    listaCaixaFinanceiro.innerHTML =
      "<span><b>Entradas recebidas</b>" +
      formatarMoeda(totalCaixaRecebido) +
      "</span>" +
      "<span><b>Trocas recebidas</b>" +
      formatarMoeda(totalTrocas) +
      "</span>" +
      "<span><b>Saídas gerais</b>" +
      formatarMoeda(totalSaidasGerais) +
      "</span>" +
      "<span><b>Saídas vinculadas</b>" +
      formatarMoeda(totalSaidas - totalSaidasGerais) +
      "</span>" +
      "<span><b>Caixa líquido</b>" +
      formatarMoeda(totalCaixaRecebido - totalSaidasGerais) +
      "</span>";
  }

  if (listaContasReceber) {
    const receber = vendidos.filter(function (carro) {
      return Number(carro.saldoReceber) > 0;
    });

    if (resumoReceberFinanceiro) {
      resumoReceberFinanceiro.textContent =
        receber.length + " venda(s) com " + formatarMoeda(totalSaldoReceber) + " pendente.";
    }

    listaContasReceber.innerHTML = receber.length
      ? receber
          .map(function (carro) {
            return (
              '<article class="admin-item admin-item-simples">' +
              "<div>" +
              "<h4>" +
              escaparHTML(carro.nome) +
              "</h4>" +
              '<div class="financeiro-item-meta">' +
              "<span>Venda: " +
              escaparHTML(carro.dataVenda || "Sem data") +
              "</span>" +
              "<span>Vendedor: " +
              escaparHTML(carro.vendedorNome || "Não informado") +
              "</span>" +
              "</div>" +
              '<strong class="financeiro-lucro-negativo">Pendente: ' +
              formatarMoeda(carro.saldoReceber) +
              "</strong>" +
              "</div>" +
              '<div class="admin-acoes">' +
              '<button type="button" class="btn-status" onclick="marcarSaldoRecebido(' +
              (Number(carro.id) || 0) +
              ')">Marcar recebido</button>' +
              "</div>" +
              "</article>"
            );
          })
          .join("")
      : '<p class="sem-resultados">Nenhuma conta a receber neste período.</p>';
  }

  if (resumoPeriodoFinanceiro) {
    resumoPeriodoFinanceiro.textContent = mes
      ? "Mostrando vendas registradas em " + mes.split("-").reverse().join("/") + "."
      : "Mostrando todas as vendas registradas.";
  }

  if (resumoSaidasFinanceiras) {
    resumoSaidasFinanceiras.textContent = mes
      ? "Mostrando saídas lançadas em " + mes.split("-").reverse().join("/") + "."
      : "Mostrando todas as saídas.";
  }

  if (listaAlertasFinanceiros) {
    const alertas = montarAlertasFinanceiros(vendidos);

    listaAlertasFinanceiros.innerHTML = alertas.length
      ? alertas
          .map(function (alerta) {
            return (
              '<div class="analytics-lista-item alerta-financeiro-item">' +
              '<span class="analytics-nome">' +
              escaparHTML(alerta) +
              "</span>" +
              "</div>"
            );
          })
          .join("")
      : '<div class="analytics-lista-item"><span class="analytics-nome">Nenhuma inconsistência encontrada no período.</span></div>';
  }

  if (listaSaidasFinanceiras) {
    if (saidasFiltradas.length === 0) {
      listaSaidasFinanceiras.innerHTML =
        '<p class="sem-resultados">Nenhuma saída lançada neste período.</p>';
    } else {
      listaSaidasFinanceiras.innerHTML = saidasFiltradas
        .slice()
        .sort(function (a, b) {
          return String(b.data || "").localeCompare(String(a.data || ""));
        })
        .map(function (saida) {
          const idSaida = Number(saida.id) || 0;

          return (
            '<article class="admin-item admin-item-saida">' +
            '<div class="saida-data">' +
            formatarDataBR(saida.data) +
            "</div>" +
            "<div>" +
            "<h4>" +
            escaparHTML(saida.descricao) +
            "</h4>" +
            '<div class="financeiro-item-meta">' +
            "<span>" +
            escaparHTML(saida.categoria) +
            "</span>" +
            "<span>" +
            escaparHTML(saida.pagamento || "Não informado") +
            "</span>" +
            (saida.responsavel
              ? "<span>Responsável: " + escaparHTML(saida.responsavel) + "</span>"
              : "") +
            "</div>" +
            (saida.observacao
              ? "<p>" + escaparHTML(saida.observacao) + "</p>"
              : "") +
            '<strong class="financeiro-lucro-negativo">Saída: ' +
            formatarMoeda(saida.valor) +
            "</strong>" +
            "</div>" +
            '<div class="admin-acoes">' +
            '<button type="button" class="btn-excluir" onclick="excluirSaidaFinanceira(' +
            idSaida +
            ')">Excluir</button>' +
            "</div>" +
            "</article>"
          );
        })
        .join("");
    }
  }

  if (vendidos.length === 0) {
    listaFinanceiro.innerHTML =
      '<p class="sem-resultados">Nenhuma venda registrada neste período.</p>';
    return;
  }

  listaFinanceiro.innerHTML = vendidos
    .map(function (carro) {
      const valorVenda = Number(carro.valorVenda) || precoNumero(carro.preco);
      const valorRecebido = valorCaixaVenda(carro);
      const valorTroca = Number(carro.trocaValor) || 0;
      const saldoReceber = Number(carro.saldoReceber) || 0;
      const custoCompra = Number(carro.precoCompra) || 0;
      const custoPreparacao = Number(carro.custoPreparacao) || 0;
      const custosVinculados = totalSaidasVinculadasAoVeiculo(carro.id);
      const taxaComissao = Number(carro.comissaoPercentual) || 0;
      const comissao = Number(carro.comissao) || 0;
      const taxas = Number(carro.taxas) || 0;
      const custoTotal = custoCompra + custoPreparacao + custosVinculados + comissao + taxas;
      const lucro = lucroCarro(carro);
      const margemCarro = valorVenda ? (lucro / valorVenda) * 100 : 0;
      const idCarro = Number(carro.id) || 0;

      return (
        '<article class="admin-item admin-item-financeiro">' +
        '<img src="' +
        escaparAtributo(carro.imagem) +
        '" alt="' +
        escaparAtributo(carro.nome) +
        '">' +
        "<div>" +
        "<h4>" +
        escaparHTML(carro.nome) +
        "</h4>" +
        '<div class="financeiro-item-meta">' +
        "<span>Venda: " +
        escaparHTML(carro.dataVenda || "Sem data") +
        "</span>" +
        "<span>Valor: " +
        formatarMoeda(valorVenda) +
        "</span>" +
        "<span>Caixa: " +
        formatarMoeda(valorRecebido) +
        "</span>" +
        (valorTroca
          ? "<span>Troca: " + formatarMoeda(valorTroca) + "</span>"
          : "") +
        (saldoReceber
          ? "<span>Saldo: " + formatarMoeda(saldoReceber) + "</span>"
          : "") +
        "<span>Vendedor: " +
        escaparHTML(carro.vendedorNome || "Não informado") +
        "</span>" +
        "<span>Margem: " +
        formatarPercentual(margemCarro) +
        "%</span>" +
        "</div>" +
        '<div class="financeiro-breakdown">' +
        "<span><b>Compra</b>" +
        formatarMoeda(custoCompra) +
        "</span>" +
        "<span><b>Preparação</b>" +
        formatarMoeda(custoPreparacao) +
        "</span>" +
        "<span><b>Comissão</b>" +
        formatarMoeda(comissao) +
        (taxaComissao ? " (" + formatarPercentual(taxaComissao) + "%)" : "") +
        "</span>" +
        "<span><b>Taxas</b>" +
        formatarMoeda(taxas) +
        "</span>" +
        "<span><b>Custo total</b>" +
        formatarMoeda(custoTotal) +
        "</span>" +
        "</div>" +
        (carro.temTroca
          ? '<p class="admin-ajuda">Troca recebida: ' +
            escaparHTML(carro.trocaVeiculo || "Não informado") +
            (carro.trocaEstoqueId
              ? " | cadastrada no estoque #" + escaparHTML(carro.trocaEstoqueId)
              : "") +
            "</p>"
          : "") +
        '<strong class="' +
        (lucro < 0 ? "financeiro-lucro-negativo" : "financeiro-lucro-positivo") +
        '">Lucro estimado: ' +
        formatarMoeda(lucro) +
        "</strong>" +
        "</div>" +
        '<div class="admin-acoes">' +
        '<button type="button" class="btn-editar" onclick="editarCarro(' +
        idCarro +
        ')">Editar</button>' +
        "</div>" +
        "</article>"
      );
    })
    .join("");
}

function renderizarVendedores() {
  if (!listaVendedoresAdmin || !listaComissoesVendedores) return;

  const mes = filtroFinanceiroMes ? filtroFinanceiroMes.value : "";
  const vendedoresAtivos = vendedoresAdmin.filter(function (vendedor) {
    return vendedor.ativo !== false;
  });
  const vendidos = carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido" && carroNoMesFinanceiro(carro, mes);
  });
  const resumo = vendedoresAdmin.map(function (vendedor) {
    const vendas = vendidos.filter(function (carro) {
      return Number(carro.vendedorId) === Number(vendedor.id);
    });
    const totalVendido = vendas.reduce(function (total, carro) {
      return total + (Number(carro.valorVenda) || precoNumero(carro.preco));
    }, 0);
    const comissao = vendas.reduce(function (total, carro) {
      return total + (Number(carro.comissao) || 0);
    }, 0);

    return {
      vendedor: vendedor,
      vendas: vendas,
      totalVendido: totalVendido,
      comissao: comissao,
    };
  });
  const totalComissoes = resumo.reduce(function (total, item) {
    return total + item.comissao;
  }, 0);
  const totalVendasVinculadas = resumo.reduce(function (total, item) {
    return total + item.vendas.length;
  }, 0);
  const destaque = resumo
    .slice()
    .sort(function (a, b) {
      return b.comissao - a.comissao;
    })[0];

  atualizarDashboardTexto("vend-total-ativos", vendedoresAtivos.length);
  atualizarDashboardTexto("vend-total-comissoes", formatarMoeda(totalComissoes));
  atualizarDashboardTexto(
    "vend-total-vendas",
    totalVendasVinculadas + " venda(s) vinculadas"
  );
  atualizarDashboardTexto(
    "vend-maior-comissao",
    destaque ? formatarMoeda(destaque.comissao) : "R$ 0"
  );
  atualizarDashboardTexto(
    "vend-destaque",
    destaque && destaque.comissao > 0
      ? destaque.vendedor.nome
      : "Nenhum vendedor no período"
  );

  if (resumoPeriodoVendedores) {
    resumoPeriodoVendedores.textContent = mes
      ? "Comissões de " + mes.split("-").reverse().join("/") + "."
      : "Usa o mesmo filtro de mês do financeiro.";
  }

  const vendedoresComVenda = resumo
    .filter(function (item) {
      return item.vendas.length > 0;
    })
    .sort(function (a, b) {
      return b.comissao - a.comissao;
    });

  listaComissoesVendedores.innerHTML =
    '<article><span>Vendas vinculadas</span><strong>' +
    totalVendasVinculadas +
    "</strong></article>" +
    '<article><span>Comissões</span><strong>' +
    formatarMoeda(totalComissoes) +
    "</strong></article>" +
    '<article><span>Melhor resultado</span><strong>' +
    escaparHTML(
      vendedoresComVenda[0]
        ? vendedoresComVenda[0].vendedor.nome
        : "Sem vendas no período"
    ) +
    "</strong></article>";

  listaVendedoresAdmin.innerHTML = vendedoresAdmin.length
    ? vendedoresAdmin
        .map(function (vendedor) {
          const idVendedor = Number(vendedor.id) || 0;

          return (
            '<article class="admin-item admin-item-simples">' +
            "<div>" +
            "<h4>" +
            escaparHTML(vendedor.nome) +
            "</h4>" +
            "<p>" +
            (vendedor.ativo !== false ? "Ativo" : "Inativo") +
            (vendedor.whatsapp ? " | WhatsApp: " + escaparHTML(vendedor.whatsapp) : "") +
            "</p>" +
            "<p>Comissão padrão: " +
            formatarMoeda(vendedor.comissaoPadrao || 0) +
            (vendedor.comissaoPercentualPadrao
              ? " | " + formatarPercentual(vendedor.comissaoPercentualPadrao) + "%"
              : "") +
            "</p>" +
            "</div>" +
            '<div class="admin-acoes">' +
            '<button type="button" class="btn-editar" onclick="editarVendedor(' +
            idVendedor +
            ')">Editar</button>' +
            '<button type="button" class="btn-excluir" onclick="excluirVendedor(' +
            idVendedor +
            ')">Excluir</button>' +
            "</div>" +
            "</article>"
          );
        })
        .join("")
    : '<p class="sem-resultados">Nenhum vendedor cadastrado.</p>';
}

function vendasHistoricoComissoes() {
  const mes = filtroFinanceiroMes ? filtroFinanceiroMes.value : "";
  const vendedorId = filtroHistoricoComissoes
    ? filtroHistoricoComissoes.value
    : "";

  return carrosAdmin
    .filter(function (carro) {
      return (
        carro.status === "Vendido" &&
        carroNoMesFinanceiro(carro, mes) &&
        (!vendedorId || Number(carro.vendedorId) === Number(vendedorId))
      );
    })
    .sort(function (a, b) {
      return String(b.dataVenda || "").localeCompare(String(a.dataVenda || ""));
    });
}

function renderizarHistoricoComissoes() {
  if (!listaHistoricoComissoes) return;

  const vendas = vendasHistoricoComissoes();
  const total = vendas.reduce(function (soma, carro) {
    return soma + (Number(carro.comissao) || 0);
  }, 0);
  const mes = filtroFinanceiroMes ? filtroFinanceiroMes.value : "";

  totalHistoricoComissoes.textContent = formatarMoeda(total);
  periodoHistoricoComissoes.textContent = mes
    ? "Período: " + mes.split("-").reverse().join("/")
    : "Todas as vendas registradas.";
  listaHistoricoComissoes.innerHTML = vendas.length
    ? vendas
        .map(function (carro) {
          const valorVenda =
            Number(carro.valorVenda) || precoNumero(carro.preco);
          return (
            '<article class="historico-comissao-item">' +
            '<img src="' +
            escaparAtributo(carro.imagem) +
            '" alt="' +
            escaparAtributo(carro.nome) +
            '">' +
            '<div class="historico-comissao-info"><h4>' +
            escaparHTML(carro.nome) +
            "</h4><p>" +
            escaparHTML(carro.vendedorNome || "Vendedor não informado") +
            " · " +
            escaparHTML(
              carro.dataVenda ? formatarDataBR(carro.dataVenda) : "Sem data"
            ) +
            '</p><div class="financeiro-item-meta"><span>Venda: ' +
            formatarMoeda(valorVenda) +
            "</span><span>Taxa: " +
            formatarPercentual(Number(carro.comissaoPercentual) || 0) +
            "%</span></div></div>" +
            '<strong class="historico-comissao-valor">' +
            formatarMoeda(Number(carro.comissao) || 0) +
            "</strong></article>"
          );
        })
        .join("")
    : '<p class="sem-resultados">Nenhuma comissão encontrada para este filtro.</p>';
}

function abrirHistoricoComissoes() {
  if (!modalComissoes) return;

  const atual = filtroHistoricoComissoes.value;
  filtroHistoricoComissoes.innerHTML =
    '<option value="">Todos os vendedores</option>';
  vendedoresAdmin.forEach(function (vendedor) {
    const option = document.createElement("option");
    option.value = vendedor.id;
    option.textContent = vendedor.nome;
    filtroHistoricoComissoes.appendChild(option);
  });
  filtroHistoricoComissoes.value = atual;
  renderizarHistoricoComissoes();
  modalComissoes.classList.add("ativo");
  modalComissoes.setAttribute("aria-hidden", "false");
  document.body.classList.add("modal-aberto");
}

function fecharHistoricoComissoes() {
  if (!modalComissoes) return;

  modalComissoes.classList.remove("ativo");
  modalComissoes.setAttribute("aria-hidden", "true");
  document.body.classList.remove("modal-aberto");
}

function renderizarCentralAtendimento(hoje, atrasados, propostas) {
  if (!centralListaPrioridades) return;

  const retornosHoje = leadsAdmin.filter(function (lead) {
    return (
      lead.proximoContato === hoje &&
      lead.status !== "Fechado" &&
      lead.status !== "Perdido"
    );
  });
  const novosRecentes = leadsAdmin.filter(function (lead) {
    const criado = String(lead.criadoEm || "").slice(0, 10);
    return lead.status === "Novo" || criado === hoje;
  });
  const prioridades = atrasados
    .map(function (lead) {
      return { lead: lead, tipo: "Atrasado", classe: "atrasado", ordem: 0 };
    })
    .concat(
      retornosHoje.map(function (lead) {
        return { lead: lead, tipo: "Hoje", classe: "hoje", ordem: 1 };
      })
    )
    .concat(
      propostas.map(function (lead) {
        return { lead: lead, tipo: "Proposta", classe: "proposta", ordem: 2 };
      })
    )
    .concat(
      novosRecentes.map(function (lead) {
        return { lead: lead, tipo: "Novo", classe: "novo", ordem: 3 };
      })
    )
    .filter(function (item, indice, lista) {
      return (
        lista.findIndex(function (comparar) {
          return Number(comparar.lead.id) === Number(item.lead.id);
        }) === indice
      );
    })
    .sort(function (a, b) {
      if (a.ordem !== b.ordem) return a.ordem - b.ordem;
      return String(a.lead.proximoContato || "9999-12-31").localeCompare(
        String(b.lead.proximoContato || "9999-12-31")
      );
    })
    .slice(0, 5);

  atualizarDashboardTexto("central-retornos-hoje", retornosHoje.length);
  atualizarDashboardTexto("central-retornos-atrasados", atrasados.length);
  atualizarDashboardTexto("central-clientes-novos", novosRecentes.length);
  atualizarDashboardTexto("central-propostas-abertas", propostas.length);

  if (centralPrioridadesResumo) {
    centralPrioridadesResumo.textContent = prioridades.length
      ? prioridades.length + " ação(ões)"
      : "Tudo em dia";
  }

  centralListaPrioridades.innerHTML = prioridades.length
    ? prioridades
        .map(function (item) {
          const lead = item.lead;
          const idLead = Number(lead.id) || 0;
          const prazo = lead.proximoContato
            ? formatarDataBR(lead.proximoContato)
            : "Sem data";
          const detalhe =
            item.classe === "proposta"
              ? "Enviar/acompanhar proposta"
              : item.classe === "novo"
                ? "Fazer primeiro contato"
                : "Retorno agendado: " + prazo;

          return (
            '<article class="central-prioridade-item prioridade-' +
            item.classe +
            '" role="button" tabindex="0" onclick="abrirFichaCliente(' +
            idLead +
            ')" onkeydown="if(event.key === \'Enter\' || event.key === \' \'){event.preventDefault();abrirFichaCliente(' +
            idLead +
            ')}">' +
            '<span class="central-prioridade-tag">' +
            escaparHTML(item.tipo) +
            "</span>" +
            "<div><strong>" +
            escaparHTML(lead.nome || "Cliente sem nome") +
            "</strong><small>" +
            escaparHTML(
              [lead.veiculoNome || "Sem veículo definido", lead.vendedorNome]
                .filter(Boolean)
                .join(" · ")
            ) +
            "</small></div>" +
            "<p>" +
            escaparHTML(detalhe) +
            "</p>" +
            '<button type="button" onclick="event.stopPropagation();abrirWhatsappLead(' +
            idLead +
            ', \'retorno\')">WhatsApp</button>' +
            "</article>"
          );
        })
        .join("")
    : '<p class="central-prioridades-vazio">Nenhuma pendência crítica agora. Bom momento para revisar propostas e novos contatos.</p>';
}

function renderizarClientes() {
  if (!listaLeadsAdmin || !listaFunilClientes) return;

  renderizarNotificacoes();

  const ativos = leadsAdmin.filter(function (lead) {
    return ["Novo", "Em atendimento", "Proposta"].indexOf(lead.status) !== -1;
  });
  const propostas = leadsAdmin.filter(function (lead) {
    return lead.status === "Proposta";
  });
  const fechados = leadsAdmin.filter(function (lead) {
    return lead.status === "Fechado";
  });
  const hoje = new Date().toISOString().slice(0, 10);
  const atrasados = leadsAdmin.filter(function (lead) {
    return (
      lead.proximoContato &&
      lead.proximoContato < hoje &&
      lead.status !== "Fechado" &&
      lead.status !== "Perdido"
    );
  });
  const etapas = ["Novo", "Em atendimento", "Proposta", "Fechado", "Perdido"];

  atualizarDashboardTexto("lead-total-ativos", ativos.length);
  atualizarDashboardTexto("lead-total-propostas", propostas.length);
  atualizarDashboardTexto("lead-total-fechados", fechados.length);
  atualizarDashboardTexto("lead-total-atrasados", atrasados.length);
  renderizarCentralAtendimento(hoje, atrasados, propostas);

  listaFunilClientes.innerHTML = etapas
    .map(function (etapa) {
      const total = leadsAdmin.filter(function (lead) {
        return lead.status === etapa;
      }).length;

      return (
        '<div class="analytics-lista-item">' +
        '<span class="analytics-nome">' +
        escaparHTML(etapa) +
        "</span>" +
        "<strong>" +
        total +
        "</strong>" +
        "</div>"
      );
    })
    .join("");

  const busca = normalizarTextoAdmin(inputLeadBusca ? inputLeadBusca.value : "");
  const filtroStatus = selectLeadFiltroStatus ? selectLeadFiltroStatus.value : "";
  const filtroContato = selectLeadFiltroContato ? selectLeadFiltroContato.value : "";
  const leadsFiltrados = leadsAdmin.filter(function (lead) {
    const texto = normalizarTextoAdmin(
      [
        lead.nome,
        lead.whatsapp,
        lead.email,
        lead.cpf,
        lead.cidade,
        lead.estado,
        lead.profissao,
        lead.vendedorNome,
        lead.temperatura,
        lead.tarefa,
        lead.motivoPerda,
        lead.origem,
        lead.veiculoNome,
        lead.observacao,
      ].join(" ")
    );
    const combinaBusca = !busca || texto.includes(busca);
    const combinaStatus = !filtroStatus || lead.status === filtroStatus;
    let combinaContato = true;

    if (filtroContato === "atrasados") {
      combinaContato =
        Boolean(lead.proximoContato) &&
        lead.proximoContato < hoje &&
        lead.status !== "Fechado" &&
        lead.status !== "Perdido";
    } else if (filtroContato === "hoje") {
      combinaContato = lead.proximoContato === hoje;
    } else if (filtroContato === "proximos") {
      combinaContato = Boolean(lead.proximoContato) && lead.proximoContato > hoje;
    } else if (filtroContato === "sem-data") {
      combinaContato = !lead.proximoContato;
    }

    return combinaBusca && combinaStatus && combinaContato;
  });

  const leadsOrdenados = leadsFiltrados.slice().sort(function (a, b) {
    const prioridadeA =
      a.proximoContato && a.proximoContato <= hoje ? 0 : 1;
    const prioridadeB =
      b.proximoContato && b.proximoContato <= hoje ? 0 : 1;

    if (prioridadeA !== prioridadeB) return prioridadeA - prioridadeB;

    return String(b.atualizadoEm || b.criadoEm || "").localeCompare(
      String(a.atualizadoEm || a.criadoEm || "")
    );
  });
  const totalPaginasClientes = Math.max(
    1,
    Math.ceil(leadsOrdenados.length / itensPorPaginaClientes)
  );
  paginaClientes = Math.min(paginaClientes, totalPaginasClientes);
  const inicioClientes = (paginaClientes - 1) * itensPorPaginaClientes;
  const leadsPagina = leadsOrdenados.slice(
    inicioClientes,
    inicioClientes + itensPorPaginaClientes
  );

  listaLeadsAdmin.innerHTML = leadsPagina.length
    ? '<div class="clientes-tabela">' +
      '<div class="clientes-tabela-head">' +
      "<span>Nome</span>" +
      "<span>CPF</span>" +
      "<span>Telefone</span>" +
      "<span>Interesse</span>" +
      "<span>Status</span>" +
      "<span>Ações</span>" +
      "</div>" +
      leadsPagina
        .map(function (lead) {
          const idLead = Number(lead.id) || 0;
          const contatoAtrasado =
            lead.proximoContato &&
            lead.proximoContato < hoje &&
            lead.status !== "Fechado" &&
            lead.status !== "Perdido";
          const contatoHoje = lead.proximoContato === hoje;
          const iniciais = String(lead.nome || "CL")
            .split(" ")
            .filter(Boolean)
            .slice(0, 2)
            .map(function (parte) {
              return parte.charAt(0);
            })
            .join("")
            .toUpperCase();
          const localizacao = [lead.cidade, lead.estado].filter(Boolean).join(" / ");
          const detalheContato = contatoAtrasado
            ? "Retorno atrasado: " + formatarDataBR(lead.proximoContato)
            : contatoHoje
              ? "Retorno hoje"
              : lead.proximoContato
                ? "Próximo: " + formatarDataBR(lead.proximoContato)
                : "Sem retorno agendado";

          return (
            '<article class="cliente-linha lead-status-' +
            normalizarTextoAdmin(lead.status || "novo").replace(/\s+/g, "-") +
            (contatoAtrasado ? " cliente-contato-atrasado" : "") +
            (contatoHoje ? " cliente-contato-hoje" : "") +
            '" role="button" tabindex="0" onclick="abrirFichaCliente(' +
            idLead +
            ')" onkeydown="if(event.key === \'Enter\' || event.key === \' \'){event.preventDefault();abrirFichaCliente(' +
            idLead +
            ')}">' +
            '<div class="cliente-col cliente-col-nome">' +
            '<span class="cliente-avatar">' +
            escaparHTML(iniciais || "CL") +
            "</span>" +
            "<div><strong>" +
            escaparHTML(lead.nome || "Cliente sem nome") +
            "</strong><small>" +
            escaparHTML(lead.email || lead.origem || "Sem e-mail informado") +
            "</small></div>" +
            "</div>" +
            '<div class="cliente-col cliente-col-cpf" data-label="CPF"><span>' +
            escaparHTML(lead.cpf || "Não informado") +
            "</span></div>" +
            '<div class="cliente-col cliente-col-telefone" data-label="Telefone"><span>' +
            escaparHTML(lead.whatsapp || "Não informado") +
            "</span><small>" +
            escaparHTML(localizacao || lead.origem || "") +
            "</small></div>" +
            '<div class="cliente-col cliente-col-interesse" data-label="Interesse"><span>' +
            escaparHTML(lead.veiculoNome || "Sem veículo definido") +
            "</span><small>" +
            escaparHTML(detalheContato) +
            "</small></div>" +
            '<div class="cliente-col cliente-col-status" data-label="Status"><span class="cliente-status">' +
            escaparHTML(lead.status || "Novo") +
            "</span><small>" +
            escaparHTML(lead.temperatura || "Morno") +
            (lead.vendedorNome ? " · " + escaparHTML(lead.vendedorNome) : "") +
            "</small></div>" +
            '<div class="cliente-col cliente-col-acoes" onclick="event.stopPropagation()">' +
            '<button type="button" title="Ver ficha" aria-label="Ver ficha" onclick="abrirFichaCliente(' +
            idLead +
            ')">👁</button>' +
            '<button type="button" title="Retorno WhatsApp" aria-label="Retorno WhatsApp" onclick="abrirWhatsappLead(' +
            idLead +
            ', \'retorno\')">↩</button>' +
            '<button type="button" title="Proposta" aria-label="Proposta" onclick="abrirWhatsappLead(' +
            idLead +
            ', \'proposta\')">💬</button>' +
            '<button type="button" title="Financiamento" aria-label="Financiamento" onclick="abrirWhatsappLead(' +
            idLead +
            ', \'financiamento\')">R$</button>' +
            '<button type="button" title="Editar" aria-label="Editar cliente" onclick="editarLead(' +
            idLead +
            ')">✎</button>' +
            '<button type="button" class="cliente-acao-excluir" title="Excluir" aria-label="Excluir cliente" onclick="excluirLead(' +
            idLead +
            ')">×</button>' +
            "</div>" +
            "</article>"
          );
        })
        .join("") +
      "</div>"
    : '<p class="sem-resultados">Nenhum cliente encontrado com estes filtros.</p>';

  renderizarPaginacao(
    paginacaoClientes,
    leadsOrdenados.length,
    paginaClientes,
    itensPorPaginaClientes,
    "clientes"
  );
  renderizarKanbanClientes();
}

function vendedorLeadPorId(id) {
  return vendedoresAdmin.find(function (vendedor) {
    return Number(vendedor.id) === Number(id);
  });
}

function preencherVendedoresLead() {
  if (!selectLeadVendedor) return;

  const atual = selectLeadVendedor.value;
  selectLeadVendedor.innerHTML = '<option value="">Sem responsável</option>';

  vendedoresAdmin
    .filter(function (vendedor) {
      return vendedor.ativo !== false;
    })
    .forEach(function (vendedor) {
      const option = document.createElement("option");
      option.value = vendedor.id;
      option.textContent = vendedor.nome;
      selectLeadVendedor.appendChild(option);
    });

  selectLeadVendedor.value = atual;
}

function renderizarKanbanClientes() {
  if (!kanbanClientes) return;

  const etapas = ["Novo", "Em atendimento", "Proposta", "Fechado", "Perdido"];
  kanbanClientes.innerHTML = etapas
    .map(function (etapa) {
      const itens = leadsAdmin.filter(function (lead) {
        return lead.status === etapa;
      });

      return (
        '<section class="kanban-coluna" data-kanban-status="' +
        escaparAtributo(etapa) +
        '">' +
        '<header><strong>' +
        escaparHTML(etapa) +
        "</strong><span>" +
        itens.length +
        "</span></header>" +
        '<div class="kanban-lista">' +
        itens
          .map(function (lead) {
            const vendedor = vendedorLeadPorId(lead.vendedorId);

            return (
              '<article class="kanban-card temperatura-' +
              normalizarTextoAdmin(lead.temperatura || "morno") +
              '" draggable="true" data-lead-id="' +
              Number(lead.id) +
              '">' +
              "<strong>" +
              escaparHTML(lead.nome) +
              "</strong>" +
              "<span>" +
              escaparHTML(lead.veiculoNome || "Sem veículo definido") +
              "</span>" +
              "<small>" +
              escaparHTML(
                vendedor ? vendedor.nome : lead.temperatura || "Morno"
              ) +
              "</small>" +
              "</article>"
            );
          })
          .join("") +
        "</div></section>"
      );
    })
    .join("");

  kanbanClientes.querySelectorAll(".kanban-card").forEach(function (card) {
    card.addEventListener("dragstart", function (evento) {
      evento.dataTransfer.setData("text/plain", card.dataset.leadId);
      card.classList.add("arrastando");
    });
    card.addEventListener("dragend", function () {
      card.classList.remove("arrastando");
    });
  });

  kanbanClientes.querySelectorAll(".kanban-coluna").forEach(function (coluna) {
    coluna.addEventListener("dragover", function (evento) {
      evento.preventDefault();
      coluna.classList.add("recebendo");
    });
    coluna.addEventListener("dragleave", function () {
      coluna.classList.remove("recebendo");
    });
    coluna.addEventListener("drop", function (evento) {
      evento.preventDefault();
      coluna.classList.remove("recebendo");
      const id = Number(evento.dataTransfer.getData("text/plain"));
      const status = coluna.dataset.kanbanStatus;

      leadsAdmin = leadsAdmin.map(function (lead) {
        if (Number(lead.id) !== id) return lead;

        return {
          ...lead,
          status: status,
          atualizadoEm: new Date().toISOString(),
        };
      });

      salvarLeadsAdmin();
      renderizarClientes();
    });
  });
}

function renderizarHistoricoVeiculos() {
  if (!listaHistoricoVeiculos) return;

  const filtro = selectHistoricoVeiculo ? selectHistoricoVeiculo.value : "";
  const historico = historicoVeiculosAdmin.filter(function (item) {
    return !filtro || Number(item.carroId) === Number(filtro);
  });

  listaHistoricoVeiculos.innerHTML = historico.length
    ? historico
        .slice(0, 80)
        .map(function (item) {
          const dataHistorico = item.data
            ? new Date(item.data).toLocaleString("pt-BR")
            : "Data não informada";

          return (
            '<article class="historico-item historico-veiculo-card">' +
            '<div class="historico-item-icone" aria-hidden="true">' +
            escaparHTML(String(item.tipo || "H").slice(0, 1).toUpperCase()) +
            "</div>" +
            '<div class="historico-item-corpo">' +
            '<div class="historico-item-topo">' +
            "<h4 title=\"" +
            escaparAtributo(item.tipo || "Histórico") +
            "\">" +
            escaparHTML(item.tipo || "Histórico") +
            "</h4>" +
            "<time>" +
            escaparHTML(dataHistorico) +
            "</time>" +
            "</div>" +
            '<div class="historico-item-meta">' +
            "<span>" +
            escaparHTML(item.carroNome || "Veículo não informado") +
            "</span>" +
            "</div>" +
            "<p>" +
            escaparHTML(item.descricao || "") +
            "</p>" +
            "</div>" +
            "</article>"
          );
        })
        .join("")
    : '<p class="sem-resultados">Nenhum histórico registrado.</p>';
}

function limparFormularioLead() {
  if (!formLead) return;

  formLead.reset();
  document.getElementById("lead-id").value = "";
  btnLeadSalvar.textContent = "Salvar cliente";
  tituloFormLead.textContent = "Cadastrar cliente";
  btnLeadCancelar.style.display = "none";
  fecharCadastroAdmin("form-lead");
}

function valorFichaCliente(rotulo, valor) {
  if (valor === null || valor === undefined || valor === "") return "";

  return (
    '<article><span>' +
    escaparHTML(rotulo) +
    "</span><strong>" +
    escaparHTML(valor) +
    "</strong></article>"
  );
}

function financiamentosDoCliente(lead) {
  return solicitacoesFinanciamentoAdmin.filter(function (item) {
    return (
      Number(item.lead_id) === Number(lead.id) ||
      (lead.cpf && item.cpf === lead.cpf)
    );
  });
}

function renderizarFinanciamentosCliente(lead) {
  if (!modalClienteFinanciamentos) return;

  const financiamentos = financiamentosDoCliente(lead);
  modalClienteFinanciamentos.innerHTML = financiamentos.length
    ? financiamentos
        .map(function (item) {
          const documentos = Array.isArray(item.documents) ? item.documents : [];
          const links = documentos.length
            ? '<div class="cliente-documentos">' +
              documentos
                .map(function (documento) {
                  return (
                    '<a href="/api/financing-documents/' +
                    Number(documento.id) +
                    '" target="_blank" rel="noopener">' +
                    escaparHTML(documento.category || "Documento") +
                    ": " +
                    escaparHTML(documento.original_name || "Arquivo") +
                    "</a>"
                  );
                })
                .join("") +
              "</div>"
            : '<small>Nenhum documento enviado.</small>';

          return (
            '<article class="cliente-financiamento-item">' +
            '<div><strong>' +
            escaparHTML(item.status || "Recebida") +
            "</strong><span>Protocolo " +
            escaparHTML(item.protocol || "não informado") +
            "</span></div>" +
            '<div class="financeiro-item-meta">' +
            (item.requested_amount
              ? "<span>Solicitado: " +
                escaparHTML(formatarMoeda(Number(item.requested_amount))) +
                "</span>"
              : "") +
            (item.institution
              ? "<span>Instituição: " + escaparHTML(item.institution) + "</span>"
              : "") +
            "</div>" +
            links +
            "</article>"
          );
        })
        .join("")
    : '<p class="sem-resultados">Nenhuma solicitação de financiamento vinculada.</p>';
}

function renderizarHistoricoCliente(lead, comunicacoes) {
  if (!modalClienteHistorico) return;

  const legado = Array.isArray(lead.historico)
    ? lead.historico.map(function (item) {
        return {
          channel: item.tipo || "Atendimento",
          direction: "",
          message: item.texto || "",
          sent_at: item.data || item.criadoEm || "",
        };
      })
    : [];
  const historico = comunicacoes.concat(legado).sort(function (a, b) {
    return String(b.sent_at || "").localeCompare(String(a.sent_at || ""));
  });

  modalClienteHistorico.innerHTML = historico.length
    ? historico
        .map(function (item) {
          const data = item.sent_at
            ? new Date(item.sent_at).toLocaleString("pt-BR")
            : "Data não informada";
          return (
            '<article class="cliente-historico-item">' +
            '<div><strong>' +
            escaparHTML(item.channel || "Atendimento") +
            "</strong>" +
            (item.direction
              ? "<span>" + escaparHTML(item.direction) + "</span>"
              : "") +
            "</div><p>" +
            escaparHTML(item.message || "") +
            "</p><small>" +
            escaparHTML(data) +
            "</small></article>"
          );
        })
        .join("")
    : '<p class="sem-resultados">Nenhuma interação registrada.</p>';
}

async function carregarHistoricoCliente(lead) {
  if (!modalClienteHistorico) return;

  modalClienteHistorico.innerHTML =
    '<p class="sem-resultados">Carregando histórico...</p>';

  try {
    const resposta = await fetch("/api/leads/" + Number(lead.id) + "/communications", {
      headers: { Accept: "application/json" },
    });
    if (!resposta.ok) throw new Error();
    renderizarHistoricoCliente(lead, (await resposta.json()).data || []);
  } catch (erro) {
    renderizarHistoricoCliente(lead, []);
  }
}

function abrirFichaCliente(id) {
  const lead = leadsAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!lead || !modalCliente) return;

  clienteModalId = Number(lead.id);
  modalClienteNome.textContent = lead.nome || "Cliente";
  modalClienteResumo.textContent =
    (lead.veiculoNome ? "Interesse em " + lead.veiculoNome + " · " : "") +
    (lead.vendedorNome ? "Responsável: " + lead.vendedorNome : "Sem responsável");
  modalClienteStatus.textContent = lead.status || "Novo";
  modalClienteDados.innerHTML =
    valorFichaCliente("WhatsApp", lead.whatsapp || "Não informado") +
    valorFichaCliente("E-mail", lead.email) +
    valorFichaCliente("CPF", lead.cpf) +
    valorFichaCliente("Nascimento", lead.dataNascimento ? formatarDataBR(lead.dataNascimento) : "") +
    valorFichaCliente("Endereço", [lead.endereco, lead.numero].filter(Boolean).join(", ")) +
    valorFichaCliente("Complemento", lead.complemento) +
    valorFichaCliente("Bairro", lead.bairro) +
    valorFichaCliente("Cidade/UF", [lead.cidade, lead.estado].filter(Boolean).join(" / ")) +
    valorFichaCliente("Profissão", lead.profissao) +
    valorFichaCliente("Renda mensal", lead.rendaMensal ? formatarMoeda(Number(lead.rendaMensal)) : "") +
    valorFichaCliente("Origem", lead.origem || "Não informada") +
    valorFichaCliente("Temperatura", lead.temperatura || "Morno") +
    valorFichaCliente("Próximo contato", lead.proximoContato ? formatarDataBR(lead.proximoContato) : "") +
    valorFichaCliente("Próxima tarefa", lead.tarefa) +
    valorFichaCliente("Observações", lead.observacao);

  linkModalClienteLigar.href = lead.whatsapp
    ? "tel:" + String(lead.whatsapp).replace(/\D/g, "")
    : "#";
  linkModalClienteLigar.classList.toggle("desativado", !lead.whatsapp);
  retornoComunicacaoCliente.className = "admin-retorno";
  retornoComunicacaoCliente.textContent = "";
  formComunicacaoCliente.reset();
  renderizarFinanciamentosCliente(lead);
  carregarHistoricoCliente(lead);
  modalCliente.classList.add("ativo");
  modalCliente.setAttribute("aria-hidden", "false");
  document.body.classList.add("modal-aberto");
}

function fecharFichaCliente() {
  if (!modalCliente) return;

  modalCliente.classList.remove("ativo");
  modalCliente.setAttribute("aria-hidden", "true");
  document.body.classList.remove("modal-aberto");
  clienteModalId = null;
}

function editarLead(id) {
  const lead = leadsAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!lead) return;

  if (modalCliente?.classList.contains("ativo")) fecharFichaCliente();
  abrirCadastroAdmin("form-lead");
  document.getElementById("lead-id").value = lead.id;
  document.getElementById("lead-nome").value = lead.nome || "";
  document.getElementById("lead-whatsapp").value = lead.whatsapp || "";
  document.getElementById("lead-email").value = lead.email || "";
  document.getElementById("lead-cpf").value = lead.cpf || "";
  document.getElementById("lead-data-nascimento").value =
    lead.dataNascimento || "";
  document.getElementById("lead-cep").value = lead.cep || "";
  document.getElementById("lead-endereco").value = lead.endereco || "";
  document.getElementById("lead-numero").value = lead.numero || "";
  document.getElementById("lead-complemento").value = lead.complemento || "";
  document.getElementById("lead-bairro").value = lead.bairro || "";
  document.getElementById("lead-cidade").value = lead.cidade || "";
  document.getElementById("lead-estado").value = lead.estado || "";
  document.getElementById("lead-profissao").value = lead.profissao || "";
  document.getElementById("lead-renda-mensal").value =
    lead.rendaMensal ? formatarCampoMoedaValor(lead.rendaMensal) : "";
  document.getElementById("lead-origem").value = lead.origem || "Site";
  document.getElementById("lead-veiculo").value = lead.veiculoId || "";
  document.getElementById("lead-status").value = lead.status || "Novo";
  document.getElementById("lead-temperatura").value =
    lead.temperatura || "Morno";
  document.getElementById("lead-motivo-perda").value =
    lead.motivoPerda || "";
  document.getElementById("lead-tarefa").value = lead.tarefa || "";
  document.getElementById("lead-prazo-tarefa").value =
    lead.prazoTarefa || "";
  document.getElementById("lead-consentimento").checked =
    lead.consentimento === true;
  if (selectLeadVendedor) {
    selectLeadVendedor.value = lead.vendedorId || "";
  }
  document.getElementById("lead-proximo-contato").value = lead.proximoContato || "";
  document.getElementById("lead-observacao").value = lead.observacao || "";
  document.getElementById("lead-interacao").value = "";
  btnLeadSalvar.textContent = "Atualizar cliente";
  tituloFormLead.textContent = "Editar cliente";
  btnLeadCancelar.style.display = "inline-flex";
  abrirAbaAdmin("clientes");
}

async function excluirLead(id) {
  const lead = leadsAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!lead || !(await confirmar("Excluir cliente " + lead.nome + "?", "Excluir cliente"))) return;

  leadsAdmin = leadsAdmin.filter(function (item) {
    return Number(item.id) !== Number(id);
  });
  salvarLeadsAdmin();
  renderizarClientes();
}

function marcarChecklistCompleto(id) {
  const carroAtual = carrosAdmin.find(function (carro) {
    return Number(carro.id) === Number(id);
  });

  if (!carroAtual) return;

  carrosAdmin = carrosAdmin.map(function (carro) {
    if (Number(carro.id) !== Number(id)) return carro;

    return {
      ...carro,
      checklistAnuncio: "Completo",
      preparacaoStatus:
        carro.preparacaoStatus === "Anunciado" ? "Pronto para venda" : carro.preparacaoStatus || "Anunciado",
    };
  });

  salvarCarros(carrosAdmin);
  registrarHistoricoVeiculo(id, "Checklist", "Checklist do anúncio marcado como completo.", {});
  renderizarAdmin();
}

function gerarTextoWhatsappLead(lead, tipo) {
  const loja = carregarConfigLoja();
  const nome = lead.nome ? lead.nome.split(" ")[0] : "tudo bem";
  const veiculo = lead.veiculoNome || "o veículo";

  if (tipo === "proposta") {
    return (
      "Olá, " +
      nome +
      "! Aqui é da " +
      loja.nome +
      ". Separei as condições para " +
      veiculo +
      ". Posso te enviar a proposta e tirar suas dúvidas?"
    );
  }

  if (tipo === "financiamento") {
    return (
      "Olá, " +
      nome +
      "! Para avançarmos com a simulação bancária de " +
      veiculo +
      ", a loja solicitará os demais dados necessários com segurança e autorização LGPD."
    );
  }

  return (
    "Olá, " +
    nome +
    "! Passando para continuar seu atendimento sobre " +
    veiculo +
    ". Posso te ajudar agora?"
  );
}

function abrirWhatsappLead(id, tipo) {
  const lead = leadsAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!lead) return;

  const telefone = String(lead.whatsapp || "").replace(/\D/g, "");
  const texto = gerarTextoWhatsappLead(lead, tipo || "retorno");
  const url = "https://wa.me/55" + telefone + "?text=" + encodeURIComponent(texto);

  window.open(url, "_blank");
}

function gerarPropostaVeiculo(id) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!carro) return;

  const loja = carregarConfigLoja();
  const validade = new Date(Date.now() + 3 * 86400000).toLocaleDateString("pt-BR");
  const html =
    "<!doctype html><html><head><meta charset='utf-8'><title>Proposta " +
    escaparHTML(carro.nome) +
    "</title><style>body{font-family:Arial,sans-serif;color:#111827;margin:40px}h1{font-size:30px}section{border:1px solid #e5e7eb;border-radius:14px;padding:22px;margin:18px 0}.preco{font-size:36px;font-weight:900;color:#e11d48}.meta{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}.meta span{background:#f3f4f6;border-radius:10px;padding:12px;font-weight:700}.assinatura{margin-top:50px;border-top:1px solid #111827;width:320px;padding-top:8px}@media print{button{display:none}}</style></head><body><button onclick='print()'>Imprimir / PDF</button><h1>Proposta comercial</h1><p><b>" +
    escaparHTML(loja.nome) +
    "</b> | " +
    escaparHTML(loja.whatsapp || "") +
    "</p><section><h2>" +
    escaparHTML(carro.nome) +
    "</h2><p class='preco'>" +
    escaparHTML(carro.preco) +
    "</p><div class='meta'><span>Ano: " +
    escaparHTML(carro.ano) +
    "</span><span>Km: " +
    escaparHTML(carro.km) +
    "</span><span>Câmbio: " +
    escaparHTML(carro.cambio) +
    "</span><span>Cor: " +
    escaparHTML(carro.cor || "-") +
    "</span><span>Combustível: " +
    escaparHTML(carro.combustivel || "-") +
    "</span><span>Status: " +
    escaparHTML(carro.status || "-") +
    "</span></div><p>" +
    escaparHTML(carro.descricao || "") +
    "</p></section><section><h2>Condições</h2><p>Proposta válida até " +
    validade +
    ". Valores sujeitos à confirmação de disponibilidade, avaliação de troca e aprovação bancária quando houver financiamento.</p></section><p class='assinatura'>Responsável pela proposta</p></body></html>";
  const janela = window.open("", "_blank");

  if (!janela) return;

  janela.document.write(html);
  janela.document.close();
}

async function excluirSaidaFinanceira(id) {
  const saida = saidasFinanceiras.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!saida || !(await confirmar("Excluir esta saída financeira?", "Excluir saída"))) return;

  saidasFinanceiras = saidasFinanceiras.filter(function (item) {
    return Number(item.id) !== Number(id);
  });

  salvarSaidasFinanceiras();
  renderizarFinanceiro();
}

async function marcarSaldoRecebido(id) {
  const carroAtual = carrosAdmin.find(function (carro) {
    return Number(carro.id) === Number(id);
  });

  if (!carroAtual || !Number(carroAtual.saldoReceber)) return;
  if (!(await confirmar("Marcar o saldo pendente como recebido?", "Confirmar recebimento"))) return;

  const saldo = Number(carroAtual.saldoReceber) || 0;

  carrosAdmin = carrosAdmin.map(function (carro) {
    if (Number(carro.id) !== Number(id)) return carro;

    return {
      ...carro,
      valorRecebido: (Number(carro.valorRecebido) || valorCaixaVenda(carro)) + saldo,
      saldoReceber: 0,
      dataRecebimentoSaldo: new Date().toISOString().slice(0, 10),
    };
  });

  salvarCarros(carrosAdmin);
  registrarHistoricoVeiculo(
    id,
    "Recebimento",
    "Saldo a receber marcado como recebido: " + formatarMoeda(saldo),
    { valor: saldo }
  );
  renderizarAdmin();
}

function limparFormularioVendedor() {
  if (!formVendedor) return;

  formVendedor.reset();
  document.getElementById("vendedor-id").value = "";
  document.getElementById("vendedor-ativo").checked = true;
  btnVendedorSalvar.textContent = "Salvar vendedor";
  tituloFormVendedor.textContent = "Cadastrar vendedor";
  btnVendedorCancelar.style.display = "none";
  fecharCadastroAdmin("form-vendedor");
}

function editarVendedor(id) {
  const vendedor = vendedorPorId(id);

  if (!vendedor) return;

  abrirCadastroAdmin("form-vendedor");
  document.getElementById("vendedor-id").value = vendedor.id;
  document.getElementById("vendedor-nome").value = vendedor.nome;
  document.getElementById("vendedor-whatsapp").value = vendedor.whatsapp || "";
  document.getElementById("vendedor-comissao-padrao").value =
    formatarCampoMoedaValor(vendedor.comissaoPadrao);
  document.getElementById("vendedor-comissao-tipo").value =
    vendedor.comissaoTipo || "fixa";
  document.getElementById("vendedor-comissao-percentual").value =
    vendedor.comissaoPercentualPadrao || "";
  document.getElementById("vendedor-ativo").checked = vendedor.ativo !== false;
  btnVendedorSalvar.textContent = "Salvar alterações";
  tituloFormVendedor.textContent = "Editar vendedor";
  btnVendedorCancelar.style.display = "inline-block";
  abrirAbaAdmin("vendedores");
  formVendedor.scrollIntoView({ behavior: "smooth", block: "start" });
}

async function excluirVendedor(id) {
  const vendedor = vendedorPorId(id);

  if (!vendedor || !(await confirmar("Excluir vendedor " + vendedor.nome + "?", "Excluir vendedor"))) return;

  vendedoresAdmin = vendedoresAdmin.filter(function (item) {
    return Number(item.id) !== Number(id);
  });

  carrosAdmin = carrosAdmin.map(function (carro) {
    if (Number(carro.vendedorId) !== Number(id)) return carro;

    return {
      ...carro,
      vendedorId: "",
      vendedorNome: "",
    };
  });

  salvarVendedores();
  salvarCarros(carrosAdmin);
  renderizarAdmin();
}

function montarDepoimento(idExistente) {
  const depoimentoExistente = depoimentosAdmin.find(function (depoimento) {
    return Number(depoimento.id) === Number(idExistente);
  });

  return {
    id: idExistente
      ? Number(idExistente)
      : gerarIdUnico([depoimentosAdmin, carrosAdmin, parceriasAdmin]),
    cliente: document.getElementById("depoimento-cliente").value.trim(),
    veiculo: document.getElementById("depoimento-veiculo").value.trim(),
    texto: document.getElementById("depoimento-texto").value.trim(),
    imagem:
      imagemDepoimentoBase64 ||
      (depoimentoExistente && depoimentoExistente.imagem) ||
      "https://via.placeholder.com/700x450?text=Foto+da+entrega",
  };
}

function renderizarDepoimentosAdmin() {
  renderizarDashboard();
  listaDepoimentosAdmin.innerHTML = "";

  depoimentosAdmin.forEach(function (depoimento) {
    const idDepoimento = Number(depoimento.id) || 0;

    listaDepoimentosAdmin.innerHTML +=
      '<article class="admin-item admin-item-depoimento">' +
      '<img src="' +
      escaparAtributo(depoimento.imagem) +
      '" alt="Foto da entrega para ' +
      escaparAtributo(depoimento.cliente) +
      '">' +
      "<div>" +
      "<h4>" +
      escaparHTML(depoimento.cliente) +
      "</h4>" +
      "<p>Comprou " +
      escaparHTML(depoimento.veiculo) +
      "</p>" +
      "<p>" +
      escaparHTML(depoimento.texto) +
      "</p>" +
      "</div>" +
      '<div class="admin-acoes">' +
      '<button type="button" class="btn-editar" onclick="editarDepoimento(' +
      idDepoimento +
      ')">Editar</button>' +
      '<button type="button" class="btn-excluir" onclick="excluirDepoimento(' +
      idDepoimento +
      ')">Excluir</button>' +
      "</div>" +
      "</article>";
  });
}

function montarParceria(idExistente) {
  return {
    id: idExistente
      ? Number(idExistente)
      : gerarIdUnico([parceriasAdmin, carrosAdmin, depoimentosAdmin]),
    nome: document.getElementById("parceria-nome").value.trim(),
    ativo: document.getElementById("parceria-ativo").checked,
  };
}

function renderizarParceriasAdmin() {
  renderizarDashboard();
  listaParceriasAdmin.innerHTML = "";

  parceriasAdmin.forEach(function (parceria) {
    const idParceria = Number(parceria.id) || 0;

    listaParceriasAdmin.innerHTML +=
      '<article class="admin-item admin-item-simples">' +
      "<div>" +
      "<h4>" +
      escaparHTML(parceria.nome) +
      "</h4>" +
      "<p>" +
      (parceria.ativo ? "Visível na home" : "Oculta na home") +
      "</p>" +
      "</div>" +
      '<div class="admin-acoes">' +
      '<button type="button" class="btn-editar" onclick="editarParceria(' +
      idParceria +
      ')">Editar</button>' +
      '<button type="button" class="btn-excluir" onclick="excluirParceria(' +
      idParceria +
      ')">Excluir</button>' +
      "</div>" +
      "</article>";
  });
}

function editarCarro(id) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!carro) return;

  abrirCadastroAdmin("form-carro");
  document.getElementById("carro-id").value = carro.id;
  if (
    carro.marca &&
    !Array.from(selectMarca.options).some(function (option) {
      return option.value === carro.marca;
    })
  ) {
    const option = document.createElement("option");
    option.value = carro.marca;
    option.textContent = carro.marca;
    selectMarca.appendChild(option);
  }

  selectMarca.value = carro.marca || carro.nome.split(" ")[0];
  document.getElementById("modelo").value =
    carro.modelo || carro.nome.replace((carro.marca || "") + " ", "");
  document.getElementById("ano").value = carro.ano;
  document.getElementById("km").value = carro.km;
  document.getElementById("cambio").value = carro.cambio;
  document.getElementById("tipo").value = carro.tipo;
  document.getElementById("status").value = carro.status;
  document.getElementById("preco").value = formatarCampoMoedaValor(carro.preco);
  document.getElementById("data-entrada").value = carro.dataEntrada || "";
  document.getElementById("preparacao-status").value =
    carro.preparacaoStatus || "Aguardando revisão";
  document.getElementById("checklist-anuncio").value = carro.checklistAnuncio || "Pendente";
  document.getElementById("combustivel").value = carro.combustivel || "";
  document.getElementById("cor").value = carro.cor || "";
  document.getElementById("portas").value = carro.portas || "";
  document.getElementById("placa-final").value = carro.placaFinal || "";
  document.getElementById("preco-compra").value = formatarCampoMoedaValor(
    carro.precoCompra
  );
  document.getElementById("custo-preparacao").value = formatarCampoMoedaValor(
    carro.custoPreparacao
  );
  document.getElementById("comissao-percentual").value = carro.comissaoPercentual || "";
  document.getElementById("comissao").value = formatarCampoMoedaValor(carro.comissao);
  document.getElementById("taxas").value = formatarCampoMoedaValor(carro.taxas);
  document.getElementById("valor-venda").value = formatarCampoMoedaValor(
    carro.valorVenda
  );
  document.getElementById("data-venda").value = carro.dataVenda || "";
  preencherVendedoresVenda();
  document.getElementById("vendedor-venda").value = carro.vendedorId || "";
  document.getElementById("descricao").value = carro.descricao || "";
  document.getElementById("opcionais").value = (carro.opcionais || []).join(", ");
  document.getElementById("galeria-urls").value = (carro.galeria || [])
    .filter(function (imagem) {
      return imagem !== carro.imagem && !String(imagem).startsWith("data:image");
    })
    .join("\n");
  galeriaUploadBase64 = (carro.galeria || []).filter(function (imagem) {
    return imagem !== carro.imagem && String(imagem).startsWith("data:image");
  });
  document.getElementById("oferta").checked = Boolean(carro.oferta);
  document.getElementById("destaque").checked = Boolean(carro.destaque);
  document.getElementById("blindado").checked = Boolean(carro.blindado);

  previewImg.src = carro.imagem;
  previewImg.style.display = "block";
  renderizarGaleriaAdmin();
  renderizarPreviewCard();
  renderizarLucroFormulario();
  imagemBase64 = "";
  btnSalvar.textContent = "Salvar alteracoes";
  tituloForm.textContent = "Editar veículo";
  btnCancelar.style.display = "inline-block";
  abrirAbaAdmin("veiculos");
  form.scrollIntoView({ behavior: "smooth", block: "start" });
}

function duplicarCarro(id) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!carro) return;

  const copia = {
    ...carro,
    id: gerarIdUnico([carrosAdmin, depoimentosAdmin, parceriasAdmin]),
    modelo: carro.modelo + " - copia",
    nome: carro.nome + " - copia",
    status: "Disponível",
    precoCompra: 0,
    custoPreparacao: 0,
    comissao: 0,
    taxas: 0,
    valorVenda: 0,
    dataVenda: "",
    temTroca: false,
    trocaVeiculo: "",
    trocaValor: 0,
    valorRecebido: 0,
    saldoReceber: 0,
    trocaEstoqueId: "",
    origem: "",
    origemTrocaVendaId: "",
    origemTrocaVeiculo: "",
  };

  carrosAdmin.push(copia);
  salvarCarros(carrosAdmin);
  renderizarAdmin();
}

async function excluirCarro(id) {
  const carro = carrosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!carro || !(await confirmar("Excluir " + carro.nome + "?", "Excluir veículo"))) {
    return;
  }

  carrosAdmin = carrosAdmin.filter(function (item) {
    return Number(item.id) !== Number(id);
  });

  salvarCarros(carrosAdmin);
  renderizarAdmin();
}

function editarDepoimento(id) {
  const depoimento = depoimentosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!depoimento) return;

  abrirCadastroAdmin("form-depoimento");
  document.getElementById("depoimento-id").value = depoimento.id;
  document.getElementById("depoimento-cliente").value = depoimento.cliente;
  document.getElementById("depoimento-veiculo").value = depoimento.veiculo;
  document.getElementById("depoimento-texto").value = depoimento.texto;

  previewDepoimento.src = depoimento.imagem;
  previewDepoimento.style.display = "block";
  imagemDepoimentoBase64 = "";
  btnDepoimentoSalvar.textContent = "Salvar alteracoes";
  tituloFormDepoimento.textContent = "Editar depoimento";
  btnDepoimentoCancelar.style.display = "inline-block";
  formDepoimento.scrollIntoView({ behavior: "smooth", block: "start" });
}

async function excluirDepoimento(id) {
  const depoimento = depoimentosAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!depoimento || !(await confirmar("Excluir depoimento de " + depoimento.cliente + "?", "Excluir depoimento"))) {
    return;
  }

  depoimentosAdmin = depoimentosAdmin.filter(function (item) {
    return Number(item.id) !== Number(id);
  });

  salvarDepoimentos(depoimentosAdmin);
  renderizarDepoimentosAdmin();
}

function editarParceria(id) {
  const parceria = parceriasAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!parceria) return;

  abrirCadastroAdmin("form-parceria");
  document.getElementById("parceria-id").value = parceria.id;
  document.getElementById("parceria-nome").value = parceria.nome;
  document.getElementById("parceria-ativo").checked = parceria.ativo;
  btnParceriaSalvar.textContent = "Salvar alteracoes";
  tituloFormParceria.textContent = "Editar parceria";
  btnParceriaCancelar.style.display = "inline-block";
  formParceria.scrollIntoView({ behavior: "smooth", block: "start" });
}

async function excluirParceria(id) {
  const parceria = parceriasAdmin.find(function (item) {
    return Number(item.id) === Number(id);
  });

  if (!parceria || !(await confirmar("Excluir parceria com " + parceria.nome + "?", "Excluir parceria"))) {
    return;
  }

  parceriasAdmin = parceriasAdmin.filter(function (item) {
    return Number(item.id) !== Number(id);
  });

  salvarParcerias(parceriasAdmin);
  renderizarParceriasAdmin();
}

if (inputFile) {
  inputFile.addEventListener("change", function () {
    const file = inputFile.files[0];

    if (file) {
      reduzirImagem(file, function (base64) {
        imagemBase64 = base64;
        previewImg.src = base64;
        previewImg.style.display = "block";
        renderizarPreviewCard();
      });
    }
  });
}

if (inputGaleriaFiles) {
  inputGaleriaFiles.addEventListener("change", function () {
    const files = Array.from(inputGaleriaFiles.files || []);

    Promise.all(files.map(reduzirImagemPromise)).then(function (imagens) {
      galeriaUploadBase64 = imagens;
      renderizarGaleriaAdmin();
    });
  });
}

if (inputLogoLoja) {
  inputLogoLoja.addEventListener("change", function () {
    const file = inputLogoLoja.files[0];

    if (file) {
      reduzirImagem(file, function (base64) {
        logoLojaBase64 = base64;
        previewLogoLoja.src = base64;
        previewLogoLoja.style.display = "block";
      });
    }
  });
}

if (inputDepoimentoFile) {
  inputDepoimentoFile.addEventListener("change", function () {
    const file = inputDepoimentoFile.files[0];

    if (file) {
      reduzirImagem(file, function (base64) {
        imagemDepoimentoBase64 = base64;
        previewDepoimento.src = base64;
        previewDepoimento.style.display = "block";
      });
    }
  });
}

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const idExistente = document.getElementById("carro-id").value;
  const carroAtualizado = montarCarro(idExistente);

  if (idExistente) {
    carrosAdmin = carrosAdmin.map(function (carro) {
      return Number(carro.id) === Number(idExistente) ? carroAtualizado : carro;
    });
    registrarHistoricoVeiculo(
      carroAtualizado.id,
      "Edição",
      "Cadastro do veículo atualizado no painel.",
      { status: carroAtualizado.status }
    );
  } else {
    carrosAdmin.push(carroAtualizado);
    registrarHistoricoVeiculo(
      carroAtualizado.id,
      "Cadastro",
      "Veículo cadastrado no estoque.",
      { status: carroAtualizado.status }
    );
  }

  salvarCarros(carrosAdmin);
  renderizarAdmin();
  limparFormulario();
});

form.addEventListener("input", renderizarPreviewCard);
form.addEventListener("change", renderizarPreviewCard);
form.addEventListener("input", renderizarLucroFormulario);
form.addEventListener("change", renderizarLucroFormulario);

if (selectVendedorVenda) {
  selectVendedorVenda.addEventListener("change", function () {
    const vendedor = vendedorPorId(selectVendedorVenda.value);
    const inputComissao = document.getElementById("comissao");
    const carroAtual = montarCarro(document.getElementById("carro-id").value);
    const valorVenda = numeroFinanceiro("valor-venda") || precoNumero(carroAtual.preco);

    if (vendedor && !inputComissao.value) {
      inputComissao.value = formatarCampoMoedaValor(
        calcularComissaoPadraoVendedor(vendedor, carroAtual, valorVenda)
      );
      renderizarLucroFormulario();
    }
  });
}

if (formVendedor) {
  formVendedor.addEventListener("submit", function (e) {
    e.preventDefault();

    const idExistente = document.getElementById("vendedor-id").value;
    const vendedor = {
      id: idExistente
        ? Number(idExistente)
        : gerarIdUnico([vendedoresAdmin, carrosAdmin, depoimentosAdmin, parceriasAdmin]),
      nome: document.getElementById("vendedor-nome").value.trim(),
      whatsapp: document.getElementById("vendedor-whatsapp").value.trim(),
      comissaoPadrao: numeroFinanceiro("vendedor-comissao-padrao"),
      comissaoTipo: document.getElementById("vendedor-comissao-tipo").value,
      comissaoPercentualPadrao: numeroPercentual("vendedor-comissao-percentual"),
      ativo: document.getElementById("vendedor-ativo").checked,
    };

    if (!vendedor.nome) {
      alert("Informe o nome do vendedor.");
      return;
    }

    if (idExistente) {
      vendedoresAdmin = vendedoresAdmin.map(function (item) {
        return Number(item.id) === Number(idExistente) ? vendedor : item;
      });

      carrosAdmin = carrosAdmin.map(function (carro) {
        if (Number(carro.vendedorId) !== Number(idExistente)) return carro;

        return {
          ...carro,
          vendedorNome: vendedor.nome,
        };
      });
    } else {
      vendedoresAdmin.push(vendedor);
    }

    salvarVendedores();
    salvarCarros(carrosAdmin);
    limparFormularioVendedor();
    renderizarAdmin();
  });
}

if (btnVendedorCancelar) {
  btnVendedorCancelar.addEventListener("click", limparFormularioVendedor);
}

if (formLead) {
  formLead.addEventListener("submit", function (e) {
    e.preventDefault();

    const idExistente = document.getElementById("lead-id").value;
    const veiculo = carrosAdmin.find(function (carro) {
      return Number(carro.id) === Number(document.getElementById("lead-veiculo").value);
    });
    const leadAnterior = leadsAdmin.find(function (item) {
      return Number(item.id) === Number(idExistente);
    });
    const novaInteracao = document.getElementById("lead-interacao").value.trim();
    const historicoLead = Array.isArray(leadAnterior && leadAnterior.historico)
      ? leadAnterior.historico.slice()
      : [];

    if (novaInteracao) {
      historicoLead.unshift({
        data: new Date().toISOString(),
        texto: novaInteracao,
      });
    }

    const lead = {
      id: idExistente
        ? Number(idExistente)
        : gerarIdUnico([leadsAdmin, vendedoresAdmin, carrosAdmin, saidasFinanceiras]),
      nome: document.getElementById("lead-nome").value.trim(),
      whatsapp: document.getElementById("lead-whatsapp").value.trim(),
      email: document.getElementById("lead-email").value.trim(),
      cpf: document.getElementById("lead-cpf").value.trim(),
      dataNascimento: document.getElementById("lead-data-nascimento").value,
      cep: document.getElementById("lead-cep").value.trim(),
      endereco: document.getElementById("lead-endereco").value.trim(),
      numero: document.getElementById("lead-numero").value.trim(),
      complemento: document.getElementById("lead-complemento").value.trim(),
      bairro: document.getElementById("lead-bairro").value.trim(),
      cidade: document.getElementById("lead-cidade").value.trim(),
      estado: document.getElementById("lead-estado").value.trim().toUpperCase(),
      profissao: document.getElementById("lead-profissao").value.trim(),
      rendaMensal:
        Number(
          String(document.getElementById("lead-renda-mensal").value).replace(
            /\D/g,
            ""
          )
        ) || 0,
      origem: document.getElementById("lead-origem").value,
      veiculoId: veiculo ? veiculo.id : "",
      veiculoNome: veiculo ? veiculo.nome : "",
      vendedorId: selectLeadVendedor ? selectLeadVendedor.value : "",
      vendedorNome: selectLeadVendedor
        ? selectLeadVendedor.options[selectLeadVendedor.selectedIndex].text
        : "",
      status: document.getElementById("lead-status").value,
      temperatura: document.getElementById("lead-temperatura").value,
      motivoPerda: document.getElementById("lead-motivo-perda").value,
      tarefa: document.getElementById("lead-tarefa").value.trim(),
      prazoTarefa: document.getElementById("lead-prazo-tarefa").value,
      consentimento: document.getElementById("lead-consentimento").checked,
      consentimentoEm:
        document.getElementById("lead-consentimento").checked
          ? (leadAnterior && leadAnterior.consentimentoEm) ||
            new Date().toISOString()
          : "",
      proximoContato: document.getElementById("lead-proximo-contato").value,
      observacao: document.getElementById("lead-observacao").value.trim(),
      historico: historicoLead,
      criadoEm: idExistente
        ? (leadAnterior || {}).criadoEm
        : new Date().toISOString(),
      atualizadoEm: new Date().toISOString(),
    };

    if (!lead.nome || !lead.whatsapp) {
      alert("Informe nome e WhatsApp do cliente.");
      return;
    }

    if (idExistente) {
      leadsAdmin = leadsAdmin.map(function (item) {
        return Number(item.id) === Number(idExistente) ? lead : item;
      });
    } else {
      leadsAdmin.push(lead);
    }

    salvarLeadsAdmin();
    limparFormularioLead();
    renderizarClientes();
  });
}

if (btnLeadCancelar) {
  btnLeadCancelar.addEventListener("click", limparFormularioLead);
}

[inputLeadBusca, selectLeadFiltroStatus, selectLeadFiltroContato].forEach(
  function (campo) {
    if (!campo) return;
    campo.addEventListener("input", function () {
      paginaClientes = 1;
      renderizarClientes();
    });
    campo.addEventListener("change", function () {
      paginaClientes = 1;
      renderizarClientes();
    });
  }
);

if (btnLeadLimparFiltros) {
  btnLeadLimparFiltros.addEventListener("click", function () {
    if (inputLeadBusca) inputLeadBusca.value = "";
    if (selectLeadFiltroStatus) selectLeadFiltroStatus.value = "";
    if (selectLeadFiltroContato) selectLeadFiltroContato.value = "";
    paginaClientes = 1;
    renderizarClientes();
  });
}

if (btnCentralNovoCliente) {
  btnCentralNovoCliente.addEventListener("click", function () {
    limparFormularioLead();
    abrirCadastroAdmin("form-lead");
  });
}

if (btnClientesTopoNovoCliente) {
  btnClientesTopoNovoCliente.addEventListener("click", function () {
    limparFormularioLead();
    abrirCadastroAdmin("form-lead");
  });
}

const inputLeadCpf = document.getElementById("lead-cpf");
const inputLeadEstado = document.getElementById("lead-estado");

if (inputLeadCpf) {
  inputLeadCpf.addEventListener("input", function () {
    const numeros = inputLeadCpf.value.replace(/\D/g, "").slice(0, 11);
    inputLeadCpf.value = numeros
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  });
}

if (inputLeadEstado) {
  inputLeadEstado.addEventListener("input", function () {
    inputLeadEstado.value = inputLeadEstado.value
      .replace(/[^a-z]/gi, "")
      .slice(0, 2)
      .toUpperCase();
  });
}

if (formModalVenda) {
  formModalVenda.addEventListener("submit", function (e) {
    e.preventDefault();
    registrarVendaPendente();
  });
}

if (inputModalVendaValor) {
  inputModalVendaValor.addEventListener("input", recalcularComissaoModalVenda);
}

if (inputModalVendaTaxa) {
  inputModalVendaTaxa.addEventListener("input", recalcularComissaoModalVenda);
}

[
  inputModalVendaValor,
  inputModalVendaValorRecebido,
  inputModalVendaTrocaValor,
  inputModalVendaSaldo,
].forEach(function (campo) {
  if (!campo) return;
  campo.addEventListener("input", atualizarResumoTrocaModalVenda);
});

if (selectModalVendaTemTroca) {
  selectModalVendaTemTroca.addEventListener("change", atualizarResumoTrocaModalVenda);
}

if (selectModalVendaVendedor) {
  selectModalVendaVendedor.addEventListener("change", function () {
    const vendedor = vendedorPorId(selectModalVendaVendedor.value);
    const carroVenda = carrosAdmin.find(function (carro) {
      return Number(carro.id) === Number(vendaPendenteId);
    });
    const valorVenda = Number(String(inputModalVendaValor.value).replace(/\D/g, "")) || 0;

    if (vendedor && carroVenda && !inputModalVendaComissao.value) {
      inputModalVendaComissao.value = formatarCampoMoedaValor(
        calcularComissaoPadraoVendedor(vendedor, carroVenda, valorVenda)
      );
    }
  });
}

if (btnFecharModalVenda) {
  btnFecharModalVenda.addEventListener("click", fecharModalVenda);
}

if (btnCancelarModalVenda) {
  btnCancelarModalVenda.addEventListener("click", fecharModalVenda);
}

if (modalVenda) {
  modalVenda.addEventListener("click", function (evento) {
    if (evento.target === modalVenda) {
      fecharModalVenda();
    }
  });
}

if (btnFecharModalCliente) {
  btnFecharModalCliente.addEventListener("click", fecharFichaCliente);
}

if (btnAbrirHistoricoComissoes) {
  btnAbrirHistoricoComissoes.addEventListener("click", abrirHistoricoComissoes);
}

if (btnFecharModalComissoes) {
  btnFecharModalComissoes.addEventListener("click", fecharHistoricoComissoes);
}

if (modalComissoes) {
  modalComissoes.addEventListener("click", function (evento) {
    if (evento.target === modalComissoes) fecharHistoricoComissoes();
  });
}

if (filtroHistoricoComissoes) {
  filtroHistoricoComissoes.addEventListener(
    "change",
    renderizarHistoricoComissoes
  );
}

if (btnAbrirNotificacoes) {
  btnAbrirNotificacoes.addEventListener("click", function (evento) {
    evento.stopPropagation();
    alternarPainelNotificacoes();
  });
}

if (painelNotificacoes) {
  painelNotificacoes.addEventListener("click", function (evento) {
    evento.stopPropagation();
  });
}

if (btnNotificacoesVerClientes) {
  btnNotificacoesVerClientes.addEventListener("click", function () {
    alternarPainelNotificacoes(false);
    abrirAbaAdmin("clientes");
  });
}

document.addEventListener("click", function () {
  alternarPainelNotificacoes(false);
});

if (modalCliente) {
  modalCliente.addEventListener("click", function (evento) {
    if (evento.target === modalCliente) fecharFichaCliente();
  });
}

if (btnModalClienteWhatsapp) {
  btnModalClienteWhatsapp.addEventListener("click", function () {
    if (clienteModalId) abrirWhatsappLead(clienteModalId, "retorno");
  });
}

if (btnModalClienteEditar) {
  btnModalClienteEditar.addEventListener("click", function () {
    const id = clienteModalId;
    fecharFichaCliente();
    if (id) editarLead(id);
  });
}

if (btnModalClienteTarefa) {
  btnModalClienteTarefa.addEventListener("click", function () {
    const id = clienteModalId;
    fecharFichaCliente();
    if (!id) return;
    editarLead(id);
    const campoTarefa = document.getElementById("lead-tarefa");
    if (campoTarefa) campoTarefa.focus({ preventScroll: true });
  });
}

if (formComunicacaoCliente) {
  formComunicacaoCliente.addEventListener("submit", async function (evento) {
    evento.preventDefault();
    const lead = leadsAdmin.find(function (item) {
      return Number(item.id) === Number(clienteModalId);
    });
    const mensagem = document
      .getElementById("cliente-comunicacao-mensagem")
      .value.trim();

    if (!lead || !mensagem) return;

    const resposta = await fetch(
      "/api/leads/" + Number(lead.id) + "/communications",
      {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "X-CSRF-TOKEN":
            document.querySelector('meta[name="csrf-token"]')?.content || "",
        },
        body: JSON.stringify({
          channel: document.getElementById("cliente-comunicacao-canal").value,
          direction: document.getElementById("cliente-comunicacao-direcao").value,
          message: mensagem,
        }),
      }
    );

    if (!resposta.ok) {
      retornoComunicacaoCliente.textContent =
        "Não foi possível salvar a interação.";
      retornoComunicacaoCliente.className =
        "admin-retorno admin-retorno-erro";
      return;
    }

    formComunicacaoCliente.reset();
    retornoComunicacaoCliente.textContent = "Interação salva no histórico.";
    retornoComunicacaoCliente.className =
      "admin-retorno admin-retorno-sucesso";
    await carregarHistoricoCliente(lead);
  });
}

document.addEventListener("keydown", function (evento) {
  if (evento.key === "Escape" && modalCliente?.classList.contains("ativo")) {
    fecharFichaCliente();
  }
  if (evento.key === "Escape" && modalComissoes?.classList.contains("ativo")) {
    fecharHistoricoComissoes();
  }
  if (
    evento.key === "Escape" &&
    document
      .querySelector('.cadastro-recolhivel-modal[data-cadastro="form-lead"]')
      ?.classList.contains("aberto")
  ) {
    fecharCadastroAdmin("form-lead");
  }
  if (evento.key === "Escape") alternarPainelNotificacoes(false);
});

window.addEventListener("focus", renderizarNotificacoes);
window.setInterval(renderizarNotificacoes, 60000);

formLoja.addEventListener("submit", function (e) {
  e.preventDefault();

  salvarConfigLoja({
    nome: document.getElementById("loja-nome").value.trim(),
    subtitulo: document.getElementById("loja-subtitulo").value.trim(),
    whatsapp: document.getElementById("loja-whatsapp").value.replace(/\D/g, ""),
    endereco: document.getElementById("loja-endereco").value.trim(),
    horario: document.getElementById("loja-horario").value.trim(),
    instagram: document.getElementById("loja-instagram").value.trim(),
    email: document.getElementById("loja-email").value.trim(),
    sobre: document.getElementById("loja-sobre").value.trim(),
    logo: logoLojaBase64 || carregarConfigLoja().logo,
  });

  carregarFormularioLoja();
  aplicarConfigLoja();
});

formMensagemWhatsapp.addEventListener("submit", function (e) {
  e.preventDefault();

  salvarConfigLoja({
    mensagemVeiculo: document.getElementById("loja-mensagem-veiculo").value.trim(),
  });

  carregarFormularioLoja();
});

btnCancelar.addEventListener("click", limparFormulario);

formDepoimento.addEventListener("submit", function (e) {
  e.preventDefault();

  const idExistente = document.getElementById("depoimento-id").value;
  const depoimentoAtualizado = montarDepoimento(idExistente);

  if (idExistente) {
    depoimentosAdmin = depoimentosAdmin.map(function (depoimento) {
      return Number(depoimento.id) === Number(idExistente)
        ? depoimentoAtualizado
        : depoimento;
    });
  } else {
    depoimentosAdmin.push(depoimentoAtualizado);
  }

  salvarDepoimentos(depoimentosAdmin);
  renderizarDepoimentosAdmin();
  limparFormularioDepoimento();
});

btnDepoimentoCancelar.addEventListener("click", limparFormularioDepoimento);

formParceria.addEventListener("submit", function (e) {
  e.preventDefault();

  const idExistente = document.getElementById("parceria-id").value;
  const parceriaAtualizada = montarParceria(idExistente);

  if (idExistente) {
    parceriasAdmin = parceriasAdmin.map(function (parceria) {
      return Number(parceria.id) === Number(idExistente)
        ? parceriaAtualizada
        : parceria;
    });
  } else {
    parceriasAdmin.push(parceriaAtualizada);
  }

  salvarParcerias(parceriasAdmin);
  renderizarParceriasAdmin();
  limparFormularioParceria();
});

btnParceriaCancelar.addEventListener("click", limparFormularioParceria);

if (selectInstagramCarro) {
  selectInstagramCarro.addEventListener("change", function () {
    atualizarCamposInstagram(carroInstagramSelecionado());
    renderizarInstagram();
  });

  selectInstagramTom.addEventListener("change", function () {
    atualizarCamposInstagram(carroInstagramSelecionado());
    renderizarInstagram();
  });

  [selectInstagramFormato, selectInstagramCor, inputInstagramTitulo, inputInstagramCta].forEach(function (campo) {
    campo.addEventListener("change", renderizarInstagram);
    campo.addEventListener("input", renderizarInstagram);
  });
}

if (btnInstagramAtualizar) {
  btnInstagramAtualizar.addEventListener("click", function () {
    textareaInstagramLegenda.value = legendaInstagram(carroInstagramSelecionado());
    renderizarInstagram();
    mostrarRetornoInstagram("Arte e legenda atualizadas.", "sucesso");
  });
}

if (btnInstagramCopiar) {
  btnInstagramCopiar.addEventListener("click", function () {
    const texto = textareaInstagramLegenda.value;

    if (!texto) {
      mostrarRetornoInstagram("Selecione um veículo para gerar a legenda.", "erro");
      return;
    }

    if (navigator.clipboard) {
      navigator.clipboard.writeText(texto).then(function () {
        mostrarRetornoInstagram("Legenda copiada para a área de transferência.", "sucesso");
      });
      return;
    }

    textareaInstagramLegenda.select();
    document.execCommand("copy");
    mostrarRetornoInstagram("Legenda copiada.", "sucesso");
  });
}

if (btnInstagramBaixar) {
  btnInstagramBaixar.addEventListener("click", function () {
    const carro = carroInstagramSelecionado();

    if (!carro) {
      mostrarRetornoInstagram("Selecione um veículo para baixar a arte.", "erro");
      return;
    }

    try {
      const link = document.createElement("a");
      link.href = canvasInstagram.toDataURL("image/png");
      link.download =
        "instagram-" +
        normalizarTextoAdmin(carro.nome).replace(/\s+/g, "-") +
        "-" +
        selectInstagramFormato.value +
        ".png";
      link.click();
      mostrarRetornoInstagram("Arte baixada com sucesso.", "sucesso");
    } catch (erro) {
      mostrarRetornoInstagram(
        "Não foi possível baixar a arte com essa imagem. Troque por uma foto enviada pelo admin.",
        "erro"
      );
    }
  });
}

formSeguranca.addEventListener("submit", function (e) {
  e.preventDefault();

  const usuarioAtual = document.getElementById("seguranca-usuario-atual").value.trim();
  const senhaAtual = document.getElementById("seguranca-senha-atual").value;
  const novoUsuario = document.getElementById("seguranca-novo-usuario").value.trim();
  const novaSenha = document.getElementById("seguranca-nova-senha").value;
  const confirmarSenha = document.getElementById("seguranca-confirmar-senha").value;

  if (novaSenha !== confirmarSenha) {
    segurancaRetorno.textContent = "A confirmacao da senha nao confere.";
    segurancaRetorno.className = "admin-retorno admin-retorno-erro";
    return;
  }

  const resposta = requisicaoLaravel("PUT", "/admin/credentials", {
    current_username: usuarioAtual,
    current_password: senhaAtual,
    username: novoUsuario,
    password: novaSenha,
    password_confirmation: confirmarSenha,
  });

  if (!resposta.ok) {
    segurancaRetorno.textContent =
      resposta.data.message || "Não foi possível atualizar o acesso.";
    segurancaRetorno.className = "admin-retorno admin-retorno-erro";
    return;
  }

  formSeguranca.reset();
  segurancaRetorno.textContent = resposta.data.message;
  segurancaRetorno.className = "admin-retorno admin-retorno-sucesso";
});

buscaAdminCarros.addEventListener("input", function () {
  paginaVeiculos = 1;
  renderizarAdmin();
});
statusAdminCarros.addEventListener("change", function () {
  paginaVeiculos = 1;
  renderizarAdmin();
});

if (filtroFinanceiroMes) {
  filtroFinanceiroMes.addEventListener("change", function () {
    renderizarFinanceiro();
    renderizarVendedores();
    if (modalComissoes?.classList.contains("ativo")) {
      renderizarHistoricoComissoes();
    }
  });
}

if (selectHistoricoVeiculo) {
  selectHistoricoVeiculo.addEventListener("change", renderizarHistoricoVeiculos);
}

if (formSaidaFinanceira) {
  const inputSaidaData = document.getElementById("saida-data");

  if (inputSaidaData && !inputSaidaData.value) {
    inputSaidaData.value = new Date().toISOString().slice(0, 10);
  }

  formSaidaFinanceira.addEventListener("submit", function (e) {
    e.preventDefault();
    const veiculoSaida = carrosAdmin.find(function (carro) {
      return Number(carro.id) === Number(selectSaidaVeiculo ? selectSaidaVeiculo.value : "");
    });

    const saida = {
      id: gerarIdUnico([saidasFinanceiras, carrosAdmin, depoimentosAdmin, parceriasAdmin]),
      data: document.getElementById("saida-data").value,
      categoria: document.getElementById("saida-categoria").value,
      valor: numeroFinanceiro("saida-valor"),
      descricao: document.getElementById("saida-descricao").value.trim(),
      pagamento: document.getElementById("saida-pagamento").value,
      veiculoId: veiculoSaida ? veiculoSaida.id : "",
      veiculoNome: veiculoSaida ? veiculoSaida.nome : "",
      responsavel: document.getElementById("saida-responsavel").value.trim(),
      observacao: document.getElementById("saida-observacao").value.trim(),
      criadoEm: new Date().toISOString(),
    };

    if (!saida.data || !saida.categoria || !saida.valor || !saida.descricao) {
      alert("Preencha data, categoria, descrição e valor da saída.");
      return;
    }

    saidasFinanceiras.push(saida);
    salvarSaidasFinanceiras();
    if (veiculoSaida) {
      registrarHistoricoVeiculo(
        veiculoSaida.id,
        "Gasto",
        "Saída vinculada: " + saida.descricao + " - " + formatarMoeda(saida.valor),
        { saidaId: saida.id, categoria: saida.categoria, valor: saida.valor }
      );
    }
    formSaidaFinanceira.reset();
    document.getElementById("saida-data").value = new Date().toISOString().slice(0, 10);
    fecharCadastroAdmin("form-saida-financeira");
    renderizarFinanceiro();
  });
}

if (btnLimparFinanceiro) {
  btnLimparFinanceiro.addEventListener("click", function () {
    filtroFinanceiroMes.value = "";
    renderizarFinanceiro();
  });
}

if (btnCopiarLinkFinanciamento) {
  btnCopiarLinkFinanciamento.addEventListener("click", async function () {
    const link =
      window.location.origin +
      window.location.pathname.replace("admin.html", "financiamento-dados.html");

    if (navigator.clipboard) {
      navigator.clipboard.writeText(link);
      retornoLinkFinanciamento.textContent = "Link copiado para enviar ao cliente.";
      retornoLinkFinanciamento.className = "admin-retorno admin-retorno-sucesso";
      return;
    }

    await solicitarTexto("Copie o link do formulário:", link, "Link do financiamento");
  });
}

if (btnLimparVisitas) {
  btnLimparVisitas.addEventListener("click", async function () {
    if (!(await confirmar("Limpar todos os dados locais de visitas?", "Limpar visitas"))) return;

    limparAnalyticsSite();
    renderizarAnalyticsAdmin();
  });
}

resetLoja.addEventListener("click", async function () {
  if (!(await confirmar("Restaurar nome, WhatsApp e logo padrão da loja?", "Restaurar dados da loja"))) return;

  restaurarConfigLoja();
  carregarFormularioLoja();
  aplicarConfigLoja();
});

if (btnLogout) {
  btnLogout.addEventListener("click", logoutAdmin);
}

adminTabs.forEach(function (tab) {
  tab.addEventListener("click", function () {
    abrirAbaAdmin(tab.dataset.adminTab);
  });
});

if (selectPerfilAdmin) {
  selectPerfilAdmin.addEventListener("change", aplicarPerfilAdmin);
}

adminAtalhos.forEach(function (atalho) {
  atalho.addEventListener("click", function () {
    const destino = atalho.dataset.adminAtalho;
    const formularioPorAba = {
      veiculos: "form-carro",
      depoimentos: "form-depoimento",
      parcerias: "form-parceria",
    };

    abrirAbaAdmin(destino);
    if (formularioPorAba[destino]) {
      abrirCadastroAdmin(formularioPorAba[destino]);
    }
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});

financeiroMenuBtns.forEach(function (botao) {
  botao.addEventListener("click", function () {
    const view = botao.dataset.financeViewTarget;

    financeiroMenuBtns.forEach(function (item) {
      item.classList.toggle("ativo", item === botao);
    });

    financeiroViews.forEach(function (painel) {
      painel.classList.toggle("ativo", painel.dataset.financeView === view);
    });
  });
});

btnExportarBackup.addEventListener("click", function () {
  const backup = {
    versao: 1,
    geradoEm: new Date().toISOString(),
    carros: carrosAdmin,
    depoimentos: depoimentosAdmin,
    parcerias: parceriasAdmin,
    lojaConfig: carregarConfigLoja(),
    homeConteudo: carregarConteudoHome(),
    analyticsSite: carregarAnalyticsSite(),
    saidasFinanceiras: saidasFinanceiras,
    vendedores: vendedoresAdmin,
    leadsClientes: leadsAdmin,
    historicoVeiculos: historicoVeiculosAdmin,
  };
  const blob = new Blob([JSON.stringify(backup, null, 2)], {
    type: "application/json",
  });
  const link = document.createElement("a");

  link.href = URL.createObjectURL(blob);
  link.download = "backup-prime-motors.json";
  link.click();
  URL.revokeObjectURL(link.href);
  localStorage.setItem("ultimoBackupAdmin", new Date().toISOString().slice(0, 10));
  renderizarDashboard();
});

function baixarCSV(nomeArquivo, linhas) {
  const csv = linhas
    .map(function (linha) {
      return linha
        .map(function (campo) {
          return '"' + String(campo === undefined || campo === null ? "" : campo).replace(/"/g, '""') + '"';
        })
        .join(";");
    })
    .join("\n");
  const blob = new Blob([csv], { type: "text/csv;charset=utf-8" });
  const link = document.createElement("a");

  link.href = URL.createObjectURL(blob);
  link.download = nomeArquivo;
  link.click();
  URL.revokeObjectURL(link.href);
}

function vendasFiltradasRelatorio() {
  const mes = filtroFinanceiroMes ? filtroFinanceiroMes.value : "";
  return carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido" && carroNoMesFinanceiro(carro, mes);
  });
}

btnExportarFinanceiro.addEventListener("click", function () {
  const mes = filtroFinanceiroMes.value;
  const vendidos = carrosAdmin.filter(function (carro) {
    return carro.status === "Vendido" && carroNoMesFinanceiro(carro, mes);
  });
  const saidasFiltradas = saidasFinanceiras.filter(function (saida) {
    return saidaNoMesFinanceiro(saida, mes);
  });
  const linhas = [
    ["VENDAS"],
    [
      "Veículo",
      "Data venda",
      "Valor venda",
      "Caixa recebido",
      "Valor em troca",
      "Saldo a receber",
      "Carro da troca",
      "ID estoque troca",
      "Preço compra",
      "Preparação",
      "Taxa comissão %",
      "Comissão",
      "Vendedor",
      "Taxas",
      "Lucro estimado",
    ],
  ].concat(
    vendidos.map(function (carro) {
      return [
        carro.nome,
        carro.dataVenda || "",
        Number(carro.valorVenda) || precoNumero(carro.preco),
        valorCaixaVenda(carro),
        Number(carro.trocaValor) || 0,
        Number(carro.saldoReceber) || 0,
        carro.trocaVeiculo || "",
        carro.trocaEstoqueId || "",
        Number(carro.precoCompra) || 0,
        Number(carro.custoPreparacao) || 0,
        Number(carro.comissaoPercentual) || 0,
        Number(carro.comissao) || 0,
        carro.vendedorNome || "",
        Number(carro.taxas) || 0,
        lucroCarro(carro),
      ];
    })
  ).concat(
    [[""], ["SAÍDAS"], ["Data", "Categoria", "Descrição", "Valor", "Pagamento", "Responsável", "Observação"]],
    saidasFiltradas.map(function (saida) {
      return [
        saida.data || "",
        saida.categoria || "",
        saida.descricao || "",
        Number(saida.valor) || 0,
        saida.pagamento || "",
        saida.responsavel || "",
        saida.observacao || "",
      ];
    })
  );
  const csv = linhas
    .map(function (linha) {
      return linha
        .map(function (campo) {
          return '"' + String(campo).replace(/"/g, '""') + '"';
        })
        .join(";");
    })
    .join("\n");
  const blob = new Blob([csv], { type: "text/csv;charset=utf-8" });
  const link = document.createElement("a");

  link.href = URL.createObjectURL(blob);
  link.download = "financeiro-prime-motors.csv";
  link.click();
  URL.revokeObjectURL(link.href);
});

if (btnExportarEstoque) {
  btnExportarEstoque.addEventListener("click", function () {
    baixarCSV(
      "estoque-prime-motors.csv",
      [
        ["Veículo", "Marca", "Modelo", "Ano", "Status", "Preço", "Compra", "Preparação", "Origem"],
      ].concat(
        carrosAdmin.map(function (carro) {
          return [
            carro.nome,
            carro.marca,
            carro.modelo,
            carro.ano,
            carro.status,
            precoNumero(carro.preco),
            Number(carro.precoCompra) || 0,
            Number(carro.custoPreparacao) || 0,
            carro.origem || "",
          ];
        })
      )
    );
  });
}

if (btnExportarVendas) {
  btnExportarVendas.addEventListener("click", function () {
    baixarCSV(
      "vendas-prime-motors.csv",
      [
        ["Veículo", "Data", "Vendedor", "Valor", "Recebido", "Troca", "Saldo", "Lucro"],
      ].concat(
        vendasFiltradasRelatorio().map(function (carro) {
          return [
            carro.nome,
            carro.dataVenda || "",
            carro.vendedorNome || "",
            Number(carro.valorVenda) || precoNumero(carro.preco),
            valorCaixaVenda(carro),
            Number(carro.trocaValor) || 0,
            Number(carro.saldoReceber) || 0,
            lucroCarro(carro),
          ];
        })
      )
    );
  });
}

if (btnExportarComissoes) {
  btnExportarComissoes.addEventListener("click", function () {
    baixarCSV(
      "comissoes-prime-motors.csv",
      [
        ["Vendedor", "Veículo", "Data", "Valor venda", "Taxa %", "Comissão"],
      ].concat(
        vendasFiltradasRelatorio().map(function (carro) {
          return [
            carro.vendedorNome || "Não informado",
            carro.nome,
            carro.dataVenda || "",
            Number(carro.valorVenda) || precoNumero(carro.preco),
            Number(carro.comissaoPercentual) || 0,
            Number(carro.comissao) || 0,
          ];
        })
      )
    );
  });
}

if (btnExportarRecebiveis) {
  btnExportarRecebiveis.addEventListener("click", function () {
    baixarCSV(
      "contas-a-receber-prime-motors.csv",
      [
        ["Veículo", "Data venda", "Vendedor", "Saldo a receber"],
      ].concat(
        vendasFiltradasRelatorio()
          .filter(function (carro) {
            return Number(carro.saldoReceber) > 0;
          })
          .map(function (carro) {
            return [carro.nome, carro.dataVenda || "", carro.vendedorNome || "", Number(carro.saldoReceber) || 0];
          })
      )
    );
  });
}

if (btnExportarClientes) {
  btnExportarClientes.addEventListener("click", function () {
    baixarCSV(
      "clientes-prime-motors.csv",
      [
        [
          "Nome",
          "WhatsApp",
          "E-mail",
          "CPF",
          "Nascimento",
          "CEP",
          "Endereço",
          "Número",
          "Complemento",
          "Bairro",
          "Cidade",
          "UF",
          "Profissão",
          "Renda mensal",
          "Origem",
          "Veículo",
          "Status",
          "Próximo contato",
          "Observação",
        ],
      ].concat(
        leadsAdmin.map(function (lead) {
          return [
            lead.nome,
            lead.whatsapp,
            lead.email,
            lead.cpf,
            lead.dataNascimento,
            lead.cep,
            lead.endereco || "",
            lead.numero || "",
            lead.complemento || "",
            lead.bairro || "",
            lead.cidade,
            lead.estado,
            lead.profissao,
            lead.rendaMensal,
            lead.origem,
            lead.veiculoNome,
            lead.status,
            lead.proximoContato,
            lead.observacao,
          ];
        })
      )
    );
  });
}

if (btnExportarHistorico) {
  btnExportarHistorico.addEventListener("click", function () {
    baixarCSV(
      "historico-veiculos-prime-motors.csv",
      [
        ["Data", "Veículo", "Tipo", "Descrição"],
      ].concat(
        historicoVeiculosAdmin.map(function (item) {
          return [item.data, item.carroNome, item.tipo, item.descricao];
        })
      )
    );
  });
}

inputImportarBackup.addEventListener("change", async function () {
  const file = inputImportarBackup.files[0];

  if (!file) return;
  if (!(await confirmar("Importar backup e substituir os dados atuais?", "Importar backup"))) {
    inputImportarBackup.value = "";
    return;
  }

  const reader = new FileReader();

  reader.onload = function (e) {
    try {
      const backup = JSON.parse(e.target.result);

      if (Array.isArray(backup.carros)) salvarCarros(backup.carros);
      if (Array.isArray(backup.depoimentos)) salvarDepoimentos(backup.depoimentos);
      if (Array.isArray(backup.parcerias)) salvarParcerias(backup.parcerias);
      if (backup.lojaConfig) salvarConfigLoja(backup.lojaConfig);
      if (backup.homeConteudo) salvarConteudoHome(backup.homeConteudo);
      if (backup.analyticsSite) salvarAnalyticsSite(backup.analyticsSite);
      if (Array.isArray(backup.saidasFinanceiras)) {
        saidasFinanceiras = backup.saidasFinanceiras;
        salvarSaidasFinanceiras();
      }
      if (Array.isArray(backup.vendedores)) {
        vendedoresAdmin = backup.vendedores;
        salvarVendedores();
      }
      if (Array.isArray(backup.leadsClientes)) {
        leadsAdmin = backup.leadsClientes;
        salvarLeadsAdmin();
      }
      if (Array.isArray(backup.historicoVeiculos)) {
        historicoVeiculosAdmin = backup.historicoVeiculos;
        salvarHistoricoVeiculos();
      }
      carrosAdmin = carregarCarros();
      depoimentosAdmin = carregarDepoimentos();
      parceriasAdmin = carregarParcerias();
      carregarFormularioLoja();
      aplicarConfigLoja();
      renderizarAdmin();
      renderizarDepoimentosAdmin();
      renderizarParceriasAdmin();
      renderizarFinanceiro();
      renderizarAnalyticsAdmin();
      preencherCarrosInstagram();
      renderizarInstagram();
      alert("Backup importado com sucesso.");
    } catch (erro) {
      alert("Não foi possível importar o backup.");
    }
  };

  reader.readAsText(file);
  inputImportarBackup.value = "";
});

configurarCadastrosRecolhiveis();
preencherMarcasAdmin();
carregarFormularioLoja();
limparFormulario();
renderizarLucroFormulario();
limparFormularioDepoimento();
limparFormularioParceria();
renderizarAdmin();
carregarSolicitacoesFinanciamento();
renderizarDepoimentosAdmin();
renderizarParceriasAdmin();
renderizarFinanceiro();
renderizarAnalyticsAdmin();
preencherCarrosInstagram();
renderizarInstagram();
aplicarPerfilAdmin();


