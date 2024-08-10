<?php
if(!isset($animation)) $animation = th_get_option('shop_thumb_animation');
if(empty($size)) $size = array(380,380);
// $size = th_size_random($size);
?>	
<?php if(isset($column) && $view == 'grid') echo '<div '.$item_wrap.'>';?>
	<?php echo '<div '.$item_inner.'>';?>
		<div class="item-product item-product-grid item-product-grid-style8 addcart-hover">
			<?php do_action( 'woocommerce_before_shop_loop_item' );?>
			<div class="product-info-before">
				<?php if($item_rate == 'yes') th_get_rating_html()?>
				<?php if($item_price == 'yes') th_get_price_html()?>
			</div>	
			<?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
				<div class="product-thumb">
					<!-- th_woocommerce_thumbnail_loop have $size and $animation -->
					<?php th_woocommerce_thumbnail_loop($size,$animation);?>			
					<div class="thumb-extra-link icon-small style5"> <!-- "",style2,style3,style4 -->
						<?php if($item_quickview == 'yes') th_product_quickview()?>
						<?php echo th_compare_url();?>
						<?php echo th_wishlist_url();?>
					</div>
					<?php if($item_label == 'yes') th_product_label()?>
					<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
				</div>
			<?php endif?>
			<div class="product-info">
				<?php echo th_get_cat_in()?>
				<?php if($item_title == 'yes'):?>
					<h3 class="title14 product-title">
						<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
				<?php endif?>
				<?php do_action( 'woocommerce_shop_loop_item_title' );?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
				<?php if($item_button == 'yes'):?>				
					<div class="addcart-link-wrap-hover product-extra-link">
						<?php 
						$icon = '<i aria-hidden="true" class="las la-shopping-cart"></i>';
						th_addtocart_link(['icon'=>$icon,'el_class' => 'button']);
						?>
					</div>
				<?php endif?>
			</div>		
			<?php do_action( 'woocommerce_after_shop_loop_item' );?>
		</div>
	</div>
<?php if(isset($column) && $view == 'grid'):?></div><?php endif;?>