{{-- @extends('layouts._includes.admin.body')
@section('titulo','Actualizar Operador')

@section('conteudo') --}}
    <div class="card shadow mb-4">
        {{-- <div class="card-header">
        <strong class="card-title">Actualizar Operador</strong>
        </div> --}}
        <form action="{{ route('admin.utilizadores.update', ['id' => $utilizador->id]) }}
" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('_form.utilizadorForm.index')
                <button type="submit" class="btn btn-primary w-md">Actualizar</button>
            </div>
        </form>
    </div>

@if (session('operador.update.success'))
    <script>
        Swal.fire(
            'Categoria Actualizada com sucesso!',
            '',
            'success'
        )
    </script>
@endif
@if (session('operador.update.error'))
    <script>
        Swal.fire(
            'Erro ao Actualizar Categoria!',
            '',
            'error'
        )
    </script>
@endif

{{-- @endsection --}}
