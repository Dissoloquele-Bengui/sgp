<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CampoPedido;
use App\Models\Destinatario;
use App\Models\Notificacao;
use App\Models\Pedido;
use App\Models\TipoPedido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{

    public function index()
    {


        try {

            $registros = Pedido::join('tipo_pedidos','tipo_pedidos.id','pedidos.id_tipo')
                ->join('users','pedidos.id_user','users.id')
                ->select('pedidos.*','users.name as user','tipo_pedidos.nome as tipo')
                ->orderBy('pedidos.id','DESC')
                ->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum tipo de pedido encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar tipos de pedidos.', 'error' => $e->getMessage()], 500);
        }
    }
    public function cadastrar(Request $request)
    {
        try {
            $pedido = Pedido::create([
                'estado' => "Aguardando Parecer",
                'id_user' => intval($request->id_user),
                'descricao' => $request->descricao,
                'id_tipo' => $request->id_tipo,
            ]);
            if(isset($request->campo_ids)){
                $indice = 0;
                foreach($request->campo_ids as $campo_id){
                    CampoPedido::create([
                        'valor'=>$request->campos[$indice],
                        'id_campo'=>$campo_id,
                        'id_pedido'=>$pedido->id
                    ]);
                    $indice++;
                }
            }
            //Inicio de Envio de notificaç]ao
            $user = User::findOrfail(1);
            $tipo = TipoPedido::findOrfail($request->id_tipo);
            $destinatarios = usersByTipoPedido($request->id_tipo);
            $notificacao = Notificacao::create([
                'titulo'=>"Aviso",
                'descricao'=>"O usuário de nome $user->name e id $user->id fez um pedido do tipo $tipo->nome que está aguardando o vosso parecer",
                'data'=>Carbon::now(),
                'id_categoria'=>1,
                'id_pedido'=>$pedido->id
            ]);

            foreach ($destinatarios as $key) {
                //Enviando notificação aos usuarios com permissao de tomarem uma ação quanto ao pedido
                Destinatario::create([
                    'id_notificacao'=>$notificacao->id,
                    'id_user'=>$key->id,
                    'estado'=>0
                ]);
            }


            if ($pedido) {
                $ultimoPedido = Pedido::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Pedido " .intval($request->id_user)." Cadstrado com sucesso",
                ], 200);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Throwable $e) {
            throw $e;
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e], 500);
        }
    }
    public function actualizar(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'descricao' => 'required',
            ], [
                'descricao.required' => 'O campo descrição é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $campo = Pedido::find($id);



            //$validated = $validator->validated();
            $registro = Pedido::findOrFail($id)->update([
                'descricao' => $request->descricao,
                'id_tipo' => intval($request->id_tipo),
            ]);
            if(isset($request->campo_ids)){
                $indice = 0;
                foreach($request->campo_ids as $campo_id){
                    CampoPedido::create([
                        'valor'=>$request->campos[$indice],
                        'id_campo'=>$campo_id,
                        'id_pedido'=>$id
                    ]);
                    $indice++;
                }
            }
            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Pedido  Atualizado com sucesso",
                ], 200);
            }

        } catch (\Throwable $e) {
            throw $e;
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $campo = Pedido::where('id', $id)->first();

        if (!$campo) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        // return new PedidoResource($campo);
        return response()->json($campo,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Pedido::find($id);
            if ($registro) {
                $registro->delete();
                return response()->json(['message' => 'Registro  eliminado com sucesso.'], 200);
            } else {
                return response()->json(['message' => 'Registro  não encontrado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao eliminar registro.', 'error' => $e->getMessage()], 500);
        }
    }
}
