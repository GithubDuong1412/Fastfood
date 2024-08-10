<?php
namespace Elementor;
extract($settings);
// Get all make terms
$make_terms = get_terms( 'tax_product_make', array(
    'hide_empty' => false,
));
$model_terms = get_terms( 'tax_product_model', array(
    'hide_empty' => false,
));
$year_terms = get_terms( 'tax_product_year', array(
    'hide_empty' => false,
));
$trim_terms = get_terms( 'tax_product_trim', array(
    'hide_empty' => false,
));
?>
<div class="block-element block-search-advance bg-color">
    <form class="search-form-taxonomy <?php echo esc_attr($settings['style'].' live-search-'.$settings['live_search'])?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <?php if(!empty($title)):?>
	        <h3 class="search-title title24 font-bold text-uppercase"><?php echo esc_html($title)?></h3>
	    <?php endif?>
        <div class="group-1-wrap flex-wrap flex-wrap-wrap justify-content-center">
            <div data-tax="make" class="make-select tax-select">
                <div class="select-wrap">
                    <div class="opt-default"><?php echo esc_html__("Make", "autopart") ?></div>
                    <ul class="option-wrap list-none visible-hidden">
                        <li class="active" data-slug=""><?php echo esc_html__("Make", "autopart") ?></li>
                        <?php
                        if (!empty($make_terms) && is_array($make_terms)) {
                            foreach ($make_terms as $key => $value) {
                                echo '<li class="" data-slug="' . esc_attr($value->slug) . '">' . esc_html($value->name) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <input class="hidden" name="tax_product_make" value="" type="text"/>
            </div>
            <div data-tax="model" class="model-select tax-select">
                <div class="select-wrap">
                    <div class="opt-default"><?php echo esc_html__("Model", "autopart") ?></div>
                    <ul class="option-wrap list-none visible-hidden">
                        <li class="default active" data-slug=""><?php echo esc_html__("Model","autopart") ?></li>
                        <?php
                        if(!empty($model_terms) && is_array($model_terms)){
                            foreach ($model_terms as $key => $value){
                                $cf_make_arr = get_term_meta($value->term_id, 'related_make_tax', false);
                                $cf_make_val = "";
                                $cf_make_terms = $cf_make_arr[0];
                                if(is_array($cf_make_terms)){
                                    foreach ($cf_make_terms as $key => $cf_make_term){
                                        if($key == count($cf_make_terms) - 1){
                                            $cf_make_val .= $cf_make_term;
                                        }else{
                                            $cf_make_val .= $cf_make_term.",";
                                        }

                                    }
                                }else{
                                    $cf_make_val = "";
                                }
                                $cf_year_arr = get_term_meta($value->term_id, 'related_year_tax', false);
                                $cf_year_val = "";
                                $cf_year_terms = $cf_year_arr[0];
                                if(is_array($cf_year_terms)){
                                    foreach ($cf_year_terms as $key => $cf_year_term){
                                        if($key == count($cf_year_terms) - 1){
                                            $cf_year_val .= $cf_year_term;
                                        }else{
                                            $cf_year_val .= $cf_year_term.",";
                                        }

                                    }
                                }else{
                                    $cf_year_val = "";
                                }

                                $cf_trim_arr = get_term_meta($value->term_id, 'related_trim_tax', false);
                                $cf_trim_val = "";
                                $cf_trim_terms = $cf_trim_arr[0];
                                if(is_array($cf_trim_terms)){
                                    foreach ($cf_trim_terms as $key => $cf_trim_term){
                                        if($key == count($cf_trim_terms) - 1){
                                            $cf_trim_val .= $cf_trim_term;
                                        }else{
                                            $cf_trim_val .= $cf_trim_term.",";
                                        }

                                    }
                                }else{
                                    $cf_trim_val = "";
                                }
                                echo '<li class="hidden" data-make="'.esc_attr($cf_make_val).'" data-year="'.esc_attr($cf_year_val).'" data-trim="'.esc_attr($cf_trim_val).'" data-slug="'.esc_attr($value->slug).'">'.esc_html($value->name).'</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <input class="hidden" name="tax_product_model" value="" type="text"/>
            </div>
            <div data-tax="year" class="year-select tax-select">
                <div class="select-wrap">
                    <div class="opt-default"><?php echo esc_html__("Year", "autopart") ?></div>
                    <ul class="option-wrap list-none visible-hidden">
                        <li class="default active"  data-slug=""><?php echo esc_html__("Year", "autopart") ?></li>
                        <?php
                        if (!empty($year_terms) && is_array($year_terms)) {
                            foreach ($year_terms as $key => $value) {
                                echo '<li class="hidden" data-slug="' . esc_attr($value->slug) . '">' . esc_html($value->name) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <input class="hidden" name="tax_product_year" value="" type="text"/>
            </div>
            <div data-tax="trim" class="trim-select tax-select">
                <div class="select-wrap">
                    <div class="opt-default"><?php echo esc_html__("Trim", "autopart") ?></div>
                    <ul class="option-wrap list-none visible-hidden">
                        <li class="default active"  data-slug=""><?php echo esc_html__("Trim", "autopart") ?></li>
                        <?php
                        if (!empty($trim_terms) && is_array($trim_terms)) {
                            foreach ($trim_terms as $key => $value) {
                                echo '<li class="hidden" data-slug="' . esc_attr($value->slug) . '">' . esc_html($value->name) . '</option>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <input class="hidden" name="tax_product_trim" value="" type="text"/>
            </div>            
        	<div class="search-input tax-select">
        		<h4><?php esc_html_e("Product name suggestive","autopart") ?></h4>
                <input name="s" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="<?php echo esc_attr($settings['placeholder']);?>" type="text" autocomplete="off">
            </div>
        </div>
        <div class="group-2-wrap flex-wrap flex-wrap-wrap justify-content-space-between">            
            <div class="taxonomy-submit-form">
                <input class="input-submit text-uppercase text-center" type="submit" value="<?php echo esc_html__("Search","autopart") ?>" />
            </div>
        </div>
    </form>
</div>