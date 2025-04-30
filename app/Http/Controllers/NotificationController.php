<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->orderBy('is_read')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);
        
        $this->notificationService->markAsRead($notification);
        return view('notifications.show', compact('notification'));
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()
            ->update(['is_read' => true]);
            
        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);
        
        $notification->delete();
        return back()->with('success', 'Notification deleted successfully.');
    }
}