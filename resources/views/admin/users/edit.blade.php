@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8">

			<form class="form-horizontal" name="edit-user" action="{{ route('users.update', $user->id) }}" method="POST">
				{{ method_field('PUT') }}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<fieldset>
					<legend>Minha conta</legend>

					<div class="form-group">
						<label class="col-md-3 control-label" for="email">E-mail</label>
						<div class="col-md-5">
							<input disabled name="email" placeholder="E-mail" class="form-control input-md" type="text" value="{{ $user->email }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="password">Senha</label>
						<div class="col-md-5">
							<input name="password" placeholder="Senha" class="form-control input-md" type="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="password_confirmation">Repetir Senha</label>
						<div class="col-md-5">
							<input name="password_confirmation" placeholder="Senha" class="form-control input-md" type="password">
						</div>
					</div>

					<div class="form-group control-label col-md-8">
						<a class="btn btn-link" href="{{ route('home') }}">
							Cancelar
						</a>
						<button type="submit" class="btn btn-primary">Alterar dados</button>
					</div>

					@if (!empty($errors->all()))
					<div class="col-md-8 alert alert-danger reset-m m-10">
						<h5>Lista de erros</h5>
						<ul>
							@foreach ($errors->all() as $error)
							<li class="">{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					@if(session('message'))
					<div class="col-md-8 alert alert-success reset-m m-10">
						{{ session('message' )}}
					</div>
					@endif

				</fieldset>
			</form>

		</div>
	</div>
</div>


@endsection
