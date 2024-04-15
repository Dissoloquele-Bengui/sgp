@extends('layouts._includes.lab.App')
@section('titulo', 'Queda de um Corpo - Energia Potencial')
@section('conteudo')
    <style>
        canvas {
            background-color: gray;
            display: block;
            margin: 20px auto;
            border: 5px solid black;
        }

        .controls {
            text-align: center;
            margin-top: 20px;
        }

        .controls label {
            font-weight: bold;
        }

        .controls input {
            width: 60px;
            margin-right: 10px;
        }

        .controls button {
            padding: 5px 10px;
            background-color: gray;
            color: white;
            border: none;
            cursor: pointer;
            margin: 0 5px;
        }

        #energy {
            margin-top: 10px;
            font-weight: bolder;
        }
    </style>
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center">
                        <img class="ms-n2" src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Queda de um Corpo - Energia Potencial(Trabalho e Energia)
                                <span class="text-info fw-medium"></span></h4>
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
                    <canvas id="fallingObjectCanvas"  class="w-100" height="100"></canvas>
                </div>
                <div class="card-footer text-end bg-transparent" data-bs-theme="light">
                    <div id="acelerationValue"></div>
                    <div id="potentialEnergy" class="controls" style="margin-top: 10px;"></div>
                    <a class="text-white" href="#!">Real-time data<span
                            class="fa fa-chevron-right ms-1 fs-10"></span></a>

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
                                    <div class="mb-3"><label class="form-label" for="customRange1">Altura Inicial
                                            (m):</label>
                                        <input class="form-control" id="initialHeight" value="50" type="number" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1">Aceleração da Gravidade
                                            (m/s²):</label>
                                        <input class="form-control" id="gravity" value="9.8" type="number" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1">Massa do Objeto
                                            (kg):</label>
                                        <input class="form-control" id="mass" value="1" type="number" />
                                    </div>
                                </div>


                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" value="Iniciar" onclick="startAnimation()" id="btnStart"
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="far fa-play-circle me-1"></i>Iniciar</button>

                                <button type="button" value="Pausar" onclick="stopAnimation()" id="btnPause"
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="fas  fa-stop-circle  me-1"></i>Pausar</button>
                                <button onclick="resetAnimation()" class="btn btn-falcon-default btn-sm me-2">
                                    <i class="fas fa-redo me-1"></i>
                                    Reiniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      const canvas = document.getElementById('fallingObjectCanvas');
      const ctx = canvas.getContext('2d');
  
      const objectWidth = 30;
      const objectHeight = 30;
      let objectX = (canvas.width - objectWidth) / 1;
      let objectY = 0; // Começa a partir do topo do canvas
      let gravity = parseFloat(document.getElementById('gravity').value); // Aceleração da gravidade em m/s²
      let mass = parseFloat(document.getElementById('mass').value); // Massa do objeto (em kg)
      let velocity = 0; // Velocidade inicial do objeto
      let time = 0; // Tempo decorrido
      let intervalId;
  
      function drawObject() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = 'blue';
        ctx.fillRect(objectX, objectY, objectWidth, objectHeight);
      }
  
      function updateObjectPosition() {
        // Calcula a altura do objeto usando a equação da cinemática
        objectY = 0.5 * gravity * time * time;
  
        // Atualiza o tempo
        time += 0.1; // Incrementa o tempo em intervalos de 0.1 segundo
  
        // Verifica se o objeto ultrapassou a borda inferior do canvas
        if (objectY >= canvas.height - objectHeight) {
          objectY = canvas.height - objectHeight; // Define a posição do objeto para a borda inferior
          clearInterval(intervalId); // Para a simulação
        }
  
        // Redesenha o objeto
        drawObject();
  
        // Mostra a energia potencial gravitacional
        const potentialEnergy = mass * gravity * objectY;
        document.getElementById('potentialEnergy').innerText = `Energia Potencial Gravitacional: ${potentialEnergy.toFixed(2)} J`;
      }
  
      function startSimulation() {
        clearInterval(intervalId); // Limpa qualquer animação anterior
        intervalId = setInterval(updateObjectPosition, 100); // Inicia a simulação
      }
  
      function stopSimulation() {
        clearInterval(intervalId); // Para a simulação
      }
  
      function restartSimulation() {
        stopSimulation(); // Para a simulação
        startSimulation() //reiniciar
        time = 0; // Reseta o tempo
        objectY = parseFloat(document.getElementById('initialHeight').value); // Reseta a altura inicial do objeto
        drawObject(); // Redesenha o objeto
        document.getElementById('potentialEnergy').innerText = 'Energia Potencial Gravitacional: 0 J'; // Reseta a energia potencial
      }
  
      // Atualiza a simulação quando os valores são alterados
      document.getElementById('initialHeight').addEventListener('input', restartSimulation);
      document.getElementById('gravity').addEventListener('input', restartSimulation);
      document.getElementById('mass').addEventListener('input', restartSimulation);
    </script>
@endsection
