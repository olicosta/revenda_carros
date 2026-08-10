const formFinanciamentoInteresse = document.getElementById("form-financiamento-interesse");
const selectVeiculoFinanciamento = document.getElementById("fin-veiculo");

function preencherSelectVeiculos(select) {
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

function valorCampoFinanciamento(id, fallback) {
  const campo = document.getElementById(id);
  return campo && campo.value.trim() ? campo.value.trim() : fallback;
}

function mensagemInteresseFinanciamento(dados) {
  const template =
    (carregarConfigLoja().mensagemFinanciamentoInteresse ||
      lojaConfig.mensagemFinanciamentoInteresse);

  return template.replace(/\{(\w+)\}/g, function (_, chave) {
    return dados[chave] !== undefined ? dados[chave] : "";
  });
}

preencherSelectVeiculos(selectVeiculoFinanciamento);

if (selectVeiculoFinanciamento) {
  const paramsFinanciamento = new URLSearchParams(window.location.search);
  const veiculoSelecionado = paramsFinanciamento.get("veiculo");

  if (veiculoSelecionado) {
    selectVeiculoFinanciamento.value = veiculoSelecionado;

    if (selectVeiculoFinanciamento.value !== veiculoSelecionado) {
      const option = document.createElement("option");
      option.value = veiculoSelecionado;
      option.textContent = veiculoSelecionado;
      selectVeiculoFinanciamento.appendChild(option);
      selectVeiculoFinanciamento.value = veiculoSelecionado;
    }
  }
}

if (formFinanciamentoInteresse) {
  formFinanciamentoInteresse.addEventListener("submit", function (event) {
    event.preventDefault();

    const linkCompleto =
      window.location.origin +
      window.location.pathname.replace("financiamento.html", "financiamento-dados.html");

    const mensagem = mensagemInteresseFinanciamento({
      nome: valorCampoFinanciamento("fin-nome", "Não informado"),
      whatsapp: valorCampoFinanciamento("fin-telefone", "Não informado"),
      veiculo: valorCampoFinanciamento("fin-veiculo", "Ainda não escolhi"),
      entrada: valorCampoFinanciamento("fin-entrada", "A definir"),
      temTroca: valorCampoFinanciamento("fin-tem-troca", "Não"),
      carroTroca: valorCampoFinanciamento("fin-carro-troca", "Não informado"),
      linkCompleto: linkCompleto,
    });

    window.open(criarLinkWhatsApp(mensagem), "_blank", "noopener");
  });
}

