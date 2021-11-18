@extends('users.layout.app')

@section('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="col-lg-6">
        <div class="central-meta">
            <div class="editing-info">
                <h5 class="f-title"><i class="ti-info-alt"></i> Register</h5>
                <p>Don’t use MBC Yet? Take the tour or Join now</p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group half">
                        <input pattern="^[A-Za-z -]+$" type="text" id="input" required="required" name="fname">
                        <label class="control-label" for="input">First Name</label><i class="mtrl-select"></i>
                    </div>
                    <div class="form-group half">
                        <input pattern="^[A-Za-z -]+$" type="text" required="required" name="lname">
                        <label class="control-label" for="input">Last Name</label><i class="mtrl-select"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" required="required" name="email">
                        <label class="control-label" for="input">
                            <a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="4b0e262a22270b">[email&nbsp;protected]</a></label><i class="mtrl-select"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" maxlength="11" class="numeric" name="phone" required="required">
                        <label class="control-label" for="input">Phone No.</label><i class="mtrl-select"></i>
                    </div>

                    <div class="form-radio">
                        <div class="radio">
                            <label>
                                <input type="radio" value="Male" checked="checked" name="gender"><i
                                    class="check-box"></i>Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" value="Female" name="gender"><i class="check-box"></i>Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" minlength="8" maxlength="15" name="password" required="required">
                        <label class="control-label" for="input">Password.</label><i class="mtrl-select"></i>
                    </div>

                    <div class="submit-btns">

                        <button type="submit" class="mtr-btn"><span>Register</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.numeric').keypress(function(e) {
            var a = [];
            var k = e.which;

            for (i = 48; i < 58; i++)
                a.push(i);

            if (!(a.indexOf(k) >= 0))
                e.preventDefault();

            // $('span').text('KeyCode: '+k);
        });
    </script>
@endsection
