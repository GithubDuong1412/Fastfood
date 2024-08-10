<?php
/**
 * Created by PhpStorm.
 * User: dell3537
 * Date: 9/20/2019
 * Time: 8:30 AM
 */

if(!class_exists('Th_TaxonomyController'))
{
    class Th_TaxonomyController{

        static function _init()
        {
            if(function_exists('stp_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_taxonomy'));
            }
        }

        static  function  _add_taxonomy (){
            stp_reg_taxonomy(
                'tax_product_make',
                'product',
                array(
                    'label' => esc_html__( 'Product Make', 'autopart' ),
                    'rewrite' => array( 'slug' => 'product_make', 'autopart' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
            stp_reg_taxonomy(
                'tax_product_model',
                'product',
                array(
                    'label' => esc_html__( 'Product Model', 'autopart' ),
                    'rewrite' => array( 'slug' => 'product_model', 'autopart' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
            stp_reg_taxonomy(
                'tax_product_year',
                'product',
                array(
                    'label' => esc_html__( 'Product Year', 'autopart' ),
                    'rewrite' => array( 'slug' => 'product_year', 'autopart' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
            stp_reg_taxonomy(
                'tax_product_trim',
                'product',
                array(
                    'label' => esc_html__( 'Product Trim', 'autopart' ),
                    'rewrite' => array( 'slug' => 'product_trim', 'autopart' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
        }
    }

    Th_TaxonomyController::_init();
}


