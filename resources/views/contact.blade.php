@extends('layouts.app')

@section('title', 'Kontak - Labitech Insan Mulia')

@section('content')

<!-- Hero Section -->
<section style="padding: 4rem 0; background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; text-align: center;">
    <div class="container-lg">
        <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem;">Hubungi Kami</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Kami siap membantu Anda dengan informasi lengkap tentang SDIT Labitech Insan Mulia</p>
    </div>
</section>

<!-- Contact Content -->
<section style="padding: 4rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <div class="row">
            <!-- Contact Info Cards -->
            <div class="col-lg-6" style="margin-bottom: 2rem;">
                <h2 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem; font-size: 2rem;">Informasi Kontak</h2>

                <!-- Email Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-envelope" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Email</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Hubungi via email</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">{{ $settings['contact_email'] ?? 'labitechunggulbermutu@gmail.com' }}</p>
                </div>

                <!-- Phone Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-phone" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Nomor Telepon</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Hubungi langsung kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">{{ $settings['contact_phone'] ?? '+62 816262619' }}</p>
                </div>

                <!-- Address Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Alamat</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Kunjungi kantor kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: #333; font-weight: 500; line-height: 1.6;">{{ $settings['contact_address'] ?? 'Jl. Kutilang No.3, RT.001/RW.003, Jatimakmur, Kec. Pd. Gede, Kota Bks, Jawa Barat' }}</p>
                </div>
            </div>

            <!-- School Info Cards -->
            <div class="col-lg-6" style="margin-bottom: 2rem;">
                <h2 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem; font-size: 2rem;">Informasi Sekolah</h2>

                <!-- School Name Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-school" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Nama Sekolah</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Identitas sekolah</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $settings['contact_school_name'] ?? 'SDIT Labitech Insan Mulia' }}</p>
                </div>

                <!-- Level Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-graduation-cap" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Jenjang Pendidikan</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Tingkat sekolah</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $settings['contact_school_level'] ?? 'SD (Sekolah Dasar)' }}</p>
                </div>

                <!-- Mission Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-heart" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Motto</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Semangat kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $settings['contact_motto'] ?? 'Iman - Ilmu - Amal' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <h2 style="color: var(--dark-blue); font-weight: 700; font-size: 2rem;">Kirim Pesan</h2>
                    <p style="color: #666; font-size: 1.05rem;">Ada pertanyaan? Silakan kirim pesan melalui form berikut</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; box-shadow: 0 2px 8px rgba(40,167,69,0.15);">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none;">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" style="background: #f8f9fa; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="Nama Anda">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="email@contoh.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">No. Telepon / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Subjek <span class="text-danger">*</span></label>
                            <select name="subject" required class="form-select" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;">
                                <option value="">Pilih subjek...</option>
                                <option value="Informasi PPDB" {{ old('subject') == 'Informasi PPDB' ? 'selected' : '' }}>Informasi PPDB</option>
                                <option value="Informasi Akademik" {{ old('subject') == 'Informasi Akademik' ? 'selected' : '' }}>Informasi Akademik</option>
                                <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                <option value="Saran & Masukan" {{ old('subject') == 'Saran & Masukan' ? 'selected' : '' }}>Saran & Masukan</option>
                                <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Pesan <span class="text-danger">*</span></label>
                        <textarea name="message" rows="5" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8; resize: vertical;" placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="padding: 0.75rem 3rem; border-radius: 10px; font-weight: 600; font-size: 1.05rem; background: linear-gradient(135deg, var(--primary-blue), #0052a3); border: none; box-shadow: 0 4px 15px rgba(0,102,204,0.3);">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
