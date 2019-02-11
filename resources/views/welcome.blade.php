@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 text-center">
                <h4 class="text-center">Check Email validity</h4>
                <form action="{{ route('email-test') }}" method="POST">
                    @csrf
                    <input type="text" name="email" class="form-control mb-3">
                    <button class="btn btn-primary w-100 mb-3" type="submit">Test Email</button>
                </form>

                @foreach (App\Email::all() as $entity)
                    @include('templates.entity-layout')
                @endforeach
            </div>
            <div class="col-md-5 text-center">
                <h4 class="text-center">Check Domain validity</h4>
                <form action="{{ route('domain-test') }}" method="POST">
                    @csrf
                    <input type="text" name="domain" class="form-control mb-3">
                    <button class="btn btn-primary w-100 mb-3" type="submit">Test Domain</button>
                </form>
                @foreach (App\Domain::all() as $entity)
                    @include('templates.entity-layout')
                @endforeach
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection