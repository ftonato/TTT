@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-6">
					<h1>Dashboard</h1>
					<h3>Minhas empresas</h3>

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nome fantasia</th>
								<th>CNPJ</th>
								<th>Qtd de pedidos</th>
							</tr>
						</thead>
						<tbody>
							@if (empty($companies))
							<tr>
								<td colspan="3" class="warning">Nothing to see here!</td>
							</tr>
							@else
							@foreach ($companies as $company)
							<tr>
								<td>{{ $company->name }}</td>
								<td>{{ $company->cnpj }}</td>
								<td class="text-center">
									@if ($company->amountOrders > 0)
									
									<a href="{{ route('orders.show', ['id' => $company->id]) }}">{{ $company->amountOrders }}</a>
									@else
									Nenhum
									@endif
								</td>
							</tr>
							@endforeach
							@endif

						</tbody>
					</table>

					@if (!empty($companies))
					<div>
						<!-- Paginate -->
						{{ $companies->links() }}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
