<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-api-keys" style="display: none;">
	<div class="jltma-master-addons-features">
		<div class="jltma-tab-dashboard-header-wrapper">
			<div class="jltma-tab-dashboard-header-right is-flex">
				<button type="submit" class="jltma-button jltma-tab-element-save-setting">
					<?php _e('Save Settings', 'master-addons' ); ?>
				</button>
			</div>
		</div>

		<?php $jltma_api_options = get_option('jltma_api_save_settings'); ?>

		<div class="jltma-tab-dashboard-wrapper">
			<form action="" method="POST" id="jltma-api-forms-settings" class="jltma-api-forms-settings" name="jltma-api-forms-settings">
				<?php wp_nonce_field('jltma_api_settings_nonce_action'); ?>
				<div class="jltma-addons-dashboard-tabs-wrapper is-flex">
					<!-- Start of reCaptcha Settings -->
					<div class="jltma-api-settings-element jltma-half">
						<h4><?php echo esc_html__('reCaptcha Settings', 'master-addons' ); ?></h4>
						<div class="jltma-api-element-inner">
							<div class="jltma-api-forms">

								<div class="jltma-form-group is-flex">
									<label for="recaptcha_site_key">
										<?php echo esc_html__('reCAPTCHA Site key', 'master-addons' ); ?>
									</label>
									<input name="recaptcha_site_key" type="text" class="jltma-form-control recaptcha_site_key" value="<?php echo isset($jltma_api_options['recaptcha_site_key']) ? esc_attr($jltma_api_options['recaptcha_site_key']) : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="recaptcha_secret_key">
										<?php echo esc_html__('reCAPTCHA Secret key', 'master-addons' ); ?>
									</label>
									<input type="text" name="recaptcha_secret_key" class="jltma-form-control recaptcha_secret_key" value="<?php echo isset($jltma_api_options['recaptcha_secret_key']) ? esc_attr($jltma_api_options['recaptcha_secret_key']) : ""; ?>">
								</div>

								<p>
									<?php echo /* translators: %s: Google reCaptcha Url */ sprintf(__('Go to your Google <a href="%1$s" target="_blank"> reCAPTCHA</a> > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste here.', 'master-addons' ), esc_url('https://www.google.com/recaptcha/about/'));
									?>
								</p>
							</div>
						</div><!-- /.jltma-api-element-inner -->
					</div><!-- /.jltma-api-settings-element -->
					<!-- End of reCaptcha Settings -->



					<!-- Start of Twitter Settings -->
					<div class="jltma-api-settings-element jltma-half">
						<h4><?php echo esc_html__('Twitter Settings', 'master-addons' ); ?></h4>
						<div class="jltma-api-element-inner">
							<div class="jltma-api-forms">

								<div class="jltma-form-group is-flex">
									<label for="twitter_username">
										<?php echo esc_html__('Username', 'master-addons' ); ?>
									</label>
									<input name="twitter_username" type="text" class="jltma-form-control twitter_username" value="<?php echo isset($jltma_api_options['twitter_username']) ? esc_attr($jltma_api_options['twitter_username']) : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_consumer_key">
										<?php echo esc_html__('Consumer Key', 'master-addons' ); ?>
									</label>
									<input name="twitter_consumer_key" type="text" class="jltma-form-control twitter_consumer_key" value="<?php echo isset($jltma_api_options['twitter_consumer_key']) ? esc_attr($jltma_api_options['twitter_consumer_key']) : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_consumer_secret">
										<?php echo esc_html__('Consumer Secret', 'master-addons' ); ?>
									</label>
									<input type="text" name="twitter_consumer_secret" class="jltma-form-control twitter_consumer_secret" value="<?php echo isset($jltma_api_options['twitter_consumer_secret']) ? esc_attr($jltma_api_options['twitter_consumer_secret']) : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_access_token">
										<?php echo esc_html__('Access Token', 'master-addons' ); ?>
									</label>
									<input type="text" name="twitter_access_token" class="jltma-form-control twitter_access_token" value="<?php echo isset($jltma_api_options['twitter_access_token']) ? esc_attr($jltma_api_options['twitter_access_token']) : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_access_token_secret">
										<?php echo esc_html__('Access Token Secret', 'master-addons' ); ?>
									</label>
									<input type="text" name="twitter_access_token_secret" class="jltma-form-control twitter_access_token_secret" value="<?php echo isset($jltma_api_options['twitter_access_token_secret']) ? esc_attr($jltma_api_options['twitter_access_token_secret']) : ""; ?>">
								</div>

								<p>
									<?php echo /* translators: %s: Twitter Url */ sprintf(__('Go to <a href="%1$s" target="_blank"> https://developer.twitter.com/en/apps/create</a> for creating your Consumer key and Access Token.', 'master-addons' ), esc_url('https://developer.twitter.com/en/apps/create'));
									?>
								</p>
							</div>
						</div><!-- /.jltma-api-element-inner -->
					</div><!-- /.jltma-api-settings-element -->
					<!-- End of Twitter Settings -->
				</div>
			</form>
		</div>
	</div>
</div>
