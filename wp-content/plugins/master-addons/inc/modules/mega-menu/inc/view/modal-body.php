<div class="jltma-pop-contents-body">
    <div class="jltma-pop-contents-padding">

        <div class="jltma-modal-header">
            <div class="jltma-row">
                <ul class="jltma-tabs jltma_menu_control_nav jltma-col-4">
                    <li id="content_nav" class="jltma-nav-item">
                        <a class="jltma-nav-link active" href="#content_tab">
                            <?php esc_html_e('Content', 'master-addons' ); ?>
                        </a>
                    </li>

                    <li id="general_nav" class="jltma-nav-item">
                        <a class="jltma-nav-link" href="#general_tab">
                            <?php esc_html_e('Settings', 'master-addons' ); ?>
                        </a>
                    </li>

                    <li id="icon_nav" class="jltma-nav-item">
                        <a class="jltma-nav-link" href="#icon_tab">
                            <?php esc_html_e('Icon', 'master-addons' ); ?>
                        </a>
                    </li>

                    <li id="badge_nav" class="jltma-nav-item">
                        <a class="jltma-nav-link" href="#badge_tab">
                            <?php esc_html_e('Badge', 'master-addons' ); ?>
                        </a>
                    </li>

                </ul>

                <div class="jltma-tab-content jltma-col-8">
                    <div class="jltma-tab-pane active" id="content_tab">
                        <?php if (defined('ELEMENTOR_VERSION')) : ?>

                            <div class="jltma-pop-content-inner">
                                <div id="jltma-menu-builder-wrapper">
                                    <div class="jltma-custom-switch">
                                        <span class="jltma-switch-title jltma-menu-mega-submenu enabled_item">
                                            <?php esc_html_e('Megamenu Enabled'); ?>
                                        </span>
                                        <span class="jltma-switch-title jltma-menu-mega-submenu disabled_item">
                                            <?php esc_html_e('Megamenu Disabled'); ?>
                                        </span>

                                        <label for="jltma-menu-item-enable" class="jltma-switch">
                                            <input type="checkbox" value="1" id="jltma-menu-item-enable" />
                                            <span class="jltma-switch-slider round"></span>
                                            <span class="jltma-absolute-no"><?php esc_html_e('NO'); ?></span>
                                        </label>
                                    </div>
                                </div>

                                <button disabled type="button" id="jltma-menu-builder-trigger" class="jltma-menu-elementor-button content-edit-btn" data-toggle="modal" data-target="#jltma-mega-menu-builder-modal">
                                    <?php esc_html_e('Edit Megamenu Content'); ?>
                                </button>
                            </div>


                        <?php else : ?>
                            <p class="no-elementor-notice">
                                <?php esc_html_e('Elementor Page Builder required to Edit Megamenu Content', 'master-addons' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="jltma-tab-pane" id="general_tab">

                        <div class="option-table jltma-label-container">
                            <div class="jltma-row">

                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <label for="jltma-megamenu-width-type">
                                        <strong>
                                            <?php esc_html_e('Mega Menu Width', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <select class="jltma-form-control" id="jltma-megamenu-width-type">
                                        <option value="default" selected="selected"><?php esc_html_e('Default Width', 'master-addons' ); ?></option>
                                        <option value="full_width"><?php esc_html_e('Full Width', 'master-addons' ); ?></option>
                                        <option value="custom_width"><?php esc_html_e('Custom Width', 'master-addons' ); ?></option>
                                    </select>
                                    <input id="jltma-megamenu-width" class="jltma-form-control hidden" type="text" placeholder="1000px" />
                                </div>
                            </div>

                            <div class="jltma-row">

                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <label for="jltma-mobile-submenu-type">
                                        <strong>
                                            <?php esc_html_e('Mobile Menu', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <select class="jltma-form-control" id="jltma-mobile-submenu-type">
                                        <option value="submenu_list"><?php esc_html_e('WP Menu List', 'master-addons' ); ?></option>
                                        <option value="builder_content" selected="selected"><?php esc_html_e('Builder Content', 'master-addons' ); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="jltma-row">
                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <label for="mega-menu-trigger-effect">
                                        <strong>
                                            <?php esc_html_e('Trigger Effect', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <select class="jltma-form-control" id="mega-menu-trigger-effect">
                                        <option value="" selected="selected"><?php esc_html_e('Hover', 'master-addons' ); ?></option>
                                        <option value="click"><?php esc_html_e('Click', 'master-addons' ); ?></option>
                                    </select>
                                </div>
                            </div>


                            <!-- <div class="jltma-form-group mb-2 jltma-col-7">
                                    <label for="mega-menu-transition-effect">
                                        <strong>
                                        <?php //esc_html_e('Transition', 'master-addons' );
                                        ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <select class="jltma-form-control" id="mega-menu-transition-effect">
                                        <option value="" selected="selected"><?php //echo esc_html__('Fade', 'master-addons' );
                                                                                ?></option>
                                        <option value="slide"><?php //esc_html_e('Slide Left', 'master-addons' );
                                                                ?></option>
                                        <option value="slide-left"><?php //esc_html_e('Slide Right', 'master-addons' );
                                                                    ?></option>
                                        <option value="slide-down"><?php //esc_html_e('Slide Down', 'master-addons' );
                                                                    ?></option>
                                        <option value="slide-up"><?php //esc_html_e('Slide Up', 'master-addons' );
                                                                    ?></option>
                                        <option value="slide-up-fade"><?php //esc_html_e('Slide Up With Fade', 'master-addons' );
                                                                        ?></option>
                                        <option value="slide-down-fade"><?php //esc_html_e('Slide Down With Fade', 'master-addons' );
                                                                        ?></option>
                                        <option value="super-slidedown"><?php //esc_html_e('Super SlideDown', 'master-addons' );
                                                                        ?></option>
                                        <option value="zoom-inout"><?php //esc_html_e('Zoom In/Out', 'master-addons' );
                                                                    ?></option>
                                        <option value="flip-effect"><?php //esc_html_e('Flip Effect', 'master-addons' );
                                                                    ?></option>
                                    </select>
                                </div> -->




                            <div class="jltma-row">
                                <div class="jltma-form-group mb-2 jltma-col-6 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <label for="mega-menu-hide-item-label">
                                        <strong>
                                            <?php esc_html_e('Show Menu Label', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-6 jtlma-mega-switcher <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                                        echo "jltma-disabled";
                                                                                                    } ?>">
                                    <input type='checkbox' id="mega-menu-hide-item-label" class='mega-menu-hide-item-label' name='mega-menu-hide-item-label' value='1' />
                                    <label for="mega-menu-hide-item-label">
                                        <?php _e("NO", "master-addons" ) ?>
                                    </label>
                                </div>



                                <?php if (!ma_el_fs()->can_use_premium_code()) {
                                    echo '<span class="jltma-pro-badge eicon-pro-icon"></span>';
                                } ?>
                            </div>

                            <div class="jltma-row">
                                <div class="jltma-form-group mb-2 jltma-col-6 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <label for="mega-menu-hide-item-label">
                                        <strong>
                                            <?php esc_html_e('Show Description', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-6 jtlma-mega-switcher <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                                        echo "jltma-disabled";
                                                                                                    } ?>">
                                    <input type='checkbox' id="jltma-menu-disable-description" class='jltma-menu-disable-description' name='jltma-menu-disable-description' value='1' />
                                    <label for="jltma-menu-disable-description">
                                        <?php _e("NO", "master-addons" ) ?>
                                    </label>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="jltma-tab-pane" id="icon_tab">

                        <div class="option-table jltma-label-container">
                            <div class="jltma-row">

                                <div class="jltma-form-group mb-2 jltma-col-7 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <label for="jltma-menu-icon-field">
                                        <strong>
                                            <?php esc_html_e('Menu Icon', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>

                                <div class="jltma-form-group mb-2 jltma-col-5 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <div data-target="icon-picker" class="button icon-picker"></div>
                                    <input id="jltma-menu-icon-field" class="icon-picker-input" type="text" placeholder="Click Icon for Picker" />
                                </div>

                                <?php if (!ma_el_fs()->can_use_premium_code()) {
                                    echo '<span class="jltma-pro-badge top-badge eicon-pro-icon"></span>';
                                } ?>


                                <div class="jltma-form-group mb-2 jltma-col-7 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <label for="jltma-menu-icon-color-field">
                                        <strong>
                                            <?php esc_html_e('Icon Color', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-5 <?php if (!ma_el_fs()->can_use_premium_code()) {
                                                                                    echo "jltma-disabled";
                                                                                } ?>">
                                    <input type="text" value="#6f10b5" class="jltma-menu-wpcolor-picker" id="jltma-menu-icon-color-field" />
                                </div>


                            </div>
                        </div>


                    </div>

                    <div class="jltma-tab-pane" id="badge_tab">


                        <div class="option-table jltma-label-container">
                            <div class="jltma-row">

                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <label for="jltma-menu-badge-text-field">
                                        <strong>
                                            <?php esc_html_e('Badge Text', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <input type="text" placeholder="<?php esc_html_e('Badge Text', 'master-addons' ); ?>" id="jltma-menu-badge-text-field" />
                                </div>


                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <label for="jltma-menu-badge-color-field">
                                        <strong>
                                            <?php esc_html_e('Badge Color', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <input type="text" class="jltma-menu-wpcolor-picker" value="#6f10b5" id="jltma-menu-badge-color-field" />
                                </div>


                                <div class="jltma-form-group mb-2 jltma-col-7">
                                    <label for="jltma-menu-badge-background-field">
                                        <strong>
                                            <?php esc_html_e('Background', 'master-addons' ); ?>
                                        </strong>
                                    </label>
                                </div>
                                <div class="jltma-form-group mb-2 jltma-col-5">
                                    <input type="text" class="jltma-menu-wpcolor-picker" value="#6f10b5" id="jltma-menu-badge-background-field" />
                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
