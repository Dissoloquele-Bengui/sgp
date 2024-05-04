<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CursoController extends Controller
{
    //~

    public function index()
    {


        try {

            $cursos = cursos()->get();
            if ($cursos->isEmpty()) {
                return response()->json(['message' => 'Nenhum  curso encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($cursos, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar curso.', 'error' => $e->getMessage()], 500);
        }
    }
    public function por_avaliacao($estado)
    {
        try {
            $cursos = collect();
            if ($estado == 'melhores_avaliacao') {
                try {
                    // Obter todos os cursos
                    $cursos = cursos()->get();

                    // Inicializar um array para armazenar os resultados
                    $resultados = [];
                    $registros = collect();
                    // Iterar sobre todos os cursos
                    $inscritos = 0;
                    foreach ($cursos as $curso) {
                        // Contar o número de inscritos
                        $inscritos = inscricoes()
                            ->where('inscricaos.id_curso', $curso->id)
                            ->count();

                        // Inicializar o total de estrelas preenchidas
                        $estrelas_preenchidas = 0;

                        if ($inscritos > 0) {
                            // Obter os registros de feedback apenas para o curso atual
                            $registros = feedbacks()->where('feed_backs.id_curso', $curso->id)
                                ->get();

                            // Inicializar o contador de votos
                            $total_votos = 0;
                            // Total possível de estrelas (considerando o número de inscritos)
                            $total_estrelas = $inscritos * 5;

                            // Contar o número total de votos
                            foreach ($registros as $registro) {
                                $total_votos += intval($registro->feedback);
                            }

                            // Calcular o percentual de votos
                            $percentual = ($total_votos / $total_estrelas) * 100;

                            // Garantir que o percentual não ultrapasse 100%
                            $percentual = min($percentual, 100);

                            // Calcular a quantidade de estrelas a ser preenchida
                            $estrelas_preenchidas = round(($percentual / 100) * 5);
                        }

                        // Formatar o resultado
                        $resultado = [
                            'id' => $curso->id ?? null,
                            'curso' => $curso->curso ?? null,
                            'duracao' => $curso->duracao,
                            'descricao' => $curso->descricao,
                            'id_categoria_curso' => $curso->id_categoria_curso,
                            'id_user' => $curso->id_user,
                            'deleted_at' => $curso->deleted_at,
                            'updated_at' => $curso->updated_at,
                            'estado' => $curso->estado,
                            'criador' => $curso->criador,
                            'categoria' => $curso->categoria,
                            'votos' => $total_votos ?? 0,
                            'total_inscritos' => $inscritos,
                            'percentual' => $percentual ?? 0,
                            'estrelas_preenchidas' => $estrelas_preenchidas,
                        ];

                        $total_votos = 0;
                        $inscritos = 0;
                        $percentual = 0;
                        $resultados[] = $resultado;
                    }

                    // Ordenar os resultados pelo número de estrelas preenchidas em ordem decrescente
                    $resultados = collect($resultados)->sortByDesc('votos')->values()->all();

                    // Retornar os dados com status de sucesso
                    return response()->json($resultados, 200);
                } catch (\Exception $e) {
                    // Se ocorrer uma exceção, retornar uma resposta de erro
                    return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
                }
            } else {
                $cursos = cursos()->where('cursos.estado', $estado)->get();
            }
            if ($cursos->isEmpty()) {
                return response()->json(['message' => 'Nenhum curso encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($cursos, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar curso.', 'error' => $e->getMessage()], 500);
        }
    }

    public function cadastrar(Request $request)
    {
        try {
            // return response()->json($request->all());

            $validador = Validator::make($request->all(), [
                'curso' => 'required',
                'duracao' => 'required',
                'descricao' => 'required',
                // 'vc_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                // 'vc_image'=>'required',
                // 'id_categoria_curso' => 'required',
                // 'id_user' => 'required',
            ], [
                'curso.required' => 'O campo Curso é obrigatório.',
                'duracao.required' => 'O campo Duração é obrigatório.',
                'descricao.required' => 'O campo Descrição é obrigatório.',
                // 'id_categoria_curso.required' => 'O campo Categoria do Curso é obrigatório.',
                // 'id_user.required' => 'O campo ID do Usuário é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);
            }

            // $image_path = $request->file('vc_image')->store('cursos', 'public');

            if ($request->hasFile('vc_image')) {
                $image_path = $request->file('vc_image')->store('cursos', 'public');
            } else {
                $image_path = ''; // ou qualquer valor padrão que você deseje
            }

            $curso = Curso::create([
                'curso' => $request->curso,
                'duracao' => $request->duracao,
                'descricao' => $request->descricao,
                'vc_image' => $image_path,
                // 'vc_image' =>$request->vc_image,
                // 'id_categoria_curso' => $request->id_categoria_curso,
                // 'id_user' => $request->id_user
                'id_categoria_curso' =>1,
                'id_user' =>1
            ]);
            if ($curso) {
                return response()->json(['message' => 'Registro efectuado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function ver($id)
    {
        $curso['data'] = Curso::where('id', $id)->first();

        if (!$curso) {
            return response()->json(['message' => 'Curso Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($curso,200);
    }

    public function actualizar(Request $request, $id)
    {
        try {
            $validador = Validator::make($request->all(), [
                'curso' => 'required',
                'duracao' => 'required',
                'descricao' => 'required',
                // 'vc_image' => 'required',
                // 'id_categoria_curso' => 'required',
                // 'id_user' => 'required',
            ], [
                'curso.required' => 'O campo Curso é obrigatório.',
                'duracao.required' => 'O campo Duração é obrigatório.',
                'descricao.required' => 'O campo Descrição é obrigatório.',
                // 'id_categoria_curso.required' => 'O campo Categoria do Curso é obrigatório.',
                // 'id_user.required' => 'O campo ID do Usuário é obrigatório.',
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $registro = Curso::find($id)->update([
                'curso' => $request->curso,
                'duracao' => $request->duracao,
                'descricao' => $request->descricao,
                 'vc_image' => $request->vc_image,
                'id_categoria_curso' => $request->id_categoria_curso,
                'id_user' => $request->id_user
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
                    'message' => "Curso " .$request->curso." Atualizado com sucesso",
                ], 200);
                // return response()->json("Usuario ".$request->vc_pnome." ".$request->vc_unome." Atualizado com sucesso", 200);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }
    public function por_criador($id_user)
    {
        try {

            $cursos = cursos()->where('cursos.id_user', $id_user)->get();
            if ($cursos->isEmpty()) {
                return response()->json(['message' => 'Nenhum  curso encontrado.'], 404);
            }
            // Retornar os dados com status de sucesso
            return response()->json($cursos, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar curso.', 'error' => $e->getMessage()], 500);
        }
    }
    public function eliminar2($id_curso)
    {
        try {
            $curso = Curso::find($id_curso);
            if ($curso) {
                $curso->delete();
                return response()->json(['message' => 'Registro  eliminado com sucesso.'], 200);
            } else {
                return response()->json(['message' => 'Registro  não encontrado.'], 400);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao eliminar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function eliminar($id)
    {
        try {
            $registro = Curso::find($id);
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
