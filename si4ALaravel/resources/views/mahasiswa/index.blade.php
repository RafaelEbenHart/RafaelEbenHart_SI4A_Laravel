<H1>Mahasiswa</H1>

@extends('layout.main')
@section('content')
<table>
    <tr>
        <th>Nama</th>
        <th>NPM</th>
        <th>jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Asal Sma</th>
        <th>Prodi</th>
        <th>Foto</th>
    </tr>
    @foreach ($mahasiwa as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->npm }}</td>
            <td>{{ $item->jk }}</td>
            <td>{{ $item->tanggal_lahir }}</td>
            <td>{{ $item->asal_sma}}</td>
            <td>{{ $item->prodi->nama ?? '-'}}</td>
            <td>{{ $item->foto}}</td>
         </tr>

</table>
    @endforeach
@endsection