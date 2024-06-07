<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CampoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampoPedidoController extends Controller
{

    public function index($id)
    {


        try {

            $registros = CampoPedido::join('pedidos','pedidos.id','campo_pedidos.id_pedido')
                ->join('campos','campos.id','campo_pedidos.id_campo')
                ->select('campo_pedidos.valor','campos.*')
                ->where('pedidos.id',$id)
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

            $validator = Validator::make($request->all(), [

                "valor" => "required",
            ], [
                'valor.required' => 'O campo valor completo é obrigatório.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);


            }
            $campo = CampoPedido::create([
                'valor' => $request->valor,
                'id_pedido' => $request->id_pedido,
                'id_tipo' => $request->id_tipo,
            ]);

            if ($campo) {
                $ultimoUsuario = CampoPedido::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$ultimoUsuario->valor." Cadstrado com sucesso",
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
            $campoFind = CampoPedido::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $campoId = auth()->id();
            } else {
                $campoId = $campoFind->id;
            }
            $validator = Validator::make($request->all(), [
                'valor' => 'required',
            ], [
                'valor.required' => 'O campo valor completo é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $campo = CampoPedido::find($id);



            $validated = $validator->validated();
            $registro = CampoPedido::find($id)->update([
                'valor' => $request->valor,
                'id_pedido' => $request->id_pedido,
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
                    'message' => "Tipo de Usuario " .$request->valor." Atualizado com sucesso",
                ], 200);
            }

        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $campo['data'] = CampoPedido::where('id', $id)->first();

        if (!$campo) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        // return new CampoPedidoResource($campo);
        return response()->json($campo,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = CampoPedido::find($id);
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
