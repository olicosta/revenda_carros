<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('site.partials.pwa')
  <title>Recuperar senha | 3M Veículos</title>
  <link rel="stylesheet" href="/css/style.css?v=20260805-footer-mobile" />
</head>
<body class="login-page">
  <main class="customer-portal">
    <section class="customer-login-card">
      <h1>Recuperar acesso</h1>
      <p>Informe o e-mail do administrador para receber um link seguro.</p>
      @if (session('status')) <p class="finance-feedback success">{{ session('status') }}</p> @endif
      <form method="post" action="{{ route('password.email') }}" class="customer-login-form">
        @csrf
        <label>E-mail <input type="email" name="email" value="{{ old('email') }}" required /></label>
        @error('email') <p class="finance-feedback error">{{ $message }}</p> @enderror
        <button type="submit" class="btn-primary">Enviar link</button>
      </form>
      <a href="{{ route('login') }}" class="login-voltar">Voltar ao login</a>
    </section>
  </main>
</body>
</html>
