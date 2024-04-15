@extends('layouts._includes.admin.Header')
@section('title', 'Tipo Serviços')
@section('conteudo')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Listar /</span> Tipo Serviços</h4>

    <!-- Bootstrap Table with Caption -->
    <div class="card">

        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5 class="card-header">Tipo Serviços</h5>
            </div>
            <div>
                <a href="javascript:void(0)" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tipoServicoModal">
                    Adicionar Tipo Serviço
                </a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <caption class="ms-4">
                    Listar Tipo Serviço
                </caption>
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="85%">Tipo Serviço</th>
                        <th width="10%">Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipo_servicos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->vc_tipo_servico }}</td>
                            <td>
                                <a title="Editar" href="{{route('admin.tipo_servico.edit', $item->slug )}}" class="btn btn-sm btn-icon btn-outline-warning">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <button type="button" title="Eliminar" onclick="eliminarTipoServicoModal('{{$item->vc_tipo_servico}}', '{{$item->slug}}')" class="btn btn-sm btn-icon btn-outline-danger">
                                    <i class="bx bx-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function eliminarTipoServicoModal(nome, slug) {
            document.getElementById("nome_eliminarTipoServicoModal").textContent = nome;
            document.getElementById("slug_eliminarTipoServicoModal").value = slug;
            $('#eliminarTipoServicoModal').modal('show');
        }

        function adicionarMembroDepartamentoModal(slug) {
            document.getElementById("slug_adicionarMembroDepartamentoModal").value = slug;
            $('#adicionarMembroDepartamentoModal').modal('show');
        }
    </script>
@endsection
