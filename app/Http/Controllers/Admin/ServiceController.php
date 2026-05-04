<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_jasa' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('services', 'public');
        }

        Service::create($data);
        return back()->with('success', 'Jasa berhasil ditambahkan!');
    }

    public function update(Request $request, Service $service) {
        $request->validate([
            'nama_jasa' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($service->gambar) {
                Storage::disk('public')->delete($service->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('services', 'public');
        }

        $service->update($data);
        return back()->with('success', 'Jasa berhasil diperbarui!');
    }

    public function destroy(Service $service) {
        if ($service->gambar) {
            Storage::disk('public')->delete($service->gambar);
        }
        $service->delete();
        return back()->with('success', 'Jasa berhasil dihapus!');
    }
    public function edit(Service $service) 
    {
        return view('admin.services.edit', compact('service'));
    }
}