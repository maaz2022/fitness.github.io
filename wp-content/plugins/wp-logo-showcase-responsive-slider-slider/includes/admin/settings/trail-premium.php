<?php
/**
 * Plugin Premium Offer Page
 *
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wrap wpls-wrap">

	<h2 class="text-center"><?php _e( 'Logo Showcase with ', 'wp-logo-showcase-responsive-slider-slider' ); ?><span class="h-blue"><?php _e( 'Essential Plugin Bundle Free Trial', 'wp-logo-showcase-responsive-slider-slider' ); ?></span></h2>

	<style>
	.button-orange { background: #FF5D52 !important; color: #fff !important; border: 2px solid #FF5D52 !important; font-size:18px!important; font-weight:bold; padding:10px 20px !important;	}
	.section-space-medium{margin:15px 0;}
	.text-center{text-align:center;}
	.h-blue { color: #0055fb !important;  margin-bottom: 0px !important;}
	.cart-section-header{font-size:26px; line-height:34px; margin:10px 0px;}
	.wpos-trail-main-table{background:#fff; width:100%;}
	.wpos-trail-main-table th, .wpos-trail-main-table td{padding:10px; text-align:left; border:1px solid #ddd; border-collapse: collapse;}
  	.edd_checkout_cart_item_title{font-size:18px; font-weight:bold;}
	.wpos-trail-main-table tfoot th.edd_cart_total{text-align:right; font-size:18px;  color:#0055fb;}
	.epb-list h5{margin:2px 0 !important;}
	.epb-list .dashicons  {background: #aadb98;color: #34801a;font-size: 14px;padding: 2px;border-radius: 50%;margin-right: 5px; line-height:20px;}
	.epb-list li{margin-bottom:15px;}
	.page-template-free-trial-membership .wpos-bundle-stats .wpos-bundle-box {font-size:16px; margin-bottom:15px; box-shadow: 0 5px 30px 0 rgba(214,215,216,.57);padding: 20px 20px 20px 20px;background: #fff;position: relative;}
	.section-space-small{margin-bottom:20px;}
	.page-template-free-trial-membership .common-plan .wpos-bundle-stats .medium-4  .wpos-bundle-box{padding: 15px;}
	.common-plan img{width: 45px;height: 45px;margin-bottom: 8px;}
	.pay-later-cta {box-shadow: 0 5px 30px 0 rgba(214,215,216,.57);padding: 20px 20px 20px 20px;background: #fff;border-bottom: 2px solid #efeded;}
	.pricing-review-wrap span{font-size: 14px;}
	.page-template-free-trial-membership .wpos-seam-integration li{width: 32%;display: inline-block;}
	.page-template-free-trial-membership .epb-list li{margin-bottom: 0;line-height: 34px;}
	.page-template-free-trial-membership .wpos-checkout-right .epb-list li{line-height: 26px;}
	.page-template-free-trial-membership .wp-builder-list li a{display: table;}
	.page-template-free-trial-membership .wp-builder-list li a img{display: table-cell;width: 50px;}
	.page-template-free-trial-membership .wp-builder-list li a span{vertical-align: middle;display: table-cell;padding-left: 10px;line-height: normal;}
	.page-template-free-trial-membership .wpos-pricing-faq-page ul{max-width: 650px;margin: 0 auto;}
	.grid-x:before, .grid-x:after{content: "";display: table;}
	.grid-x::after, .grid-x{clear: both;}
	.grid-padding-x{ margin-right: -.9375rem;  margin-left: -.9375rem;}

	@media only screen and (max-width: 40em) {
		.page-template-free-trial-membership .pricing-review-wrap .medium-3{margin-bottom: 15px;}
		.page-template-free-trial-membership .wpos-seam-integration li{width: 100%;}
		.page-template-free-trial-membership .wpos-seam-integration li ul.epb-list li{border: none !important;}
		.page-template-free-trial-membership .wpos-pricing-faq-page .accordion-item a{font-size: 16px;line-height: normal;}
		.page-template-free-trial-membership .medium-4.wpos-checkout-right img{max-width: 200px;margin: 0 auto 20px;display: block;width: 100%;}
		.common-plan .medium-2{width: 100%;}
	}
	@media only screen and (min-width: 40em) {
		.cell {padding-right: .9375rem; padding-left: .9375rem; float:left; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
		.medium-12{ width: 100%; }
		.medium-8{ width: 66.66667%; }
		.medium-4{ width: 33.333%; }
		.medium-3{ width:25%; }
		.medium-2{ width: 20%; }
	}
	</style>
	
	<div id="poststuff">
		<div id="post-body" class="metabox-holder page-template-free-trial-membership">
			<div id="post-body-content">
				<div class="grid-x grid-padding-x">
					<div class="small-12 medium-8 cell">
						<div class="wpos-trail-table">	
							<table class="wpos-trail-main-table">
								<thead>
									<tr class="edd_cart_header_row">
										<th class="edd_cart_item_name">0$ Pro Trial</th>
										<th class="edd_cart_item_price">Item Price</th>
									</tr>
								</thead>
								<tbody>
									<tr class="edd_cart_item" id="edd_cart_item_0_106568" data-download-id="106568">
										<td class="edd_cart_item_name">
											<span class="edd_checkout_cart_item_title">14 Days Pro Essential Plugin Bundle – 0$ Pro Trial - Unlimited Sites</span>
											<p class="eddr-notice eddr-cart-item-notice" style="margin-bottom: 0 !important;"><em style="font-weight:bold; font-size:13px;line-height: normal;">* <span class="h-blue">After 14-Days</span> 0$ Pro Trial $149 will be billed annually.</em></p>
											<p class="eddr-notice h-orange eddr-cart-item-notice"><em style="font-weight:bold; font-size:13px; ">* <span class="h-blue">Within 14-Days </span>0$ Pro Trial easily cancelable and you will not be charge at all.</em></p>
										</td>
										<td class="edd_cart_item_price">$149.00
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr class="edd_cart_footer_row">
										<th colspan="2" class="edd_cart_total">Total: <span class="edd_cart_amount" data-subtotal="149" data-total="149">$0.00</span></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="grid-x grid-padding-x" style="text-align: center;width: 100%;padding: 30px 0;">
							<div class="small-12 medium-6" style="display: inline-block; font-weight: bold;border-right: 1px solid #ddd;text-align: center;">
								<span class="h-blue" style="font-size: 40px;margin-right: 10px;">277</span> <span style="display: inline-block;color: #505050;max-width: 100px;line-height: normal;text-align: left;font-size: 15px;">Trials in the last month</span>
								</div>
								<div class="small-12 medium-6" style="display: inline-block; font-weight: bold;text-align: center;">
								<span class="h-blue" style="font-size: 40px;margin-right: 10px;">16,435</span> <span style="display: inline-block;color: #505050;max-width: 100px;line-height: normal;text-align: left;font-size: 15px;">Pro-users since 2015</span>
							</div>
						</div>
					</div>
					<div class="small-12 medium-4 cell wpos-checkout-right">
						<h4 class="cart-section-header">14 Days Pro Essential Plugin Bundle – <span style="color: #0055fb ;">0$ Pro Trial</span></h4>
						<h5 style="font-size: 18px;line-height: 30px;margin: 10px 0px;">Your Plan Details:</h5>
						<ul style="margin: 0;list-style: none;font-size: 16px;">
							<li style="margin-bottom:8px;">
								<span style="display:inline-block;vertical-align: middle;"><img src="<?php echo WPLS_URL; ?>/assets/images/utility-50.png" width="24"></span> <span style="display:inline-block;vertical-align: middle;">39 Utility Plugins</span>
							</li>
							<li style="margin-bottom:8px;">
								<span style="display:inline-block;vertical-align: middle;"><img src="<?php echo WPLS_URL; ?>/assets/images/inboundwp-50.png" width="24"></span> <span style="display:inline-block;vertical-align: middle;">6 Marketing Tools</span>
							</li>
							<li style="margin-bottom:8px;">
								<span style="display:inline-block;vertical-align: middle;"><img src="<?php echo WPLS_URL; ?>/assets/images/SlidersPack-50.png" width="24"></span><span style="display:inline-block;vertical-align: middle;"> 10 SlidersPack</span>
							</li>
							<li style="margin-bottom:8px;">
								<span style="display:inline-block;vertical-align: middle;"><img src="<?php echo WPLS_URL; ?>/assets/images/popup-anything-icon.png" width="24"></span><span style="display:inline-block;vertical-align: middle;"> Popup Anything A Marketing Popup</span>
							</li>
							<li>
								<span style="display:inline-block;vertical-align: middle;"><img src="<?php echo WPLS_URL; ?>/assets/images/security-icon.png" width="24"></span><span style="display:inline-block;vertical-align: middle;"> Essential Security</span>
							</li>
						</ul>
					</div>
					<div class="small-12 medium-12 cell text-center section-space-medium">
						<a href="<?php echo WPLS_CHECKOUT_PLUGIN_LINK; ?>" class="large button button-orange radius" target="_blank">Join 0$ 14 Days Pro Bundle Trial</a>
					</div>
				</div>
				<div class="grid-x grid-padding-x" style="margin:30px 0;">			
					<div class="medium-12 cell text-center">
						<h3 class="text-center cart-section-header" style="display: inline-block;">Build <span style="background:#0099fb;color:#fff;padding: 0 5px;">better websites</span>, <span style="background:#0099fb;color:#fff;padding: 0 5px;">landing pages</span> &amp; <span style="background:#0099fb;color:#fff;padding: 0 5px;">conversion flow</span></h3>
					</div>
					<div class="text-center medium-12 cell epb-list">
						<ul style="list-style:none;margin-left: 0;">
							<li>
								<h5 style="font-size:17px;"><span class="dashicons dashicons-saved"></span></i>45 plugins, 10 sliders, Best in class - Popup plugin<span class="new-badge" style="position: relative;top: -8px;right: 2px;font-size: 10px;">New</span> with 2000+ pre-built templates in <span class="h-blue">Essential Bundle</span></h5>
							</li>
							<li>
								<h5 style="font-size:17px;line-height: 30px;margin-bottom: 6px !important;"><span class="dashicons dashicons-saved"></span> Compatible with <span style="text-decoration: underline;color: #ff5d52;">Gutenberg, DIVI, Elementor, Avada, VC/WPbakery</span> etc page builder/themes</h5>
							</li>
						</ul>
					</div>
				</div>
				<div class="grid-x grid-padding-x wpos-bundle-stats">
					<div class="small-12 medium-12 cell text-center section-space-small">
						<h3 class="cart-section-header text-center">What You Will Get?</h3>
					</div>
					<div class="medium-2 small-12 cell">
						<div class="wpos-bundle-box text-center">
							<img src="<?php echo WPLS_URL; ?>/assets/images/utility-50.png"><br>
							39 <br>
							Utility Plugins
						</div>
					</div>
					<div class="medium-2 small-12 cell">
						<div class="wpos-bundle-box text-center">
							<img src="<?php echo WPLS_URL; ?>/assets/images/inboundwp-50.png"><br>
							6 <br>
							Marketing Tools
						</div>
					</div>
					<div class="medium-2 small-12 cell">
						<div class="wpos-bundle-box text-center">
							<img src="<?php echo WPLS_URL; ?>assets/images/SlidersPack-50.png"><br>
							10 <br>
							SlidersPack 
						</div>
					</div>
					<div class="medium-2 small-12 cell">
						<div class="wpos-bundle-box text-center">									
							<img src="<?php echo WPLS_URL; ?>assets/images/popup-anything-icon.png"><br> 
							Popup Anything <br>
							A Marketing Popup 
						</div>
					</div>
					<div class="medium-2 small-12 cell">
						<div class="wpos-bundle-box text-center"> 
							<img src="<?php echo WPLS_URL; ?>/assets/images/security-icon.png"><br> 
							Essential <br>Security 
						</div>
					</div>
					<div class="medium-4 small-12 cell">
						<div class="wpos-bundle-box text-center">
							2000+ Templates  
						</div>
					</div>
					<div class="medium-4 small-12 cell">
						<div class="wpos-bundle-box text-center">
							Regular Updates With Valid Subscription 
						</div>
					</div>
					<div class="medium-4 small-12 cell">
						<div class="wpos-bundle-box text-center">
							Auto Renewal Yearly Product License  
						</div>
					</div>
				</div>

				<h3 class="pay-later-cta text-center section-space-medium" style="font-size: 28px;"><span style="color:#ed4635;">PAY $0 USD</span> + <span style="color:#5f9654;">INSTALL</span> + <span style="color:#9d42b0;">USE &amp; EXPLORE</span> = <span class="h-blue">YOUR DECISION YOU PAY OR NOT</span></h3>
				<div class="pricing-review-wrap text-center section-space-medium" style="padding:30px 0;background-color: #eaf1fe;">
					<div class="grid-container">
						<h4 class="section-space-small cart-section-header">Get convinced? Check out what our real-life members have to say...</h4>
						<div class="grid-x grid-padding-x">
							<div class="small-12 medium-3 cell text-center">
								<a href="https://tinyurl.com/y4bh9dnn" target="_blank" style="display: block;">
									<img src="<?php echo WPLS_URL; ?>/assets/images/g-logo.png" width="44">
								<br>
								<span style="color:#555">Google Reviews</span><br>
								<span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><br>
								<span>150+ reviews</span>
								</a>
							</div>
							<div class="small-12 medium-3 cell">
								<a href="https://www.facebook.com/EssentialPlugins/reviews/" target="_blank" style="display: block;">
									<img src="<?php echo WPLS_URL; ?>/assets/images/fb-icon.png" width="44">
								<br>
								<span style="color:#555">Facebook Reviews</span><br>
								<span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><br>
								<span>50+ reviews</span>
								</a>
							</div>
							<div class="small-12 medium-3 cell" style="padding-top: 10px;">
								<a href="https://profiles.wordpress.org/wponlinesupport/#content-plugins" target="_blank" style="display: block;">
									<img src="<?php echo WPLS_URL; ?>/assets/images/wordpress-icon-logo.png" width="150">
								<br>
								<span style="color:#555">WordPress.org Reviews</span><br>
								<span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><br>
								<span>500+ reviews</span>
								</a>
							</div>
							<div class="small-12 medium-3 cell" style="padding-top:10px;">
								<a href="https://www.essentialplugin.com/essential-plugin-bundle-testimonials/" target="_blank" style="display: block;">
									<img src="<?php echo WPLS_URL; ?>/assets/images/essential-plugin-logo.png" width="150">
								<br>
								<span style="color:#555">On-Site Reviews</span><br>
								<span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><span class="dashicons dashicons-star-filled" style="color: #fe8f01;"></span><br>
								<span>200+ reviews</span>
								</a>
							</div>
						</div>
					</div>
				</div>
					
				<div class="text-center section-space-larger">
					<a href="<?php echo WPLS_CHECKOUT_PLUGIN_LINK; ?>" class="large button button-orange radius" target="_blank">Join 0$ 14 Days Pro Bundle Trial</a>
					<ul class="epb-list" style="text-align: left;list-style: none;margin: 0 auto;padding: 0 15px;max-width: 500px;">
						<li><span class="dashicons dashicons-saved"></span><span class="h-orange">After 14 days - 0$ Pro Trial $149 will be billed annually.</span></li>
						<li><span class="dashicons dashicons-saved"></span><span class="h-orange">Within 14 days 0$ Pro Trial easily cancelable and you will not be charge at all.</span></li>
					</ul>
				</div>
					
				<div id="wpos-seam-integration" class="wpos-seam-integration section-space-medium">
					<div class="grid-x grid-padding-x">
						<div class="small-12 medium-12 cell text-center section-space-small">
							<h4 class="h-blue cart-section-header">Seamless Integration With All Major Page Builders</h4>
							<h3 class="cart-section-header">+ Multisite, Ecom Compatible</h3>
						</div>
					</div>
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="small-12 medium-12 cell section-space-small">
								<ul class="wp-builder-list" style="list-style:none;margin:0;">
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/gutenberg-icon.png" width="30"><span style="margin-left: 10px;">Gutenberg Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/site-origin-icon.png" width="30"><span style="margin-left: 10px;">Siteorigin Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/elementor-icon.png" width="30"><span style="margin-left: 10px;">Elementor Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/vc-icon.png" width="30"><span style="margin-left: 10px;">VC Composer Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/wpbakery-icon.png" width="30"><span style="margin-left: 10px;">WPbakery Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/beaver-icon.png" width="30"><span style="margin-left: 10px;">Beaver Page Builder</span>
									</li>
									<li>
										<img src="<?php echo WPLS_URL; ?>/assets/images/divi-icon.png" width="30"><span style="margin-left: 10px;">Adding DIVI and Avada theme support</span>
									</li>
									
								</ul>
							</div>
							<div class="small-12 medium-12 cell text-center">
								<a href="<?php echo WPLS_CHECKOUT_PLUGIN_LINK; ?>" class="large button button-orange radius" target="_blank">Join 0$ 14 Days Pro Bundle Trial</a>
								<ul class="epb-list" style="text-align: left;list-style: none;max-width: 500px;margin: 0 auto;padding: 0;">
									<li style="line-height: 34px;width: 100%;padding: 0;margin: 0;"><span class="dashicons dashicons-saved"></span><span class="h-orange">After 14 days - 0$ Pro Trial $149 will be billed annually.</span></li>
									<li style="line-height: 34px;width: 100%;padding: 0;margin: 0;"><span class="dashicons dashicons-saved"></span><span class="h-orange">Within 14 days 0$ Pro Trial easily cancelable and you will not be charge at all.</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>