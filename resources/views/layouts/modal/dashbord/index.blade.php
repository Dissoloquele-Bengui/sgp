{{-- <!--Trocar sanha-->
<div class="modal fade" id="alterarSenhaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Alterar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Eliminar Utilizador-->
<div class="modal fade" id="eliminarUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Eliminar Utilizador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <p>Tens a certeza que queres eliminar <b id="nome_eliminarUserModal"></b></p>
                    <input type="hidden" name="slug" id="slug_eliminarUserModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Cadastrar Departamento-->
<div class="modal fade" id="tipoServicoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Cadastrar Tipo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tipo_servico.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @include('forms._formTipoServico.index')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Eliminar Departamento-->
<div class="modal fade" id="eliminarTipoServicoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Eliminar Tipo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tipo_servico.delete') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <p>Tens a certeza que queres eliminar <b id="nome_eliminarTipoServicoModal"></b></p>
                    <input type="hidden" name="slug" id="slug_eliminarTipoServicoModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
--}}



<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg mt-6" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button
                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <div class="modal-body p-0">
                <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
                    <h4 class="mb-1" id="staticBackdropLabel">Cadastrar classe</h4>
                </div>
                <div class="p-4">
                    <div class="row body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Cadastrar Classe-->
<div class="modal fade" id="classeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog mt-6" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.classe.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-0">
                    <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
                        <h4 class="mb-1" id="staticBackdropLabel">Cadastrar classe</h4>
                    </div>
                    <div class="p-4">
                        <div class="row body">
                            @csrf
                            @include('forms._formClasse.index')
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Cadastrar </button>
                </div>
            </form>
        </div>
    </div>
</div>
