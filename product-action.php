<?php
/*
 * Template Name: Product action
 *
 *
 * */

get_header();

    if(!function_exists('s7upf_update_product')){
        function s7upf_update_product($update = 'thumbnail',$value = [],$post_type = 'product',$cats = '') {  
            if (is_array($value) && count($value) == 2) {
                $new_value = [];
                for ($i=$value[0]; $i <=$value[1] ; $i++) { 
                    $new_value[] = $i;
                }
                $value = $new_value;
            }
            if(isset($_GET['update_product'])){
                $args = array(
                    'post_type'         => $post_type,
                    'posts_per_page'    => -1,
                    );
                if(!empty($cats)) {
                    $custom_list = explode(",",$cats);
                    $args['tax_query'][]=array(
                        'taxonomy'=>'product_cat',
                        'field'=>'slug',
                        'terms'=> $custom_list
                    );
                }
                $product_query = new WP_Query($args);
                $count = 0;
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        switch ($update) {
                            case 'thumb_hover':
                                if(is_array($value)){
                                    $count++;
                                    update_post_meta( get_the_ID(), 'product_thumb_hover', wp_get_attachment_image_url($value[$count],'full'));
                                    if($count == count($value)) $count = -1;
                                }
                                else update_post_meta( get_the_ID(), 'product_thumb_hover',  wp_get_attachment_image_url($value,'full'));
                                break;

                            case 'feature':
                                $check = rand(1,3);
                                if($check % 2 == 0) update_post_meta( get_the_ID(), '_featured', 1);
                                break;

                            case 'cats':
                                wp_set_object_terms( get_the_ID() , $value , 'product_cat' );
                                break;

                            case 'tags':
                                if(is_array($value)){
                                    $tags_key = array_rand($value,3);
                                    $tags = array_intersect_key($value,array_flip($tags_key));
                                }
                                else $tags = $value;
                                // wp_set_object_terms( get_the_ID() , $tags , 'product_tag' );
                                if($post_type == 'post'){
                                    wp_set_object_terms( get_the_ID() , $tags , 'category' );
                                    wp_set_post_tags( get_the_ID() , $tags );
                                }
                                else wp_set_object_terms( get_the_ID() , $tags , 'product_tag' );
                                break;

                            case 'excerpt':
                                $my_post = array(
                                    'ID'                => get_the_ID(),
                                    'post_excerpt'      => $value,
                                );
                                wp_update_post( $my_post );
                                break;

                            case 'content':
                                $my_post = array(
                                    'ID'                => get_the_ID(),
                                    'post_content'      => $value,
                                );
                                wp_update_post( $my_post );
                                break;

                            case 'title':
                                
                                break;

                            case 'date':
                                $postdate = $value;/*For example*/

                                $update_post = array(
                                    'ID' => get_the_ID(),
                                    'post_date' => $postdate
                                );

                                wp_update_post( $update_post );
                                break;

                            case 'gallery':
                                $gallery = array_rand($value,3);
                                $gallery = array_intersect_key($value,array_flip($gallery));
                                $gallery = implode(',', $gallery);
                                update_post_meta( get_the_ID(), '_product_image_gallery', $gallery);
                                break;

                            case 'thumbnail':
                                if(is_array($value)){
                                    update_post_meta( get_the_ID(), '_thumbnail_id', $value[$count]);
                                    $count++;
                                    if($count == count($value)) $count = 0;
                                }
                                else update_post_meta( get_the_ID(), '_thumbnail_id', $value);
                                break;

                            default:
                                
                                break;
                        }
                    }
                }
                wp_reset_postdata();
            }
        }
    }

    if(!function_exists('s7upf_create_products')){
        function s7upf_create_products($name = array(),$number = 10,$post_type = 'product',$content = '',$excerpt = '') {
            if(isset($_GET['add_product'])){            
                $index = $key_index = 0;
                $products = array();
                if(is_array($name) && !empty($name)){
                    $key_array = array();
                    for ($i=0; $i < $number; $i++) {
                        foreach ($name as $key => $value) {
                            if(isset($value[$key_index])) $products[] = $value[$key_index];
                        }
                        $key_index++;
                        if($key_index == 5) $key_index = 0;
                    }
                    foreach ($name as $key => $value) {
                        $key_array[] = $key;
                    }
                    foreach ($products as $key => $value) {
                        $post = array(
                            'post_content'  => $content,
                            'post_excerpt'  => $excerpt,
                            'post_status'   => "publish",
                            'post_title'    => $value,
                            'post_type'     => $post_type,
                        );
                        $post_id = wp_insert_post( $post );
                        if($post_type == 'product'){
                            $price = rand(50,500);
                            $price_sale = '';
                            $sku = 'No-'.rand(1000,9999).'-'.rand(1,99);
                            if($price % 2 == 0){
                                $price_sale = $price - rand(5,$price-30) % 100;
                            }
                            update_post_meta( $post_id, '_regular_price', $price );
                            update_post_meta( $post_id, '_sale_price', $price_sale );
                            update_post_meta( $post_id, '_sku', $sku);
                            wp_set_object_terms( $post_id, $key_array[$index], 'product_cat' );
                        }
                        $index++;
                        if($index == count($key_array)) $index = 0;
                    }
                }
                else{
                    for ($i=0; $i < $number; $i++) {
                        $post = array(
                            'post_content'  => $content,
                            'post_excerpt'  => $excerpt,
                            'post_status'   => "publish",
                            'post_title'    => $name,
                            'post_type'     => $post_type,
                        );
                        $post_id = wp_insert_post( $post );
                        if($post_type == 'product'){
                            $price = rand(50,500);
                            $price_sale = '';
                            $sku = 'No-'.rand(1000,9999).'-'.rand(1,99);
                            if($price % 2 == 0){
                                $price_sale = $price - rand(5,$price-30) % 100;
                            }
                            update_post_meta( $post_id, '_regular_price', $price );
                            update_post_meta( $post_id, '_sale_price', $price_sale );
                            update_post_meta( $post_id, '_sku', $sku);
                            wp_set_object_terms( $post_id, $key_array[$index], 'product_cat' );
                        }
                    }
                }
            }
        }
    }
    // $ids = array(2114,2115,2116,2117,2118,2119,2120,2121,2122,2123,2124,2125,2126,2127,2128,2129,2130,2131,2132,2133);
    $ids_cat = array(6069,6098);
    $content = 'Donec pede justo, fringilla vel, aliquet nec, vulpu tate eget. Sed quia consequuntur magni dolores. Id eges tas massa sem et elit. Donec pede justo, fringilla vel, aliquet nec, vulpu tate eget. Sed quia consequuntur magni dolores. Id eges tas massa sem et elit.

Qenean commodo ligula eget dolor. Aenean massa. Cumt sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla onsequat mas quis enim. Donec pede justo, fringilla vel, aliquet nec, vulpu tate eget. Sed quia consequuntur magni dolores. Id eges tas massa sem et elit. Viva mus semper cursus libero';
    $excerpt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt condimentum felis, et tempor neque rhoncus ac. Proin elementum, felis id placerat dapibus, purus ipsum lobortis tellus, ut vehicula nisl metus eget arcu.';
    $tags = array("Burger","Takeaway","Combo Meal","Pizza","Quick Service","Salads","Taco","Sandwich","Breakfast Menu","Specials", "Nuggets");
    // $ids_cat = array(5038,5050);
    // s7upf_update_product('thumbnail',$ids_cat,'product','skiwear');
    // s7upf_update_product('gallery',$ids_cat,'product','skiwear');

    // $ids_cat = array(5051,5062);
    // s7upf_update_product('thumbnail',$ids_cat,'product','boxing');
    // s7upf_update_product('gallery',$ids_cat,'product','boxing');

    // $ids_cat = array(6069,6098);
    // s7upf_update_product('thumbnail',$ids_cat,'product','badminton');
    // s7upf_update_product('gallery',$ids_cat,'product','badminton');

    // $ids_cat = array(5063,5070);
    // s7upf_update_product('thumbnail',$ids_cat,'product','golf');
    // s7upf_update_product('gallery',$ids_cat,'product','golf');

    // $ids_cat = array(5082,5081,5080,5079,5050,5049,5048,5047,5046,5062,5061,5060,5059);
    // s7upf_update_product('thumbnail',$ids_cat,'product','volleyball,baseball,gym,hockey,soccer');
    // s7upf_update_product('gallery',$ids_cat,'product','volleyball,baseball,gym,hockey,soccer');


    // s7upf_update_product('thumb_hover',$ids,'product','foods');

    // $ids_sweat = array(603,604,605,606,607,608);
    // s7upf_update_product('thumbnail',$ids,'product','sweat-cloth');
    // s7upf_update_product('gallery',$ids,'product','sweat-cloth');
    // s7upf_update_product('thumb_hover',$ids,'product','sweat-cloth');

    // $ids_furniture = array(609,610,611,612,613,614,615,616);
    // s7upf_update_product('thumbnail',$ids,'product','furniture');
    // s7upf_update_product('gallery',$ids,'product','furniture');
    // s7upf_update_product('thumb_hover',$ids,'product','furniture');

    // $ids_electronics = array(617,618,619,620,621,622,623);
    // s7upf_update_product('thumbnail',$ids,'product','electronics');
    // s7upf_update_product('gallery',$ids,'product','electronics');
    // s7upf_update_product('thumb_hover',$ids,'product','electronics');

    // $ids_fashions = array(624,625,626,627,628,629,630,631);
    // s7upf_update_product('thumbnail',$ids,'product','fashions');
    // s7upf_update_product('gallery',$ids,'product','fashions');
    // s7upf_update_product('thumb_hover',$ids,'product','fashions');

    // $ids_flowers = array(632,633,634,635,636,637,638,639);


    //Update thumb
    $ids = array(10838,10867);
    s7upf_update_product('thumbnail',$ids);
    s7upf_update_product('gallery',$ids);
    s7upf_update_product('thumb_hover',$ids);

    // s7upf_update_product('excerpt',$excerpt);
    // s7upf_update_product('content',$content);
    s7upf_update_product('tags',$tags);
    s7upf_update_product('tags',$tags,'post');
    // $gallery = '2568,2569,2570';
    // update_post_meta( 2506, '_product_image_gallery', $gallery);
    $name = array(
        "foods"  => array(
            "Noodles",
            "Pancakes",
            "Pizza",
            "Sprinkles Bakery",
            "Cupcake Couture",
            "Cookie Packaging ",
            // "Bakery Macaron",
            // "Moon cake",
            ),
        // "sweat-cloth"   => array(
        //     "Cooling towel",
        //     "Women Headband",
        //     "Sunland Soft Breathable",
        //     "Soft Cloth Towel",
        //     "Large Cooling Towel",
        //     "Cooling Fitness Towel",
        //     ),
        "furniture"  => array(
            "Engage Task Stool",
            "Light Classic",
            "CrossRoads Shelving",
            "Lipzor Light",
            "CrossRoads Shelving",
            "Berlage Guest Chair",
            // "Affina Glider",
            // "Barron Table",
            ),
        "drinks"  => array(
            "Coffee & milk",
            "Coffee black",
            "Apple juice",
            "Watermelon juice",
            "Lemon Leo",
            "Cappuccino",
            // "Green Tea",
            // "Lemon Tea",
            ),
        "electronics"  => array(
            "Tablet Samsung",
            "iPad 4 16Gb",
            "Galaxy S VII",
            "Iphone 6",
            "Sony Z5 premium",
            "Iphone 6 plus",
            // "Ipad Air",
            // "Acer A510",
            ),
        "fashions"  => array(
            "Women's Woolen",
            "Fashion Mangto",
            "Bag Goodscol",
            "Men's Woolen",
            "Women's Dress",
            "Polo shirt ",
            // "T-Shirt Sport",
            // "Happy short",
            ),
        // "kid-toys"  => array(
        //     "Car remote control",
        //     "Excavator",
        //     "Big crane",
        //     "Teddy bear",
        //     "Toytolo palinting",
        //     "Dinosaur eggs",
        //     "Planes model",
        //     "Jigsaw Puzzle",
        //     ),
        // "homeware" => array(
        //     "Hedgehogs",
        //     "Chair Classicle",
        //     "Lipzor Light",
        //     "Light cup",
        //     "Lipzor Light",
        //     "Pok Chair Classicle",
        //     ),
        // "flowers"  => array(
        //     "Amazon lily",
        //     "Baby's breath",
        //     "Balloon flower",
        //     "Barberton daisy",
        //     "Bird of paradise",
        //     "Golden rod",
        //     "Grape hyacinth",
        //     "Sunflower",
        //     ),
        // "beauty-health"  => array(
        //     "Sculpt & Highlight",
        //     "Ombre Blush",
        //     "Cream Highlight",
        //     "Cheek Contour Duo",
        //     "Wonder Stick",
        //     "Ombre Lip Duo",
        //     "BB Cream Body",
        //     "Lipice sheer color",
        //     ),
        // "sport"  => array(
        //     "Happy short",
        //     "T-Shirt Sport",
        //     "Lacoste Sport",
        //     "Smart Gloves",
        //     "Tennis ball",
        //     "Shose sport",
        //     ),
        // "jewelry"   => array(
        //     "Ring Lounge",
        //     "Leather Bracelet",
        //     "Heart Nick",
        //     "Elegant Silver Bar",
        //     "Personal Necklace",
        //     "Heart Nick Necklace",
        //     ),
        );
    $number = 6; //number product each category
    // s7upf_create_products($name,$number);
    $content_post = 'Cauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Praesent nonummy mi in odio. Etiam imperdiet imperdiet orci. Sed cursus turpis vitae tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla neque dolor, sagittis eget. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
<blockquote class="single-quote">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. which is the same as saying through shrinking from toil and pain</blockquote>
On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, They cannot foresee the pain and trouble that are bound to ensue and equal blame belongs.';    
    $name_post = "Cool mother’s day gifts for 2019";
    $excerpt_post = 'Cauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Praesent nonummy mi in odio. Etiam imperdiet imperdiet orci. Sed cursus turpis vitae tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus';
    // s7upf_create_products($name_post,$number,'post',$content_post,$excerpt_post);
    // $ids = array(2779,2780,2781,2782,2783,2784,2785,2786,2787,2788);
    // $ids = array(6099,6110);
    // s7upf_update_product('thumbnail',$ids,'post','');
    // s7upf_update_product('content',$content_post,'post','');
    // s7upf_update_product('excerpt',$excerpt_post,'post','');
    // s7upf_update_product('date','2023-02-23 18:57:33','post','');
get_footer();