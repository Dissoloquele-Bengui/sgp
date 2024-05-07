<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaAnexo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\CategoriaAnexoResource;

class CategoriaAnexoController extends Controller
{
    public function index()
    {
        try {
            $categoriaAnexos = categoriaAnexos()->get();
            if ($categoriaAnexos->isEmpty()) {
                return response()->json(['message' => 'Nenhuma  categoria de anexo encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($categoriaAnexos, 200);
             $data=CategoriaAnexoResource::collection($categoriaAnexos);
            //  return $data;
            return $data;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar categoria de anexo.', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {


        try {

            $validador = Validator::make($request->all(), [
                'vc_nome' => 'required'
            ], [
                'vc_nome.required' => 'O campo Categoria é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }


            $categoriaAnexo = CategoriaAnexo::create([

                'vc_nome' => $request->vc_nome
            ]);

            // return new AnexosResource($anexo);
            if ($categoriaAnexo) {
                return response()->json(['message' => 'Registro efectuado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $categoriaAnexo['data'] = CategoriaAnexo::where('id', $id)->first();

        if (!$categoriaAnexo) {
            return response()->json(['message' => 'Anexo Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($categoriaAnexo,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'vc_nome' => 'required'
            ], [
                'vc_nome.required' => 'O campo Categoria é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }
            $registro = Anexo::find($id)->update([
                'vc_nome' => $request->vc_nome,
            ]);
            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
                // return $this->error("Erro ao atualizar Usuario ",400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Anexo " .$request->vc_nome." Atualizado com sucesso",
                ], 200);
                // return response()->json("Usuario ".$request->vc_pnome." ".$request->vc_unome." Atualizado com sucesso", 200);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }
    public function delete($id)
    {
        try {
            $registro = CategoriaAnexo::find($id);
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
