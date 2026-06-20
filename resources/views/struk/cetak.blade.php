<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: monospace; font-size: 11px; margin: 0; padding: 10px; }
        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 6px 0; }
        table { width: 100%; }
        td { padding: 2px 0; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="center bold">WASHWIRE LAUNDRY</div>
    <div class="center">Jl. Contoh No. 123</div>
    <div class="center">Telp: 0812-3456-7890</div>
    <div class="line"></div>

    <table>
        <tr><td>No. Nota</td><td class="right">{{ $transaksi->no_nota }}</td></tr>
        <tr><td>Tanggal</td><td class="right">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td></tr>
        <tr><td>Kasir</td><td class="right">{{ $transaksi->kasir->name }}</td></tr>
    </table>
    <div class="line"></div>

    <table>
        <tr><td>Pelanggan</td><td class="right">{{ $transaksi->nama_pelanggan }}</td></tr>
        <tr><td>No. HP</td><td class="right">{{ $transaksi->no_hp ?? '-' }}</td></tr>
    </table>
    <div class="line"></div>

    <table>
        <tr><td>{{ $transaksi->paket->nama }}</td></tr>
        <tr>
            <td>{{ $transaksi->berat }} kg x Rp {{ number_format($transaksi->paket->harga_per_kg, 0, ',', '.') }}</td>
            <td class="right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
        </tr>
    </table>
    <div class="line"></div>

    <table>
        <tr class="bold"><td>TOTAL</td><td class="right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td></tr>
    </table>
    <div class="line"></div>

    <div class="center">Status: {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}</div>
    <div class="center" style="margin-top: 10px;">Terima kasih atas kepercayaan Anda!</div>
</body>
</html>