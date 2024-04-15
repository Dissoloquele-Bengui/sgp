


@extends('layouts.admin')
@section('titulo', 'Utilizadores')
@section('conteudo')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Utilizadores <small>Gestão Utilizadores</small></h3>
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
                        <form id="demo-form2" action="{{route('admin.utilizadores.store')}}" method="post" 
                            class="form-horizontal form-label-left row" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('_form.utilizadorForm.index')

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
                                            <th>Fotografia</th>
                                            <th>Nome</th>
                                            <th>Gênero</th>
                                            <th>Nif</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>Ações</th>
                                          
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($utilizadores as $utilizador)
                                              <tr>
                                                  <td>{{$utilizador->id}}</td>
                                                  <td>
                                                    <div class="avatar avatar-md">
                                                      <img src="{{ asset($utilizador->profile_photo_path) }}" alt="..." class="avatar-img rounded-circle" style="width: 48px;
                                                      height: 48px;">
                                                    </div>
                                                  </td>
                                                  <td>{{$utilizador->name}}</td>
                        
                                                  <td>{{$utilizador->genero}}</td>
                                                  <td>{{$utilizador->bi}}</td>
                                                  <td>{{$utilizador->email}}</td>
                                                  <td>{{$utilizador->telefone}}</td>
                                                  <td>
                                                      <div class="dropdown">
                                                          <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <span class="text-muted sr-only">Action</span>
                                                          </button>
                                                          <div class="dropdown-menu dropdown-menu-right">
                                                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalEdit{{$utilizador->id}}">{{ __('Editar') }}</a>
                                                              {{-- <a class="dropdown-item" href="{{route('admin.utilizador.edit',['id'=>$utilizador->id])}}">Editar</a> --}}
                                                              <a class="dropdown-item" href="{{route('admin.utilizadores.destroy',['id'=>$utilizador->id])}}">Remover</a>
                                                              <a class="dropdown-item" href="{{route('admin.utilizadores.purge',['id'=>$utilizador->id])}}">Purgar</a>
                                                          </div>
                                                          </div>
                        
                                                  </td>
                                              </tr>
                                          {{-- ModalUpdate --}}
                                          <div class="modal fade text-left" id="ModalEdit{{$utilizador->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h4 class="modal-title">{{ __('Editar Utilizador') }}</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          @include('admin.utilizadores.edit.index')
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          {{-- ModalUpdate --}}
                                          @endforeach
                                          @php
                                              unset($utilizadores);
                                              unset($utilizador);
                                          @endphp
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
