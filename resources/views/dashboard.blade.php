@extends('layouts.app')

@section('header')
    Selamat Datang, {{ Auth::user()->nama_lengkap }}
@endsection

@section('content')
    @role('admin|pengelola')
        @include('partials.admin-dashboard', ['dataPeminjaman' => $peminjamans])
    @endrole('peminjam')
    @role('peminjam')
        @include('partials.peminjam-dashboard', ['dataPeminjaman' => $peminjamans])
    @endrole
@endsection
