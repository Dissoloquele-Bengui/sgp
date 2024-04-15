@extends('layouts._includes.lab.App')
@section('titulo', 'Plano Inclinado (forca peso)')
@section('conteudo')
    <style>



section
{
	font-style: oblique;
	margin: auto;
	display: inline-block;
}

#options
{
	/* margin: 10px; */
}

article
{
	margin: 10px 10px 10px 10px;
	float: left;
}

#advancedOptionsArticle
{
	margin: 10px 10px 10px 10px;
	display: none; 	
	float: left;
}

#advancedOptionsArticle2
{
	margin: 10px 10px 10px 10px;
	display: none; 	
	float: left;
}
#plane
{
	height: 400px;
	width: 550px;
	border: 2px solid #3498db;
	margin: 10px 10px 10px 10px;
}
#canvasArticle
{
	float: none; 
	margin: 10px;
}
#parametersArticle
{
	min-height: 100px; 
	min-width: 150px; 
	float: none;
	text-align: left;
}


.form1 {
	display: flex;
	align-items: center;
	justify-content: center;
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
                            <h4 class="text-primary fw-bold mb-0">Plano Inclinado (forca peso)
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
                    <article id="canvasArticle">
                        <canvas id="canvas" width="600" style="display: inline-block;"></canvas>
                        <br/>
                    
                    </article>
                </div>
                <div class="card-footer text-end bg-transparent" data-bs-theme="light">
                    <div id="acelerationValue"></div>
                    <div id="potentialEnergy" class="controls" style="margin-top: 10px;"></div>
                    <a class="text-white" href="#!">Real-time data<span
                            class="fa fa-chevron-right ms-1 fs-10"></span></a>
                            <article id="parametersArticle" >
                                Tempo: 0 s<br/>
                                Velocidade: 0 m/s<br/>
                                Aceleração: 0 m/s<sup>2</sup><br/>
                                Coeficiente máximo:<br/>
                            </article>
                            

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
                            <section id="options" class="w-100 pt-0">
                                <article id="optionsArticle" class="w-100 pt-0">
                                    <form name="form1"  method="post" class="row" >
                                        <div class="col">
                                        Comprimento do plano (metros)<br/>
                                        <input class="form-control form-control-lg" type="text" size="20" id="length" value="300"/><br/>
                                 
                                    </div>
                                    <div class="col">
                                        Ângulo (graus)
                                        <input class="form-control form-control-lg" type="number" size="20" id="angle" value ="30" min="1" max="90" step="1.0" /><br/>
                                       
                                    </div>
                                    <div class="col">
                                        Coeficiente de Atrito (valor entre 0-1)
                                        <input class="form-control form-control-lg" type="number" size="20" id="friction" value ="0.1" step="0.1" min="0.1" max="1.0" /><br/><br/>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" value="Iniciar" onclick="start()" id="btnStart"
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

                                    </form>
                                </article>
                                
                                <article id="advancedOptionsArticle">
                                    <form name="form2"  method="post">
                                        Taxa de atualização (s)<br/>
                                        <input class="form-control form-control-lg" type="text" size="20" id="dt" value="0.03"/><br/>
                                        Comprimento do corpo (metros)<br/>
                                        <input class="form-control form-control-lg" type="text" size="20" id="Length" value ="10"/><br/>
                                        Altura do corpo (metros)<br/>
                                        <input class="form-control form-control-lg" type="text" size="20" id="Height" value ="6"/><br/><br/>
                                    </form>
                                </article>
                                    
                                <article id="advancedOptionsArticle2">
                                    <form name="form3"  method="post">
                                        Aceleração da gravidade<br/>
                                        <input type="text" class="form-control form-control-lg" size="20" id="g" value="9.81"/><br/>
                                    </form>
                                </article>
                            </section>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script>
    // Isso valida a informação inserida pelo usuário e inicia o movimento do bloco
function start()
{				
	if ((document.form1.length.value=="")||(document.form1.angle.value==""))
	{
		alert ("Valores não podem estar em branco");
		return false;
	}
	else if ((parseFloat(document.form2.Length.value)>=parseFloat(document.form1.length.value))||(parseFloat(document.form1.length.value)>2000))
	{
		alert ("length value must be in (Cuboid length (default 10),2000] ");
		return false;
	}
	else if ((parseFloat(document.form1.angle.value)<=0)||(parseFloat(document.form1.angle.value)>90))
	{
		alert ("Ângulo deve estar entre [0, 90]");
		return false;
	}
	else if ((parseFloat(document.form1.friction.value)<0))
	{
		alert ("Atrito deve ser um valor maior que 0 ");
		return false;
	}
	else if ((parseFloat(document.form2.dt.value)<=0)||(parseFloat(document.form2.dt.value)>100))
	{
		alert ("Ângulo deve ser um valor entre (0,100] ");
		return false;
	}
	else if ((parseFloat(document.form2.Length.value)<=0)||(parseFloat(document.form2.Length.value)>=parseFloat(document.form1.length.value)))
	{
		alert ("Comprimento deve estar entre (0, Comprimento do Plano) ");
		return false;
	}
	else if ((parseFloat(document.form2.Height.value)<0)||(parseFloat(document.form2.Height.value)>200))
	{
		alert ("Altura deve estar entre (0,200] ");
		return false;
	}
	else 
	{
		runAndDraw();
		return true;
	}
}

// Calcula e atualiza a posição do bloco após a próxima vez dt (selecionado pelo usuário, ou padrão 0,03s)
function nextPosition(dt)
{
	var frictionSign=null;
	this.number+=1;
	this.time=this.number*dt-0.0001;

	// O atrito funciona o oposto da reversão da velocidade
	if(this.vX>=0.0 && this.vY>=0.0) {
		frictionSign=1.0;
	}
	else if(this.vX<0.0 && this.vY<0.0) {
		frictionSign=-1.0;
	}

	// A aceleração devido ao atrito não deve exceder a aceleração do bloco
	if(this.frictionX>this.aX)
	this.frictionX=this.aX;
	if(this.frictionY>this.aY)
	this.frictionY=this.aY;

	// Atualização da posição e velocidade do bloco
	this.vX+=dt*(this.aX-frictionSign*this.frictionX);
	this.vY+=dt*(this.aY-frictionSign*this.frictionY);
	this.pX=this.startpX+((this.aX-frictionSign*this.frictionX)*this.time*this.time)/2.0;
	this.pY=this.startpY+((this.aY-frictionSign*this.frictionY)*this.time*this.time)/2.0;
}



// Uma flag que diz se o bloco está funcionando sem problemas
var cuboidSlidingDown= false;

// Isso ajuda a controlar o número de simulações em execução e desinstalação. O valor mínimo é 0 (atualmente não estamos exibindo a simulação), o valor máximo é 2 (estamos exibindo as simulações + solicitaremos uma nova simulação).
var numberOfTask=0;

var topX=0;
var topY=20;
function runAndDraw() {
	if(numberOfTask<=1)
	{
		++numberOfTask;
		const canvasElem = document.getElementById('canvas');
		const ctx = canvasElem.getContext('2d');
		
		ctx.clearRect(0, 0, canvasElem.width, canvasElem.height);
		var length=parseFloat(document.form1.length.value);
		var angle=parseFloat(document.form1.angle.value);
		var friction=parseFloat(document.form1.friction.value);
		var dt=parseFloat(document.form2.dt.value);
		var rectLength=parseFloat(document.form2.Length.value);
		var rectHeight=parseFloat(document.form2.Height.value);
		var g =parseFloat(document.form3.g.value);
		var sina=Math.sin(angle*Math.PI/180.0);
		var cosa=Math.cos(angle*Math.PI/180.0);
		topY=rectHeight*cosa+20;
		canvasElem.height=length*sina+rectHeight*cosa+20;
		canvasElem.width=length*cosa+rectHeight*sina+20;
		var vX=0.0;
		var vY=0.0;

		var bottomX=topX+Math.cos(angle*Math.PI/180.0)*length;
		var bottomY=topY+Math.sin(angle*Math.PI/180.0)*length;

		var cuboid = new Cuboid(30,rectLength,topX,topY,vX,vY,g*sina*cosa,g*sina*sina,g*cosa*friction*cosa,g*cosa*friction*sina);
		cuboidSlidingDown=true;

		if(numberOfTask==1)
		{
			calcAndDrawNextPosition(bottomX,bottomY,angle,length,cuboid,ctx,canvasElem,dt);
			var interval=setInterval(function() {
				calcAndDrawNextPosition(bottomX,bottomY,angle,length,cuboid,ctx,canvasElem,dt);
				if(cuboid.pX >=bottomX- Math.cos(angle*Math.PI/180.0)*rectLength  || cuboid.pY >= bottomY- Math.sin(angle*Math.PI/180.0)*rectLength)
				{
					numberOfTask--;
					cuboidSlidingDown=false;
					clearInterval(interval);
				}

				if(numberOfTask>1)
				{
					--numberOfTask;
					clearInterval(interval);
					
					--numberOfTask;
					runAndDraw();
				}
			}
		, dt*1000);
		}

		  
}

function calcAndDrawNextPosition(bottomX,bottomY,angle,length,cuboid,ctx,canvasElem,dt)
{
	var sina=Math.sin(angle*Math.PI/180.0);
	var cosa=Math.cos(angle*Math.PI/180.0);
	document.getElementById('parametersArticle').innerHTML="tempo: "+cuboid.time.toFixed(2)+" s"+"<br/>velocidade: "+Math.sqrt(cuboid.vX*cuboid.vX+cuboid.vY*cuboid.vY).toFixed(2)+" m/s"+"<br/>aceleração: "+Math.sqrt((cuboid.aX-cuboid.frictionX)*(cuboid.aX-cuboid.frictionX)+(cuboid.aY-cuboid.frictionY)*(cuboid.aY-cuboid.frictionY)).toFixed(2) + " m/s<sup>2</sup>"+"<br/>coeficiente máximo: "+((sina/cosa).toFixed(4));
	ctx.clearRect(0, 0, canvasElem.width, canvasElem.height);
	ctx.fillStyle="#3498db";
	ctx.beginPath();
	ctx.moveTo(topX,topY);
	ctx.lineTo(bottomX,bottomY);
	ctx.lineTo(topX,bottomY);
	ctx.fill();
	cuboid.drawCuboid(ctx,angle);
	cuboid.nextPosition(dt);
}

// Isso representa um bloco que viaja ao longo do mesmo caminho
function Cuboid (height, width, positionX, positionY, velocityX, velocityY, accelerationX, accelerationY, frictionX, frictionY) 
{
	this.height = height;
	this.width = width;
	this.pX = positionX;
	this.pY = positionY;
	this.startpX=positionX;
	this.startpY=positionY;
	this.vX = velocityX;
	this.vY = velocityY;
	this.aX = accelerationX;
	this.aY = accelerationY;
	this.frictionX = frictionX;
	this.frictionY = frictionY;
	this.time=0.0;
	this.number=0;
	
	this.updateParameters=updateParameters;
	this.nextPosition=nextPosition;
	this.drawCuboid=drawCuboid;
}

// Desenha o Bloco
function drawCuboid(ctx,angle)
{
	ctx.fillStyle="#e74c3c";
	ctx.beginPath();
	ctx.moveTo(this.pX,this.pY);

	var nextX=this.pX+Math.cos(angle*Math.PI/180.0)*this.width;
	var nextY=this.pY+Math.sin(angle*Math.PI/180.0)*this.width;
	ctx.lineTo(nextX, nextY);
	nextX=nextX+Math.sin(angle*Math.PI/180.0)*this.height;
	nextY=nextY-Math.cos(angle*Math.PI/180.0)*this.height;
	ctx.lineTo(nextX, nextY);
	nextX=nextX-Math.cos(angle*Math.PI/180.0)*this.width;
	nextY=nextY-Math.sin(angle*Math.PI/180.0)*this.width;
	ctx.lineTo(nextX, nextY);					
	ctx.lineTo(this.pX, this.pY);
	ctx.fill();
}

// É usado para configuração de parâmetro manual, usado em testes, à esquerda no caso de o aplicativo ser estendido
function updateParameters(positionX=this.pX, positionY=this.pY, velocityX=this.vX, velocityY=this.vY, accelerationX=this.aX, accelerationY=this.aY, height=this.height, width=this.width, frictionX=this.frictionX, frictionY=this.frictionY, time=this.time) 
{
	this.height = height;
	this.width = width;
	this.pX = positionX;
	this.pY = positionY;
	this.vX = velocityX;
	this.vY = velocityY;
	this.aX = accelerationX;
	this.aY = accelerationY;
	this.frictionX = frictionX;
	this.frictionY = frictionY;
}}
  </script>
@endsection
