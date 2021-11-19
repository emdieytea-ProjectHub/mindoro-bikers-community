@extends('users.layout.app')

@section('body')
    
    <div class="loadMore">
    <div class="central-meta item">

            <div class="user-post" style="margin-top: 10px">
                <div class="friend-info">
                    <figure>
                        <img src="{{ asset('dist/images/resources/friend-avatar10.jpg') }}" alt="">
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
                        <img src="{{ asset($post->image) }}" alt="">
                        <div class="we-video-info">
                            <ul>
                               
                                <li>
                                    <span class="comment" data-toggle="tooltip" title="Comments">
                                        <i class="fa fa-comments-o"></i>
                                        <ins>
                                            {{ $post->groupcomment->count() }}
                                        </ins>
                                    </span>
                                </li>
                                <li>
                                    <span class="like" data-toggle="tooltip" title="like">
                                        <i class="ti-heart"></i>
                                        <ins>2.2k</ins>
                                    </span>
                                </li>
                               
                            </ul>
                        </div>
                        <div class="description">
                            
                            <p>
                               {{ $post->post }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="coment-area">
                    <ul class="we-comet">
                        @if ($post->groupcomment->count()>0)
                       @foreach ($post->groupcomment as $key => $comment )

                       <li>
                        <div class="comet-avatar">
                            <img src="{{ asset('dist/images/resources/comet-1.jpg') }}" alt="">
                        </div>
                        <div class="we-comment">
                            <div class="coment-head">
                                <h5>
                                    <a href="time-line.html" title="">
                                        {{ $comment->user->fname }} {{ $comment->user->fname }}
                                    </a>
                                </h5>
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                            </div>
                            <p>
                                {{ $comment->comment }}
                            </p>
                        </div>
                        
                           
                    </li>
                       @endforeach
                       
                        @endif

                        @auth
                            
                        <li class="post-comment">
                            <form method="post" action="{{ route('addgroupcomment') }}">
                            <div class="comet-avatar">
                                <img src="{{ asset('dist/images/resources/comet-1.jpg') }}" alt="">
                            </div>
                            
                            <div class="post-comt-box">
                               
                                <div class="row">
                                    <div class="col-md-9">
                                        
                                            @csrf
                                            <input type="hidden" value="{{ $post->id }}" name="post_id" >
                                            <input type="hidden" value="{{ Auth::id() }}" name="user_id" >
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
          
    </div>

    
    </div>
@endsection

<!-- centerl meta -->