<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\LokasiTempatSampahDataTable;
use App\Models\TempatSampah;
use App\Models\RiwayatPembuangan;
use Illuminate\Support\Facades\DB;

class TempatSampahController extends Controller
{
    public function location(LokasiTempatSampahDataTable $dataTable){
        // Get all trash bin locations
        $locations = TempatSampah::select('id', 'alamat_deskripsi', 'latitude', 'longitude', 'status')
            ->get()
            ->map(function($bin) {
                return [
                    'lat' => (float) $bin->latitude,
                    'long' => (float) $bin->longitude,
                    'info' => "<strong>ID: {$bin->id}</strong><br>Alamat: {$bin->alamat_deskripsi}<br>Status: {$bin->status}"
                ];
            })
            ->toArray();
            
        return $dataTable->render('location.index', compact('locations'));
    }
    
    public function dashboard()
    {
        // Get all trash bins
        $tempatSampah = TempatSampah::all();
        
        // Count total, full, and active bins
        $totalBins = $tempatSampah->count();
        $fullBins = $tempatSampah->where('status', 'Penuh')->count();
        $activeBins = $tempatSampah->where('status', 'Normal')->count();
        
        // Get waste type statistics from disposal history
        $wasteTypeStats = RiwayatPembuangan::select('jenis_sampah', 
            DB::raw('COUNT(*) as total_count'),
            DB::raw('SUM(berat_sampah_dibuang) as total_weight'))
            ->groupBy('jenis_sampah')
            ->get();
            
        // Calculate average capacity and weight by waste type
        $wasteTypeCapacity = [];
        foreach (['plastik', 'residu', 'metal', 'organik'] as $type) {
            $bins = TempatSampah::whereHas('riwayatPembuangan', function($query) use ($type) {
                $query->where('jenis_sampah', $type);
            })->get();
            
            if ($bins->count() > 0) {
                $avgCapacity = $bins->avg('kapasitas_saat_ini') / $bins->avg('kapasitas_maksimal') * 100;
                $avgWeight = $bins->avg('berat_saat_ini');
                
                $wasteTypeCapacity[$type] = [
                    'capacity_percent' => round($avgCapacity, 2),
                    'weight' => round($avgWeight, 2),
                    'bin_count' => $bins->count()
                ];
            }
        }
        
        // Get weekly data for chart
        $weeklyData = $this->getWeeklyData();
        
        return view('status.index', compact(
            'totalBins', 
            'fullBins', 
            'activeBins', 
            'wasteTypeStats', 
            'wasteTypeCapacity',
            'weeklyData'
        ));
    }
    
    private function getWeeklyData()
    {
        // Get data for the last 7 days
        $dates = [];
        $capacityData = [];
        $weightData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('D');
            
            // Get average capacity and weight for this day
            $dayStats = TempatSampah::whereDate('terakhir_diperbarui', $date)
                ->selectRaw('AVG(kapasitas_saat_ini / kapasitas_maksimal * 100) as avg_capacity, AVG(berat_saat_ini) as avg_weight')
                ->first();
                
            $capacityData[] = $dayStats ? round($dayStats->avg_capacity, 2) : 0;
            $weightData[] = $dayStats ? round($dayStats->avg_weight, 2) : 0;
        }
        
        return [
            'labels' => $dates,
            'capacity' => $capacityData,
            'weight' => $weightData
        ];
    }
}