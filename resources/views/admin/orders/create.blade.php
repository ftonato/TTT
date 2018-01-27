@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<create-product
				name="new-order"
				action="{{ route('orders.store') }}"
				csrf="{{ csrf_token() }}"
				data-companies="{{json_encode($companies)}}"
				data-products="{{json_encode($products)}}"
				>
			</create-product>

			@if(session('message'))
			<div class="col-md-7 alert alert-success reset-m m-10">
				{{ session('message' )}}
			</div>
			@endif

		</div>
	</div>
</div>

@endsection
