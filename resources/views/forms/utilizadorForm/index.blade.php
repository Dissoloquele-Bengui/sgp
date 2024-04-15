
    
<div class="col-md-12">

    {{-- <h2 class="h3 mb-4 page-title">Settings</h2> --}}
    <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab{{isset($utilizador)?$utilizador->id:''}}" data-toggle="tab" href="#home{{isset($utilizador)?$utilizador->id:''}}" role="tab"
                    aria-controls="home" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab3{{isset($utilizador)?$utilizador->id:''}}" data-toggle="tab" href="#profile3{{isset($utilizador)?$utilizador->id:''}}" role="tab"
                    aria-controls="profile" aria-selected="false">Passe</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home{{isset($utilizador)?$utilizador->id:''}}" role="tabpanel" aria-labelledby="home-tab{{isset($utilizador)?$utilizador->id:''}}">
                @isset($utilizador)
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset($utilizador->profile_photo_path) }}"alt="..."
                                    class="avatar-img rounded-circle"
                                    style="    width: 110px;
                                  height: 113px;">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 class="mb-1">{{ $utilizador->name }}</h4>
                                    <p class="small mb-3"><span
                                            class="badge badge-dark">{{ $utilizador->tipoUtilizador }}</span></p>
                                </div>
                            </div>
                            <div class="row mb-4">
                         
                                <div class="col">
                                    <p class="small mb-0 text-muted">{{ $utilizador->email }}</p>
                                    <p class="small mb-0 text-muted">{{ $utilizador->genero }} </p>
                                    <p class="small mb-0 text-muted">{{ $utilizador->bi }}</p>

                                    <p class="small mb-0 text-muted">(244) {{ $utilizador->telefone }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset
                    <hr class="my-4">
                    <div class="form-row">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="profile_photo_path">Fotografia</label>
                                    <input type="file" id="profile_photo_path" name="profile_photo_path"
                                        class="form-control" value="{{ old('profile_photo_path') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nome</label>
                                    <input type="text" id="name" placeholder="Digita o nome" name="name"
                                        class="form-control"
                                        value="{{ isset($utilizador) ? $utilizador->name : old('name') }}" required>
                                </div>
                            </div> <!-- /.col -->


                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="bi">NIF</label>
                                    <input  minlength="14" maxlength="14" id="bi" placeholder="Digita o NIF"name="bi" required
                                        class="form-control"
                                        value="{{ isset($utilizador) ? $utilizador->bi : old('bi') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="telefone">Telefone</label>
                                    <input  type="number"
                                    min="900000000"
                                    max="999999999"
                                   
                                    required
                                    id="telefone" name="telefone"
                                     placeholder="Digita o Telefone"
                                        class="form-control"
                                        value="{{ isset($utilizador) ? $utilizador->telefone : old('telefone') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">E-mail</label>
                                    <input id="email" required placeholder="Digita o E-mail" name="email"
                                        class="form-control"
                                        value="{{ isset($utilizador) ? $utilizador->email : old('vc_zona_geografica_actuacao') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="genero">Gênero</label>
                                    <select name="genero" class="form-control select2" id="genero" required>
                                        @isset($utilizador)
                                            <option value="{{ $utilizador->genero }}">{{ $utilizador->genero }}</option>
                                        @else
                                            <option value="">Selecciona o Gênero</option>
                                        @endisset
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tipoUtilizador">Nível de Acesso</label>
                                    <select name="tipoUtilizador" class="form-control select2" id="tipoUtilizador" required>
                                        @isset($utilizador)
                                            <option value="{{ $utilizador->tipoUtilizador }}">
                                                {{ $utilizador->tipoUtilizador }}</option>
                                        @else
                                            <option value="">Selecciona o Nível</option>
                                        @endisset
                                        <option value="Administrador">Administrador</option>
       

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Requisitos de senha</p>
                                <p class="small text-muted mb-2"> Para criar senha, você deve atender a todos os seguintes requisitos: </p>
                                <ul class="small text-muted pl-4 mb-0">
                                  <li> Mínimo 8 caracteres </li>
                                  <li>Pelo menos um caractere especial</li>
                                  <li>Pelo menos um numero</li>
                                  <li>Não pode ser igual à senha anterior</li>
                                  <li>Ao fazer a ediçâo, deve colocar a passe</li>
                                </ul>
                              </div>

                        </div>

                    </div>
                  
            </div>
            <div class="tab-pane fade" id="profile3{{isset($utilizador)?$utilizador->id:''}}" role="tabpanel" aria-labelledby="profile-tab3{{isset($utilizador)?$utilizador->id:''}}">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="passe">Passe</label>
                            <input id="passe"  placeholder="Digita a passe" name="password"
                                class="form-control" type="password" {{isset($utilizador)?'':'required'}}>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="passeConfirm">Confirmar Passe</label>
                            <input id="passeConfirm"  placeholder="Digita a passe" name="passeConfirm"
                                class="form-control" type="password" {{isset($utilizador)?'':'required'}}>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div> <!-- /.card-body -->
 
</div>

