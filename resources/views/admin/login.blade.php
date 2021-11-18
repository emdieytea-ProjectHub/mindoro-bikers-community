<!doctype html>
<html lang="en">

<!-- Mirrored from getbootstrap.com/docs/4.0/examples/sign-in/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 May 2021 03:03:44 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="{{ asset('/images/bikers.jpg') }}" type="image/jpg" sizes="16x16">

     <title>Admin | Mindoro Bikers Community </title>

     <link rel="canonical" href="index.html">

     <!-- Bootstrap core CSS -->
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
</head>

<body class="text-center" style="background-image: linear-gradient(to left, #99ffcc, white)">

     <form class="form-signin" method="POST" action="{{ route('admin.login') }}"
          style="border-left:10px outset; border:5px outset #0af5dd;  border-radius: 20px; background-color:white; ">
          @csrf

          <img style="height:150px;" src="{{ asset('/images/bikers.jpg') }}" />
          <h1 class="h3 mb-3 font-weight-normal" style="color:red; font-family:Palatino Linotype;">Admin Login</h1>
          @if (session('error'))
               <div class="alert alert-danger">
                    {{ session('error') }}
               </div>
          @endif
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required
               autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
               required>

          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
     </form>
</body>

<!-- Mirrored from getbootstrap.com/docs/4.0/examples/sign-in/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 May 2021 03:03:44 GMT -->

</html>
