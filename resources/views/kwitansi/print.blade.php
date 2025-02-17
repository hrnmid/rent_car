<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        padding: 0;
        margin: 0;
        font-family: 'Open Sans', sans-serif;
    }

    #container {
        border: 1px solid black;
        width: 100%;
        box-sizing: border-box;
        padding: 10px;
    }

    #header {
        display: flex;
        font-family: 'Open Sans', sans-serif;
        align-items: center;
        border-bottom: 3px solid black;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    #logo,
    #reference {
        line-height: 0;
        margin-left: 0.8cm;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px; /* Added margin-top to adjust spacing */
    }

    th,
    td {
        padding: 0; /* Remove default padding */
        margin: 0; /* Remove default margin */
        vertical-align: top;
        font-weight: normal; /* Remove bold font from th */
    }

    .label {
        text-align: left;
        padding-left: 2cm;
        width: 35%;
    }

    .value {
        text-align: left;
        border-left: none;
    }

    #caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
        text-align: center;
        text-decoration: underline;
        font-size: 200%;
    }

    .kop:before {
        content: ': ';
    }

    .ttd td,
    .ttd th {
        padding-bottom: 5em;
    }

    @media print {
        @page {
            size: landscape;
        }
    }
</style>

</head>

<body>
    <div id="container">
        <div id="header">
            <div id="logo">
                <img src="{{ asset('images/logo.png') }}" alt="" width="200">
            </div>
            <div id="reference">
                <h2><strong style="color: #073c6d;">LAKITAN RENTAL MOBIL</strong></h2>
                <h5 style="color: #073c6d;">Jadikan perjalanan Anda menyenangkan</h5>
                <p style="font-size: smaller;">Jl. Brigjen Katamso, Tj. Uncang, Kec. Batu Aji, Kota Batam, Kepulauan Riau</p>
                <p style="font-size: smaller;">Hotline: 0822 8304 0404 | Website : app.projecthree.my.id</p>
            </div>

            <div id="no-box" style="margin-left: 1cm;">
                <p style="margin-bottom: 0; display: inline-block;">No :</p>
                <div style="border: 1px solid black; padding: 5px; display: inline-block;">
                    {{ $kuitansi->receipt_no }}
                </div>
            </div>
        </div>
        <table border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <td colspan="2" id="caption">KUITANSI</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="label">Sudah terima dari</th>
                    <td class="value">: {{ \App\Models\Transaksi::find($kuitansi->transaksi_id)->customer_name }}</td>
                </tr>
                <tr>
                    <th class="label">Banyaknya uang</th>
                    <td class="value">: Rp. {{ number_format($kuitansi->total_biaya, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="label">Metode Pembayaran</th>
                    <td class="value">: 
                        @if($kuitansi->receipt_method == 1)
                            Cash (Tunai)
                        @elseif($kuitansi->receipt_method == 2)
                            Transfer Bank
                        @else
                            Metode Tidak Diketahui
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="label">Terbilang</th>
                    <td class="value">: 
                        <div style="display: inline-block; border: 1px solid black; padding: 3px;">
                            <?php
                            function terbilang($angka){
                                $angka = abs($angka);
                                $baca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                                $hasil = "";
                                if ($angka < 12) {
                                    $hasil = " " . $baca[$angka];
                                } else if ($angka < 20) {
                                    $hasil = terbilang($angka - 10) . " belas";
                                } else if ($angka < 100) {
                                    $hasil = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
                                } else if ($angka < 200) {
                                    $hasil = " seratus" . terbilang($angka - 100);
                                } else if ($angka < 1000) {
                                    $hasil = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
                                } else if ($angka < 2000) {
                                    $hasil = " seribu" . terbilang($angka - 1000);
                                } else if ($angka < 1000000) {
                                    $hasil = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
                                } else if ($angka < 1000000000) {
                                    $hasil = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
                                } else if ($angka < 1000000000000) {
                                    $hasil = terbilang($angka / 1000000000) . " milyar" . terbilang($angka % 1000000000);
                                } else if ($angka < 1000000000000000) {
                                    $hasil = terbilang($angka / 1000000000000) . " trilyun" . terbilang($angka % 1000000000000);
                                } else {
                                    $hasil = "Angka terlalu besar";
                                }
                                return $hasil;
                            }
                            
                            $uang_terbilang = terbilang($kuitansi->total_biaya);
                            echo ucwords($uang_terbilang)  . " Rupiah"; // Menambahkan "Rupiah" sebelum terbilang dan membuat huruf pertama setiap kata menjadi huruf besar
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="label">Untuk Pembayaran</th>
                    <td class="value">: 
                        @if ($kuitansi->receipt_status == 1)
                            Uang Muka Penyewaan mobil dengan nomor transaksi {{ \App\Models\Transaksi::find($kuitansi->transaksi_id)->transaksi_no }}.

                            <br>&nbsp; Harap menyelesaikan sisa pembayaran sebelum tanggal {{ \App\Models\Transaksi::find($kuitansi->transaksi_id)->invoice_due }}.
                        @elseif ($kuitansi->receipt_status == 3)
                            Penyewaan mobil dengan nomor transaksi {{ \App\Models\Transaksi::find($kuitansi->transaksi_id)->transaksi_no }} sudah lunas. Terima kasih atas pembayarannya.
                        @else
                            Status pembayaran tidak diketahui.
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="ttd">
                    <th colspan="2" style="text-align: right; padding-right: 2cm; font-weight: normal;">
                        Batam, <span id="formatted_date"></span>
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right; padding-right: 2cm;">Admin Staff&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>
        <script>
            window.onload = function () {
                window.print();
            };
        </script>
    </div>
</body>
<script>
    // Mendapatkan tanggal dari variabel PHP atau dari data lainnya
    var receiptDate = "{{ $kuitansi->receipt_date }}";
    
    // Mendefinisikan nama-nama bulan dalam bahasa Indonesia
    var monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    // Memformat tanggal
    var dateObj = new Date(receiptDate);
    var formattedDate = dateObj.getDate() + " " + monthNames[dateObj.getMonth()] + " " + dateObj.getFullYear();

    // Menampilkan hasilnya di dalam elemen dengan id "formatted_date"
    document.getElementById("formatted_date").textContent = formattedDate;
</script>
</html>
