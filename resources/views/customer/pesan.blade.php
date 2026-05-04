<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemesanan Cetak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4">Buat Pesanan Baru</h3>
                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
    <x-input-label for="service_id" value="Pilih Jasa Cetak" />
    <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
        @foreach($services as $service)
            <option value="{{ $service->id }}">
                {{ $service->nama_jasa }} - Rp {{ number_format($service->harga) }}/{{ $service->satuan }}
            </option>
        @endforeach
    </select>
</div>
                    <div class="mb-4">
                        <x-input-label for="jumlah" value="Jumlah" />
                        <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full" required />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="catatan" value="Catatan Tambahan (Opsional)" />
                        <textarea id="catatan" name="catatan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    </div>
                    <x-primary-button class="bg-blue-600">Buat Pesanan</x-primary-button>
                </form>
            </div>
            <h3 class="text-lg font-bold mb-4">Katalog Jasa Kami</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-12">
    @foreach($services as $service)
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        @if($service->gambar)
            <img src="{{ asset('storage/' . $service->gambar) }}" class="h-48 w-full object-cover">
        @else
            <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-400">Gambar Tidak Tersedia</div>
        @endif
        <div class="p-4">
            <h4 class="font-bold text-xl text-gray-800">{{ $service->nama_jasa }}</h4>
            <p class="text-sm text-gray-500 mb-2">{{ $service->deskripsi }}</p>
            <p class="text-blue-600 font-bold">Rp {{ number_format($service->harga) }} / {{ $service->satuan }}</p>
        </div>
    </div>
    @endforeach
</div>

            <div class="p-6 bg-white shadow sm:rounded-lg overflow-x-auto">
                <h3 class="text-lg font-bold mb-4">Riwayat Pesanan Saya</h3>
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Jenis Cetakan</th>
                            <th class="px-6 py-3">Jumlah</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $order->service->nama_jasa }}</td>
                            <td class="px-6 py-4">{{ $order->jumlah }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-white text-xs 
                                    {{ $order->status == 'pending' ? 'bg-yellow-500' : ($order->status == 'diproses' ? 'bg-blue-500' : 'bg-green-500') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>