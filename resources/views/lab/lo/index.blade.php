@extends('layouts._includes.lab.App')
@section('titulo', 'Experências(MRUV)')
@section('conteudo')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2"
                            src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Lançamento Oblíquo <span
                                    class="text-info fw-medium"></span></h4>
                        </div><img class="ms-n4 d-md-none d-lg-block" src="../assets/img/illustrations/crm-line-chart.png"
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
                                <h4 class="text-primary fw-normal" id="angulo_display">0 m/s<sup>2</sup></h4>
                                <p class="fs-11 fw-semi-bold text-500 mb-0">Ângulo de Lançamento</p>
                            </div>
                            <div class="col">
                                <h4 class="text-primary fw-normal" id="altura_max_display">0m</h4>
                                <p class="fs-11 fw-semi-bold text-500 mb-0">Altura Máxima</p>
                            </div>
                            <div class="col">
                                <h4 class="text-primary fw-normal" id="alcance_display">0m/s</h4>
                                <p class="fs-11 fw-semi-bold text-500 mb-0">Alcance</p>
                            </div>
                            <div class="col">
                                <h4 class="text-primary fw-normal" id="tempo_display">0s</h4>
                                <p class="fs-11 fw-semi-bold text-500 mb-0">Tempo de Voo</p>
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
                                            Velocidade Inicial:</label><input id="velocidade" min="1" max="100"
                                            class="form-control" type="number" placeholder="Valor" />
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Ângulo de
                                            Lançamento:</label><input class="form-control" value="0" id="angulo"
                                            min="0" max="90" type="number" /></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick="simular()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button"><i class="far fa-play-circle me-1"></i>
                                </button>

                                <button onclick="reset()" class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                        class="fas fa-redo me-1"></i>
                                </button>
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

            // Limpar o canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var velocidadeInicial = document.getElementById('velocidade').value;
            var angulo = document.getElementById('angulo').value;
// alert("ol");
            var g = 9.8; // Aceleração da gravidade em m/s^2

            // Converter o ângulo de graus para radianos
            var anguloRadianos = angulo * (Math.PI / 180);

            // Calcular componentes da velocidade inicial
            var v0x = velocidadeInicial * Math.cos(anguloRadianos);
            var v0y = velocidadeInicial * Math.sin(anguloRadianos);

            // Calcular tempo de voo
            var tempoVoo = (2 * v0y) / g;

            // Calcular altura máxima
            var alturaMaxima = (v0y * v0y) / (2 * g);

            // Calcular alcance
            var alcance = v0x * tempoVoo;

            // Exibir os resultados
        //     var resultados = document.getElementById('resultados');
        //     resultados.innerHTML = `
        //     <h3>Resultados:</h3>
        //     <p>Ângulo de Lançamento: ${angulo} graus</p>
        //     <p>Altura Máxima: ${alturaMaxima.toFixed(2)} metros</p>
        //     <p>Alcance: ${alcance.toFixed(2)} metros</p>
        //     <p>Tempo de Voo: ${tempoVoo.toFixed(2)} segundos</p>
        // `;

        document.getElementById("angulo_display").textContent=`${angulo} graus`;
        document.getElementById("altura_max_display").textContent=`${alturaMaxima.toFixed(2)} m`;
        document.getElementById("alcance_display").textContent=`${alcance.toFixed(2)} m`;
        document.getElementById("tempo_display").textContent=`${tempoVoo.toFixed(2)} s`;



            // Iniciar animação
            animarTrajetoria(canvas, ctx, v0x, v0y, tempoVoo);
        }

        function animarTrajetoria(canvas, ctx, v0x, v0y, tempoVoo) {
            var g = 9.8; // Aceleração da gravidade em m/s^2
            var x, y, t = 0;

            // Intervalo de tempo para a animação
            var intervalo = 100; // milissegundos

            // Função de animação
            var intervalID = setInterval(function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Desenhar a trajetória
                ctx.beginPath();
                ctx.moveTo(0, canvas.height);
                for (t = 0; t <= tempoVoo; t += 0.1) {
                    x = v0x * t;
                    y = (v0y * t) - (0.5 * g * t * t);
                    ctx.lineTo(x, canvas.height - y);
                }
                ctx.strokeStyle = '#007bff';
                ctx.stroke();

                // Desenhar a bolinha
                ctx.beginPath();
                ctx.arc(x, canvas.height - y, 5, 0, 2 * Math.PI);
                ctx.fillStyle = '#ff0000';
                ctx.fill();

                // Desenhar a trajetória pontilhada
                // ctx.beginPath();
                // ctx.moveTo(0, canvas.height);
                // // ctx.setLineDash([5, 5]);
                // for (t = 0; t <= tempoVoo; t += 0.1) {
                //     x = v0x * t;
                //     y = (v0y * t) - (0.5 * g * t * t);
                //     ctx.lineTo(x, canvas.height - y);
                // }
                // ctx.strokeStyle = '#ccc';
                ctx.stroke();

                // Verificar se a bolinha ainda está se movendo
                if (t > tempoVoo) {
                    clearInterval(intervalID);
                }
            }, intervalo);
        }
    </script>
@endsection
