@extends('layouts._includes.lab.App')
@section('titulo', 'Simulador de Colisões')
@section('conteudo')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center">
                        <img class="ms-n2" src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Simulador de Colisões <span
                                    class="text-info fw-medium"></span></h4>
                        </div>
                        <img class="ms-n4 d-md-none d-lg-block" src="../assets/img/illustrations/crm-line-chart.png"
                            alt="" width="150" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #canvas {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
    </style>

    <div class="row mb-3 g-3">
        <div class="col-md-12 col-xxl-12">
            <div class="card h-100 ">
                <div class="card-header " data-bs-theme="light">
                    <canvas id="canvas"></canvas>
                    <div class="row g-3">
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="massa1_display">0 kg</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Massa 1</p>
                        </div>
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="massa2_display">0 kg</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Massa 2</p>
                        </div>
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="velocidade1_display">0 m/s</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Velocidade 1</p>
                        </div>
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="velocidade2_display">0 m/s</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Velocidade 2</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-transparent" data-bs-theme="light"><a class="text-white"
                        href="#!">Real-time data<span class="fa fa-chevron-right ms-1 fs-10"></span></a></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Controles<span class="ms-1 text-400" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Average call duration based of last 50 calls"><span
                                        class="far fa-question-circle" data-fa-transform="shrink-1"></span></span></h6>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row ">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="massa1_input">
                                            Massa 1 (kg):</label><input id="massa1_input" min="1" max="100"
                                            class="form-control" type="number" placeholder="Valor" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="massa2_input"> Massa 2
                                            (kg):</label><input class="form-control" value="1" id="massa2_input"
                                            min="0" max="90" type="number" /></div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="velocidade1_input"> Velocidade 1
                                            (m/s):</label><input class="form-control" value="1" id="velocidade1_input"
                                            min="0" max="90" type="number" /></div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="velocidade2_input"> Velocidade 2
                                            (m/s):</label><input class="form-control" value="1" id="velocidade2_input"
                                            min="0" max="90" type="number" /></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick="simular()" class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                        class="far fa-play-circle me-1"></i>Simular</button>
                                <button onclick="reset()" class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                        class="fas fa-redo me-1"></i>Limpar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function simular() {
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var massa1 = parseFloat(document.getElementById('massa1_input').value);
            var massa2 = parseFloat(document.getElementById('massa2_input').value);
            var velocidade1 = parseFloat(document.getElementById('velocidade1_input').value);
            var velocidade2 = parseFloat(document.getElementById('velocidade2_input').value);

            var intervalo = 100; // Intervalo de tempo para a animação (ms)
            var tempo = 0; // Tempo inicial

            var intervalID = setInterval(function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                var posicao1 = velocidade1 * tempo;
                var posicao2 = canvas.width - (velocidade2 * tempo);

                // Desenhar os objetos
                ctx.beginPath();
                ctx.arc(posicao1, canvas.height / 2, 20, 0, 2 * Math.PI);
                ctx.fillStyle = 'blue';
                ctx.fill();

                ctx.beginPath();
                ctx.arc(posicao2, canvas.height / 2, 20, 0, 2 * Math.PI);
                ctx.fillStyle = 'red';
                ctx.fill();

                // Verificar a colisão
                if (posicao1 >= posicao2) {
                    clearInterval(intervalID);
                    var velocidadeFinal1 = ((massa1 - massa2) * velocidade1 + 2 * massa2 * velocidade2) / (massa1 +
                        massa2);
                    var velocidadeFinal2 = ((massa2 - massa1) * velocidade2 + 2 * massa1 * velocidade1) / (massa1 +
                        massa2);
                    document.getElementById("velocidade1_display").textContent =
                        `${velocidadeFinal1.toFixed(2)} m/s`;
                    document.getElementById("velocidade2_display").textContent =
                        `${velocidadeFinal2.toFixed(2)} m/s`;
                    movimentoPosColisao(velocidadeFinal1, velocidadeFinal2);
                }

                tempo += intervalo / 1000; // Converter milissegundos para segundos
            }, intervalo);
        }

        function movimentoPosColisao(velocidadeFinal1, velocidadeFinal2) {
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            var posicao1 = canvas.width / 2;
            var posicao2 = canvas.width / 2;
            var intervalo = 100; // milissegundos
            var intervalID = setInterval(function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                // Desenhar os objetos após a colisão
                ctx.beginPath();
                ctx.arc(posicao1, canvas.height / 2, 20, 0, 2 * Math.PI);
                ctx.fillStyle = 'blue';
                ctx.fill();

                ctx.beginPath();
                ctx.arc(posicao2, canvas.height / 2, 20, 0, 2 * Math.PI);
                ctx.fillStyle = 'red';
                ctx.fill();

                // Movimento pós-colisão
                posicao1 -= velocidadeFinal1 * (intervalo / 1000); // Atualizar a posição invertendo a direção
                posicao2 += velocidadeFinal2 * (intervalo / 1000); // Atualizar a posição invertendo a direção

                // Verificar se os objetos voltaram a se separar
                if (posicao1 - 20 > posicao2 + 20) { // Ajuste de condição para garantir separação adequada
                    clearInterval(intervalID);
                }

            }, intervalo);
        }


        function reset() {
            var inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(function(input) {
                input.value = ''; // Limpar os valores dos inputs
            });
            var displays = document.querySelectorAll('[id$="_display"]');
            displays.forEach(function(display) {
                display.textContent = '0'; // Reiniciar os displays
            });
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpar o canvas
        }
    </script>
@endsection
