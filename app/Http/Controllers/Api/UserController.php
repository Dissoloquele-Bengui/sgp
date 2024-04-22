<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    //~

    public function index()
    {


        try {

            $registros = users()->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum  curso encontrado.'], 200);
            }
            // Retornar os dados com status de sucesso
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar utilizadores.', 'error' => $e->getMessage()], 500);
        }
    }
    public function cadastrar(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                "name" => "required",
                "vc_pnome" => "required",
                "vc_nome_meio" => "required",
                "vc_unome" => "required",
                // 'name' => 'required',
                // 'telefone' => 'required',
                // 'genero' => 'required',
                // 'bi' => 'required|unique:users',
                // 'email' => 'required|email|unique:users',
                // 'perfil' => 'required',
                // 'password' => 'required',
            ], [
                'name.required' => 'O campo nome completo é obrigatório.',
                'name.required' => 'O campo nome completo é obrigatório.',
                'name.required' => 'O campo nome completo é obrigatório.',
                // 'telefone.required' => 'O campo telefone é obrigatório.',
                // 'genero.required' => 'O campo gênero é obrigatório.',
                // 'bi.required' => 'O campo bi é obrigatório.',
                // 'bi.unique' => 'Este número de bi já está em uso.',
                // 'email.required' => 'O campo email é obrigatório.',
                // 'email.email' => 'Por favor, insira um endereço de email válido.',
                // 'email.unique' => 'Este email já está em uso.',
                // 'perfil.required' => 'O campo perfil é obrigatório.'
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os campos obrigatórios",
                ],422);


            }
            // $user = User::create([
            //     'name' => $request->name, // Supondo que o campo name seja usado para o nome do usuário
            //     'telefone' => $request->telefone,
            //     'genero' => $request->genero,
            //     'bi' => $request->bi,
            //     'email' => $request->email,
            //     'perfil' => $request->perfil,
            //     'password' => Hash::make($request->password)
            // ]);

            $user = user::create($validator->validated());

            // $caminho = upload_file($request, 'profile_photo_path', 'user/img');
            // dd( $request,  $caminho );
            // if ($caminho) {
            //     User::find($user->id)->update(
            //         ['profile_photo_path' => $caminho]
            //     );
            // }
            if ($user) {
                $ultimoUsuario = User::latest()->first();
                // return response()->json(['message' => 'Registro efectuado com sucesso.','data'=>$user], 201);
                return response()->json([
                    'status' => 200,
                    'message' => "Usuario " .$ultimoUsuario->vc_pnome.' '.$ultimoUsuario->vc_unome ." Cadstrado com sucesso",
                ], 200);
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
            $userFind = User::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $userId = auth()->id();
            } else {
                $userId = $userFind->id;
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                "vc_pnome" => "required",
                "vc_nome_meio" => "required",
                "vc_unome" => "required",
                // 'telefone' => 'required',
                // 'genero' => 'required',
                // 'bi' => 'required|unique:users,bi,' . $userId,
                // 'email' => 'required|email|unique:users,email,' . $userId,
                // 'perfil' => 'required',

            ], [
                'name.required' => 'O campo nome completo é obrigatório.',
                'name.required' => 'O campo nome completo é obrigatório.',
                'name.required' => 'O campo nome completo é obrigatório.',
                'name.required' => 'O campo nome completo é obrigatório.',

                // 'telefone.required' => 'O campo telefone é obrigatório.',
                // 'genero.required' => 'O campo gênero é obrigatório.',
                // 'bi.required' => 'O campo bi é obrigatório.',
                // 'bi.unique' => 'Este número de bi já está em uso.',
                // 'email.required' => 'O campo email é obrigatório.',
                // 'email.email' => 'Por favor, insira um endereço de email válido.',
                // 'email.unique' => 'Este email já está em uso.',
                // 'perfil.required' => 'O campo perfil é obrigatório.'
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $user = User::find($id);




            $validated = $validator->validated();
            $registro = user::find($id)->update([
                "name" => $validated["name"],
                "vc_pnome" => $validated["vc_pnome"],
                "vc_nome_meio" => $validated["vc_nome_meio"],
                "vc_unome" => $validated["vc_unome"],
                // "genero" => $validated["genero"],
                // "ativo" => $validated["ativo"],
                // "img" => $validated["img"],
                // "nivel_acesso"=> $validated["nivel_acesso"],
                // "password" => $validated["password"],
                // "email" => $validated["email"],
                // "telefone" => $validated["telefone"],
            ]);

            // dd($registro);

            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
                // return $this->error("Erro ao atualizar Usuario ",400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Usuario " .$request->vc_pnome.' '.$request->vc_unome ." Atualizado com sucesso",
                ], 200);
                // return response()->json("Usuario ".$request->vc_pnome." ".$request->vc_unome." Atualizado com sucesso", 200);
            }

            // if ($registro) {
            //     $registro->update([
            //         'name' => $request->name, // Supondo que o campo name seja usado para o nome do usuário
            //         'telefone' => $request->telefone,
            //         'genero' => $request->genero,
            //         'bi' => $request->bi,
            //         'email' => $request->email,
            //         'perfil' => $request->perfil,
            //     ]);
            //     return response()->json(['message' => 'Registro actualizado com sucesso.'], 201);
            // } else {
            //     return response()->json(['message' => 'Actualização  não efectuada, registro não econtrado.'], 400);
            // }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver($id)
    {
        $user['data'] = user::where('id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário Não Encontrado'], 200);
        }

        // return new UserResource($user);
        return response()->json($user,200);
    }


    public function actualizar_password (Request $request, $id)
    {
        try {

            $validador = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
            ], [
                'password.required' => 'O campo palavra passe é obrigatório.',
                'password.min' => 'A password deve ter no mínimo 8 caracteres',
                'password.confirmed' => 'A confirmação da senha não coincide',
            ]);
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }

            $registro = User::find($id);

            if ($registro) {
                $registro->update([
                    'password' => Hash::make($request->password)
                ]);
                return response()->json(['message' => 'Registro actualizado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Actualização  não efectuada, usuário não encontrado.'], 404);
            }
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }

    public function recuperar_password(Request $request, $id)
    {
        try {

            $validador = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ], [
                'current_password.required' => 'A senha atual é obrigatória.',
                'password.required' => 'A nova senha é obrigatória.',
                'password.min' => 'A nova senha deve ter no mínimo 8 caracteres',
                'password.confirmed' => 'A confirmação da nova senha não coincide',
            ]);

            $userActual = User::find($id);
            if (!Hash::check($request->current_password, $userActual->password)) {
                $validador->errors()->add('current_password', 'A senha atual está incorreta.');
                return response()->json($validador->errors(), 422);
            }
            if ($validador->fails()) {
                return response()->json($validador->errors(), 422);
            }

            $registro = User::find($id);

            if ($registro) {
                $registro->update([
                    'password' => $request->password
                ]);
                return response()->json(['message' => 'Registro actualizado com sucesso.'], 201);
            } else {
                return response()->json(['message' => 'Actualização  não efectuada, usuário não encontrado.'], 404);
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
    public function eliminar($id)
    {
        try {
            $registro = User::find($id);
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
