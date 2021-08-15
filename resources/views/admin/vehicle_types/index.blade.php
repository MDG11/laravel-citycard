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
                    <th>Type</th>
                    <th>Actions</th>
                    <a href="{{ route('admin.vehicle-types.create') }}" class="btn btn-success">Create new</a>
                </thead>
                <tbody>
                    @foreach ($vehicle_types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->type }}</td>
                            <td>
                                <a href="{{ route('admin.vehicle-types.edit', $type->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.vehicle-types.destroy',$type->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection