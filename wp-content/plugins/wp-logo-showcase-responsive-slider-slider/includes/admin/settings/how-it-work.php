<?php
/**
 * How it Work Page
 *
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wrap wpls-wrap">
	<style type="text/css">
		.wpos-box{box-shadow: 0 5px 30px 0 rgba(214,215,216,.57);background: #fff; padding-bottom:10px; position:relative;}
		.wpos-box ul{padding: 15px;}
		.wpos-box h5{background:#555; color:#fff; padding:15px; text-align:center;}
		.wpos-box h4{ padding:0 15px; margin:5px 0; font-size:18px;}
		.wpos-box .button{margin:0px 15px 15px 15px; text-align:center; padding:7px 15px; font-size:15px;display:inline-block;}
		.wpos-box .wpos-list{list-style:square; margin:10px 0 0 20px;}
		.wpos-clearfix:before, .wpos-clearfix:after{content: "";display: table;}
		.wpos-clearfix::after{clear: both;}
		.wpos-clearfix{clear: both;}
		.wpos-col{width: 47%; float: left; margin-right:10px; margin-bottom:10px;}
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpls-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpls-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
		.wpos-copy-clipboard{-webkit-touch-callout: all; -webkit-user-select: all; -khtml-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;}
		.button-orange{background: #ff5d52 !important;border-color: #ff5d52 !important; font-weight: 600;}
		.button-blue{background: #0055fb !important;border-color: #0055fb !important; font-weight: 600;}
	</style>
<h2><?php _e( 'How It Works', 'wp-logo-showcase-responsive-slider-slider' ); ?>	</h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!--How it workd HTML -->
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'How It Works - Display and shortcode', 'wp-logo-showcase-responsive-slider-slider' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('Getting Started with Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Go to "Logo Showcase --> Add New".', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-2. Add Logo title, logo link to redirect(if need) and logo image under featured image section.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-3. Display multiple logo showcase, create categories under "Logo Showcase --> category" and create categories.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-4. Assign logo showcase post to respective categories and use the category shortcode under "Logo Showcase --> category"', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('How Shortcode Works', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page like Logoshose OR add the shortcode in any page.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-2. Put below shortcode as per your need.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<span class="wpls-shortcode-preview wpos-copy-clipboard">[logoshowcase]</span> – <?php _e('Logo Showcase Slider Shortcode', 'wp-logo-showcase-responsive-slider-slider'); ?> <br />
											<span class="wpls-shortcode-preview wpos-copy-clipboard">[logoshowcase center_mode="true" slides_column="3"]</span> – <?php _e('Logo Showcase Slider with center mode Shortcode', 'wp-logo-showcase-responsive-slider-slider'); ?><br />
											<span class="wpls-shortcode-preview wpos-copy-clipboard">[logoshowcase limit="-1"]</span> – <?php _e('Logo Showcase Slider limit -1 to display all logos, by defualt display only 15 logos.', 'wp-logo-showcase-responsive-slider-slider'); ?>
										</td>
									</tr>
									<tr>
										<th>
											<label><?php _e('Documentation', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<a class="button button-primary" href="https://docs.essentialplugin.com/wp-logo-showcase-responsive-slider/" target="_blank"><?php _e('Check Documentation', 'wp-logo-showcase-responsive-slider-slider'); ?></a>
										</td>
									</tr>
									<tr>
										<th>
											<label><?php _e('Demo', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<a class="button button-primary" href="https://demo.essentialplugin.com/logo-slider-plugin-demo/" target="_blank"><?php _e('Check Free Demo', 'wp-logo-showcase-responsive-slider-slider'); ?></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->

				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Gutenberg Support', 'wp-logo-showcase-responsive-slider-slider' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('How it Work', 'wp-logo-showcase-responsive-slider-slider'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Go to the Gutenberg editor of your page.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-2. Search "logoshowcase" keyword in the gutenberg block list.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
												<li><?php _e('Step-3. Add any block of logoshowcase and you will find its relative options on the right end side.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->

			

				<!-- Help to improve this plugin! -->
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Help to improve this plugin!', 'wp-logo-showcase-responsive-slider-slider' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<p><?php echo sprintf( __( 'Enjoyed this plugin? You can help by rate this plugin <a href="%s" target="_blank">5 stars!', 'wp-logo-showcase-responsive-slider-slider'), 'https://wordpress.org/support/plugin/wp-logo-showcase-responsive-slider-slider/reviews/' ); ?></a></p>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

			<!--Upgrad to Pro HTML -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox wpos-pro-box">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'Logo Showcase Premium Features', 'wp-logo-showcase-responsive-slider-slider' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<ul class="wpos-list">
								<li><?php _e( '15+ predefined template for logo showcase.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( '3 shortcodes [logoshowcase], [logo_grid] and [logo_filter]', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Drag & Drop order change', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display logo showcase in a grid view.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display logo with filtration.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display logo showcase in slider view', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display logo showcase in center mode view', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Logo Showcase With Ticker Mode', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( '2 Widgets- Slider and Grid view.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display Logo with title and description', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Slider RTL support.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Display logo showcase categories wise.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Set image size for logo among WordPress image size.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Visual Composer support.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Gutenberg, Elementor, Beaver and SiteOrigin Page Builder Support. <span class="wpos-new-feature">New</span>', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Divi Page Builder Native Support.<span class="wpos-new-feature">New</span>', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Fusion Page Builder (Avada) native support. <span class="wpos-new-feature">New</span>', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Logo Showcase with tool-tip with 5 tool-tip theme and various parameters.', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Custom CSS option', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( 'Fully responsive', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
								<li><?php _e( '100% Multi language', 'wp-logo-showcase-responsive-slider-slider'); ?></li>
							</ul>
							<div class="upgrade-to-pro"><?php _e( 'Gain access to <strong>Logo Showcase Responsive Slider</strong>', 'wp-logo-showcase-responsive-slider-slider'); ?></div>
							<a class="button button-primary wpos-button-full button-orange" href="<?php echo WPLS_PLUGIN_LINK_HOWITWORK; ?>" target="_blank"><?php _e('Grab Logo Showcase Now', 'wp-logo-showcase-responsive-slider-slider'); ?></a>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-container-1 -->

		</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- end .wpls-wrap -->