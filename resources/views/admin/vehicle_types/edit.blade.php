@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Card Type</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vehicle-types.update', $type->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-input">
                            <label for="city">Type</label>
                            <input type="text" class="input-form" name="type" id="type" placeholder="{{ $type->type }}" value="{{ $type->type }}" required>
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