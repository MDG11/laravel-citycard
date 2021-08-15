@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>License plate</th>
                    <th>Type</th>
                    <th>City</th>
                    <th>Actions</th>
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success">Create new</a>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->licence_plate_number }}</td>
                            <td>{{ $vehicle->vehicle_type->type }}</td>
                            <td>{{ $vehicle->city->city }}</td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.vehicles.destroy',$vehicle->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $vehicles->links() }}
        </div>
    </div>
@endsection