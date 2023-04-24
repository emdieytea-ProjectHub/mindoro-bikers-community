@extends('users.layout.app')

@section('body')
        <div class="loadMore" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            <div class="central-meta item">

                @if ($tournaments->count())
                    @foreach ($tournaments as $tournament)
                        <div class="user-post" style="margin-top: 30px">
                            <div class="friend-info">

                                <div class="friend-name">
                                    <ins>
                                        <a href="time-line.html" title="">
                                            {{ $tournament->name }}
                                        </a>
                                    </ins>
                                    <span>published: {{ $tournament->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="post-meta">
                                    <div class="description">
                                        <div class="alert alert-info">
                                            <p>Date: <span class="badge badge-success">{{ $tournament->t_date }}</span>
                                            </p>
                                            <p>Time: <span class="badge badge-warning">{{ $tournament->kick_off }}</span>
                                            </p>
                                            <p>Starting Destination: <span
                                                    class="badge badge-danger">{{ $tournament->start }}</span></p>
                                            <p>Ending Destination: <span
                                                    class="badge badge-primary">{{ $tournament->end }}</span></p>
                                        </div>
                                    </div>
                                    {{-- <img src="{{ asset('images/map.jpg') }}" style="height: 200px"> --}}
                                    <div class="we-video-info">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h5 class="text-danger">
                                                    {{ $tournament->city }}
                                                </h5>
                                            </div>
                                            <div class="col-md-5">
                                                <a href="{{ route('join_tournament', $tournament->id) }}"
                                                    class="btn btn-primary btn-sm pull-right ml-2">
                                                    Join Ride
                                                </a>

                                                <a href="{{ route('view_tournament', $tournament->id) }}"
                                                    class="btn btn-success btn-sm pull-right">
                                                    View Route
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <hr>
                    @endforeach
                @else

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="alert alert-warning text-center">
                                    <p>
                                        There is no tournament yet
                                    </p>

                                    @auth

                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>


        </div>
@endsection

<!-- centerl meta -->
