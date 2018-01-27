@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-5">

					<form class="form-horizontal" name="new-company" action="{{ route('companies.store') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
							<legend>Cadastro de empresa</legend>

							<div class="form-group">
								<label class="col-md-4 control-label" for="name">Nome fantasia</label>  
								<div class="col-md-8">
									<input name="name" placeholder="Nome fantasia" class="form-control input-md" type="text" value="{{ old('name') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="cnpj">CNPJ</label>  
								<div class="col-md-8">
									<input name="cnpj" placeholder="CNPJ" class="form-control input-md" type="text" value="{{ old('cnpj') }}">
								</div>
							</div>

							<div class="form-group control-label col-md-4">
								<button type="submit" class="btn btn-primary">Cadastrar</button>
							</div>

							@if (!empty($errors->all()))
							<div class="col-md-12 alert alert-danger reset-m m-10">
								<h5>Lista de erros</h5>
								<ul>
									@foreach ($errors->all() as $error)
									<li class="">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</fieldset>
					</form>

					@if(session('message'))
					<div class="col-md-12 alert alert-success reset-m m-10">
						{{ session('message' )}}
					</div>
					@endif

				</div>
			</div>
		</div>
	</div>
</div>


@endsection
