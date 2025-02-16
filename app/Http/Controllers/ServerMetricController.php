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

        return view('server-metrics.index', compact('metrics', 'selectedDate'));
    }
}
