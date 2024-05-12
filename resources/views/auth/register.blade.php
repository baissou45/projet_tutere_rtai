@extends("layouts.guest")

@section("content")
<div class="card">
    <div class="card-body">

        <h3 class="text-center m-0">
            <a href="#" class="logo logo-admin">
                <img src="{{ asset('template/back/assets/images/logo_dark.png') }}" class="w-25" alt="logo">
            </a>
        </h3>

        <div class="p-3">
            <h4 class="text-muted font-18 m-b-5 text-center">Register</h4>

            <form class="form-horizontal m-t-30" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full name</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>

                <div class="form-group row m-t-20">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                    </div>
                </div>

                <div class="m-t-40 text-center">
                    <p>Already have an account ? <a href="{{ route('login') }}" class="font-500 font-14 text-primary font-secondary"> Signin Now </a> </p>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection