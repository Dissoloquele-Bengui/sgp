<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Federacao;
use Illuminate\Http\Request;

class FederacaoController extends Controller
{
    //
    public function list()
    {

        dd("ss");
        $response['federacoes'] = federacoes()->get();
        // dd(  $response['federacoes']);
        return view('admin.federacao.index', $response);

    }

    public function destroy($id)
    {
        // dd($id);
       Federacao::find($id)->delete();
       return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => "Federação Eliminada com sucesso!"]);

    }

    public function store(Request $request)
    {
        $logo_url = upload_file($request, 'logo_url', 'federacoes/logo');
        // dd(   $request);
        $federacao = Federacao::create([
            "nome" => $request->nome,
            "presidente" => $request->presidente,
            "selecao" => $request->selecao,
            "fundacao" => $request->fundacao,
            "sede" => $request->sede,
            "treinador" => $request->treinador,
            "email_contato" => $request->email_contato,
            "telefone" => $request->telefone,
            "url_site" => $request->url_site,
            "confederacao" => $request->confederacao,
            'descricao' => $request->descricao,
            'logo_url' => $logo_url,
            'descricao'=>$request->descricao,
            "slug" => slug_gerar()
        ]);
        Federacao::find($federacao->id)->update([
            'logo_url' => $logo_url
        ]);
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => "Federação adicionada com sucesso!"]);

        // dd($federacao);
        // dd($request->all());

    }

    public function update(Request $request, $id)
    {
// dd($request);
        $federacao = Federacao::find($id)->update([
            "nome" => $request->nome,
            "presidente" => $request->presidente,
            "selecao" => $request->selecao,
            "fundacao" => $request->fundacao,
            "sede" => $request->sede,
            "treinador" => $request->treinador,
            "email_contato" => $request->email_contato,
            "telefone" => $request->telefone,
            "url_site" => $request->url_site,
            "confederacao" => $request->confederacao,

            'descricao' => $request['descricao'.$id],

        ]);
        $logo_url = upload_file($request, 'logo_url', 'federacoes/logo');
        if ($logo_url) {
            Federacao::find($id)->update([
                'logo_url' => $logo_url
            ]);
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => "Federação editada com sucesso!"]);

        // dd($federacao);
        // dd($request->all());

    }
}
