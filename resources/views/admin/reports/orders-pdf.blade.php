<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - {{ ucfirst($filter) }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #1e40af; }
        .header p { margin: 5px 0; font-style: italic; color: #666; }
        .meta { margin-bottom: 20px; }
        .meta table { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { bg-color: #f8fafc; color: #475569; font-weight: bold; }
        .text-right { text-align: right; }
        .total-box { margin-top: 20px; padding: 15px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; }
        .status { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .status-selesai { background: #dcfce7; color: #166534; }
        .status-proses { background: #dbeafe; color: #1e40af; }
        .status-pending { background: #fef9c3; color: #854d0e; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SPEKTRUM MULTI GRAFIKA</h1>
        <p>Solusi Percetakan Profesional & Terpercaya</p>
    </div>

    <div class="meta">
        <table>
            <tr>
                <td><strong>Jenis Laporan:</strong> Penjualan {{ ucfirst($filter) }}</td>
                <td class="text-right"><strong>Tanggal Cetak:</strong> {{ $date }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Resi</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Status</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="font-family: monospace;">{{ $order->nomor_resi }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ $order->nama_pelanggan }}</td>
                <td>{{ $order->service->nama_jasa }}</td>
                <td>
                    <span class="status status-{{ $order->status }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="text-right">Rp {{ number_format($order->total_harga) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <table style="margin: 0;">
            <tr>
                <td style="border: none; padding: 0;"><strong>TOTAL PENDAPATAN (SELESAI):</strong></td>
                <td style="border: none; padding: 0;" class="text-right"><strong>Rp {{ number_format($totalPendapatan) }}</strong></td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak secara otomatis oleh Sistem Spektrum Multi Grafika</p>
    </div>
</body>
</html>