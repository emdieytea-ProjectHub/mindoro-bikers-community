@extends('users.layout.app')

@section('body')
        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            <div class="about">
                <div class="personal">
                    <h5 class="f-title"><i class="ti-user"></i> Avatar</h5>
                    <p>
                        Your profile avatar
                    </p>
                    @if (session('ca-success'))
                        <div class="alert alert-success">
                            {{ session('ca-success') }}
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-row mt-2">
                    <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left">
                        <li class="nav-item">
                            <a href="#avatar" class="nav-link active show" data-toggle="tab">Current Avatar</a>
                        </li>
                        <li class="nav-item">
                            <a href="#change-avatar" class="nav-link " data-toggle="tab">Change Avatar</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="avatar">
                            <div class="card p-2">
                                <img class="img-thumbnail" src="{{ asset(auth()->user()->avatar) }}" height="200"
                                    width="200" />
                            </div>
                        </div>
                        <div class="tab-pane fade " id="change-avatar" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('change.avatar') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group half">
                                            <input type="file" name="AvatarFile" accept="image/*" required />
                                        </div>

                                        <div class="submit-btns">
                                            <button type="submit" class="mtr-btn"><span>Change</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="work" role="tabpanel">
                            <div>

                                <a href="#" title="">Envato</a>
                                <p>work as autohr in envato themeforest from 2013</p>
                                <ul class="education">
                                    <li><i class="ti-facebook"></i> BSCS from Oxford University</li>
                                    <li><i class="ti-twitter"></i> MSCS from Harvard Unversity</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="interest" role="tabpanel">
                            <ul class="basics">
                                <li>Footbal</li>
                                <li>internet</li>
                                <li>photography</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="lang" role="tabpanel">
                            <ul class="basics">
                                <li>english</li>
                                <li>french</li>
                                <li>spanish</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            <div class="about">
                <div class="personal">
                    <h5 class="f-title"><i class="ti-info-alt"></i> Personal Info</h5>
                    <p>
                        Your personal information
                    </p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-row mt-2">
                    <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left">
                        <li class="nav-item">
                            <a href="#basic" class="nav-link active show" data-toggle="tab">Basic info</a>
                        </li>
                        <li class="nav-item">
                            <a href="#location" class="nav-link " data-toggle="tab">Edit Profile</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="basic">
                            <div class="card">
                                <ul class="basics">
                                    <li><i class="ti-user"></i>{{ auth()->user()->fname }}
                                        {{ auth()->user()->lname }}
                                    </li>
                                    <li><i class="ti-mobile"></i>{{ auth()->user()->phone }}</li>
                                    <li><i class="ti-email"></i><a href="https://wpkixx.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__" data-cfemail="3c4553494e515d55507c59515d5550125f5351">
                                            {{ auth()->user()->email }}
                                        </a></li>
                                    <li><i class="fa fa-user"></i>{{ auth()->user()->gender }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="location" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="#">
                                        @csrf
                                        <div class="form-group half">
                                            <input type="text" id="input" required="required" name="fname"
                                                value="{{ auth()->user()->fname }}">
                                            <label class="control-label" for="input">First Name</label><i
                                                class="mtrl-select"></i>
                                        </div>
                                        <div class="form-group half">
                                            <input type="text" required="required" name="lname"
                                                value="{{ auth()->user()->lname }}">
                                            <label class="control-label" for="input">Last Name</label><i
                                                class="mtrl-select"></i>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="required" name="email"
                                                value="{{ auth()->user()->email }}">
                                            <label class="control-label" for="input">
                                                <a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                                    data-cfemail="4b0e262a22270b">[email&nbsp;protected]</a></label><i
                                                class="mtrl-select"></i>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" required="required"
                                                value="{{ auth()->user()->phone }}">
                                            <label class="control-label" for="input">Phone No.</label><i
                                                class="mtrl-select"></i>
                                        </div>


                                        <div class="submit-btns">

                                            <button type="submit" class="mtr-btn"><span>Update</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="work" role="tabpanel">
                            <div>

                                <a href="#" title="">Envato</a>
                                <p>work as autohr in envato themeforest from 2013</p>
                                <ul class="education">
                                    <li><i class="ti-facebook"></i> BSCS from Oxford University</li>
                                    <li><i class="ti-twitter"></i> MSCS from Harvard Unversity</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="interest" role="tabpanel">
                            <ul class="basics">
                                <li>Footbal</li>
                                <li>internet</li>
                                <li>photography</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="lang" role="tabpanel">
                            <ul class="basics">
                                <li>english</li>
                                <li>french</li>
                                <li>spanish</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
