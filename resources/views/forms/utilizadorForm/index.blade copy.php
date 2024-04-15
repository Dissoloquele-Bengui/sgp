<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="profile_photo_path">Fotografia</label>
            <input type="file" id="profile_photo_path" name="profile_photo_path" class="form-control"
                value="{{ old('profile_photo_path') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="name">Nome</label>
            <input type="text" id="name" placeholder="Digita o nome" name="name" class="form-control"
                value="{{ isset($utilizador) ? $utilizador->name : old('name') }}" required>
        </div>
    </div> <!-- /.col -->


    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="bi">NIF</label>
            <input id="bi" placeholder="Digita o NIF"name="bi" required class="form-control"
                value="{{ isset($utilizador) ? $utilizador->bi : old('bi') }}">

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="telefone">Telefone</label>
            <input id="telefone" name="telefone" placeholder="Digita o Telefone" class="form-control"
                value="{{ isset($utilizador) ? $utilizador->telefone : old('yr_ano_fundacao') }}">

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="email">E-mail</label>
            <input id="email" required placeholder="Digita o E-mail" name="email" class="form-control"
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
                    <option value="{{ $utilizador->tipoUtilizador }}">{{ $utilizador->tipoUtilizador }}</option>
                @else
                    <option value="">Selecciona o Nível</option>
                @endisset
                <option value="Administrador">Administrador</option>
                <option value="Feminino">Feminino</option>

            </select>

        </div>
    </div>
    <hr>

    <div class="col-md-12 row"  id="divParaEsconder" hidden>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="passe">Passe</label>
                <input id="passe"  placeholder="Digita a passe" name="passe" class="form-control"
                    type="password">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="passeConfirm">Confirmar Passe</label>
                <input id="passeConfirm"  placeholder="Digita a passe" name="passeConfirm" class="form-control"
                    type="password">

            </div>
        </div>

    </div>

</div>

