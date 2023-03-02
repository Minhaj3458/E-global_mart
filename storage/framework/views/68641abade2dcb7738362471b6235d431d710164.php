<!DOCTYPE html>
<?php if(session()->get('locale') == 'en' OR session()->get('locale') == ''): ?>
<html lang="en">
<?php endif; ?>

<?php if(session()->get('locale') == 'ar'): ?>
<html lang="en" dir="rtl">
<?php endif; ?>

	<?php echo $__env->make('includes.web.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<body class="fashion-theme2">
		
		    <!-- ============================================================== -->
		    <!-- Preloader - style you can find in spinners.css -->
		    <!-- ============================================================== -->
		    <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		    
		    
		    <!-- ============================================================== -->
		    <!-- Main wrapper - style you can find in pages.scss -->
		    <!-- ============================================================== -->
		    <div id="main-wrapper">

		    	<?php echo $__env->make('includes.web.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	    		<?php echo $__env->yieldContent('content'); ?>

	    		<?php echo $__env->make('includes.web.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		    </div>
		    <!-- ============================================================== -->
		    <!-- End Wrapper -->
		    <!-- ============================================================== -->

		    <!-- Branch List Modal -->
		    <div class="modal fade" id="promotion" role="dialog" data-toggle="modal">
		      <div class="modal-dialog">

		        <!-- Modal content-->
		        <div class="modal-content">
		        	<?php if(Helper::homebanner()->type == "product"): ?>
		        		<a href="<?php echo e(Helper::getSlug(Helper::homebanner()->type,Helper::homebanner()->product_id)); ?>">
		        	<?php else: ?>
		        		<a href="<?php echo e(Helper::getSlug(Helper::homebanner()->type,Helper::homebanner()->cat_id)); ?>">
		        	<?php endif; ?>
		            	<img src='<?php echo e(Helper::homebanner()->image); ?>' class="img-responsive center-block d-block mx-auto" width="100%">
		        	</a>
		        </div>

		      </div>
		    </div>

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/jquery.min.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/metisMenu.min.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/owl-carousel.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/ion.rangeSlider.min.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/smoothproducts.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/jquery-rating.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/jQuery.style.switcher.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/custom.js')); ?>"></script>
		<script src="<?php echo e(asset('storage/app/public/Webassets/js/toasty.js')); ?>"></script>
		<script src="<?php echo asset('storage/app/public/Webassets/sweetalert/js/sweetalert.min.js'); ?>"></script>
		
		<script>
			function openRightMenu() {
				document.getElementById("rightMenu").style.display = "block";
			}
			function closeRightMenu() {
				document.getElementById("rightMenu").style.display = "none";
			}

			function openLeftMenu() {
				document.getElementById("leftMenu").style.display = "block";
			}
			function closeLeftMenu() {
				document.getElementById("leftMenu").style.display = "none";
			}

			function openFilterSearch() {
				document.getElementById("filter_search").style.display = "block";
			}
			function closeFilterSearch() {
				document.getElementById("filter_search").style.display = "none";
			}

		  // $(document).click(function(e) {
		  //   if (!$(e.target).is('.shop_category')) {
		  //       $('.collapse').collapse('hide');      
		  //     }
		  // });

          var options = {
				autoClose: true,
				progressBar: true,
				enableSounds: true,
				sounds: {
					info: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233294/info.mp3",
					// path to sound for successfull message:
					success: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233524/success.mp3",
					// path to sound for warn message:
					warning: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233563/warning.mp3",
					// path to sound for error message:
					error: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233574/error.mp3",
				},
			};

			var toast = new Toasty(options);
			toast.configure(options);

		  var url = "<?php echo e(route('changeLang')); ?>";
		  
		  $(".changeLang").change(function(){
		      window.location.href = url + "?lang="+ $(this).val();
		  });

		  // $('.product-sorter-options').on('change',function(){
		  // 	value=$(this).val();
		  // 	var type = $('option:selected', this).attr('data-type');
		  // 	var slug = $('option:selected', this).attr('data-slug');
		  // 	$.ajax({
	   //      	headers: {
	   //          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   //      	},
	   //      	url: "<?php echo e(URL::to('/product/productfilter')); ?>",
	   //      	type: "POST",
	   //      	data: {
	   //          	'value': value,
	   //          	'type': type,
	   //          	'slug': slug
	   //      	},
	   //      	success: function (data) {
	   //      		$('#product-filter').html(data);
	   //      		lazyload();
	   //      	}, error: function (data) {
	   //          	console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
	   //      	}
	   //  	});
		  // })

		  function qtyupdate(cart_id,type) 
		  {
		      var qtys= parseInt($("#number_"+cart_id).val());
		      var cart_id= cart_id;

		      if (type == "decreaseValue") {
		          qty= qtys-1;
		      } else {
		          qty= qtys+1;
		      }

		      if (qty >= "1") {
		      	$('#preloader').show();
		          $.ajax({
		              headers: {
		                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		              },
		              url:"<?php echo e(URL::to('cart/qtyupdate')); ?>",
		              data: {
		                  cart_id: cart_id,
		                  qty:qty,
		                  type,type
		              },
		              method: 'POST',
		              success: function(response) {
		              	$('#preloader').hide();
		  	            if (response.status == 1) {
		  	            	localStorage.setItem("message",response.message)
		  	                location.reload();
		  	            } else {
		  	                toast.error(response.message);
		  	            }
		  	        },
		  	        error: function(error) {
		  	        	$('#preloader').hide();
		  	            toast.error('Somethig went wrong');
		  	        }
		          });
		      } else {

		          if (qty < "1") {
		          	toast.error("You've reached the minimum units allowed for the purchase of this item");
		          } else {
		          	toast.error("You've reached the maximum units allowed for the purchase of this item");
		          }
		      }
		  }

		  function DeleteItem(id) {
		      swal({
		          title: "Are you sure?",
		          text: "Are you sure want to Delete this item ?",
		          type: "warning",
		          showCancelButton: true,
		          confirmButtonClass: "btn-danger",
		          confirmButtonText: "Yes, Delete it!",
		          cancelButtonText: "No, cancel plz!",
		          closeOnConfirm: false,
		          closeOnCancel: false,
		          showLoaderOnConfirm: true,
		      },
		      function(isConfirm) {
		          if (isConfirm) {
		              $.ajax({
		                  headers: {
		                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                  },
		                  url:"<?php echo e(URL::to('cart/delete')); ?>",
		                  data: {
		                      id: id
		                  },
		                  method: 'POST',

		                  success: function(response) {
		                      if (response.status == 1) {
		                          swal({
		                              title: "Approved!",
		                              text: "Item has been deleted from cart.",
		                              type: "success",
		                              showCancelButton: true,
		                              confirmButtonClass: "btn-danger",
		                              confirmButtonText: "Ok",
		                              closeOnConfirm: false,
		                              showLoaderOnConfirm: true,
		                          },
		                          function(isConfirm) {
		                              if (isConfirm) {
		                                  swal.close();
		                                  location.reload();
		                              }
		                          });
		                      } else {
		                          swal("Cancelled", "Something Went Wrong :(", "error");
		                      }
		                  },
		                  error: function(e) {
		                      swal("Cancelled", "Something Went Wrong :(", "error");
		                  }
		              });
		          } else {
		              swal("Cancelled", "Your record is safe :)", "error");
		          }
		      });
		  }

		  $(document).ready(function(){
		      //get it if Status key found
		      if(localStorage.getItem("message"))
		      {
		          toast.success(localStorage.getItem("message"));
		          localStorage.clear();
		      }

		      lazyload();
		  });

	  		function lazyload() {
	  		  "use strict";

	  		  $(".woo_product_thumb img").one('lazyloaded load', function() {
	  		    	$(this).parent().find(".curtain").remove();
	  		  }).each(function(e){
	  		    	if(this.complete){
	  		  	  	$(this).trigger("lazyloaded load");
	  		      	$(this).parent().find(".curtain").remove();
	  		    	}
	  		  });
	  		  
	  		};

	  		function WishList(product_id,product_name,user_id) {
	  		  "use strict";

	  		  $('#preloader').show();
	  		  $.ajax({
	  		      headers: {
	  		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  		      },
	  		      url:"<?php echo e(URL::to('/product/addtowishlist')); ?>",
	  		      data: {
	  		          user_id: user_id,
	  		          product_id: product_id,
	  		          product_name: product_name,
	  		      },
	  		      method: 'POST', //Post method,
	  		      dataType: 'json',
	  		      success: function(response) {
	  		        $("#preloader").hide();
	  		          if (response.status == 1) {
	  					localStorage.setItem("message",response.message)
	  		            location.reload();
	  		          } else {
  		              	localStorage.setItem("message",response.message)
	  		            location.reload();
	  		          }
	  		      },
	  		      error: function(error) {
	  		          // $('#errormsg').show();
	  		      }
	  		  })
	  		};

	  		function RemoveWishList(product_id,product_name,user_id) {
	  		  "use strict";

	  		  $('#preloader').show();
	  		  $.ajax({
	  		      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	  		      url:"<?php echo e(URL::to('/product/removefromwishlist')); ?>",
	  		      data: {
	  		          user_id: user_id,
	  		          product_id: product_id,
	  		          product_name: product_name,
	  		      },
	  		      method: 'POST', //Post method,
	  		      dataType: 'json',
	  		      success: function(response) {
	  		        $("#preloader").hide();
	  		          if (response.status == 1) {
	  					localStorage.setItem("message",response.message)
	  		            location.reload();
	  		          } else {
  		              	localStorage.setItem("message",response.message)
	  		            location.reload();
	  		          }
	  		      },
	  		      error: function(error) {
	  		          // $('#errormsg').show();
	  		      }
	  		  })
	  		};

	  		$(document).ready(function(){
	  		  "use strict";
	  		  $("#search-box").keyup(function(){
	  		    var query = $(this).val(); 
	  		    $.ajax({
	  		        headers: {
	  		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  		        },

	  		        url:"<?php echo e(URL::to('/product/searchitem')); ?>",
	  		  
	  		        type:"POST",
	  		       
	  		        data:{'keyword':query},
	  		       
	  		        success:function (data) {
	  		          
	  		            $('#countryList').html(data);
	  		        }
	  		    })
	  		  });

	  		  $("#mobile-search-box").keyup(function(){
	  		    var query = $(this).val(); 
	  		    $.ajax({
	  		        headers: {
	  		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  		        },
	  		        
	  		        url:"<?php echo e(URL::to('/product/searchitem')); ?>",
	  		  
	  		        type:"POST",
	  		       
	  		        data:{'keyword':query},
	  		       
	  		        success:function (data) {
	  		          
	  		            $('#ProductSuggestions').html(data);
	  		        }
	  		    })
	  		  });
	  		});

	  		$(window).on('load',function(){
	  		  var x = getCookie('is_open');
	  		  if (x) {
	  		      $('#promotion').modal('hide');
	  		  } else {
	  		    $('#promotion').modal('show');
	  		    setCookie('is_open','yes',365)
	  		  }
	  		});

	  		function setCookie(name,value,days) {
	  		    var expires = "";
	  		    if (days) {
	  		        var date = new Date();
	  		        date.setTime(date.getTime() + (days*24*60*60*1000));
	  		        expires = "; expires=" + date.toUTCString();
	  		    }
	  		    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	  		}
	  		function getCookie(name) {
	  		    var nameEQ = name + "=";
	  		    var ca = document.cookie.split(';');
	  		    for(var i=0;i < ca.length;i++) {
	  		        var c = ca[i];
	  		        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	  		        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	  		    }
	  		    return null;
	  		}
		</script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
	    
		<?php echo $__env->yieldContent('scripttop'); ?>  	
	</body>

</html>
<?php /**PATH E:\Laravel_Rcreation\eglobalmart\resources\views/layouts/web.blade.php ENDPATH**/ ?>