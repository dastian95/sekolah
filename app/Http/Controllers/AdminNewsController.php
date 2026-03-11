<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    /**
     * Display a listing of all news.
     */
    public function index(Request $request)
    {
        $query = News::query()->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $news = $query->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'required|string|max:100',
            'author'         => 'required|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->has('is_published') ? now() : null;

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('news', 'public');
            $validated['featured_image'] = $path;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(int $id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, int $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'required|string|max:100',
            'author'         => 'required|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_published'   => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        // If publishing for the first time
        if ($validated['is_published'] && !$news->published_at) {
            $validated['published_at'] = now();
        }

        // If unpublishing
        if (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $path = $request->file('featured_image')->store('news', 'public');
            $validated['featured_image'] = $path;
        }

        // Update slug only if title changed
        if ($news->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified article.
     */
    public function destroy(int $id)
    {
        $news = News::findOrFail($id);

        if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
