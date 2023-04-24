@extends('users.layout.app')

@section('body')
          <div class="central-meta"
               style=" border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 5px aquamarine; ">
               @guest
                    <div class="row" id="post">
                         <div class="col-md-12">
                              <div class="card">
                                   <div class="alert alert-warning text-center">
                                        <p>
                                             Welcome To Mindoro Bikers Community! <br>Click login to start your tour!
                                        </p>
                                        <a class="btn btn-warning" href="{{ route('login') }}">
                                             Login
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>
               @endguest

               @auth
                    <div class="new-postbox">
                         @if (session('success'))
                              <div class="alert alert-success text-center" style="margin-bottom: 10px">
                                   {{ session('success') }}
                              </div>
                         @endif

                         <figure>
                              <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ asset(auth()->user()->avatar) }}">
                         </figure>
                         <div class="newpst-input">
                              <form method="post" action="{{ route('addpost') }}" enctype="multipart/form-data">
                                   @csrf
                                   <textarea name="post" rows="2" placeholder="Write something" required></textarea>
                                   <div class="attachments">
                                        <ul>
                                             <li style="cursor: pointer">
                                                  <i class="fa fa-paperclip"></i>
                                                  <label class="fileContainer">
                                                       <input type="file" name="PostFile" accept="video/*, image/*">
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
               @endauth


          </div><!-- add post new box -->
          <div class="loadMore">
               <div class="central-meta item"
                    style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">

                    @if ($posts->count())
                         @foreach ($posts as $post)

                              <div class="user-post" style="margin-top: 30px">
                                   <div class="friend-info">
                                        <figure>
                                             <img src="{{ asset($post->user->avatar) }}" alt="" style="width: 98%">
                                        </figure>
                                        <div class="friend-name">
                                             <ins>
                                                  <a href="time-line.html" title="">
                                                       {{ $post->user->fname }} {{ $post->user->lname }}
                                                  </a>
                                             </ins>
                                             <span>published: {{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="post-meta">
                                             <div class="description">
                                                  <p>
                                                       {{ $post->post }}
                                                  </p>
                                             </div>

                                             @if (preg_match('/^.*\.(mp4|mov|webm|mpg|mp2|mpeg|mpe|mpv|ogg|m4p|m4v)$/i', $post->file))
                                                  <video class="embed-responsive" controls>
                                                       <source src="{{ asset($post->file) }}" type="video/mp4">
                                                       <source src="{{ asset($post->file) }}" type="video/ogg">
                                                       Your browser does not support the video tag.
                                                  </video>
                                             @endif

                                             @if (preg_match('/^.*\.(jpg|png|gif|webp|svg)$/i', $post->file))
                                                  <img class="embed-responsive" src="{{ asset($post->file) }}"
                                                       alt="{{ asset($post->file) }}">
                                             @endif

                                             <div class="we-video-info">
                                                  <ul>

                                                       <li>
                                                            <span class="comment" data-toggle="tooltip"
                                                                 title="Comments">
                                                                 <i class="fa fa-comments-o"></i>
                                                                 <ins>
                                                                      {{ $post->comments->count() }}
                                                                 </ins>
                                                            </span>
                                                       </li>
                                                       <li>
                                                            @php
                                                                 $likes = DB::table('likes')
                                                                     ->where('post_id', $post->id)
                                                                     ->get();
                                                            @endphp
                                                            <form method="post" action="{{ route('addPostLike') }}">
                                                                 @csrf
                                                                 <input type="hidden" value="{{ $post->id }}"
                                                                      name="post_id">
                                                                 @php
                                                                      $chklikes = DB::table('likes')
                                                                          ->where('post_id', $post->id)
                                                                          ->where('user_id', Auth::id())
                                                                          ->get();
                                                                 @endphp
                                                                 <?php
                                 $chklike=$chklikes->count();
                                 if($chklike==1){
                                     ?>
                                                                 <button type="submit" style="background:transparent;"><span
                                                                           class="like" data-toggle="tooltip"
                                                                           title="Likes" style="color:red;"><i
                                                                                class="ti-heart"
                                                                                style="color:red;"></i><ins>{{ $likes->count() }}</ins></span></button>
                                                                 <?php

                                 }
                                 else{
                                 ?>
                                                                 <button type="submit" style="background:transparent;"><span
                                                                           class="like" data-toggle="tooltip"
                                                                           title="Likes" style="color:black;"><i
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
                                             @if ($post->comment->count() > 0)
                                                  @foreach ($post->comment as $key => $comment)

                                                       @if ($key < 1)

                                                            <li>
                                                                 <div class="comet-avatar">
                                                                      <img src="{{ asset($comment->user->avatar) }}"
                                                                           alt="" style="width: 60%">
                                                                 </div>
                                                                 <div class="we-comment">
                                                                      <div class="coment-head">
                                                                           <h5>
                                                                                <a href="time-line.html" title="">
                                                                                     {{ $comment->user->fname }}
                                                                                     {{ $comment->user->lname }}
                                                                                </a>
                                                                           </h5>
                                                                           <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                                           <a class="we-reply" href="#"
                                                                                title="Reply"><i
                                                                                     class="fa fa-reply"></i></a>
                                                                      </div>
                                                                      <p>
                                                                           {{ $comment->comment }}
                                                                      </p>
                                                                 </div>
                                                       @endif

                                                       </li>
                                                  @endforeach

                                                  @if ($post->comment->count() >= 2)
                                                       <li>
                                                            <a href="{{ route('postComment', $post->id) }}" title=""
                                                                 class="showmore underline">more
                                                                 comments</a>
                                                       </li>
                                                  @endif

                                             @endif


                                             @auth
                                                  <li class="post-comment">
                                                       <form method="post" action="{{ route('addPostComment') }}">
                                                            <div class="comet-avatar">
                                                                 <img src="{{ asset(auth()->user()->avatar) }}" alt="">
                                                            </div>

                                                            <div class="post-comt-box">

                                                                 <div class="row">
                                                                      <div class="col-md-9">

                                                                           @csrf
                                                                           <input type="hidden" value="{{ $post->id }}"
                                                                                name="post_id">
                                                                           <textarea placeholder="Post your comment"
                                                                                name="comment"></textarea>


                                                                      </div>
                                                                      <div class="col-md-3">
                                                                           <button type="submit"
                                                                                class="btn btn-primary btn-block">
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
@endsection

<!-- centerl meta -->
