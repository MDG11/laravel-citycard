@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create new Card</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cards.store') }}" method="POST">
                        @csrf
                        <div class="form-input">
                            <label for="cnumber">Card number</label>
                            <input type="text" class="input-form" name="card_number" id="cnumber" placeholder="ads" required>
                        </div>
                        <div class="form-input">
                            <label for="ctype">Card type</label>
                            <select class="input-form" name="card_type" id="ctype" required>
                                @foreach ($card_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
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