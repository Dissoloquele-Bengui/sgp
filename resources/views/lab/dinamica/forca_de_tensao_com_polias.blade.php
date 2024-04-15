@extends('layouts._includes.lab.App')
@section('titulo', 'Força de Tensão Com Polias')
@section('conteudo')
    <style>
        main#tracaoPolias {
            min-height: 520px;
            max-height: 520px;
        }

        #tracaoPolias .base {
            bottom: 350px;
            width: 350px !important;
        }

        #tracaoPolias .box,
        #tracaoPolias .box1 {
            width: 100px;
            height: 100px;

            transition: margin-left 0s;

        }

        #tracaoPolias .box {
            bottom: 370px;
            margin-left: 0;
        }

        #tracaoPolias .box1 {
            justify-content: center;
            /* bottom: 0; */
            margin-bottom: 200px;
            margin-left: 400px;
        }

        .box1-initial-place {
            margin-bottom: 200px;
        }

        #tracaoPolias .box .boxLine {
            width: 350px;
        }

        #tracaoPolias .box1 #verticalLine,
        #tracaoPolias .box #horizontalLine {
            visibility: hidden;
        }

        #tracaoPolias .base {
            width: 400px;
        }

        #tracaoPolias .poliaBase {
            width: 80px;
            height: 15px;
            background-color: black;

            position: absolute;
            right: -70px;
            top: -7px;
            z-index: 0;

            transform: rotateZ(-15deg);
        }

        #tracaoPolias .polia {
            width: 80px;
            height: 80px;
            background-color: black;

            border-radius: 100%;

            position: relative;
            right: -369px;
            top: 101px;

            z-index: 30;
        }

        #tracaoPolias .box .boxDiretionRight {
            transform: rotateZ(180deg);
        }

        #tracaoPolias .box .tensionArrow,
        #tracaoPolias .box .tension {
            left: 125px;
        }

        #tracaoPolias .line {
            width: 400px;
            height: 140px;

            border-style: dotted;
            border-color: blue blue transparent transparent;
            border-top-right-radius: 40px;

            position: absolute;
            right: 549px;
            top: 100px;

            z-index: 20;
        }

        #tracaoPolias .limit {
            width: 30px;
            height: 30px;
            background-color: rgb(99, 99, 99);
            border-top-right-radius: 20px;
            border-bottom-right-radius: 4px;

            margin-left: 325px;
            margin-top: -10px;

            position: relative;

            z-index: 2;
        }

        .letter-T {
            position: absolute;
            top: 40px;
        }

        .letter-g {
            position: absolute;
            top: 140px;
            left: 490px;
        }

        .gravity>span {
            font-size: .9rem;
            top: -4px;
            margin: 2px;

            position: relative;
        }

        .sub-indice {
            font-size: .9rem;

            position: relative;
            top: -22px;
            left: 12px;
        }

        .boxDiretionRight {
            position: absolute;
            left: -123px;
        }

        .gravityArrow {
            width: 15px;
            left: -17px;
            top: -28px;

            position: absolute;
        }

        .down {
            transform: rotateZ(90deg) !important;
            left: 8px;
            top: -15px;
        }

        .box1 .letter-T {
            top: -10px;
            left: 70px;
        }

        .box1 .directionTop {
            transform: rotateZ(90deg);

            position: absolute;
            right: -206px;
            top: -30px;
        }

        .box1 .verticalLineBottom {
            width: 3px;
            height: 100px;
            background-color: blue;

            position: absolute;
            top: 50px;
        }

        .box1 .directionBottom {
            transform: rotateZ(270deg);

            position: absolute;
            bottom: -61px;
        }

        .box1 .letter-P {
            position: absolute;
            top: 150px;
            right: 18px;
        }

        .box1 .weightArrow {
            left: -14px;
        }

        .box1 .letter-P .sub-indice {
            position: relative;
            top: 5px;
            left: 0;
        }


        .title {
            background-color: rgb(52, 100, 197);
            color: #fff;
            font-size: 1.6rem;

            padding: 5px;
            margin: 10px;
        }

        main {
            /* background-color: rgb(238, 242, 242); */
            /* width: 1000px; */
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
                            <h4 class="text-primary fw-bold mb-0">Força de Tensão Com Polias(Dinâmica) <span
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
                    <main id="tracaoPolias">
                        <div class="box1" id="box1">
                          <span class="mass">m2</span>
                  
                          <div class="letter-T">
                            <img src="./assets/arrow.svg" class="tensionArrow" />
                            <div class="tension">T <span class="sub-indice">a,b</span></div>
                          </div>
                  
                          <img src="./assets/left_arrow_icon.svg" class="directionTop" />
                  
                          <div class="verticalLineBottom"></div>
                          <img src="./assets/left_arrow_icon.svg" class="directionBottom" />
                  
                          <div class="letter-P">
                            <img src="./assets/arrow.svg" class="tensionArrow weightArrow" />
                            <div class="tension">P<span class="sub-indice">b</span></div>
                          </div>
                  
                        </div>
                  
                        <div class="line" id="line"></div>
                  
                        <div id="box" class="box">
                          <span class="mass">m1</span>
                  
                          <div class="letter-T">
                            <img src="./assets/arrow.svg" class="tensionArrow" />
                            <div class="tension">T <span class="sub-indice">b,a</span></div>
                          </div>
                  
                          <img
                            src="./assets/left_arrow_icon.svg"
                            class="boxDiretionRight direction"
                          />
                        </div>
                  
                        <div class="letter-g">
                          <img src="./assets/arrow.svg" class="gravityArrow" />
                          <img src="./assets/arrow.svg" class="gravityArrow down" />
                          <div class="gravity">g<span>+</span></div>
                        </div>
                  
                        <div class="base">
                          <div class="limit"></div>
                          <div class="poliaBase"></div>
                        </div>
                  
                        <div class="polia"></div>
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
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Massa 1(kg)</label>
                                        <input class="form-control" value="1" id="massValue" value="0"
                                            type="number" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="customRange1"> Massa 2(kg)</label>
                                        <input class="form-control" value="1" id="massValue2" value="0"
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
                                <button onclick="restartSimulation()" class="btn btn-falcon-default btn-sm me-2"
                                    type="button"><i class="fas fa-redo me-1"></i>Limpar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const box = document.querySelector("#box");
        const box1 = document.querySelector("#box1");
        const line = document.querySelector("#line");
  
        time = parseInt(document.querySelector("#massValue2").value);
        let interval = null; // Variable to store interval
  
        function startSimulation() {
          let position = parseInt(window.getComputedStyle(box).marginLeft);
          let position1 = parseInt(window.getComputedStyle(box1).marginBottom);
          let horizontalLine = parseInt(window.getComputedStyle(line).width);
          let verticalLine = parseInt(window.getComputedStyle(line).height);
          let lastResize = true;
  
          interval = setInterval(() => {
            let mass = parseInt(document.querySelector("#massValue").value);
            let mass1 = parseInt(document.querySelector("#massValue2").value);
            let auxPosition, auxPosition1;
  
            let tensionForce =
              mass1 * 10 > mass ? (mass1 * 10) / (mass + mass1) : 0;
  
            document.querySelector("#acelerationValue").innerHTML =
              mass !== 0 && mass1 !== 0
                ? `Aceleração: ${
                    typeof tensionForce === "decimal"
                      ? tensionForce.toFixed(1)
                      : tensionForce
                  } m/s²`
                : "Aceleração: 0 m/s²";
  
            const mainWidth = document.querySelector(".base").offsetWidth - 25;
            const boxWidth = box.offsetWidth;
  
            auxPosition = position + tensionForce;
            auxPosition1 = position1;
            auxPosition += tensionForce;
  
            if (auxPosition + boxWidth > mainWidth && lastResize) {
              // console.log(position);
              position = 225;
              position1 = -21;
  
              horizontalLine = 175;
              verticalLine = 365;
  
              console.log(position1);
              lastResize = false;
            } else {
              position += tensionForce;
              position1 -= tensionForce;
  
              horizontalLine -= tensionForce;
              verticalLine += tensionForce;
            }
  
            if (
              (position + boxWidth > mainWidth && !lastResize) ||
              mass <= 0 ||
              mass1 <= 0 ||
              position <= 0
            ) {
              clearInterval(interval);
            } else {
              box.style.marginLeft = `${position}px`;
              box1.style.marginBottom = `${position1}px`;
              line.style.width = `${horizontalLine}px`;
              line.style.height = `${verticalLine}px`;
            }
          }, 100 - time / 10);
        }
  
        function pauseSimulation() {
          clearInterval(interval);
        }
  
        function restartSimulation() {
          clearInterval(interval);
          box.style.marginLeft = "0";
          box1.style.marginBottom = "200px";
          line.style.width = "400px";
          line.style.height = "140px";
        }
      </script>
@endsection
