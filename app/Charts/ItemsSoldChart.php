<?php

namespace App\Charts;



use marineusde\LarapexCharts\Charts\PieChart as LarapexPieChart;
use App\Models\Recipt;

class ItemsSoldChart
{



    public function build(): LarapexPieChart
    {
        $itemCounts = [];


        $recipts = Recipt::all();


        foreach ($recipts as $recipt) {


            $products = is_string($recipt->products ?? '') ? json_decode($recipt->products, true) : ($recipt->products ?? []);


            foreach ($products as $product) {
                $productName = $product['name'] ?? 'Produto Desconhecido';
                $productQuantity = $product['quantity'] ?? 0;


                $itemCounts[$productName] = ($itemCounts[$productName] ?? 0) + $productQuantity;
            }
        }


        $labels = array_keys($itemCounts);
        $data = array_values($itemCounts);


        return (new LarapexPieChart)
            ->setTitle('Itens Mais Vendidos')
            ->setSubtitle('Contagem total de cada item nos recibos')
            ->addData($data)
            ->setLabels($labels);
    }
}
