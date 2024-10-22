<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
add_filter( 'use_block_editor_for_post', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
if(!function_exists('th_change_required')){
    function th_change_required($condition){
        if(is_string($condition)){            
            $requireds = array();
            $conditions = explode(',', $condition);
            foreach ($conditions as $key => $value) {
                $value = str_replace('(on)', '(1)', $value);
                $value = str_replace('(off)', '(0)', $value);
                $value = str_replace(')', '', $value);
                $value = str_replace('is', '=', $value);
                $value = str_replace('(', ':', $value);
                $requireds[] = explode(':', $value);
            }
            $condition = $requireds;
        }
        return $condition;
    }
}
if(!function_exists('th_fix_type_redux')){
    function th_fix_type_redux($settings){
        switch ($settings['type']) {
            case 'checkbox':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;
            case 'select':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        if(isset($val['label'])) $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;

            case 'on-off':
                $settings['type'] = 'switch';
                if(isset($settings['std'])){
                    if($settings['std'] == 'on') $settings['default'] = true;
                    else $settings['default'] = false;
                    unset($settings['std']);
                }
                break;

            case 'colorpicker-opacity':
                $settings['type'] = 'color_rgba';
                break;

            case 'upload':
                $settings['type'] = 'media';
                break;

            case 'background':
                if(!isset($settings['preview_media'])) $settings['preview_media'] = true;
                break;

            case 'sidebar-select':
                $settings['type'] = 'select';
                $settings['data'] = 'sidebars';
                break;

            case 'post_types':
                $settings['type'] = 'select';
                $settings['data'] = 'post_types';
                break;

            case 'numeric-slider':
                $settings['type'] = 'slider';
                $data = $settings['min_max_step'];
                $data = explode(',', $data);
                $settings['min'] = (int)$data[0];
                $settings['max'] = (int)$data[1];
                $settings['step'] = (int)$data[2];
                unset($settings['min_max_step']);
                break;

            case 'list-item':
                $settings['type'] = 'repeater';
                $data = $settings['settings'];

                foreach ($data as $item_key => $item_field) {
                    $data[$item_key] = th_fix_type_redux($item_field);
                }
                $title_df = array(array(
                    'id'       => 'title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Title', 'autopart' ),
                ));
                $settings['fields'] = array_merge($title_df,$data);
                unset($settings['settings']);
                break;
            
            default:
                
                break;
        }
        // change title
        if(isset($settings['label'])){
            $settings['title'] = $settings['label'];
            unset($settings['label']);
        } 
        // change default
        if(isset($settings['std'])){
            $settings['default'] = $settings['std'];
            unset($settings['std']);
        }

        // change require
        if(isset($settings['condition'])){
            $settings['required'] = th_change_required($settings['condition']);
            unset($settings['condition']);
        }
        if(!isset($settings['default'])) $settings['default'] = '';
        return $settings;
    }
}

if(class_exists('Redux')){
    $th_option_name = th_get_option_name();
    $uri = '';
    if(isset($_GET['action'])) $uri = $_GET['action'];
    if( $uri !== 'elementor' ) add_filter("redux/metaboxes/".$th_option_name."/boxes", "th_custom_meta_boxes",$th_option_name);
}
if(!function_exists('th_register_metabox')){
    function th_register_metabox($settings){
        foreach ($settings as $key => $setting) {
            if(is_array($setting['fields'])){
                $new_options = [];
                foreach ($setting['fields'] as $keyf => $field) {                    
                    $stemp = th_fix_type_redux($field);
                    if($field['type'] == 'tab'){
                        $tab_id = $field['id'];
                        $new_options[$tab_id] = array_merge($new_options,$stemp);
                        if(!isset($new_options[$tab_id]['icon'])) $new_options[$tab_id]['icon'] = '';
                    }
                    else{
                        if(!isset($tab_id)) $tab_id = 0;
                        $new_options[$tab_id]['fields'][] = $stemp;
                    }
                }
            }
            if(isset($new_options['title'])) $new_options['icon'] = '';
            unset($new_options['type']);
            $new_options2 = array();
            foreach ($new_options as $key2 => $value) {
                $new_options2[] = $new_options[$key2];
            }
            $settings[$key]['post_types'] = $settings[$key]['pages'];
            $settings[$key]['position'] = $settings[$key]['context'];
            $settings[$key]['sections'] = $new_options2;
            unset($settings[$key]['fields']);
            unset($settings[$key]['pages']);
            unset($settings[$key]['context']);
        }
        return $settings;
    }
}
if(!function_exists('th_custom_meta_boxes')){
    function th_custom_meta_boxes(){
        //Format content
        $format_metabox = array(
            'id'        => 'block_format_content',
            'title'     => esc_html__('Format Settings', 'autopart'),
            'desc'      => '',
            'pages'     => array('post'),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(                
                array(
                    'id'        => 'format_image',
                    'label'     => esc_html__('Upload Image', 'autopart'),
                    'type'      => 'upload',
                    'desc'      => esc_html__('Choose image from media.','autopart'),
                ),
                array(
                    'id'        => 'format_gallery',
                    'label'     => esc_html__('Add Gallery', 'autopart'),
                    'type'      => 'Gallery',
                    'desc'      => esc_html__('Choose images from media.','autopart'),
                ),
                array(
                    'id'        => 'format_media',
                    'label'     => esc_html__('Link Media', 'autopart'),
                    'type'      => 'text',
                    'desc'      => esc_html__('Enter media url(Youtube, Vimeo, SoundCloud ...).','autopart'),
                ),
            ),
        );
        // SideBar
        $page_settings = array(
            'id'        => 'th_sidebar_option',
            'title'     => esc_html__('Page Settings','autopart'),
            'pages'     => array( 'page','post','product'),
            'context'   => 'normal',
            'priority'  => 'low',
            'fields'    => array(
                // General tab
                array(
                    'id'        => 'page_general',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','autopart')
                ),
                array(
                    'id'        => 'th_header_page',
                    'label'     => esc_html__('Choose page header','autopart'),
                    'type'      => 'select',
                    'default'   => '',
                    'choices'   => th_list_post_type('th_header',false,true),
                    'desc'      => esc_html__('Include Header content. Go to Header page in admin menu to edit/create header content. Default is value of Theme Option.','autopart'),
                ),
                array(
                    'id'         => 'th_footer_page',
                    'label'      => esc_html__('Choose page footer','autopart'),
                    'type'       => 'select',
                    'default'   => '',
                    'choices'    => th_list_post_type('th_footer',false,true),
                    'desc'       => esc_html__('Include Footer content. Go to Footer page in admin menu to edit/create footer content. Default is value of Theme Option.','autopart'),
                ),
                array(
                    'id'         => 'th_sidebar_position',
                    'label'      => esc_html__('Sidebar position ','autopart'),
                    'type'       => 'select',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','autopart'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('No Sidebar','autopart'),
                            'value' => 'no'
                        ),
                        array(
                            'label' => esc_html__('Left sidebar','autopart'),
                            'value' => 'left'
                        ),
                        array(
                            'label' => esc_html__('Right sidebar','autopart'),
                            'value' => 'right'
                        ),
                    ),
                    'desc'      => esc_html__('Choose sidebar position for current page/post(Left,Right or No Sidebar).','autopart'),
                ),
                array(
                    'id'        => 'th_select_sidebar',
                    'label'     => esc_html__('Selects sidebar','autopart'),
                    'type'      => 'sidebar-select',
                    'condition' => 'th_sidebar_position:not(no),th_sidebar_position:not()',
                    'desc'      => esc_html__('Choose a sidebar to display.','autopart'),
                ), 
                array(
                    'id'          => 'single_sidebar_style',
                    'type'        => 'select',
                    'title'       => esc_html__('Sidebar style','autopart'),
                    'desc'        =>esc_html__('Choose a style to active display','autopart'),
                    'condition'   => 'th_sidebar_position:not(no),th_sidebar_position:not()',
                    'options'     => array(
                        ''  => esc_html__('Default','autopart'),
                        'sidebar-toggle'  => esc_html__('Hidden toggle button','autopart'),
                    ),
                    'default'     => '',
                ),
                array(
                    'id'          => 'before_append',
                    'label'       => esc_html__('Append content before','autopart'),
                    'type'        => 'select',                    
                    'default'   => '',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','autopart'),
                ),
                array(
                    'id'          => 'after_append',
                    'label'       => esc_html__('Append content after','autopart'),
                    'type'        => 'select',
                    'default'   => '',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','autopart'),
                ),
                array(
                    'id'          => 'show_title_page',
                    'label'       => esc_html__('Show title', 'autopart'),
                    'type'        => 'on-off',
                    'std'         => 'on',
                    'desc'        => esc_html__('Show/hide title of page.','autopart'),
                ),
                array(
                    'id' => 'post_single_page_share',
                    'label' => esc_html__('Show Share Box', 'autopart'),
                    'type' => 'select',
                    'std'   => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Theme Option--','autopart'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','autopart'),
                            'value'=>'1'
                        ),
                        array(
                            'label'=>esc_html__('Off','autopart'),
                            'value'=>'0'
                        ),
                    ),
                    'desc'        => esc_html__( 'You can show/hide share box independent on this page. ', 'autopart' ),
                ),
                // End general tab
                // Custom color
                array(
                    'id'        => 'page_color',
                    'type'      => 'tab',
                    'label'     => esc_html__('Custom color','autopart')
                ),
                array(
                    'id'          => 'body_bg',
                    'label'       => esc_html__('Body Background','autopart'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change body background of page.', 'autopart' ),
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','autopart'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color of this page.', 'autopart' ),
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','autopart'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color 2 of this page.', 'autopart' ),
                ),
                // End Custom color
                // Display & Style tab
                array(
                    'id'        => 'page_layout',
                    'type'      => 'tab',
                    'label'     => esc_html__('Display & Style','autopart')
                ),
                array(
                    'id'          => 'th_page_style',
                    'label'       => esc_html__('Page Style','autopart'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','autopart'),
                            'value' =>  'page-content-df',
                        ),
                        array(
                            'label' =>  esc_html__('Page boxed','autopart'),
                            'value' =>  'page-content-box'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for page.', 'autopart' ),
                ),
                array(
                    'id'          => 'container_width',
                    'label'       => esc_html__('Custom container width(px)','autopart'),
                    'type'        => 'text',
                    'desc'        => esc_html__( 'You can custom width of page container. Default is 1200px.', 'autopart' ),
                ),                
                
                // End Display & Style tab               
            )
        );
        
        $product_settings = array(
            'id' => 'block_product_settings',
            'title' => esc_html__('Product Settings', 'autopart'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(    
                // Begin Product Settings
                array(
                    'id'        => 'block_product_custom_tab',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','autopart')
                ),             
                array(
                    'id'          => 'before_append_tab',
                    'label'       => esc_html__('Append content before product tab','autopart'),
                    'type'        => 'select',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','autopart'),
                ),
                array(
                    'id'          => 'after_append_tab',
                    'label'       => esc_html__('Append content after product tab','autopart'),
                    'type'        => 'select',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','autopart'),
                ),                
                array(
                    'id'          => 'product_single_style',
                    'type'        => 'select',
                    'title'       => esc_html__('Product style','autopart'),
                    'desc'        => esc_html__('Choose style display for product single','autopart'),
                    'default'         => '',
                    'options'     => array(
                        ''              => esc_html__('Default','autopart'),
                        'style1'        => esc_html__('Style 1','autopart'),
                        'style2'        => esc_html__('Style 2','autopart'),
                        'style3'        => esc_html__('Style 3','autopart'),
                        'style4'        => esc_html__('Style 4','autopart'),
                        'style5'        => esc_html__('Style 5','autopart'),
                        'style6'        => esc_html__('Style 6','autopart'),
                        'default-woo'   => esc_html__('Default WooCommerce','autopart'),
                    ),
                ),
                array(
                    'id'        => 'product_slider',
                    'label'     => esc_html__('Add Slider Gallery', 'autopart'),
                    'type'      => 'gallery',
                    'desc'      => esc_html__('Choose images from media.','autopart'),
                    'condition' => 'product_single_style:is(style4)',
                ),
                array(
                    'id'          => 'add_to_cart_sticky',
                    'type'        => 'select',
                    'title'       => esc_html__('Add to cart sticky bottom','autopart'),
                    'default'         => '',
                    'options'     => array(
                        ''    => esc_html__('Default','autopart'),
                        'show'  => esc_html__('Show','autopart'),
                        'hide' => esc_html__('Hide','autopart'),
                    ),
                ),
                array(
                    'id'          => 'product_tab_detail',
                    'label'       => esc_html__('Product Tab Style','autopart'),
                    'type'        => 'select',
                    'choices'     => array(                                                    
                        array(
                            'value'=> 'tab-normal',
                            'label'=> esc_html__("Normal", 'autopart'),
                        ),
                        array(
                            'value'=> 'tab-style2',
                            'label'=> esc_html__("Tab style 2", 'autopart'),
                        ),
                    )
                ),
                array(
                    'id'          => 'th_product_tab_data',
                    'label'       => esc_html__('Add Custom Tab','autopart'),
                    'type'        => 'list-item',
                    'settings'    => array(
                        array(
                            'id'    => 'tab_content',
                            'label' => esc_html__('Content', 'autopart'),
                            'type'  => 'textarea',
                            'std'   => '',
                        ),
                        array(
                            'id'            => 'priority',
                            'label'         => esc_html__('Priority (Default 40)', 'autopart'),
                            'type'          => 'numeric-slider',
                            'min_max_step'  => '1,50,1',
                            'std'           => '40',
                            'desc'          => esc_html__('Choose priority value to re-order custom tab position.','autopart'),
                        ),
                    )
                ),
            ),
        );
        $product_type = array(
            'id' => 'product_trendding',
            'title' => esc_html__('Product Type', 'autopart'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trending', 'autopart'),
                    'type'        => 'on-off',
                    'std'         => 'off',
                    'desc'        => esc_html__( 'Set trending for current product.', 'autopart' ),
                ),
                array(
                    'id'    => 'product_thumb_hover',
                    'label' => esc_html__('Product hover image', 'autopart'),
                    'type'  => 'upload',
                    'desc'        => esc_html__( 'Product thumbnail 2. Some hover animation of thumbnail show back image. Default return main product thumbnail.', 'autopart' ),
                ),
            ),
        );        
        if(class_exists('Redux')){
            $metaboxes = th_register_metabox([$format_metabox,$page_settings,$product_settings,$product_type]);
            return $metaboxes;
        }
    }
}
?>