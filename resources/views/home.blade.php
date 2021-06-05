@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		@if($departamente)
		@foreach($departamente as $d)
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header {{ ($d['id'] == Auth::user()->departamentID) ? ' text-white bg-primary' : '' }} mb-3">
					<b>{{ $d['denumire'] }}</b>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Titlu</th>
								<th>Categorie</th>
								<th>Autor</th>
								<th>Data publicării</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($d['articole']))
							@php
							$i = 1;
							@endphp
							@foreach($d['articole'] as $articol)
							<tr>
							  	<td scope="row">{{ $i }}</td>
							   	<td><a href="{{ url('/articole/vizualizare/' . $articol['id']) }}">{{ $articol['titlu'] }}</a></td>
							   	<td><a href="{{ url('/articole/vizualizare/' . $articol['id']) }}">{{ $articol['categorie'] }}</a></td>
							   	<td>{{ $articol['autor'] }}</td>
							  	<td><span class="text-muted">{{ $articol['data'] }}</span></td>
							</tr>
							@php
							$i++;
							@endphp
							@endforeach
						@else
							<tr>
							  	<td colspan="5">Nici un articol nu este disponibil pentru acest departament.</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					@if(Auth::user()->departamentID == $d['id'])
					<span class="float-left">Cele mai noi 5 articole prezentate.</span><a href="{{ url('articole/adauga') }}" class="btn btn-primary btn-sm float-right">Adauga articol</a>
					@endif
				</div>
			</div>
			<br>
		</div>
		@endforeach
		@else 

		@endif
	</div>
</div>
@endsection