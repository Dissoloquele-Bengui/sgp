@extends('layouts._includes.admin.body')
@section('titulo','Lista de Numerações')

@section('conteudo')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="mb-2 page-title">Lista de Numerações</h2>
        <p class="card-text">
          {{-- DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table.  --}}
        </p>
        <div class="row my-4">
          <!-- Small table -->
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <!-- table -->
                <div class="toolbar row mb-3">
                 
                  <div class="col ml-auto">
                    <div class="dropdown float-right">
                      <button class="btn btn-primary float-right ml-3"
                      class="btn botao" data-toggle="modal" data-target="#ModalCreateNumeracao"
                      type="button">Gerar +</button>
                   
                    </div>
                  </div>
                </div>
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
              
                        <th >#</th>
                        <th >Título</th>
                        <th >Número</th>
                       
                        <th >Opções</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($numeracoes as $key => $numero)
                    <tr>
                        <td>{{$numero->id}}</td>
                        <td>{{$numero->vc_operador}}<span class="badge badge-pill badge-success">{{$numero->vc_numero_titulo }}</span></td>
                        <td>{{{$numero->vc_numeracao}}}</td>
                      
                      
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalEdit{{$numero->id}}">{{ __('Editar') }}</a> --}}
                                    {{-- <a class="dropdown-item" href="{{route('admin.operador.edit',['id'=>$operador->id])}}">Editar</a> --}}
                                    <a class="dropdown-item" href="{{route('admin.numeracoes.destroy',['id'=>$numero->id])}}">Remover</a>
                                    <a class="dropdown-item" href="{{route('admin.numeracoes.purge',['id'=>$numero->id])}}">Purgar</a>
                                </div>
                            </div>

                        </td>
                    </tr>

                    {{-- ModalUpdate --}}
                    {{-- <div class="modal fade text-left" id="ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('Editar Morada Sede') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.morada_sede.update',$item->id)}}" method="post">
                                        @csrf
                                        @include('_form.numeracaoForm.index')
                                        <button type="submit" class="btn btn-primary w-md">Editar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- ModalUpdate --}}
                    @endforeach
                    @php
                    unset($numeracoes);
                    unset($numero);
                @endphp
                </tbody>
                </table>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> 


{{-- ModalCreateNumeracaoTelefone --}}

<div class="modal fade text-left" id="ModalCreateNumeracao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Gerar Numeração') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.numeracoes.store')}}" method="post">
                    @csrf
                    @include('_form.numeracaoForm.index')
                    <button type="submit" class="btn btn-primary w-md">Gerar</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
{{-- ModalCreateNumeracao --}}

@endsection
