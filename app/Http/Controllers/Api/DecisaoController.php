<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Decisao;
use App\Models\Destinatario;
use App\Models\Notificacao;
use App\Models\Pedido;
use App\Models\TipoPedido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DecisaoController extends Controller
{

    public function index()
    {


        try {

            $registros = Decisao::all();
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
            //return response($request);
            $validator = Validator::make($request->all(), [

                "descricao" => "required",
            ], [
                'descricao.required' => 'A descricao é obrigatória.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os decisaos obrigatórios",
                ],422);


            }
            $decisao = Decisao::create([
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_pedido' => $request->id_pedido,
            ]);
            Pedido::find($request->id_pedido)->update([
                'estado'=>$request->estado,
            ]);

            // Inicio de Envio de notificação

            $pedido = Pedido::findOrFail($request->id_pedido);

            $user = User::findOrfail($request->id_user);

            $tipo = TipoPedido::findOrfail($pedido->id_tipo);

            $destinatarios = usersDecisaoByTipoPedido($request->id_tipo);

            $notificacao = Notificacao::create([
                'titulo'=>"Notificação",
                'descricao'=>"Viemos por esta informar que foi tomada uma decisão quanto ao seu pedido de descrição $pedido->descricao e agora ele possui o estado de $request->estado",
                'data'=>Carbon::now(),
                'id_categoria'=>3
            ]);

            //Enviando notificação aos usuários com permissao de tomarem uma ação quanto ao pedido
            Destinatario::create([
                'id_notificacao'=>$notificacao->id,
                'id_user'=>$pedido->id_user,
                'estado'=>0
            ]);


            if ($decisao) {
                $ultimoUsuario = Decisao::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$ultimoUsuario->estado." Cadstrado com sucesso",
                ], 200);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'descricao' => 'required',
            ], [
                'descricao.required' => 'A descricao  é obrigatória.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $decisao = Decisao::find($id);



            $validated = $validator->validated();
            $registro = Decisao::find($id)->update([
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_pedido' => $request->id_pedido,
            ]);
            Pedido::find($request->id_pedido)->update([
                'estado'=>$request->estado,
            ]);
            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$request->estado." Atualizado com sucesso",
                ], 200);
            }

        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $decisao['data'] = Decisao::where('id_pedido', $id)->first();

        if (!$decisao) {
            return response()->json(['message' => 'Decisão Não Encontrada'], 200);
        }

        // return new DecisaoResource($decisao);
        return response()->json($decisao,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Decisao::find($id);
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
