<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aula;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\AulaResource;

class AulaController extends Controller
{
    public function index()
    {
        try {
            $aulas = aulas()->get();
            if ($aulas->isEmpty()) {
                return response()->json(['message' => 'Nenhum  aula encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($aulas, 200);
             $data=AulaResource::collection($aulas);
            //  return $data;
            return $data;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar aula.', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $vc_thumb = $request->file('vc_thumb');
        try {

            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                'vc_thumb' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                'vc_thumb.required' => 'O campo Capa é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }

           $file= upload_file($request, 'vc_file', 'arquivos/aulas');
           $thumb= upload_file($request, 'vc_thumb', 'arquivos/thumbs');
            $aula = Aula::create([

                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'vc_thumb' => $file['url_absoluta'],
                'it_id_seccao' => $request->it_id_seccao,
                'it_id_curso' => $request->it_id_curso,
            ]);

            // return new AulaResource($aula);
            if ($aula) {
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
        $aula['data'] = Aula::where('id', $id)->first();

        if (!$aula) {
            return response()->json(['message' => 'Aula Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($aula,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                'vc_thumb' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                'vc_thumb.required' => 'O campo capa é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = Anexo::find($id)->update([
                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'vc_thumb' => $file['url_absoluta'],
                'it_id_seccao' => $request->it_id_seccao,
                'it_id_curso' => $request->it_id_curso,
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
                    'message' => "Aula de" .$request->vc_title." Atualizado com sucesso",
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
            $registro = Aula::find($id);
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
