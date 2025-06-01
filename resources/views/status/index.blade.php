<x-app-layout>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">Status Tempat Sampah</h1>
                    </div>

                    <!-- Waste Type Charts -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Capacity by Waste Type Chart -->
                        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kapasitas Berdasarkan Jenis Sampah (%)</h3>
                            <div id="wasteTypeCapacityChart" class="h-72"></div>
                        </div>
                        
                        <!-- Weight by Waste Type Chart -->
                        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Berat Berdasarkan Jenis Sampah (kg)</h3>
                            <div id="wasteTypeWeightChart" class="h-72"></div>
                        </div>
                    </div>

                    <!-- Individual Waste Type Charts -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Per Jenis Sampah</h2>
                    
                    <!-- Organik Charts -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sampah Organik</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Kapasitas (%)</h4>
                                <div id="organikCapacityChart" class="h-64"></div>
                            </div>
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Berat (kg)</h4>
                                <div id="organikWeightChart" class="h-64"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plastik Charts -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sampah Plastik</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Kapasitas (%)</h4>
                                <div id="plastikCapacityChart" class="h-64"></div>
                            </div>
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Berat (kg)</h4>
                                <div id="plastikWeightChart" class="h-64"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metal Charts -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sampah Metal</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Kapasitas (%)</h4>
                                <div id="metalCapacityChart" class="h-64"></div>
                            </div>
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Berat (kg)</h4>
                                <div id="metalWeightChart" class="h-64"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Residu Charts -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sampah Residu</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Kapasitas (%)</h4>
                                <div id="residuCapacityChart" class="h-64"></div>
                            </div>
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">Berat (kg)</h4>
                                <div id="residuWeightChart" class="h-64"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data for waste type charts
            const wasteTypeData = {
                types: ['Plastik', 'Residu', 'Metal', 'Organik'],
                capacity: [75, 45, 60, 85],
                weight: [12, 8, 15, 20]
            };

            // Weekly data for individual waste type charts
            const weeklyData = {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                organik: {
                    capacity: [80, 82, 85, 83, 87, 84, 85],
                    weight: [18, 19, 20, 19, 21, 20, 20]
                },
                plastik: {
                    capacity: [70, 72, 75, 78, 76, 74, 75],
                    weight: [10, 11, 12, 13, 12, 11, 12]
                },
                metal: {
                    capacity: [55, 58, 60, 62, 59, 57, 60],
                    weight: [14, 15, 15, 16, 15, 14, 15]
                },
                residu: {
                    capacity: [40, 42, 45, 47, 44, 43, 45],
                    weight: [7, 7, 8, 8, 8, 7, 8]
                }
            };

            // Capacity by Waste Type Chart
            const capacityOptions = {
                series: wasteTypeData.capacity,
                chart: {
                    type: 'donut',
                    height: 288,
                    toolbar: {
                        show: false
                    },
                    foreColor: '#374151'
                },
                labels: wasteTypeData.types,
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                value: {
                                    color: "#4b5563"
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: "#4b5563",
                                    formatter: function (w) {
                                        return Math.round(w.globals.seriesTotals.reduce((a, b) => a + b, 0) / w.globals.series.length) + '%';
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#1f2937']
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: '#4b5563'
                    }
                },
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + "%";
                        }
                    },
                    theme: 'light'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 260
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };


            // Weight by Waste Type Chart
            const weightOptions = {
                series: wasteTypeData.weight,
                chart: {
                    type: 'donut',
                    height: 288,
                    toolbar: {
                        show: false
                    },
                    foreColor: '#374151'
                },
                labels: wasteTypeData.types,
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                value: {
                                    color: "#4b5563"
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: "#4b5563",
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toFixed(1) + ' kg';
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#1f2937']
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: '#4b5563'
                    }
                },
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " kg";
                        }
                    },
                    theme: 'light'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 260
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };


            // Function to create line chart options
            function createLineChartOptions(data, title, color, valueFormatter) {
                return {
                    series: [{
                        name: title,
                        data: data
                    }],
                    chart: {
                        height: 256,
                        type: 'line',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        foreColor: '#374151'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    colors: [color],
                    xaxis: {
                        categories: weeklyData.labels,
                        labels: {
                            style: {
                                colors: '#4b5563'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return valueFormatter(val);
                            },
                            style: {
                                colors: '#4b5563'
                            }
                        }
                    },
                    tooltip: {
                        theme: 'light',
                        y: {
                            formatter: function(val) {
                                return valueFormatter(val);
                            }
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb',
                        strokeDashArray: 4
                    },
                    markers: {
                        size: 5
                    }
                };
            }


            // Render main charts
            const capacityChart = new ApexCharts(document.querySelector("#wasteTypeCapacityChart"), capacityOptions);
            capacityChart.render();

            const weightChart = new ApexCharts(document.querySelector("#wasteTypeWeightChart"), weightOptions);
            weightChart.render();

            // Render individual waste type charts
            // Organik
            new ApexCharts(
                document.querySelector("#organikCapacityChart"), 
                createLineChartOptions(weeklyData.organik.capacity, 'Kapasitas', '#ef4444', val => val + '%')
            ).render();
            
            new ApexCharts(
                document.querySelector("#organikWeightChart"), 
                createLineChartOptions(weeklyData.organik.weight, 'Berat', '#ef4444', val => val + ' kg')
            ).render();

            // Plastik
            new ApexCharts(
                document.querySelector("#plastikCapacityChart"), 
                createLineChartOptions(weeklyData.plastik.capacity, 'Kapasitas', '#3b82f6', val => val + '%')
            ).render();
            
            new ApexCharts(
                document.querySelector("#plastikWeightChart"), 
                createLineChartOptions(weeklyData.plastik.weight, 'Berat', '#3b82f6', val => val + ' kg')
            ).render();

            // Metal
            new ApexCharts(
                document.querySelector("#metalCapacityChart"), 
                createLineChartOptions(weeklyData.metal.capacity, 'Kapasitas', '#f59e0b', val => val + '%')
            ).render();
            
            new ApexCharts(
                document.querySelector("#metalWeightChart"), 
                createLineChartOptions(weeklyData.metal.weight, 'Berat', '#f59e0b', val => val + ' kg')
            ).render();

            // Residu
            new ApexCharts(
                document.querySelector("#residuCapacityChart"), 
                createLineChartOptions(weeklyData.residu.capacity, 'Kapasitas', '#10b981', val => val + '%')
            ).render();
            
            new ApexCharts(
                document.querySelector("#residuWeightChart"), 
                createLineChartOptions(weeklyData.residu.weight, 'Berat', '#10b981', val => val + ' kg')
            ).render();
        });
    </script>
    @endpush
</x-app-layout>