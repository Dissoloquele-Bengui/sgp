<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Mpdf\Mpdf;

class RelatorioController extends Controller
{
    public function gerar(Request $request){
        $data['pedidos']= Pedido::join('tipo_pedidos','tipo_pedidos.id','pedidos.id_tipo')
            ->join('users','pedidos.id_user','users.id')
            ->select('pedidos.*','users.name as user','tipo_pedidos.nome as tipo')
          //  ->orderBy('pedidos.id','DESC')
            ->get();
     // dd($request->id_tipo);
        $data['inicio'] = $request->inicio;
        $data['termino'] = $request->termino;
        if($request->inicio){
            $data['pedidos']=$data['pedidos']->where('created_at','>=',$request->inicio);
        }
        if($request->termino){
            $data['pedidos']=$data['pedidos']->where('created_at','<=',$request->termino);
        }
        if($request->id_tipo != "All"){
            $data['pedidos']=$data['pedidos']->where('id_tipo',$request->id_tipo);
        }
       // dd($data);
        if($request->tipo == "EXCEL"){
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('A1', 'Descrição');
            $sheet->setCellValue('B1', 'Data');
            $sheet->setCellValue('C1', 'Tipo de Pedido');
            $sheet->setCellValue('D1', 'Usuário');
            $sheet->setCellValue('E1', 'Estado');
            $sheet->getColumnDimension('A')->setWidth(35);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(69);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(69);

            $contador = 2;
            foreach($data['pedidos'] as $pedido){

                $sheet->setCellValue('A'.$contador, $pedido->descricao);
                $sheet->setCellValue('B'.$contador, $pedido->created_at);
                $sheet->setCellValue('C'.$contador, $pedido->tipo);
                $sheet->setCellValue('D'.$contador, $pedido->user);
                $sheet->setCellValue('E'.$contador, $pedido->estado);
                $sheet->getStyle('A'.$contador.':E'.$contador)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $contador++;
            }
            $linha = 1; // Número da linha que você deseja alterar a cor do fundo e do texto
            $sheet->getStyle('A'.$linha.':E'.$linha)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('7AD693'); // Cor azul
            $sheet->getStyle('A'.$linha.':E'.$linha)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE)); // Cor do texto branca

             // Definir altura das linhas
            $linhaInicial = 1; // Começando da primeira linha
            $linhaFinal = $contador - 1; // Terminando na última linha preenchida
            $altura = 30; // Altura desejada em pontos (1 ponto = 1/72 polegada)
            for ($linha = $linhaInicial; $linha <= $linhaFinal; $linha++) {
                $sheet->getRowDimension($linha)->setRowHeight($altura);
            }
            // Criar um objeto Writer para Excel
            $writer = new Xlsx($spreadsheet);

            $filename = 'Relatório dos Pedidos.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            // Enviar o conteúdo do arquivo para o navegador
            $writer->save('php://output');
        }else{
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
            $mpdf->SetFont("arial");
            ini_set('memory_limit', '15000M');
            ini_set("pcre.backtrack_limit", "300000M");
            ini_set("max_execution_time", "6000");
            //dd($data);
            $mpdf->setHeader();
            $html = view('admin.index',compact('data'));
            $mpdf->writeHTML($html);
            $mpdf->Output("Relatorio Dos Pedidos.pdf", "I");
        }
    }
}
