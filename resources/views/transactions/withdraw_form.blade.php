@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('success'))
                <div class="alert alert-danger">{{ Session::get('success') }}</div>
            @endif
            <form method="POST" action="{{ route('withdraw.proceed') }}">
                @if (Session::has('stripe_error'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}</div>
                @endif
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Credit Card</strong>
                        <small>enter your card number</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="sum">Sum</label>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input class="form-control" id="sum" name="sum" type="text" placeholder="10.01"
                                                pattern="^[0-9]+(\.[0-9]{1,2})?$">
                                        </div>
                                        <p class="btn btn-primary">$</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ccnumber">Credit Card Number</label>
                                    <div class="input-group">
                                        <input class="form-control" name="number" type="text"
                                            pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$"
                                            placeholder="0000 0000 0000 0000" autocomplete="email">
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
