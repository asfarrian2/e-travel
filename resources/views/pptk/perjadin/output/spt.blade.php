<!DOCTYPE html>
<html>
<head>
	<!-- PAGE TITLE HERE -->
	<title>E-Travel BPKUK</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/profile/Default Picture Profile.png') }}" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <style>
         @page {
             margin-top: 0.1in;
             margin-right: 0.5in;
             margin-bottom: 0.5in;
             margin-left: 0.5in;
         }
     
         body {
             margin: 0;
         }

        .watermark {
            position: fixed;
            bottom: 15px;
            right: 20px;
            font-size: 9px;
            color: #999;
            opacity: 0.4;
            font-style: italic;
        }

        .title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18,67px;
            font-weight: bold;
        }

        .text {
        font-family: 'Times New Roman', Times, serif;
        font-size: 16px;

        }

        .tabelkolom {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelkolom tr th {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            border: 1px solid #131212;
            padding: 8px;
            font-size: 11px;
            background-color:rgb(165, 219, 255);
        }

        .tabelkolom tr td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            border: 1px solid #131212;
            padding: 5px;
            font-size: 10px;
        }

        .foto {
            width: 40px;
            height: 30px;

        }
    </style>

</head>
<body>
    @php
        $image_path = public_path('assets/images/laporan/kop.png');
        $image_data = base64_encode(file_get_contents($image_path));  
    @endphp
    <img src="data:image/png;base64,{{ $image_data }}" alt="Logo" style="width: 100%">
    <br>
    {{-- Head SPT --}}
    <table style="width: 100%">
        <tr>
            <td style="text-align: center;" colspan="10">
                <span class="title">
                      <u>SURAT PERINTAH TUGAS</u>
                </span>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="10">
                <span class="text">
                      NOMOR : 800.1.11.1/ &nbsp; &nbsp; &nbsp; &nbsp;/22.6/BPKUK/2026
                </span>
            </td>
        </tr>
    </table>
    <br>
    {{-- Dasar Perjalanan --}}
    <table class="text" style="margin-left: 60px;">
        <tr>
            <td style="width: 90px; vertical-align: top;" rowspan="2">DASAR</td>
            <td style="vertical-align: top;" rowspan="2">:</td>
            <td style="vertical-align: top;">1. </td>
            <td style="width: 500px;">DPA-SKPD Nomor {{ $tahun->dpa}}<br> Tanggal {{ \Carbon\Carbon::parse($tahun->tgl_dpa)->locale('id')->translatedFormat('d F Y') }}
                T.A. {{ $tahun->tahun }}</td>
        </tr>
        <tr>
        @if ($perjadin->dasar == '-')
            <td></td>
        @else
            <td style="vertical-align: top;">2.</td><td style="text-align: justify">{{ $perjadin->dasar }}</td>
        @endif
        </tr>
    </table>
    <br>
    {{-- MEMERINTAHKAN --}}
    <span class="title" style="display: block; text-align: center;"> MEMERINTAHKAN :</span>
    <br>
    <table class="text" style="margin-left: 60px">
        <tr>
            <td style="vertical-align: top; width: 90px">Kepada :</td>
            <td style="vertical-align: top; width: 25px">
            @foreach ($pelperjadin as $d )
                {{$loop->iteration}}. <br><br><br><br>@if ($d->pelaksana->pangkgol == NULL)@else<br>@endif
            @endforeach
            </td>
            <td style="vertical-align: top;">
            @foreach ($pelperjadin as $d )
            Nama
            @if ($d->pelaksana->pangkgol == NULL)
            @else
            <br>
            Pangkat/Gol.
            @endif
            <br>
            N I P
            <br>
            Jabatan
            <br>
            <br>
            @endforeach
            </td>
            <td style="vertical-align: top;">
            @foreach ($pelperjadin as $d )
            : <b>{{ $d->pelaksana->nama}}</b>    
             @if ($d->pelaksana->pangkgol == NULL)
            @else
            <br>
            : {{ $d->pelaksana->pangkgol}}
            @endif
            <br>
            : {{ $d->pelaksana->nip}}
            <br>
            : {{ $d->pelaksana->jabatan}}
            <br>
            <br>
            @endforeach
            </td>
        </tr>
    </table>

    {{-- KEPERLUAN --}}
    <table class="text" style="margin-left: 60px;">
        <tr>
            <td style="vertical-align: top;">Untuk :</td>
            <td style="vertical-align: top; text-align:justify; width: 550px">
                {{ $perjadin->keperluan}} ({{ $perjadin->tujuan }})
                pada Tanggal {{ \Carbon\Carbon::parse($perjadin->tgl_berangkat)->locale('id')->translatedFormat('d F Y') }}.
            </td>
    </table>
    <br>
    {{-- TTD --}}
    <table class="text" style="margin-left: 10px; border-collapse: collapse;">
        <tr>
            <td style="vertical-align: top;  width: 350px"></td>
            <td style="vertical-align: top;  text-align:justify;">
                <b>DITETAPKAN DI</b>
            </td>
            <td style="vertical-align: top; text-align:justify;">
                <b>: BANJARBARU</b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top; text-align:justify;">
                <b>PADA TANGGAL</b>
            </td>
            <td style="vertical-align: top; text-align:justify;">
                <b>: {{ strtoupper(\Carbon\Carbon::parse($perjadin->tgl_berangkat)->locale('id')->translatedFormat('d F Y')) }}</b><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="vertical-align: top; text-align:center; ">
                <b>KEPALA BALAI</b>
                <br><br><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="vertical-align: top; text-align:center;">
                <b>{{ $kpa->pegawai->nama }}</b><br>{{ $kpa->pegawai->pangkgol }}<br>NIP. {{ $kpa->pegawai->nip }}
            </td>
        </tr>
    </table>

    <div class="watermark">
        Dikeluarkan Resmi: {{ config('app.name') }} | NPJ/{{ substr($perjadin->id_perjalanan, -4) }}/{{ $tahun->tahun }}
    </div>
    

    
</body>
</html>
