@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your data') }}</div>

                    <div class="card-body">
                        <h1>Card #{{ auth()->user()->card_code ?? auth()->user()->login }}</h1>
                        <h2>Card type: {{ auth()->user()->card_type->type ?? 'Admin' }}</h2>
                        <h2>Balance: {{ number_format(auth()->user()->balance / 100, 2) }} $</h2>
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('refill.balance.show') }}" class="btn btn-success">Add funds</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('balance.withdraw.choose') }}" class="btn btn-primary">Withdraw funds</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('transactions.history') }}" class="btn btn-primary">Payment history</a>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('rides.show') }}" class="btn btn-success">Take a ride</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('rides.history') }}" class="btn btn-primary">Rides history</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
