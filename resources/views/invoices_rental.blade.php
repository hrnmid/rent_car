<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rental-Invoice</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <style>
        @import "https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700";

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        total,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block
        }

        body {
            line-height: 1
        }

        ol,
        ul {
            list-style: none
        }

        blockquote,
        q {
            quotes: none
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none
        }

        table {
            border-collapse: collapse;
            border-spacing: 0
        }

        body {
            height: 840px;
            width: 592px;
            margin: auto;
            font-family: 'Open Sans', sans-serif;
            font-size: 12px
        }

        strong {
            font-weight: 700
        }

        #container {
            position: relative;
            padding: 3%
        }

        #header {
            height: 80px
        }

        #header>#reference {
            float: left;
            text-align: left
        }

        #header>#reference h3 {
            margin: 0
        }

        #header>#reference h4 {
            margin: 0;
            font-size: 85%;
            font-weight: 600
        }

        #header>#reference p {
            margin: 0;
            margin-top: 2%;
            font-size: 85%
        }

        #header>#logo {
            width: 30%;
            float: left
        }

        #fromto {
            height: 160px
        }

        #fromto>#from,
        #fromto>#to {
            width: 45%;
            min-height: 85px;
            font-size: 95%;
            padding: 1.5%;
            line-height: 120%
        }

        #fromto>#from {
            float: left;
            width: 45%;
            font-size: 89%;
            padding: 1.5%;
            height: 85px;
        }

        #fromto>#to {
            float: right;
        }

        #items {
            margin-top: 10px
        }

        #items>p {
            font-weight: 700;
            text-align: right;
            margin-bottom: 1%;
            font-size: 65%
        }

        #items>table {
            width: 100%;
            font-size: 85%;
            border: solid 1px;
        }

        #items>table th:first-child {
            text-align: left
        }

        #items>table th {
            font-weight: 400;
            padding: 1px 4px
        }

        #items>table td {
            padding: 1px 4px
        }

        #items>table th:nth-child(2),
        #items>table th:nth-child(4) {
            width: 45px
        }

        #items>table th:nth-child(3) {
            width: 60px
        }

        #items>table th:nth-child(5) {
            width: 80px
        }

        #items>table tr td:not(:first-child) {
            text-align: right;
            padding-right: 1%
        }

        #items table td {
            border-right: solid 1px
        }

        #items table tr td {
            padding-top: 3px;
            padding-bottom: 3px;
            height: 10px
        }

        #items table tr:nth-child(1) {
            border: solid 1px;
        }

        #items table tr th {
            border-right: solid 1px;
            padding: 3px
        }

        #items table tr:nth-child(2)>td {
            padding-top: 8px
        }

        #summary {
            height: 110px;
            margin-top: 11px
        }

        #summary #note {
            float: left;
            border: 1px solid;
            padding: 2px;
            /* border-radius: 10px; */
            font-style: italic;
        }

        #summary #note h4 {
            font-size: 10px;
            font-weight: 600;
            font-style: italic;
            margin-bottom: 4px
        }

        #summary #note p {
            font-size: 10px;
            line-height: 1.6;
        }

        #summary #total table {
            font-size: 85%;
            width: 260px;
            float: right;
            border: 1px solid;
        }

        #summary #total table td {
            padding: 3px 4px
        }

        #summary #total table tr td:last-child {
            text-align: right
        }

        #summary #total table tr:nth-child(3) {
            background: #efefef;
            border: 1px solid;
            font-weight: 600
        }

        #footer {
            margin: auto;
            position: absolute;
            left: 4%;
            bottom: 4%;
            right: 4%;
            border-top: solid grey 1px
        }

        #footer p {
            margin-top: 1%;
            font-size: 65%;
            line-height: 140%;
            text-align: center
        }
        @media print {
            body {
                zoom: 150%;
            }

        }
    </style>

    <?php $page_count =1; foreach ($obj as $key => $val) { ?>
    <?php if($page_count > 1){ ?>
    <?php } ?>
        <div id="container">
            <div id="header">
                <div id="logo" style="margin-top:8px">
                    <img src="{{ asset('images/logo.png') }}" alt="" width="160">
                </div>
                <div id="reference" style="margin-top:5px">
                    <h1 style="font-size:20px;color:rgb(22, 22, 128);"><strong>LAKITAN RENTAL MOBIL</strong></h1>
                    <h4 style="font-size:12px;margin-top:5px;color:blue;">Jadikan perjalanan Anda menyenangkan</h4>
                    <h4 style="margin-top:5px">Jl. Brigjen Katamso, Tj. Uncang, Kec. Batu Aji, Kota Batam, Kepulauan Riau</h4>
                    <h4 style="margin-top:3px">Hotline: 0812 3456 7890 | Website : app.projecthree.my.id</h4>
                </div>
            </div>
            <hr>
            <div id="invoice" style="float:right;margin-top:10px;margin-right:10px">
                <h1><strong>INVOICE</strong></h1>

            </div>
                <div id="fromto">
                    <div id="from" style="border:1px solid;margin-top:30px;">
                    <p style="line-height: 1.8em;">
                        <strong>Nama :</strong> {{ $obj[$key]['pa']['customer_name'] }}<br>
                        <strong>No HP :</strong> {{ $obj[$key]['pa']['customer_phone'] }}<br>
                        <strong>Email :</strong> {{ $obj[$key]['pa']['customer_email'] }}<br>
                        <strong>Alamat :</strong> {{ $obj[$key]['pa']['customer_address'] }},
                        {{\App\Models\Kecamatan::find($obj[$key]['pa']['customer_kecamatan'])->name}},
                        {{\App\Models\Kelurahan::find($obj[$key]['pa']['customer_kelurahan'])->name}}
                    </p>
                </div>

                <div id="to" style="border:1px solid;margin-top:8px">
                    <div style="float:left; line-height: 1.8em;"> <!-- Adjusted for 1.5 cm spacing -->
                        <div><strong>Tanggal Invoice</strong></br>
                            {{ $obj[$key]['pa']['invoice_date'] }}
                        </div>
                        <div><strong>Jatuh Tempo</strong></br>
                            ‎{{ $obj[$key]['pa']['invoice_due'] }}
                        </div>
                    </div>
                    <div style="float:right; margin-right:65px; line-height: 1.8em;"> <!-- Adjusted for 1.5 cm spacing -->
                        <div><strong>Invoice No.</strong></br>
                            {{ $obj[$key]['pa']['invoice_no'] }}
                        </div>
                        <div>
                            <strong>Pembayaran</strong></br>
                            @if ($obj[$key]['pa']['payment_mode'] == 1)
                                Cash
                            @elseif ($obj[$key]['pa']['payment_mode'] == 2)
                                Transfer Bank
                            @else
                                {{ $obj[$key]['pa']['payment_mode'] }}
                            @endif
                        </div>

                    </div>
                </div>

            </div>
            

            <div id="items">
                <?php $total = 0; ?> <!-- Initialize total outside the loop -->
                @foreach ($obj as $item)
                <?php $total += $item['pa']['total_biaya']; ?> <!-- Add the current item's total to the total -->
                <table>
                        <tr>
                            <th style="width:5px;padding:5px;">No</th>
                            <th style="width:2px;padding:5px">Tanggal</th>
                            <th style="width:200px;padding:5px">Keterangan</th>
                            <th style="padding:5px">Harga</th>
                        </tr>
                        <tr>
                            <td style="text-align:center">
                                <?php echo $page_count++;?>
                            </td>
                            <td style="text-align:center">
                                {{ $item['pa']['booking_date'] }}
                            </td>
                            <td style="text-align:left">
                                Layanan : Rental Mobil  
                                @if ($item['pa']['jenis_sewa'] == 1)
                                    Harian
                                @elseif ($item['pa']['jenis_sewa'] == 2)
                                    Mingguan
                                @elseif ($item['pa']['jenis_sewa'] == 3)
                                    Bulanan
                                @endif
                            </td>
                            <td> 
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align:left">Mobil : {{ $item['pa']['mobil_merek'] }} </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align:left"> No Plat : {{ $item['pa']['mobil_noplat'] }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td  style="text-align:left"> Harga : Rp.
                                @if ($item['pa']['jenis_sewa'] == 1)
                                    {{\App\Models\Mobil::find($obj[$key]['pa']['mobil_id'])->sewa_harian}}
                                @elseif ($item['pa']['jenis_sewa'] == 2)
                                    {{\App\Models\Mobil::find($obj[$key]['pa']['mobil_id'])->sewa_mingguan}}
                                @elseif ($item['pa']['jenis_sewa'] == 3)
                                    {{\App\Models\Mobil::find($obj[$key]['pa']['mobil_id'])->sewa_bulanan}}
                                @endif x {{ $item['pa']['lama_sewa'] }} 
                                @if ($item['pa']['jenis_sewa'] == 1)
                                    Hari
                                @elseif ($item['pa']['jenis_sewa'] == 2)
                                    Minggu
                                @elseif ($item['pa']['jenis_sewa'] == 3)
                                    Bulan
                                @endif
                            </td>
                            <td>Rp.
                                {{ number_format( $item['pa']['total_biaya'] ) }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td></td>
                            <td style="text-align:left;font-style:italic;text-decoration: underline;">
                                <h2><strong>Note : silahkan melakukan pembayaran sesuai total nominal harga</strong></h2>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </table>
                @endforeach
            </div>

            <div id="summary">

                <div id="note" style="">
                    <p>Silakan melakukan pembayaran ke rekening di bawah ini :  </br>
                        Nama Penerima: <strong>LAKITAN RENTAL MOBIL</strong> </br>
                        Bank : <strong>Mandiri</strong>, A/C No : 111111111111111 </br>
                        Bank : <strong>BCA</strong>, A/C No : 111111111111111 </br>
                </div>
                <?php
                function terbilang($angka){
                    $angka = abs($angka);
                    $baca = array(
                        "", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"
                    );
                    $hasil = "";
                    if ($angka < 10) {
                        $hasil = $baca[$angka];
                    } else if ($angka < 20) {
                        $hasil = $baca[$angka - 10]." Belas";
                    } else if ($angka < 100) {
                        $hasil = terbilang($angka / 10)." Puluh ".$baca[$angka % 10];
                    } else if ($angka < 200) {
                        $hasil = "Seratus ".terbilang($angka - 100);
                    } else if ($angka < 1000) {
                        $hasil = terbilang($angka / 100)." Ratus ".terbilang($angka % 100);
                    } else if ($angka < 2000) {
                        $hasil = "Seribu ".terbilang($angka - 1000);
                    } else if ($angka < 1000000) {
                        $hasil = terbilang($angka / 1000)." Ribu ".terbilang($angka % 1000);
                    } else if ($angka < 1000000000) {
                        $hasil = terbilang($angka / 1000000)." Juta ".terbilang($angka % 1000000);
                    } else if ($angka < 1000000000000) {
                        $hasil = terbilang($angka / 1000000000)." Milyar ".terbilang($angka % 1000000000);
                    } else if ($angka < 1000000000000000) {
                        $hasil = terbilang($angka / 1000000000000)." Trilyun ".terbilang($angka % 1000000000000);
                    }
                    return $hasil;
                }


                // Penggunaan:
                $total_terbilang = terbilang($total);
                ?>

                <div id="total">
                    <table border="1">
                        <tr>
                            <td>Subtotal</td>
                            <td>Rp. {{ number_format($total) }}</td>
                        </tr>
                        <tr>
                            <td> ㅤ</td>
                            <td> ㅤ</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>Rp. {{ number_format($total) }}</td>
                        </tr>
                        <tr>
                            <td>Terbilang</td>
                            <td><?php echo $total_terbilang ?>Rupiah</td>
                        </tr>

                        
                    </table>
                    
                    
                </div>
                
            </div>
                
        </div></br>
            <div style="float:left; margin-left:50px"> Hormat kami,
                <div style="margin-top:5px;">
                    <strong>LAKITAN RENTAL</strong>
                </div>
                <div style="margin-top:90px;">
                    Admin Staff
                </div>
            </div>

            {{-- <div style="float:right; margin-right:180px"> Diterima oleh
                <div style="margin-top:90px;">
                    {{ Auth::user()->name }}
                </div>
                <hr style="margin-top:100px">
            </div> --}}
    <?php $page_count++; }  ?>
</body>
<script>
    $(document).ready(function () {
        window.print();
    });
</script>

</html>