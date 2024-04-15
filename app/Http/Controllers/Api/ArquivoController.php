<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Topico;
use Illuminate\Http\Request;

class ArquivoController extends Controller
{
    //
    //
    public function index()
    {
        try {
            $registros = arquivos()->get();
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

            $validador = \Validator::make($request->all(), [
                'id_topico' => 'required',
            ], [
                'id_topico.required' => 'O capo topico(id topico) é obrigatório.'

            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            if (!Topico::where('id', $request->id_topico)->count()) {
                return response()->json(['message' => 'Upload  não efectuado, topico inválido'], 400);
            }

            $file_data = upload_file($request, 'arquivo', 'arquivos/topicos');
            // return response()->json(['message' => 'Upload efectuado com sucesso','path'=>$path], 201);
            if ($file_data) {
                // $path = $request->file('arquivo')->store('arquivo_topico');
                $arquivo = Arquivo::create([
                    'url' => $file_data['url_absoluta'],
                    'tamanho' => $file_data['tamanho'] . ' ' . $file_data['unidade'],
                    'tipo_arquivo' => $file_data['extensao'],
                    'id_topico' => $request->id_topico
                ]);


                if ($arquivo) {
                    return response()->json(['message' => 'Upload efectuado com sucesso'], 201);
                } else {
                    return response()->json(['message' => 'Upload  não efectuado'], 400);
                }
            } else {
                return response()->json(['message' => 'Upload  não efectuado, arquivo não válido'], 400);

            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id)
    {
        try {
            $validador = \Validator::make($request->all(), [
                'topico' => 'required',
                'descricao' => 'required',
                'numero' => 'required',
                // 'id_topico' => 'required'
            ], [
                'topico.required' => 'O capo topico é obrigatório.',
                'descricao.required' => 'O capo descrição é obrigatório.',
                'numero.required' => 'O capo numero é obrigatório.',
                // 'id_topico.required' => 'O capo topico(id do topico) é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }

            $registro = Topico::find($id);
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
            $registro = Topico::find($id);
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
    public function por_topico($id_topico)
    {
        try {
            $registros = arquivos()->where('arquivos.id_topico', $id_topico)->get();
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
