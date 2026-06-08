<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    /**
     * Show About Us settings form.
     */
    public function editAbout()
    {
        $settings = SiteSetting::getGroup('about');

        return view('admin.settings.about', compact('settings'));
    }

    /**
     * Update About Us settings.
     */
    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'about_description_1'  => 'nullable|string',
            'about_description_2'  => 'nullable|string',
            'about_description_3'  => 'nullable|string',
            'about_vision'         => 'nullable|string',
            'about_mission'        => 'nullable|string',
            'about_values'         => 'nullable|string',
            'about_stat_branches'  => 'nullable|string|max:20',
            'about_stat_teachers'  => 'nullable|string|max:20',
            'about_stat_students'  => 'nullable|string|max:20',
            'about_stat_years'     => 'nullable|string|max:20',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::setValue($key, $value, 'about');
        }

        return redirect()->route('admin.settings.about')->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }

    /**
     * Show Contact settings form.
     */
    public function editContact()
    {
        $settings = array_merge(
            SiteSetting::getGroup('contact'),
            SiteSetting::getGroup('social')
        );

        return view('admin.settings.contact', compact('settings'));
    }

    /**
     * Update Contact settings.
     */
    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'contact_email'       => 'nullable|string|max:255',
            'contact_phone'       => 'nullable|string|max:50',
            'contact_address'     => 'nullable|string|max:500',
            'contact_school_name' => 'nullable|string|max:255',
            'contact_school_level'=> 'nullable|string|max:100',
            'contact_motto'       => 'nullable|string|max:255',
            'social_facebook'     => 'nullable|url|max:500',
            'social_twitter'      => 'nullable|url|max:500',
            'social_instagram'    => 'nullable|url|max:500',
            'social_youtube'      => 'nullable|url|max:500',
            'social_whatsapp'     => 'nullable|string|max:20',
        ]);

        $contactFields = ['contact_email','contact_phone','contact_address','contact_school_name','contact_school_level','contact_motto'];
        foreach ($contactFields as $key) {
            SiteSetting::setValue($key, $request->input($key), 'contact');
        }

        $socialFields = ['social_facebook','social_twitter','social_instagram','social_youtube','social_whatsapp'];
        foreach ($socialFields as $key) {
            SiteSetting::setValue($key, $request->input($key), 'social');
        }

        return redirect()->route('admin.settings.contact')->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    /**
     * Show Homepage settings form.
     */
    public function editHomepage()
    {
        $settings = SiteSetting::getGroup('homepage');

        return view('admin.settings.homepage', compact('settings'));
    }

    /**
     * Update Homepage settings.
     */
    public function updateHomepage(Request $request)
    {
        $request->validate([
            'homepage_banner_subtitle' => 'nullable|string|max:255',
            'homepage_banner_title'    => 'nullable|string|max:255',
            'homepage_banner_link'     => 'nullable|string|max:500',
            'homepage_video_url'       => 'nullable|url|max:500',
            'homepage_hero_interval'   => 'nullable|integer|min:1|max:30',
            'homepage_hero_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_hero_image_2'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_hero_image_3'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_hero_image_4'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_hero_image_5'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_about_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'homepage_video_file'      => 'nullable|mimes:mp4,webm,ogg|max:102400',
        ]);

        $textFields = ['homepage_banner_subtitle', 'homepage_banner_title', 'homepage_banner_link', 'homepage_video_url', 'homepage_hero_interval'];
        foreach ($textFields as $key) {
            SiteSetting::setValue($key, $request->input($key), 'homepage');
        }

        $imageKeys = ['homepage_hero_image', 'homepage_hero_image_2', 'homepage_hero_image_3', 'homepage_hero_image_4', 'homepage_hero_image_5', 'homepage_about_image'];
        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $old = SiteSetting::getValue($key);
                if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
                $path = $request->file($key)->store('settings', 'public');
                SiteSetting::setValue($key, $path, 'homepage');
            }
            // Hapus gambar jika checkbox delete dicentang
            if ($request->input('delete_' . $key)) {
                $old = SiteSetting::getValue($key);
                if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
                SiteSetting::setValue($key, null, 'homepage');
            }
        }

        if ($request->hasFile('homepage_video_file')) {
            $old = SiteSetting::getValue('homepage_video_file');
            if ($old) \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
            $path = $request->file('homepage_video_file')->store('videos', 'public');
            SiteSetting::setValue('homepage_video_file', $path, 'homepage');
        }

        return redirect()->route('admin.settings.homepage')->with('success', 'Pengaturan halaman utama berhasil diperbarui!');
    }

    /**
     * Show Registration settings form.
     */
    public function editRegistration()
    {
        $settings = SiteSetting::getGroup('registration');
        $totalPendaftar = \App\Models\Student::count();

        return view('admin.settings.registration', compact('settings', 'totalPendaftar'));
    }

    /**
     * Update Registration settings.
     */
    public function updateRegistration(Request $request)
    {
        $request->validate([
            'registration_open'              => 'nullable|in:0,1',
            'registration_start_date'        => 'nullable|date',
            'registration_end_date'          => 'nullable|date|after_or_equal:registration_start_date',
            'registration_capacity'          => 'required|integer|min:1|max:10000',
            'registration_closed_message'    => 'nullable|string|max:500',
            'registration_google_form_baru'  => 'nullable|url|max:500',
            'registration_google_form_pindahan' => 'nullable|url|max:500',
            'registration_pindahan_open'        => 'nullable|in:0,1',
        ]);

        SiteSetting::setValue('registration_open', $request->has('registration_open') ? '1' : '0', 'registration');
        SiteSetting::setValue('registration_start_date', $request->input('registration_start_date'), 'registration');
        SiteSetting::setValue('registration_end_date', $request->input('registration_end_date'), 'registration');
        SiteSetting::setValue('registration_capacity', $request->input('registration_capacity'), 'registration');
        SiteSetting::setValue('registration_closed_message', $request->input('registration_closed_message'), 'registration');
        SiteSetting::setValue('registration_google_form_baru', $request->input('registration_google_form_baru'), 'registration');
        SiteSetting::setValue('registration_google_form_pindahan', $request->input('registration_google_form_pindahan'), 'registration');
        SiteSetting::setValue('registration_pindahan_open', $request->has('registration_pindahan_open') ? '1' : '0', 'registration');

        return redirect()->route('admin.settings.registration')->with('success', 'Pengaturan pendaftaran berhasil diperbarui!');
    }
}
