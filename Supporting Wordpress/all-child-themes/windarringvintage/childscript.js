/**/
jQuery(document).ready(function(){
	
	jQuery(document).on('click', 'li#tab-title-description', function(e) {
		var vi=jQuery('.woocommerce div.product .woocommerce-tabs .panel');
		if(vi.hasClass("showdesc"))
			vi.removeClass("showdesc").addClass("hidedesc");
		else	
			vi.addClass("showdesc").removeClass("hidedesc");
	});
	
	jQuery('.btnupdatecart').append(jQuery('.cart.woocommerce-cart-form__contents tbody tr:last-child td.actions').html());
	jQuery('.btnupdatecart .coupon').remove();
	
	// 	jQuery('.cart.woocommerce-cart-form__contents tbody tr:last-child td.actions').remove();
	
	jQuery('.shippingcalculate table tr').append(jQuery('.cart_totals .shop_table .woocommerce-shipping-totals.shipping').html());
	jQuery('.shippingcalculate table th').remove();
	
	var td = jQuery(".shippingcalculate table td");
	if(jQuery("body").hasClass("woocommerce-cart")){
		td.html(td.html().replace('Enter your address to view shipping options.', ''));
		td.html(td.html().replace('Enter a different address', ''));
		td.html(td.html().replace('No shipping options were found for <strong>default</strong>.', ''));

		jQuery(".shippingcalculate table td a.shipping-calculator-button").text('Calculate shipping');

		// 	jQuery(".shippingcalculate table td .shipping-calculator-form").att('display','block');

		var td1 = jQuery(".shippingcalculate table td section.shipping-calculator-form button");
		td1.html(td1.html().replace('Update', 'Update totals'));
 	}
	
	jQuery(document).on('click', '.btnupdatecart button', function(e) {
		jQuery(".woocommerce-cart-form td.actions button[name='update_cart']").trigger('click');
		setTimeout(function(){location.reload(); }, 1000);
	});
	
});
 
