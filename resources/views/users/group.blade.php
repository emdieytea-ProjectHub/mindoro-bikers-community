@extends('users.layout.app')

@section('body')
    <div class="col-md-4 col-lg-6">
        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">

            <div class="new-postbox">

                @if (session('success'))
                    <div class="alert alert-success text-center" style="margin-bottom: 10px">
                        {{ session('success') }}
                    </div>
                @endif

                <figure>
                    <img src="{{ asset('dist/images/resources/admin2.jpg') }}" alt="">
                </figure>
                <div class="newpst-input">
                    <form method="post" action="{{ route('addgrouppost') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <textarea name="post" rows="2" placeholder="write something" required></textarea>
                        <div class="attachments">
                            <ul>
                                <li style="cursor: pointer">
                                    <i class="fa fa-paperclip"></i>
                                    <label class="fileContainer">
                                        <input type="file" name="PostFile">
                                    </label>
                                </li>

                                <li>
                                    <button type="submit">Post</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- add post new box -->
        <div class="loadMore">
            <div class="central-meta item">

                @if ($groupposts->count())
                    @foreach ($groupposts as $grouppost)
                        <div class="user-post" style="margin-top: 30px">
                            <div class="friend-info">
                                <figure>
                                    <img src="{{ asset($grouppost->user->avatar) }}" alt="">
                                </figure>
                                <div class="friend-name">
                                    <ins>
                                        <a href="time-line.html" title="">
                                            {{ $grouppost->user->fname }} {{ $grouppost->user->lname }}
                                        </a>
                                    </ins>
                                    <span>published: {{ $grouppost->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="post-meta">
                                    <div class="description">
                                        <p>
                                            {{ $grouppost->post }}
                                        </p>
                                    </div>

                                    @if (preg_match('/^.*\.(mp4|mov|webm|mpg|mp2|mpeg|mpe|mpv|ogg|m4p|m4v)$/i', $grouppost->file))
                                        <video class="embed-responsive" controls>
                                            <source src="{{ asset($grouppost->file) }}" type="video/mp4">
                                            <source src="{{ asset($grouppost->file) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif

                                    @if (preg_match('/^.*\.(jpg|png|gif|webp|svg)$/i', $grouppost->file))
                                        <img class="embed-responsive" src="{{ asset($grouppost->file) }}"
                                            alt="{{ asset($grouppost->file) }}">
                                    @endif

                                    <div class="we-video-info">
                                        <ul>

                                            <li>
                                                <span class="comment" data-toggle="tooltip" title="Comments">
                                                    <i class="fa fa-comments-o"></i>
                                                    <ins>
                                                        {{ $grouppost->groupcomment->count() }}
                                                    </ins>
                                                </span>
                                            </li>
                                            <li>
                                                @php
                                                    $likes = DB::table('grouplikes')
                                                        ->where('post_id', $grouppost->id)
                                                        ->get();
                                                @endphp
                                                <form method="post" action="{{ route('addGroupPostLike') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $grouppost->id }}" name="post_id">
                                                    @php
                                                        $chklikes = DB::table('grouplikes')
                                                            ->where('post_id', $grouppost->id)
                                                            ->where('user_id', Auth::id())
                                                            ->get();
                                                    @endphp
                                                    <?php
                                 $chklike=$chklikes->count();
                                 if($chklike==1){
                                     ?>
                                                    <button type="submit" style="background:transparent;"><span class="like"
                                                            data-toggle="tooltip" title="Likes" style="color:red;"><i
                                                                class="ti-heart"
                                                                style="color:red;"></i><ins>{{ $likes->count() }}</ins></span></button>
                                                    <?php

                                 }
                                 else{
                                 ?>
                                                    <button type="submit" style="background:transparent;"><span class="like"
                                                            data-toggle="tooltip" title="Likes" style="color:black;"><i
                                                                class="ti-heart"
                                                                style="color:grey;"></i><ins>{{ $likes->count() }}</ins></span></button>
                                                    <?php
                                 }
                                       ?>


                                                    </a>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="coment-area">
                                <ul class="we-comet">
                                    @if ($grouppost->groupcomment->count() > 0)
                                        @foreach ($grouppost->groupcomment as $key => $comment)

                                            @if ($key < 1)

                                                <li>
                                                    <div class="comet-avatar">
                                                        <img src="{{ asset('dist/images/resources/comet-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="we-comment">
                                                        <div class="coment-head">
                                                            <h5>
                                                                <a href="" title="">
                                                                    {{ $comment->user->fname }}
                                                                    {{ $comment->user->fname }}
                                                                </a>
                                                            </h5>
                                                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                            <a class="we-reply" href="#" title="Reply"><i
                                                                    class="fa fa-reply"></i></a>
                                                        </div>
                                                        <p>
                                                            {{ $comment->comment }}
                                                        </p>
                                                    </div>
                                            @endif

                                            </li>
                                        @endforeach

                                        @if ($grouppost->groupcomment->count() >= 2)
                                            <li>
                                                <a href="{{ route('groupcomment', $grouppost->id) }}" title=""
                                                    class="showmore underline">more comments</a>
                                            </li>
                                        @endif
                                    @endif


                                    @auth
                                        <li class="post-comment">
                                            <form method="post" action="{{ route('addgroupcomment') }}">

                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <div class="comet-avatar">
                                                    <img src="{{ asset('dist/images/resources/comet-1.jpg') }}" alt="">
                                                </div>



                                                <div class="post-comt-box">

                                                    <div class="row">
                                                        <div class="col-md-9">

                                                            @csrf
                                                            <input type="hidden" value="{{ $grouppost->id }}" name="post_id">
                                                            <textarea placeholder="Post your comment" name="comment"></textarea>


                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-primary btn-block">
                                                                Send
                                                            </button>
                                                        </div>

                                                    </div>

                                                </div>

                                            </form>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="alert alert-warning text-center">
                                    <p>
                                        No post yet, be the first to Post!!!!
                                    </p>

                                    @auth
                                        <a class="btn btn-warning" href="#login">
                                            Post
                                        </a>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>


        </div>
    </div>
    <div class="col-md-4 col-lg-3">
        <aside class="sidebar static">
            <div class="widget">
                <div class="banner medium-opacity bluesh">

                    <div class="banermeta">
                        <p>
                            {{ $group->groupName }}
                        </p>

                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="widget friend-list stick-widget is_stuck">
                    <h4 class="widget-title">Group Members</h4>

                    <!--<ul id="people-list" class="friendz-list ps-container ps-theme-default ps-active-y" data-ps-id="d590c2d6-5239-2516-580d-906ada6a845e">-->
                    <ul id="people-list">
                        <li>

                            <figure>
                                <img src="{{ asset($group->user->avatar) }}" alt="">
                                @if (Cache::has('user-is-online-' . $group->user->id))
                                    <span class="status f-online"></span>
                                @else
                                    <span class="status f-offline"></span>
                                @endif
                                <span class=""></span>
                            </figure>

                            <div class="friendz-meta">
                                <a href="time-line.html">
                                    {{ $group->user->fname }} {{ $group->user->lname }} <span
                                        class="badge badge-danger">Admin</span>
                                </a>
                                <i>
                                    <a href="#" class="__cf_email__">
                                        {{ $group->user->email }}
                                    </a>
                                </i>
                            </div>
                        </li>

                        @if ($group->usergroup->count() > 0)

                            @foreach ($group->usergroup as $users)


                                <li>

                                    <table>
                                        <tr>
                                            <td>
                                                <figure>
                                                    <img src="{{ asset($users->user->avatar) }}" alt="">
                                                    @if (Cache::has('user-is-online-' . $users->user->id))
                                                        <span class="status f-online"></span>
                                                    @else
                                                        <span class="status f-offline"></span>
                                                    @endif
                                                </figure>
                                                <div class="friendz-meta">
                                                    <a href="#">{{ $users->user->fname }}
                                                        {{ $users->user->lname }}</a>
                                                    <i><a href="#" class="__cf_email__">{{ $users->user->email }}</a></i>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                $status=$users->status;
                                if($status==1){
                                ?>
                                                <a href="#"
                                                    style="background: green;color: white;padding: 4px 4px 4px 4px;border-radius: 10px 10px 10px 10px;">Verifed</a>
                                                <?php
                                }
                                else{
                                ?>

                                                <a href="{{ route('verifygroup', $users->user->id) }}"
                                                    style="background: red;color: white;padding: 4px 4px 4px 4px;border-radius: 10px 10px 10px 10px;"">Verify</a>
                                                                                                                                                                                                                                                                    <?php
                                }
                                ?>
                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                        </table>

                                                                                                                                                                                                                                                    </li>






                                                         @endforeach
                            @endif


                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 450px; right: 0px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 334px;"></div>
                            </div>
                    </ul>

                </div>
            </div><!-- friends list sidebar -->
        </aside>
    </div>
@endsection

<!-- centerl meta -->
