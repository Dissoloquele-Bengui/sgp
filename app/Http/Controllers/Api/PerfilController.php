<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\PerfilResource;

class PerfilController extends Controller
{
    public function index()
    {
        try {
            $perfis = perfis()->get();
            if ($perfis->isEmpty()) {
                return response()->json(['message' => 'Nenhum Perfil encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
             return response()->json($perfis, 200);
             $data=PerfilResource::collection($perfis);
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
                'txt_experience' => 'required'
            ], [
                'txt_experience.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }


            $perfil = Perfil::create([
                'txt_experience' => $request->txt_experience,
                'it_id_user' => $request->it_id_user,
                'vc_hobby' => $request->vc_hobby
            ]);

            // return new PerfilsResource($anexo);
            if ($perfil) {
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
        $perfil['data'] = Perfil::where('id', $id)->first();

        if (!$perfil) {
            return response()->json(['message' => 'Perfil Não Encontrado'], 200);
        }
        // return new UserResource($user);
        return response()->json($perfil,200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'txt_experience' => 'required'
            ], [
                'txt_experience.required' => 'O campo é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }
            $registro = Perfil::find($id)->update([
                'txt_experience' => $request->txt_experience,
                'it_id_user' => $request->it_id_user,
                'vc_hobby' => $request->vc_hobby
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
                    'message' => "info" .$request->txt_experience." Atualizada com sucesso",
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
            $registro = Perfil::find($id);
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
