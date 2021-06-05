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
		<div class="col-lg-12 col-md-12 col-sm-12">
			<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-vizualizare" data-toggle="tab" href="#vizualizare" role="tab" aria-controls="vizualizare" aria-selected="true">Vizualizare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-editare" data-toggle="tab" href="#editare" role="tab" aria-controls="editare" aria-selected="false">Editare</a>
                </li>
            </ul>		
		</div>
	</div>

    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
        <hr>
        <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="vizualizare" role="tabpanel" aria-labelledby="tab-vizualizare">
                    <div class="card">
                        <div class="card-header">
                            {{ $template->titlu }}
                        </div>
                        <div class="card-body ck-content">
                            {!! $template->format !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="editare" role="tabpanel" aria-labelledby="tab-editare">
                    <form id="editor" method="POST" action="{{ route('editareTemplate') }}">
                        @csrf
                        <input type="hidden" name="templateID" value="{{ $template->id }}">
                        <textarea id="editorTemplate" name="editorTemplate" class="editor">{!! $template->format !!}</textarea>
                        <button type="submit" class="btn btn-success">Salvează modificările</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
	var ele = "#editor";
if(ele.addEventListener){
    ele.addEventListener("submit", callback, false);  //Modern browsers
}else if(ele.attachEvent){
    ele.attachEvent('onsubmit', callback);            //Old IE
}
</script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckeditor/editor.js') }}"></script>
@endpush
@endsection
