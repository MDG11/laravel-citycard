@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if($withdraws->first())
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Sum</th>
                    <th>Card #</th>
                    <th>Phone number</th>
                    <th>Bank number</th>
                    <th>Actions</th>
                    <a href="{{ route('admin.cities.create') }}" class="btn btn-success">Create new</a>
                </thead>
                <tbody>
                    
                    @foreach ($withdraws as $withdraw)
                        <tr>
                            <td>{{ $withdraw->id }}</td>
                            <td>{{ $withdraw->sum }}</td>
                            <td>{{ $withdraw->card->card_code }}</td>
                            <td>{{ $withdraw->card->user->phone }}</td>
                            <td>{{ $withdraw->card_number }}</td>
                            <td>
                                <a href="{{ route('admin.withdraws.approve', $withdraw) }}" class="btn btn-success">Approve</a>
                                <a href="{{ route('admin.withdraws.decline', $withdraw) }}" class="btn btn-danger">Decline</a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <h1>No pending withdraw requests</h1>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection