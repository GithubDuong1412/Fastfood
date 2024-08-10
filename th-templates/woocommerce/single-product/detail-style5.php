<?php
th_set_post_view();
//add_filter( 'woocommerce_product_thumbnails_columns', 'th_change_product_thumbnails_columns' );
function th_change_product_thumbnails_columns() {
    return 8; // change the value as per your need
}
$thumb_class = 'col-md-12 col-sm-12 col-xs-12';
$info_class = 'col-md-12 col-sm-12 col-xs-12';
?>
<div class="product-detail detail-style5">
    <div class="row">
        <div class="<?php echo esc_attr($thumb_class)?>">
            <div class="detail-gallery">
                <?php do_action( 'woocommerce_before_single_product_summary' );?>
                <?php th_get_template( 'share','',false,true );?>
            </div>
        </div>
        <div class="<?php echo esc_attr($info_class)?>">
            <div class="summary entry-summary detail-info">
                <h2 class="product-title titlelv1"><?php the_title()?></h2>
                <?php
                    do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
?>