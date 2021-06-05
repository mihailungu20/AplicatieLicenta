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
					Vizualizare profil {{ $user->name }}
					@if($user->id === Auth::user()->id || Auth::user()->administrator == 1)
						<button class="float-right btn btn-sm btn-inverse">Editare</button>
					@endif
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-12">
							<div class="card">
								<div class="card-body">
									<img class="img-fluid img-responsive rounded-circle mr-2" src="https://avatars.dicebear.com/api/male/lungu-mihai.svg?mood[]=happy">
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12">
                            <dl class="row">
                                <dt class="col-sm-3">Nume:</dt>
                                <dd class="col-sm-9">{{ $user->name }}</dd>
                                <dt class="col-sm-3">Email:</dt>
                                <dd class="col-sm-9">{{ $user->email }}</dd>
                                <dt class="col-sm-3">Numar telefon:</dt>
                                <dd class="col-sm-9">{{ ($user->telefon != null) ? $user->telefon : "-" }}</dd>
                                <dt class="col-sm-3">Departament:</dt>
                                <dd class="col-sm-9">Logistica</dd>
                                <dt class="col-sm-3">Functie:</dt>
                                <dd class="col-sm-9">{{ $userData['functie'] }}</dd>
                                <dt class="col-sm-3">Locatie:</dt>
                                <dd class="col-sm-9">{{ ($user->locatie != null) ? $user->locatie : "-" }}</dd>
                                <dt class="col-sm-3">Birou:</dt>
                                <dd class="col-sm-9">{{ ($user->birou != null) ? $user->birou : "-" }}</dd>
                            </dl>
						</div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <button class="btn btn-dark btn-block">Trimite mesaj privat</button>
                        </div>
					</div>
				</div>
				<div class="card-footer">
					Cont creat la data de {{ $user->created_at }}
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="card">
				<div class="card-header">
					Articole scrise
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Titlu</th>
								<th>Categorie</th>
								<th>Dată aprobare</th>
							</tr>
						</thead>
						@if($articole)
						@php
						$i = 1;
						@endphp
                        <tbody>
							@foreach($articole as $articol)
                            <tr>
                                <td scope="row">{{ $i }}</td>
    							<td><a href="{{ url('/articole/vizualizeaza/1') }}">{{ $articol->titlu }}</a></td>
    							<td><a href="{{ url('/articole/vizualizeaza/1') }}">Livrari</a></td>
    							<td><span class="text-muted">{{ $articol->aprobat_la }}</span></td>
    						</tr>
							@php
							$i++
							@endphp
							@endforeach
                        </tbody>
						@endif
					</table>
				</div>
			</div>

		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
</div>
@endsection
