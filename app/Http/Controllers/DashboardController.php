<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\TempatSampah;
use App\Models\Notifikasi;
use App\Models\RiwayatPembuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $trashBins = TempatSampah::all();
        
        // Count total trash bins
        $totalBins = $trashBins->count();
        
        // Count full bins
        $fullBins = $trashBins->filter(function($bin) {
            return $bin->status === 'Penuh';
        })->count();
        
        // Count active bins
        $activeBins = $trashBins->where('status', 'Normal')->count();
        
        // Count unread notifications
        $unreadNotifications = Notifikasi::where('status_baca', false)->count();
        
        // Get recent notifications
        $recentNotifications = Notifikasi::with('tempatSampah')
            ->orderBy('waktu_notifikasi', 'desc')
            ->take(5)
            ->get();
        
        // Get waste data by type for donut chart
        $wasteByType = $this->getWasteDataByType();
        
        return view('dashboard', compact(
            'trashBins', 
            'totalBins', 
            'fullBins', 
            'activeBins', 
            'unreadNotifications',
            'recentNotifications',
            'wasteByType'
        ));
    }
    
    /**
     * Get waste data aggregated by type for charts
     * 
     * @return array
     */
    private function getWasteDataByType()
    {
        // Define waste types
        $wasteTypes = ['organik', 'plastik', 'metal', 'residu'];
        
        // Get total weight by waste type
        $weightByType = RiwayatPembuangan::select('jenis_sampah', DB::raw('SUM(berat_sampah_dibuang) as total_weight'))
            ->whereIn('jenis_sampah', $wasteTypes)
            ->groupBy('jenis_sampah')
            ->get()
            ->pluck('total_weight', 'jenis_sampah')
            ->toArray();
        
        // Format data for chart
        $formattedTypes = [];
        $formattedWeights = [];
        $dummyCapacity = [85, 75, 60, 45]; // Dummy capacity data for chart
        
        foreach ($wasteTypes as $index => $type) {
            // Capitalize first letter for display
            $formattedTypes[] = ucfirst($type);
            
            // Get weight or default to 0
            $formattedWeights[] = isset($weightByType[$type]) ? round($weightByType[$type], 1) : 0;
        }
        
        return [
            'types' => $formattedTypes,
            'weight' => $formattedWeights,
            'capacity' => $dummyCapacity // Add dummy capacity data
        ];
    }
}