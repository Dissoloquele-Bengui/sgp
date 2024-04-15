@extends('layouts._includes.lab.App')
@section('titulo', 'Experiências(MRUV)')
@section('conteudo')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2"
                            src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Movimento Retilíneo Uniformemente Variado (MRUV): <span
                                    class="text-info fw-medium"></span></h4>
                        </div><img class="ms-n4 d-md-none d-lg-block" src="../assets/img/illustrations/crm-line-chart.png"
                            alt="" width="150" />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        #object {
            width: 50px;
            height: 50px;

            position: relative;
            top: 0;
            left: 0;
            transition: left 1s linear;
            border-radius: 50%;
            /* Adiciona uma transição suave para o movimento */
        }
    </style>



    <div class="row mb-3 g-3">
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
                                            Velocidade(m/s):</label><input id="velocity" class="form-control"
                                            type="number" placeholder="Valor" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1">
                                            Aceleração(m/s<sup>2</sup> ):
                                            range</label><input class="form-control" value="0" id="acceleration"
                                            type="number" /></div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="initialPosition">Posição Inicial
                                            (m):</label><input id="initialPosition" class="form-control" type="number"
                                            placeholder="Valor" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick="startSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button"><i class="far fa-play-circle me-1"></i>Iniciar Simulação</button>
                                <button onclick="stopSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button"><i class="far fa-stop-circle me-1"></i>Parar Simulação</button>
                                <button onclick="reset()" class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                        class="fas fa-redo me-1"></i>Limpar</button>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-md-12 col-xxl-12">
            <div class="card h-100 ">
                <div class="card-header " data-bs-theme="light">
                    <h5 class="text-white">
                        {{-- Users online right now --}}
                    </h5>
                    <div class="real-time-user display-1 fw-normal text-white">
                        <div class="box-objecto" id="boxObject">
                            <div id="object" class=" bg-primary"></div>
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
                            <h6 class="mb-0">Resultados<span class="ms-1 text-400" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Average call duration based of last 50 calls"><span
                                        class="far fa-question-circle" data-fa-transform="shrink-1"></span></span></h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="current_aceleracao">0 m/s<sup>2</sup></h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Aceleração</p>
                                </div>
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="position">0m</h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Posição</p>
                                </div>
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="current_speed">0m/s</h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Velocidade</p>
                                </div>
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="time">0s</h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Tempo</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
    <script>
        let velocityInput = document.getElementById('velocity');
        let timeDisplay = document.getElementById('time');
        let positionDisplay = document.getElementById('position');
        let object = document.getElementById('object');

        let current_speed_display = document.getElementById('current_speed');
        let timer;
        let boxObject = document.getElementById("boxObject");

        function startSimulation() {

            // Limpar qualquer simulação anterior
            clearInterval(timer);
            object.style.left = '0'; // Resetar a posição do objeto

            // Obter a posição inicial do input
            let initialPosition = parseFloat(document.getElementById('initialPosition').value);

            // Setar a posição inicial do objeto
            object.style.left = initialPosition + 'px';

            // Obter a velocidade inicial do input
            let velocity = parseFloat(velocityInput.value);

            // Iniciar a simulação
            timer = setInterval(function() {
                let accelerationInput = document.getElementById('acceleration');
                let acceleration = parseFloat(accelerationInput.value);
                console.log(acceleration);
                // Incrementar o tempo em 1 segundo

                let time = parseFloat(timeDisplay.textContent) + 1;
                timeDisplay.textContent = time + " s";
                let final_instantaneous_speed = velocity + acceleration * time;
                // Calcular a posição usando a fórmula: posição = velocidade * tempo
                let position = final_instantaneous_speed * time;
                current_speed_display.textContent = final_instantaneous_speed + " m/s";;
                positionDisplay.textContent = position.toFixed(2) + " m";

                // Atualizar a posição visual do objeto
                object.style.left = position + 'px';
                let posicaoAtual = parseInt(object.style.left) || 0;
                const limiteDireita = boxObject.offsetWidth - object.offsetWidth;

                let boxWidth = boxObject.offsetWidth;
                let objectWidth = object.offsetWidth;
                let rightLimit = boxWidth - objectWidth;

                // Verificar se o objeto atingiu o limite direito da caixa
                if (position >= rightLimit) {
                    object.style.left = rightLimit + 'px';
                    stopSimulation(); // Parar a simulação
                } else {
                    // Atualizar a posição visual do objeto
                    object.style.left = position + 'px';
                }
            }, 2000); // Atualizar a cada segundo

            ;
        }

        function stopSimulation() {
            clearInterval(timer);
        }

        function reset() {
            document.getElementById('velocity').value = "";
            document.getElementById('time').textContent = '0 s';
            document.getElementById('position').textContent = '0 m';;
            document.getElementById('object').style.left = '0px';
            document.getElementById('acceleration').value = "";;
            document.getElementById('current_speed').textContent = '0 m/s';
            stopSimulation();
        }

        document.getElementById('acceleration').addEventListener('change', function() {
            let current_aceleracao_display = document.getElementById('current_aceleracao').textContent = document
                .getElementById('acceleration').value;
        });
    </script>

@endsection
