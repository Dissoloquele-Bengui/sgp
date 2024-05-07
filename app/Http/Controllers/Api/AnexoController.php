<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anexo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\AnexoResource;

class AnexoController extends Controller
{
    public function index()
    {
        try {
            $anexos = anexos()->get();
            if ($anexos->isEmpty()) {
                return response()->json(['message' => 'Nenhum  anexo encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($anexos, 200);
             $data=AnexosResource::collection($anexos);
            //  return $data;
            return $data;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar anexo.', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {

        $vc_file = $request->file('vc_file');
        $vc_thumb = $request->file('vc_thumb');
        try {

            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                // 'tm_duraction' => 'required',
                'vc_file' => 'required',
                'vc_thumb' => 'required',
                // 'id_user' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'vc_file.required' => 'O campo Anexo é obrigatório.',
                'tm_duraction.required' => 'O campo capa é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                // 'id_categoria_anexo.required' => 'O campo Categoria do Anexo é obrigatório.',
                // 'id_user.required' => 'O campo ID do Usuário é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }

           $file= upload_file($request, 'vc_file', 'arquivos/anexos');
           $thumb= upload_file($request, 'vc_thumb', 'arquivos/thumbs');
            $anexo = Anexo::create([

                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'vc_file' => $file['url_absoluta'],
                'vc_thumb' => $request->vc_thumb,
                'tm_duraction' => $request->tm_duraction,
                'it_id_aula' => $request->it_id_aula,
                'it_id_categoriaAnexo' => $request->it_id_categoriaAnexo
            ]);

            // return new AnexosResource($anexo);
            if ($anexo) {
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
        $anexo['data'] = Anexo::where('id', $id)->first();

        if (!$anexo) {
            return response()->json(['message' => 'Anexo Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($anexo,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                'vc_file' => 'required',
                'vc_thumb' => 'required',
                // 'id_user' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'vc_file.required' => 'O campo Anexo é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                'vc_thumb.required' => 'O campo capa é obrigatório.',
                // 'id_categoria_anexo.required' => 'O campo Categoria do Anexo é obrigatório.',
                // 'id_user.required' => 'O campo ID do Usuário é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = Anexo::find($id)->update([
                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'vc_file' => $request->vc_file,
                'vc_thumb' => $request->vc_thumb,
                'tm_duraction' => $request->tm_duraction,
                'it_id_aula' => $request->it_id_aula,
                'it_id_categoriaAnexo' => $request->it_id_categoriaAnexo
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
                    'message' => "Anexo " .$request->anexo." Atualizado com sucesso",
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
            $registro = Anexo::find($id);
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
