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
        $settings = SiteSetting::getGroup('contact');

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
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::setValue($key, $value, 'contact');
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
        $validated = $request->validate([
            'homepage_banner_subtitle' => 'nullable|string|max:255',
            'homepage_banner_title'    => 'nullable|string|max:255',
            'homepage_banner_link'     => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::setValue($key, $value, 'homepage');
        }

        return redirect()->route('admin.settings.homepage')->with('success', 'Pengaturan halaman utama berhasil diperbarui!');
    }
}
