@extends('layouts._includes.lab.App')
@section('titulo', 'Energia Potencial Elástica')
@section('conteudo')
   <style>
   
.center {
    display: flex;
    justify-content: center;
    align-items: center;
}

main {
    /* width: 800px; */
    height: 500px;
    /* background-color: #fff; */
    flex-direction: column;
}

.line {
    height: 150px;
    width: 1px;
    background-color: black;

    position: relative;
}

.box {
    width: 100px;
    height: 100px;
    background-color: rgb(83, 201, 142);

    position: absolute;
    left: 76px;

}

.box img.arrow {
    width: 35px;
}


.horizontal-base {
    width: 700px;
    height: 30px;

    text-align: center;
    background-color: rgb(168, 134, 75);
    border-top: 4px dotted black;

    position: relative;
}

/* .horizontal-base::after {
    content: 'X';

    color: black;
    font: bolder 1rem cursive;

    position: inherit;
} */

.vertical-base {
    width: 20px;
    height: 200px;
    background-color: rgb(168, 134, 75);

    position: absolute;
    bottom: 0;
}


.main-circle {
    bottom: 40px;
    left: 18px;

    transform: rotateY(-60deg);
}

.main-circle::after {
    content: '';
    width: 35px;
    height: 50px;

    border-radius: 0 8px 8px 0;
    background-color: rgb(49, 49, 49);

    position: absolute;
    left: -25px;
}

.circle {
    width: 80px;
    height: 80px;
    background-color: transparent;

    border-radius: 100%;
    border: 4px solid white;

    transform: rotateY(30deg);

    position: absolute;
}

.circle-shild {
    left: 40px;

    animation: spring-animate 2s infinite;
}

.stick {
    width: 5px;
    height: 60px;

    background-color: rgb(179, 27, 60);
}

.horizontal-base>.stick {
    width: 2px;
    height: 60px;

    position: absolute;
    bottom: 0;
    left: 248px;

}

.circle-shild:last-child .stick {
    position: absolute;
    bottom: -44px;
    right: 0;
    background-color: rgb(179, 27, 60);
}

.deformationStick {
    height: 1px;
    width: 0;

    background-color: rgb(27, 27, 79);
    color: transparent;

    position: absolute;
    bottom: 18px;
}

.showLetter {
    color: black;
}

.comprimir {
    left: 5px !important;
}

/* 
@keyframes spring-animate {
    from {
    left: 50px;
    }
    to {
    left: 5px;
    }
} */

.inputDatas fieldset {
    border: none;
    margin-bottom: 8px;
}

.controllers {
    margin-bottom: 10px;
}

.controllers input {
    padding: 2px;
    cursor: pointer;
}

/* 
#spring {
    display: flex;
    flex-basis:  1 100%;
    height: 100%;
    background-color: blueviolet !important;
} */
   </style>
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center">
                        <img class="ms-n2" src="../assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
                        <div>
                            <h6 class="text-primary fs-10 mb-0">Simulações </h6>
                            <h4 class="text-primary fw-bold mb-0">Energia Potencial Elástica(Trabalho e Energia)
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
                    <main class="center">
                        <div class="horizontal-base">
                          <div class="stick fixedStick">
                            <div class="deformationStick">x</div>
                          </div>
                          <div class="vertical-base"></div>
                          <div class="circle main-circle center">
                            <div class="circle circle-shild center">
                              <div class="circle circle-shild center">
                                <div class="circle circle-shild center">
                                  <div class="circle circle-shild center">
                                    <div class="circle circle-shild center">
                                      <div class="circle circle-shild center">
                                        <div class="circle circle-shild center">
                                          <img
                                            src="/assets/arrow.svg"
                                            class="arrow"
                                          />
                  
                                          <div class="stick springStick"></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  
                        <div class="filedDatas">
                          <br />
                          <span class="deformationValue"> Posição da deformação X = 0 m</span
                          ><br />
                          <span class="springEnergyValue">
                            Energia Potencial Elástica E(elas) = 0 J</span
                          >
                        </div>
                    </main>
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
                                    <div class="mb-3"><label class="form-label" for="customRange1">A Força aplicada (N):</label>
                                        <input class="form-control"  value="0" id="force" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1">Constante da Mola (N/m)</label>
                                        <input class="form-control" value="0" id="springConst" type="number" />
                                    </div>
                                </div>
                            


                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button"  type="button"
                                value="aplicar"
                                onclick="applyForce()"
                                id="btnApplyForce"
                              
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="far fa-play-circle me-1"></i>Iniciar</button>

                                <button type="button"   onclick="leftSpring()"
                                id="btnLeftSpring"
                                    class="btn btn-falcon-default btn-sm me-2"><i
                                        class="fas  fa-stop-circle  me-1"></i>Soltar</button>
                                <button     onclick="restartSimulation()"
                                id="btnRestart"  class="btn btn-falcon-default btn-sm me-2">
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
        const spring = document.querySelectorAll(".circle-shild");
        const deformationStick = document.querySelector(".deformationStick");
        let deformationValue = document.querySelector(".deformationValue");
        let springEnergyValue = document.querySelector(".springEnergyValue");
        let energy;
        const springWidth = 40;
  
        function applyForce() {
          const force = parseInt(document.querySelector("#force").value);
          const springConst = parseInt(
            document.querySelector("#springConst").value
          );
  
          const fixedStick = document.querySelector(".fixedStick");
          const springStick = document.querySelector(".springStick");
          const fixedStickMargin = parseInt(
            window.getComputedStyle(fixedStick).left
          );
          const springStickMargin = parseInt(
            window.getComputedStyle(springStick).position
          );
  
          if (force > 0 && springConst >= 0) {
            const deformation =
              springConst === 0 ? 0 : springWidth - force / springConst;
  
            for (let i = 0; i < spring.length; i++) {
              spring[i].style.left = `${deformation >= 0 ? deformation: 0}px`;
            }
  
            document.querySelector(".arrow").style.transform = "rotateZ(180deg)";
  
            const stick1 = springStick.getBoundingClientRect().left;
            const stick2 = fixedStick.getBoundingClientRect().left;
  
            const distance = stick2 - stick1;
            deformationStick.style.width = `${distance}px`;
            deformationStick.style.right = `1px`;
            let valueOfDeformation = (distance - (distance * 70) / 100).toFixed(
              0
            );
  
            deformationValue.innerHTML = `Posição da deformação X = ${valueOfDeformation}cm`;
            energy = `Energia Potencial Elástica E(elas) = ${(
              (valueOfDeformation * valueOfDeformation * springConst) /
              2
            ).toFixed(1)} J`;
  
            if (distance >= 15) {
              deformationStick.style.color = "black";
            } else {
              deformationStick.style.color = "transparent";
            }
          }
        }
  
        function leftSpring() {
          for (let i = 0; i < spring.length; i++) {
            spring[i].style.left = `${springWidth}px`;
          }
  
          deformationStick.style.color = "transparent";
          deformationStick.style.width = "0";
          document.querySelector(".arrow").style.transform = "rotateZ(0)";
          springEnergyValue.innerHTML = energy;
        }
  
        function restartSimulation() {
          for (let i = 0; i < spring.length; i++) {
            spring[i].style.left = `${springWidth}px`;
          }
  
          document.querySelector(".arrow").style.transform = "rotateZ(0)";
          deformationStick.style.width = "0";
          
          deformationValue.innerHTML = "Posição da deformação X = 0 m";
          springEnergyValue.innerHTML =
            " Energia Potencial Elástica E(elas) = 0 J";
        }
      </script>
@endsection
