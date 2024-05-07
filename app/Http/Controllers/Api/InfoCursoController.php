<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoCurso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\InfoCursoResource;

class InfoCursoController extends Controller
{
    public function index()
    {
        try {
            $infoCursos = infoCursos()->get();
            if ($infoCursos->isEmpty()) {
                return response()->json(['message' => 'Nenhuma Informação encontrada.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($infoCursos, 200);
             $data=InfoCursoResource::collection($infoCursos);
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
                'txt_text' => 'required'
            ], [
                'txt_text.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }


            $infoCurso = InfoCurso::create([

                'txt_text' => $request->txt_text,
                'it_id_curso' => $request->it_id_curso,
                'it_id_categoriaCurso' => $request->it_id_categoriaCurso


            ]);

            // return new InfoCursosResource($anexo);
            if ($infoCurso) {
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
        $infoCurso['data'] = InfoCurso::where('id', $id)->first();

        if (!$infoCurso) {
            return response()->json(['message' => 'Info do Curso Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($infoCurso,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'txt_text' => 'required'
            ], [
                'txt_text.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }
            $registro = InfoCurso::find($id)->update([
                'txt_text' => $request->txt_text,
                'it_id_curso' => $request->it_id_curso,
                'it_id_categoriaCurso' => $request->it_id_categoriaCurso
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
                    'message' => "info" .$request->txt_text." Atualizada com sucesso",
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
            $registro = InfoCurso::find($id);
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
