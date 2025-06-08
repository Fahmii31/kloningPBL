<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;
use Illuminate\Support\Facades\Storage;

class MerkController extends Controller
{
    public function index()
    {
        $merks = Merk::all();
        return view('pages.admin.merk.merk', compact('merks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:merks,code',
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|in:ON,OFF',
        ]);

        $merk = new Merk();
        $merk->code = $request->code;
        $merk->name = $request->name;
        $merk->status = $request->status ?? 'OFF';

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/logos', $filename);
            $merk->logo = $filename;
        }

        $merk->save();

        return redirect()->route('merk.index')->with('success', 'Merk berhasil ditambahkan.');
    }

    public function update(Request $request, $code)
    {
        $merk = Merk::findOrFail($code);

        $request->validate([
            'code' => 'required|string|max:10|unique:merks,code,' . $merk->code . ',code',
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|in:ON,OFF',
        ]);

        // Jika code berubah, update code
        $merk->code = $request->code;
        $merk->name = $request->name;
        $merk->status = $request->status ?? 'OFF';

        if ($request->hasFile('logo')) {
            if ($merk->logo && Storage::exists('public/logos/' . $merk->logo)) {
                Storage::delete('public/logos/' . $merk->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/logos', $filename);
            $merk->logo = $filename;
        }

        $merk->save();

        return redirect()->route('merk.index')->with('success', 'Merk berhasil diupdate.');
    }

    public function destroy($code)
    {
        $merk = Merk::findOrFail($code);

        if ($merk->logo && Storage::exists('public/logos/' . $merk->logo)) {
            Storage::delete('public/logos/' . $merk->logo);
        }

        $merk->delete();

        return redirect()->route('merk.index')->with('success', 'Merk berhasil dihapus.');
    }

    public function updateStatus(Request $request, $code)
    {
        $request->validate([
            'status' => 'required|in:ON,OFF',
        ]);

        $merk = Merk::findOrFail($code);
        $merk->status = $request->status;
        $merk->save();

        return redirect()->route('merk.index');
    }
}
