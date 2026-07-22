# 3M Veículos

Sistema Laravel para catálogo público e painel administrativo de uma revenda de veículos.

O projeto inclui estoque, clientes/CRM, propostas, financiamento, vendedores, financeiro, depoimentos, parcerias, analytics básico, área do cliente e gestão de imagens.

## Requisitos

- PHP 8.2+
- Composer
- Node.js 20+ e npm
- MySQL/MariaDB em produção
- Extensões PHP comuns do Laravel: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`

## Instalação local

Na pasta do projeto Laravel:

```powershell
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Acesse:

```text
http://127.0.0.1:8000
```

## Login administrativo

Em ambiente local, o seeder cria um usuário conforme as variáveis do `.env`:

```env
ADMIN_USERNAME=admin
ADMIN_ROLE=gestor
ADMIN_PASSWORD=1234
```

Em produção, altere obrigatoriamente `ADMIN_PASSWORD` para uma senha forte com pelo menos 12 caracteres antes de rodar `php artisan db:seed`.

## Configuração do `.env`

Copie `.env.example` para `.env` e ajuste:

```env
APP_NAME="3M Veículos"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com.br

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=revenda_carros
DB_USERNAME=usuario
DB_PASSWORD=senha

ADMIN_USERNAME=admin
ADMIN_ROLE=gestor
ADMIN_PASSWORD=troque-por-uma-senha-forte
```

Nunca suba o arquivo `.env` para o Git.

Para produção, prefira começar pelo modelo seguro:

```bash
cp .env.production.example .env
php artisan key:generate --force
```

Depois ajuste domínio, banco, e-mail e `ADMIN_PASSWORD`.

## Banco e dados iniciais

Para criar as tabelas:

```powershell
php artisan migrate
```

Para popular dados de demonstração e usuário admin:

```powershell
php artisan db:seed
```

Para recriar tudo em ambiente local:

```powershell
php artisan migrate:fresh --seed
```

## Imagens e uploads

Crie o link público do storage:

```powershell
php artisan storage:link
```

O sistema valida imagens enviadas em base64, limita tamanho e salva arquivos em `storage/app/public`.

Para migrar imagens antigas em base64:

```powershell
php artisan media:migrate-base64
```

## Build dos assets

Ambiente local:

```powershell
npm run dev
```

Produção:

```powershell
npm run build
```

## Otimização para produção

Depois de configurar `.env`, banco e assets:

```powershell
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Se alterar `.env`, rotas ou views, limpe e regenere caches:

```powershell
php artisan optimize:clear
```

## Segurança básica

Antes de publicar:

- use `APP_ENV=production`;
- use `APP_DEBUG=false`;
- defina `APP_URL` com o domínio real;
- troque a senha padrão do admin;
- use `ADMIN_ROLE=gestor` apenas para usuários que podem acessar todo o painel;
- use banco com usuário/senha próprios;
- mantenha `.env`, `vendor`, `node_modules`, banco SQLite e caches fora do Git;
- configure HTTPS na hospedagem;
- garanta permissão de escrita em `storage` e `bootstrap/cache`.

## Perfis de acesso

O campo `role` do usuário controla as permissões reais no backend:

- `gestor`: acesso total;
- `vendedor`: clientes, atendimentos e comunicações;
- `financeiro`: financeiro, vendedores, vendas e financiamentos;
- `estoque`: veículos e histórico operacional;
- `marketing`: loja, depoimentos, parcerias e analytics.

O usuário criado pelo seeder usa `ADMIN_ROLE`. Para ambientes simples, mantenha:

```env
ADMIN_ROLE=gestor
```

## Testes

```powershell
php artisan test
vendor\bin\pint --test
```

Para corrigir estilo automaticamente:

```powershell
vendor\bin\pint
```

## Deploy sugerido

No servidor:

```bash
git clone https://github.com/olicosta/revenda_carros.git
cd revenda_carros
composer install --no-dev --optimize-autoloader
npm ci
npm run build
cp .env.production.example .env
php artisan key:generate --force
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Configure o document root da hospedagem para a pasta `public`.

Antes de publicar, confirme:

- `public/hot` não existe no servidor;
- `public/storage` aponta para `storage/app/public`;
- `APP_ENV=production`;
- `APP_DEBUG=false`;
- `APP_URL` usa HTTPS e domínio real;
- `ADMIN_PASSWORD` não é a senha padrão;
- `storage` e `bootstrap/cache` têm permissão de escrita.

## Observações

- O projeto foi migrado para Laravel e mantém compatibilidade com rotas antigas como `/index.html`, `/carros.html` e `/admin.html`.
- Consulte [MIGRATION_STATUS.md](MIGRATION_STATUS.md) para histórico da migração.
