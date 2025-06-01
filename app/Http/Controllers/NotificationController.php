<?php
// app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index()
    {
        $notifications = Notifikasi::with('tempatSampah')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $unreadCount = Notifikasi::where('status_baca', false)->count();
        
        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notifikasi::findOrFail($id);
        $notification->status_baca = true;
        $notification->save();
        
        return redirect()->back()
            ->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notifikasi::where('status_baca', false)
            ->update(['status_baca' => true]);

        return redirect()->back()
            ->with('success', 'Semua notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy($id)
    {
        $notification = Notifikasi::findOrFail($id);
        $notification->delete();
        
        return redirect()->back()
            ->with('success', 'Notifikasi berhasil dihapus.');
    }
    
    /**
     * Get unread notifications count.
     */
    public function getUnreadCount()
    {
        $count = Notifikasi::where('status_baca', false)->count();
        
        return response()->json([
            'count' => $count
        ]);
    }
    
    /**
     * Get recent notifications for dashboard.
     */
    public function getRecentNotifications()
    {
        $notifications = Notifikasi::with('tempatSampah')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return response()->json([
            'notifications' => $notifications
        ]);
    }
}