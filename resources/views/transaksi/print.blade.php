<!DOCTYPE html>
<html>
<head>
    <title>Print Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px; /* Ukuran font untuk th dan td */
            white-space: nowrap; /* Mencegah teks untuk wrap/menurun ke baris baru */
            overflow: hidden; /* Mengatur overflow jika teks terlalu panjang */
            text-overflow: ellipsis; /* Mengganti teks yang terlalu panjang dengan ellipsis */
        }
        th {
            background-color: #f2f2f2;
            text-align: center; /* Teks rata tengah */
        }

        /* Tambahan Style */
        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header #reference {
            flex-grow: 1;
            margin-left: 20px;
        }

        #header #reference h1, #header #reference h4 {
            margin: 0;
        }

        #header #logo img {
            width: 190px;
        }

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
            border: 0;
            border-top: 1px solid #000;
        }
        /* Ganti ukuran font untuk alamat dan hotline */
        #header #reference h4 {
            font-size: 14px;
            margin-top: 2px; /* Mengatur margin lebih kecil */
        }
        /* Menghapus margin pada h2 dan p */
        h2, p {
            margin: 0;
        }
        
    </style>
    <script>
        // JavaScript to automatically trigger the print dialog when the page loads
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <div id="header">
        <div id="logo">
            <img src="{{ asset('images/logo.png') }}">
        </div>
        <div id="reference">
            <h1 style="font-size:25px;color:rgb(22, 22, 128);"><strong>LAKITAN RENTAL MOBIL</strong></h1>
            <h4 style="font-size:15px;margin-top:3px;color:blue;">Jadikan perjalanan Anda menyenangkan</h4>
            <h4>Jl. Brigjen Katamso, Tj. Uncang, Kec. Batu Aji, Kota Batam, Kepulauan Riau</h4>
            <h4>Hotline: 0822 8304 0404 | Website : app.projecthree.my.id</h4>
        </div>
    </div>
    <hr>

    <h2>Laporan Transaksi</h2>
    <p>Rentang Tanggal : {{ request()->get('datetime') }}</p><br>
    <table>
        <thead>
            <tr>
                <th style="font-size: 12px;">Nomor Transaksi</th>
                <th style="font-size: 12px;">Nomor Invoice</th>
                <th style="font-size: 12px;">Merek</th>
                <th style="font-size: 12px;">Nama Pelanggan</th>
                <th style="font-size: 12px;">Nomor Telepon</th>
                <th style="font-size: 12px;">Status Pembayaran</th>
                <th style="font-size: 12px;">Tanggal Pemesanan</th>
                <th style="font-size: 12px;">Total Harga</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total_harga = 0;

                function terbilang($angka) {
                    $angka = abs($angka);
                    $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
                    $terbilang = '';
                    if ($angka < 12) {
                        $terbilang = ' ' . $baca[$angka];
                    } else if ($angka < 20) {
                        $terbilang = terbilang($angka - 10) . ' belas';
                    } else if ($angka < 100) {
                        $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
                    } else if ($angka < 200) {
                        $terbilang = ' seratus' . terbilang($angka - 100);
                    } else if ($angka < 1000) {
                        $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
                    } else if ($angka < 2000) {
                        $terbilang = ' seribu' . terbilang($angka - 1000);
                    } else if ($angka < 1000000) {
                        $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
                    } else if ($angka < 1000000000) {
                        $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
                    } else if ($angka < 1000000000000) {
                        $terbilang = terbilang($angka / 1000000000) . ' milyar' . terbilang(fmod($angka, 1000000000));
                    } else if ($angka < 1000000000000000) {
                        $terbilang = terbilang($angka / 1000000000000) . ' triliun' . terbilang(fmod($angka, 1000000000000));
                    }
                    return $terbilang;
                }
            @endphp
            @foreach ($transactions as $transaction)
                <tr>
                    <td style="font-size: 12px;">{{ $transaction->transaksi_no }}</td>
                    <td style="font-size: 12px;">{{ $transaction->invoice_no }}</td>
                    <td style="font-size: 12px;">{{ $transaction->mobil_merek }}</td>
                    <td style="font-size: 12px;">{{ $transaction->customer_name }}</td>
                    <td style="font-size: 12px;">{{ $transaction->customer_phone }}</td>
                    <td style="font-size: 12px;">
                        @php
                            switch ($transaction->payment_status) {
                                case 0:
                                    echo "Menunggu Pembayaran";
                                    break;
                                case 1:
                                    echo "Menunggu Pelunasan";
                                    break;
                                case 2:
                                    echo "Menunggu Konfirmasi";
                                    break;
                                case 3:
                                    echo "Transaksi berhasil";
                                    break;
                                default:
                                    echo "Status tidak valid";
                            }
                        @endphp
                    </td>
                    <td style="font-size: 12px;">{{ ucfirst(strftime('%e %B %Y', strtotime($transaction->booking_date))) }}</td>

                    <td style="font-size: 12px;">{{ 'Rp ' . number_format($transaction->total_biaya, 2, ',', '.') }}</td>
                </tr>
                @php
                    $total_harga += $transaction->total_biaya;
                @endphp
            @endforeach
        </tbody>
    </table><br>
    
    <p>
        <span style="display: inline-block; width: 150px;">Total Pendapatan </span>
        : {{ 'Rp ' . number_format($total_harga, 2, ',', '.') }}
    </p>
    <p>
        <span style="display: inline-block; width: 150px;">Terbilang </span>
        : {{ ucwords(terbilang($total_harga)) }} Rupiah
    </p>

</body>
</html>
