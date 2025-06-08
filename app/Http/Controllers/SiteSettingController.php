<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting; // ← PENTING: ini harus ada!

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();
        return view('pages.admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name'   => 'nullable|string',
            'copyright'   => 'nullable|string',
            'address'     => 'nullable|string',
            'email'       => 'nullable|email',
            'phone'       => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Changes Have Been Saved.');
    }
}
