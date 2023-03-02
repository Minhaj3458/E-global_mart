<!DOCTYPE html>

<html class="loading" lang="en">
	@include('includes.admin.head')
  <body data-col="2-columns" class=" 2-columns ">
    <div class="wrapper">
		@include('includes.admin.sidebar')

		@include('includes.admin.header')
		<div class="main-panel">
      	<div class="main-content">

				@yield('content')
		
				</div>
			@include('includes.admin.footer')
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
    <script src="{{asset('storage/app/public/Adminassets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/switchery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/js/switch.min.js')}}" type="text/javascript"></script>
	    
		@yield('scripttop')
		<!-- BEGIN VENDOR JS-->
		<script src="{{asset('storage/app/public/Adminassets/vendors/js/tagging.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('storage/app/public/Adminassets/js/app-sidebar.js')}}" type="text/javascript"></script>
		<script src="{{asset('storage/app/public/Adminassets/js/notification-sidebar.js')}}" type="text/javascript"></script>
		<script src="{{asset('storage/app/public/Adminassets/js/customizer.js')}}" type="text/javascript"></script>
		<script src="{{ asset('storage/app/public/Adminassets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>

		<script src="{{ asset('storage/app/public/Adminassets/js/tagging.js')}}" type="text/javascript"></script>
		@yield('script')   	
    	<script type="text/javascript">
    	  function changePassword(){  
    	  $.ajaxSetup({
    	      headers: {
    	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	      }
    	  });   
    	      var oldpassword=$("#oldpassword").val();
    	      var newpassword=$("#newpassword").val();
    	      var confirmpassword=$("#confirmpassword").val();
    	      var CSRF_TOKEN = $('input[name="_token"]').val();
    	      
    	      $.ajax({
    	          url:"{{ route('admin.changepassword') }}",
    	          method:"POST",
    	          data:{'oldpassword':oldpassword,'newpassword':newpassword,'confirmpassword':confirmpassword},
    	          dataType: "json",
    	          success: function(result) {
    	              	$('.error').text('');
	              		if(result == 1)
	              		{
	              		    toastr.success("Success!"," Password has been Changed..");
	              	     	$(".modal").modal("hide");
	              	     	$("#change_password_form")[0].reset();
	              		}
    	              	if(result == 2)
    	              	{
    	                  	toastr.error("Error!","Fail..");
    	              	}
    	             	
	              		if(result == 3)
	              		{
	      	    		    toastr.error("Error!"," Old Password is not match..");
	              		}
    	          },error:function(data){
    	              $('.error').text('');
    	              for(var key in data.responseJSON.errors){
    	                  $('#'+key+"-error").text(data.responseJSON.errors[key]);
    	              }
    	          }
    	      });
    	  }

		  function myFunction() {
			toastr.options ={
				"closeButton" : true,
				"progressBar" : true,
			}
			toastr.error("Error!","Permission disabled for demo mode");
		}
    	</script>
	</body>

</html>
