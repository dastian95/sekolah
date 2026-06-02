@extends('layouts.app')

@section('title', $news->title . ' - Laboratorium Islamic Technology-Labitech')

@section('content')
@if(isset($isPreview) && $isPreview)
<div style="background:#ff9800; color:white; text-align:center; padding:0.6rem; font-weight:700; font-size:0.9rem; position:sticky; top:0; z-index:999;">
    <i class="fas fa-eye-slash me-2"></i>MODE PREVIEW — Artikel ini masih DRAFT dan tidak terlihat oleh publik.
    <a href="{{ route('admin.news.index') }}" style="color:white; text-decoration:underline; margin-left:1rem;">← Kembali ke Admin</a>
</div>
@endif
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem 0;">
    <div class="container-lg">
        <a href="{{ route('news') }}" style="color: white; text-decoration: none; margin-bottom: 1rem; display: inline-block;">
            <i class="fas fa-arrow-left"></i> Kembali ke Berita
        </a>
        <h1 style="font-size: 2.5rem; font-weight: 700; margin: 1rem 0 0 0;">{{ $news->title }}</h1>
    </div>
</section>

<!-- Article Content -->
<section style="padding: 3rem 0; background-color: white;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8">
                <!-- Featured Image -->
                @if($news->featured_image)
                    <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                         style="width: 100%; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                @else
                    <div style="width:100%; aspect-ratio:2/1; border-radius:12px; margin-bottom:2rem; box-shadow:0 15px 40px rgba(0,0,0,0.1); background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.75rem;">
                        <img src="{{ asset('images/logo.png') }}" style="height:70px;width:auto;opacity:0.5;" alt="">
                        <span style="font-size:0.85rem;color:#aaa;text-align:center;padding:0 2rem;">{{ Str::limit($news->title, 60) }}</span>
                    </div>
                @endif

                <!-- Article Meta -->
                <div style="display: flex; gap: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #999;">
                        <i class="fas fa-calendar"></i>
                        <span>{{ ($news->published_at ?? $news->created_at)->format('d F Y') }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #999;">
                        <i class="fas fa-user"></i>
                        <span>{{ $news->author }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="background-color: var(--primary-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.85rem;">
                            {{ $news->category }}
                        </span>
                    </div>
                </div>

                <!-- Article Content -->
                <div style="line-height: 1.8; color: #555; font-size: 1.05rem; margin-bottom: 2rem;">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <!-- Share Section -->
                <div style="padding: 2rem; background-color: #f8f9fa; border-radius: 12px; margin-top: 3rem;">
                    <h4 style="margin-bottom: 1rem; color: var(--dark-blue); font-weight: 600;">Bagikan Artikel Ini</h4>
                    <div style="display: flex; gap: 1rem;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #1877F2; color: white; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($news->title) }}" target="_blank"
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #1DA1F2; color: white; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank"
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #0A66C2; color: white; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="mailto:?subject={{ urlencode($news->title) }}&body={{ urlencode($news->excerpt . ' ' . url()->current()) }}"
                           style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #EA4335; color: white; border-radius: 6px; text-decoration: none; transition: background-color 0.3s;">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent News -->
                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                    <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem; font-size: 1.1rem;">
                        <i class="fas fa-newspaper" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                        Berita Terbaru
                    </h4>
                    @php
                        $recentNews = App\Models\News::where('is_published', true)
                            ->where('id', '!=', $news->id)
                            ->orderBy('published_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp

                    @foreach($recentNews as $recent)
                        <div style="border-bottom: 1px solid #e0e0e0; padding-bottom: 1rem; margin-bottom: 1rem;">
                            <h5 style="margin: 0 0 0.5rem 0; color: var(--dark-blue); font-weight: 600; font-size: 0.95rem;">
                                <a href="{{ route('news.show', $recent) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;">
                                    {{ $recent->title }}
                                </a>
                            </h5>
                            <div style="font-size: 0.85rem; color: #999;">
                                <i class="fas fa-calendar-alt"></i> {{ ($recent->published_at ?? $recent->created_at)->format('d F Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Categories -->
                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                    <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem; font-size: 1.1rem;">
                        <i class="fas fa-tags" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                        Kategori
                    </h4>
                    @php
                        $categories = App\Models\News::where('is_published', true)
                            ->distinct()
                            ->pluck('category');
                    @endphp

                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($categories as $category)
                            <a href="#" style="display: inline-block; background-color: white; padding: 0.5rem 1rem; border-radius: 6px; border-left: 4px solid var(--primary-blue); text-decoration: none; color: var(--dark-blue); transition: all 0.3s;">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related News -->
<section style="padding: 3rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <h2 style="font-size: 1.5rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem;">Berita Serupa</h2>
        <div class="row">
            @php
                $relatedNews = App\Models\News::where('is_published', true)
                    ->where('category', $news->category)
                    ->where('id', '!=', $news->id)
                    ->orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp

            @forelse($relatedNews as $related)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">
                        @if($related->featured_image)
                            <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}">
                        @else
                            <div style="width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                                <img src="{{ asset('images/logo.png') }}" style="height:45px;width:auto;opacity:0.5;" alt="">
                                <span style="font-size:0.7rem;color:#aaa;text-align:center;padding:0 0.75rem;">{{ Str::limit($related->title, 35) }}</span>
                            </div>
                        @endif
                        <div class="news-card-body">
                            <div class="news-card-title">{{ $related->title }}</div>
                            <div class="news-card-date">{{ ($related->published_at ?? $related->created_at)->format('d F Y') }}</div>
                            <a href="{{ route('news.show', $related) }}" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p style="text-align: center; color: #999; padding: 2rem;">Tidak ada berita serupa.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
