<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        // Mark as read
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }
}
