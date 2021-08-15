@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ number_format($transaction->sum/100, 2) }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                                @if ($transaction->status == 'pending')
                                    <a class="btn btn-danger" href="{{ route('transaction.cancel', ['id' => $transaction->id]) }}">Cancel</a>
                                @else
                                    <a class="btn btn-primary" href="">Details</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }}

        </div>
    </div>
@endsection
