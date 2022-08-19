<div class="jltma-pop-contents-body" id="jltma_hf_modal_body">

    <div class="jltma-spinner"></div>

    <div class="jltma-pop-contents-padding">

        <form action="" mathod="get" id="jltma_hf_modal_form" data-open-editor="0" data-editor-url="<?php echo get_admin_url(); ?>" data-nonce="<?php echo wp_create_nonce('jltma_megamenu_modal_rest'); ?>">
            <div class="jltma-modal-header">
                <div class="jltma-tab-content">
                    <div class="jltma-label-container">
                        <div class="jltma-row">

                            <div class="jltma-form-group mb-2 jltma-col-6">
                                <label for="jltma-mobile-submenu-type">
                                    <strong>
                                        <?php esc_html_e('Template Title', 'master-addons' ); ?>
                                    </strong>
                                </label>
                            </div>
                            <div class="jltma-form-group mb-2 jltma-col-6">
                                <input required type="text" name="title" class="jltma_hf_modal-title jltma-form-control" placeholder="<?php echo esc_html__('Template Title here', 'master-addons' ); ?>">
                            </div>

                            <div class="jltma-form-group mb-2 jltma-col-6">
                                <label for="jltma-hf-trigger-effect">
                                    <strong>
                                        <?php esc_html_e('Template Type', 'master-addons' ); ?>
                                    </strong>
                                </label>
                            </div>
                            <div class="jltma-form-group mb-2 jltma-col-6">
                                <select name="type" class="jltma-form-control jltma_hfc_type">
                                    <option value="header" selected="selected">
                                        <?php esc_html_e('Header', 'master-addons' ); ?>
                                    </option>
                                    <option value="footer">
                                        <?php esc_html_e('Footer', 'master-addons' ); ?>
                                    </option>
                                    <option value="comment">
                                        <?php esc_html_e('Comment', 'master-addons' ); ?>
                                    </option>
                                    <!-- <option value="popup"> -->
                                    <?php //esc_html_e('Popup', 'master-addons' );
                                    ?>
                                    <!-- </option> -->
                                </select>
                            </div>


                            <div class="jltma-form-group mb-2 jltma-col-6 jltma-hfc-hide-item-label">
                                <label for="jltma-hf-hide-item-label">
                                    <strong>
                                        <?php esc_html_e('Display Conditions', 'master-addons' ); ?>
                                    </strong>
                                </label>
                            </div>
                            <div class="jltma-form-group mb-2 jltma-col-6 jltma_hf_options_container">
                                <select name="jltma_hf_conditions" class="jltma_hf_modal-jltma_hf_conditions jltma-form-control">
                                    <option value="entire_site">
                                        <?php esc_html_e('Entire Site', 'master-addons' ); ?>
                                    </option>

                                    <?php if (ma_el_fs()->can_use_premium_code()) { ?>
                                        <option value="singular">
                                            <?php esc_html_e('Singular', 'master-addons' ); ?>
                                        </option>
                                        <option value="archive">
                                            <?php esc_html_e('Archive', 'master-addons' ); ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="jltma-hfc-single-pro">
                                            <?php esc_html_e('Singular (Pro)', 'master-addons' ); ?>
                                        </option>
                                        <option value="jltma-hfc-archive-pro">
                                            <?php esc_html_e('Archive (Pro)', 'master-addons' ); ?>
                                        </option>
                                    <?php } ?>

                                </select><br>


                                <div class="jltma_hf_modal-jltma_hfc_singular-container">
                                    <div class="jltma-input-group">
                                        <label class="jltma-attr-input-label"></label>
                                        <select name="jltma_hfc_singular" class="jltma_hf_modal-jltma_hfc_singular jltma-orm-control">
                                            <option value="all"><?php esc_html_e('All Singulars', 'master-addons' ); ?></option>
                                            <option value="front_page"><?php esc_html_e('Front Page', 'master-addons' ); ?></option>
                                            <option value="all_posts"><?php esc_html_e('All Posts', 'master-addons' ); ?></option>
                                            <option value="all_pages"><?php esc_html_e('All Pages', 'master-addons' ); ?></option>
                                            <option value="selective"><?php esc_html_e('Selective Singular', 'master-addons' ); ?>
                                            </option>
                                            <option value="404page"><?php esc_html_e('404 Page', 'master-addons' ); ?></option>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="jltma_hf_modal-jltma_hfc_singular_id-container jltma_multipile_ajax_search_filed">
                                        <div class="jltma-input-group">
                                            <label class="jltma-attr-input-label"></label>
                                            <select multiple name="jltma_hfc_singular_id[]" class="jltma_hf_modal-jltma_hfc_singular_id"></select>
                                        </div>
                                        <br />
                                    </div>
                                    <br>
                                </div>


                            </div>


                            <div class="jltma-form-group mb-2 jltma-col-6">
                                <label for="jltma-hf-hide-item-label">
                                    <strong>
                                        <?php esc_html_e('Enable Settings?', 'master-addons' ); ?>
                                    </strong>
                                </label>
                            </div>

                            <div class="jltma-form-group mb-2 jltma-col-6 jtlma-mega-switcher">
                                <input checked="" type="checkbox" value="yes" class="jltma-admin-control-input jltma-enable-switcher" name="activation" id="jltma_activation_modal_input">
                                <label class="jltma-admin-control-label" for="jltma_activation_modal_input">
                                    <span class="jltma-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div> <!-- tab-content -->
            </div> <!-- modal-header -->



            <div class="jltma-modal-footer">
                <button type="button" class="jltma-btn-editor jltma-save-btn jltma-color-three">
                    <img class="mr-1 mb-1" src="<?php echo JLTMA_IMAGE_DIR . 'icon.png'; ?>" alt="Master Addons Logo">
                    <?php esc_html_e('Edit with Elementor', 'master-addons' ); ?>
                </button>
                <button type="submit" class="jltma-hf-save jltma-save-btn jltma-color-two">
                    <?php esc_html_e('Save Settings', 'master-addons' ); ?>
                </button>
            </div>

        </form>

    </div>
</div>
