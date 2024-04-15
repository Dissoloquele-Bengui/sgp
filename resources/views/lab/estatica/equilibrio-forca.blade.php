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
                            <h4 class="text-primary fw-bold mb-0">Equilibrio de uma Força <span
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
     .container {
            width: 80%;
            height: 400px;
            /* background-color: #fff; */
            border: 2px solid #000;
            position: relative;
        }

        .object {
            width: 100px;
            height: 100px;
            background-color: blue;
            position: absolute;
        }

    </style>

    <div class="row mb-3 g-3">
        <div class="col-md-12 col-xxl-12">
            <div class="card h-100 ">
                <div class="card-header "  data-bs-theme="light">
                    <div id="container" class="container">
                        <div id="object" class="object"></div>
                    </div>
                  
                
                </div>
                
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
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">
                                            Força X:</label><input
                                            class="form-control" type="number" id="forceX" value="0" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">
                                            Força Y:</label><input
                                            class="form-control" type="number" id="forceY" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="startBtn"class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                    class="far fa-play-circle me-1"></i></button>
                                <button id="pauseBtn"class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                    class="far  fa-stop-circle me-1"></i></button>
                                <button id="resetBtn"class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                    class="fas fa-redo me-1"></i></button>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const object = document.getElementById('object');
        const forceXInput = document.getElementById('forceX');
        const forceYInput = document.getElementById('forceY');
        const startBtn = document.getElementById('startBtn');
        const pauseBtn = document.getElementById('pauseBtn');
        const resetBtn = document.getElementById('resetBtn');

        let animationInterval;
        let posX = 0;
        let posY = 0;
        let velocityX = 0;
        let velocityY = 0;
        let running = false;

        // Função para mover o objeto
        function moveObject() {
            const forceX = parseFloat(forceXInput.value) || 0;
            const forceY = parseFloat(forceYInput.value) || 0;

            velocityX += forceX;
            velocityY += forceY;

            posX += velocityX;
            posY += velocityY;

            if (posX >= container.offsetWidth - object.offsetWidth) {
                posX = container.offsetWidth - object.offsetWidth;
                velocityX = 0;
            } else if (posX <= 0) {
                posX = 0;
                velocityX = 0;
            }

            if (posY >= container.offsetHeight - object.offsetHeight) {
                posY = container.offsetHeight - object.offsetHeight;
                velocityY = 0;
            } else if (posY <= 0) {
                posY = 0;
                velocityY = 0;
            }

            object.style.left = `${posX}px`;
            object.style.top = `${posY}px`;
        }

        // Event listener para o botão Iniciar
        startBtn.addEventListener('click', () => {
            if (!running) {
                animationInterval = setInterval(moveObject, 500); // Intervalo de atualização de 100 milissegundos (0.1 segundo)
                running = true;
            }
        });

        // Event listener para o botão Pausar
        pauseBtn.addEventListener('click', () => {
            if (running) {
                clearInterval(animationInterval);
                running = false;
            }
        });

        // Event listener para o botão Reiniciar
        resetBtn.addEventListener('click', () => {
            clearInterval(animationInterval);
            posX = 0;
            posY = 0;
            object.style.left = '0px';
            object.style.top = '0px';
            velocityX = 0;
            velocityY = 0;
            running = false;
        });
    </script>
@endsection
