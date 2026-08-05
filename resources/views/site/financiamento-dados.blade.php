<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('site.partials.pwa')
    <meta
      name="description"
      content="Formulário completo de dados para pré-análise de financiamento automotivo."
    />
    <title>Dados para Financiamento - 3M Veículos</title>
    <link rel="stylesheet" href="/css/style.css?v=20260805-gallery-lightbox" />
  </head>
  <body>
    <main class="finance-external-page">
      <section class="finance-external-hero">
        <div class="container finance-external-heading">
          <a href="financiamento.html" class="finance-back-link">Voltar para financiamento</a>
          <span>Pré-análise bancária</span>
          <h1>Dados para simulação de financiamento</h1>
          <p>
            Seus dados são restritos e somente a revenda terá acesso. Preencha com atenção
            para ajudar a equipe a encaminhar a simulação aos bancos parceiros.
          </p>
        </div>
      </section>

      <section class="finance-page">
        <div class="container finance-complete-layout">
          <form id="form-financiamento-completo" class="finance-complete-form">
            <div class="finance-privacy-note">
              <strong>Proteção de dados - LGPD</strong>
              <p>
                Seus dados são restritos à 3M Veículos e serão usados apenas para atendimento,
                contato, análise de interesse e encaminhamento de pré-simulação de financiamento
                aos bancos parceiros, quando necessário.
              </p>
            </div>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>01</span>
                <div>
                  <h2>Dados pessoais</h2>
                  <p>Informações básicas para identificação e cadastro.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Nome completo
                  <input type="text" id="full-nome" required />
                </label>
                <label>
                  CPF
                  <input type="text" id="full-cpf" required />
                </label>
                <label>
                  RG
                  <input type="text" id="full-rg" />
                </label>
                <label>
                  Data de emissão do RG
                  <input type="date" id="full-emissao-rg" />
                </label>
                <label>
                  Data de nascimento
                  <input type="date" id="full-nascimento" />
                </label>
                <label>
                  Nome da mãe
                  <input type="text" id="full-mae" />
                </label>
                <label>
                  Nome do pai
                  <input type="text" id="full-pai" />
                </label>
                <label>
                  Naturalidade
                  <input type="text" id="full-naturalidade" placeholder="Cidade/UF" />
                </label>
                <label>
                  Estado civil
                  <select id="full-estado-civil">
                    <option value="">Selecione</option>
                    <option>Solteiro(a)</option>
                    <option>Casado(a)</option>
                    <option>Separado(a)</option>
                    <option>Divorciado(a)</option>
                    <option>Viúvo(a)</option>
                    <option>Outros</option>
                  </select>
                </label>
                <label>
                  Sexo
                  <select id="full-sexo">
                    <option value="">Selecione</option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                    <option>Outro</option>
                    <option>Prefiro não informar</option>
                  </select>
                </label>
                <label>
                  CNH
                  <select id="full-cnh">
                    <option value="">Selecione</option>
                    <option>Possui CNH</option>
                    <option>Não possui CNH</option>
                    <option>Em processo de habilitação</option>
                  </select>
                </label>
                <label>
                  E-mail
                  <input type="email" id="full-email" />
                </label>
                <label>
                  Nome do cônjuge
                  <input type="text" id="full-conjuge-nome" />
                </label>
                <label>
                  CPF do cônjuge
                  <input type="text" id="full-conjuge-cpf" />
                </label>
                <label>
                  Renda do cônjuge
                  <input type="text" id="full-conjuge-renda" placeholder="Ex: R$ 3.500" />
                </label>
                <label>
                  Profissão do cônjuge
                  <input type="text" id="full-conjuge-profissao" />
                </label>
              </div>
            </section>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>02</span>
                <div>
                  <h2>Contato e endereço</h2>
                  <p>Dados para retorno, residência e conferência cadastral.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Telefone
                  <input type="tel" id="full-telefone" />
                </label>
                <label>
                  Celular / WhatsApp
                  <input type="tel" id="full-whatsapp" required />
                </label>
                <label>
                  CEP
                  <input
                    type="text"
                    id="full-cep"
                    data-cep
                    data-cep-endereco="full-endereco"
                    data-cep-bairro="full-bairro"
                    data-cep-cidade="full-cidade"
                    data-cep-uf="full-estado"
                    inputmode="numeric"
                    maxlength="9"
                  />
                </label>
                <label>
                  Endereço
                  <input type="text" id="full-endereco" />
                </label>
                <label>
                  Número
                  <input type="text" id="full-numero" />
                </label>
                <label>
                  Complemento
                  <input type="text" id="full-complemento" />
                </label>
                <label>
                  Bairro
                  <input type="text" id="full-bairro" />
                </label>
                <label>
                  Cidade
                  <input type="text" id="full-cidade" />
                </label>
                <label>
                  UF
                  <select id="full-estado">
                    <option value="">UF</option>
                    <option>AC</option><option>AL</option><option>AP</option><option>AM</option>
                    <option>BA</option><option>CE</option><option>DF</option><option>ES</option>
                    <option>GO</option><option>MA</option><option>MT</option><option>MS</option>
                    <option>MG</option><option>PA</option><option>PB</option><option>PR</option>
                    <option>PE</option><option>PI</option><option>RJ</option><option>RN</option>
                    <option>RS</option><option>RO</option><option>RR</option><option>SC</option>
                    <option>SP</option><option>SE</option><option>TO</option>
                  </select>
                </label>
                <label>
                  Tempo de residência
                  <input type="text" id="full-tempo-residencia" placeholder="Ex: 3 anos" />
                </label>
              </div>
            </section>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>03</span>
                <div>
                  <h2>Dados profissionais</h2>
                  <p>Informações profissionais e endereço comercial.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Empresa onde trabalha
                  <input type="text" id="full-empresa" />
                </label>
                <label>
                  Cargo / função
                  <input type="text" id="full-cargo" />
                </label>
                <label>
                  Renda mensal
                  <input type="text" id="full-renda" placeholder="Ex: R$ 4.500" required />
                </label>
                <label>
                  Telefone comercial
                  <input type="tel" id="full-telefone-comercial" />
                </label>
                <label>
                  Tempo neste emprego
                  <input type="text" id="full-tempo-trabalho" placeholder="Ex: 2 anos" />
                </label>
                <label>
                  CEP comercial
                  <input
                    type="text"
                    id="full-cep-comercial"
                    data-cep
                    data-cep-endereco="full-endereco-comercial"
                    data-cep-bairro="full-bairro-comercial"
                    data-cep-cidade="full-cidade-comercial"
                    data-cep-uf="full-uf-comercial"
                    inputmode="numeric"
                    maxlength="9"
                  />
                </label>
                <label class="finance-form-full">
                  Endereço comercial
                  <input type="text" id="full-endereco-comercial" />
                </label>
                <label>
                  Número
                  <input type="text" id="full-numero-comercial" />
                </label>
                <label>
                  Complemento
                  <input type="text" id="full-complemento-comercial" />
                </label>
                <label>
                  Bairro
                  <input type="text" id="full-bairro-comercial" />
                </label>
                <label>
                  Cidade
                  <input type="text" id="full-cidade-comercial" />
                </label>
                <label>
                  UF
                  <select id="full-uf-comercial">
                    <option value="">UF</option>
                    <option>AC</option><option>AL</option><option>AP</option><option>AM</option>
                    <option>BA</option><option>CE</option><option>DF</option><option>ES</option>
                    <option>GO</option><option>MA</option><option>MT</option><option>MS</option>
                    <option>MG</option><option>PA</option><option>PB</option><option>PR</option>
                    <option>PE</option><option>PI</option><option>RJ</option><option>RN</option>
                    <option>RS</option><option>RO</option><option>RR</option><option>SC</option>
                    <option>SP</option><option>SE</option><option>TO</option>
                  </select>
                </label>
              </div>
            </section>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>04</span>
                <div>
                  <h2>Referência bancária</h2>
                  <p>Relacionamento bancário atual do cliente.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Banco
                  <input type="text" id="full-banco" />
                </label>
                <label>
                  Agência
                  <input type="text" id="full-agencia" />
                </label>
                <label>
                  Conta
                  <input type="text" id="full-conta" />
                </label>
                <label>
                  Tempo de conta
                  <input type="text" id="full-tempo-conta" />
                </label>
              </div>
            </section>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>05</span>
                <div>
                  <h2>Referências pessoais</h2>
                  <p>Duas pessoas para referência de contato.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Nome da referência 1
                  <input type="text" id="full-ref1-nome" />
                </label>
                <label>
                  Telefone da referência 1
                  <input type="tel" id="full-ref1-telefone" />
                </label>
                <label>
                  Nome da referência 2
                  <input type="text" id="full-ref2-nome" />
                </label>
                <label>
                  Telefone da referência 2
                  <input type="tel" id="full-ref2-telefone" />
                </label>
              </div>
            </section>

            <section class="finance-form-section">
              <div class="finance-section-title">
                <span>06</span>
                <div>
                  <h2>Veículo e proposta</h2>
                  <p>Dados do carro, entrada e prazo desejado.</p>
                </div>
              </div>

              <div class="finance-form">
                <label>
                  Veículo de interesse
                  <select id="full-veiculo">
                    <option value="">Ainda não escolhi</option>
                  </select>
                </label>
                <label>
                  Valor aproximado do veículo
                  <input type="text" id="full-valor-veiculo" placeholder="Ex: R$ 90.000" />
                </label>
                <label>
                  Valor de entrada
                  <input type="text" id="full-entrada" placeholder="Ex: R$ 20.000" />
                </label>
                <label>
                  Prazo desejado
                  <select id="full-prazo">
                    <option value="">A definir</option>
                    <option>24x</option>
                    <option>36x</option>
                    <option>48x</option>
                    <option>60x</option>
                  </select>
                </label>
                <label>
                  Possui veículo na troca?
                  <select id="full-troca">
                    <option>Não</option>
                    <option>Sim</option>
                  </select>
                </label>
                <label>
                  Qual veículo na troca?
                  <input type="text" id="full-carro-troca" placeholder="Ex: Corolla 2018 XEi" />
                </label>
                <label>
                  Valor desejado de parcela
                  <input type="text" id="full-parcela" placeholder="Ex: até R$ 1.800" />
                </label>
              </div>
            </section>

            <section class="finance-form-section finance-consent-section">
              <div class="finance-section-title">
                <span>07</span>
                <div>
                  <h2>Informações adicionais</h2>
                  <p>Use este campo para completar dados importantes.</p>
                </div>
              </div>

              <textarea
                id="full-observacao"
                rows="5"
                placeholder="Inclua detalhes do usado na troca, banco de preferência, restrições, melhor horário para contato ou outras informações."
              ></textarea>

              <label class="finance-consent">
                <input type="checkbox" id="full-informativos" checked />
                Aceito receber informativos e contatos da 3M Veículos sobre este atendimento.
              </label>

              <label class="finance-consent">
                <input type="checkbox" id="full-consentimento" required />
                Autorizo, nos termos da LGPD, que a 3M Veículos colete e utilize os dados
                informados neste formulário para atendimento, contato, análise de interesse,
                organização da proposta e encaminhamento de pré-simulação de financiamento
                aos bancos e instituições parceiras.
              </label>

              <div class="finance-documents">
                <label for="full-documentos-categoria">Tipo dos documentos</label>
                <select id="full-documentos-categoria">
                  <option value="Identificação">Identificação (RG, CPF ou CNH)</option>
                  <option value="Comprovante de renda">Comprovante de renda</option>
                  <option value="Comprovante de residência">Comprovante de residência</option>
                  <option value="Outro">Outro</option>
                </select>
                <label for="full-documentos">Documentos para análise (opcional)</label>
                <input type="file" id="full-documentos" multiple accept=".pdf,.jpg,.jpeg,.png,.webp" />
                <small>Até 8 arquivos de 5 MB cada. PDF, JPG, PNG ou WebP.</small>
              </div>

              <p id="financiamento-retorno" class="finance-feedback" role="status" aria-live="polite"></p>

              <button type="submit" class="btn-whatsapp finance-submit">
                Enviar dados para a 3M Veículos
              </button>
              <button type="button" class="btn-secondary-dark finance-pdf-button" id="baixar-pdf-financiamento">
                Baixar PDF para bancos
              </button>
            </section>
          </form>

          <aside class="finance-complete-side">
            <div class="finance-info-card">
              <span class="finance-icon">DOC</span>
              <h3>Documentos que podem ser solicitados</h3>
              <p>CNH ou RG/CPF, comprovante de residência e comprovante de renda atualizado.</p>
            </div>
            <div class="finance-info-card">
              <span class="finance-icon">OK</span>
              <h3>Antes de enviar</h3>
              <p>Confira CPF, WhatsApp, renda, entrada, endereço e veículo escolhido.</p>
            </div>
          </aside>
        </div>
      </section>
    </main>

    @include('site.partials.footer')
    @include('site.partials.whatsapp-floating')

    <script src="/js/config.js?v=20260805-admin-panel-guard"></script>
    <script data-site-script data-src="/js/carros.js?v=20260618-performance"></script>
    <script data-site-script data-src="/js/storage.js?v=20260621-banco"></script>
    <script data-site-script data-src="/js/financiamento-dados.js?v=20260625-modal-cards"></script>
  </body>
</html>













