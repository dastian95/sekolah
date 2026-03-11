<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\News;
use App\Models\TransferStudent;
use App\Models\ContactMessage;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'aktif')->count();
        $graduatedStudents = Student::where('status', 'lulus')->count();
        $totalNews = News::count();
        $publishedNews = News::where('is_published', true)->count();
        $totalTransfers = TransferStudent::count();
        $pendingTransfers = TransferStudent::where('status', 'pending')->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $totalMessages = ContactMessage::count();

        // Siswa terbaru
        $recentStudents = Student::orderBy('created_at', 'desc')->take(5)->get();
        
        // Berita terbaru
        $recentNews = News::orderBy('created_at', 'desc')->take(5)->get();
        
        // Pesan kontak terbaru
        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        // Statistik pendaftaran per bulan (6 bulan terakhir)
        $monthlyRegistrations = Student::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        // Gender distribution
        $maleCount = Student::where('jenis_kelamin', 'L')->count();
        $femaleCount = Student::where('jenis_kelamin', 'P')->count();

        return view('admin.dashboard', compact(
            'totalStudents', 'activeStudents', 'graduatedStudents',
            'totalNews', 'publishedNews',
            'totalTransfers', 'pendingTransfers',
            'unreadMessages', 'totalMessages',
            'recentStudents', 'recentNews', 'recentMessages',
            'monthlyRegistrations', 'maleCount', 'femaleCount'
        ));
    }
}
