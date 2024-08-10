<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('Th_HeaderController'))
{
    class Th_HeaderController{

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
                'name'               => esc_html__('Header Page','autopart'),
                'singular_name'      => esc_html__('Header Page','autopart'),
                'menu_name'          => esc_html__('Header Page','autopart'),
                'name_admin_bar'     => esc_html__('Header Page','autopart'),
                'add_new'            => esc_html__('Add New','autopart'),
                'add_new_item'       => esc_html__( 'Add New Header','autopart' ),
                'new_item'           => esc_html__( 'New Header', 'autopart' ),
                'edit_item'          => esc_html__( 'Edit Header', 'autopart' ),
                'view_item'          => esc_html__( 'View Header', 'autopart' ),
                'all_items'          => esc_html__( 'All Header', 'autopart' ),
                'search_items'       => esc_html__( 'Search Header', 'autopart' ),
                'parent_item_colon'  => esc_html__( 'Parent Header:', 'autopart' ),
                'not_found'          => esc_html__( 'No Header found.', 'autopart' ),
                'not_found_in_trash' => esc_html__( 'No Header found in Trash.', 'autopart' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'th_header' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/header-icon.png",
                'supports'           => array( 'title', 'editor', 'revisions' )
            );

            stp_reg_post_type('th_header',$args);
        }
    }

    Th_HeaderController::_init();

}