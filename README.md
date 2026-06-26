# 3M Veículos

Aplicação de catálogo e gestão de revenda de veículos em Laravel 12.

O painel inclui estoque, vendas, financeiro, clientes, histórico operacional,
conteúdo institucional e analytics básico das visitas.

## Requisitos

- PHP 8.2+
- Composer
- Node.js e npm

## Instalação

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Configure o banco no `.env` (o ambiente atual usa MySQL). Acesse
`http://127.0.0.1:8000`.

Para melhor desempenho após concluir alterações:

```powershell
php artisan optimize
```

Ao alterar rotas ou variáveis do `.env`, limpe os caches antes de continuar:

```powershell
php artisan optimize:clear
```

Para converter imagens Base64 de instalações anteriores:

```powershell
php artisan media:migrate-base64
```

## Testes e estilo

```powershell
php artisan test
vendor\bin\pint --test
```

Consulte [MIGRATION_STATUS.md](MIGRATION_STATUS.md) para o estado atual da
migração e as próximas etapas.
