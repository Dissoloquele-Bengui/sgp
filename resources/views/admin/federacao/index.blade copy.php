@extends('layouts.admin')
@section('titulo', 'Federações')
@section('conteudo')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Federações <small>Gestão Federações</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-12 col-sm-12 ">
                {{-- <div class="x_panel">
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
                    <div class="x_content">
                        <form class="" action="" method="post" novalidate="">
                            <p>For alternative validation library <code>parsleyJS</code> check out in the <a
                                    href="form.html">form page</a>
                            </p>
                            <span class="section">Personal Info</span>
                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2"
                                        name="name" placeholder="ex. John f. Kennedy" required="required">
                                </div>
                                <div class="alert">please put something here</div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Occupation<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="occupation" data-validate-length-range="5,15"
                                        type="text">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">email<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="email" required="required" type="email">
                                </div>
                            </div>
                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm email address<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="email" name="confirm_email"
                                        data-validate-linked="email" required="required">
                                </div>
                                <div class="alert">please put something here</div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Number <span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="number" name="number" data-validate-minmax="10,100"
                                        required="required">
                                </div>
                            </div>
                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="date" name="date" required="required">
                                </div>
                                <div class="alert">please put something here</div>
                            </div>
                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Time<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="time" name="time" required="required">
                                </div>
                                <div class="alert">please put something here</div>
                            </div>

                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password1" name="password"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*]).{8,}"
                                        title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character"
                                        required="">

                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                        <i id="slash" class="fa fa-eye-slash"></i>
                                        <i id="eye" class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="alert">inupt is not as expected</div>
                            </div>

                            <div class="field item form-group bad">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="password2"
                                        data-validate-linked="password" required="required">
                                </div>
                                <div class="alert">passwords do not match</div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Telephone<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="tel" name="phone" required="required"
                                        data-validate-length-range="8,20">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">message<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea required="required" name="message"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
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
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Logo tipo</th>
                                                <th>Nome</th>
                                                <th>Presidente</th>
                                                <th>Selecao</th>
                                                <th>Fundação</th>
                                                <th>Sede</th>
                                                <th>Treinador</th>
                                                <th>E-mail</th>
                                                <th>Telefone</th>
                                                <th>URL Site</th>
                                                <th>Confederação</th>
                                                <th>Descricão</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($federacoes as $federacao)
                                                <tr>
                                                    <td><img src="{{ $federacao->logo_url }}" style="height: 30px"
                                                            alt=""> </td>
                                                    <td>{{ $federacao->nome }}</td>
                                                    <td>{{ $federacao->presidente }}</td>
                                                    <td>{{ $federacao->selecao }}</td>

                                                    <td>{{ formatarDataPortugues($federacao->fundacao) }}</td>
                                                    <td>{{ $federacao->sede }}</td>
                                                    <td>{{ $federacao->treinador }}</td>
                                                    <td>{{ $federacao->email_contato }}</td>
                                                    <td>{{ $federacao->telefone }}</td>

                                                    <td> <a target="_blank"
                                                            href="{{ $federacao->url_site }}">{{ $federacao->url_site }}</a>
                                                    </td>
                                                    <td>{{ $federacao->confederacao }}</td>
                                                    <td>{{ $federacao->descricao }}</td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>Tiger</td>
                                                <td>Tiger</td>
                                                <td>Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>5421</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>5421</td>
                                            </tr>
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
