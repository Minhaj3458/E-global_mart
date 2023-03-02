<div class="col-lg-4 col-md-3">
	<nav class="dashboard-nav mb-10 mb-md-0">
	  <div class="list-group list-group-sm list-group-strong list-group-flush-x">
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('order*') ? 'active' : '' }}" href="{{URL::to('order-history')}}">
		  {{trans('labels.orders')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('wishlist*') ? 'active' : '' }}" href="{{URL::to('wishlist')}}">
		  {{trans('labels.wishlist')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('notifications*') ? 'active' : '' }}" href="{{URL::to('notifications')}}">
		  {{trans('labels.all_notifications')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('account*') ? 'active' : '' }}" href="{{URL::to('account')}}">
		  {{trans('labels.account_settings')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('my-address*') ? 'active' : '' }}" href="{{URL::to('my-address')}}">
		  {{trans('labels.my_address')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('my-wallet*') ? 'active' : '' }}" href="{{URL::to('my-wallet')}}">
		  {{trans('labels.wallet')}}
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle" href="{{URL::to('logout')}}">
		  {{trans('labels.logout')}}
		</a>
	  </div>
	</nav>
</div>