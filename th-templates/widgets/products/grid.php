<?php
extract($settings);
$attr = array(
	'item_wrap'         => $item_wrap,
    'item_inner'        => $item_inner,
    'button_icon_pos'   => $button_icon_pos,
    'button_icon'       => $button_icon,
    'button_text'       => $button_text,
    'size'              => $size,
    'view'              => $view,
    'column'            => $column,
    'item_style'        => $item_style,
    'item_thumbnail'    => $item_thumbnail,
    'item_quickview'    => $item_quickview,
    'item_label'        => $item_label,
    'item_title'        => $item_title,
    'item_rate'         => $item_rate,
    'item_price'        => $item_price,
    'item_button'       => $item_button,
    'animation'         => $thumbnail_hover_animation,
	);
?>
<?php echo '<div '.$wdata->get_render_attribute_string( 'elth-wrapper' ).'>';?>
    <?php
    if($filter_show == 'yes'){
        $data_filter = array(
            'args'          => $args,
            'attr'          => $attr,
            'filter_style'  => $filter_style,
            'filter_column' => $filter_column,
            'filter_cats'   => $filter_cats,
            'filter_price'  => $filter_price,
            'filter_attr'   => $filter_attr,
            'filter_pos'    => '',
        );
        th_get_template_woocommerce('loop/filter-product','',$data_filter,true);
    }
    ?>
    <?php echo '<div '.$wdata->get_render_attribute_string( 'elth-inner' ).'>';?>
    	<?php
    	if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                $attr['count'] = $count;
    			th_get_template_woocommerce('loop/grid/grid',$item_style,$attr,true);
                $count++;
    		}
    	}
    	?>
	</div>
	<?php
	if($pagination == 'load-more' && $max_page > 1){
        $data_load = array(
            "args"        => $args,
            "attr"        => $attr,
            );
        $data_loadjs = json_encode($data_load);
        echo    '<div class="btn-loadmore">
                    <a href="#" class="product-loadmore loadmore elth-bt-default elth-bt-medium" 
                        data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                        data-maxpage="'.esc_attr($max_page).'">
                        '.esc_html__("Load more","autopart").'
                    </a>
                </div>';
    }
    if($pagination == 'pagination') th_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query),true);
	?>
</div>