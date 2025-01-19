@extends('guru.template.main')

@section('title', 'Guru-Wallet')

@push('style')
@endpush

@section('content')
    @include('wallet.index')
@endsection

@push('script')
    @include('wallet.script')
@endpush