@extends('users.layout.app')

@section('body')
    <div class="col-lg-6">
        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            <div class="frnds">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="active" href="#mygroups" data-toggle="tab">My groups</a>
                        <span>{{ $mygroups->count() }}</span>
                    </li>
                    <li class="nav-item"><a class="" href="#joinedgroups" data-toggle="tab">Joined
                            Groups</a><span>{{ $joinedgroups->count() }}</span></li>
                    <li class="nav-item"><a class="" href="#othergroups" data-toggle="tab">Other
                            groups</a><span>{{ $othergroups->count() }}</span></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="mygroups">
                        <ul class="nearby-contct">



                            <li style="background-color: rgb(248, 248, 248)">
                                <form method="POST" action="{{ route('groups') }}">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
                                    <div class="nearly-pepls">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>Group Name</label>
                                                    <input name="groupName" class="form-control" type="text"
                                                        style="background-color: rgb(255, 255, 255)" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label>.</label>
                                                    <button class="btn btn-info btn-sm" type="submit">
                                                        <i class="fa fa-plus-circle"></i>
                                                        Create Group
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @if ($mygroups->count() > 0)

                                @foreach ($mygroups as $mygroup)

                                    <li>
                                        <div class="nearly-pepls">
                                            <figure>
                                                <a href="{{ route('viewgroup', $mygroup->id) }}" title=""><img
                                                        src="images/resources/group1.jpg" alt=""></a>
                                            </figure>
                                            <div class="pepl-info">
                                                <h4><a href="{{ route('viewgroup', $mygroup->id) }}"
                                                        title="">{{ $mygroup->groupName }}</a></h4>

                                                <em>{{ $mygroup->usergroup->count() + 1 }} Members</em>
                                                <a href="{{ route('viewgroup', $mygroup->id) }}" title="" class="add-butn"
                                                    data-ripple="">View Group</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="alert alert-warning">
                                            You havent created any group so far!!
                                        </div>
                                    </div>
                                </li>

                            @endif


                        </ul>

                    </div>



                    <div class="tab-pane fade" id="joinedgroups">
                        <ul class="nearby-contct">
                            @if ($joinedgroups->count() > 0)

                                @foreach ($joinedgroups as $joinedgroup)

                                    <li>
                                        <div class="nearly-pepls">
                                            <figure>
                                                <a href="#" title=""><img src="images/resources/group1.jpg" alt=""></a>
                                            </figure>
                                            <div class="pepl-info">
                                                <h4><a href="#" title="">{{ $joinedgroup->group->groupName }}</a></h4>
                                                <?php
                                 $sts=$joinedgroup->status;
                                 if($sts==1){
                                 $user=$joinedgroup->user_id;
                                 $array  = array_map('intval', str_split($user));
                                 ?>
                                                <em><?php echo count($array); ?> Members</em>
                                                <?php
                                 }
                                 else{
                                 ?>
                                                <em> 0 Members</em>
                                                <?php
                                 }
                                 ?>
                                                @php
                                                    $usergroup = DB::table('usergroups')
                                                        ->where('user_id', Auth::id())
                                                        ->where('group_id', $joinedgroup->id)
                                                        ->get();
                                                @endphp

                                                <?php

                                    $status=$joinedgroup->status;
                                    if($status!=1){
                                        ?>
                                                <a href="#" title="" class="add-butn" data-ripple="">Not Verified</a>
                                                <?php
                                    }
                                    else{
                                        ?>
                                                <a href="{{ route('viewgroup', $joinedgroup->group_id) }}" title=""
                                                    class="add-butn" data-ripple="" disabled>View group</a>
                                                <?php
                                    }
                                    ?>


                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="alert alert-warning">
                                            No groups created so far
                                        </div>
                                    </div>
                                </li>

                            @endif


                        </ul>

                    </div>

                    <div class="tab-pane fade" id="othergroups">
                        <ul class="nearby-contct">
                            @if ($othergroups->count() > 0)

                                @foreach ($othergroups as $othergroup)

                                    <li>
                                        <div class="nearly-pepls">
                                            <figure>
                                                <a href="" title=""><img src="images/resources/group1.jpg" alt=""></a>
                                            </figure>
                                            <div class="pepl-info">
                                                <h4><a href="" title="">{{ $othergroup->groupName }}</a></h4>

                                                <em>{{ $othergroup->usergroup->count() }} Members</em>
                                                @php
                                                    $usergroup = DB::table('usergroups')
                                                        ->where('user_id', Auth::id())
                                                        ->where('group_id', $othergroup->id)
                                                        ->get();
                                                @endphp

                                                @if ($usergroup->count() > 0)
                                                    <a href="{{ route('viewgroup', $othergroup->id) }}" title=""
                                                        class="add-butn" data-ripple="">View group</a>
                                                @else
                                                    <a href="{{ route('joingroup', $othergroup->id) }}" title=""
                                                        class="add-butn" data-ripple="">Join now</a>

                                                @endif

                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="nearly-pepls">
                                        <div class="alert alert-warning">
                                            No groups created so far
                                        </div>
                                    </div>
                                </li>

                            @endif


                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
