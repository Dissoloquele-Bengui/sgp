@extends('layouts._includes.site.body')
@section('titulo', 'Comitê Olímpico-Federações')

@section('conteudo')
    <br>
    <br><br><br>

    <section id="contact" class="get-started">
        <div class="container">
            <div class="row text-center">
                <h1 class="display-3 fw-bold text-capitalize">Registre-se Aqui</h1>
                <div class="heading-line"></div>
                <!-- <p class="lh-lg">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero illum architecto modi.
                          </p> -->
            </div>

            <!-- START THE CTA CONTENT  -->
            <div class="row text-white" style="color: black!important;;">
                <!-- Tabs navs -->
                <ul class="nav nav-fill nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="fill-tab-0" data-bs-toggle="tab" href="#fill-tabpanel-0"
                            role="tab" aria-controls="fill-tabpanel-0" aria-selected="true"> <i
                                class="fa fa-taxi me-2"></i>Motorista </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fill-tab-1" data-bs-toggle="tab" href="#fill-tabpanel-1" role="tab"
                            aria-controls="fill-tabpanel-1" aria-selected="false"> <i class="fa fa-male me-2"></i>Passageiro
                        </a>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                              <a class="nav-link" id="fill-tab-2" data-bs-toggle="tab" href="#fill-tabpanel-2" role="tab" aria-controls="fill-tabpanel-2" aria-selected="false"> Tab 3 </a>
                            </li> -->
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active " id="fill-tabpanel-0" role="tabpanel" aria-labelledby="fill-tab-0">
                        <div class="row">

                            <div class="col-12 col-lg-12 bg-white shadow ">
                                <div class="wizard p-2 pt-5 " style="color: black!important;">
                                    <div class="wizard-inner">
                                        <div class="connecting-line"></div>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                                    aria-expanded="true"><span class="round-tab">1 </span> <i>Dados Pessoas
                                                    </i></a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                                    aria-expanded="false"><span class="round-tab">2</span> <i>Dados do
                                                        veículo
                                                    </i></a>
                                            </li>

                                            <li role="presentation" class="disabled">
                                                <a href="#step3" data-toggle="tab" aria-controls="step3"
                                                    role="tab"><span class="round-tab">3</span> <i>Finalizar</i></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <form role="form" action="{{ route('site.register_motorista.store_motorista') }}"
                                        method="POST" class="login-box">
                                        @csrf
                                      
                                        @include('forms._formRegisterMotorista.index')

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="fill-tabpanel-1" role="tabpanel" aria-labelledby="fill-tab-1">

                        <form role="form" action="{{ route('site.register_passageiro.store_passageiro') }}"
                            method="POST" class="login-box">
                            @csrf
                            <div class="col-12 col-lg-12 bg-white shadow p-3">
                                <div class="form w-100 pb-2">
                                    <div class="row">
                                        <!-- Dados Pessoais -->
                                        @include('forms._formRegisterPassageiro.index')

                                        <div class="text-center d-grid mt-1">
                                            <button type="submit" class="btn btn-primary rounded-pill pt-3 pb-3">
                                                Enviar
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>
                    <!-- <div class="tab-pane" id="fill-tabpanel-2" role="tabpanel" aria-labelledby="fill-tab-2">Tab Tab 3 selected</div> -->
                </div>

            </div>
        </div>
    </section>



@endsection
