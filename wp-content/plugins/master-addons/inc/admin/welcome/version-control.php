<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-version" style="display: none;">
	<div class="jltma-master-addons-features">


		<div class="jltma-tab-dashboard-header-wrapper">

			<div class="jltma-response-wrap"></div>

			<div class="jltma-version-top-wrapper">
				<h2 class="jltma-roll-back mb-0">
					<?php echo __('Rollback to Previous Version', 'master-addons' ); ?>
				</h2>
				<p class="jltma-roll-back-span"><?php echo /* translators: %s: Version */ sprintf(__('Experiencing an issue with Master Addons for Elementor version <strong>%s</strong>? Rollback to a previous version before the issue appeared.', 'master-addons' ), JLTMA_VER); ?></p>
			</div>


			<div class="jltma-version-wrapper is-flex mt-2">
				<div class="jltma-version-left p-3">
					<h4 class="m-0"><?php echo __('Rollback Version', 'master-addons' ); ?></h4>
				</div>
				<div class="jltma-version-right p-3">
					<?php

					echo '<select class="master-addons-rollback-select">';
					$ger_versions = \MasterAddons\Inc\Master_Addons_Rollback::get_instance();
					foreach ($ger_versions->get_rollback_versions() as $version) {
						printf("<option value='%s'>%s</option>", $version, $version);
					}
					echo '</select>';
					printf('<a data-placeholder-text="' . esc_html__('Reinstall', JLTMA_VER) . ' v{VERSION}" href="#" data-placeholder-url="%s" class="jltma-button inline-block jltma-rollback-button button button-primary elementor-button-spinner ml-2">%s</a>', wp_nonce_url(admin_url('admin-post.php?action=master_addons_rollback&version=VERSION'), 'master_addons_rollback'), __('Reinstall', JLTMA_VER));

					?>
					<p class="jltma-roll-desc text-danger mb-0">
						<?php echo __('Warning: Please backup your database before making the rollback.', 'master-addons' ); ?>
					</p>
				</div>
			</div>

		</div>
	</div>
</div>
