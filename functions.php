<?php
defined( 'ABSPATH' ) || exit;

function wpbb_insurance_project_mode( $mode ) { return 'woocommerce'; }
add_filter( 'wp_theme_project_mode', 'wpbb_insurance_project_mode' );

function wpbb_insurance_assets() {
    $theme = wp_get_theme();
    $manifest = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    if ( ! is_readable( $manifest ) ) return;
    $data = json_decode( (string) file_get_contents( $manifest ), true );
    if ( ! is_array( $data ) ) return;
    if ( ! empty( $data['src/scss/public.scss']['file'] ) ) {
        wp_enqueue_style( 'wpbb-insurance-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/scss/public.scss']['file'], '/' ), array(), $theme->get( 'Version' ) );
        if ( function_exists( 'wp_theme_sector_customizer_css' ) ) wp_add_inline_style( 'wpbb-insurance-app', wp_theme_sector_customizer_css( '#1D4ED8', '18px', '--sector-primary', '--sector-radius' ) );
    }
    if ( ! empty( $data['src/js/main.js']['file'] ) ) wp_enqueue_script( 'wpbb-insurance-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/js/main.js']['file'], '/' ), array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'wpbb_insurance_assets', 30 );

function wpbb_insurance_dark_mode_bootstrap() { echo '<script>(function(){try{var m=localStorage.getItem("wpThemeMode");if(m==="dark"){document.documentElement.classList.add("is-dark-theme");document.documentElement.setAttribute("data-theme","dark");}}catch(e){}})();</script>'; }
add_action( 'wp_head', 'wpbb_insurance_dark_mode_bootstrap', 1 );


function wpbb_insurance_demo_profile( $profile ) {
    $assets = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/demo/';
    return array_merge( $profile, array(
        'id'=>'insurance', 'name'=>__( 'Insurance & Cover Packages', 'wp-bbtheme-child-insurance' ), 'commerce'=>true,
        'eyebrow'=>__( 'Cover packages, easier to compare', 'wp-bbtheme-child-insurance' ), 'hero_title'=>__( 'Insurance packages that explain the cover before the checkout.', 'wp-bbtheme-child-insurance' ), 'hero_text'=>__( 'Filter cover by vehicle and level, compare benefits, choose monthly or yearly options and use WooCommerce for basket, checkout, orders and account management.', 'wp-bbtheme-child-insurance' ),
        'hero_image'=>$assets . 'hero-photo.jpg', 'about_image'=>$assets . 'about-photo.jpg',
        'primary_label'=>__( 'Find cover', 'wp-bbtheme-child-insurance' ), 'primary_url'=>'#finder',
        'secondary_label'=>__( 'Explore services', 'wp-bbtheme-child-insurance' ), 'secondary_url'=>wp_theme_demo_page_url( 'services' ),
        'services_eyebrow'=>__( 'What we do', 'wp-bbtheme-child-insurance' ), 'services_heading'=>__( 'Cover packages, quotes and account journeys in one familiar WooCommerce flow.', 'wp-bbtheme-child-insurance' ),
        'about_eyebrow'=>__( 'Why choose us', 'wp-bbtheme-child-insurance' ), 'about_title'=>__( 'A package-led insurance site with clearer comparison and checkout.', 'wp-bbtheme-child-insurance' ), 'about_text'=>__( 'The package finder follows the useful patterns of breakdown-cover stores: vehicle type, feature-led cards, configurable purchase options and a complete account journey.', 'wp-bbtheme-child-insurance' ),
        'industries_eyebrow'=>__( 'Built around your needs', 'wp-bbtheme-child-insurance' ), 'industries_heading'=>__( 'Cover for cars, vans, motorbikes and mobility needs.', 'wp-bbtheme-child-insurance' ),
        'process_eyebrow'=>__( 'How it works', 'wp-bbtheme-child-insurance' ), 'process_heading'=>__( 'Filter packages, compare benefits and complete the cover purchase in WooCommerce.', 'wp-bbtheme-child-insurance' ), 'faq_heading'=>__( 'Cover, payment and assistance questions answered before purchase.', 'wp-bbtheme-child-insurance' ),
        'services'=>array(array( __( 'Roadside cover', 'wp-bbtheme-child-insurance' ), __( 'Entry-level assistance with clear recovery limits.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'Home assistance', 'wp-bbtheme-child-insurance' ), __( 'Packages that include help when the vehicle will not start at home.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'UK recovery', 'wp-bbtheme-child-insurance' ), __( 'Nationwide recovery options for longer-distance support.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'European cover', 'wp-bbtheme-child-insurance' ), __( 'Packages for customers who regularly drive abroad.', 'wp-bbtheme-child-insurance' ) )), 'industries'=>array(array( __( 'Cars', 'wp-bbtheme-child-insurance' ), __( 'Cover packages for everyday passenger vehicles.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'Vans', 'wp-bbtheme-child-insurance' ), __( 'Commercial-vehicle options with weight and size considerations.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'Motorbikes', 'wp-bbtheme-child-insurance' ), __( 'Roadside and recovery choices for motorcycles.', 'wp-bbtheme-child-insurance' ) ),
array( __( 'Mobility', 'wp-bbtheme-child-insurance' ), __( 'Accessible vehicle cover with clear assistance features.', 'wp-bbtheme-child-insurance' ) )), 'stats'=>array(array( '8', __( 'Cover packages', 'wp-bbtheme-child-insurance' ) ),
array( '4', __( 'Vehicle groups', 'wp-bbtheme-child-insurance' ) ),
array( '2', __( 'Billing cycles', 'wp-bbtheme-child-insurance' ) ),
array( '1', __( 'Quote + account flow', 'wp-bbtheme-child-insurance' ) )), 'process'=>array(array( '01', __( 'Filter', 'wp-bbtheme-child-insurance' ), __( 'Choose vehicle type, cover level and budget.', 'wp-bbtheme-child-insurance' ) ),
array( '02', __( 'Configure', 'wp-bbtheme-child-insurance' ), __( 'Select monthly/yearly billing and optional assistance.', 'wp-bbtheme-child-insurance' ) ),
array( '03', __( 'Buy', 'wp-bbtheme-child-insurance' ), __( 'Use basket, checkout, order confirmation and My Account.', 'wp-bbtheme-child-insurance' ) )),
        'cta_title'=>__( 'Make the next cover choice easier to compare.', 'wp-bbtheme-child-insurance' ), 'cta_text'=>__( 'Use the package finder and WooCommerce option workflow as a starting point for breakdown, warranty or protection products.', 'wp-bbtheme-child-insurance' ), 'footer_text'=>__( 'Insurance packages with clear comparison, configurable cover and customer account journeys.', 'wp-bbtheme-child-insurance' ),
        'page_labels'=>array('about'=>__( 'About', 'wp-bbtheme-child-insurance' ),'services'=>__( 'Services', 'wp-bbtheme-child-insurance' ),'industries'=>__( 'Solutions', 'wp-bbtheme-child-insurance' ),'contact'=>__( 'Contact', 'wp-bbtheme-child-insurance' ),'blog'=>__( 'Insights', 'wp-bbtheme-child-insurance' )),
        'palette'=>array('theme_brand_color'=>'#1D4ED8','theme_accent_color'=>'#0F8A6A','theme_background_color'=>'#f7f8fb','theme_surface_color'=>'#ffffff','theme_border_color'=>'#dfe4ee','theme_radius'=>'22px')
    ) );
}
add_filter( 'wp_theme_demo_profile', 'wpbb_insurance_demo_profile', 20 );


function wpbb_insurance_pattern_markup( $name ) {
    $path = get_stylesheet_directory() . '/patterns/' . sanitize_file_name( $name ) . '.php';
    if ( ! is_readable( $path ) ) return '';
    ob_start(); include $path; return trim( (string) ob_get_clean() );
}

function wpbb_insurance_extra_home_sections( $content, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'insurance' ) return $content;
    return $content . wpbb_insurance_pattern_markup( 'sector-proof' );
}
add_filter( 'wp_theme_demo_extra_home_sections', 'wpbb_insurance_extra_home_sections', 25, 2 );

function wpbb_insurance_blog_profile( $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'insurance' ) return $profile;
    $profile['blog_eyebrow'] = __( 'Insights', 'wp-bbtheme-child-insurance' );
    $profile['blog_archive_title'] = __( 'Cover guides, motoring advice and policy explainers.', 'wp-bbtheme-child-insurance' );
    $profile['blog_archive_intro'] = __( 'Plain-language content that helps customers understand options before buying.', 'wp-bbtheme-child-insurance' );
    return $profile;
}
add_filter( 'wp_theme_demo_profile', 'wpbb_insurance_blog_profile', 90 );


function wpbb_insurance_woo_profile( $profile ) { return 'store'; } add_filter('wp_theme_woo_support_default_profile','wpbb_insurance_woo_profile');
function wpbb_insurance_demo_products( $products ) { return array(array('simple','Car Roadside','Cars',4.9,'Essential roadside assistance and short-distance recovery.'),
array('simple','Roadside Plus','Cars',7.5,'Roadside help with extended local recovery.'),
array('simple','Home Plus','Cars',12.9,'Roadside and home assistance with nationwide recovery.'),
array('simple','UK Plus','Cars',16.9,'Roadside assistance and nationwide UK recovery.'),
array('simple','Euro Plus','Cars',24.9,'Comprehensive UK and European roadside cover.'),
array('simple','Van Roadside 3.5T','Vans',14.5,'Roadside assistance for eligible light commercial vans.'),
array('simple','Motorbike Plus','Motorbikes',8.9,'Roadside and recovery cover for motorcycles.'),
array('simple','Mobility Plus','Mobility',11.9,'Breakdown assistance designed for mobility vehicles.')); } add_filter('wp_theme_woo_demo_product_data','wpbb_insurance_demo_products');
function wpbb_insurance_demo_product_image( $path,$product,$index ) { $images=array('product-1.jpg','product-2.jpg','product-3.jpg','product-4.jpg','product-5.jpg','product-6.jpg','product-7.jpg','product-8.jpg'); return isset($images[$index])?get_stylesheet_directory().'/assets/img/demo/'.$images[$index]:$path; } add_filter('wp_theme_woo_demo_product_image_path','wpbb_insurance_demo_product_image',10,3);
function wpbb_insurance_woocommerce_support() { add_theme_support('woocommerce');add_theme_support('wc-product-gallery-zoom');add_theme_support('wc-product-gallery-lightbox');add_theme_support('wc-product-gallery-slider'); } add_action('after_setup_theme','wpbb_insurance_woocommerce_support',30);
function wpbb_insurance_woocommerce_legacy_template( $template ) {
 if(is_admin()||!function_exists('WC')||wp_doing_ajax()||is_feed())return $template;$base=trailingslashit(get_stylesheet_directory()).'woocommerce-legacy/';$candidate='';
 if(function_exists('is_cart')&&is_cart())$candidate='cart.php';elseif(function_exists('is_checkout')&&is_checkout())$candidate='checkout.php';elseif(function_exists('is_account_page')&&is_account_page())$candidate='account.php';elseif(function_exists('is_product')&&is_product())$candidate='product.php';elseif((function_exists('is_shop')&&is_shop())||(function_exists('is_product_taxonomy')&&is_product_taxonomy()))$candidate='catalog.php'; if($candidate&&is_readable($base.$candidate))return $base.$candidate;return $template;
} add_filter('template_include','wpbb_insurance_woocommerce_legacy_template',99);
function wpbb_insurance_woo_body_class($classes){if(function_exists('is_woocommerce')&&(is_woocommerce()||is_cart()||is_checkout()||is_account_page()))$classes[]='wp-theme-uses-woo-legacy-shell';return $classes;} add_filter('body_class','wpbb_insurance_woo_body_class');

function wpbb_insurance_after_hero( $content,$profile ){if(($profile['id']??'')!=='insurance')return$content;return $content.'<!-- wp:group {"className":"wp-theme-section-shell insurance-finder-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell insurance-finder-section"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"insurance","limit":12} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';} add_filter('wp_theme_demo_after_hero_sections','wpbb_insurance_after_hero',20,2);
function wpbb_insurance_finder_render($html,$context,$attributes){if('insurance'!==$context)return$html;$vehicle=sanitize_title(wp_unslash($_REQUEST['vehicle_type']??''));$level=sanitize_text_field(wp_unslash($_REQUEST['cover_level']??''));$max=''===(string)($_REQUEST['max_price']??'')?'':(float)$_REQUEST['max_price'];$args=array('post_type'=>'product','post_status'=>'publish','posts_per_page'=>max(1,min(24,absint($attributes['limit']??12))),'orderby'=>'menu_order title','order'=>'ASC');if($vehicle)$args['tax_query']=array(array('taxonomy'=>'product_cat','field'=>'slug','terms'=>$vehicle));if($max!=='')$args['meta_query']=array(array('key'=>'_price','value'=>$max,'compare'=>'<=','type'=>'NUMERIC'));if($level)$args['s']=$level;$query=new WP_Query($args);ob_start();?><section class="wpbb-sector-finder" data-wpbb-sector-finder><div class="wpbb-sector-finder__intro"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(__( 'Cover finder', 'wp-bbtheme-child-insurance' ));?></p><h2><?php echo esc_html(__( 'Find cover for your vehicle and priorities.', 'wp-bbtheme-child-insurance' ));?></h2><p><?php echo esc_html(__( 'Compare packages, then configure billing and assistance options before continuing.', 'wp-bbtheme-child-insurance' ));?></p></div><form class="wpbb-sector-finder__form" method="get" action="<?php echo esc_url(home_url('/'));?>"><label class="wpbb-sector-finder__field"><span><?php echo esc_html(__( 'Vehicle', 'wp-bbtheme-child-insurance' ));?></span><select name="vehicle_type"><option value="">Any vehicle</option><?php foreach(array('cars'=>'Cars','vans'=>'Vans','motorbikes'=>'Motorbikes','mobility'=>'Mobility') as $v=>$label):?><option value="<?php echo esc_attr($v);?>" <?php selected($vehicle,$v);?>><?php echo esc_html($label);?></option><?php endforeach;?></select></label><label class="wpbb-sector-finder__field"><span><?php echo esc_html(__( 'Cover level', 'wp-bbtheme-child-insurance' ));?></span><select name="cover_level"><option value="">Any level</option><?php foreach(array('Roadside','Plus','Home','Euro') as $v):?><option value="<?php echo esc_attr($v);?>" <?php selected($level,$v);?>><?php echo esc_html($v);?></option><?php endforeach;?></select></label><label class="wpbb-sector-finder__field"><span><?php echo esc_html(__( 'Max monthly price', 'wp-bbtheme-child-insurance' ));?></span><input type="number" step="1" min="0" name="max_price" value="<?php echo esc_attr($max);?>"></label><div class="wpbb-sector-finder__actions"><button class="btn btn-primary" type="submit"><?php echo esc_html(__( 'Find cover', 'wp-bbtheme-child-insurance' ));?></button></div></form><div class="wpbb-sector-finder__results"><div class="wpbb-sector-finder__results-head"><strong><?php echo esc_html(sprintf(_n('%d package','%d packages',$query->found_posts,'wp-bbtheme-child-insurance'),$query->found_posts));?></strong><span><?php echo esc_html(__( 'matching your choices', 'wp-bbtheme-child-insurance' ));?></span></div><div class="wpbb-sector-grid"><?php while($query->have_posts()):$query->the_post();$product=function_exists('wc_get_product')?wc_get_product(get_the_ID()):null;?><article class="wpbb-sector-card"><a class="wpbb-sector-card__media" href="<?php the_permalink();?>"><?php echo function_exists('wp_theme_item_gallery_card_inner') ? wp_theme_item_gallery_card_inner(get_the_ID(),'woocommerce_thumbnail',4) : get_the_post_thumbnail(get_the_ID(),'woocommerce_thumbnail');?></a><div class="wpbb-sector-card__body"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(wp_strip_all_tags(wc_get_product_category_list(get_the_ID(),', ')));?></p><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><p><?php echo esc_html(get_the_excerpt());?></p><?php if($product):?><div class="wpbb-sector-card__meta"><span><small><?php echo esc_html(__( 'From', 'wp-bbtheme-child-insurance' ));?></small><strong><?php echo wp_kses_post($product->get_price_html());?></strong></span><span><small><?php echo esc_html(__( 'Purchase', 'wp-bbtheme-child-insurance' ));?></small><strong><?php echo esc_html(__( 'Monthly / yearly', 'wp-bbtheme-child-insurance' ));?></strong></span></div><?php endif;?><a class="wpbb-sector-card__link" href="<?php the_permalink();?>"><?php echo esc_html(__( 'Configure cover →', 'wp-bbtheme-child-insurance' ));?></a></div></article><?php endwhile;wp_reset_postdata();?></div></div></section><?php return ob_get_clean();} add_filter('wp_theme_sector_finder_render','wpbb_insurance_finder_render',20,3);
function wpbb_insurance_product_options(){if(!is_product())return;?><div class="insurance-product-options"><h3><?php echo esc_html(__( 'Configure your cover', 'wp-bbtheme-child-insurance' ));?></h3><p class="form-row"><label><?php echo esc_html(__( 'Vehicle type', 'wp-bbtheme-child-insurance' ));?><select name="insurance_vehicle_type" required><option value="Cars">Cars</option><option value="Vans">Vans</option><option value="Motorbikes">Motorbikes</option><option value="Mobility">Mobility</option></select></label></p><p class="form-row"><label><?php echo esc_html(__( 'Billing cycle', 'wp-bbtheme-child-insurance' ));?><select name="insurance_billing_cycle" required><option value="monthly">Monthly</option><option value="yearly">Yearly — demo 10.5× monthly price</option></select></label></p><p class="form-row"><label><input type="checkbox" name="insurance_home_assistance" value="1"> <?php echo esc_html(__( 'Add home assistance preference', 'wp-bbtheme-child-insurance' ));?></label></p></div><?php } add_action('woocommerce_before_add_to_cart_button','wpbb_insurance_product_options',18);
function wpbb_insurance_validate_options($passed,$product_id,$quantity){$vehicle=sanitize_text_field(wp_unslash($_POST['insurance_vehicle_type']??''));$billing=sanitize_key(wp_unslash($_POST['insurance_billing_cycle']??''));if(!in_array($vehicle,array('Cars','Vans','Motorbikes','Mobility'),true)||!in_array($billing,array('monthly','yearly'),true)){wc_add_notice(__( 'Please choose a valid vehicle type and billing cycle.', 'wp-bbtheme-child-insurance' ),'error');return false;}return$passed;}add_filter('woocommerce_add_to_cart_validation','wpbb_insurance_validate_options',10,3);
function wpbb_insurance_cart_data($data,$product_id,$variation_id){$product=function_exists('wc_get_product')?wc_get_product($variation_id?:$product_id):null;$vehicle=sanitize_text_field(wp_unslash($_POST['insurance_vehicle_type']??'Cars'));$billing=sanitize_key(wp_unslash($_POST['insurance_billing_cycle']??'monthly'));$data['insurance_vehicle_type']=in_array($vehicle,array('Cars','Vans','Motorbikes','Mobility'),true)?$vehicle:'Cars';$data['insurance_billing_cycle']=in_array($billing,array('monthly','yearly'),true)?$billing:'monthly';$data['insurance_home_assistance']=!empty($_POST['insurance_home_assistance'])?'Yes':'No';if($product)$data['insurance_base_price']=(float)$product->get_price();$data['insurance_unique']=wp_generate_uuid4();return$data;}add_filter('woocommerce_add_cart_item_data','wpbb_insurance_cart_data',10,3);
function wpbb_insurance_cart_display($item_data,$cart_item){foreach(array('insurance_vehicle_type'=>__( 'Vehicle', 'wp-bbtheme-child-insurance' ),'insurance_billing_cycle'=>__( 'Billing', 'wp-bbtheme-child-insurance' ),'insurance_home_assistance'=>__( 'Home assistance', 'wp-bbtheme-child-insurance' ))as$key=>$label)if(isset($cart_item[$key]))$item_data[]=array('key'=>$label,'value'=>wc_clean($cart_item[$key]));return$item_data;}add_filter('woocommerce_get_item_data','wpbb_insurance_cart_display',10,2);
function wpbb_insurance_cart_prices($cart){if(is_admin()&&!defined('DOING_AJAX'))return;foreach($cart->get_cart() as $item)if(!empty($item['insurance_base_price'])&&isset($item['insurance_billing_cycle'])){$price=(float)$item['insurance_base_price'];if('yearly'===$item['insurance_billing_cycle'])$price*=10.5;$item['data']->set_price($price);}}add_action('woocommerce_before_calculate_totals','wpbb_insurance_cart_prices',20);
function wpbb_insurance_order_meta($item,$cart_item_key,$values,$order){foreach(array('insurance_vehicle_type'=>__( 'Vehicle', 'wp-bbtheme-child-insurance' ),'insurance_billing_cycle'=>__( 'Billing', 'wp-bbtheme-child-insurance' ),'insurance_home_assistance'=>__( 'Home assistance', 'wp-bbtheme-child-insurance' ))as$key=>$label)if(isset($values[$key]))$item->add_meta_data($label,$values[$key],true);}add_action('woocommerce_checkout_create_order_line_item','wpbb_insurance_order_meta',10,4);
function wpbb_insurance_register_quotes(){register_post_type('insurance_quote',array('labels'=>array('name'=>__( 'Insurance Quotes', 'wp-bbtheme-child-insurance' ),'singular_name'=>__( 'Insurance Quote', 'wp-bbtheme-child-insurance' )),'public'=>false,'show_ui'=>true,'show_in_menu'=>'edit.php?post_type=product','supports'=>array('title')));}add_action('init','wpbb_insurance_register_quotes',14);
function wpbb_insurance_quote_form(){if(!is_product())return;$product_id=get_the_ID();$success=isset($_GET['insurance_quote'])&&'received'===sanitize_key(wp_unslash($_GET['insurance_quote']));?><section class="wpbb-sector-request insurance-quote-request" id="insurance-quote"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(__( 'Prefer a quote first?', 'wp-bbtheme-child-insurance' ));?></p><h2><?php echo esc_html(__( 'Send the vehicle and contact details for a tailored quote.', 'wp-bbtheme-child-insurance' ));?></h2><?php if($success):?><div class="alert alert-success"><?php echo esc_html(__( 'Thanks. Your insurance quote request has been received.', 'wp-bbtheme-child-insurance' ));?></div><?php endif;?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php'));?>"><input type="hidden" name="action" value="wpbb_insurance_quote"><input type="hidden" name="product_id" value="<?php echo esc_attr($product_id);?>"><?php wp_nonce_field('wpbb_insurance_quote_'.$product_id,'wpbb_insurance_quote_nonce');?><label><span><?php echo esc_html(__( 'Name', 'wp-bbtheme-child-insurance' ));?></span><input name="name" required></label><label><span><?php echo esc_html(__( 'Email', 'wp-bbtheme-child-insurance' ));?></span><input type="email" name="email" required></label><label><span><?php echo esc_html(__( 'Phone', 'wp-bbtheme-child-insurance' ));?></span><input type="tel" name="phone"></label><label><span><?php echo esc_html(__( 'Vehicle registration', 'wp-bbtheme-child-insurance' ));?></span><input name="registration"></label><label><span><?php echo esc_html(__( 'Postcode', 'wp-bbtheme-child-insurance' ));?></span><input name="postcode"></label><label><span><?php echo esc_html(__( 'Renewal date', 'wp-bbtheme-child-insurance' ));?></span><input type="date" name="renewal_date"></label><label class="is-wide"><span><?php echo esc_html(__( 'Cover requirements', 'wp-bbtheme-child-insurance' ));?></span><textarea name="message" rows="5"></textarea></label><button class="btn btn-outline-primary" type="submit"><?php echo esc_html(__( 'Request insurance quote', 'wp-bbtheme-child-insurance' ));?></button></form></section><?php }add_action('woocommerce_after_add_to_cart_form','wpbb_insurance_quote_form',20);
function wpbb_insurance_quote_submit(){$product_id=absint($_POST['product_id']??0);if(!$product_id||'product'!==get_post_type($product_id))wp_die(esc_html(__( 'Invalid insurance package.', 'wp-bbtheme-child-insurance' )));if(empty($_POST['wpbb_insurance_quote_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpbb_insurance_quote_nonce'])),'wpbb_insurance_quote_'.$product_id))wp_die(esc_html(__( 'The quote form expired. Please try again.', 'wp-bbtheme-child-insurance' )));$name=sanitize_text_field(wp_unslash($_POST['name']??''));$email=sanitize_email(wp_unslash($_POST['email']??''));if(!$name||!is_email($email))wp_die(esc_html(__( 'Please complete the required quote fields.', 'wp-bbtheme-child-insurance' )));$id=wp_insert_post(array('post_type'=>'insurance_quote','post_status'=>'publish','post_title'=>sprintf('%s — %s',get_the_title($product_id),$name)));if($id&&!is_wp_error($id)){foreach(array('product_id'=>$product_id,'name'=>$name,'email'=>$email,'phone'=>sanitize_text_field(wp_unslash($_POST['phone']??'')),'registration'=>sanitize_text_field(wp_unslash($_POST['registration']??'')),'postcode'=>sanitize_text_field(wp_unslash($_POST['postcode']??'')),'renewal_date'=>sanitize_text_field(wp_unslash($_POST['renewal_date']??'')),'message'=>sanitize_textarea_field(wp_unslash($_POST['message']??'')),'status'=>'new')as$key=>$value)update_post_meta($id,'_insurance_quote_'.$key,$value);}wp_safe_redirect(add_query_arg('insurance_quote','received',get_permalink($product_id)).'#insurance-quote');exit;}add_action('admin_post_wpbb_insurance_quote','wpbb_insurance_quote_submit');add_action('admin_post_nopriv_wpbb_insurance_quote','wpbb_insurance_quote_submit');


/** v3.8.10.7: complete the starter insurance single-product experience. */
function wpbb_insurance_seed_product_content_v107( $page_id = 0, $profile = array() ) {
    if ( ! post_type_exists( 'product' ) ) return;
    $packages = array(
        'Car Roadside' => array('Roadside assistance from the point of breakdown.','Short-distance recovery when the vehicle cannot be repaired.','Driver updates and a clear next-step route.'),
        'Roadside Plus' => array('Roadside assistance with extended local recovery.','Support for common non-start and breakdown situations.','Simple monthly or yearly billing.'),
        'Home Plus' => array('Assistance at home as well as on the road.','Nationwide recovery for eligible vehicles.','Clear options before purchase.'),
        'UK Plus' => array('Nationwide UK roadside assistance.','Recovery when a repair cannot be completed at the roadside.','Optional home-assistance preference and flexible billing.'),
        'Euro Plus' => array('UK and European roadside cover.','Recovery support while travelling across eligible regions.','A single package for frequent UK and European driving.'),
        'Van Roadside 3.5T' => array('Breakdown assistance for eligible light commercial vans.','Recovery support for working vehicles.','Straightforward cover configuration for business use.'),
        'Motorbike Plus' => array('Roadside and recovery support for motorcycles.','Help with common breakdown situations.','Flexible monthly or yearly purchase.'),
        'Mobility Plus' => array('Breakdown assistance designed for eligible mobility vehicles.','Clear recovery support and contact routes.','Simple cover options without unnecessary complexity.'),
    );
    foreach ( $packages as $title => $points ) {
        $post = get_page_by_title( $title, OBJECT, 'product' );
        if ( ! $post ) continue;
        $body = '<h2>What this cover includes</h2><ul><li>' . implode('</li><li>', array_map('esc_html', $points)) . '</li></ul>' .
            '<h2>Before you buy</h2><p>Check vehicle eligibility, the recovery area and any optional assistance choices. The demo product page keeps the key information, price, configuration and quote route together.</p>' .
            '<h2>Need a tailored option?</h2><p>Use the quote form below to send the vehicle and renewal details to the team.</p>';
        if ( '' === trim( wp_strip_all_tags( (string) $post->post_content ) ) ) {
            wp_update_post( array( 'ID'=>$post->ID, 'post_content'=>$body ) );
        }
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_insurance_seed_product_content_v107', 45, 2 );

/** Refresh starter package imagery after every import, including existing products. */
function wpbb_insurance_refresh_product_media_v107( $page_id = 0, $profile = array() ) {
    if ( ! post_type_exists( 'product' ) ) return;
    $titles = array('Car Roadside','Roadside Plus','Home Plus','UK Plus','Euro Plus','Van Roadside 3.5T','Motorbike Plus','Mobility Plus');
    foreach ( $titles as $index => $title ) {
        $post = get_page_by_title( $title, OBJECT, 'product' );
        if ( ! $post ) continue;
        $path = get_stylesheet_directory() . '/assets/img/demo/product-' . ( $index + 1 ) . '.jpg';
        if ( ! is_readable( $path ) || ! function_exists( 'wp_theme_demo_local_attachment' ) ) continue;
        $attachment = wp_theme_demo_local_attachment( $path, $title );
        if ( $attachment ) set_post_thumbnail( $post->ID, $attachment );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_insurance_refresh_product_media_v107', 46, 2 );

/**
 * v3.8.10.20: keep editable Mega Menu content out of public discovery / SEO.
 * The parent already registers these objects as private; child filters make the
 * intent explicit for Core XML sitemaps and common SEO plugins too.
 */
function wpbb_child_private_megamenu_post_type_args( $args, $post_type ) {
    if ( 'megamenu' !== $post_type ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['exclude_from_search'] = true;
    $args['has_archive'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_post_type_args', 'wpbb_child_private_megamenu_post_type_args', 20, 2 );

function wpbb_child_private_megamenu_taxonomy_args( $args, $taxonomy ) {
    if ( 'megamenu-cat' !== $taxonomy ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_taxonomy_args', 'wpbb_child_private_megamenu_taxonomy_args', 20, 2 );

function wpbb_child_core_sitemap_post_types( $post_types ) {
    unset( $post_types['megamenu'] );
    return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'wpbb_child_core_sitemap_post_types', 20 );

function wpbb_child_core_sitemap_taxonomies( $taxonomies ) {
    unset( $taxonomies['megamenu-cat'] );
    return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'wpbb_child_core_sitemap_taxonomies', 20 );

function wpbb_child_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
add_filter( 'wp_robots', 'wpbb_child_mega_robots', 20 );

function wpbb_child_yoast_exclude_megamenu_post_type( $excluded, $post_type ) {
    return 'megamenu' === $post_type ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'wpbb_child_yoast_exclude_megamenu_post_type', 20, 2 );

function wpbb_child_yoast_exclude_megamenu_taxonomy( $excluded, $taxonomy ) {
    return 'megamenu-cat' === $taxonomy ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'wpbb_child_yoast_exclude_megamenu_taxonomy', 20, 2 );

function wpbb_child_yoast_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) return 'noindex, nofollow';
    return $robots;
}
add_filter( 'wpseo_robots', 'wpbb_child_yoast_mega_robots', 20 );


/**
 * v3.8.10.21: global request-a-quote UI is opt-in by child theme.
 * Sector themes with their own quote journeys can keep it; the rest do not
 * expose an unrelated floating "My Quote" control or public route.
 */
if ( ! function_exists( 'wpbb_child_request_quote_enabled' ) ) {
    function wpbb_child_request_quote_enabled() {
        $enabled_themes = array(
            'wp-bbtheme-child-automotive',
            'wp-bbtheme-child-building-services',
            'wp-bbtheme-child-insurance',
            'wp-bbtheme-child-logistics',
            'wp-bbtheme-child-medicine',
            'wp-bbtheme-child-woo-tech-shop',
        );
        $enabled = in_array( get_stylesheet(), $enabled_themes, true );
        return (bool) apply_filters( 'wpbb_child_request_quote_enabled', $enabled, get_stylesheet() );
    }
}

function wpbb_child_request_quote_body_class( $classes ) {
    $classes[] = wpbb_child_request_quote_enabled() ? 'wpbb-request-quote-enabled' : 'wpbb-request-quote-disabled';
    return $classes;
}
add_filter( 'body_class', 'wpbb_child_request_quote_body_class', 30 );

function wpbb_child_request_quote_menu_items( $items ) {
    if ( wpbb_child_request_quote_enabled() ) return $items;
    $target = trim( (string) wp_parse_url( home_url( '/request-a-quote/' ), PHP_URL_PATH ), '/' );
    foreach ( $items as $key => $item ) {
        $path = trim( (string) wp_parse_url( $item->url, PHP_URL_PATH ), '/' );
        if ( $target && $path === $target ) unset( $items[ $key ] );
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'wpbb_child_request_quote_menu_items', 30 );

function wpbb_child_request_quote_disable_route() {
    if ( wpbb_child_request_quote_enabled() ) return;
    $request = isset( $GLOBALS['wp']->request ) ? trim( (string) $GLOBALS['wp']->request, '/' ) : '';
    if ( ! is_page( 'request-a-quote' ) && 'request-a-quote' !== $request ) return;

    global $wp_query;
    if ( $wp_query ) $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
    $template = get_404_template();
    if ( $template ) {
        include $template;
        exit;
    }
    wp_die( esc_html__( 'Page not found.', 'wp-bbtheme-child' ), esc_html__( 'Not found', 'wp-bbtheme-child' ), array( 'response' => 404 ) );
}
add_action( 'template_redirect', 'wpbb_child_request_quote_disable_route', 1 );

function wpbb_child_request_quote_sitemap_args( $args, $post_type ) {
    if ( wpbb_child_request_quote_enabled() || 'page' !== $post_type ) return $args;
    $page = get_page_by_path( 'request-a-quote' );
    if ( $page ) {
        $excluded = isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array();
        $excluded[] = (int) $page->ID;
        $args['post__not_in'] = array_values( array_unique( $excluded ) );
    }
    return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'wpbb_child_request_quote_sitemap_args', 30, 2 );

require_once get_stylesheet_directory() . '/inc/seo-guardrails.php';

/** v3.8.10.24: identify generated legal pages independently of translated slugs. */
function wpbb_child_legal_page_body_class_v381024( $classes ) {
    if ( ! is_page() ) return $classes;
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) return $classes;

    $is_legal = function_exists( 'is_privacy_policy' ) && is_privacy_policy();
    if ( ! $is_legal && false !== strpos( (string) $post->post_content, 'wp-theme-legal-section' ) ) {
        $is_legal = true;
    }
    if ( $is_legal ) $classes[] = 'wpbb-legal-page';
    return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'wpbb_child_legal_page_body_class_v381024', 40 );

/** v3.8.10.25: remove generated empty spacing without touching authored copy. */
if ( ! function_exists( 'wpbb_child_remove_empty_paragraphs_v381025' ) ) {
    function wpbb_child_remove_empty_paragraphs_v381025( $content ) {
        if ( is_admin() || ! is_string( $content ) || '' === $content ) return $content;
        return (string) preg_replace(
            '~<p(?:\\s[^>]*)?>(?:\\s|&nbsp;|&#160;|<br\\s*/?>)*</p>~i',
            '',
            $content
        );
    }
}
add_filter( 'the_content', 'wpbb_child_remove_empty_paragraphs_v381025', 120 );

/** v3.8.10.25: do not output a completely empty CTA block above the footer. */
if ( ! function_exists( 'wpbb_child_remove_empty_cta_v381025' ) ) {
    function wpbb_child_remove_empty_cta_v381025( $block_content, $block ) {
        if ( empty( $block['blockName'] ) || 'wpbb/cta-section' !== $block['blockName'] || ! is_string( $block_content ) ) return $block_content;
        if ( preg_match( '~<(?:img|picture|video|iframe|form|button|a)\\b~i', $block_content ) ) return $block_content;
        $plain = trim( html_entity_decode( wp_strip_all_tags( $block_content ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) ) );
        return '' === $plain ? '' : $block_content;
    }
}
add_filter( 'render_block', 'wpbb_child_remove_empty_cta_v381025', 120, 2 );

