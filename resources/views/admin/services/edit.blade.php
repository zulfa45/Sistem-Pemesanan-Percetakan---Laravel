<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Jasa: {{ $service->nama_jasa }}</h2>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 flex flex-col items-center p-4 border rounded-lg bg-gray-50">
                            <span class="text-sm text-gray-500 mb-2">Gambar Saat Ini:</span>
                            @if($service->gambar)
                                <img src="{{ asset('storage/' . $service->gambar) }}" class="h-40 w-auto object-cover rounded shadow mb-3">
                            @else
                                <div class="h-40 w-40 bg-gray-200 flex items-center justify-center rounded text-gray-400 mb-3">Tidak ada gambar</div>
                            @endif
                            
                            <div class="w-full">
                                <x-input-label for="gambar" value="Ganti Gambar (Biarkan kosong jika tidak ingin mengganti)" />
                                <input type="file" name="gambar" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-white">
                            </div>
                        </div>

                        <div>
                            <x-input-label for="nama_jasa" value="Nama Jasa" />
                            <x-text-input id="nama_jasa" name="nama_jasa" type="text" class="mt-1 block w-full" value="{{ old('nama_jasa', $service->nama_jasa) }}" required />
                        </div>
                        <div>
                            <x-input-label for="harga" value="Harga" />
                            <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" value="{{ old('harga', $service->harga) }}" required />
                        </div>
                        <div>
                            <x-input-label for="satuan" value="Satuan (Pcs/Lembar/Meter)" />
                            <x-text-input id="satuan" name="satuan" type="text" class="mt-1 block w-full" value="{{ old('satuan', $service->satuan) }}" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="deskripsi" value="Deskripsi Singkat" />
                            <textarea name="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $service->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="bg-blue-600">Update Data Jasa</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>