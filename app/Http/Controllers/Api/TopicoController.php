<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicoController extends Controller
{
    //
    public function index()
    {
        try {
            $registros = topicos()->get();
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
                'topico' => 'required',
                'descricao' => 'required',
                'numero' => 'required',
                'id_curso' => 'required'
            ], [
                'topico.required' => 'O capo topico é obrigatório.',
                'descricao.required' => 'O capo descrição é obrigatório.',
                'numero.required' => 'O capo numero é obrigatório.',
                'id_curso.required' => 'O capo curso(id do curso) é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }

            $registro = Topico::create($request->all());
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
            $validador = \Validator::make($request->all(), [
                'topico' => 'required',
                'descricao' => 'required',
                'numero' => 'required',
                // 'id_curso' => 'required'
            ], [
                'topico.required' => 'O capo topico é obrigatório.',
                'descricao.required' => 'O capo descrição é obrigatório.',
                'numero.required' => 'O capo numero é obrigatório.',
                // 'id_curso.required' => 'O capo curso(id do curso) é obrigatório.'
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
    public function por_curso($id_curso)
    {
        try {
            $topicosComArquivos = [];
            $topicos = Topico::join('cursos', 'cursos.id', 'topicos.id_curso')
                ->select('topicos.*', 'cursos.curso')
                ->where('topicos.id_curso', $id_curso)
                ->get();

            if ($topicos->isEmpty()) {
                return response()->json(['message' => 'Nenhum registro encontrado.'], 200);
            }

            foreach ($topicos as $topico) {
                $arquivos = Arquivo::where('id_topico', $topico->id)->get();
                $arquivosSeparados = [
                    'videos' => [],
                    'audios' => [],
                    'imagens' => [],
                    'documentos' => []
                ];

                foreach ($arquivos as $arquivo) {
                    switch ($arquivo->tipo_arquivo) {
                        case 'mp4':
                            $arquivosSeparados['videos'][] = $arquivo;
                            break;
                        case 'mp3':
                            $arquivosSeparados['audios'][] = $arquivo;
                            break;
                        case 'jpg':
                            $arquivosSeparados['imagens'][] = $arquivo;
                            break;
                        case 'jpeg':
                            $arquivosSeparados['imagens'][] = $arquivo;
                            break;
                        case 'png':
                            $arquivosSeparados['imagens'][] = $arquivo;
                            break;
                        default:
                            $arquivosSeparados['documentos'][] = $arquivo;
                            break;
                    }
                }

                $topicosComArquivos[] = [
                    'topico' => $topico,
                    'arquivos' => $arquivosSeparados
                ];
            }

            // Retornar os dados com status de sucesso
            return response()->json($topicosComArquivos, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar tópicos.', 'error' => $e->getMessage()], 500);
        }
    }

}
