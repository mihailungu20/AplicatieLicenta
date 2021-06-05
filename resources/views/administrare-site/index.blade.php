@extends('layouts.app')

@section('content')
<div class="container">
		<h2>Panou administrativ</h2>
		<br>

	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-departamente" data-toggle="tab" href="#departamente" role="tab" aria-controls="departamente" aria-selected="true">Listă utilizatori  <span class="badge badge-primary">{{ count($departamente) }}</span></a>
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
				<div class="tab-pane fade" id="departamente" role="departamente" aria-labelledby="tab-departamente">
					<div class="row justify-content-center">
						<div class="col-lg-6 col-md-6 col-sm-12">
						<hr>
							<div class="card">
								<div class="card-header">
									Departamente
								</div>
								<div class="card-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Denumire</th>
												<th>Cod Identificare</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody>
											@php
											$i = 1;
											@endphp
											@foreach($departamente as $departament)
											<tr>
												<td>{{ $i }}</td>
												<td>{{ $departament->denumire }}</td>
												<td>{{ $departament->cod }}</td>
												<td><a href="{{ url('departament/stergere/' . $departament->id) }}" class="btn btn-sm btn-danger">Șterge</a></td>
											</tr>
											@php
											$i++;
											@endphp
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
						<hr>
							<div class="card">
								<div class="card-header">
									Adăugare departament
								</div>
								<div class="card-body">
									<form method="POST" action="{{ route('adaugareDepartament') }}">
										@csrf
										<input type="hidden" name="departamentID" value="{{ $departament->id }}">
										<div class="form-group row">
											<label for="departamentTitlu" class="col-md-4 col-form-label text-md-right">Denumire departament:</label>
											<div class="col-md-8">
												<input id="departamentTitlu" type="text" class="form-control @error('departamentTitlu') is-invalid @enderror" name="departamentTitlu">
											</div>
										</div>
										<div class="form-group row">
											<label for="departamentCod" class="col-md-4 col-form-label text-md-right">Cod documente:</label>
											<div class="col-md-8">
												<input id="departamentCod" type="text" class="form-control" name="departamentCod">
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-sm float-right"><i class="far fa-plus-square"></i> Salveaza informatiile</button>
									</form>
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
									Setarile departamentului
								</div>
								<div class="card-body">
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