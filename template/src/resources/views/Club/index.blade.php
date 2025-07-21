<!-- src/resources/views/clubs/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Klub</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nama Klub</th>
                <th>Lokasi</th>
                <th>Jumlah Pemain</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubs as $club)
            <tr>
                <td>
                    <a href="{{ route('clubs.show', $club->id) }}">
                        {{ $club->name }}
                    </a>
                </td>
                <td>{{ $club->location }}</td>
                <td>{{ $club->players->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection