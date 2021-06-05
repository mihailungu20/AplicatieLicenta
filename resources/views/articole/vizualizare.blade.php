@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Acasa</a></li>
                <li class="breadcrumb-item">{{ $articol['departament'] }}</li>
                <li class="breadcrumb-item">{{ $articol['categorie'] }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $articol['titlu'] }} <i>({{ $articol['codUnic'] }})</i></li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Titlu Articol<br>(cod articol)</th>
                                    <th>Scris de<br>(data)</th>
                                    <th>Aprobat de<br>(data)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $articol['titlu'] }}</td>
                                    <td>{{ $articol['autor'] }}</td>
                                    <td>{{ $articol['aprobat_de'] }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{ $articol['codUnic'] }}</td>
                                    <td>{{ $articol['data'] }}</td>
                                    <td>{{ $articol['aprobat_la'] }}</td>
                                </tr>
                            </tfoot>
                        </table>
                </div>

                <div class="card-body ck-content">
                    {!! $articol['text'] !!}
                </div>
                @if($articol['aprobat'] != 1)
                <div class="card-footer">
                    Acest articol necesita aprobare!
                </div>
                @endif
            </div>
            @if(Auth::user()->id == $articol['autorID'] || (Auth::user()->departamentID == $articol['departamentID'] && Auth::user()->responsabilDepartament == 1) || Auth::user()->administrator == 1)
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    @if(Auth::user()->id == $articol['autorID'] || (Auth::user()->departamentID == $articol['departamentID'] && Auth::user()->responsabilDepartament == 1) || Auth::user()->administrator == 1)
                        <a href="{{ url('articole/editare/' . $articol['id']) }}" class="btn btn-sm btn-success">Editează articolul</a>
                        <a href="{{ url('articole/permisiuni/' . $articol['id']) }}" class="btn btn-sm btn-dark">Permisiuni vizualizare</a>
                    @endif
                    @if((Auth::user()->departamentID == $articol['departamentID'] && Auth::user()->responsabilDepartament == 1) || Auth::user()->administrator == 1)
                         @if($articol['aprobat'] === 0)
                        <a href="{{ url('articole/aprobare/' . $articol['id']) }}" class="btn btn-sm btn-success">Aprobă</a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalRespingere">Respinge</a>
                        @elseif($articol['aprobat'] == 1)
                        @endif
                    @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="modalRespingere" tabindex="-1" role="dialog" aria-labelledby="modalRespingere" aria-hidden="true">
   <div class="modal-dialog" role="document">
   <form method="POST" action="{{ route('respingereArticol') }}" id="formularRespingere">
       @csrf
        <input type="hidden" name="articolID" value="{{ $articol['id'] }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRespingere">Respingere articol</h5>
            </div>
            <div class="modal-body">
                <p>Motivul respingerii:</p>
                <textarea class="form-control" name="motivRespingere"></textarea>
            </div>
            <div class="modal-footer">
                <button type="cangel" class="btn btn-secondary" data-dismiss="modal">Renunță</button>
                <button type="submit" class="btn btn-danger" onclick="form_submit()">Respinge</button>
            </div>
        </div>
    </form>
   </div>
</div>

@push('scripts')
<script src="{{ asset('js/jquery.js') }}">
<script>
function form_submit() {
    document.getElementById("formularRespingere").submit();
}  

</script>
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
