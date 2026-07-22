# Migração para Laravel

## Concluído

- Projeto Laravel 12 criado.
- Páginas migradas para views Blade.
- Assets copiados para `public/`.
- Rotas limpas e aliases `.html` mantidos.
- Banco SQLite configurado para desenvolvimento.
- Login, logout e alteração de credenciais migrados para autenticação Laravel.
- Painel administrativo e APIs de escrita protegidos por autenticação e CSRF.
- Veículos, vendas, saídas financeiras, vendedores e leads persistidos no banco.
- Veículos gravados por operações CRUD individuais em uma fila assíncrona no frontend.
- Inclusões, edições e exclusões de veículos não substituem mais o estoque completo.
- Leads, saídas financeiras e vendedores gravados por CRUD individual assíncrono.
- Cadastro de clientes ampliado com CPF, nascimento, localização, profissão e renda.
- Busca, filtros e priorização de retornos na área comercial.
- Filas independentes preservam a ordem das alterações sem bloquear recursos diferentes.
- Dados públicos carregados por um único bootstrap assíncrono e reutilizados em memória.
- Scripts específicos das páginas carregados após os dados, sem `XMLHttpRequest` síncrono.
- Analytics enviado com `fetch keepalive`, sem bloquear navegação.
- Histórico operacional dos veículos persistido em `vehicle_histories`.
- Visitas do site persistidas individualmente em `analytics_visits`.
- Relatório de analytics centralizado no painel, com importação automática do legado local.
- Depoimentos e parcerias persistidos no banco.
- Configurações da loja e conteúdo da home persistidos em `store_settings`.
- Imagens novas de veículos, galerias, depoimentos e logo salvas no Laravel Storage.
- Conversão automática de Data URLs com validação de formato e limite de 5 MB.
- Comando `media:migrate-base64` para migrar imagens antigas gravadas no banco.
- Conteúdo inicial criado por seeders sem sobrescrever personalizações existentes.
- Fallback em `localStorage` mantido para abrir a versão estática fora do Laravel.
- Testes de autenticação e sincronização das APIs.

## Credenciais locais iniciais

- Usuário: `admin`
- Senha: `1234`

Em produção, defina `ADMIN_USERNAME`, `ADMIN_EMAIL` e `ADMIN_PASSWORD` antes
de executar o seeder de administrador e troque a senha inicial.

## Ainda pendente

- Remover arquivos de mídia órfãos quando registros ou imagens forem substituídos.
- Migrar depoimentos, parcerias e histórico para CRUD individual assíncrono.
- Tornar o envio de duração das visitas assíncrono com `sendBeacon` ou `fetch keepalive`.
- Remover o login legado e os arquivos estáticos duplicados da raiz.
- Substituir requisições síncronas do frontend por carregamento assíncrono.

## Executar localmente

```powershell
cd D:\Users\User\auto-prime-veiculos\laravel
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan media:migrate-base64
php artisan serve
```

Validação:

```powershell
php artisan test
vendor\bin\pint --test
```
