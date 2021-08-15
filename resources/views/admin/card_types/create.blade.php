@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create new Card Type</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.card-types.store') }}" method="POST">
                        @csrf
                        <div class="form-input">
                            <label for="city">Type</label>
                            <input type="text" class="input-form" name="type" id="type" placeholder="Type" required>
                        </div>
                        <h1>Prices</h1><br><hr>
                        @foreach ($vehicle_types as $vehicle_type)
                            <div class="form-input">
                                <label for="price">Price for {{ $vehicle_type->type }} ticket(in cents)</label>
                                <input type="text" class="input-form" name="{{ $vehicle_type->id.'-price' }}" id="type" placeholder="price" required>
                            </div><br><hr><br>
                        @endforeach
                        <div class="form-input">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
