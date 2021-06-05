@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Acasa</a></li>
                <li class="breadcrumb-item"><a href="#">Logistica</a></li>
                <li class="breadcrumb-item"><a href="#">Articole</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ambalarea produselor pentru livrare</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    Adăugare articol
                </div>

                <div class="card-body">
                    @include('articole.formular-adaugare-articol')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
