@extends('layouts._includes.admin.Header')
@section('title', 'Tipo Serviço| editar')
@section('conteudo')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Editar /</span> Tipo Serviço</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Tipo Serviço</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tipo_servico.update', $tipo_servico->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('forms._formTipoServico.index')
                        <button type="submit" class="btn btn-primary">Editar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
