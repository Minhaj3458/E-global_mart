<div class="col-lg-4 col-md-3">
	<nav class="dashboard-nav mb-10 mb-md-0">
	  <div class="list-group list-group-sm list-group-strong list-group-flush-x">
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('order*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('order-history')); ?>">
		  <?php echo e(trans('labels.orders')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('wishlist*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('wishlist')); ?>">
		  <?php echo e(trans('labels.wishlist')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('notifications*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('notifications')); ?>">
		  <?php echo e(trans('labels.all_notifications')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('account*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('account')); ?>">
		  <?php echo e(trans('labels.account_settings')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('my-address*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('my-address')); ?>">
		  <?php echo e(trans('labels.my_address')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle <?php echo e(request()->is('my-wallet*') ? 'active' : ''); ?>" href="<?php echo e(URL::to('my-wallet')); ?>">
		  <?php echo e(trans('labels.wallet')); ?>

		</a>
		<a class="list-group-item list-group-item-action dropright-toggle" href="<?php echo e(URL::to('logout')); ?>">
		  <?php echo e(trans('labels.logout')); ?>

		</a>
	  </div>
	</nav>
</div><?php /**PATH /home/eglobalm/public_html/resources/views/includes/web/order-sidebar.blade.php ENDPATH**/ ?>