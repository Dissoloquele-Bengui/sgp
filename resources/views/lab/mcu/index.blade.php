@extends('layouts._includes.lab.App')
@section('titulo', 'Experências(MCU)')
@section('conteudo')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center">
                        <img class="ms-n2" src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Movimento Circular Uniforme (MCU) <span
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
                            <h4 class="text-primary fw-normal" id="velocidade_angular_display">0 rad/s</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Velocidade Angular (ω)</p>
                        </div>
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="periodo_display">0 s</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Período (T)</p>
                        </div>
                        <div class="col">
                            <h4 class="text-primary fw-normal" id="frequencia_display">0 Hz</h4>
                            <p class="fs-11 fw-semi-bold text-500 mb-0">Frequência (f)</p>
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
                            <h6 class="mb-0">Controlls<span class="ms-1 text-400" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Average call duration based of last 50 calls"><span
                                        class="far fa-question-circle" data-fa-transform="shrink-1"></span></span></h6>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row ">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">
                                            Velocidade (m/s):</label><input id="velocidade" min="1" max="100"
                                            class="form-control" type="number" placeholder="Valor" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Raio da trajetória (m):</label><input class="form-control" value="1" id="raio"
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
       var intervalID; // Armazenar o ID do intervalo para permitir limpar posteriormente

        function simular() {
            clearInterval(intervalID); // Limpar o intervalo anterior, se houver
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var velocidade = parseFloat(document.getElementById('velocidade').value);
            var raio = parseFloat(document.getElementById('raio').value);
            
            var velocidadeAngular = velocidade / raio;
            var periodo = (2 * Math.PI * raio) / velocidade;
            var frequencia = 1 / periodo;

            var intervalo = 100; // Intervalo de tempo para a animação (ms)
            var tempo = 0; // Tempo inicial

            intervalID = setInterval(function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Calcular a posição atual do objeto no MCU
                var x = raio * Math.cos(velocidadeAngular * tempo);
                var y = raio * Math.sin(velocidadeAngular * tempo);

                // Desenhar o objeto
                ctx.beginPath();
                ctx.arc(canvas.width / 2 + x, canvas.height / 2 + y, 5, 0, 2 * Math.PI);
                ctx.fillStyle = '#ff0000';
                ctx.fill();

                // Desenhar o raio da trajetória
                ctx.beginPath();
                ctx.moveTo(canvas.width / 2, canvas.height / 2);
                ctx.lineTo(canvas.width / 2 + x, canvas.height / 2 + y);
                ctx.strokeStyle = '#000000';
                ctx.stroke();

                // Atualizar os dados exibidos
                document.getElementById("velocidade_angular_display").textContent = `${velocidadeAngular.toFixed(2)} rad/s`;
                document.getElementById("periodo_display").textContent = `${periodo.toFixed(2)} s`;
                document.getElementById("frequencia_display").textContent = `${frequencia.toFixed(2)} Hz`;

                // Atualizar o tempo
                tempo += intervalo / 1000; // Converter milissegundos para segundos
            }, intervalo);
        }

        function reset() {
            clearInterval(intervalID); // Limpar o intervalo
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    </script>
@endsection
