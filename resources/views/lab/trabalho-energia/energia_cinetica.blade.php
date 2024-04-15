@extends('layouts._includes.lab.App')
@section('titulo', 'Energia Cinética da Bola de Tênis')
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
                            <h4 class="text-primary fw-bold mb-0">Energia Cinética da Bola de Tênis(Trabalho e Energia) <span
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
                <canvas id="court" class="w-100" height="100"></canvas>
                </div>
                <div class="card-footer text-end bg-transparent" data-bs-theme="light">
                    <div id="acelerationValue"></div>
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
                                    <div class="mb-3"><label class="form-label" for="customRange1">Massa(kg)</label>
                                        <input class="form-control" id="mass" value="0.057"
                                            type="number" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Velocidade (m/s):</label>
                                        <input class="form-control"  id="speed" value="10"
                                            type="number" />
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
                                        <button onclick="resetAnimation()"  class="btn btn-falcon-default btn-sm me-2">
                                            <i
                                        class="fas fa-redo me-1"></i>
                                            Reiniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const canvas = document.getElementById('court');
        const ctx = canvas.getContext('2d');
        const ballRadius = 10;
        let xPos = ballRadius;
        let yPos = canvas.height / 2;
        let dx = 0; // Velocidade inicial é zero
        let dy = 0;
        let timer;
    
        function drawBall() {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          ctx.beginPath();
          ctx.arc(xPos, yPos, ballRadius, 0, Math.PI * 2);
          ctx.fillStyle = '#FFF';
          ctx.fill();
          ctx.closePath();
        }
    
        function startAnimation() {
          const massInput = document.getElementById('mass');
          const speedInput = document.getElementById('speed');
          const mass = parseFloat(massInput.value);
          const speed = parseFloat(speedInput.value);
          dx = speed;
          animate(mass);
        }
    
        function animate(mass) {
          timer = requestAnimationFrame(() => animate(mass));
          drawBall();
          xPos += dx;
          if (xPos + dx > canvas.width - ballRadius || xPos + dx < ballRadius) {
            cancelAnimationFrame(timer);
            const energy = calculateEnergy(mass, dx);
            document.getElementById('energy').innerText = `Energia Cinética: ${energy.toFixed(2)} J`;
          }
        }
    
        function calculateEnergy(mass, speed) {
          const kineticEnergy = (mass * Math.pow(speed, 2)) / 2;
          return kineticEnergy;
        }
    
        function stopAnimation() {
          cancelAnimationFrame(timer);
        }
    
        function resetAnimation() {
          xPos = ballRadius;
          yPos = canvas.height / 2;
          dx = 0;
          dy = 0;
          document.getElementById('energy').innerText = '';
          drawBall();
        }
    
      </script>
@endsection
