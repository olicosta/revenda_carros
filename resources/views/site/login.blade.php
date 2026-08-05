<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <title>Login Admin - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260805-footer-final" />
  </head>
  <body class="login-page">
    <main class="login-shell">
      <section class="login-card">
        <div class="login-brand-panel">
          <a href="index.html" class="logo login-logo" aria-label="3M Veículos">
            <img src="/img/logo-3m-veiculos.jpg" alt="" />
            <span>3M <small>Veículos</small></span>
          </a>

          <div class="login-motivation-card" aria-live="polite">
            <span>Mensagem do dia</span>
            <p>{{ $motivation }}</p>
          </div>

          <div class="login-brand-copy">
            <span>Painel exclusivo</span>
            <h2>Controle sua vitrine com facilidade</h2>
            <p>Estoque, fotos, vendas e contatos sempre organizados.</p>
          </div>
        </div>

        <div class="login-content">
          <span class="badge">Área administrativa</span>
          <h1>Acessar painel</h1>
          <p>
            Entre para gerenciar veículos, fotos, depoimentos, parcerias e dados
            da loja.
          </p>

          <form method="post" action="{{ route('login.store') }}" class="login-form" data-submit-once>
            @csrf
            <label for="login-usuario">Usuário</label>
            <input
              type="text"
              id="login-usuario"
              name="username"
              value="{{ old('username') }}"
              placeholder="Digite seu usuário"
              autocomplete="username"
              autofocus
              required
            />

            <label for="login-senha">Senha</label>
            <input
              type="password"
              id="login-senha"
              name="password"
              placeholder="Digite sua senha"
              autocomplete="current-password"
              required
            />

            <label class="check-filtro login-check">
              <input type="checkbox" name="remember" value="1" />
              Manter conectado
            </label>

            <button type="submit" class="btn-primary">Entrar no painel</button>
            <a href="{{ route('password.request') }}" class="login-voltar">Esqueci minha senha</a>
            @error('username')
              <p class="login-erro" style="display: block" aria-live="polite">{{ $message }}</p>
            @enderror
          </form>

          <a href="index.html" class="login-voltar">Voltar para o site</a>
        </div>
      </section>
    </main>

    <script src="/js/config.js?v=20260805-footer-final"></script>
    <script>
      document.querySelector("[data-submit-once]")?.addEventListener("submit", function () {
        const botao = this.querySelector('button[type="submit"]');
        if (!botao || botao.disabled) return;
        botao.disabled = true;
        botao.textContent = "Entrando...";
      });
    </script>
  </body>
</html>













