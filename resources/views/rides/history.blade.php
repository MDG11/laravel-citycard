@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>Vehicle Type</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Response</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rides as $ride)
                        <tr>
                            <td>{{ $ride->id }}</td>
                            <td>{{ $ride->city->city }}</td>
                            <td>{{ $ride->vehicle->vehicle_type->type }}</td>
                            <td>{{ number_format($ride->price/100, 2) }}$</td>
                            <td>{{ $ride->created_at }}</td>
                            <td>{{ $ride->response }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rides->links() }}

        </div>
    </div>
@endsection
