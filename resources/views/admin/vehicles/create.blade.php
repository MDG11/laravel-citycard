@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create new Vehicle Type</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vehicles.store') }}" method="POST">
                        @csrf
                        <div class="form-input">
                            <label for="plate">Plate</label>
                            <input type="text" class="form-input" name="licence_plate_number" id="type" pattern="[A-Z]{2}\d{4}[A-Z]{2}" placeholder="AA0000AA" required>
                        </div>
                        <div class="form-input">
                            <label for="city">City</label>
                            <select required name="city_id" id="city" class="form-input">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label for="vehicle_type">City</label>
                            <select name="vehicle_type_id" id="vehicle_type" class="form-input" required>
                                @foreach ($vehicle_types as $vehicle_type)
                                    <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->type }}</option>
                                @endforeach
                            </select>
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