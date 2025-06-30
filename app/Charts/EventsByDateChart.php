<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart as LarapexBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;
use App\Models\Event;
use Carbon\Carbon;

class EventsByDateChart
{
    public function build(): LarapexBarChart
    {
        $events = Event::all();

        $eventsByMonth = $events->groupBy(function ($date) {
            return Carbon::parse($date->date)->format('m');
        })->map(function ($item, $key) {
            return $item->count();
        })->sortKeys();

        $months = [];
        $data = [];

        $monthNames = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        for ($i = 1; $i <= 12; $i++) {
            $monthNum = str_pad($i, 2, '0', STR_PAD_LEFT);
            $months[] = $monthNames[$monthNum];
            $data[] = $eventsByMonth[$monthNum] ?? 0;
        }

        return (new LarapexBarChart)
            ->setTitle('Eventos por Mês')
            ->setSubtitle('Contagem de eventos ao longo do ano')
            ->addData('Número de Eventos', $data)
            ->setXAxisOption(new XAxisOption($months));
    }
}
