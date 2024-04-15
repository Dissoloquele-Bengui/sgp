<?php
use App\Models\Arquivo;
use App\Models\CategoriaCurso;
use App\Models\CategoriaTituloHabilitante;
use App\Models\Federacao;
use App\Models\FeedBack;
use App\Models\FrequenciaMovTerrestre;
use App\Models\FrequenciaMovTom;
use App\Models\FrequenciaNumeracao;
use App\Models\Inscricao;
use App\Models\Numeracao;
use App\Models\Operador;
use App\Models\TituloHabilitante;
use App\Models\CategoriaServico;
use App\Models\Curso;
use App\Models\Topico;
use App\Models\User;

function federacoes()
{
    return Federacao::orderBy('id', 'desc');
}
function slug_gerar()
{

    $slug =
        //  Keygen::numeric(2)->generate() . 
        uniqid(date('HisYmd'));
    // . Keygen::numeric(4)->generate();

    return $slug;
}
// app/Helpers/CustomHelper.php

if (!function_exists('formatar_reais')) {
    function formatar_reais($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}
function operadores()
{
    return Operador::orderBy('id', 'desc');
}
function licencas()
{
    return CategoriaTituloHabilitante::orderBy('id', 'desc');

}
// function servicos(){

//     return  CategoriaServico::orderBy('id','desc');

//   }

function numeracoes()
{
    return Numeracao::join('titulo_habilitantes', 'titulo_habilitantes.id', '=', 'numeracaos.it_id_titulo_habilitante')
        ->join('operadores', 'titulo_habilitantes.it_id_operador', '=', 'operadores.id')
        ->join('categoria_titulo_habilitantes', 'titulo_habilitantes.it_id_categoria_titulo_habilitante', '=', 'categoria_titulo_habilitantes.id')
        ->select(
            'titulo_habilitantes.*',
            'operadores.vc_nome as vc_operador',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'categoria_titulo_habilitantes.vc_nome as categoria_nome',
            'numeracaos.*'
        );

}
function frequencias()
{
    return FrequenciaNumeracao::join('titulo_habilitantes', 'titulo_habilitantes.id', '=', 'frequencia_numeracaos.it_id_titulo_habilitante')
        ->join('operadores', 'titulo_habilitantes.it_id_operador', '=', 'operadores.id')
        ->join('categoria_titulo_habilitantes', 'titulo_habilitantes.it_id_categoria_titulo_habilitante', '=', 'categoria_titulo_habilitantes.id')
        ->select(
            'titulo_habilitantes.*',
            'operadores.vc_nome as vc_operador',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'categoria_titulo_habilitantes.vc_nome as categoria_nome',
            'frequencia_numeracaos.*'
        );

}
function licencas_operadores()
{
    $titulos_cont = [];
    $licensas_cont = [];
    $titulos = CategoriaTituloHabilitante::get();
    foreach ($titulos as $titulo) {
        array_push($titulos_cont, $titulo->vc_nome);
        array_push($licensas_cont, titulos()->where('categoria_titulo_habilitantes.id', $titulo->id)->count());

    }
    $response['titulos_cont'] = $titulos_cont;
    // dd($response['titulos_cont']);
    $response['licensas_cont'] = $licensas_cont;

    return response()->json($response);
}
function tom_prots()
{
    return TomProt::orderBy('id', 'desc');
}
function frequencias_mov_terrestres()
{
    return FrequenciaMovTerrestre::join('titulo_habilitantes', 'titulo_habilitantes.id', '=', 'frequencia_mov_terrestres.it_id_titulo_habilitante')
        ->join('operadores', 'titulo_habilitantes.it_id_operador', '=', 'operadores.id')
        ->join('categoria_titulo_habilitantes', 'titulo_habilitantes.it_id_categoria_titulo_habilitante', '=', 'categoria_titulo_habilitantes.id')
        ->select(
            'titulo_habilitantes.*',
            'operadores.vc_nome as vc_operador',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'categoria_titulo_habilitantes.vc_nome as categoria_nome',

            'frequencia_mov_terrestres.*'
        );
}
function tons()
{

    return FrequenciaMovTom::join('frequencia_mov_terrestres', 'frequencia_mov_terrestres.id', 'frequencia_mov_toms.it_id_frequencia_mov_terrestre')
        ->join('tom_prots', 'frequencia_mov_toms.it_id_tom_prot', 'tom_prots.id')
        ->select('frequencia_mov_terrestres.*', 'tom_prots.*', 'frequencia_mov_toms.*');

}
function titulos()
{
    return TituloHabilitante::join('categoria_titulo_habilitantes', 'categoria_titulo_habilitantes.id', 'titulo_habilitantes.it_id_categoria_titulo_habilitante')
        ->join('operadores', 'operadores.id', 'titulo_habilitantes.it_id_operador')
        ->orderBy('categoria_titulo_habilitantes.vc_nome', 'asc')
        ->select(
            'titulo_habilitantes.*',
            'operadores.vc_nome',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'operadores.vc_zona_geografica_actuacao',
            'operadores.vc_tecnologia_usada',
            'operadores.vc_site_oficial',
            'operadores.vc_caminho',
            'categoria_titulo_habilitantes.vc_nome as nome_categoria_titulo',
        );

}
function categorias_titulos()
{
    return CategoriaTituloHabilitante::get();



}
function titulos_habilitante()
{
    return TituloHabilitante::join('categoria_titulo_habilitantes', 'categoria_titulo_habilitantes.id', 'titulo_habilitantes.it_id_categoria_titulo_habilitante')
        ->select(
            'titulo_habilitantes.*',
            'categoria_titulo_habilitantes.vc_nome as nome_categoria_titulo',
        );

}
function servicos()
{
    return CategoriaServico::get();
}
function estado_titulo()
{
    return [
        'Título Revogado',
        'Em Operação',
        'Título Caducado',
        'Verificar Estado',
    ];
}
function titulo_por_operador($id_operador)
{
    return $response['titulos'] = TituloHabilitante::join('categoria_titulo_habilitantes', 'categoria_titulo_habilitantes.id', 'titulo_habilitantes.it_id_categoria_titulo_habilitante')
        ->join('operadores', 'operadores.id', 'titulo_habilitantes.it_id_operador')
        ->where('operadores.id', $id_operador)
        ->select(

            'titulo_habilitantes.*',
            'operadores.vc_nome',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'operadores.vc_zona_geografica_actuacao',
            'operadores.vc_tecnologia_usada',
            'operadores.vc_site_oficial',
            'operadores.vc_caminho',
            'categoria_titulo_habilitantes.vc_nome as nome_categoria_titulo',
        )->get();

}
function servicos_titulo_operador($id_operador, $id_titulo)
{
    return DB::table('servico_licenciados')
        ->join('titulo_habilitantes', 'titulo_habilitantes.id', 'servico_licenciados.it_id_titulo_habilitante')
        ->join('operadores', 'operadores.id', 'titulo_habilitantes.it_id_operador')
        ->join('categoria_servicos', 'categoria_servicos.id', 'servico_licenciados.it_id_categoria_servico')
        // ->leftJoin('frequencia_numeracaos', 'titulo_habilitantes.it_frequencia_numeracao', '=', 'frequencia_numeracaos.id') //
        ->leftJoin('categoria_titulo_habilitantes', 'titulo_habilitantes.it_id_categoria_titulo_habilitante', '=', 'categoria_titulo_habilitantes.id')
        ->where('operadores.id', $id_operador)
        ->where('titulo_habilitantes.id', $id_titulo)
        ->select(
            'categoria_servicos.vc_nome as servico_licenciado',
            'titulo_habilitantes.*',
            'operadores.vc_nome',
            'operadores.vc_nif',
            'operadores.yr_ano_fundacao',
            'operadores.vc_zona_geografica_actuacao',
            'operadores.vc_tecnologia_usada',
            'operadores.vc_site_oficial',
            'operadores.vc_caminho',

            'categoria_titulo_habilitantes.vc_nome as nome_categoria_titulo',


        )
        ->get();
}
function detalhes_operador($id_operador)
{
    return Operador::join('telefones', 'telefones.it_id_operadore', 'operadores.id')
        ->join('morada_sedes', 'morada_sedes.it_id_operadore', 'operadores.id')
        ->join('emails', 'emails.it_id_operadore', 'operadores.id')
        ->join('ponto_focals', 'ponto_focals.it_id_operadore', 'operadores.id')
        ->where('operadores.id', $id_operador)
        ->limit(2)
        ->get();
}
function formatarDataPortugues($data)
{
    return date("d/m/Y", strtotime($data));
}
function situacao_tributaria($valor)
{
    if ($valor == 1) {
        return "Regularizada";
    } else if ($valor == 0) {
        return "Por Regularizar";
    }
}
function texto_dividido($texto)
{
    $textoCompleto = $texto;
    $textoResumido = substr($textoCompleto, 0, 30);
    return [$textoCompleto, $textoResumido];
}
function upload_file($request, $input, $caminho)
{
    if (isset ($request[$input]) && $request[$input]->isValid()) {

        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $request[$input]->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload:
        $requestImage = $request[$input];
        $upload = $requestImage->move(public_path($caminho), $nameFile);

        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

        // Verifica se NÃO deu certo o upload ( Redireciona de volta )
        if (!$upload) {
            return -1;
        } else {
            // Obtém o tamanho do arquivo em bytes usando filesize
            $sizeInBytes = filesize(public_path($caminho . '/' . $nameFile));

            // Converte o tamanho do arquivo para uma unidade legível
            $size = $sizeInBytes;
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
                $size /= 1024;
            }
            $size = round($size, 2);

            // Obtém a URL absoluta
            $url = url("$caminho/$nameFile");

            // Retorna os dados
            return [
                'tamanho' => $size,
                'unidade' => $units[$i],
                'url_absoluta' => $url,
                'extensao' => $extension
            ];
        }
    } else {
        return null;
    }
}


function cursos()
{

    $cursos = Curso::join('categoria_cursos', 'categoria_cursos.id', 'cursos.id_categoria_curso')
        ->join('users', 'users.id', 'cursos.id_user')
        ->select('cursos.*', 'cursos.id_user', 'users.name as criador', 'categoria_cursos.categoria');
    return $cursos;
}
function categorias_cursos()
{

    $categorias = CategoriaCurso::orderBy('id', 'desc');
    return $categorias;
}
function inscricoes()
{

    $inscricoes = Inscricao::join('users', 'users.id', 'inscricaos.id_user')
        ->join('cursos', 'cursos.id', 'inscricaos.id_curso')
        ->join('categoria_cursos', 'categoria_cursos.id', 'cursos.id_categoria_curso')
        ->select('inscricaos.*', 'cursos.curso', 'users.name as formando', 'users.perfil', 'categoria_cursos.categoria');
    return $inscricoes;
}
function feedbacks()
{

    $feedbacks = FeedBack::join('users', 'users.id', 'feed_backs.id_user')
        ->join('cursos', 'cursos.id', 'feed_backs.id_curso')
        ->join('categoria_cursos', 'categoria_cursos.id', 'cursos.id_categoria_curso')
        ->select('feed_backs.*', 'cursos.curso', 'users.name as formando','users.perfil', 'categoria_cursos.categoria');
    return $feedbacks;
}
function users()
{

    $users = User::orderBy('id', 'desc');
    return $users;
}
function topicos()
{

    $topicos = Topico::join('cursos', 'cursos.id', 'topicos.id_curso')
        ->select('topicos.*', 'cursos.curso');
    return $topicos;
}
function arquivos()
{

    $arquivos = Arquivo::join('topicos', 'topicos.id', 'arquivos.id_topico')
        ->join('cursos', 'cursos.id', 'topicos.id_curso')
        ->select('arquivos.*', 'topicos.topico', 'topicos.numero', 'cursos.curso');
    return $arquivos;
}