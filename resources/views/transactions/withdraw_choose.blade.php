@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Choose withdraw method
        </div>
        <div class="card-body">
            <a href="{{ route('auto_withdraw') }}" class="btn btn-primary">Card(Automatically)</a>
            <a href="{{ route('stripe.withdraw.show') }}" class="btn btn-primary">Stripe(Automatically)</a>
            <a href="{{ route('balance.withdraw.show') }}" class="btn btn-primary">Card(manual)</a>
        </div>
    </div>
@endsection