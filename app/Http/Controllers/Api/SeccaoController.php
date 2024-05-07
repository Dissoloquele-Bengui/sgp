<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seccao;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\SeccaoResource;

class SeccaoController extends Controller
{
    public function index()
    {
        try {
            $seccao = seccao()->get();
            if ($seccao->isEmpty()) {
                return response()->json(['message' => 'Nenhum  seccao encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($seccao, 200);
             $data=SeccaoResource::collection($seccao);
            //  return $data;
            return $data;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar seccao.', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {

        try {

            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                'it_number' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                'it_number.required' => 'O campo Núemro de Secção é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }

            $seccao = Seccao::create([

                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'it_number' => $request->it_number,
                'it_id_curso' => $request->it_id_curso,
            ]);

            // return new AnexosResource($seccao);
            if ($seccao) {
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
        $seccao['data'] = Aula::where('id', $id)->first();

        if (!$seccao) {
            return response()->json(['message' => 'Aula Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($seccao,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'vc_title' => 'required',
                'txt_description' => 'required',
                'it_number' => 'required',
            ], [
                'vc_title.required' => 'O campo Título é obrigatório.',
                'txt_description.required' => 'O campo Descrição é obrigatório.',
                'it_number.required' => 'O campo capa é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = Seccao::find($id)->update([
                'vc_title' => $request->vc_title,
                'txt_description' => $request->txt_description,
                'it_number' => $request->it_number,
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
