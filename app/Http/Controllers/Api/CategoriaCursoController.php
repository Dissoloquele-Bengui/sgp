<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaCursoController extends Controller
{
    public function index()
    {
        try {
            $registros = categorias_cursos()->get();
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
                'categoria' => 'required'
            ], [
                'categoria.required' => 'O categoria é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = CategoriaCurso::create([
                'categoria' => $request->categoria
            ]);
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

    public function actualizar(Request $request,$id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'categoria' => 'required'
            ], [
                'categoria.required' => 'O campo Curso é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = CategoriaCurso::find($id);
           
            if ($registro) {
                $registro->update([
                    'categoria' => $request->categoria
                ]);
                return response()->json(['message' => 'Registro actualizado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Actualização  não efectuada, registro não econtrado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao actualizar registro.', 'error' => $e->getMessage()], 500);
        }
    }
    public function eliminar($id)
    {
        try {
            $registro = CategoriaCurso::find($id);
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

