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
                    <th>Vehicle Type</th>
                    <th>Card Type</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    @foreach ($prices as $price)
                        <tr>
                            <td>{{ $price->card_type->type }}</td>
                            <td>{{ $price->vehicle_type->type }}</td>
                            <td>
                                <form action="{{ route('admin.prices.update',$price->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" value="{{ $price->price/100 }}" name="price">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection