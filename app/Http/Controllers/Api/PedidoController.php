<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{

    public function index()
    {


        try {

            $registros = Pedido::all();
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

                "descricao" => "required",
            ], [
                'descricao.required' => 'O campo estado completo é obrigatório.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);


            }
            $campo = Pedido::create([
                'estado' => $request->estado,
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_tipo' => $request->id_tipo,
            ]);

            if ($campo) {
                $ultimoUsuario = Pedido::latest()->first();

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
            $campoFind = Pedido::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $campoId = auth()->id();
            } else {
                $campoId = $campoFind->id;
            }
            $validator = Validator::make($request->all(), [
                'estado' => 'required',
            ], [
                'estado.required' => 'O campo estado completo é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $campo = Pedido::find($id);



            $validated = $validator->validated();
            $registro = Pedido::find($id)->update([
                'estado' => $request->estado,
                'id_user' => $request->id_user,
                'descricao' => $request->descricao,
                'id_tipo' => $request->id_tipo,
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
        $campo['data'] = Pedido::where('id', $id)->first();

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
