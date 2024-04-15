<div class="tab-content" id="main_form">
    <div class="tab-pane active " role="tabpanel" id="step1">
        <div class="row">

            <div class="col-12 col-lg-12 bg-white ">
                <div class=" w-100 pb-2">
                    <div class="row">
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_primeiro_nome" placeholder="Primeiro Nome"
                                class="shadow form-control form-control-lg" required>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_meio_nome" placeholder="Nome do Meio"
                                class="shadow form-control form-control-lg">
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_ultimo_nome" placeholder="Último Nome"
                                class="shadow form-control form-control-lg" required>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_numero_bi_ou_passaporte"
                                placeholder="Nº do B.I. ou Passaporte" class="shadow form-control form-control-lg"
                                required>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_telefone" placeholder="Nº do WhatsApp"
                                class="shadow form-control form-control-lg" required>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="email" name="vc_email" placeholder="Email"
                                class="shadow form-control form-control-lg" required>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="date" name="dt_nascimento" placeholder="Data de Nascimento"
                                class="shadow form-control form-control-lg">
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <select name="vc_pais" class="shadow form-control form-control-lg">
                                <option value="" selected disabled>Seleciona o País</option>
                                <option value="Angola">Angola</option>
                                <option value="ca">Canadá</option>
                                <option value="us">Estados Unidos</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <select name="vc_provincia" class="shadow form-control form-control-lg" required>
                                <option value="" selected disabled>Seleciona o Estado</option>
                                <option value="Angola">Angola</option>
                                <option value="ca">Canadá</option>
                                <option value="us">Estados Unidos</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_localidade" placeholder="Localidade"
                                class="shadow form-control form-control-lg" required>
                        </div>

                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_municipio" placeholder="Município"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Distrito -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_destrito" placeholder="Distrito"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Zona -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_zona" placeholder="Zona"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Bairro -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_bairro" placeholder="Bairro"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Nº do telefone alternativo -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="tel" name="vc_alternativo_telefone"
                                placeholder="Nº do telefone alternativo" class="shadow form-control form-control-lg">
                        </div>

                        <!-- Sexo -->
                        <div class="col-lg-6 col-md mb-3">
                            <select placeholder="Sexo" name="vc_sexo" class="shadow form-control form-control-lg">
                                <option value="" selected disabled>Selecione
                                    o Sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>

                        <!-- Município em que trabalha ou estuda -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_municipio_estudo_trabalho"
                                placeholder="Município em que trabalha ou estuda"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Distrito em que trabalha ou estuda -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_distrito_estudo_trabalho"
                                placeholder="Distrito em que trabalha ou estuda"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Zona em que trabalha ou estuda -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_zona_estudo_trabalho"
                                placeholder="Zona em que trabalha ou estuda"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Bairro em que trabalha ou estuda -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_bairro_estudo_trabalho"
                                placeholder="Bairro em que trabalha ou estuda"
                                class="shadow form-control form-control-lg">
                        </div>

                        <!-- Área em que se dirige com frequência -->
                        <div class="col-lg-6 col-md mb-3">
                            <input type="text" name="vc_area_dirigir_frequencia"
                                placeholder="Área em que se dirige com frequência"
                                class="shadow form-control form-control-lg">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-primary rounded-pill pt-3 pb-3 next-step">
                    Próximo Passo</button></li>
        </ul>
    </div>
    <div class="tab-pane" role="tabpanel" id="step2">
        <div class="row">
            <div class="row">
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_marca" placeholder="Marca do Veículo"
                        class="shadow form-control form-control-lg">
                </div>

                <!-- Modelo -->
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_modelo" placeholder="Modelo"
                        class="shadow form-control form-control-lg">
                </div>
            </div>

            <!-- Ano de Fabrico -->
            <div class="row">
                <div class="col-lg-6 col-md mb-3">
                    <input type="number" name="vc_ano_fabrico" placeholder="Ano de Fabrico"
                        class="shadow form-control form-control-lg">
                </div>

                <!-- Cor -->
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_cor" placeholder="Cor"
                        class="shadow form-control form-control-lg">
                </div>
            </div>

            <!-- Matrícula -->
            <div class="row">
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_matricula" placeholder="Matrícula"
                        class="shadow form-control form-control-lg">
                </div>

                <!-- Lugares -->
                <div class="col-lg-6 col-md mb-3">
                    <input type="number" name="vc_lugar" placeholder="Lugares"
                        class="shadow form-control form-control-lg">
                </div>
            </div>

            <!-- Nº do Livrete -->
            <div class="row">
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_livrete" placeholder="Nº do Livrete"
                        class="shadow form-control form-control-lg">
                </div>

                <!-- Nº da Carta de Condução -->
                <div class="col-lg-6 col-md mb-3">
                    <input type="text" name="vc_numero_carta" placeholder="Nº da Carta de Condução"
                        class="shadow form-control form-control-lg">
                </div>
            </div>

            <!-- Disponibilidade para o Serviço -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="disponibilidade" class="form-label">Disponibilidade para o Serviço</label>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="vc_disponibilidade" type="radio" id="partTime"
                            value="partTime">
                        <label class="form-check-label" for="partTime">Part-time</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="vc_disponibilidade" type="radio" id="fullTime"
                            value="fullTime">
                        <label class="form-check-label" for="fullTime">Full-time</label>
                    </div>
                </div>
            </div>

            <!-- Tipo de Serviço a Prestar -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="tipoServico" class="form-label">Tipo de Serviço a
                        Prestar</label>
                </div>
                @foreach ($site_tipo_servicos as $item)
                    <div class="col-lg-3 col-md mb-3">
                        <div class="form-check">
                            <input class="form-check-input" name="it_id_tipo_servico[]" type="checkbox"
                                id="{{ $item->vc_tipo_servico }}" value="{{ $item->id }}">
                            <label class="form-check-label"
                                for="{{ $item->vc_tipo_servico }}">{{ $item->vc_tipo_servico }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Forma de Pagamento da Taxa de Subscrição -->
            <div class="row">
                <div class="col-lg-6 col-md mb-3">
                    <select name="vc_forma_pagamento" class="form-select shadow form-control form-control-lg" id="formaPagamento" required>
                        <option value="" selected disabled>Forma de Pagamento
                        </option>
                        <option value="cash">Cash</option>
                        <option value="transferencia">Transferência</option>
                        <option value="deposito">Depósito</option>
                    </select>
                </div>

                <!-- Método de Pagamento da Taxa de Subscrição -->
                <div class="col-lg-6 col-md mb-3">
                    <select name="vc_metodo_pagamento" class="form-select shadow form-control form-control-lg" id="metodoPagamento" required>
                        <option value="" selected disabled>Método de
                            Pagamento</option>
                        <option value="semanal">Semanal</option>
                        <option value="quinzenal">Quinzenal</option>
                        <option value="mensal">Mensal</option>
                    </select>
                </div>
            </div>

            <!-- Comentários -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <textarea name="vc_descricao" class="form-control shadow form-control-lg" id="comentarios" placeholder="Comentários" rows="3"></textarea>
                </div>
            </div>

            <!-- Botão de Envio -->

        </div>

        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-primary rounded-pill pt-3 pb-3 prev-step">Voltar</button>
            </li>
            <li><button type="button"
                    class="btn btn-primary rounded-pill pt-3 pb-3 next-step skip-btn">Manter</button>
            </li>
            <li><button type="button" class="btn btn-primary rounded-pill pt-3 pb-3 next-step">Continuar</button>
            </li>
        </ul>
    </div>

    <div class="tab-pane" role="tabpanel" id="step3">
        <h4 class="text-center">Agradecemos pela sua paciência e desejamos que
            aproveite ao máximo. Obrigado!</h4>


        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-primary rounded-pill pt-3 pb-3 prev-step">Voltar</button>
            </li>
            <li><button type="button" onclick="submit()" class="btn btn-primary rounded-pill pt-3 pb-3 next-step">Finalizar</button>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
