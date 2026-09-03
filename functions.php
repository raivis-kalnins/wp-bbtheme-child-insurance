<?php
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/inc/frontend-password-protection.php';

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



/** v3.8.10.29: make demo switching/imports self-healing across child themes. */
if ( ! function_exists( 'wpbb_child_demo_refresh_on_activation_v381029' ) ) {
    function wpbb_child_demo_refresh_on_activation_v381029() {
        // The parent importer stores one global version/profile. When a different
        // child theme is activated, invalidate that marker so its own profile is
        // imported instead of reusing the previous child's demo state.
        delete_option( 'wp_theme_demo_import_version' );
        delete_option( 'wp_theme_demo_menu_profile' );
    }
    add_action( 'after_switch_theme', 'wpbb_child_demo_refresh_on_activation_v381029', 5 );
}

if ( ! function_exists( 'wpbb_child_demo_integrity_guard_v381029' ) ) {
    function wpbb_child_demo_integrity_guard_v381029( $page_id = 0, $profile = array() ) {
        $page_id = absint( $page_id ?: get_option( 'page_on_front' ) );
        if ( ! $page_id || 'page' !== get_post_type( $page_id ) ) return;

        $content = (string) get_post_field( 'post_content', $page_id );
        // Never rewrite a real imported or edited homepage. This is only a guard
        // for the genuinely empty/near-empty page seen after switching demos.
        if ( strlen( trim( $content ) ) >= 120 ) return;

        if ( ! is_array( $profile ) ) $profile = array();
        $eyebrow = (string) ( $profile['eyebrow'] ?? __( 'Welcome', 'wp-theme' ) );
        $title = (string) ( $profile['hero_title'] ?? get_bloginfo( 'name' ) );
        $intro = (string) ( $profile['hero_text'] ?? __( 'A practical WordPress starter site ready to edit.', 'wp-theme' ) );
        $primary_label = (string) ( $profile['primary_label'] ?? __( 'Get started', 'wp-theme' ) );
        $primary_url = (string) ( $profile['primary_url'] ?? home_url( '/contact/' ) );
        $secondary_label = (string) ( $profile['secondary_label'] ?? __( 'Explore', 'wp-theme' ) );
        $secondary_url = (string) ( $profile['secondary_url'] ?? home_url( '/services/' ) );
        $services_heading = (string) ( $profile['services_heading'] ?? __( 'Useful services, clearly presented.', 'wp-theme' ) );
        $about_title = (string) ( $profile['about_title'] ?? __( 'A flexible starting point for the real site.', 'wp-theme' ) );
        $about_text = (string) ( $profile['about_text'] ?? $intro );
        $hero_image = esc_url( (string) ( $profile['hero_image'] ?? '' ) );
        $about_image = esc_url( (string) ( $profile['about_image'] ?? $hero_image ) );
        $services = ! empty( $profile['services'] ) && is_array( $profile['services'] ) ? array_slice( $profile['services'], 0, 4 ) : array();
        $stats = ! empty( $profile['stats'] ) && is_array( $profile['stats'] ) ? array_slice( $profile['stats'], 0, 4 ) : array();

        $out = '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-sector-hero wp-theme-demo-repair","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-sector-hero wp-theme-demo-repair"><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} --><!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( $eyebrow ) . '</p><h1>' . esc_html( $title ) . '</h1><p class="wp-theme-sector-lead">' . esc_html( $intro ) . '</p><div class="wp-theme-demo-buttons"><a class="btn btn-primary" href="' . esc_url( $primary_url ) . '">' . esc_html( $primary_label ) . '</a><a class="btn btn-outline-primary" href="' . esc_url( $secondary_url ) . '">' . esc_html( $secondary_label ) . '</a></div><!-- /wp:wpbb/column -->';
        if ( $hero_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $hero_image . '" alt="" loading="eager" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        if ( 'automotive' === ( $profile['id'] ?? '' ) ) {
            $out .= '<!-- wp:group {"className":"wp-theme-section-shell wpbb-automotive-finder-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wpbb-automotive-finder-section" id="finder"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"automotive","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';
        }

        $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-services-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-services-section"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['services_eyebrow'] ?? __( 'Services', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $services_heading ) . '</h2><!-- wp:wpbb/row {"gutterX":"gx-4","gutterY":"gy-4"} -->';
        foreach ( $services as $service ) {
            $service_title = is_array( $service ) ? (string) ( $service[0] ?? '' ) : '';
            $service_text = is_array( $service ) ? (string) ( $service[1] ?? '' ) : '';
            if ( '' === trim( $service_title ) ) continue;
            $out .= '<!-- wp:wpbb/column {"xs":12,"md":6,"lg":3} --><article class="wp-theme-sector-card"><h3>' . esc_html( $service_title ) . '</h3><p>' . esc_html( $service_text ) . '</p></article><!-- /wp:wpbb/column -->';
        }
        $out .= '<!-- /wp:wpbb/row --><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-about-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-about-section"><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} -->';
        if ( $about_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $about_image . '" alt="" loading="lazy" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['about_eyebrow'] ?? __( 'About', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $about_title ) . '</h2><p class="wp-theme-sector-lead">' . esc_html( $about_text ) . '</p><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';

        if ( $stats ) {
            $out .= '<!-- wp:group {"className":"wp-theme-section-shell wp-theme-sector-proof","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wp-theme-sector-proof"><!-- wp:wpbb/row {"containerClass":"container","gutterX":"gx-3","gutterY":"gy-3"} -->';
            foreach ( $stats as $stat ) {
                $number = is_array( $stat ) ? (string) ( $stat[0] ?? '' ) : '';
                $label = is_array( $stat ) ? (string) ( $stat[1] ?? '' ) : '';
                $out .= '<!-- wp:wpbb/column {"xs":6,"lg":3} --><div class="wp-theme-sector-proof__item"><h3>' . esc_html( $number ) . '</h3><p>' . esc_html( $label ) . '</p></div><!-- /wp:wpbb/column -->';
            }
            $out .= '<!-- /wp:wpbb/row --></div><!-- /wp:group -->';
        }

        $out .= '<!-- wp:wpbb/cta-section {"title":"' . esc_attr( (string) ( $profile['cta_title'] ?? __( 'Ready to make it yours?', 'wp-theme' ) ) ) . '","titleTag":"h2","text":"' . esc_attr( (string) ( $profile['cta_text'] ?? $intro ) ) . '","buttonText":"' . esc_attr( $primary_label ) . '","buttonUrl":"' . esc_url( $primary_url ) . '","className":"wp-theme-home-cta wp-theme-home-cta--bbuilder"} /-->';

        wp_update_post( array( 'ID' => $page_id, 'post_content' => $out ) );
        update_post_meta( $page_id, '_wp_theme_demo_repaired_381029', current_time( 'mysql' ) );
    }
    add_action( 'wp_theme_after_demo_import', 'wpbb_child_demo_integrity_guard_v381029', 99, 2 );
}


/* v3.8.10.30 visual icon configuration */
function wpbb_insurance_visual_icon_config() {
    $config = array( 'base' => get_stylesheet_directory_uri(), 'icons' => array('shield', 'home', 'briefcase', 'car', 'users', 'calendar', 'map-pin', 'chart-line') );
    echo '<script>window.wpbbChildVisuals=' . wp_json_encode( $config ) . ';</script>';
}
add_action( 'wp_footer', 'wpbb_insurance_visual_icon_config', 1 );


/* v3.8.10.30: realistic demo blog featured images. Runs only after the theme's explicit demo import. */
function wpbb_insurance_demo_blog_photo_attachment( $filename, $title ) {
    $slug = sanitize_title( pathinfo( $filename, PATHINFO_FILENAME ) );
    $existing = get_page_by_path( 'insurance-blog-' . $slug, OBJECT, 'attachment' );
    if ( $existing ) {
        if ( function_exists( 'wpbb_insurance_refresh_bundled_attachment_v381041' ) ) wpbb_insurance_refresh_bundled_attachment_v381041( (int) $existing->ID, 'assets/img/blog' );
        return (int) $existing->ID;
    }
    $source = get_stylesheet_directory() . '/assets/img/blog/' . basename( $filename );
    if ( ! is_readable( $source ) ) return 0;
    $uploads = wp_upload_dir();
    $dir = trailingslashit( $uploads['basedir'] ) . 'insurance-blog';
    wp_mkdir_p( $dir );
    $target = $dir . '/' . basename( $filename );
    if ( ! file_exists( $target ) ) copy( $source, $target );
    $filetype = wp_check_filetype( $target );
    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = wp_insert_attachment( array(
        'post_mime_type' => $filetype['type'] ?: 'image/jpeg',
        'post_title' => $title,
        'post_name' => 'insurance-blog-' . $slug,
        'post_status' => 'inherit',
    ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wp_generate_attachment_metadata( $id, $target );
        if ( $meta ) wp_update_attachment_metadata( $id, $meta );
        update_post_meta( $id, '_wp_attachment_image_alt', $title );
        return (int) $id;
    }
    return 0;
}
function wpbb_insurance_seed_demo_blog_photos( $page_id = 0, $profile = array() ) {
    $posts = get_posts( array( 'post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>12, 'orderby'=>'date', 'order'=>'DESC' ) );
    if ( ! $posts ) return;
    $images = array( 'blog-1.jpg','blog-2.jpg','blog-3.jpg','blog-4.jpg','blog-5.jpg','blog-6.jpg' );
    foreach ( $posts as $index => $post ) {
        $filename = $images[ $index % count( $images ) ];
        $attachment = wpbb_insurance_demo_blog_photo_attachment( $filename, get_the_title( $post ) );
        if ( $attachment ) set_post_thumbnail( $post->ID, $attachment );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_insurance_seed_demo_blog_photos', 70, 2 );


/** v3.8.10.31: apply bundled realistic media to already-imported demos after theme upgrade. */

/**
 * Refresh an already-imported demo attachment from the current child-theme asset.
 *
 * Image optimisation may have changed `_wp_attached_file` from e.g. item-1.jpg to
 * item-1.avif/webp. Resolve the bundled source by filename stem instead of requiring
 * the child theme to ship every generated format, then regenerate all WP sub-sizes.
 */
function wpbb_insurance_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir ) {
    $attachment_id = absint( $attachment_id );
    if ( ! $attachment_id || 'attachment' !== get_post_type( $attachment_id ) ) return false;

    $attached = (string) get_post_meta( $attachment_id, '_wp_attached_file', true );
    $stem = pathinfo( basename( $attached ), PATHINFO_FILENAME );
    if ( '' === $stem ) return false;

    $base = trailingslashit( get_stylesheet_directory() ) . trailingslashit( $asset_dir ) . $stem;
    $source = '';
    foreach ( array( '.jpg', '.jpeg', '.png', '.webp', '.avif' ) as $extension ) {
        if ( is_readable( $base . $extension ) ) {
            $source = $base . $extension;
            break;
        }
    }
    if ( ! $source ) return false;

    $target = get_attached_file( $attachment_id );
    if ( ! $target ) return false;

    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';

    $source_ext = strtolower( (string) pathinfo( $source, PATHINFO_EXTENSION ) );
    $target_ext = strtolower( (string) pathinfo( $target, PATHINFO_EXTENSION ) );
    $written = false;

    if ( $source_ext === $target_ext ) {
        $written = (bool) @copy( $source, $target );
    } else {
        $target_type = wp_check_filetype( $target );
        $target_mime = ! empty( $target_type['type'] ) ? (string) $target_type['type'] : '';
        $editor = wp_get_image_editor( $source );
        if ( ! is_wp_error( $editor ) && 0 === strpos( $target_mime, 'image/' ) ) {
            $saved = $editor->save( $target, $target_mime );
            $written = ! is_wp_error( $saved ) && is_readable( $target );
        }
    }

    // Some hosts can read AVIF/WebP but cannot encode it. Fall back to the bundled
    // source extension and update WordPress to the new original file explicitly.
    if ( ! $written ) {
        $fallback = trailingslashit( dirname( $target ) ) . $stem . '.' . $source_ext;
        if ( ! @copy( $source, $fallback ) ) return false;
        update_attached_file( $attachment_id, $fallback );
        $filetype = wp_check_filetype( $fallback );
        if ( ! empty( $filetype['type'] ) ) {
            wp_update_post( array( 'ID' => $attachment_id, 'post_mime_type' => $filetype['type'] ) );
        }
        $target = $fallback;
    }

    // Remove old generated sizes first. Otherwise stale JPG thumbnails can remain
    // referenced after the original was converted to AVIF/WebP by an optimiser.
    $old_meta = wp_get_attachment_metadata( $attachment_id );
    if ( is_array( $old_meta ) && ! empty( $old_meta['sizes'] ) && is_array( $old_meta['sizes'] ) ) {
        foreach ( $old_meta['sizes'] as $old_size ) {
            if ( empty( $old_size['file'] ) ) continue;
            $old_file = trailingslashit( dirname( $target ) ) . basename( (string) $old_size['file'] );
            if ( is_file( $old_file ) && wp_normalize_path( $old_file ) !== wp_normalize_path( $target ) ) @unlink( $old_file );
        }
    }

    $meta = wp_generate_attachment_metadata( $attachment_id, $target );
    if ( $meta ) wp_update_attachment_metadata( $attachment_id, $meta );
    clean_attachment_cache( $attachment_id );
    return true;
}

function wpbb_insurance_realistic_media_upgrade_v381041() {
    if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
    $done_key = 'wpbb_insurance_realistic_media_upgrade_v381041';
    if ( get_option( $done_key ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;

    $pairs = array(array('insurance-blog','assets/img/blog'));
    foreach ( $pairs as $pair ) {
        $upload_prefix = $pair[0];
        $asset_dir = $pair[1];
        $ids = get_posts( array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array( array( 'key'=>'_wp_attached_file', 'value'=>$upload_prefix . '/', 'compare'=>'LIKE' ) ),
        ) );
        foreach ( $ids as $attachment_id ) {
            wpbb_insurance_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir );
        }
    }
    if ( function_exists( 'wpbb_insurance_seed_demo_blog_photos' ) ) wpbb_insurance_seed_demo_blog_photos( 0, array() );
    update_option( $done_key, current_time( 'mysql' ), false );
}
add_action( 'admin_init', 'wpbb_insurance_realistic_media_upgrade_v381041', 120 );


/* v3.8.10.42: full-width single-column demo rows + optional frontend demo protection. */
function wpbb_child_381042_repair_single_columns( $blocks ) {
    foreach ( $blocks as &$block ) {
        if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) && ! empty( $block['innerBlocks'] ) ) {
            $column_indexes = array();
            foreach ( $block['innerBlocks'] as $index => $inner ) {
                if ( 'wpbb/column' === ( $inner['blockName'] ?? '' ) ) $column_indexes[] = $index;
            }
            if ( 1 === count( $column_indexes ) ) {
                $idx = $column_indexes[0];
                $attrs = $block['innerBlocks'][ $idx ]['attrs'] ?? array();
                if ( 12 === (int) ( $attrs['xs'] ?? 12 ) ) {
                    $attrs['xs'] = 12;
                    foreach ( array( 'sm', 'md', 'lg', 'xl', 'xxl' ) as $breakpoint ) unset( $attrs[ $breakpoint ] );
                    $block['innerBlocks'][ $idx ]['attrs'] = $attrs;
                }
            }
        }
        if ( ! empty( $block['innerBlocks'] ) ) $block['innerBlocks'] = wpbb_child_381042_repair_single_columns( $block['innerBlocks'] );
    }
    unset( $block );
    return $blocks;
}

function wpbb_child_381042_repair_demo_page_widths() {
    $pages = get_posts( array(
        'post_type' => 'page', 'post_status' => 'any', 'posts_per_page' => -1,
        'meta_key' => '_wp_theme_demo_managed', 'meta_value' => '1', 'fields' => 'ids',
    ) );
    foreach ( $pages as $page_id ) {
        $content = (string) get_post_field( 'post_content', $page_id );
        if ( false === strpos( $content, 'wpbb/column' ) ) continue;
        $blocks = parse_blocks( $content );
        $repaired = serialize_blocks( wpbb_child_381042_repair_single_columns( $blocks ) );
        if ( $repaired !== $content ) wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381042_repair_demo_page_widths', 140 );
function wpbb_child_381042_repair_demo_page_widths_once() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) return;
    $key = 'wpbb_381042_single_col_' . sanitize_key( get_stylesheet() );
    if ( get_option( $key ) ) return;
    wpbb_child_381042_repair_demo_page_widths();
    update_option( $key, 1, false );
}
add_action( 'admin_init', 'wpbb_child_381042_repair_demo_page_widths_once', 40 );

/**
 * v3.8.10.43: repair shared demo alignment and force one fresh media pass.
 *
 * The previous media migration was intentionally one-shot. This release uses a
 * new per-theme marker so sites that already ran v381041 receive the current
 * child-owned room/product/project/blog images as well.
 */
if ( ! function_exists( 'wpbb_child_381043_normalize_text' ) ) {
    function wpbb_child_381043_normalize_text( $value ) {
        $value = html_entity_decode( wp_strip_all_tags( (string) $value ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) );
        return trim( preg_replace( '/\\s+/u', ' ', $value ) );
    }
}

if ( ! function_exists( 'wpbb_child_381043_dedupe_single_body' ) ) {
    function wpbb_child_381043_dedupe_single_body( $content, $excerpt = '' ) {
        $excerpt_text = wpbb_child_381043_normalize_text( $excerpt );
        if ( '' === $excerpt_text ) return $content;

        $content_text = wpbb_child_381043_normalize_text( $content );
        if ( $content_text === $excerpt_text ) return '';

        if ( preg_match( '~^\\s*<p(?:\\s[^>]*)?>(.*?)</p>~is', (string) $content, $match ) ) {
            if ( wpbb_child_381043_normalize_text( $match[1] ) === $excerpt_text ) {
                return ltrim( substr( (string) $content, strlen( $match[0] ) ) );
            }
        }
        return $content;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_block_alignment' ) ) {
    function wpbb_child_381043_repair_block_alignment( $blocks ) {
        foreach ( $blocks as &$block ) {
            if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) ) {
                $attrs = $block['attrs'] ?? array();
                $classes = preg_split( '/\\s+/', trim( (string) ( $attrs['customClasses'] ?? '' ) ) );
                $classes = array_values( array_filter( array_map( 'sanitize_html_class', $classes ) ) );
                if ( in_array( 'wp-theme-sector-media-text', $classes, true ) ) {
                    $classes = array_values( array_diff( $classes, array( 'align-items-center', 'align-items-end' ) ) );
                    if ( ! in_array( 'align-items-start', $classes, true ) ) $classes[] = 'align-items-start';
                    $attrs['customClasses'] = implode( ' ', $classes );
                    $block['attrs'] = $attrs;
                }
            }
            if ( ! empty( $block['innerBlocks'] ) ) {
                $block['innerBlocks'] = wpbb_child_381043_repair_block_alignment( $block['innerBlocks'] );
            }
        }
        unset( $block );
        return $blocks;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_demo_pages' ) ) {
    function wpbb_child_381043_repair_demo_pages() {
        // Repair every page that actually contains the theme's media/text row.
        // This also covers front pages imported before the managed-page marker existed.
        $page_ids = get_posts( array(
            'post_type' => 'page',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields' => 'ids',
        ) );
        foreach ( $page_ids as $page_id ) {
            $content = (string) get_post_field( 'post_content', $page_id );
            if ( false === strpos( $content, 'wp-theme-sector-media-text' ) ) continue;
            $repaired = serialize_blocks( wpbb_child_381043_repair_block_alignment( parse_blocks( $content ) ) );
            if ( $repaired !== $content ) {
                wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
                clean_post_cache( $page_id );
            }
        }
    }
}

if ( ! function_exists( 'wpbb_child_381043_refresh_media_once' ) ) {
    function wpbb_child_381043_refresh_media_once( $page_id = 0, $profile = array() ) {
        if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
        if ( ! current_user_can( 'manage_options' ) ) return;

        $current_stylesheet = sanitize_key( get_stylesheet() );
        $done_key = 'wpbb_child_381043_media_' . $current_stylesheet;
        $owner_key = 'wpbb_child_381043_media_owner';
        // Demo posts are shared while child themes are switched. Refresh again
        // whenever a different child theme last supplied the active media.
        if ( get_option( $done_key ) && $current_stylesheet === (string) get_option( $owner_key ) ) return;

        $defined = get_defined_functions();
        foreach ( (array) ( $defined['user'] ?? array() ) as $function_name ) {
            if ( ! preg_match( '/^wpbb_[a-z0-9_]+_realistic_media_upgrade_v381041$/', $function_name ) ) continue;
            delete_option( $function_name );
            call_user_func( $function_name );
        }

        // Correct stale titles/alt text left behind when the same demo posts were
        // reused while switching child themes.
        $post_ids = get_posts( array(
            'post_type' => 'any',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => '_thumbnail_id',
            'fields' => 'ids',
        ) );
        foreach ( $post_ids as $post_id ) {
            $thumbnail_id = (int) get_post_thumbnail_id( $post_id );
            if ( ! $thumbnail_id ) continue;
            $attached = (string) get_post_meta( $thumbnail_id, '_wp_attached_file', true );
            $attachment_name = (string) get_post_field( 'post_name', $thumbnail_id );
            if ( false === strpos( $attached, '-blog/' ) && 0 !== strpos( $attachment_name, 'wpbb-' ) ) continue;
            $title = get_the_title( $post_id );
            if ( '' === trim( (string) $title ) ) continue;
            wp_update_post( array( 'ID' => $thumbnail_id, 'post_title' => $title ) );
            update_post_meta( $thumbnail_id, '_wp_attachment_image_alt', $title );
            clean_post_cache( $post_id );
            clean_attachment_cache( $thumbnail_id );
        }

        wpbb_child_381043_repair_demo_pages();
        update_option( $done_key, current_time( 'mysql' ), false );
        update_option( $owner_key, $current_stylesheet, false );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381043_refresh_media_once', 180, 2 );
add_action( 'admin_init', 'wpbb_child_381043_refresh_media_once', 130 );

/**
 * v3.8.10.45: shared rhythm, contrast, sector-media and gallery repair.
 */
require_once __DIR__ . '/inc/sector-consistency.php';
