<?php

namespace App\Http\Controllers;

use App\Models\ServerMetric;
use Illuminate\Http\Request;

class ServerMetricController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        $metrics = ServerMetric::whereDate('created_at', $selectedDate)
            ->get()
            ->groupBy('server_name');

        $chartData = [];
        foreach ($metrics as $serverName => $serverMetrics) {
            $chartData[$serverName] = [
                'safeName' => str_replace([' ', '-', '.', ':'], '_', $serverName),
                'labels' => $serverMetrics->pluck('created_at')->map(function($date) {
                    return \Carbon\Carbon::parse($date)->format('H:i');
                }),
                'cpu' => $serverMetrics->pluck('cpu_usage'),
                'memory' => $serverMetrics->pluck('memory_usage'),
                'disk' => $serverMetrics->pluck('disk_usage'),
            ];
        }

        return view('server-metrics.index', compact('chartData', 'selectedDate'));
    }
}