<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\TipoPedido;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function data(){
        $data['pedidosCount']= Pedido::count();
        $data['pedidosConcluidos']= Pedido::where('estado',"Aprovado")
        ->count();
        $data['pedidosPendentes']= Pedido::where('estado',"Aguardando Parecer")
        ->count();
        $data['tiposCount']= TipoPedido::count();
        return response()->json($data);
    }
}
