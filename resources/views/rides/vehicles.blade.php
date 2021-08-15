@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Price(For tour card type)</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->vehicle_type->type }}</td>
                            <td>{{ number_format($prices->where('vehicle_type_id', '=', $vehicle->vehicle_type_id)->first()->price / 100, 2) }}$
                            </td>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('rides.pay', ['vehicle_id' => $vehicle->id]) }}">Take a ticket</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $vehicles->links() }}

        </div>
    </div>
@endsection
