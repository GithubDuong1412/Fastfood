<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('Th_PortfolioController'))
{
    class Th_PortfolioController{

        static function _init()
        {
            if(function_exists('stp_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type()
        {
            $labels = array(
                'name'               => esc_html__('Portfolio','autopart'),
                'singular_name'      => esc_html__('Portfolio','autopart'),
                'menu_name'          => esc_html__('Portfolio','autopart'),
                'name_admin_bar'     => esc_html__('Portfolio','autopart'),
                'add_new'            => esc_html__('Add New','autopart'),
                'add_new_item'       => esc_html__( 'Add New Portfolio','autopart' ),
                'new_item'           => esc_html__( 'New Portfolio', 'autopart' ),
                'edit_item'          => esc_html__( 'Edit Portfolio', 'autopart' ),
                'view_item'          => esc_html__( 'View Portfolio', 'autopart' ),
                'all_items'          => esc_html__( 'All Portfolio', 'autopart' ),
                'search_items'       => esc_html__( 'Search Portfolio', 'autopart' ),
                'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'autopart' ),
                'not_found'          => esc_html__( 'No Portfolio found.', 'autopart' ),
                'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash.', 'autopart' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'portfolio' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
            );

            stp_reg_post_type('portfolio',$args);
            self::th_add_custom_taxonomy();
            self::th_add_custom_meta_box();
        }

        static function th_add_custom_taxonomy (){
            stp_reg_taxonomy(
                'portfolio_category',
                'portfolio',
                array(
                    'label' => esc_html__( 'Portfolio Category', 'autopart' ),
                    'rewrite' => array( 'slug' => 'portfolio_category', 'autopart' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
        }

        static function th_add_custom_meta_box (){
            $my_meta_box = array(
                'id'        => 'portfolio_option',
                'title'     => esc_html__(  'Portfolio Option' , 'autopart' ),
                'desc'      => '',
                'pages'     => array( 'portfolio' ),
                'context'   => 'normal',
                'priority'  => 'high',
                'fields'    => array(                    
                    array(
                        'id'                => 'icon',
                        'label'             => esc_html__('Choose icon', 'autopart'),
                        'desc'              => esc_html__('Choose font awesome icon','autopart'),
                        'type'              => 'text',
                        'class'             => 'sv_iconpicker'
                    ),
                    array(
                        'id'                => 'featured_special',
                        'label'             => esc_html__('Special Featured Image', 'autopart'),
                        'desc'              => esc_html__('Upload Image','autopart'),
                        'type'              => 'upload'
                    )
                )
            );

            if ( function_exists( 'ot_register_meta_box' ) )
                ot_register_meta_box($my_meta_box );
        }
    }

    Th_PortfolioController::_init();

}