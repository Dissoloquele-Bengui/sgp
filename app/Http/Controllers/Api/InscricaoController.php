<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InscricaoController extends Controller
{
    //
    public function index()
    {
        try {
            $registros = inscricoes()->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum  registro encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }

  

    public function cadastrar(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'id_user' => 'required',
                'id_curso' => 'required'
            ], [
                'id_user.required' => 'O capo usuário(id do usuàrio) é obrigatório.',
                'id_curso.required' => 'O capo curso(id do curso) é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $estado = Inscricao::where('id_user', $request->id_user)
                ->where('id_curso', $request->id_curso)
                ->count();
            if ($estado) {
                return response()->json(['message' => 'Não é possível adicionar um inscrição duplicada'], 409);
            }
            $registro = Inscricao::create($request->all());
            if ($registro) {
                return response()->json(['message' => 'Registro efectuado com sucesso.'], 201);
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
            $validador = Validator::make($request->all(), [
                'id_user' => 'required',
                'id_curso' => 'required'
            ], [
                'id_user.required' => 'O capo usuário(id do usuàrio) é obrigatório.',
                'id_curso.required' => 'O capo curso(id do curso) é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $estado = Inscricao::where('id_user', $request->id_user)
                ->where('id_curso', $request->id_curso)
                ->count();
            if ($estado) {
                return response()->json(['message' => 'Não é possível adicionar um inscrição duplicada'], 409);
            }
            $registro = Inscricao::find($id);
            if ($registro) {
                $registro->update($request->all());
                return response()->json(['message' => 'Registro actualizado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Actualização não efectuada, registro não econtrado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }
    public function eliminar($id)
    {
        try {
            $registro = Inscricao::find($id);
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
    public function por_formando($id_user)
    {
        try {
            $registros = inscricoes()->where('inscricaos.id_user', $id_user)->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum  registro encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
    public function por_curso($id_curso)
    {
        try {
            $registros = inscricoes()->where('inscricaos.id_curso', $id_curso)->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum  registro encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
}
