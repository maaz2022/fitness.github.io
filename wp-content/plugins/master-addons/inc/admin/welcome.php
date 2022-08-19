<?php
/*
* Master Addons : Welcome Screen by Jewel Theme
*/

use MasterAddons\Inc\Classes\Master_Addons_White_Label;

$jltma_white_label_setting 	= jltma_get_options('jltma_white_label_settings') ?? [];
if ( empty($jltma_white_label_setting) ) {
	$jltma_white_label_setting = Master_Addons_White_Label::jltma_white_label_default_options();
}

$jltma_hide_welcome 		     = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_welcome'] ?? false);
$jltma_hide_addons 			     = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_addons'] ?? false);
$jltma_hide_extensions 		  = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_extensions'] ?? false);
$jltma_hide_icons_library 	= jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_icons_library'] ?? false);
$jltma_hide_api 			        = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_api'] ?? false);
$jltma_hide_white_label 	  = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_white_label'] ?? false);
$jltma_hide_version 		     = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_version'] ?? false);
$jltma_hide_changelogs 		  = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_changelogs'] ?? false);
$jltma_hide_system_info 	  = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_tab_system_info'] ?? false);
?>
<div class="jltma-master-addons-admin">
	<div class="jltma-master-addons-wrap">

		<header class="jltma-master-addons-header is-flex">
			<a class="jltma-master-addons-panel-logo" href="https://master-addons.com/?utm_source=dashboard&utm_medium=settings_header&utm_id=admin_dashboard" target="_blank">
				<img src="<?php echo JLTMA_URL . '/inc/admin/assets/icons/white-logo.png'; ?>" />
			</a>

			<h1 class="jltma-master-addons-title">
				<?php if (!empty($jltma_white_label_setting['jltma_wl_plugin_menu_label'])) {
					printf(__('%s <small>v %s</small>'), $jltma_white_label_setting['jltma_wl_plugin_menu_label'], JLTMA_VER);
				} else {
					printf(__('%s <small>v %s</small>'), JLTMA, JLTMA_VER);
				}
				?>
			</h1>

			<div class="jltma-master-addons-header-text"></div>
		</header>

		<?php require_once JLTMA_PATH . '/inc/admin/welcome/navigation.php'; ?>

		<div class="jltma-master-addons-tab-contents">
			<?php
			if (isset($jltma_hide_welcome) && !$jltma_hide_welcome) {
				require JLTMA_PATH . '/inc/admin/welcome/supports.php';
			}

			if (isset($jltma_hide_addons) && !$jltma_hide_addons) {
				require JLTMA_PATH . '/inc/admin/welcome/addons.php';
			}

			if (isset($jltma_hide_extensions) && !$jltma_hide_extensions) {
				require JLTMA_PATH . '/inc/admin/welcome/extensions.php';
			}

			if (isset($jltma_hide_icons_library) && !$jltma_hide_icons_library) {
				require JLTMA_PATH . '/inc/admin/welcome/icons-library.php';
			}

			if (isset($jltma_hide_api) && !$jltma_hide_api) {
				require JLTMA_PATH . '/inc/admin/welcome/api-keys.php';
			}

			if (isset($jltma_hide_version) && !$jltma_hide_version) {
				require JLTMA_PATH . '/inc/admin/welcome/version-control.php';
			}

			if (isset($jltma_hide_changelogs) && !$jltma_hide_changelogs) {
				require JLTMA_PATH . '/inc/admin/welcome/changelogs.php';
			}

			if (isset($jltma_hide_white_label) && !$jltma_hide_white_label) {
				require JLTMA_PATH . '/inc/admin/welcome/white-label.php';
			}

			if (isset($jltma_hide_system_info) && !$jltma_hide_system_info) {
				require JLTMA_PATH . '/inc/admin/welcome/system-info.php';
			}
			?>
		</div>

	</div>
</div>
