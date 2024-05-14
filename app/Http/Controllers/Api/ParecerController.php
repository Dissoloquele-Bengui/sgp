<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parecer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParecerController extends Controller
{

    public function index()
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

            if ($parecer) {
                $ultimoUsuario = Parecer::latest()->first();

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
            $parecerFind = Parecer::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $parecerId = auth()->id();
            } else {
                $parecerId = $parecerFind->id;
            }
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
        $parecer['data'] = Parecer::where('id', $id)->first();

        if (!$parecer) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        // return new ParecerResource($parecer);
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

