<?php

namespace MasterAddons\Admin\Promotions;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 25/07/2021
 */

if (!defined('ABSPATH')) {
    exit;
} // No, Direct access Sir !!!

if (!class_exists('Master_Addons_Promotions')) {
    class Master_Addons_Promotions
    {

        public $timenow;

        private static $instance = null;

        public static function get_instance()
        {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct()
        {
            if (!is_admin()) {
                return;
            }

            $this->timenow = strtotime("now");

            // Admin Notices
            add_action('admin_init', [$this, 'jltma_admin_notice_init']);

            //Notices
            add_action('admin_notices', [$this, 'jltma_latest_update_details'], 10);
            add_action('network_admin_notices', [$this, 'jltma_latest_update_details'], 10);

            if (ma_el_fs()->can_use_premium_code()) {
                add_action('admin_notices', [$this, 'jltma_review_notice_generator'], 10);
            } else {

                add_action('admin_notices', [$this, 'jltma_review_notice_generator'], 10);
                add_action('admin_notices', [$this, 'jltma_upgrade_pro_notice_generator'], 10);

                //Black Friday & Cyber Monday Offer
                add_action('admin_notices', [$this, 'jltma_black_friday_cyber_monday_deals'], 10);
            }

            // Styles
            add_action('admin_enqueue_scripts', [$this, 'jltma_admin_notice_styles']);
        }

        public function jltma_admin_notice_init()
        {
            add_action('wp_ajax_jltma_dismiss_admin_notice', [$this, 'jltma_dismiss_admin_notice']);
        }

        public function jltma_latest_update_details()
        {
            if (!self::is_admin_notice_active('jltma-update-notice-forever')) {
                return;
            }

            $jltma_changelog_message = sprintf(
                __('<h3 class="jltma-update-head">' . JLTMA . ' <span><small><em>v' . JLTMA_VER . '</em></small>' . __(' has some major updates...', 'master-addons' ) . '</span></h3><br>%3$s %4$s %5$s %6$s<br> <strong>Check Changelogs for </strong> <a href="%1$s" target="__blank">%2$s</a>', 'master-addons' ),
                esc_url_raw('https://master-addons.com/changelogs/'),
                __('More Details', 'master-addons' ),

                /** Changelog Items
                 * Starts from: %3$s
                 */
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Timeline Scroll Line updated</span><br>', 'master-addons' ), //%3$s
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Elementor Popup width issue fixed</span><br>', 'master-addons' ),
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Image Hover effect popup icon issue fixed </span><br>', 'master-addons' ),
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Latest Elementor support and deprecated methods updated</span><br>', 'master-addons' ) //%6$s

            );

            printf('<div data-dismissible="jltma-update-notice-forever" id="jltma-admin-notice-forever" class="jltma-notice updated notice notice-success is-dismissible"><p>%1$s</p></div>', $jltma_changelog_message);
        }


        public function jltma_admin_notice_ask_for_review($notice_key)
        {
            if (!self::is_admin_notice_active($notice_key)) {
                return;
            }

            $this->jltma_notice_header($notice_key);
            
            echo /* translators: 1: Plugin name, 2: Wordpress.org Link, 3: Wordpress.org title */  sprintf(
                __('<p>Enjoying <strong>%1$s ?</strong></p> <p>Seems like you are enjoying <strong>%1$s</strong>. Would you please show us a little love by rating us on <a href="%2$s" target="_blank" style="background:yellow; padding:2px 5px;">%3$s?</a></p>
            <ul class="jltma-review-ul">
                <li><a href="%2$s" target="_blank" class="button jltma-sure-do-btn is-warning mt-4 upgrade-btn pt-1 pb-1 pr-4 pl-4" style="background-color: transparent; color: #fff;"><span class="dashicons dashicons-external" style="line-height:inherit"></span>Sure! I\'d love to!</a></li>
                <li><a href="#" target="_blank" class="jltma-admin-notice-dismiss button upgrade-btn mt-4 pt-1 pb-1 pr-4 pl-4"><span class="dashicons dashicons-smiley" style="line-height:inherit"></span>I\'ve already left a review</a></li>
                <li><a href="#" target="_blank" class="jltma-admin-notice-dismiss button is-danger upgrade-btn mt-4 pt-1 pb-1 pr-4 pl-4" style="background-color: #f14668 !important; color:#fff !important; border:1px solid #f14668;"><span class="dashicons dashicons-dismiss" style="line-height:inherit"></span>Never show again</a></li>
            </ul>', 'master-addons' ),
                JLTMA,
                esc_url_raw('https://wordpress.org/support/plugin/master-addons/reviews/?filter=5'),
                __("WordPress.org", "master-addons" )
            );
            $this->jltma_notice_footer();
        }


        public function jltma_admin_upgrade_pro_notice($notice_key)
        {
            if (!self::is_admin_notice_active($notice_key)) {
                return;
            }

            $this->jltma_notice_header($notice_key);

            echo /* translators: 1: Info 2: Discount 3: Coupon */ sprintf(
                __(' <p> %1$s <strong>%2$s</strong> %3$s </p> <p><a class="button upgrade-btn mt-4" href="https://master-addons.com/pricing" target="_blank">Upgrade Now</a></p>', 'master-addons' ),
                __("Unlock all possiblities - Ready made Pro Templates, Extensions, Features and much more .. <br>", "master-addons" ),
                __('20% Discount on all pricing, enjoy the freedom.<br>', 'master-addons' ),
                __("Coupon Code: <strong style='background:yellow; padding:1px 5px; color: #0347FF;'>ENJOY25</strong>", "master-addons" )
            );

            $this->jltma_notice_footer();
        }


        // Black Friday & Cyber Monday Offer
        public function jltma_admin_black_friday_cyber_monday_notice($notice_key)
        {
            if (!self::is_admin_notice_active($notice_key)) {
                return;
            }

            $this->jltma_notice_header($notice_key);

            echo /* translators: 1: Info 2: Discount 3: Coupon */ sprintf(
                __(' <p> %1$s <strong>%2$s</strong> %3$s </p> <p><a class="button upgrade-btn mt-4" href="https://master-addons.com/pricing" target="_blank">Upgrade Now</a></p>', 'master-addons' ),
                __("Unlock all possiblities - 20+ Extensions, Custom Breakpoints, Mega Menu, Icons Library, Comment Form Builder many more.. <br>", "master-addons" ),
                __('50% Huge Discount for <span style="background:#111; padding:2px 10px; color: #fff;">Black Friday and Cyber Monday Deals</span><br>', 'master-addons' ),
                __("Coupon Code: <strong style='background:yellow; padding:2px 10px; color: #0347FF;'>BLACKFRIDAY50</strong>", "master-addons" )
            );


            $this->jltma_notice_footer();
        }


        public function jltma_notice_header($notice_key)
        { ?>
            <div data-dismissible="<?php echo esc_attr($notice_key); ?>" id="<?php echo esc_attr($notice_key); ?>" class="jltma-notice jltma-review-notice-banner updated notice notice-success is-dismissible">
                <div id="jltma-bfcm-upgrade-notice" class="jltma-review-notice">
                    <div class="jltma-admin-notice-banner">
                        <div class="jltma-admin-notice-contents columns is-tablet is-align-items-center">
                            <ul class="jltma-admin-notice-left-nav column is-2-tablet">
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/docs/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-book"></i>
                                        <?php echo __('Docs', 'master-addons' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/all-widgets/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-fullscreen-alt"></i>
                                        <?php echo __('All Demos', 'master-addons' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/pricing">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-editor-help"></i>
                                        <?php echo __('F.A.Q.', 'master-addons' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/contact-us/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-phone"></i>
                                        <?php echo __('Contact Us', 'master-addons' ); ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="jltma-admin-notice-middle column is-8-tablet has-text-centered">

                            <?php }

                        public function jltma_notice_footer()
                        { ?>
                            </div>

                            <div class="jltma-admin-notice-right column is-2-tablet has-text-centered">
                                <ul class="jltma-admin-notice-right-nav">
                                    <li>
                                        <a class="jltma-logo" href="https://master-addons.com/" target="_blank">
                                            <img src="<?php echo JLTMA_IMAGE_DIR; ?>full-logo.png" alt="<?php echo JLTMA; ?>">
                                        </a>
                                    </li>
                                    <li class="jltma-admin-notice-social">
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://www.facebook.com/groups/2495256720521297">
                                            <i class="is-rounded dashicons dashicons-facebook-alt"></i>
                                        </a>
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://www.youtube.com/playlist?list=PLqpMw0NsHXV9V6UwRniXTUkabCJtOhyIf">
                                            <i class="is-rounded dashicons dashicons-youtube"></i>
                                        </a>
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://twitter.com/jwthemeltd">
                                            <i class="is-rounded dashicons dashicons-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="jltma-rate-us mt-3">
                                        <div class="jltma-rate-contents">
                                            <label class="jltma-rating-label">Rate us:</label>
                                            <a class="jltma-rating is-inline-block" href="https://wordpress.org/support/plugin/master-addons/reviews/?filter=5" target="_blank">
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-half"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
                        }

                        public function jltma_dismiss_admin_notice()
                        {
                            $option_name        = sanitize_text_field($_POST['option_name']);
                            $dismissible_length = sanitize_text_field($_POST['dismissible_length']);

                            if ('forever' != $dismissible_length) {
                                // If $dismissible_length is not an integer default to 1
                                $dismissible_length = (0 == absint($dismissible_length)) ? 1 : $dismissible_length;
                                $dismissible_length = strtotime(absint($dismissible_length) . ' days');
                            }

                            check_ajax_referer('jltma-admin-notice-nonce', 'notice_nonce');
                            self::set_admin_notice_cache($option_name, $dismissible_length);
                            wp_die();
                        }

                        public static function set_admin_notice_cache($id, $timeout)
                        {
                            $cache_key = 'jltma-admin-notice-' . md5($id);
                            update_site_option($cache_key, $timeout);

                            return true;
                        }

                        public static function is_admin_notice_active($arg)
                        {
                            $array       = explode('-', $arg);
                            $length      = array_pop($array);
                            $option_name = implode('-', $array);
                            $db_record   = self::get_admin_notice_cache($option_name);

                            if ('forever' === $db_record) {
                                return false;
                            } elseif (absint($db_record) >= time()) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        public static function get_admin_notice_cache($id = false)
                        {
                            if (!$id) {
                                return false;
                            }

                            $cache_key = 'jltma-admin-notice-' . md5($id);
                            $timeout   = get_site_option($cache_key);
                            $timeout   = 'forever' === $timeout ? time() + 45 : $timeout;

                            if (empty($timeout) || time() > $timeout) {
                                return false;
                            }

                            return $timeout;
                        }

                        public function jltma_admin_notice_styles()
                        {
                            $output_css = '';
                            $output_css .= '.jltma-notice *{-webkit-box-sizing:border-box;box-sizing:border-box}.jltma-notice{margin:15px 15px 2px 0!important}.jltma-review-notice .notice-dismiss{padding:0 0 0 26px}.jltma-notice .jltma-update-head{margin:0}.jltma-notice .jltma-update-head span{font-size:.9em}.jltma-notice .jltma-changes-list{padding-left:.5em}.is-align-items-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}.column{display:block;-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1;padding:.75rem}.has-text-centered{text-align:center!important}.columns{display:flex;margin-left:-.75rem;margin-right:-.75rem;margin-top:-.75rem}.jltma-review-notice .notice-dismiss:before{display:none}.jltma-review-notice.jltma-review-notice{background-color:#fff;border-radius:3px;border-left:4px solid transparent;display:flex;align-items:center;padding:10px 10px 10px 0}.jltma-review-notice .jltma-review-thumbnail{width:160px;float:left;margin-right:20px;padding-top:20px;text-align:center;border-right:4px solid transparent}.jltma-review-notice .jltma-review-thumbnail img{vertical-align:middle}.jltma-review-notice .jltma-review-text{flex:0 0 1;overflow:hidden}.jltma-review-notice .jltma-review-text h3{font-size:24px;margin:0 0 5px;font-weight:400;line-height:1.3}.jltma-review-notice .jltma-review-text p{margin:0 0 5px}.jltma-review-notice .jltma-review-ul{margin:5px 0 0;padding:0}.jltma-review-notice .jltma-review-ul li{display:inline-block;margin:5px 15px 0 0}.jltma-review-notice .jltma-review-ul li a{display:inline-block;color:#4b00e7;position:relative}.jltma-review-notice .jltma-review-ul li a:not(.notice-dismiss) span.dashicons{font-size:17px;float:left;height:auto;width:auto;margin-right:3px}#wpbody-content .jltma-notice.jltma-review-notice-banner{background-color:#4b00e7;border-left:0;padding-right:.5rem}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-banner{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%}#wpbody-content .jltma-review-notice-banner .jltma-review-notice{background-color:transparent;font-size:15px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice p{color:#fff;font-size:15px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav{margin:0}@media screen and (min-width:769px){.column.is-2,.column.is-2-tablet{-webkit-box-flex:0;-webkit-flex:none;-ms-flex:none;flex:none;width:16.6666666667%}.column.is-8,.column.is-8-tablet{-webkit-box-flex:0;-webkit-flex:none;-ms-flex:none;flex:none;width:66.6666666667%}}.mr-2{margin-right:.5rem!important}.mt-4{margin-top:1.5rem!important}img{max-width:100%}.is-pulled-left{float:left!important}.is-rounded{border-radius:9999px}a{text-decoration:none}.wp-adminify .is-rounded{-webkit-border-radius:9999px;border-radius:9999px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav li{clear:both;margin-bottom:5px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-admin-notice-left-nav a{color:#fff;display:inline-block;line-height:25px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav a i{background-color:#fff;color:#4b00e7;font-size:20px;height:26px;width:26px;line-height:26px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn{background-color:#fff;border:1px solid #fff;color:#4b00e7;font-size:16px;font-weight:800;border-radius:8px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn:hover{border:1px solid #fff!important;background:#4b00e7!important;color:#fff!important}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn:focus{background-color:#fff}.jltma-review-notice-banner .jltma-logo{display:flex;margin:0 auto 1rem;max-width:135px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-social-icon i{background-color:#fff;height:40px;width:40px;line-height:40px;margin:3px}.jltma-review-notice-banner .jltma-logo{max-width:135px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-rate-contents,#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-rate-contents a{color:#fff}.jltma-review-notice-banner .jltma-rating{display:inline-block;direction:rtl}.jltma-review-notice-banner .jltma-rating label{font-size:0;line-height:0}.jltma-review-notice-banner .jltma-rate-contents i{font-size:14px;height:auto;width:auto;line-height:0;vertical-align:middle}.jltma-rating input{display:none!important}.jltma-rating:hover span i:before{content:"\f154"}.jltma-rating span:hover i:before,.jltma-rating span:hover~span i:before{content:"\f155"}#wpbody-content .jltma-review-notice-banner .notice-dismiss{border-color:#fff}#wpbody-content .jltma-review-notice-banner .notice-dismiss:before{color:#fff}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .jltma-sure-do-btn:hover{background-color:#00d1b2!important;border-color:transparent!important}';
                            echo '<style>' . strip_tags($output_css) . '</style>';
        ?>

<?php }

                        public function jltma_get_total_interval($interval, $type)
                        {
                            switch ($type) {
                                case 'years':
                                    return $interval->format('%Y');
                                    break;
                                case 'months':
                                    $years = $interval->format('%Y');
                                    $months = 0;
                                    if ($years) {
                                        $months += $years * 12;
                                    }
                                    $months += $interval->format('%m');
                                    return $months;
                                    break;
                                case 'days':
                                    return $interval->format('%a');
                                    break;
                                case 'hours':
                                    $days = $interval->format('%a');
                                    $hours = 0;
                                    if ($days) {
                                        $hours += 24 * $days;
                                    }
                                    $hours += $interval->format('%H');
                                    return $hours;
                                    break;
                                case 'minutes':
                                    $days = $interval->format('%a');
                                    $minutes = 0;
                                    if ($days) {
                                        $minutes += 24 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $minutes += 60 * $hours;
                                    }
                                    $minutes += $interval->format('%i');
                                    return $minutes;
                                    break;
                                case 'seconds':
                                    $days = $interval->format('%a');
                                    $seconds = 0;
                                    if ($days) {
                                        $seconds += 24 * 60 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $seconds += 60 * 60 * $hours;
                                    }
                                    $minutes = $interval->format('%i');
                                    if ($minutes) {
                                        $seconds += 60 * $minutes;
                                    }
                                    $seconds += $interval->format('%s');
                                    return $seconds;
                                    break;
                                case 'milliseconds':
                                    $days = $interval->format('%a');
                                    $seconds = 0;
                                    if ($days) {
                                        $seconds += 24 * 60 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $seconds += 60 * 60 * $hours;
                                    }
                                    $minutes = $interval->format('%i');
                                    if ($minutes) {
                                        $seconds += 60 * $minutes;
                                    }
                                    $seconds += $interval->format('%s');
                                    $milliseconds = $seconds * 1000;
                                    return $milliseconds;
                                    break;
                                default:
                                    return NULL;
                            }
                        }


                        public function jltma_days_differences()
                        {
                            $install_date = get_option('jltma_activation_time');
                            // $install_date = strtotime('2021-09-3 14:39:05'); // Testing datetime
                            $jltma_datetime1 = \DateTime::createFromFormat('U', $install_date);
                            $jltma_datetime2 = \DateTime::createFromFormat('U', strtotime("now"));

                            $interval = $jltma_datetime2->diff($jltma_datetime1);

                            $jltma_days_diff = $this->jltma_get_total_interval($interval, 'days');
                            return $jltma_days_diff;
                        }


                        public function jltma_review_notice_generator()
                        {
                            $jltma_seven_day_notice = $this->jltma_days_differences();
                            $diff_modulas = $jltma_seven_day_notice % 15;

                            if ($jltma_seven_day_notice <= 7) {
                                return;
                            }

                            if (($jltma_seven_day_notice < 15) && ($diff_modulas >= 8 && $diff_modulas <= 12)) {
                                $this->jltma_admin_notice_ask_for_review('jltma-nine-to-twelve');
                                return;
                            }

                            // No Review Ask for Pro Customers
                            // if (ma_el_fs()->can_use_premium_code()) {
                            //     if (($diff_modulas >= 0 && $diff_modulas < 5) || ($diff_modulas >= 11 && $diff_modulas < 14)) {
                            //         $this->jltma_admin_notice_ask_for_review('jltma-zero-to-five');
                            //     }
                            // }
                        }

                        public function jltma_upgrade_pro_notice_generator()
                        {
                            $jltma_seven_day_notice = $this->jltma_days_differences();
                            $diff_modulas = $jltma_seven_day_notice % 15;
                            if ($jltma_seven_day_notice <= 7) {
                                return;
                            }

                            if (($jltma_seven_day_notice < 15) && ($diff_modulas >= 13)) {
                                $this->jltma_admin_upgrade_pro_notice('jltma-after-thirteen');
                                return;
                            }


                            if ($jltma_seven_day_notice >= 15 && $diff_modulas >= 5 && $diff_modulas < 11) {
                                $this->jltma_admin_upgrade_pro_notice('jltma-five-to-eleventh');
                            }
                        }

                        public function jltma_black_friday_cyber_monday_deals()
                        {
                            $today = date("Y-m-d");
                            $start_date = '2021-11-22';
                            $expire_date = '2021-12-30';

                            $today_time = strtotime($today);
                            $start_time = strtotime($start_date);
                            $expire_time = strtotime($expire_date);
                            if ($today_time >= $start_time && $today_time <= $expire_time) {
                                $this->jltma_admin_black_friday_cyber_monday_notice('jltma-bfcm-2021');
                            }
                        }
                    }
                    Master_Addons_Promotions::get_instance();
                }
