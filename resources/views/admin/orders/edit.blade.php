
@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-6">
					<h3>Meus pedidos - Empresa <u>{{ $company->name }}</u></h3>

					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center">Código do Pedido</th>
								<th class="text-center">Itens do pedido</th>
								<th class="text-center">Ações</th>
							</tr>
						</thead>
						<tbody>
							@if (empty($orders))
							<tr>
								<td colspan="3" class="warning">Nothing to see here!</td>
							</tr>
							@else
							@foreach ($orders as $order)
							<tr class="text-center">
								<td class="cell-center">{{ $order->id }}</td>
								<td>
									@if (!empty($order->OrderItems))
									@foreach ($order->OrderItems as $key => $item)

									@if (!empty($item->products))
									{{ $item->quantity }}x - {{ $item->products[0]['name'] }}<br>
									@endif

									@endforeach
									@endif
								</td>
								<td class="cell-center">
									@if ($order->status == 'activated')
									<form class="form-horizontal" name="edit-order" action="{{ route('orders.update', $order->id) }}" method="POST">
										{{ method_field('PUT') }}
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="status" value="canceled">

										<button type="submit" class="btn btn-link">Cancelar</button>
									</form>
									@else
									Cancelado
									@endif
								</td>
							</tr>
							@endforeach
							@endif

						</tbody>
					</table>

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
