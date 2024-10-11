<?php

namespace App\Http\Controllers\Violations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserViolationController extends Controller
{
    public function getViolationAnalysis() {
        $chart = Chartjs::build()
         ->name('barChartTest')
         ->type('bar')
         ->labels(['Category 1', 'Category 2', 'Category 3'])
         ->datasets([
             [
                "label" => "User Violations",
                 'backgroundColor' => '#81C784',
                 'data' => [69,33,44]
             ],
            ])
         ->options([]);

         $chart->optionsRaw("{
            legend: {
                labels: {
                    fontColor: 'white',
                },
            },
            scales: {
                yAxes: [
                    {
                    ticks: {
                        fontColor: 'white',
                        beginAtZero: true,
                    },
                    },
                ],
                xAxes: [
                    {
                    ticks: {
                        fontColor: 'white',
                        beginAtZero: true,
                    },
                    },
                ],
            },
        }");
        return view('pages.violations.analysis', compact('chart'));
    }
}
