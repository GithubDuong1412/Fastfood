
<?php
if(!isset($animation)) $animation = th_get_option('shop_thumb_animation');
if(empty($size)) $size = array(400,400);
global $post;
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
<?php if(isset($column) && $view == 'grid') echo '<div '.$item_wrap.'>';?>
	<?php echo '<div '.$item_inner.'>';?>
		<div class="item-product item-product-grid item-product-grid-style11 detail-gallery">
			<?php do_action( 'woocommerce_before_shop_loop_item' );?>
			<?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
				<div class="product-thumb-wrap">
					<div class="product-thumb mid">
						<!-- th_woocommerce_thumbnail_loop have $size and $animation -->
						<?php th_woocommerce_thumbnail_loop($size,$animation);?>
						<div class="thumb-extra-link icon-small style5"> <!-- "",style2,style3,style4 -->
							<?php if($item_button == 'yes') th_addtocart_link(['style' => 'cart-icon']);?>
							<?php if($item_quickview == 'yes') th_product_quickview()?>
							<?php echo th_compare_url();?>
							<?php echo th_wishlist_url();?>
						</div>
						<?php if($item_label == 'yes') th_product_label()?>
						<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
					</div>
					<div class="gallery-control">
	                    <a href="#" class="prev"><i class="la la-angle-left"></i></a>
	                    <div class="carousel" data-visible="3">
	                        <ul class="list-none">
	                            <?php
	                            $i = 1;
	                            foreach ( $attachment_ids as $attachment_id ) {
	                                if($i == 1) $active = 'active';
	                                else $active = '';
	                                $attributes      = array(
	                                    'data-src'      => wp_get_attachment_image_url( $attachment_id, 'woocommerce_single' ),
	                                    'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'woocommerce_single' ),
	                                    'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
	                                    );
	                                $html = wp_get_attachment_image($attachment_id,'woocommerce_thumbnail',false,$attributes );
	                                echo   '<li data-number="'.esc_attr($i).'">
	                                            <a title="'.esc_attr( get_the_title( $attachment_id ) ).'" class="'.esc_attr($active).'" href="#">
	                                                '.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
	                                            </a>
	                                        </li>';
	                                $i++;
	                            }
	                            ?>
	                        </ul>
	                    </div>
	                    <a href="#" class="next"><i class="la la-angle-right"></i></a>
	                </div>
                </div>
			<?php endif?>
			<div class="product-info">
				<?php echo th_get_cat_in()?>
				<?php if($item_title == 'yes'):?>
					<h3 class="title14 product-title">
						<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
				<?php endif?>
				<?php if($item_rate == 'yes') th_get_rating_html()?>
				<?php if($item_price == 'yes') th_get_price_html()?>
				<div class="desc"><?php echo apply_filters( 'woocommerce_short_description', th_substr($post->post_excerpt,0,130)); ?></div>
				<?php do_action( 'woocommerce_shop_loop_item_title' );?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
			</div>		
			<?php do_action( 'woocommerce_after_shop_loop_item' );?>
		</div>
	</div>
<?php if(isset($column) && $view == 'grid'):?></div><?php endif;?>