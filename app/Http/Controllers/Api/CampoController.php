<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CampoController extends Controller
{
    //
    //~

    public function index()
    {


        try {

            $registros = Campo::join('tipo_pedidos','tipo_pedidos.id','campos.id_tipo_pedido')
                ->select('campos.*','tipo_pedidos.nome as tipo_pedido')
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
            $campo = Campo::create([
                'nome' => $request->nome,
                'id_tipo_pedido' => $request->id_tipo_pedido,
                'formato' => $request->formato,
            ]);

            if ($campo) {
                $ultimoUsuario = Campo::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$ultimoUsuario->nome." Cadstrado com sucesso",
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
            $campoFind = Campo::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $campoId = auth()->id();
            } else {
                $campoId = $campoFind->id;
            }
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
            ], [
                'nome.required' => 'O campo nome completo é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $campo = Campo::find($id);



            $validated = $validator->validated();
            $registro = Campo::find($id)->update([
                'nome' => $request->nome,
                'id_tipo_pedido' => $request->id_tipo_pedido,
                'formato' => $request->formato,
            ]);

            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$request->nome." Atualizado com sucesso",
                ], 200);
            }

        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $campo['data'] = Campo::join('tipo_pedidos','tipo_pedidos.id','campos.id_tipo_pedido')
            ->select('campos.*','tipo_pedidos.nome as tipo_pedido')
            ->where('id_tipo_pedido', $id)
            ->first();

        if (!$campo) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        // return new CampoResource($campo);
        return response()->json($campo,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Campo::find($id);
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

