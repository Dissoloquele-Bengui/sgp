@extends('layouts.app')
@section('titulo', 'INACOM')

@section('conteudo')
    <section id="center" class="clearfix center_home">
        <div class="center_home_m clearfix">
            <div class="carousel slide article-slide" id="article-photo-carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner cont-slider">

                    <div class="item active">
                        <img alt="abc" class="iw" src="/site/img/olimpico-banner.jpg">
                    </div>

                </div>
                <!-- Indicators -->

            </div>
            <div class="center_home_mi clearfix">
                <h1 class="text-uppercase">Federações Esportivas em Destaque: Descubra o Mundo do Esporte em Angola </h1>
                <p>Este é o seu destino central para todas as informações relacionadas às federações esportivas de Angola.
                </p>
               
            </div>
        </div>

    </section>


    <section id="achieve">

        <div class="container">
            <h2 class="mgt text-center">Federações</h2>
            <br>
            <div class="row">
                <div class="achieve_1 clearfix">
                    @foreach ($federacoes as $federacao)
                        <div class="col-sm-4 " style="padding-top: 25px;">
                            <div class="achieve_1m clearfix">
                                <div class="achieve_1mi clearfix">
                                    <img src="{{ asset($federacao->logo_url) }}" class="iw" alt="abc">
                                </div>
                                <div class="achieve_1mi1 text-center clearfix">
                                    <span class="col"><i class="fa fa-star-o"></i></span>
                                    <h3 class="bold col">{{ $federacao->nome }}</h3>
                                    <p class="col"> @php echo mb_strimwidth( $federacao->descricao, 0, 10, "..."); @endphp</p>
                                    <h5><a target="_blank" class="button" href="{{$federacao->url_site}}">
                                            ACESSAR <i class="fa fa-chevron-right"></i></a>
											<a   class="button" href="{{ route('site.federacoes.ver_mais', $federacao->id) }}">VER
												MAIS <i class="fa fa-chevron-right"></i></a>
										</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>




    <br>







@endsection
