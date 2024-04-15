<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_primeiro_nome" placeholder="Primeiro Nome"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_meio_nome" placeholder="Nome do Meio"
        class="shadow form-control form-control-lg">
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_ultimo_nome" placeholder="Último Nome"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_numero_bi_ou_passaporte"
        placeholder="Nº do B.I. ou Passaporte"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_telefone"
        placeholder="Telefone"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="email" name="vc_email"
        placeholder="Email"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="date" name="dt_nascimento" placeholder="Data de Nascimento"
        class="shadow form-control form-control-lg">
</div>
<div class="col-lg-6 col-md mb-3">
    <select name="vc_pais" class="shadow form-control form-control-lg">
        <option value="" selected disabled>Seleciona o País</option>
        <option value="Angola">Angola</option>
        <option value="ca">Canadá</option>
        <option value="us">Estados Unidos</option>
    </select>
</div>
<div class="col-lg-6 col-md mb-3">
    <select name="vc_provincia" class="shadow form-control form-control-lg" required>
        <option value="" selected disabled>Seleciona o Estado</option>
        <option value="Angola">Angola</option>
        <option value="ca">Canadá</option>
        <option value="us">Estados Unidos</option>
    </select>
</div>
<div class="col-lg-6 col-md mb-3">
    <input type="text" name="vc_localidade" placeholder="Localidade"
        class="shadow form-control form-control-lg" required>
</div>
<div class="col-lg-6 col-md mb-3">
    <!-- Adicione mais campos conforme necessário -->
</div>

<!-- Tipo de Serviço -->
<div class="col-md-12 mb-3">
    <label for="tipoServico" class="form-label">Tipo de Serviço a Prestar</label>
</div>
@foreach ($site_tipo_servicos as $item)
    <div class="col-lg-3 col-md mb-3">
        <div class="form-check">
            <input class="form-check-input" name="it_id_tipo_servico[]"
                type="checkbox" id="{{ $item->vc_tipo_servico }}"
                value="{{ $item->id }}">
            <label class="form-check-label"
                for="{{ $item->vc_tipo_servico }}">{{ $item->vc_tipo_servico }}</label>
        </div>
    </div>
@endforeach

