@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header">
					Formular adaugare categorie
				</div>
				<div class="card-body">
					<form>
						@csrf
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12">
                            	<label for="password" class="col-md-4 col-form-label text-md-right">Denumire categorie</label>
                            </div>
                            <div class="col-md-6">
                            	<input id="denumire" type="text" class="form-control " name="denumire" required autocomplete="off">
							</div>
                        </div>
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12">
                            	<label for="password" class="col-md-4 col-form-label text-md-right">Cuvinte cheie</label>
                            </div>
                            <div class="col-md-6">
                            	<input id="cuvinteCheie" type="text" class="form-control " name="cuvinteCheie" required autocomplete="off">
							</div>
                        </div>
                          	<div class="form-group">
								<div class="col-lg-6 col-md-6 col-sm-12">
							    	<label for="inputState">State</label>
							    </div>
	                            <div class="col-lg-6 col-md-6 col-sm-12">
							      	<select id="inputState" class="form-control">
							        	<option selected>Choose...</option>
							        	<option>...</option>
							      	</select>
							    </div>
						  	</div>
					</form>
				</div>
				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection