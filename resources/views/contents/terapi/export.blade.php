<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN HASIL TERAPI</title>
</head>

<body>
    <!-- ######## This is a comment  ######## -->
    <p style="text-align: center;"><strong>{{ $title }}</strong></p>
    <p><strong>&nbsp;</strong></p>
    <ol>
        <li><strong>Terapis</strong>
            <p>&nbsp;</p>
            <ul>
                <li>Nama Petugas: {{ $petugas }}</li>
                <li>Nama Peserta: {{ $nama }}</li>
            </ul>
        </li>
    </ol>
    <p>&nbsp;</p>
    <ol start="2">
        <li><strong>Keluhan</strong></li>
        <p>&nbsp;</p>
        <ol>
            {{ $keluhan }}
        </ol>
    </ol>
    <p style="padding-left: 60px;">&nbsp;</p>
    <ol start="3">
        <li><strong>Tanggapan</strong></li>
        <p>&nbsp;</p>
        <ol>
            {{ $tanggapan }}
        </ol>
    </ol>
    <p style="padding-left: 60px;">&nbsp;</p>
</body>

</html>
