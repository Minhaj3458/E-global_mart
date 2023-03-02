<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.innersubcategory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(Session::get('success')); ?>

                        <?php
                            Session::forget('success');
                        ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">                       
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.innersubcategory')); ?></h4>
                            <a href="<?php echo e(route('admin.innersubcategory.add')); ?>" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1 float-right" style="margin-top: -30px;">
                                <?php echo e(trans('labels.add_innersubcategory')); ?>

                            </a>
                        </div>

                        <div class="col-md-4">
                            <form method="GET" action="<?php echo e(route('admin.innersubcategory.search')); ?>">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" placeholder="Type & Enter" value="<?php echo e(request()->get('search')); ?>" class="form-control round">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon4"><i class="ft-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                    <?php echo $__env->make('Admin.innersubcategory.innersubcategorytable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function CategoryTable() {
        $('#preloader').show();
        $.ajax({
            url:"<?php echo e(route('admin.innersubcategory.list')); ?>",
            method:'get',
            success:function(data){
                $('#preloader').hide();
                $('#table-display').html(data);
                $(".zero-configuration").DataTable({
                  aaSorting: [[0, 'DESC']]
                })
            }
        });
    }

    function do_delete(id,page_name,name,titles)
    {
        Swal.fire({
            title: '<?php echo e(trans('labels.are_you_sure')); ?>',
            text: "<?php echo e(trans('labels.delete_text')); ?> "+name+"!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
            cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
        }).then((t) => {
            if(t.value==true){  
                $('#preloader').show();
                $.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: page_name,
                    type: "POST",
                    data : {'id':id},

                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            $('#del-'+id).remove();
                            Swal.fire({type: 'success',title: '<?php echo e(trans('labels.success')); ?>',showConfirmButton: false,timer: 1500});    
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});
                        }    
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});

            }
        });

    }
    
    //Change Status
    $('body').on('click','.changeStatus',function() {
        let status=$(this).attr('data-status');
        let id=$(this).attr('data-id');
        Swal.fire({
            title: '<?php echo e(trans('labels.are_you_sure')); ?>',
            text: "<?php echo e(trans('labels.change_status')); ?>",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
            cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
        }).then((t) => {
            if(t.value==true){
                $('#preloader').show();
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo e(route("admin.innersubcategory.changeStatus")); ?>',
                    type: "POST",
                    data : {'id':id,'status':status},
                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            Swal.fire({type: 'success',title: '<?php echo e(trans('labels.success')); ?>',text: "Change status successfully",showConfirmButton: false,timer: 1500});    
                            if(status=='1'){
                                $('#tdstatus'+id).html('<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="'+id+'"><?php echo e(trans('labels.active')); ?></span>');
                            }else{
                                $('#tdstatus'+id).html('<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="'+id+'"><?php echo e(trans('labels.deactive')); ?></span>');
                            }
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>', showConfirmButton: false,timer: 1500});
                        }
                            
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});

            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/innersubcategory/index.blade.php ENDPATH**/ ?>