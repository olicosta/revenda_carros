const formFinanciamentoCompleto = document.getElementById("form-financiamento-completo");
const selectVeiculoCompleto = document.getElementById("full-veiculo");
const botaoBaixarPdfFinanciamento = document.getElementById("baixar-pdf-financiamento");
const documentosFinanciamento = document.getElementById("full-documentos");
const categoriaDocumentosFinanciamento = document.getElementById("full-documentos-categoria");
const retornoFinanciamento = document.getElementById("financiamento-retorno");

function preencherSelectVeiculosCompleto(select) {
  if (!select) return;

  carregarCarros()
    .filter(function (carro) {
      return carro.status !== "Vendido";
    })
    .forEach(function (carro) {
      const option = document.createElement("option");
      option.value = carro.nome + " - " + carro.preco;
      option.textContent = carro.nome + " | " + carro.preco;
      select.appendChild(option);
    });
}

function valorCampoCompleto(id, fallback) {
  const campo = document.getElementById(id);

  if (!campo) return fallback;

  if (campo.type === "checkbox") {
    return campo.checked ? "Sim" : "Não";
  }

  return campo.value.trim() ? campo.value.trim() : fallback;
}

function linhaFinanciamento(rotulo, id, fallback) {
  return rotulo + ": " + valorCampoCompleto(id, fallback);
}

function gruposDadosFinanciamento() {
  return [
    {
      titulo: "Dados pessoais",
      campos: [
        ["Nome", "full-nome", "Não informado"],
        ["CPF", "full-cpf", "Não informado"],
        ["RG", "full-rg", "Não informado"],
        ["Emissão RG", "full-emissao-rg", "Não informado"],
        ["Nascimento", "full-nascimento", "Não informado"],
        ["Nome da mãe", "full-mae", "Não informado"],
        ["Nome do pai", "full-pai", "Não informado"],
        ["Naturalidade", "full-naturalidade", "Não informado"],
        ["Estado civil", "full-estado-civil", "Não informado"],
        ["Sexo", "full-sexo", "Não informado"],
        ["CNH", "full-cnh", "Não informado"],
        ["E-mail", "full-email", "Não informado"],
        ["Nome do cônjuge", "full-conjuge-nome", "Não informado"],
        ["CPF do cônjuge", "full-conjuge-cpf", "Não informado"],
        ["Renda do cônjuge", "full-conjuge-renda", "Não informado"],
        ["Profissão do cônjuge", "full-conjuge-profissao", "Não informado"],
      ],
    },
    {
      titulo: "Contato e residência",
      campos: [
        ["Telefone", "full-telefone", "Não informado"],
        ["Celular/WhatsApp", "full-whatsapp", "Não informado"],
        ["CEP", "full-cep", "Não informado"],
        ["Endereço", "full-endereco", "Não informado"],
        ["Número", "full-numero", "Não informado"],
        ["Complemento", "full-complemento", "Não informado"],
        ["Bairro", "full-bairro", "Não informado"],
        ["Cidade", "full-cidade", "Não informado"],
        ["UF", "full-estado", "Não informado"],
        ["Tempo de residência", "full-tempo-residencia", "Não informado"],
      ],
    },
    {
      titulo: "Dados profissionais",
      campos: [
        ["Empresa", "full-empresa", "Não informado"],
        ["Cargo/função", "full-cargo", "Não informado"],
        ["Renda mensal", "full-renda", "Não informado"],
        ["Telefone comercial", "full-telefone-comercial", "Não informado"],
        ["Tempo neste emprego", "full-tempo-trabalho", "Não informado"],
        ["CEP comercial", "full-cep-comercial", "Não informado"],
        ["Endereço comercial", "full-endereco-comercial", "Não informado"],
        ["Número comercial", "full-numero-comercial", "Não informado"],
        ["Complemento comercial", "full-complemento-comercial", "Não informado"],
        ["Bairro comercial", "full-bairro-comercial", "Não informado"],
        ["Cidade comercial", "full-cidade-comercial", "Não informado"],
        ["UF comercial", "full-uf-comercial", "Não informado"],
      ],
    },
    {
      titulo: "Referência bancária",
      campos: [
        ["Banco", "full-banco", "Não informado"],
        ["Agência", "full-agencia", "Não informado"],
        ["Conta", "full-conta", "Não informado"],
        ["Tempo de conta", "full-tempo-conta", "Não informado"],
      ],
    },
    {
      titulo: "Referências pessoais",
      campos: [
        ["Referência 1", "full-ref1-nome", "Não informado"],
        ["Telefone referência 1", "full-ref1-telefone", "Não informado"],
        ["Referência 2", "full-ref2-nome", "Não informado"],
        ["Telefone referência 2", "full-ref2-telefone", "Não informado"],
      ],
    },
    {
      titulo: "Veículo e proposta",
      campos: [
        ["Veículo", "full-veiculo", "Ainda não escolhi"],
        ["Valor do veículo", "full-valor-veiculo", "A definir"],
        ["Entrada", "full-entrada", "A definir"],
        ["Prazo", "full-prazo", "A definir"],
        ["Veículo na troca", "full-troca", "Não"],
        ["Qual veículo na troca", "full-carro-troca", "Não informado"],
        ["Parcela desejada", "full-parcela", "A definir"],
      ],
    },
    {
      titulo: "Informações adicionais e LGPD",
      campos: [
        ["Observações", "full-observacao", "Sem observações"],
        ["Aceita informativos", "full-informativos", "Não"],
        ["Autorização LGPD", "full-consentimento", "Não"],
      ],
    },
  ];
}

function gerarHtmlPdfFinanciamento() {
  const config = carregarConfigLoja();
  const dataGeracao = new Date().toLocaleString("pt-BR");
  const nomeCliente = valorCampoCompleto("full-nome", "Cliente");
  const secoes = gruposDadosFinanciamento()
    .map(function (grupo) {
      const linhas = grupo.campos
        .map(function (campo) {
          return (
            "<tr><th>" +
            escaparHTML(campo[0]) +
            "</th><td>" +
            escaparHTML(valorCampoCompleto(campo[1], campo[2])) +
            "</td></tr>"
          );
        })
        .join("");

      return (
        "<section><h2>" +
        escaparHTML(grupo.titulo) +
        "</h2><table>" +
        linhas +
        "</table></section>"
      );
    })
    .join("");

  return (
    "<!doctype html><html lang=\"pt-BR\"><head><meta charset=\"UTF-8\">" +
    "<title>Dados de financiamento - " +
    escaparHTML(nomeCliente) +
    "</title>" +
    "<style>" +
    "@page{size:A4;margin:12mm}*{box-sizing:border-box}body{font-family:Arial,sans-serif;color:#111827;margin:0;font-size:12px}header{border-bottom:3px solid #D4AF37;padding-bottom:12px;margin-bottom:18px;display:flex;justify-content:space-between;gap:16px}h1{font-size:22px;margin:0 0 6px}header p{margin:2px 0;color:#4b5563}.meta{text-align:right}section{break-inside:avoid;margin-bottom:14px}h2{font-size:15px;margin:0 0 8px;color:#0B1F3A}table{width:100%;border-collapse:collapse}th,td{border:1px solid #E5E7EB;padding:7px 8px;text-align:left;vertical-align:top}th{width:34%;background:#F3F4F6;color:#374151}td{background:#fff}.lgpd{margin-top:16px;padding:10px;border-left:4px solid #D4AF37;background:#F9FAFB;color:#374151}.actions{display:none}@media print{.actions{display:none}}" +
    "</style></head><body>" +
    "<header><div><h1>" +
    escaparHTML(config.nome) +
    "</h1><p>Dados para pré-análise de financiamento</p><p>" +
    escaparHTML(config.email) +
    " | " +
    escaparHTML(config.whatsapp) +
    "</p></div><div class=\"meta\"><p><strong>Cliente</strong></p><p>" +
    escaparHTML(nomeCliente) +
    "</p><p>" +
    escaparHTML(dataGeracao) +
    "</p></div></header>" +
    secoes +
    "<div class=\"lgpd\"><strong>Autorização LGPD:</strong> o cliente autorizou o uso dos dados informados para atendimento, contato, análise de interesse e encaminhamento de pré-simulação de financiamento aos bancos parceiros.</div>" +
    "<script>window.addEventListener('load',function(){window.print();});<\/script>" +
    "</body></html>"
  );
}

function baixarPdfFinanciamento() {
  const janela = window.open("", "_blank");

  if (!janela) {
    alert("Permita pop-ups para gerar o PDF.");
    return;
  }

  janela.document.open();
  janela.document.write(gerarHtmlPdfFinanciamento());
  janela.document.close();
}

preencherSelectVeiculosCompleto(selectVeiculoCompleto);

if (botaoBaixarPdfFinanciamento) {
  botaoBaixarPdfFinanciamento.addEventListener("click", baixarPdfFinanciamento);
}

if (formFinanciamentoCompleto) {
  formFinanciamentoCompleto.addEventListener("submit", async function (event) {
    event.preventDefault();

    const campos = {};
    formFinanciamentoCompleto
      .querySelectorAll("input, select, textarea")
      .forEach(function (campo) {
        if (!campo.id) return;
        campos[campo.id] =
          campo.type === "checkbox" ? campo.checked : campo.value;
      });
    const consentimento = document.getElementById("full-consentimento");

    if (!consentimento || !consentimento.checked) {
      alert("É necessário autorizar o uso dos dados para enviar a solicitação.");
      return;
    }

    const payload = {
      nome: valorCampoCompleto("full-nome", ""),
      cpf: valorCampoCompleto("full-cpf", ""),
      whatsapp: valorCampoCompleto("full-whatsapp", ""),
      email: valorCampoCompleto("full-email", ""),
      veiculo: valorCampoCompleto("full-veiculo", ""),
      valorVeiculo: valorCampoCompleto("full-valor-veiculo", ""),
      entrada: valorCampoCompleto("full-entrada", ""),
      prazo: Number(String(valorCampoCompleto("full-prazo", "")).replace(/\D/g, "")) || null,
      parcela: valorCampoCompleto("full-parcela", ""),
      consentimento: true,
      dados: campos,
    };

    let resultado;

    try {
      if (retornoFinanciamento) {
        retornoFinanciamento.textContent = "Enviando sua solicitação...";
        retornoFinanciamento.className = "finance-feedback";
      }

      const resposta = await fetch("/api/financing-applications", {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
      });

      if (!resposta.ok) {
        throw new Error("Não foi possível registrar a solicitação.");
      }

      resultado = await resposta.json();
      const arquivos = documentosFinanciamento
        ? Array.from(documentosFinanciamento.files)
        : [];

      if (arquivos.length) {
        const dadosDocumentos = new FormData();
        dadosDocumentos.append("token", resultado.data.upload_token);
        dadosDocumentos.append(
          "category",
          categoriaDocumentosFinanciamento
            ? categoriaDocumentosFinanciamento.value
            : "Outro"
        );
        arquivos.forEach(function (arquivo) {
          dadosDocumentos.append("documents[]", arquivo);
        });

        const respostaDocumentos = await fetch(
          "/api/financing-applications/" + resultado.data.id + "/documents",
          {
            method: "POST",
            headers: { Accept: "application/json" },
            body: dadosDocumentos,
          }
        );

        if (!respostaDocumentos.ok) {
          throw new Error(
            "A solicitação foi salva, mas não foi possível enviar os documentos."
          );
        }
      }

      if (retornoFinanciamento) {
        retornoFinanciamento.textContent =
          "Solicitação registrada. Protocolo: " +
          resultado.data.portal_protocol +
          ". Guarde este código para acompanhar em /cliente.";
        retornoFinanciamento.className = "finance-feedback success";
      }
    } catch (error) {
      if (retornoFinanciamento) {
        retornoFinanciamento.textContent = error.message;
        retornoFinanciamento.className = "finance-feedback error";
      }
      alert(error.message);
      return;
    }

    const mensagem =
      "Olá, seguem meus dados para pré-análise de financiamento:\n\n" +
      "*Protocolo:* " +
      resultado.data.portal_protocol +
      "\n*Acompanhamento:* " +
      window.location.origin +
      "/cliente\n\n" +
      "*Dados pessoais*\n" +
      linhaFinanciamento("Nome", "full-nome", "Não informado") +
      "\n" +
      linhaFinanciamento("CPF", "full-cpf", "Não informado") +
      "\n" +
      linhaFinanciamento("RG", "full-rg", "Não informado") +
      "\n" +
      linhaFinanciamento("Emissão RG", "full-emissao-rg", "Não informado") +
      "\n" +
      linhaFinanciamento("Nascimento", "full-nascimento", "Não informado") +
      "\n" +
      linhaFinanciamento("Nome da mãe", "full-mae", "Não informado") +
      "\n" +
      linhaFinanciamento("Nome do pai", "full-pai", "Não informado") +
      "\n" +
      linhaFinanciamento("Naturalidade", "full-naturalidade", "Não informado") +
      "\n" +
      linhaFinanciamento("Estado civil", "full-estado-civil", "Não informado") +
      "\n" +
      linhaFinanciamento("Sexo", "full-sexo", "Não informado") +
      "\n" +
      linhaFinanciamento("CNH", "full-cnh", "Não informado") +
      "\n" +
      linhaFinanciamento("E-mail", "full-email", "Não informado") +
      "\n" +
      linhaFinanciamento("Nome do cônjuge", "full-conjuge-nome", "Não informado") +
      "\n" +
      linhaFinanciamento("CPF do cônjuge", "full-conjuge-cpf", "Não informado") +
      "\n" +
      linhaFinanciamento("Renda do cônjuge", "full-conjuge-renda", "Não informado") +
      "\n" +
      linhaFinanciamento("Profissão do cônjuge", "full-conjuge-profissao", "Não informado") +
      "\n\n*Contato e residência*\n" +
      linhaFinanciamento("Telefone", "full-telefone", "Não informado") +
      "\n" +
      linhaFinanciamento("Celular/WhatsApp", "full-whatsapp", "Não informado") +
      "\n" +
      linhaFinanciamento("CEP", "full-cep", "Não informado") +
      "\n" +
      linhaFinanciamento("Endereço", "full-endereco", "Não informado") +
      "\n" +
      linhaFinanciamento("Número", "full-numero", "Não informado") +
      "\n" +
      linhaFinanciamento("Complemento", "full-complemento", "Não informado") +
      "\n" +
      linhaFinanciamento("Bairro", "full-bairro", "Não informado") +
      "\n" +
      linhaFinanciamento("Cidade", "full-cidade", "Não informado") +
      "\n" +
      linhaFinanciamento("UF", "full-estado", "Não informado") +
      "\n" +
      linhaFinanciamento("Tempo de residência", "full-tempo-residencia", "Não informado") +
      "\n\n*Dados profissionais*\n" +
      linhaFinanciamento("Empresa", "full-empresa", "Não informado") +
      "\n" +
      linhaFinanciamento("Cargo/função", "full-cargo", "Não informado") +
      "\n" +
      linhaFinanciamento("Renda mensal", "full-renda", "Não informado") +
      "\n" +
      linhaFinanciamento("Telefone comercial", "full-telefone-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Tempo neste emprego", "full-tempo-trabalho", "Não informado") +
      "\n" +
      linhaFinanciamento("CEP comercial", "full-cep-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Endereço comercial", "full-endereco-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Número comercial", "full-numero-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Complemento comercial", "full-complemento-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Bairro comercial", "full-bairro-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("Cidade comercial", "full-cidade-comercial", "Não informado") +
      "\n" +
      linhaFinanciamento("UF comercial", "full-uf-comercial", "Não informado") +
      "\n\n*Referência bancária*\n" +
      linhaFinanciamento("Banco", "full-banco", "Não informado") +
      "\n" +
      linhaFinanciamento("Agência", "full-agencia", "Não informado") +
      "\n" +
      linhaFinanciamento("Conta", "full-conta", "Não informado") +
      "\n" +
      linhaFinanciamento("Tempo de conta", "full-tempo-conta", "Não informado") +
      "\n\n*Referências pessoais*\n" +
      linhaFinanciamento("Referência 1", "full-ref1-nome", "Não informado") +
      "\n" +
      linhaFinanciamento("Telefone referência 1", "full-ref1-telefone", "Não informado") +
      "\n" +
      linhaFinanciamento("Referência 2", "full-ref2-nome", "Não informado") +
      "\n" +
      linhaFinanciamento("Telefone referência 2", "full-ref2-telefone", "Não informado") +
      "\n\n*Veículo e proposta*\n" +
      linhaFinanciamento("Veículo", "full-veiculo", "Ainda não escolhi") +
      "\n" +
      linhaFinanciamento("Valor do veículo", "full-valor-veiculo", "A definir") +
      "\n" +
      linhaFinanciamento("Entrada", "full-entrada", "A definir") +
      "\n" +
      linhaFinanciamento("Prazo", "full-prazo", "A definir") +
      "\n" +
      linhaFinanciamento("Veículo na troca", "full-troca", "Não") +
      "\n" +
      linhaFinanciamento("Qual veículo na troca", "full-carro-troca", "Não informado") +
      "\n" +
      linhaFinanciamento("Parcela desejada", "full-parcela", "A definir") +
      "\n\n*Informações adicionais*\n" +
      linhaFinanciamento("Observações", "full-observacao", "Sem observações") +
      "\n" +
      linhaFinanciamento("Aceita informativos", "full-informativos", "Não") +
      "\n" +
      linhaFinanciamento("Autorização LGPD", "full-consentimento", "Não") +
      "\n\nDeclaro que autorizei a 3M Veículos, nos termos da LGPD, a usar os dados informados para atendimento, contato, análise de interesse e encaminhamento de pré-simulação de financiamento aos bancos parceiros.";

    window.open(criarLinkWhatsApp(mensagem), "_blank", "noopener");
  });
}

