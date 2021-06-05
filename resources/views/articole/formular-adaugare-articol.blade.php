<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
        <form method="POST" action="{{ url('/articole/scrie') }}">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="articolTitlu" class="text-md-right">Titlu:</label>
							</div>
							<div class="col-md-8">
								<input id="articolTitlu" type="text" class="form-control" name="articolTitlu">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="articolCategorie" class="text-md-right">Categorie:</label>
							</div>
							<div class="col-md-9">
								<select name="articolCategorie" class="form-control">
									@foreach($categorii as $categorie)
										<option value="{{ $categorie->id }}">{{ $categorie->denumire }}</div>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="articolCod" class="text-md-right">Cod identificare:</label>
							</div>
							<div class="col-md-8">
								<input id="articolCod" type="text" class="form-control" name="articolCod">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="articolTemplate" class="text-md-right">Format:</label>
							</div>
							<div class="col-md-9">
								<select name="articolTemplate" id="articolTemplate" class="form-control">
									@foreach($template as $format)
										<option value="{{ $format->id }}">{{ $format->titlu }}</div>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-primary btn-sm float-right">Scrie articol</button>
		</form>
        </div>
    </div>
</div>
