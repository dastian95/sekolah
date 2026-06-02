<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Certificate;
use App\Models\News;
use App\Models\Partnership;
use App\Models\SiteSetting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        $latestNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $homepageSettings = SiteSetting::getGroup('homepage');
        $branches = Branch::ordered()->get();

        // Load data for all sections (single-page)
        $aboutSettings = SiteSetting::getGroup('about');
        $contactSettings = SiteSetting::getGroup('contact');

        return view('index', compact('latestNews', 'homepageSettings', 'branches', 'aboutSettings', 'contactSettings'));
    }

    /**
     * Display a single branch detail page.
     */
    public function showBranch(Branch $branch): View
    {
        abort_unless($branch->is_active, 404);
        $otherBranches = Branch::active()->ordered()->where('id', '!=', $branch->id)->get();
        return view('branch-detail', compact('branch', 'otherBranches'));
    }

    /**
     * Display the about page.
     */
    public function about(): View
    {
        $settings = SiteSetting::getGroup('about');
        return view('about', compact('settings'));
    }

    /**
     * Display the news page.
     */
    public function news(): View
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('news', compact('news'));
    }

    /**
     * Display a single news article (public — published only).
     */
    public function showNews(News $news): View
    {
        abort_unless($news->is_published, 404);

        $recentNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $relatedNews = News::where('is_published', true)
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('news-detail', compact('news', 'recentNews', 'relatedNews'));
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        $settings = SiteSetting::getGroup('contact');
        return view('contact', compact('settings'));
    }

    public function pendaftaran()
    {
        return view('pendaftaran');
    }

    public function kemitraan(): View
    {
        $partnerships = Partnership::active()->ordered()->get();
        return view('kemitraan', compact('partnerships'));
    }

    public function certificates(): View
    {
        $certificates = Certificate::active()->ordered()->get();
        return view('certificates', compact('certificates'));
    }

    /**
     * Handle contact form submission.
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek harus dipilih.',
            'message.required' => 'Pesan harus diisi.',
            'message.max' => 'Pesan maksimal 2000 karakter.',
        ]);

        ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        return redirect(route('home') . '#section-kontak')->with('contact_success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');
    }
}
