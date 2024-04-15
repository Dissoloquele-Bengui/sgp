@extends('layouts._includes.lab.App')
@section('titulo', '2ª Lei de Newton ou Lei de Causa e Efeito')
@section('conteudo')
    <style>
 
.title {
    background-color: rgb(52, 100, 197);
    color: #fff;
    font-size: 1.6rem;

    padding: 5px;
    margin: 10px;
}

main {
    /* background-color: rgb(238, 242, 242);
    width: 1000px; */
    height: 400px;

    position: relative;
}

.base {
    width: 100%;
    height: 20px;
    background-color: rgb(88, 79, 37);
    position: absolute;
    bottom: 1px;

    z-index: 2 !important;
}

.box,
.box1 {
    width: 120px;
    height: 120px;

    display: flex;
    align-items: center;

    background-color: black;
    position: absolute;
    bottom: 21px;

    margin-left: 180px;

    transition: margin-left 1s;
}

#twoBoxes .box1 {
    margin-left: -180px !important;
    bottom: 0px !important;
}

#oneBox .box {
    margin-left: 0px;
}

.personGoBack {
    height: 95px;
    left: 120px !important;
}

img.person {
    display: none;

    width: 100px;
    bottom: -2px;
    left: -100px;

    position: absolute;
}

.forceDiretion {
    left: -270px !important;
}

.horizontalLine {
    width: 200px;
    height: 2px;
    background-color: blue;

    position: absolute;
    margin-left: 60px;
}

.goBackDirection {
    background-color: red;
    margin-left: 100px !important;
    position: absolute;
}

.horizontalLine img.direction,
.tensionArrow {
    height: 20px;
    position: absolute;
    right: -8px;
    top: -8.81px;
}

.box .horizontalLine img.directionLeft {
    right: 276px !important;
}

.box1 .horizontalLine img.directionRight {
    left: 76px !important;
    transform: rotateZ(180deg);
}

.tensionArrow {
    top: -35px !important;
    right: -13px;
}

.mass {
    color: white;
    font-size: 1.5rem;

    display: flex;
    align-self: start;

    margin: 10px;
}

.tension,
.gravity {
    font-size: 1.5rem;
    color: blue;

    position: absolute;
    right: -8px;
    top: -25px;
    z-index: 1;
}

.force {
    top: -32px;
}

.forceArrow {
    top: -40px !important;
    right: -6px;
}

fieldset {
    border: none;
}

footer {
    margin-bottom: 10px;
}

footer+span a {
    background-color: rgb(39, 64, 127);
    color: #fff;

    font-size: 1rem;
    text-decoration: none;

    margin: 4px;
    padding: 5px;

    border-radius: 8px;
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
                            <h4 class="text-primary fw-bold mb-0">2ª Lei de Newton ou Lei de Causa e Efeito(Dinâmica) <span
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
                    <main id="oneBox">
                        <div class="box">
                          <span class="mass">m</span>
                          <img
                            src="./assets/pngwing.com (1).png"
                            alt=""
                            class="person"
                            id="personGostraight"
                          />
                          <img
                            src="./assets/pngwing.com.png"
                            class="personGoBack person"
                            id="personGoBack"
                          />
                          <!-- <div class="horizontalLine forceDiretion">
                            <img src="./assets/arrow.svg" class="tensionArrow forceArrow" />
                            <div class="tension force">
                              F<sub style="font-size: 0.8rem">R</sub>
                            </div>
                  
                            <img src="./assets/arrow.svg" class="direction" />
                          </div> -->
                        </div>
                        <div class="base"></div>
                      </main>
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
                                    <div class="mb-3"><label class="form-label" for="exampleFormControlInput1">
                                            Força de Tensão (N):</label><input id="tensionValue" min="1"
                                            max="100" class="form-control" type="number" placeholder="Valor" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Massa(kg)</label>
                                        <input class="form-control" value="1" id="massValue" value="0"
                                            type="number" />
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" value="Iniciar" onclick="startSimulation()" id="btnStart"
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="far fa-play-circle me-1"></i>Iniciar</button>
                                <button type="button" value="Pausar" onclick="pauseSimulation()" id="btnPause"
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="fas  fa-stop-circle  me-1"></i>Pausar</button>
                                        <button onclick="restartSimulation()" class="btn btn-falcon-default btn-sm me-2" type="button"><i
                                            class="fas fa-redo me-1"></i>Limpar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const box = document.querySelector(".box");
        const personGostraight = document.querySelector("#personGostraight");
        const personGoBack = document.querySelector("#personGoBack");
  
        let interval = null; // Variável para armazenar o intervalo
  
        function startSimulation() {
          let position = parseInt(window.getComputedStyle(box).marginLeft);
          document.querySelector("#btnPause");
  
          interval = setInterval(() => {
            let mass = parseInt(document.querySelector("#massValue").value);
            let tensionForce =
              parseInt(document.querySelector("#tensionValue").value) / mass;
            document.querySelector("#acelerationValue").innerHTML =
              mass !== 0
                ? `Aceleração: ${
                    typeof tensionForce === "decimal"
                      ? tensionForce.toFixed(1)
                      : tensionForce
                  } m/s²`
                : "Aceleração: 0 m/s²";
  
            position += tensionForce;
            const mainWidth = document.querySelector("main").offsetWidth;
            const boxWidth = box.offsetWidth;
            if (position + boxWidth >= mainWidth || mass <= 0 || position <= 0) {
              clearInterval(interval);
            } else {
  
              if (tensionForce < 0) {
                personGostraight.style.display = "none";
                personGoBack.style.display = "block";
              } else {
                personGoBack.style.display = "none";
                personGostraight.style.display = "block";
              }
  
              box.style.marginLeft = `${position}px`;
            }
          }, 100);
        }
  
        function pauseSimulation() {
          clearInterval(interval); // Pausa o setInterval
        }
  
        function restartSimulation() {
          clearInterval(interval);
          box.style.marginLeft = "0px";
        }
      </script>
@endsection
