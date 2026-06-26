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

    const mensagem =
      "Olá, tenho interesse em financiamento:\n\n" +
      "Nome: " +
      valorCampoFinanciamento("fin-nome", "Não informado") +
      "\nWhatsApp: " +
      valorCampoFinanciamento("fin-telefone", "Não informado") +
      "\nVeículo: " +
      valorCampoFinanciamento("fin-veiculo", "Ainda não escolhi") +
      "\nEntrada aproximada: " +
      valorCampoFinanciamento("fin-entrada", "A definir") +
      "\nTem carro para troca: " +
      valorCampoFinanciamento("fin-tem-troca", "Não") +
      "\nCarro na troca: " +
      valorCampoFinanciamento("fin-carro-troca", "Não informado") +
      "\n\nApós o primeiro contato, podem me enviar o link completo para preencher os dados da simulação.\n" +
      "Link completo da loja: " +
      linkCompleto;

    window.open(criarLinkWhatsApp(mensagem), "_blank", "noopener");
  });
}

