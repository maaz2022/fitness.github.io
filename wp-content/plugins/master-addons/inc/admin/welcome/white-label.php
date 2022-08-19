<?php

use  MasterAddons\Inc\Classes\Master_Addons_White_Label ;
$jltma_white_label_options = get_option( 'jltma_white_label_settings' );
if ( empty($jltma_white_label_options) ) {
    $jltma_white_label_options = Master_Addons_White_Label::jltma_white_label_default_options();
}
?>

<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-white-label" style="display: none;">
    <div class="jltma-master-addons-features">
        <?php 
?>

        <div class="jltma-tab-dashboard-wrapper">
            <form action="" method="POST" id="jltma-addons-white-label-settings" class="jltma-addons-tab-settings" name="jltma-addons-white-label-settings">

                <?php 
wp_nonce_field( 'jltma_options_settings_nonce_action' );
?>

                <?php 
?>
                    <div class="jltma-addons-white-label-notice">
                        <div class="jltma-addons-white-label-notice-content">
                            <div class="jltma-addons-white-label-notice-logo">
                                <img src="<?php 
echo  esc_url( JLTMA_IMAGE_DIR ) . 'logo.png' ;
?>" alt="Master Addons">
                            </div>
                            <h2><?php 
_e( 'Upgrade <span>Pro</span> for White Labeling', 'master-addons' );
?></h2>
                            <p>
                                <?php 
_e( 'Master Addons can be completely re-branded with your own brand Logo, Name and Author Details. Your clients will never know what tools you are using to build their website and will think that this is your own tool set. White-labeling works as long as your license is active.', 'master-addons' );
?><br>
                                <em><?php 
_e( 'Note: Developer Plans Only', 'master-addons' );
?></em>
                            </p>
                            <a class="jltma-button jltma-get-pro" href="<?php 
echo  esc_url( 'https://master-addons.com/pricing/' ) ;
?>" target="_blank"><?php 
_e( 'Get PRO', 'master-addons' );
?></a>
                        </div>
                    </div>
                <?php 
?>
                <div class="jltma-addons-dashboard-tabs-wrapper">
                    <div class="jltma-master-addons-dashboard-filter is-flex">
                        <!-- Start of White Label Settings -->
                        <div class="jltma-api-settings-element jltma-half">
                            <h4><?php 
echo  esc_html__( 'White Label Settings', 'master-addons' ) ;
?></h4>
                            <div class="jltma-api-element-inner">
                                <div class="jltma-api-forms">

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_logo">
                                            <?php 
echo  esc_html__( 'Logo Image', 'master-addons' ) ;
?>
                                        </label>
                                        <div class="jltma-logo-handler">
                                            <?php 
$image_id = jltma_check_options( $jltma_white_label_options['jltma_wl_plugin_logo'] );

if ( $image = wp_get_attachment_image_src( $image_id ) ) {
    echo  '<a href="#" class="jltma-form-control jltma-wl-plugin-logo"><img src="' . esc_url( $image[0] ) . '" /></a>
                                                        <a href="#" class="jltma-remove-button"><i class="dashicons dashicons-no-alt"></i></a>
                                                        <input type="hidden" name="jltma_wl_plugin_logo" value="' . esc_attr( $image_id ) . '">' ;
} else {
    echo  '<a href="#" class="jltma-form-control jltma-wl-plugin-logo"><i class="dashicons dashicons-cloud-upload"></i> <span>Upload image</span></a>
                                                        <a href="#" class="jltma-remove-button" style="display:none"><i class="dashicons dashicons-no-alt"></i></a>
                                                        <input type="hidden" class="jltma-whl-selected-image" name="jltma_wl_plugin_logo" value="">' ;
}

?>
                                        </div>
                                    </div>


                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_name">
                                            <?php 
echo  esc_html__( 'Plugin Name', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_name" type="text" class="jltma-form-control jltma_wl_plugin_name" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_name'] ) ? esc_html( $jltma_white_label_options['jltma_wl_plugin_name'] ) : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_desc">
                                            <?php 
echo  esc_html__( 'Plugin Description', 'master-addons' ) ;
?>
                                        </label>
                                        <textarea name="jltma_wl_plugin_desc" type="text" class="jltma-form-control jltma_wl_plugin_desc" cols="50"><?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_desc'] ) ? esc_html( $jltma_white_label_options['jltma_wl_plugin_desc'] ) : "" ) ;
?></textarea>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_author_name">
                                            <?php 
echo  esc_html__( 'Developer/Agency Name', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_author_name" type="text" class="jltma-form-control jltma_wl_plugin_author_name" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_author_name'] ) ? esc_html( $jltma_white_label_options['jltma_wl_plugin_author_name'] ) : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_menu_label">
                                            <?php 
echo  esc_html__( 'Menu Label', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_menu_label" type="text" class="jltma-form-control jltma_wl_plugin_menu_label" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_menu_label'] ) ? esc_html( $jltma_white_label_options['jltma_wl_plugin_menu_label'] ) : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_url">
                                            <?php 
echo  esc_html__( 'Plugin URL', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_url" type="text" class="jltma-form-control jltma_wl_plugin_url" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_url'] ) ? esc_html( $jltma_white_label_options['jltma_wl_plugin_url'] ) : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_placeholder_image">
                                            <?php 
echo  esc_html__( 'Disable MA Placeholder Image', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_placeholder_image" type="checkbox" class="jltma-form-control jltma_wl_placeholder_image" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_placeholder_image'] ?? false, true );
?>>
                                        <p class="pl-3"><?php 
echo  __( 'This will hide Master Addons placholder image and enable the elementor placeholder image.', 'master-addons' ) ;
?></p>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_row_links">
                                            <?php 
echo  esc_html__( 'Hide Plugin Row Meta Links', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_row_links" type="checkbox" class="jltma-form-control jltma_wl_plugin_row_links" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_row_links'] ?? false, true );
?>>
                                        <p class="pl-3"><?php 
echo  __( 'This will hide Support, Docs & FAQs and Video Tutorials links on Plugins page.', 'master-addons' ) ;
?></p>
                                    </div>

                                </div>
                            </div><!-- /.jltma-api-element-inner -->
                        </div><!-- /.jltma-api-settings-element jltma-half -->
                        <!-- End of White Label Settings -->


                        <!-- Start of White Label Admin Settings -->
                        <div class="jltma-api-settings-element jltma-half">
                            <h4><?php 
echo  esc_html__( 'Admin Settings', 'master-addons' ) ;
?></h4>
                            <div class="jltma-api-element-inner">
                                <div class="jltma-api-forms">

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_welcome">
                                            <?php 
echo  esc_html__( 'Hide Welcome Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_welcome" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_welcome" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_welcome'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_addons">
                                            <?php 
echo  esc_html__( 'Hide Addons Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_addons" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_addons" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_addons'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_extensions">
                                            <?php 
echo  esc_html__( 'Hide Extensions Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_extensions" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_extensions" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_extensions'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_icons_library">
                                            <?php 
echo  esc_html__( 'Hide Icons Library', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_icons_library" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_icons_library" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_icons_library'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_api">
                                            <?php 
echo  esc_html__( 'Hide API Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_api" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_api" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_api'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_white_label">
                                            <?php 
echo  esc_html__( 'Hide White Label Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_white_label" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_white_label" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_white_label'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_version">
                                            <?php 
echo  esc_html__( 'Hide Version Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_version" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_version" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_version'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_changelogs">
                                            <?php 
echo  esc_html__( 'Hide Changelogs Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_changelogs" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_changelogs" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_changelogs'] ?? false, true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_system_info">
                                            <?php 
echo  esc_html__( 'Hide System Info Tab', 'master-addons' ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_system_info" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_system_info" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_system_info'] ?? false, true );
?>>
                                    </div>

                                    <p class="border border-danger p-2">
                                        <strong><?php 
_e( 'NOTE: ', 'master-addons' );
?></strong>
                                        <?php 
echo  __( 'You will need to reactivate Master Addons PRO for Elementor plugin to be able to reset White Labeling Tab Options.', 'master-addons' ) ;
?>
                                    </p>

                                </div>
                            </div><!-- /.jltma-api-element-inner -->
                        </div><!-- /.jltma-api-settings-element jltma-half -->
                        <!-- End of White Label Admin Settings -->

                    </div>
                </div><!-- /.master_addons_feature -->
            </form>
        </div>
    </div>
</div>
