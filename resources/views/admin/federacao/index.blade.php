@extends('layouts.admin')
@section('titulo', 'Federações')
@section('conteudo')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Federações <small>Gestão Federações</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-align-left"></i> Adicionar federações <small>Clicar no ícone para abrir o
                                formulário</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content" style="display: none;">
                        <br>
                        <form id="demo-form2" action="{{ route('admin.federacoes.store') }}"
                            class="form-horizontal form-label-left row" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('_form.federacao.index')
                           
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                              
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-success">Adicionar</button>
                                    <button class="btn btn-primary" type="reset">Limpar</button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabela de dados registrados<small>Federações</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">


                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap jambo_table"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="headings">
                                                <th>#</th>
                                                <th>Logo tipo</th>
                                                <th>Nome</th>
                                                <th>Presidente</th>
                                                <th>Selecao</th>
                                                <th>Fundação</th>
                                                <th>Sede</th>
                                                <th>Treinador</th>
                                                <th>E-mail</th>
                                                <th>Telefone</th>
                                                <th>URL Site</th>
                                                <th>Confederação</th>
                                                {{-- <th>Descricão</th> --}}
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($federacoes as $federacao)
                                                <tr>
                                                    <td>{{ $federacao->id }}</td>
                                                    <td><img  data-confirm="Tem certeza que deseja eliminar?" src="/{{ $federacao->logo_url }}" style="height: 30px"
                                                            alt=""> </td>
                                                    <td>{{ $federacao->nome }}</td>
                                                    <td>{{ $federacao->presidente }}</td>
                                                    <td>{{ $federacao->selecao }}</td>

                                                    <td>{{ formatarDataPortugues($federacao->fundacao) }}</td>
                                                    <td>{{ $federacao->sede }}</td>
                                                    <td>{{ $federacao->treinador }}</td>
                                                    <td>{{ $federacao->email_contato }}</td>
                                                    <td>{{ $federacao->telefone }}</td>

                                                    <td> <a target="_blank"
                                                            href="{{ $federacao->url_site }}">{{ $federacao->url_site }}</a>
                                                    </td>
                                                    <td >{{ $federacao->confederacao }}</td>
                                                    {{-- <td>
                                                        {{ $federacao->descricao }}
                                                    </td> --}}
                                                    <td>
                                                        <div class="accordion" id="accordion" role="tablist"
                                                            aria-multiselectable="true">
                                                            <div class="panel">
                                                                <div class="d-flex">
                                                                    <a href="{{route('admin.federacoes.destroy',$federacao->id)}}"  data-confirm="Tem certeza que deseja eliminar?" href="" class="panel-heading">
                                                                        Eliminar
                                                                    </a>
                                                                    <a class="panel-heading" role="tab" id="headingOne"
                                                                        data-toggle="collapse" data-parent="#accordion"
                                                                        href="#collapseOne" aria-expanded="true"
                                                                        aria-controls="collapseOne">
                                                                        Editar
                                                                    </a>

                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in"
                                                                    role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body">
                                                                        <form id="demo-form2"
                                                                            action="{{ route('admin.federacoes.update',$federacao->id) }}"
                                                                            class="form-horizontal form-label-left row"
                                                                            enctype="multipart/form-data" method="POST">
                                                                            @csrf
                                                                            @include('_form.federacao.index')
                                                                            <div class="ln_solid"></div>
                                                                            <div class="item form-group">
                                                                                <div class="col-md-12 ">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success">Editar</button>
                                                                                   

                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
