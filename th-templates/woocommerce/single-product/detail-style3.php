<?php
remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_images',20 );
remove_action( 'woocommerce_product_thumbnails','woocommerce_show_product_thumbnails',20 );
th_set_post_view();
$thumb_class = 'col-md-5 col-sm-12 col-xs-12';
$info_class = 'col-md-7 col-sm-12 col-xs-12';
$zoom_style = th_get_option('product_image_zoom');
global $product;
$thumb_id = array(get_post_thumbnail_id());
$attachment_ids = $product->get_gallery_image_ids();
$attachment_ids = array_merge($thumb_id,$attachment_ids);
$gallerys = ''; $i = 1;
foreach ( $attachment_ids as $attachment_id ) {
    $image_link = wp_get_attachment_url( $attachment_id );
    if($i == 1) $gallerys .= $image_link;
    else $gallerys .= ','.$image_link;
    $i++;
}
?>
<div class="product-detail product-detail-style3">
    <div class="row">
        <div class="<?php echo esc_attr($thumb_class)?>">
            <div class="detail-gallery2">
                <div class="wrap-detail-gallery images <?php echo esc_attr($zoom_style)?>">
                    <?php                    
                    if ( $attachment_ids && has_post_thumbnail() && count($attachment_ids) > 1) {
                    ?>
                    <ul class="list-none">
                        <?php
                        $i = 0;
                        foreach ( $attachment_ids as $attachment_id ) {
                            if($i == 0) $active = 'active';
                            else $active = '';
                            $attributes      = array(
                                'data-src'      => wp_get_attachment_image_url( $attachment_id, 'woocommerce_single' ),
                                'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'woocommerce_single' ),
                                'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
                                );
                            $html = wp_get_attachment_image($attachment_id,array(400,400),false,$attributes );
                            echo   '<li>
                                        <a title="'.esc_attr( get_the_title( $attachment_id ) ).'" class="image-lightbox '.esc_attr($active).'" href="#" data-index="'.esc_attr($i).'" data-gallery="'.esc_attr($gallerys).'">
                                            '.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
                                        </a>
                                    </li>';
                            $i++;
                        }
                        ?>
                    </ul>                    
                    <?php
                        do_action( 'woocommerce_product_thumbnails' );
                    }
                    ?>
                </div>
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