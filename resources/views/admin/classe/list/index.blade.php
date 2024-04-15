@extends('layouts._includes.admin.Header')
@section('title', 'Classes')
@section('conteudo')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url(../../assets/img/icons/spot-illustrations/corner-4.png);">
        </div><!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Listagem de Classes</h3>
                    <p class="mb-0">Documentation and examples for opt-in styling of tables with Falcon.</p><a
                        class="btn btn-link btn-sm ps-0 mt-2" href="https://getbootstrap.com/docs/5.3/content/tables/"
                        target="_blank">Tables on Bootstrap<span class="fas fa-chevron-right ms-1 fs-11"></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto ms-auto">
                    <div class="nav nav-pills nav-pills-falcon flex-grow-1 mt-2">
                        <button class="btn btn-sm active" data-bs-toggle="modal" data-bs-target="#classeModal">Cadastrar
                            classe</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-88202497-593f-464d-888e-68d67a1d9bd3"
                    id="dom-88202497-593f-464d-888e-68d67a1d9bd3">
                    <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                        <div class="row justify-content-end g-0">
                            <div class="col-auto col-sm-5 mb-3">
                                <form>
                                    <div class="input-group"><input class="form-control form-control-sm shadow-none search"
                                            type="search" placeholder="Search..." aria-label="search" />
                                        <div class="input-group-text bg-transparent"><span
                                                class="fa fa-search fs-10 text-600"></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="85%">Classe</th>
                                        <th width="10%">Acção</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($classes as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->descricao }}</td>
                                            <td class="center">
                                           
                                                <a href="" class="icon-item-sm border rounded-2 shadow-none p-1" title="Editar">
                                                    <i class="fas fa-pencil-alt fa-w-14 text-warnng"></i>
                                                </a>
                                                    <a href="" class="icon-item-sm border rounded-3 shadow-none p-1" title="Elimnar">
                                                        <i class="far fa-trash-alt fa-w-14 text-danger"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1"
                                type="button" title="Previous" data-list-pagination="prev"><span
                                    class="fas fa-chevron-left"></span></button>
                            <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1"
                                type="button" title="Next" data-list-pagination="next"><span
                                    class="fas fa-chevron-right"> </span></button>
                        </div>
                    </div>
                </div>
            </div>
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
