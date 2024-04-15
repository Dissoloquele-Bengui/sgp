<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaTituloHabilitante;
use Illuminate\Http\Request;
use App\Models\Logger;

class HomeController extends Controller
{
    //
    public function __construct()
    {

        $this->logger = new Logger();

    }
    public function loggerData($mensagem)
    {

        $this->logger->Log('info', $mensagem);
    }
    public function index()
    {
      
       
        // $response=licencas_operadores();
        // dd( $response);
        // return redirect('/mru');
        return view('lab.index');

    }
}
