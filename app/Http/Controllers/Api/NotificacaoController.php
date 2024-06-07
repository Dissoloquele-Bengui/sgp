<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destinatario;
use App\Models\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificacaoController extends Controller
{

    public function index($id)
    {


        try {

            $registros['notificacaos'] = Notificacao::join('categoria_notificacaos','categoria_notificacaos.id','notificacaos.id_categoria')
                ->join('destinatarios','destinatarios.id_notificacao','notificacaos.id')
                ->select('notificacaos.*','categoria_notificacaos.nome as categoria','destinatarios.estado as estado','destinatarios.id as id_destinatario')
                ->where('destinatarios.id_user',$id)
                ->get();
            $registros['not_view']= $registros['notificacaos']->where('estado',0)->count();
            if ($registros['notificacaos']->isEmpty()) {
                return response()->json(['message' => 'Nenhum tipo de notificacao encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Throwable $e) {
            throw $e;
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar tipos de notificacaos.', 'error' => $e->getMessage()], 500);
        }
    }
    public function estado($id){
        $destinatario = Destinatario::findOrfail($id)->update([
            'estado'=>1
        ]);
        $user_id=    Destinatario::find($id)->id_user;

        $registros['notificacaos'] = Notificacao::join('categoria_notificacaos','categoria_notificacaos.id','notificacaos.id_categoria')
            ->join('destinatarios','destinatarios.id_notificacao','notificacaos.id')
            ->select('notificacaos.*','categoria_notificacaos.nome as categoria','destinatarios.estado as estado')
            ->where('destinatarios.id_user',$user_id)
            ->get();
        $registros['not_view']= $registros['notificacaos']->where('estado',0)->count();
        if ($registros['notificacaos']->isEmpty()) {
            return response()->json(['message' => 'Nenhum tipo de notificacao encontrado.'], 200);
        }
        // Retornar os dados com status de sucesso
        return response()->json($registros, 200);
    }

    public function ver($id, $id_user)
    {
        $notificacao['data'] = Notificacao::join('categoria_notificacaos','categoria_notificacaos.id','notificacaos.id_categoria')
            ->join('destinatarios','destinatarios.id_notificacao','notificacaos.id')
            ->select('notificacaos.*','categoria_notificacaos.nome as categria','destinatarios.estado as estado')
            ->where('id', $id)
            ->where('destinatarios.id_user',$id_user)
            ->first();

        if (!$notificacao) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        return response()->json($notificacao,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Notificacao::find($id);
            if ($registro) {
                $registro->delete();
                return response()->json(['message' => 'Registro  eliminado com sucesso.'], 200);
            } else {
                return response()->json(['message' => 'Registro  não encontrado.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao eliminar registro.', 'error' => $e->getMessage()], 500);
        }
    }
}
