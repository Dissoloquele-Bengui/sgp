<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logger;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
  //
  public function __construct(){

    $this->logger=new Logger();

}
  public function loggerData($mensagem){

    $this->logger->Log('info',$mensagem);
}
  public function index()
  {
    $response['utilizadores'] = User::get();
    return view('admin.utilizadores.index', $response);
  }
  public function store(Request $request)
  {
    try{
    // dd($request->password==$request->passeConfirm);
    if (!($request->password == $request->passeConfirm)) {
      return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro de confirmação de Palavra Passe!']);
    }

    $caminho = upload_file($request, 'profile_photo_path', 'user/img');
    // dd( $request,  $caminho );
    $user = User::create($request->all());
    if ($caminho) {
      User::find($user->id)->update(
        ['profile_photo_path' => $caminho]
      );
    }
    if ($request->password) {
      // dd($request->password);
      // dd(   Hash::make($request->password));
      $i = User::find($user->id)->update(
        ['password' => Hash::make($request->password)]
      );
      // dd($i);
    }
    return redirect()->back()->with('success', ['status' => '1', 'sms' => 'Usuário Cadastrado Com Sucesso!']);
  }catch (\Throwable $th) {

    return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'O e-mail deve ser único para cada utilizador !']);


  }
  }
  public function update(Request $request, $id)
  {
    // dd($request->password==$request->passeConfirm);
    if (!($request->password == $request->passeConfirm)) {
      return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro de confirmação de Palavra Passe!']);
    }

    $caminho = upload_file($request, 'profile_photo_path', 'user/img');
    // dd( $request,  $caminho );
    $password = $request->password;
    User::find($id)->update($request->except(['password']));
    if ($caminho) {
      User::find($id)->update(
        ['profile_photo_path' => $caminho]
      );
    }
    if ($password) {
      // dd($password);
      // dd(   Hash::make($request->password));
      $i = User::find($id)->update(
        ['password' => Hash::make($password)]
      );
      // dd($i);
    }
    return redirect()->back()->with('success', ['status' => '1', 'sms' => 'Usuário Editado Com Sucesso!']);

  }
  public function destroy(int $id)
  {
    //
    try {
      //code...
      $user = User::findOrFail($id);
      User::findOrFail($id)->delete();
      $this->loggerData(" Eliminou  utilizador de nome  ($user->name)");
      return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Usuário Eliminado Com Sucesso!']);
    } catch (\Throwable $th) {

      return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao  Eliminar Usuário!']);


    }
  }

  public function purge(int $id)
  {
    //
    try {
      // dd("o");
      //code...
      $user = User::findOrFail($id);
      User::findOrFail($id)->forceDelete();
      $this->loggerData(" Purgou utilizador de nome  ($user->name)");
      return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Usuário Eliminado Com Sucesso!']);
    } catch (\Throwable $th) {

      return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao  Eliminar Usuário!']);

    }
  }

}
