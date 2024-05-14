<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoPedido;
use Dotenv\Validator;
use Illuminate\Http\Request;

class TipoPedidoController extends Controller
{
    //
    //~

    public function index()
    {


        try {

            $registros = TipoPedido::all();
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

            $validator = Validator::make($request->all(), [

                "nome" => "required",
            ], [
                'nome.required' => 'O campo nome completo é obrigatório.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);


            }
            $user = TipoPedido::create([
                'nome' => $request->nome,
            ]);

            if ($user) {
                $ultimoPedido = TipoPedido::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Pedido " .$ultimoPedido->nome." Cadstrado com sucesso",
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
            $userFind = TipoPedido::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $userId = auth()->id();
            } else {
                $userId = $userFind->id;
            }
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
            ], [
                'nome.required' => 'O campo nome completo é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $user = TipoPedido::find($id);



            $validated = $validator->validated();
            $registro = TipoPedido::find($id)->update([
                "nome" => $validated["nome"],
            ]);

            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Pedido " .$request->nome." Atualizado com sucesso",
                ], 200);
                // return response()->json("Tipo de Pedido ".$request->vc_pnome." ".$request->vc_unome." Atualizado com sucesso", 200);
            }

        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $user['data'] = TipoPedido::where('id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário Não Encontrado'], 200);
        }

        // return new TipoPedidoResource($user);
        return response()->json($user,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = TipoPedido::find($id);
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
