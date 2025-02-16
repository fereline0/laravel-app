<x-dashboard-layout>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div class="space-y-4">

      <form method="GET" action="{{ route('dashboard.server-metrics.index') }}" class="mb-4">
          <x-bladewind::datepicker class="rounded-md" name="selected_date" placeholder="Выберите дату" default_date="{{ $selectedDate }}" />
          <x-bladewind::button can_submit="true">Фильтровать</x-bladewind::button>
      </form>
      
      @foreach ($metrics as $serverName => $serverMetrics)
          @php
              $safeServerName = str_replace([' ', '-', '.', ':'], '_', $serverName);

              $labels = $serverMetrics->pluck('created_at')->map(function($date) {
                  return \Carbon\Carbon::parse($date)->format('H:i');
              });

              $cpuData = $serverMetrics->pluck('cpu_usage');
              $memoryData = $serverMetrics->pluck('memory_usage');
              $diskData = $serverMetrics->pluck('disk_usage');
          @endphp

          <x-bladewind::card>
              <h3 class="text-lg font-semibold">{{ $serverName }}</h3>
              <canvas id="metricsChart_{{ $safeServerName }}" width="400" height="200"></canvas>

              <script>
                  const ctx_{{ $safeServerName }} = document.getElementById('metricsChart_{{ $safeServerName }}').getContext('2d');
                  const metricsData_{{ $safeServerName }} = {
                      labels: {!! json_encode($labels) !!},
                      datasets: [
                          {
                              label: 'Процессор',
                              data: {!! json_encode($cpuData) !!},
                              borderColor: 'rgba(255, 99, 132, 1)',
                              backgroundColor: 'rgba(255, 99, 132, 0.2)',
                          },
                          {
                              label: 'Оперативная память',
                              data: {!! json_encode($memoryData) !!},
                              borderColor: 'rgba(54, 162, 235, 1)',
                              backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          },
                          {
                              label: 'Диск',
                              data: {!! json_encode($diskData) !!},
                              borderColor: 'rgba(75, 192, 192, 1)',
                              backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          }
                      ]
                  };

                  const metricsChart_{{ $safeServerName }} = new Chart(ctx_{{ $safeServerName }}, {
                      type: 'line',
                      data: metricsData_{{ $safeServerName }},
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                  });
              </script>
          </x-bladewind::card>
      @endforeach
  </div>
</x-dashboard-layout>