<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Curso;

class FeedBackController extends Controller
{
    //
    //
    public function index()
    {
        try {
            $registros = feedbacks()->get();
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
                'id_curso' => 'required',
                'feedback'=>'required'
            ], [
                'id_user.required' => 'O capo usuário(id do usuàrio) é obrigatório.',
                'id_curso.required' => 'O capo curso(id do curso) é obrigatório.',
                'feedback.required'=> 'O capo feedback é obrigatório.'
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $ehIscrito = inscricoes()->where('inscricaos.id_user', $request->id_user)
                ->where('id_curso', $request->id_curso)
                ->count();
            if (!$ehIscrito) {
                return response()->json(['message' => 'Você precisa estar inscrito no curso para fornecer feedback.'], 201);

            }
            $estado = FeedBack::where('id_user', $request->id_user)
                ->where('id_curso', $request->id_curso)
                ->count();
            if ($estado) {
                FeedBack::where('id_user', $request->id_user)
                    ->where('id_curso', $request->id_curso)
                    ->update($request->all());
                return response()->json(['message' => 'Feedback Actualizado com sucesso.'], 201);

            } else {
                $registro = FeedBack::create($request->all());
                if ($registro) {
                    return response()->json(['message' => 'Feedback enviado com sucesso.'], 201);
                } else {
                    return response()->json(['message' => 'Registro  não efectuado.'], 400);
                }
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
            $estado = FeedBack::where('id_user', $request->id_user)
                ->where('id_curso', $request->id_curso)
                ->count();
            if ($estado) {
                return response()->json(['message' => 'Não é possível adicionar um inscrição duplicada'], 409);
            }
            $registro = FeedBack::find($id);
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
            $registro = FeedBack::find($id);
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

            $curso = Curso::find($id_curso);
            if (!$curso) {
                return response()->json(['message' => 'Curso  não encontrado.'], 400);
            }
            // Contar o número de inscritos
            $inscritos = inscricoes()->where('inscricaos.id_curso', $id_curso)->count();

            // Inicializar o total de estrelas preenchidas
            $estrelas_preenchidas = 0;

            if ($inscritos > 0) {
                $registros = feedbacks()->where('feed_backs.id_curso', $id_curso)->get();
                if ($registros->isEmpty()) {
                    return response()->json(['message' => 'Nenhum registro encontrado.'], 200);
                }

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

                // Calcular a quantidade de estrelas a ser preenchida
                $estrelas_preenchidas = ceil(($percentual / 100) * 5);
            }

            // Formatar o resultado
            $resultado = [
                'curso' => $curso->curso ?? null,
                'categoria' => $curso->categoria,
                'votos' => $total_votos ?? 0,
                'total_inscritos' => $inscritos,
                'percentual' => $percentual ?? 0,
                'estrelas_preenchidas' => $estrelas_preenchidas,
                // 'feedbacks' => $registros->toArray()
            ];

            // Retornar os dados com status de sucesso
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
    public function por_curso_educandos($id_curso)
    {
        try {

            $curso = Curso::find($id_curso);
            if (!$curso) {
                return response()->json(['message' => 'Curso  não encontrado.'], 400);
            }
            // Contar o número de inscritos
            $inscritos = inscricoes()->where('inscricaos.id_curso', $id_curso)->where('users.perfil', 'Educando')->count();


            // Inicializar o total de estrelas preenchidas
            $estrelas_preenchidas = 0;

            if ($inscritos > 0) {
                $registros = feedbacks()->where('feed_backs.id_curso', $id_curso)
                    ->where('users.perfil', 'Educando')
                    ->get();
                if ($registros->isEmpty()) {
                    return response()->json(['message' => 'Nenhum registro encontrado.'], 200);
                }

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

                // Calcular a quantidade de estrelas a ser preenchida
                $estrelas_preenchidas = ceil(($percentual / 100) * 5);
                // Garantir que o percentual não ultrapasse 100%
                $percentual = min($percentual, 100);

                // Calcular a quantidade de estrelas a ser preenchida
                $estrelas_preenchidas = round(($percentual / 100) * 5);
            }

            // Formatar o resultado
            $resultado = [

                'curso' => $curso->curso ?? null,
                'categoria' => $curso->categoria,
                'votos' => $total_votos ?? 0,
                'total_inscritos' => $inscritos,
                'percentual' => $percentual ?? 0,
                'estrelas_preenchidas' => $estrelas_preenchidas,
                // 'feedbacks' => $registros->toArray()
            ];

            // Retornar os dados com status de sucesso
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
    public function por_curso_professor($id_curso)
    {
        try {

            $curso = Curso::find($id_curso);
            if (!$curso) {
                return response()->json(['message' => 'Curso  não encontrado.'], 400);
            }
            // Contar o número de inscritos
            $inscritos = inscricoes()->where('inscricaos.id_curso', $id_curso)->where('users.perfil', 'Educando')->count();


            // Inicializar o total de estrelas preenchidas
            $estrelas_preenchidas = 0;

            if ($inscritos > 0) {
                $registros = feedbacks()->where('feed_backs.id_curso', $id_curso)
                    ->where('users.perfil', 'Professor')
                    ->get();
                if ($registros->isEmpty()) {
                    return response()->json(['message' => 'Nenhum registro encontrado.'], 200);
                }

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

                // Calcular a quantidade de estrelas a ser preenchida
                $estrelas_preenchidas = ceil(($percentual / 100) * 5);
                // Garantir que o percentual não ultrapasse 100%
                $percentual = min($percentual, 100);

                // Calcular a quantidade de estrelas a ser preenchida
                $estrelas_preenchidas = round(($percentual / 100) * 5);
            }

            // Formatar o resultado
            $resultado = [
                'curso' => $curso->curso ?? null,
                'categoria' => $curso->categoria,
                'votos' => $total_votos ?? 0,
                'percentual' => $percentual ?? 0,
                'total_inscritos' => $inscritos,
                'estrelas_preenchidas' => $estrelas_preenchidas,
                // 'feedbacks' => $registros->toArray()
            ];

            // Retornar os dados com status de sucesso
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }

    public function estatistica()
    {
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
                $inscritos = inscricoes()->where('inscricaos.id_curso', $curso->id)->count();

                // Inicializar o total de estrelas preenchidas
                $estrelas_preenchidas = 0;

                if ($inscritos > 0) {
                    // Obter os registros de feedback apenas para o curso atual
                    $registros = feedbacks()->where('feed_backs.id_curso', $curso->id)->get();

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
                    'id_curso' => $curso->id ?? null,
                    'curso' => $curso->curso ?? null,
                    'categoria' => $curso->categoria,
                    'votos' => $total_votos ?? 0,
                    'total_inscritos' => $inscritos,

                    'percentual' => $percentual ?? 0,
                    'estrelas_preenchidas' => $estrelas_preenchidas,
                    // 'feedbacks' => $registros->toArray()
                ];

                $total_votos = 0;
                $inscritos = 0;
                $percentual = 0;
                $resultados[] = $resultado;
            }

            // Retornar os dados com status de sucesso
            return response()->json($resultados, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
    public function estatistica_entidade($entidade)
    {
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
                    ->where('users.perfil', $entidade)
                    ->count();

                // Inicializar o total de estrelas preenchidas
                $estrelas_preenchidas = 0;

                if ($inscritos > 0) {
                    // Obter os registros de feedback apenas para o curso atual
                    $registros = feedbacks()->where('feed_backs.id_curso', $curso->id)
                        ->where('users.perfil', $entidade)
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
                    'id_curso' => $curso->id ?? null,
                    'curso' => $curso->curso ?? null,
                    'categoria' => $curso->categoria,
                    'votos' => $total_votos ?? 0,
                    'total_inscritos' => $inscritos,

                    'percentual' => $percentual ?? 0,
                    'estrelas_preenchidas' => $estrelas_preenchidas,
                    // 'feedbacks' => $registros->toArray()
                ];

                $total_votos = 0;
                $inscritos = 0;
                $percentual = 0;
                $resultados[] = $resultado;
            }

            // Retornar os dados com status de sucesso
            return response()->json($resultados, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }

    public function meus_feedbacks($id_user)
    {
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
                    ->where('users.id', $id_user)
                    ->count();
                $total_inscritos = inscricoes()
                    ->where('inscricaos.id_curso', $curso->id)
                    // ->where('users.id', $id_user)
                    ->count();
                // Inicializar o total de estrelas preenchidas
                $estrelas_preenchidas = 0;

                if ($inscritos > 0) {
                    // Obter os registros de feedback apenas para o curso atual
                    $registros = feedbacks()->where('feed_backs.id_curso', $curso->id)
                        ->where('users.id', $id_user)
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
                    'id_curso' => $curso->id ?? null,
                    'curso' => $curso->curso ?? null,
                    'categoria' => $curso->categoria,
                    'votos' => $total_votos ?? 0,
                    'total_inscritos' => $inscritos,
                    'minha_inscricao' => $inscritos,
                    'percentual' => $percentual ?? 0,
                    'estrelas_preenchidas' => $estrelas_preenchidas,
                    // 'feedbacks' => $registros->toArray()
                ];

                $total_votos = 0;
                $inscritos = 0;
                $percentual = 0;
                $resultados[] = $resultado;
            }

            // Retornar os dados com status de sucesso
            return response()->json($resultados, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao buscar registros.', 'error' => $e->getMessage()], 500);
        }
    }
}
