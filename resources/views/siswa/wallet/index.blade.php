@extends('siswa.template.main')

@section('title', 'Siswa-Wallet')

@push('style')
@endpush

@section('content')
    @include('wallet.index')
@endsection

@push('script')
    @include('wallet.script')
@endpush
