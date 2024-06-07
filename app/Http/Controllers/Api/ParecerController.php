<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destinatario;
use App\Models\Notificacao;
use App\Models\Parecer;
use App\Models\Pedido;
use App\Models\TipoPedido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParecerController extends Controller
{

    public function index($id)
    {


        try {
            $registros = Parecer::all();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum tipo de pedido encontrado.'], 200);
            }
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar tipos de pedidos.', 'error' => $e->getMessage()], 500);
        }
    }
    public function cadastrar(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "descricao" => "required",
            ], [
                'descricao.required' => 'A descricao é obrigatória.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os pareceres obrigatórios",
                ],422);


            }
            $parecer = Parecer::create([
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_pedido' => $request->id_pedido,
            ]);
            //Inicio de Envio de notificaç]ao
            $pedido = Pedido::findOrFail($request->id_pedido);

            $user = User::findOrfail($request->id_user);

            $tipo = TipoPedido::findOrfail($pedido->id_tipo);

            $destinatarios = usersDecisaoByTipoPedido($request->id_tipo);

            $notificacao = Notificacao::create([
                'titulo'=>"Aviso",
                'descricao'=>"O usuário de nome $user->name e id $user->id deu o seu parecer a um pedido do tipo $tipo->nome que está aguardando a vossa decisão",
                'data'=>Carbon::now(),
                'id_categoria'=>2
            ]);

            foreach ($destinatarios as $key => $value) {
                //Enviando notificação aos usuarios com permissao de tomarem uma ação quanto ao pedido
                Destinatario::create([
                    'id_notificacao'=>$notificacao->id,
                    'id_user'=>$key->id,
                    'estado'=>0
                ]);
            }
            if ($parecer) {
                $ultimoUsuario = Parecer::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$ultimoUsuario->estado." Cadstrado com sucesso",
                ], 200);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Throwable $e) {
            throw $e;
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
            $parecer = Parecer::find($id);



            $validated = $validator->validated();
            $registro = Parecer::find($id)->update([
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_pedido' => $request->id_pedido,
            ]);
            Pedido::find($request->id_pedido)->update([
                'estado'=>"Aguardando Decisão",
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

        } catch (\Throwable $e) {
            throw $e;
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $parecer = Parecer::join('users','users.id','parecers.id_user')
            ->join('pedidos','pedidos.id','parecers.id_pedido')
            ->select('parecers.*','users.name as user')
            ->where('id_pedido', $id)->get();

        if (!$parecer) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        return response()->json($parecer,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Parecer::find($id);
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

