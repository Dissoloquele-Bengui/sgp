<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\ComentarioResource;

class ComentarioController extends Controller
{
    public function index()
    {
        try {
            $comentarios = comentarios()->get();
            if ($comentarios->isEmpty()) {
                return response()->json(['message' => 'Nenhum Comentário encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($comentarios, 200);
             $data=ComentarioResource::collection($comentarios);
            //  return $data;
            return $data;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar Infomração.', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {

            $validador = Validator::make($request->all(), [
                'txt_comment' => 'required'
            ], [
                'txt_comment.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }


            $comentario = Comentario::create([

                'txt_comment' => $request->txt_comment,
                'it_id_curso' => $request->it_id_curso,
                'it_id_user' => $request->it_id_user,
                'it_id_aula' => $request->it_id_aula

            ]);

            // return new ComentariosResource($anexo);
            if ($comentario) {
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
        $comentario['data'] = Comentario::where('id', $id)->first();

        if (!$comentario) {
            return response()->json(['message' => 'Comentário Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($comentario,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'txt_comment' => 'required'
            ], [
                'txt_comment.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }
            $registro = Comentario::find($id)->update([
                'txt_comment' => $request->txt_comment,
                'it_id_curso' => $request->it_id_curso,
                'it_id_user' => $request->it_id_user,
                'it_id_aula' => $request->it_id_aula
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
                    'message' => "info" .$request->txt_comment." Atualizada com sucesso",
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
            $registro = Comentario::find($id);
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
