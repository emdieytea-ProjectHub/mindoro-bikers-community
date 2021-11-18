@extends('users.layout.app')

@section('body')
<div class="col-lg-6">
    <div class="central-meta">
        <div class="editing-info">
            <h5 class="f-title"><i class="ti-info-alt"></i> Update Profile</h5>
            <p>Don’t use MBC Yet? Take the tour or Join now</p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>  
            @endif
            
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-group half">	
                  <input type="text" id="input" required="required" name="fname" value="{{ auth()->user()->fname }}">
                  <label class="control-label" for="input">First Name</label><i class="mtrl-select"></i>
                </div>
                <div class="form-group half">	
                  <input type="text" required="required" name="lname" value="{{ auth()->user()->lname }}" >
                  <label class="control-label" for="input">Last Name</label><i class="mtrl-select"></i>
                </div>
                <div class="form-group">	
                  <input type="text" required="required" name="email" value="{{ auth()->user()->email }}">
                  <label class="control-label" for="input">
                      <a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="4b0e262a22270b">[email&nbsp;protected]</a></label><i class="mtrl-select"></i>
                </div>
                <div class="form-group">	
                  <input type="text" name="phone" required="required" value="{{ auth()->user()->phone }}">
                  <label class="control-label" for="input">Phone No.</label><i class="mtrl-select"></i>
                </div>
               
                
                <div class="submit-btns">
                    
                    <button type="submit" class="mtr-btn"><span>Update</span></button>
                </div>
            </form>
        </div>
    </div>	
</div>
@endsection