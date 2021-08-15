@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create new City</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cities.update', ['city' => $city->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-input">
                            <label for="city">City name</label>
                            <input type="text" class="input-form" name="city" id="city" placeholder="{{ $city->city }}" value="{{ $city->city }}" required>
                        </div>
                        <div class="form-input">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection