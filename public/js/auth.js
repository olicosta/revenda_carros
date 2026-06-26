const credenciaisPadraoAdmin = {
  usuario: "admin",
  senha: "1234",
};

function carregarCredenciaisAdmin() {
  try {
    return (
      JSON.parse(localStorage.getItem("adminCredenciais")) ||
      credenciaisPadraoAdmin
    );
  } catch (erro) {
    return credenciaisPadraoAdmin;
  }
}

function adminEstaLogado() {
  return (
    sessionStorage.getItem("adminLogado") === "true" ||
    localStorage.getItem("adminLogado") === "true"
  );
}

function loginAdmin(usuario, senha, manterConectado) {
  const credenciais = carregarCredenciaisAdmin();

  if (usuario !== credenciais.usuario || senha !== credenciais.senha) {
    return false;
  }

  sessionStorage.setItem("adminLogado", "true");

  if (manterConectado) {
    localStorage.setItem("adminLogado", "true");
  } else {
    localStorage.removeItem("adminLogado");
  }

  return true;
}

function logoutAdmin() {
  sessionStorage.removeItem("adminLogado");
  localStorage.removeItem("adminLogado");
  window.location.href = "login.html";
}

function alterarCredenciaisAdmin(usuarioAtual, senhaAtual, novoUsuario, novaSenha) {
  const credenciais = carregarCredenciaisAdmin();

  if (usuarioAtual !== credenciais.usuario || senhaAtual !== credenciais.senha) {
    return false;
  }

  localStorage.setItem(
    "adminCredenciais",
    JSON.stringify({
      usuario: novoUsuario,
      senha: novaSenha,
    })
  );

  return true;
}

function protegerAdmin() {
  if (!adminEstaLogado()) {
    window.location.replace("login.html");
  }
}

function redirecionarAdminLogado() {
  if (adminEstaLogado()) {
    window.location.replace("admin.html");
  }
}

