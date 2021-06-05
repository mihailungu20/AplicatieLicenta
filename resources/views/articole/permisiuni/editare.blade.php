@extends('layouts.app')

@section('content')

@push('scritps')
<link href="{{ asset('css/editor.css') }}" rel="stylesheet">
<script>
	window.onload = function () {
    document.getElementById("editor").onsubmit = function onSubmit(form) {
        var isValid = true;
        //validate your elems here
        isValid = false;

        if (!isValid) {
            alert("Please check your fields!");
            return false;
        }
        else {
            //you are good to go
            return true;
        }
    }
}
</script>
@endpush

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
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    Acordă permisiuni vizualizare
                </div>
                <div class="card-body">
                @foreach($departamente as $departament)
                    @if(!$permisiuni->contains('departamentID', $departament->id))
                    @if(Auth::user()->departamentID != $departament->id)
                    <a href="{{ url('articole/permite/' . $articol->id . '/' . $departament->id) }}" class="btn btn-sm btn-success float-right">Permite vizualizarea</a>
                    <span class="float-left">{{ $departament->denumire }}</span>
                    <div class="clearfix">&nbsp;</div>
                    <hr>
                    @endif
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    Elimină permisiuni vizualizare
                </div>
                <div class="card-body">
                    @foreach($permisiuni as $permisiune)
                        <a href="{{ url('articole/revoca/' . $articol->id . '/' . $departament->id) }}" class="btn btn-sm btn-danger float-right">Revocă permisiunea de vizualizare</a>
                        <span class="float-left">{{ $listaDepartamente->get($permisiune->departamentID)->denumire }}</span>
                        <div class="clearfix">&nbsp;</div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckeditor/editor.js') }}"></script>
@endpush
@endsection
