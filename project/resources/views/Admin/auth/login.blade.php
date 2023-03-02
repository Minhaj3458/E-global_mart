<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="Login">
    <meta name="author" content="Gravity Infotech">
    <title>{{Helper::webinfo()->site_title}} | {{ trans('labels.login') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{Helper::webinfo()->favicon}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/css/app.css')}}">
    
  </head>
  <body data-col="1-column" class=" 1-column  blank-page blank-page">
    @if(Session::has('error'))
        <div class="alert alert-danger" style="text-align: center; color: #fff !important; font-weight: bold;">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="wrapper">
      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
                <section id="login">
                    <div class="container-fluid gradient-red-pink">
                        <div class="row full-height-vh">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card bg-blue-grey bg-darken-3 text-center width-400">
                                    <div class="card-body">
                                        <div class="card-block">

                                            <div class="form-group mt-4">
                                                <div class="col-md-12">
                                                    <img alt="element 06" class="mb-1" src="{{Helper::webinfo()->image}}" width="190">
                                                </div>
                                            </div>

                                            <form action="{{route('admin.login')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="{{ trans('placeholder.email') }}" value="{{old('email')}}"  autocomplete="off">
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('placeholder.password') }}">
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input  type="submit" class="btn btn-pink btn-block btn-raised" value="Login" />
                                                    </div>
                                                </div>
                                            </form>
                                            @if (env('Environment') == 'sendbox')
                                              <table class="table table-bordered">
                                                  <tbody>
                                                      <tr>
                                                          <td class="white">Admin<br>admin@gmail.com</td>
                                                          <td class="white">123456</td>
                                                          <td><button class="btn btn-info" onclick="AdminFill()">Copy</button></td>
                                                      </tr>
                                                      <tr>
                                                          <td class="white">Vendor<br>zara@yopmail.com</td>
                                                          <td class="white">123456</td>
                                                          <td><button class="btn btn-info" onclick="VendorFill()">Copy</button></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                           @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!--Login Page Ends-->
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('storage/app/public/Adminassets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/js/notification-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/js/customizer.js')}}" type="text/javascript"></script>
    <script>
      @if(Session::has('success'))
         toastr.options = {
            "closeButton" : true,
            "progressBar" : true
         },
         toastr.success("{{ session('success') }}");
      @endif
      @if(Session::has('error'))
         toastr.options ={
            "closeButton" : true,
            "progressBar" : true,
            "timeOut" : 10000
         },
         toastr.error("{{ session('error') }}");
      @endif

      function AdminFill(){
          $('#email').val('admin@gmail.com');
          $('#password').val('123456');
      }
      function VendorFill(){
          $('#email').val('zara@yopmail.com');
          $('#password').val('123456');
      }
   </script>

  </body>

</html>