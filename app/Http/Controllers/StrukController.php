<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class StrukController extends Controller
{
    public function cetak(Transaksi $transaksi)
    {
        $transaksi->load(['paket', 'kasir']);

        $pdf = Pdf::loadView('struk.cetak', ['transaksi' => $transaksi])
            ->setPaper([0, 0, 226.77, 600], 'portrait'); // ukuran struk kasir (80mm)

        return $pdf->stream("Struk-{$transaksi->no_nota}.pdf");
    }
}