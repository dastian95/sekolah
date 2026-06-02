@extends('layouts.app')

@section('title', 'Berita & Artikel - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem 0;">
    <div class="container-lg">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Berita & Artikel</h1>
        <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">Informasi terkini dari Laboratorium Islamic Technology-Labitech</p>
    </div>
</section>

<!-- Featured News -->
<section style="padding: 3rem 0; background-color: white;">
    <div class="container-lg">
        <h2 style="font-size: 1.5rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem;">Berita Utama</h2>
        <div class="row">
            <div class="col-lg-8">
                @if($news->count() > 0)
                @php $featured = $news->first(); @endphp
                <div class="news-card" style="margin-bottom: 0;">
                    @if($featured->featured_image)
                        <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" style="height: 400px;"
                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div style="display:none; height:400px; background:linear-gradient(135deg,#e8f0fb,#dde8ff); align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                            <img src="{{ asset('images/logo.png') }}" style="height:60px;width:auto;opacity:0.5;" alt="">
                        </div>
                    @else
                        <div style="height:400px; background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                            <img src="{{ asset('images/logo.png') }}" style="height:60px;width:auto;opacity:0.5;" alt="">
                            <span style="font-size:0.8rem;color:#aaa;text-align:center;padding:0 1.5rem;">{{ Str::limit($featured->title, 50) }}</span>
                        </div>
                    @endif
                    <div class="news-card-body">
                        <div class="news-card-title" style="font-size: 1.5rem;">{{ $featured->title }}</div>
                        <div class="news-card-date">{{ ($featured->published_at ?? $featured->created_at)->format('d F Y') }}</div>
                        <p style="color: #666; line-height: 1.7; margin-bottom: 1.5rem;">
                            {{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) }}
                        </p>
                        <a href="{{ route('news.show', $featured) }}" class="btn btn-primary" style="padding: 0.5rem 1.5rem; font-size: 0.95rem;">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem; font-size: 1.2rem;">
                        <i class="fas fa-fire" style="color: var(--secondary-yellow); margin-right: 0.5rem;"></i>
                        Trending Sekarang
                    </h3>
                    <div style="border-bottom: 1px solid #e0e0e0; padding-bottom: 1rem; margin-bottom: 1rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--dark-blue); font-weight: 600; font-size: 0.95rem;">
                            <a href="#" style="color: inherit; text-decoration: none;">Pendaftaran Siswa Baru SD Labitech 2026 Dibuka</a>
                        </h4>
                        <div style="font-size: 0.85rem; color: #999;">13 Februari 2026</div>
                    </div>
                    <div style="border-bottom: 1px solid #e0e0e0; padding-bottom: 1rem; margin-bottom: 1rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--dark-blue); font-weight: 600; font-size: 0.95rem;">
                            <a href="#" style="color: inherit; text-decoration: none;">Prestasi Siswa SD Labitech dalam Kompetisi Sains</a>
                        </h4>
                        <div style="font-size: 0.85rem; color: #999;">10 Februari 2026</div>
                    </div>
                    <div style="padding-bottom: 1rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--dark-blue); font-weight: 600; font-size: 0.95rem;">
                            <a href="#" style="color: inherit; text-decoration: none;">Program Beasiswa Labitech untuk Siswa Berprestasi</a>
                        </h4>
                        <div style="font-size: 0.85rem; color: #999;">7 Februari 2026</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- All News -->
<section style="padding: 3rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <h2 style="font-size: 1.5rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem;">Semua Berita</h2>
        <div class="row">
            @forelse($news as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">
                        @if($item->featured_image)
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="display:none; width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,#e8f0fb,#dde8ff); align-items:center; justify-content:center;">
                                <img src="{{ asset('images/logo.png') }}" style="height:50px;width:auto;opacity:0.5;" alt="">
                            </div>
                        @else
                            <div style="width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                                <img src="{{ asset('images/logo.png') }}" style="height:50px;width:auto;opacity:0.5;" alt="">
                                <span style="font-size:0.75rem;color:#aaa;text-align:center;padding:0 1rem;">{{ Str::limit($item->title, 40) }}</span>
                            </div>
                        @endif
                        <div class="news-card-body">
                            <div class="news-card-title">{{ $item->title }}</div>
                            <div class="news-card-date">{{ ($item->published_at ?? $item->created_at)->format('d F Y') }}</div>
                            <a href="{{ route('news.show', $item) }}" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p style="text-align: center; color: #999; padding: 2rem;">Tidak ada berita tersedia.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <nav style="margin-top: 3rem;" aria-label="Page navigation">
            {{ $news->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</section>

@endsection
