<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota</title>

    <?php
    $style = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm
    ';
    ?>
    <?php
    $style .=
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
    ?>
    <?php
    $style .= '
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    ';
    ?>

    {!! $style !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">SushiB3SD</h3>
        <p>Jl. Drs.Haji.Th. Moh. Gobel No.21 RT.003/013, Mekarsari, Kec. Cimanggis, Kota Depok, Jawa Barat 16452</p>
    </div>
    <br>
    <table width="100%" style="border: 0;">
        <tr>
            <td>{{ date('d-m-Y') }}</td>
            <td class="text-right">{{ strtoupper(auth()->user()->name) }}</td>
        </tr>
        <tr>
            <td>Customer</td>
            <td class="text-right">{{ strtoupper($dataTransaksi->customer_name) }}</td>
        </tr>
    </table>
    <div class="clear-both" style="clear: both;"></div>
    {{-- <p>No: {{ $data->transaksi->transaction_code }}</p> --}}
    <p class="text-center">===================================</p>

    <br>
    <table width="100%" style="border: 0;">
        @foreach ($data as $transaksi)
            <tr>
                <td colspan="3">{{ $transaksi->produk->name }}</td>
            </tr>
            <tr>
                <td>{{ $transaksi->qty }} x {{ "Rp".number_format($transaksi->base_price,2,',','.') }}</td>
                <td></td>
                <td class="text-right">{{ "Rp".number_format($transaksi->qty * $transaksi->base_price,2,',','.') }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ "Rp".number_format($dataTransaksi->price_total,2,',','.') }}</td>
        </tr>
        <tr>
            <td>Uang Diterima:</td>
            <td class="text-right">{{ "Rp".number_format($dataTransaksi->accept,2,',','.') }}</td>
        </tr>
        <tr>
            <td>Uang Kembali:</td>
            <td class="text-right">{{ "Rp".number_format($dataTransaksi->return,2,',','.') }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>
