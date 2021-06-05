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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $articol->titlu }}
                </div>
                <div class="card-body">
                    <form id="editor" method="POST" action="{{ route('salvareArticol') }}">
                        @csrf
                        <input type="hidden" name="articolID" value="{{ $articol->id }}">
                        <textarea id="editorTemplate" name="articolText" class="editor ck-content">{!! $articol->text !!}</textarea>
                            <div class="form-group row">
								<div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="articolPentruAprobare" name="articolPentruAprobare">
                                        <label class="form-check-label" for="articolPentruAprobare">
                                            Trimite pentru aprobare
                                        </label>
                                    </div>
                                </div>
						    </div>
                        <button type="submit" class="btn btn-success">Salvează modificările</button>
                    </form>
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
