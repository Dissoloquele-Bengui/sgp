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
                            <h4 class="text-primary fw-bold mb-0">Máquinas Simples <span
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
        body {
           
          
        }

        .lever {
            width: 40%;
            height: 20px;
            background-color: #c0c0c0;
            position: relative;
            /* margin-bottom: 50px;
            margin-right: 41px;
            margin-bottom: 20px; */
            margin-top: 133px;

        }

        .load {
            width: 50px;
            height: 50px;
            background-color: #ff0000;
            position: absolute;
            bottom: -15px;
            cursor: pointer;
        }

        .load:hover {
            background-color: #cc0000;
        }
        .box-object{
            height: 300px;
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>

    <div class="row mb-3 g-3">
        <div class="col-md-12 col-xxl-12">
            <div class="card h-100 ">
                <div class="card-header "  data-bs-theme="light">
                    <div class="box-object">
                        <div class="lever" id="lever">
                            <div class="load" id="load"></div>
                        </div>
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
                                            Posição da Força (0-600):</label><input
                                            class="form-control" type="number" id="forcePosition" min="0" max="600" value="300" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Magnitude da Força:</label>
                                        <input class="form-control" type="number" id="forceMagnitude" value="0"></div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const lever = document.getElementById('lever');
        const load = document.getElementById('load');
        const forcePositionInput = document.getElementById('forcePosition');
        const forceMagnitudeInput = document.getElementById('forceMagnitude');

        function updateLoadPosition() {
            const forcePosition = parseFloat(forcePositionInput.value);
            load.style.left = `${forcePosition}px`;
            updateRotation(forcePosition);
        }

        function updateRotation(forcePosition) {
            const leverWidth = lever.offsetWidth;
            const leverCenter = leverWidth / 2;
            const forceMagnitude = parseFloat(forceMagnitudeInput.value) || 0;
            const torque = (forceMagnitude * (forcePosition - leverCenter)) / 1000; // Dividido por 1000 para simplificar a visualização

            lever.style.transform = `rotate(${torque}deg)`;
        }

        forcePositionInput.addEventListener('input', updateLoadPosition);
        forceMagnitudeInput.addEventListener('input', updateRotation);

        updateLoadPosition(); // Atualiza a posição inicial da carga e a rotação
    </script>
@endsection
