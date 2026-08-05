<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('site.partials.pwa')
  <title>Nova senha | 3M Veículos</title>
  <link rel="stylesheet" href="/css/style.css?v=20260805-fin-menu-visible" />
</head>
<body class="login-page">
  <main class="customer-portal">
    <section class="customer-login-card">
      <h1>Definir nova senha</h1>
      <form method="post" action="{{ route('password.update') }}" class="customer-login-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}" />
        <label>E-mail <input type="email" name="email" value="{{ old('email', $email) }}" required /></label>
        <label>Nova senha <input type="password" name="password" minlength="8" required /></label>
        <label>Confirmar senha <input type="password" name="password_confirmation" minlength="8" required /></label>
        @if ($errors->any()) <p class="finance-feedback error">{{ $errors->first() }}</p> @endif
        <button type="submit" class="btn-primary">Salvar nova senha</button>
      </form>
    </section>
  </main>
</body>
</html>
