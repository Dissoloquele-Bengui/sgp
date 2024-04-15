<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Federacao;
use App\Models\TipoServico;
use Illuminate\Http\Request;
use App\Models\Logger;

class ClasseController extends Controller
{
    //

    public function __construct()
    {

        $this->logger = new Logger();

    }
    public function loggerData($mensagem)
    {

        $this->logger->Log('info', $mensagem);
    }
    public function list()
    {
        $dados['classes'] = Classe::get();

        return view('admin.classe.list.index', $dados);

    }

    public function store(Request $request)
    {
        try {
            Classe::create([
                'descricao' => $request->descricao,
            ]);
            $this->loggerData("Cadastrou classe: " . $request->descricao);
            return redirect()->back()->with('success', ['status' => '1', 'sms' => 'Cadastrado com sucesso']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ['status' => '1', 'sms' => 'Erro ao cadastrar']);
        }
    }

    public function edit($slug)
    {
        $tipo_servico = TipoServico::where('slug', $slug)->first();
        if (!$tipo_servico) {
            return redirect()->back();
        }
        return view('admin.tipo_servico.edit.index', compact('tipo_servico'));
    }

    public function update(Request $request, $slug)
    {
        $tipo_servico = TipoServico::where('slug', $slug)->first();
        if (!$tipo_servico) {
            return redirect()->back();
        }
        try {
            $tipo_servico->update([
                'vc_tipo_servico' => $request->vc_tipo_servico,
            ]);
            $this->loggerData("Editou tipo serviço: " . $request->vc_tipo_servico);
            return redirect()->route('admin.tipo_servico.list')->with('success', ['status' => '1', 'sms' => 'Cadastrado com sucesso']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ['status' => '1', 'sms' => 'Erro ao cadastrar']);
        }
    }

    public function delete(Request $request)
    {

        $tipo_servico = TipoServico::where('slug', $request->slug)->first();
        if (!$tipo_servico) {
            return redirect()->back();
        }
        try {
            if ($tipo_servico->deleted_at == null) {
                $this->loggerData("Eliminou tipo serviço $tipo_servico->vc_tipo_servico");
                $tipo_servico->delete();
            } else {
                $this->loggerData("Eliminou permanentimente tipo serviço $tipo_servico->vc_tipo_servico");
                $tipo_servico->forceDelete();
            }

            return redirect()->back()->with('success', ['status' => '1', 'sms' => 'Eliminado com sucesso']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ['status' => '1', 'sms' => 'Erro ao eliminar']);
        }
    }
}
