@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('success'))
                <div class="alert alert-danger">{{ Session::get('success') }}</div>
            @endif
            <form method="POST" action="{{ route('stripe.withdraw.proceed') }}">
                @if (Session::has('stripe_error'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}</div>
                @endif
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Stripe</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="sum">Sum</label>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input class="form-control" id="sum" name="sum" type="text" placeholder="10.01"
                                                pattern="^[0-9]+\.[0-9]{2}?$">
                                        </div>
                                        <p class="btn btn-primary">$</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ccnumber">Stripe ID</label>
                                    <div class="input-group">
                                        <input class="form-control" name="number" type="text" autocomplete="email">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-credit-card"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success float-right" type="submit">
                            <i class="mdi mdi-gamepad-circle"></i> Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
