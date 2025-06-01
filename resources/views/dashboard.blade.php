<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <div class="max-w-[85dvw] mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight mb-8">
            {{ __('Dashboard') }}
        </h2>
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Trash Bins -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75 shadow-inner">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total Tempat Sampah</p>
                        <p class="text-3xl font-bold text-gray-700 mt-1">{{ $totalBins }}</p>
                    </div>
                </div>
            </div>

            <!-- Full Bins -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-rose-500 bg-opacity-75 shadow-inner">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Sampah Penuh</p>
                        <p class="text-3xl font-bold text-gray-700 mt-1">{{ $fullBins }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Bins -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-500 bg-opacity-75 shadow-inner">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Tempat Sampah Aktif</p>
                        <p class="text-3xl font-bold text-gray-700 mt-1">{{ $activeBins }}</p>
                    </div>
                </div>
            </div>

            <!-- New Notifications -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-amber-500 bg-opacity-75 shadow-inner">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Notifikasi Baru</p>
                        <p class="text-3xl font-bold text-gray-700 mt-1">{{ $unreadNotifications }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Waste Type Donut Chart -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-gray-700 mb-6 px-1">Total Sampah Berdasarkan Jenis</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Organic Waste Chart -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">Organik (kg)</h4>
                    <div id="organicWasteChart" class="h-60"></div>
                </div>
                
                <!-- Plastic Waste Chart -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">Plastik (kg)</h4>
                    <div id="plasticWasteChart" class="h-60"></div>
                </div>
                
                <!-- Paper Waste Chart -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">Kertas (kg)</h4>
                    <div id="paperWasteChart" class="h-60"></div>
                </div>
                
                <!-- Metal Waste Chart -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">Logam (kg)</h4>
                    <div id="metalWasteChart" class="h-60"></div>
                </div>
            </div>
        </div>

        <!-- Bin Status Chart and Recent Activities -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Capacity & Weight Chart -->
            <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <h3 class="text-xl font-bold text-gray-700 mb-6">Rata-Rata Kapasitas dan Berat (7 Hari Terakhir)</h3>
                <div id="binStatusChart" class="h-80"></div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 transition-all duration-300 hover:shadow-md border border-gray-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-gray-700">Notifikasi Terbaru</h3>
                    <a href="{{ route('notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-700 hover:underline flex items-center font-medium">
                        <span>Lihat Semua</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="space-y-4 max-h-[350px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 pr-2">
                    @forelse($recentNotifications as $notification)
                        <div class="flex items-start border-b border-gray-200 pb-4 hover:bg-gray-50 p-3 rounded-lg transition-colors duration-150">
                            <div class="p-2 {{ $notification->type == 'capacity_alert' ? 'bg-blue-100 text-blue-500' : 'bg-red-100 text-red-500' }} rounded-lg">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-700">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-40 text-gray-500 text-sm">
                            <svg class="w-12 h-12 mb-3 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p>Tidak ada notifikasi terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data for waste type charts from controller
            const wasteTypeData = {
                types: @json($wasteByType['types']),
                capacity: @json($wasteByType['capacity']),
                weight: @json($wasteByType['weight'])
            };

            // Chart for bin status with improved styling
            const options = {
                series: [{
                    name: 'Kapasitas Rata-Rata',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }, {
                    name: 'Berat Rata-Rata',
                    data: [30, 25, 40, 35, 28, 22, 18]
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    fontFamily: 'Inter, sans-serif',
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3
                    }
                },
                xaxis: {
                    categories: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    labels: {
                        style: {
                            colors: '#9ca3af',
                            fontFamily: 'Inter, sans-serif'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#9ca3af',
                            fontFamily: 'Inter, sans-serif'
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    }
                },
                grid: {
                    borderColor: '#e5e7eb',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                colors: ['#3b82f6', '#ef4444']
            };

            const chart = new ApexCharts(document.querySelector("#binStatusChart"), options);
            chart.render();
            
            // Create donut charts for waste types
            createDonutChart('organicWasteChart', wasteTypeData.weight[0] || 0, '#22c55e', 'Organik');
            createDonutChart('plasticWasteChart', wasteTypeData.weight[1] || 0, '#3b82f6', 'Plastik');
            createDonutChart('paperWasteChart', wasteTypeData.weight[2] || 0, '#f59e0b', 'Kertas');
            createDonutChart('metalWasteChart', wasteTypeData.weight[3] || 0, '#6366f1', 'Logam');
            
            function createDonutChart(elementId, value, color, label) {
                new ApexCharts(document.querySelector("#" + elementId), {
                    series: [value],
                    chart: {
                        type: 'donut',
                        height: 240,
                        fontFamily: 'Inter, sans-serif',
                        toolbar: { show: false },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800
                        }
                    },
                    colors: [color],
                    legend: { show: false },
                    dataLabels: { 
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + "%"
                        },
                        style: {
                            fontSize: '14px',
                            fontFamily: 'Inter, sans-serif',
                            fontWeight: 600
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: label,
                                        formatter: function(w) {
                                            return w.globals.seriesTotals[0] + ' kg'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    labels: [label]
                }).render();
            }
        });
    </script>
    @endpush
</x-app-layout>