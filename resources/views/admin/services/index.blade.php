<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Jasa Spektrum</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4">Tambah Jasa Baru</h3>
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="nama_jasa" value="Nama Jasa" />
                            <x-text-input id="nama_jasa" name="nama_jasa" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="harga" value="Harga" />
                            <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="satuan" value="Satuan (Pcs/Lembar/Meter)" />
                            <x-text-input id="satuan" name="satuan" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="gambar" value="Foto Jasa (Opsional)" />
                            <input type="file" name="gambar" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="deskripsi" value="Deskripsi Singkat" />
                            <textarea name="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-primary-button class="bg-blue-600">Simpan Jasa</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="p-6 bg-white shadow sm:rounded-lg overflow-x-auto">
                <h3 class="text-lg font-bold mb-4">Daftar Jasa Cetak</h3>
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3">Nama Jasa</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr class="border-b">
                            <td class="px-6 py-4">
                                @if($service->gambar)
                                    <img src="{{ asset('storage/' . $service->gambar) }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-400">No Image</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold">{{ $service->nama_jasa }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($service->harga) }}/{{ $service->satuan }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                                
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus jasa ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>