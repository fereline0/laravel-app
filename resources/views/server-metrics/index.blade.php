<x-dashboard-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="space-y-4">

        <form method="GET" action="{{ route('dashboard.server-metrics.index') }}" class="mb-4">
            <x-bladewind::datepicker class="rounded-md" name="selected_date" placeholder="Выберите дату" default_date="{{ $selectedDate }}" />
            <x-bladewind::button can_submit="true">Фильтровать</x-bladewind::button>
        </form>
        
        @foreach ($chartData as $serverName => $data)
            <x-bladewind::card>
                <h3 class="text-lg font-semibold">{{ $serverName }}</h3>
                <canvas id="metricsChart_{{ $data['safeName'] }}" width="400" height="200"></canvas>

                <script>
                    const ctx_{{ $data['safeName'] }} = document.getElementById('metricsChart_{{ $data['safeName'] }}').getContext('2d');
                    const metricsData_{{ $data['safeName'] }} = {
                        labels: {!! json_encode($data['labels']) !!},
                        datasets: [
                            {
                                label: 'Процессор',
                                data: {!! json_encode($data['cpu']) !!},
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            },
                            {
                                label: 'Оперативная память',
                                data: {!! json_encode($data['memory']) !!},
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            },
                            {
                                label: 'Диск',
                                data: {!! json_encode($data['disk']) !!},
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            }
                        ]
                    };

                    const metricsChart_{{ $data['safeName'] }} = new Chart(ctx_{{ $data['safeName'] }}, {
                        type: 'line',
                        data: metricsData_{{ $data['safeName'] }},
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