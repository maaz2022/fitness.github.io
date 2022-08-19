<?php

use MasterAddons\Inc\Helper\Master_Addons_Helper;

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'page_id'        => absint($prod_list)
);

$jltma_wc_wp_query = new WP_Query;

$jltma_wc_wp_query->query($args);

while ($jltma_wc_wp_query->have_posts()) {
    $jltma_wc_wp_query->the_post();

    $jltma_wc_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
    $excerpt = Master_Addons_Helper::jltma_excerpt_truncate(get_the_excerpt(), esc_attr($excerpt_size), '...');

    if (Master_Addons_Helper::jltma_get_featured_image_url() !== false) {
        $featured_image_src = aq_resize(esc_url(Master_Addons_Helper::jltma_get_featured_image_url()), $image_width, $image_height, true, true, true);
    } else {
        $featured_image_src = WP_PLUGIN_URL . '/woocommerce/assets/images/placeholder.png';
    }
?>

    <div class="jltma_wc_single_product_item">
        <div class="jltma_wc_single_product_wrapper">
            <?php
            if ($image_status == 'yes') {
            ?>
                <div class="jltma_wc_prod_image_cont">
                    <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($jltma_wc_alt_text); ?>" />
                </div>
            <?php
            }

            if ($title_status == 'yes') {
            ?>
                <div class="jltma_wc_prod_title_cont">
                    <h3 class="jltma_wc_prod_title">
                        <a href="<?php echo (($title_link == 'yes') ? '' . esc_url(get_permalink()) . '' : 'javascript:void(0)'); ?>" class="<?php echo (($title_link == 'yes') ? '' : 'no_linked_title'); ?>">
                            <?php echo esc_html(get_the_title()); ?>
                        </a>
                    </h3>
                </div>
            <?php
            }

            if ($description_status == 'yes') {
            ?>
                <div class="jltma_wc_prod_description_cont">
                    <?php echo esc_html($excerpt); ?>
                </div>
            <?php
            }
            ?>

            <div class="jltma_wc_price_cont jltma_wc_cart_button_<?php echo esc_attr($cart_button); ?>">
                <?php echo do_shortcode('[add_to_cart id="' . get_the_ID() . '" style="border: none;"]') ?>
            </div>
        </div>
    </div>
<?php
}

wp_reset_postdata();
