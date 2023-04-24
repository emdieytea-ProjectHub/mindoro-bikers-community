@extends('users.layout.app')

@section('body')
        <div class="central-meta">
            <div class="editing-info">
                <h5 class="f-title"><i class="ti-info-alt"></i>Login</h5>
                <p>Don’t use MBC Yet? Take the tour or Join now</p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" required="required" name="email">
                        <label class=" control-label" for="input">
                            <a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="4b0e262a22270b">Email</a>
                        </label><i class="mtrl-select"></i>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" required="required">
                        <label class="control-label" for="input">Password.</label><i class="mtrl-select"></i>
                    </div>

                    <div class="submit-btns">
                        <button type="submit" class="mtr-btn"><span>Sign in</span></button>
                    </div>
                </form>
            </div>
        </div>
@endsection
