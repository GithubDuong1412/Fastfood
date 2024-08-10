<?php
namespace Elementor;
use Th_Template;
extract($settings);
?>
<div class="th-cat-wrap th-cat-wrap">
<?php echo '<div '.$wdata->get_render_attribute_string( 'elth-wrapper' ).'>';?>
        <?php 
        $content_html = '';
        foreach (  $list_cats as $key => $item ) {
            $target = $item['link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
            $link = $item['link']['url'];
            $title_cat = $item['title'];
            $taxonomy = 'product_cat';
            $term = get_term_by( 'slug',$item['cat'], $taxonomy );
            if(is_object($term) && !empty($term)){
                if(!$title_cat) $title_cat = $term->name;
                if(!$link) $link = get_term_link( $term->term_id, $taxonomy );
            }
            $symbol = '';
            if($item['symbol'] == 'icon' && $item['icon']){
                ob_start();
                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                $symbol = '<span class="symbol">'.ob_get_clean().'</span>';
            }
            if($item['symbol'] == 'image' && $item['image']){
                $symbol = '<span class="symbol">'.Group_Control_Image_Size::get_attachment_image_html( $settings['list_cats'][$key], 'thumbnail', 'image' ).'</span>';
            }
            $hover_html = '';
            $icon_right = '';
            if($item['megapage']){
                $hover_html = '<div class="cat-hover-content">'.Th_Template::get_vc_pagecontent($item['megapage']).'</div>';
                $icon_right = '<i class="la la-angle-right"></i>';
            }
            $badge_html = '';
            if($item['badge']){
                $badge_html = '<small class="menu-badge">'.$item['badge'].'</small>';
            }
            $content_html .=    '<li class="item-cat elementor-repeater-item-'.$item['_id'].'">
                                    <a href="'.$link.'"'.$target.$nofollow.'>
                                        '.$symbol.'
                                        <span class="text">'.$title_cat.'</span>
                                        '.$icon_right.'
                                        '.$badge_html.'
                                    </a>
                                    '.$hover_html.'
                                </li>';
        }
        ?>
        <div class="vertical-navigation-header">
            <?php 
            if(!$title) $title = esc_html__("Shop by Department","autopart");
            echo '<span>'.$title.'</span>';
            ?>
            <i class="indicator-icon"></i>
        </div>
        <div class="vertical-navigation-content">
            <?php echo '<ul class="cat-list list-none th-scrollbar1">'.$content_html.'</ul>';?>
        </div>
    </div>
</div>