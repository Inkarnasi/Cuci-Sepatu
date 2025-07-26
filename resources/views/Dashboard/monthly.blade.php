<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .company-name { font-size: 16px; font-weight: bold; margin-bottom: 5px; text-align: center; }
        .report-title { margin-bottom: 10px; text-align: center; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .nowrap { white-space: nowrap; }
    </style>
</head>
<body>
    <div class="company-name">{{ $companyName }}</div>
    <div class="report-title">Laporan Bulan {{ $month }} Tahun {{ $year }}</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Transaksi</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Customer</th>
                <th>Telepon</th>
                <th>Admin</th>
                <th>Jenis Kategori</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Layanan Tambahan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $trx)
                @php
                    $main = $trx->categoryHargas1;
                    $add = $trx->plusServices1;
                    $rowspan = max($main->count(), $add->count(), 1);
                @endphp

                @for ($i = 0; $i < $rowspan; $i++)
                    <tr>
                        @if($i == 0)
                            <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $trx->tracking_number }}</td>
                            <td rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('Y-m-d') }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $trx->jam_transaksi }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $trx->nama_customer }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $trx->notelp_customer }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $trx->nama_admin_input }}</td>
                        @endif

                        {{-- Main service --}}
                        @if(isset($main[$i]))
                            <td>{{ optional($main[$i]->category)->nama_kategori ?? '-' }}</td>
                            <td class="text-center">{{ $main[$i]->qty }}</td>
                            <td class="text-right">{{ number_format(optional($main[$i]->category)->price ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format((optional($main[$i]->category)->price ?? 0) * $main[$i]->qty, 0, ',', '.') }}</td>
                        @else
                            <td colspan="4"></td>
                        @endif

                        {{-- Additional service --}}
                        @if(isset($add[$i]))
                            <td>{{ optional($add[$i]->plusService)->name ?? '-' }}</td>
                            <td class="text-center">{{ $add[$i]->qty ?? 1 }}</td>
                            <td class="text-right">{{ number_format(optional($add[$i]->plusService)->price ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format((optional($add[$i]->plusService)->price ?? 0) * ($add[$i]->qty ?? 1), 0, ',', '.') }}</td>
                        @else
                            <td colspan="4"></td>
                        @endif

                        @if($i == 0)
                            <td rowspan="{{ $rowspan }}" class="text-right">{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        @endif
                    </tr>
                @endfor
            @endforeach
        </tbody>
        <tfoot>
    <tr>
        <td colspan="15" class="text-right"><strong>Total Seluruh Transaksi:</strong></td>
        <td class="text-right"><strong>{{ number_format($totalSemuaTransaksi, 0, ',', '.') }}</strong></td>
    </tr>
</tfoot>

    </table>
</body>
</html>
