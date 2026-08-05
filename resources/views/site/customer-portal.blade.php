<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('site.partials.pwa')
  <title>Área do cliente | 3M Veículos</title>
  <link rel="stylesheet" href="/css/style.css?v=20260805-footer-final" />
</head>
<body class="customer-portal-page">
  <main class="customer-portal">
    <a href="/" class="customer-back">← Voltar ao site</a>

    @if (!$application)
      <section class="customer-login-card">
        <span class="admin-eyebrow">Área segura</span>
        <h1>Acompanhe sua proposta</h1>
        <p>Use o CPF e o protocolo informado após o envio da solicitação.</p>

        <form method="post" action="{{ route('customer.login') }}" class="customer-login-form" data-submit-once>
          @csrf
          <label>CPF
            <input name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" required />
          </label>
          <label>Protocolo
            <input name="protocol" maxlength="16" autocomplete="one-time-code" required />
          </label>
          @error('cpf') <p class="finance-feedback error">{{ $message }}</p> @enderror
          <button class="btn-primary" type="submit">Consultar proposta</button>
        </form>
      </section>
    @else
      <header class="customer-portal-header">
        <div>
          <span class="admin-eyebrow">Olá, {{ $application->customer_name }}</span>
          <h1>Sua proposta de financiamento</h1>
          <p>Protocolo <strong>{{ $application->protocol }}</strong></p>
        </div>
        <form method="post" action="{{ route('customer.logout') }}">
          @csrf
          <button class="btn-secondary-dark" type="submit">Sair</button>
        </form>
      </header>

      <section class="customer-status-card">
        <span>Status atual</span>
        <strong>{{ $application->status }}</strong>
        <p>
          @switch($application->status)
            @case('Aprovada') Sua proposta foi aprovada. Nossa equipe entrará em contato para os próximos passos. @break
            @case('Recusada') A análise foi concluída. Fale com nossa equipe para conhecer outras possibilidades. @break
            @case('Em análise') Seus dados estão sendo analisados pela equipe e instituições parceiras. @break
            @default Recebemos sua solicitação e ela entrará em análise em breve.
          @endswitch
        </p>
      </section>

      <div class="customer-detail-grid">
        <article><span>Veículo</span><strong>{{ data_get($application->form_data, 'full-veiculo', 'A definir') }}</strong></article>
        <article><span>Valor solicitado</span><strong>R$ {{ number_format((float) $application->requested_amount, 2, ',', '.') }}</strong></article>
        <article><span>Entrada</span><strong>R$ {{ number_format((float) $application->down_payment, 2, ',', '.') }}</strong></article>
        <article><span>Prazo</span><strong>{{ $application->installments ?: 'A definir' }} parcelas</strong></article>
        @if ($application->institution)
          <article><span>Instituição</span><strong>{{ $application->institution }}</strong></article>
        @endif
      </div>

      <section class="customer-documents-card">
        <h2>Documentos enviados</h2>
        @forelse ($application->documents as $document)
          <p>{{ $document->category }} — {{ $document->original_name }}</p>
        @empty
          <p>Nenhum documento foi enviado.</p>
        @endforelse
      </section>
    @endif
  </main>
  @include('site.partials.footer')
  @include('site.partials.whatsapp-floating')

  <script>
    document.querySelector("[data-submit-once]")?.addEventListener("submit", function () {
      const botao = this.querySelector('button[type="submit"]');
      if (!botao || botao.disabled) return;
      botao.disabled = true;
      botao.textContent = "Consultando...";
    });
  </script>
</body>
</html>
