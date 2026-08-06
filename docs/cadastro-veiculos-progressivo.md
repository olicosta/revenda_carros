# Cadastro progressivo de veículos

## Diagnóstico do módulo antigo

- O cadastro ficava concentrado em um único formulário longo no painel administrativo.
- A API preservava compatibilidade com campos legados em português e armazenava muitos dados no campo `metadata`.
- O banco possuía uma tabela `vehicles` simples, já integrada a vendas, financeiro, leads, histórico, fotos e anúncios públicos.
- Custos, comissão e preço de venda já impactavam o financeiro, então a refatoração precisava preservar os nomes legados usados pelo JavaScript.
- A listagem pública consome os mesmos dados normalizados, por isso informações sensíveis devem ser tratadas com cuidado em etapas futuras.

## Estratégia aplicada

- Preservar os registros existentes.
- Adicionar campos estruturais novos à tabela `vehicles` sem remover `metadata`.
- Manter a API compatível com o payload legado atual.
- Transformar o formulário do painel em cadastro rápido + seções progressivas.
- Registrar histórico backend para criação e alterações sensíveis.
- Bloquear duplicidade de placa ativa no backend e no frontend.

## Campos estruturais adicionados

- `stock_code`
- `plate`
- `version`
- `manufacture_year`
- `model_year`
- `condition`
- `origin`
- `store_unit`
- `responsible_user_id`
- datas operacionais de estoque
- `completion_percentage`
- `documentation`
- `condition_report`
- `financial_details`
- `preparation`
- `publication`
- `validation_status`
- `record_version`

## Regras implementadas

- Cadastro rápido pode salvar veículo como `Cadastro incompleto`.
- Placa ativa não pode ser duplicada.
- Conclusão do cadastro é calculada por grupos: básicos, documentação, financeiro, conservação, opcionais, fotos e anúncio.
- Tentativa de marcar como vendido exige cadastro minimamente completo.
- Alterações de preço, custo, comissão e status geram histórico backend.
- Perfil vendedor não visualiza a seção financeira no formulário progressivo.

## Limitações desta etapa

- Upload de documentos, anexos formais e drag-and-drop de mídia ainda não foram implementados.
- Marketplace/FIPE/consulta por placa ficaram preparados apenas como campos manuais.
- A API pública ainda preserva compatibilidade com dados legados; a separação completa de payload público versus payload administrativo deve ser feita em uma próxima etapa.
- Autosave por seção ainda não foi ativado para evitar conflito com a persistência atual em fila/localStorage.

## Checklist manual

1. Criar veículo preenchendo apenas o cadastro rápido.
2. Confirmar que ele aparece no estoque como `Cadastro incompleto`.
3. Editar o veículo e completar documentação, conservação, opcionais, financeiro e fotos.
4. Confirmar atualização do percentual de conclusão.
5. Testar placa duplicada em outro veículo ativo.
6. Tentar marcar um cadastro incompleto como vendido.
7. Marcar veículo completo como disponível e depois vendido.
8. Conferir histórico do veículo.
9. Validar painel em desktop e celular.
10. Conferir que site público continua listando veículos.
