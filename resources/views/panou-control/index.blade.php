@extends('layouts.app')

@section('content')
<div class="container">
		<h2>Panou control pentru {{ $departament->denumire }}</h2>
		<br>

	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-utilizatori" data-toggle="tab" href="#utilizatori" role="tab" aria-controls="utilizatori" aria-selected="true">Listă utilizatori  <span class="badge badge-primary">{{ count($utilizatori) }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-functii" data-toggle="tab" href="#functii" role="tab" aria-controls="functii" aria-selected="false">Funcțiile departamentului <span class="badge badge-primary">{{ count($functii) }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-categorii" data-toggle="tab" href="#categorii" role="tab" aria-controls="categorii" aria-selected="false">Categorii <span class="badge badge-primary">{{ count($categorii) }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-articole" data-toggle="tab" href="#articole" role="tab" aria-controls="articole" aria-selected="false">Articole de aprobat <span class="badge badge-primary">{{ count($articole) }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-template" data-toggle="tab" href="#template" role="tab" aria-controls="template" aria-selected="false">Template articole <span class="badge badge-primary">{{ count($template) }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-setari" data-toggle="tab" href="#setari" role="tab" aria-controls="setari" aria-selected="false">Setările departamentului</a>
                </li>
            </ul>		
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="utilizatori" role="tabpanel" aria-labelledby="tab-utilizatori">
				<div class="col-lg-12 col-md-12 col-sm-12">
						<hr>
							<div class="card">
								<div class="card-header">
									Lista utilizatorilor
								</div>
								<div class="card-body">
									<table class="table table-hover">
										</thead>
											<tr>
												<th>ID Utilizator</th>
												<th>Nume / Prenume</th>
												<th>Functie</th>
												<th>Telefon</th>
												<th>Adresa email</th>
												<th>Editor?</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody>
											@foreach($utilizatori as $utilizator)
											<tr>
												<td>{{ $utilizator->id }}</td>
												<td>{{ $utilizator->name }}</td>
												<td>{{ $utilizator->functie }}</td>
												<td>{{ $utilizator->telefon }}</td>
												<td>{{ $utilizator->email }}</td>
												<td>{{ ($utilizator->id == 1 ? "Da" : "Nu") }}</td>
												<td><a href="{{ url('user/profil/' . $utilizator->id) }}" class="btn btn-success btn-sm">A</a></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="card-footer">
									<a href="{{ url('/articole/adauga') }}" class="btn btn-primary btn-sm float-right"><i class="far fa-plus-square"></i> Salveaza informatiile</a>
								</div>
							</div>
						</div>
                </div>
                <div class="tab-pane fade" id="functii" role="tabpanel" aria-labelledby="tab-functii">
                    <div class="row justify-content-center">
						<div class="col-lg-6 col-md-6 col-sm-12">
						<hr>
							<div class="card">
								<div class="card-header">
									<b>Funcții disponibile</b>
								</div>
								<div class="card-body">
									<table class="table">
										<thead>
											<tr>
												<th>Titlu</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										@if(count($functii) > 0)
										<tbody>
											@foreach($functii as $functie)
											<tr>
												<td>{{ $functie->titlu }}</td>
												<td>&nbsp;</td>
											</tr>
											@endforeach
										</tbody>
										@else
										<tbody>
											<tr>
												<td colspan="2">Nicio functie nu este disponibila pentru acest departament.</td>
											</tr>
										</tbody>
										@endif
									</table>
									<hr>
									<form method="POST" action="{{ route('adaugaFunctie') }}">
										@csrf
										<input type="hidden" name="departamentID" value ="{{ $departament->id }}">
										<div class="form-group row">
											<label for="departamentTitluFunctie" class="col-md-4 col-form-label text-md-right">Titlu:</label>
											<div class="col-md-8">
												<input id="departamentTitluFunctie" type="text" class="form-control @error('departamentTitluFunctie') is-invalid @enderror" name="departamentTitluFunctie">
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-sm float-right"><i class="far fa-plus-square"></i> Salveaza informatiile</button>
									</form>
								</div>
							</div>

						</div>
					</div>
                </div>
                <div class="tab-pane fade" id="categorii" role="tabpanel" aria-labelledby="tab-categorii">
                    <div class="row justify-content-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<hr>
							<div class="card">
								<div class="card-header">
									<b>Categorii</b>
								</div>
								<div class="card-body">
								@if(count($categorii) == 0)
									<p>Nici o categorie nu a fost definita pentru acest departament.</p>
								@else
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Denumire</th>
												<th>Cod unic</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody>
											@php
											$i = 1;
											@endphp
											@foreach($categorii as $categorie)
											<tr>
												<td>{{ $i }}</td>
												<td>{{ $categorie->denumire }}</td>
												<td>{{ $categorie->cod }}</td>
												<td><a href="#" class="btn btn-danger btn-xs">Șterge</a></td>
											</tr>
											@php
											$i++;
											@endphp
											@endforeach
										</tbody>
									</table>
								@endif
								<hr>
									<form method="POST" action="{{ route('postareCategorie') }}">
										@csrf
										<input type="hidden" name="departamentID" value="{{ $departament->id }}">
										<div class="form-group row">
											<label for="departamentAdaugaCategorieDenumire" class="col-md-4 col-form-label text-md-right">Denumire categorie:</label>
											<div class="col-md-8">
												<input id="departamentAdaugaCategorieDenumire" type="text" class="form-control @error('departamentAdaugaCategorieDenumire') is-invalid @enderror" name="departamentAdaugaCategorieDenumire">
											</div>
										</div>

										<div class="form-group row">
											<label for="departamentAdaugaCategorieCod" class="col-md-4 col-form-label text-md-right">Cod identificare:</label>
											<div class="col-md-8">
												<input id="departamentAdaugaCategorieCod" type="text" class="form-control @error('departamentAdaugaCategorieCod') is-invalid @enderror" name="departamentAdaugaCategorieCod">
											</div>
										</div>

										<button type="submit" class="btn btn-primary btn-sm float-right"><i class="far fa-plus-square"></i> Salvează informațiile</button>
									</form>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="tab-pane fade" id="articole" role="tabpanel" aria-labelledby="tab-articole">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<hr>
							<div class="card">
								<div class="card-header">
									Lista articolelor neaprobate
								</div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Titlu</th>
												<th>Categorie</th>
												<th>Cod identificare</th>
												<th>Autor</th>
												<th>Data</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody>
										@foreach($articole as $articol)
											<tr>
												<td>{{ $articol['titlu'] }}</td>
												<td>{{ $articol['categorie'] }}</td>
												<td>{{ $articol['cod'] }}</td>
												<td>{{ $articol['autor'] }}</td>
												<td>{{ $articol['data'] }}</td>
												<td><a href="{{ url('articole/vizualizare/' . $articol['id']) }}" class="btn btn-success btn-sm">Aproba</a></td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
								<div class="card-footer">

								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="tab-template">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<hr>
							<div class="card">
								<div class="card-header">
									Setarile departamentului
								</div>
								<div class="card-body">
									<div class="row">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Titlu</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
											@if(count($template) == 0)
												<tr>
													<td colspan="4">Nu este definit niciun template pentru articolele acestui departament.</td>
												</tr>
											@else
												@foreach ($template as $format)
													<tr>
														<td>1</td>
														<td>{{ $format->titlu }}</td>
														<td><a href="{{ url('/template/vizualizare/' . $format->id) }}" class="btn btn-sm btn-primary">Vizualizează</a> <a href=" {{ url('/template/stergere/' . $format->id) }}" class="btn btn-sm btn-danger">Șterge</a></td>
													</tr>
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<hr>
										<form method="POST" action="{{ route('postareTemplate') }}">
											@csrf
											<input type="hidden" name="departamentID" value="{{ $departament->id }}">
											<div class="form-group row">
												<label for="departamentAdaugaTemplateDenumire" class="col-md-4 col-form-label text-md-right">Denumire template:</label>
												<div class="col-md-8">
													<input id="departamentAdaugaTemplateDenumire" type="text" class="form-control" name="departamentAdaugaTemplateDenumire">
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-sm float-right">Salvează informațiile</button>
											
										</form>
										<div class="clearfix">&nbsp;</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>

                </div>
				<div class="tab-pane fade" id="setari" role="tabpanel" aria-labelledby="tab-setari">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<hr>
							<div class="card">
								<div class="card-header">
									Setările departamentului
								</div>
								<div class="card-body">
									<form method="POST" action="{{ route('actualizareDepartament') }}">
										@csrf
										<input type="hidden" name="departamentID" value="{{ $departament->id }}">
										<div class="form-group row">
											<label for="departamentTitlu" class="col-md-4 col-form-label text-md-right">Denumire departament:</label>
											<div class="col-md-8">
												<input id="departamentTitlu" type="text" class="form-control @error('departamentTitlu') is-invalid @enderror" name="departamentTitlu" value="{{ $departament->denumire }}">
											</div>
										</div>

										<div class="form-group row">
											<label for="departamentCodDocumente" class="col-md-4 col-form-label text-md-right">Cod documente:</label>
											<div class="col-md-8">
												<input id="departamentCodDocumente" type="text" class="form-control @error('departamentCodDocumente') is-invalid @enderror" name="departamentCodDocumente" value="{{ $departament->cod }}">
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-sm float-right"><i class="far fa-plus-square"></i> Salvează informațiile</button>
									</form>
								</div>
							</div>
						</div>
					</div>

                </div>
            </div>
		</div>
	</div>	
</div>
@endsection