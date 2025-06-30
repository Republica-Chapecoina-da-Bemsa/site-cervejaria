<?php

namespace App\Http\Controllers;

use App\Models\Recipt;
use Barryvdh\DomPDF\Facade\PDF;
use App\Charts\ItemsSoldChart;
use Illuminate\Http\Request;

class ReciptController extends Controller
{
    public function index()
    {
        $recipts = Recipt::all();
        return view('recipt.list', [
            'receipts' => $recipts,
        ]);
    }
    public function generateRecipt(Recipt $recipt)
    {


        $data = [
            'receipt' => $recipt,
        ];

        $pdf = Pdf::loadView('recipt.report', $data);
        return $pdf->download('relatorio_listagem_product.pdf');
    }
    public function chart(ItemsSoldChart $chart)
    {
        return view('recipt.chart', ['chart' => $chart->build()]);
    }
}
