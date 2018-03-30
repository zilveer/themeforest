{if AitWoocommerce::enabled() and !AitWoocommerce::currentPageIs('cart') and !AitWoocommerce::currentPageIs('checkout')}
<div class="ait-woocommerce-cart-widget">	
	<div id="ait-woocommerce-cart-wrapper" n:class="AitWoocommerce::cartIsEmpty() ? cart-empty, cart-wrapper">
		<div id="ait-woocommerce-cart-header" class="cart-header">
			<span id="ait-woocommerce-cart-info" class="cart-header-info">
				<span id="ait-woocomerce-cart-items-count" class="cart-count">{=AitWoocommerce::cartGetItemsCount()}</span>
			</span>
		</div>
		<div id="ait-woocommerce-cart" class="cart-content" style="display: none">
			{!=AitWoocommerce::cartDisplay()}
		</div>
		<!--
		<div id="ait-woocommerce-account-links">
			<ul>
			{if !$wp->isUserLoggedIn()}
				{if AitWoocommerce::isRegistrationEnabled()}
					<li id="ln"><a href="{=AitWoocommerce::accountUrl()}">{__ 'Register'}</a></li>
				{/if}
				<li><a href="{=AitWoocommerce::accountUrl()}">{__ 'Login'}</a></li>
			{else}
				<li id="my-account"><a href="{=AitWoocommerce::accountUrl()}">{__ 'My Account'}</a></li>
			{/if}
			</ul>
		</div>
		-->
	</div>
</div>
{/if}
