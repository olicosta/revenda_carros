redirecionarAdminLogado();

document.addEventListener("DOMContentLoaded", function () {
  aplicarConfigLoja();

  const mensagemVendas = document.getElementById("login-mensagem-vendas");
  const mensagensMotivacionais = [
    "Cada atendimento bem conduzido aproxima o próximo fechamento.",
    "Venda boa começa com escuta, confiança e velocidade no retorno.",
    "Quem conhece o estoque vende com mais segurança e passa mais valor.",
    "O cliente lembra de quem simplifica a decisão e cumpre o combinado.",
    "Organização no painel hoje vira oportunidade fechada amanhã.",
    "Fotos boas, dados certos e resposta rápida aumentam a chance de venda.",
    "Todo contato merece atenção: a próxima venda pode estar na conversa mais simples.",
    "Consistência no atendimento transforma interesse em chave na mão."
  ];

  if (mensagemVendas) {
    const indiceMensagem = Math.floor(Math.random() * mensagensMotivacionais.length);
    mensagemVendas.textContent = mensagensMotivacionais[indiceMensagem];
  }

  const formLogin = document.getElementById("form-login");
  const inputUsuario = document.getElementById("login-usuario");
  const inputSenha = document.getElementById("login-senha");
  const inputManter = document.getElementById("login-manter");
  const loginErro = document.getElementById("login-erro");

  formLogin.addEventListener("submit", function (e) {
    e.preventDefault();

    const logado = loginAdmin(
      inputUsuario.value.trim(),
      inputSenha.value,
      inputManter.checked
    );

    if (logado) {
      window.location.href = "admin.html";
      return;
    }

    loginErro.textContent = "Usuário ou senha inválidos.";
    loginErro.style.display = "block";
    inputSenha.value = "";
    inputSenha.focus();
  });
});

