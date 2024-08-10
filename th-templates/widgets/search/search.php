<?php
namespace Elementor;
?>
<div class="elth-search-wrap <?php echo esc_attr($settings['style'].' live-search-'.$settings['live_search'])?>">
			<?php if($settings['style'] == 'elth-search-icon'):?>
				<div class="search-icon-popup">
					<?php Icons_Manager::render_icon( $settings['icon_popup'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php endif;?>
			<div class="elth-search-form-wrap">
				<i class="la la-times elth-close-search-form"></i>
				<form class="elth-search-form <?php echo esc_attr($settings['align_form'])?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			        <?php if($settings['show_cat'] == 'yes' && $settings['search_in'] != 'all'):?>
			            <div class="elth-dropdown-box">
			                <span class="dropdown-link current-search-cat">
			                	<?php echo esc_html($settings['title_cat'])?>
			                	<i class="la la-angle-down"></i>		                		
			                </span>
			                <ul class="list-none elth-dropdown-list">
			                    <li class="active"><a class="select-cat-search" href="#" data-filter=""><?php echo esc_html($settings['title_cat'])?></a></li>
			                    <?php
			                        $taxonomy = 'category';
			                        $tax_key = 'category_name';
			                        if($settings['search_in'] == 'product') $taxonomy = $tax_key = 'product_cat';
			                        if(!empty($cats)){
			                            $custom_list = explode(",",$cats);
			                            foreach ($custom_list as $key => $cat) {
			                                $term = get_term_by( 'slug',$cat, $taxonomy );
			                                if(!empty($term) && is_object($term)){
			                                    if(!empty($term) && is_object($term)){
			                                        echo '<li><a class="select-cat-search" href="#" data-filter="'.$term->slug.'">'.$term->name.'</a></li>';
			                                    }
			                                }
			                            }
			                        }
			                        else{
			                            $product_cat_list = get_terms($taxonomy);
			                            if(is_array($product_cat_list) && !empty($product_cat_list)){
			                                foreach ($product_cat_list as $cat) {
			                                    echo '<li><a class="select-cat-search" href="#" data-filter="'.$cat->slug.'">'.$cat->name.'</a></li>';
			                                }
			                            }
			                        }
			                    ?>
			                </ul>
			            </div>
			            <input class="cat-value" type="hidden" name="<?php echo esc_attr($tax_key)?>" value="" />
			        <?php endif;?>
			        <input name="s" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="<?php echo esc_attr($settings['placeholder']);?>" type="text" autocomplete="off">
			        <?php if($settings['search_in'] != 'all'):?>
			            <input type="hidden" name="post_type" value="<?php echo esc_attr($settings['search_in'])?>" />
			        <?php endif;?>
			        <div class="elth-submit-form">
			            <input type="submit" value="">
			            <span class="elth-text-bt-search">
			            	<?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'before-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
			            	<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			            	<?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'after-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
			            </span>
			        </div>
			        <div class="elth-list-product-search th-scrollbar">
			            <p class="text-center"><?php esc_html_e("Please enter key search to display results.","autopart")?></p>
			        </div>
			    </form>
			</div>
		</div>