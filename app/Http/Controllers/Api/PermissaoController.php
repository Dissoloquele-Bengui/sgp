<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissao;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;

class PermissaoController extends Controller
{

    public function index()
    {


        try {
            $registros = Permissao::join('tipo_usuarios','tipo_usuarios.id','permissaos.id_tipo_user')
                ->join('tipo_pedidos','tipo_pedidos.id','permissaos.id_tipo_pedido')
                ->select('permissaos.*','tipo_pedidos.nome as tipo_pedido','tipo_usuarios.nome as tipo_usuario')
                ->get();
            if ($registros->isEmpty()) {
                return response()->json(['message' => 'Nenhum tipo de pedido encontrado.'], 200);
            }
            return response()->json($registros, 200);
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao recuperar tipos de pedidos.', 'error' => $e->getMessage()], 500);
        }
    }
    public function cadastrar(Request $request)
    {
        try {

            $validator = FacadesValidator::make($request->all(), [

                "tipo" => "required",
            ], [
                'tipo.required' => 'O tipo é obrigatório.',
            ]);
            if($validator->fails()){

                // dd('require');
                return response()->json([
                    'status' => 422,
                    'message' => "Preencher os pareceres obrigatórios",
                ],422);


            }
            $parecer = Permissao::create([
                'id_tipo_user' => $request->id_tipo_usuario,
                'tipo' => $request->tipo,
                'id_tipo_pedido' => $request->id_tipo_pedido,
            ]);

            if ($parecer) {
                $ultimoUsuario = Permissao::latest()->first();

                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$ultimoUsuario->estado." Cadstrado com sucesso",
                ], 200);
            } else {
                return response()->json(['message' => 'Registro  não efectuado.'], 400);
            }
        } catch (\Throwable $e) {
            throw $e;
            return response()->json($e);
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar registro.', 'error' => $e->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id)
    {
        try {
            $parecerFind = Permissao::where('email', $request->email)->first(); // obtém o ID do usuário autenticado
            if (auth()->id()) {
                $parecerId = auth()->id();
            } else {
                $parecerId = $parecerFind->id;
            }
            $validator = Validator::make($request->all(), [
                'tipo' => 'required',
            ], [
                'tipo.required' => 'O tipo  é obrigatório.',
            ]);
            if ($validator->fails()) {
                return response()->json($validador->errors(), 422);
            }
            $parecer = Permissao::find($id);



            $validated = $validator->validated();
            $registro = Permissao::find($id)->update([
                'id_tipo_user' => $request->id_tipo_user,
                'tipo' => $request->tipo,
                'id_tipo_pedido' => $request->id_tipo_pedido,
            ]);

            if(!$registro){
                return response()->json([
                    'status' => 400,
                    'message' => "Erro ao atualizar",
                ], 400);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => "Tipo de Usuario " .$request->estado." Atualizado com sucesso",
                ], 200);
            }

        } catch (\Exception $e) {
            // Se ocorrer uma exceção, retornar uma resposta de erro
            return response()->json(['message' => 'Erro ao efectuar actualizaçao.', 'error' => $e->getMessage()], 500);
        }
    }

    public function isPermitParecer($id, $id_tipo_pedido){
        $id = intval($id);
        $id_tipo_pedido = intval($id_tipo_pedido);
        return Permissao::where('id_tipo_user',$id)
            ->where('id_tipo_pedido',$id_tipo_pedido)
            ->where('tipo',"Parecer")
            ->count();
    }
    public function isPermitDecisao($id, $id_tipo_pedido){
        $id = intval($id);
        $id_tipo_pedido = intval($id_tipo_pedido);
        return Permissao::where('id_tipo_user',$id)
            ->where('id_tipo_pedido',$id_tipo_pedido)
            ->where('tipo',"Decisão")
            ->count();
    }
    public function isPermit($id, $id_tipo_pedido){
        return Permissao::where('id_tipo_user',$id)
            ->where('id_tipo_pedido',$id_tipo_pedido)
            ->count();
    }
    public function ver($id)
    {
        $parecer['data'] = Permissao::where('id', $id)->first();

        if (!$parecer) {
            return response()->json(['message' => 'Campo Não Encontrado'], 200);
        }

        // return new PermissaoResource($parecer);
        return response()->json($parecer,200);
    }



    public function eliminar($id)
    {
        try {
            $registro = Permissao::find($id);
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
