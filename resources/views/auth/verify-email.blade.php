<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>MBC | Email Verification</title>

     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

     <!-- Bootstrap core CSS -->
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
</head>

<body>

     <div class="mx-auto col-md-6 col-md-4">
          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"> <img style="height:150px; "
                    src="{{ asset('/images/bikers.png') }}" /></a>
          <div class="mb-4 text-sm text-gray-600">
               {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
          </div>

          @if (session('status') == 'verification-link-sent')
               <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
               </div>
          @endif

          <div class="mt-4 flex items-center justify-between">
               <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                         <x-jet-button type="submit" class="btn btn-primary">
                              {{ __('Resend Verification Email') }}
                         </x-jet-button>
                    </div>
               </form>

               <form method="GET" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger">
                         {{ __('Log Out') }}
                    </button>
               </form>
          </div>
     </div>
</body>

</html>
