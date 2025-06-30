<?php

namespace App\Http\Controllers;

use App\Models\Recipt; // Importe o modelo Recipt
use App\Models\Event;  // Importe o modelo Event
use Illuminate\Support\Facades\DB; // Para queries de banco de dados

class AdminController extends Controller
{
    public function index()
    {
        // 1. Dados para "Produtos Mais Pedidos" (Pie Chart)
        // Isso assume que sua coluna 'products' no modelo Recipt armazena um JSON.
        // Se 'products' for uma relação (ex: Recipt hasMany ReciptItem), a query seria diferente.
        $topProducts = Recipt::select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(products, "$.name")) as product_name'), DB::raw('SUM(JSON_UNQUOTE(JSON_EXTRACT(products, "$.quantity"))) as total_quantity'))
            ->where('status', 'completed') // Opcional: considerar apenas recibos concluídos
            ->get()
            ->groupBy('product_name') // Agrupa por nome de produto (pode precisar de ajuste se o JSON for mais complexo)
            ->map(function ($group) {
                // Soma as quantidades para o mesmo produto, caso JSON_EXTRACT não agrupe perfeitamente
                $totalQuantity = 0;
                foreach ($group as $item) {
                    $totalQuantity += (int)$item->total_quantity;
                }
                return [
                    'product_name' => $group->first()->product_name,
                    'total_quantity' => $totalQuantity
                ];
            })
            ->sortByDesc('total_quantity')
            ->take(10) // Top 10 produtos
            ->values()
            ->toArray();

        // Se sua coluna 'products' no Recipt é um JSON que representa um ARRAY de produtos,
        // a query para topProducts seria mais complexa e provavelmente exigiria iteração em PHP ou uma query mais avançada de JSON_TABLE (MySQL 8+)
        // Para simplificar, vou assumir um JSON simples ou que o JSON_EXTRACT pode pegar o nome e quantidade de um item.
        // Se 'products' é um array de objetos JSON como '[{"name":"Cerveja A", "quantity":2}, {"name":"Cerveja B", "quantity":1}]',
        // você precisaria de uma lógica mais robusta para extrair e somar as quantidades.
        // Uma abordagem mais robusta para JSON arrays seria:
        $topProductsFromReciptItems = DB::table('recipts')
            ->select(
                DB::raw("products_data.product_name"),
                DB::raw("SUM(products_data.quantity) as total_quantity")
            )
            ->fromSub(function ($query) {
                $query->select(
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(recipts.products, CONCAT('$[', numbers.n, '].name'))) as product_name"),
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(recipts.products, CONCAT('$[', numbers.n, '].quantity'))) as quantity")
                )
                    ->from('recipts')
                    ->join(
                        DB::raw("(SELECT 0 as n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) as numbers"),
                        function ($join) {
                            $join->on(DB::raw('JSON_LENGTH(recipts.products) > numbers.n'));
                        }
                    );
            }, 'products_data')
            ->groupBy('products_data.product_name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get()
            ->toArray();


        // 2. Dados para "Eventos por Mês" (Bar Chart)
        $eventsPerMonth = Event::select(DB::raw('MONTH(event_date) as month'), DB::raw('COUNT(*) as total_events'))
            ->groupBy(DB::raw('MONTH(event_date)'))
            ->orderBy(DB::raw('MONTH(event_date)'))
            ->get()
            ->toArray();

        // Passa os dados para a view
        return view('index', [ // Apenas 'index' se o arquivo for resources/views/index.blade.php
            'topProducts' => $topProductsFromReciptItems,
            'eventsPerMonth' => $eventsPerMonth,
        ]);
    }
}
