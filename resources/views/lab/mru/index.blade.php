@extends('layouts._includes.lab.App')
@section('titulo', 'Experiência de MRU')
@section('conteudo')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center">
                        <img class="ms-n2" src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Movimento Retilíneo Uniforme (MRU)</h4>
                        </div>
                        <img class="ms-n4 d-md-none d-lg-block" src="../assets/img/illustrations/crm-line-chart.png"
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
                            <h6 class="mb-0">Controles</h6>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row ">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="velocity">Velocidade:</label>
                                        <div class="input-group">
                                            <input id="velocity" class="form-control" type="number" placeholder="Valor" />
                                            <select class="form-select" id="velocityUnit">
                                                <option value="m/s">m/s</option>
                                                <option value="km/h">km/h</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick="startSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button">
                                    <i class="far fa-play-circle me-1"></i>Iniciar
                                </button>
                                <button onclick="stopSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button">
                                    <i class="far fa-stop-circle me-1"></i>Parar
                                </button>
                                <button onclick="resetSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button">
                                    <i class="fas fa-redo me-1"></i>Reiniciar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xxl-12">
            <div class="card h-100 ">
                <div class="card-header " data-bs-theme="light">
                    <h5 class="text-white">Posição Atual</h5>
                    <div class="real-time-user display-1 fw-normal text-white">
                        <div class="box-objecto" id="boxObject">
                            <div id="object" class=" bg-primary"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-transparent" data-bs-theme="light">
                    <a class="text-white" href="#!">Dados em Tempo Real <span
                            class="fa fa-chevron-right ms-1 fs-10"></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Resultados</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="position">0 m</h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Posição</p>
                                </div>
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="current_speed">0 m/s</h4>
                                    <p class="fs-11 fw-semi-bold text-500 mb-0">Velocidade</p>
                                </div>
                                <div class="col">
                                    <h4 class="text-primary fw-normal" id="time">0 s</h4>
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
        let velocityUnitSelect = document.getElementById('velocityUnit');
        let timeDisplay = document.getElementById('time');
        let positionDisplay = document.getElementById('position');
        let object = document.getElementById('object');
        let timer;
        let boxObject = document.getElementById("boxObject");

        function startSimulation() {
            clearInterval(timer);
            object.style.left = '0'; // Resetar a posição do objeto

            let velocity = parseFloat(velocityInput.value); // Obter a velocidade inicial do input em m/s
            let velocityUnit = velocityUnitSelect.value;
            document.getElementById("current_speed").textContent = velocity + " m/s";
            if (velocityUnit === 'km/h') {
                // Converter para m/s se a unidade for km/h
                velocity = velocity / 3.6;
            }

            timer = setInterval(function() {
                let time = parseFloat(timeDisplay.textContent) + 1; // Incrementar o tempo em 1 segundo
                timeDisplay.textContent = time.toFixed(2) + " s"; // Atualizar o tempo com duas casas decimais

                let position = velocity * time; // Calcular a posição em metros
                positionDisplay.textContent = position.toFixed(2) +
                    " m"; // Atualizar a posição com duas casas decimais

                // Limites da caixa
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
        }


        function stopSimulation() {
            clearInterval(timer);
        }

        function resetSimulation() {
            velocityInput.value = "";
            timeDisplay.textContent = '0 s';
            positionDisplay.textContent = '0 m';
            object.style.left = '0px';
            stopSimulation();
        }
    </script>
@endsection
