
@extends('users.layout.app')

@section('body')
<div class="col-lg-6">
    <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
        <div class="messages">
            <h5 class="f-title"><i class="ti-bell"></i>All Messages <span class="more-options"><i class="fa fa-ellipsis-h"></i></span></h5>
            <div class="message-box">
                <ul class="peoples">
                    @if ($people->count()>0)
                    @foreach ($people as $person )
                    
                    <li>
                        <a href="{{ route('getmessages', $person->id) }}">
                        <figure>
                            <img src="{{ asset('dist/images/resources/friend-avatar10.jpg') }}" alt="">
                            <span class="status f-online"></span>
                        </figure>
                        <div class="people-name">
                               @if ($person->sender_id == Auth::id())
                               <span>{{ $person->receiver->fname }} {{ $person->receiver->lname }}</span>
                               @else
                               <span>{{ $person->sender->fname }} {{ $person->sender->lname }}</span>
                               @endif 
                           </div>
                        </a>
                       </li>

                    @endforeach
                    @else
                        <div class="alert alert-danger text-center">
                            No Messages    
                        </div>    
                    @endif
                   
                </ul>
                <div class="peoples-mesg-box">
                    @if ($showType!==1)
                        
                   {{--  <div class="conversation-head" style="height: 250">
                        <figure><img src="{{ asset('dist/images/resources/friend-avatar10.jpg') }}" alt=""></figure>
                        <span>
                            
                        </span>
                    </div> --}}

                    @if ($showType!==2)
                        
                    <ul class="chatting-area">

                        @foreach ($person->messageDetails as $messages )
                            
                        <li class="@if ($messages->user_id==Auth::id())me @else you @endif">
                            <figure><img src="{{ asset('dist/images/resources/userlist-2.jpg') }}" alt=""></figure>
                            <p>{{ $messages->message }}</p>
                        </li>
                        @endforeach
                        
                        
                    </ul>
                    @else
                        <div class="alert" style="height: 100px">
                            
                        </div>
                    @endif
                    @endif
                    <div class="message-text-container">
                        @if ($showType==2)
                        
                        <form method="post" action="{{ route('storeMessage') }}">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                            <input type="hidden" name="sender_id" value="{{ Auth::id() }}">
                        @elseif($showType==3)
                        <form method="post" action="{{ route('storeMessage2') }}">
                            @csrf
                            <input type="hidden" name="chat_id" value="{{ $chat_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        @else
                        <form method="post" action="{{ route('storeMessage2') }}">
                            @csrf
                        @endif
                            <textarea @if ($showType==1)disabled @endif name="message" required></textarea>
                            <button title="send"
                            @if ($showType==1)
                                disabled
                            @endif
                            ><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>  
@endsection
 