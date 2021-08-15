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
                    <th>Card Code</th>
                    <th>Card Type</th>
                    <th>Phone</th>
                    <th>Actions</th>
                    <a href="{{ route('admin.cards.create') }}" class="btn btn-success">Create new</a>
                </thead>
                <tbody>
                    @foreach ($cards as $card)
                        <tr>
                            <td>{{ $card->id }}</td>
                            <td>{{ $card->card_code }}</td>
                            <td>{{ $card->card_type->type }}</td>
                            <th>{{ $card->user->phone ?? 'User not connected' }}</th>
                            <td>
                                <a href="{{ route('admin.cards.edit', ['card' => $card->id]) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.cards.destroy',$card->id) }}" method="POST">
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