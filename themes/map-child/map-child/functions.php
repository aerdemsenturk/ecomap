<?php

function understrap_remove_scripts() {
// wp_dequeue_style( 'understrap-styles' );
// wp_deregister_style( 'understrap-styles' );

wp_dequeue_script( 'understrap-scripts' );
wp_deregister_script( 'understrap-scripts' );
}

function theme_enqueue_styles() {
// Get the theme data
$the_theme = wp_get_theme();
// wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}

add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Additional JS and CSS
add_action( 'wp_enqueue_scripts', function () {
wp_enqueue_script( 'masonry', '//cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js' );
wp_enqueue_script( 'masonry-gallery', get_stylesheet_directory_uri() . '/js/masonry-gallery.js', array('jquery'), '1.0.0', true);
wp_enqueue_script( 'magnific_popup_script', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js' , array('jquery'), '1.0.0', true  );
wp_enqueue_script( 'magnific_init_script', get_stylesheet_directory_uri(). '/js/jquery.magnific-popup-init.js', array('jquery'), '1.0.0', true  );
// wp_enqueue_style( 'magnific_popup_style', get_stylesheet_directory_uri(). '/css/magnific-popup.css', array() );
wp_enqueue_style( 'eko_style', get_stylesheet_directory_uri(). '/css/eko-style.css', array() );
}, 100 );

/*********
* Delete taxonomy name title
************/

function as_archive_title( $title ) 
{
    if ( is_category() ) 
    {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'as_archive_title' );

/*********
* Back button
************/

function wp_back_button()
{
    if ( wp_get_referer() )
    {
        $back_text = __( '↩' );
        $button    = "\n<h3><a id='backbutton' data-toggle='tooltip' title='Back' href='#' data-placement='left' onclick='javascript:history.back()'>$back_text</a><h3>";
        echo ( $button );
    }
}
add_action( 'back_button', 'wp_back_button' );

/*********
* Gallery Defaults
************/

// add_filter( 'shortcode_atts_gallery',
//     function( $out )
//     {
//         $out['link'] = 'file';
//         $out['size'] = 'medium';
//         return $out;
//     }
// );

/*********
* Remove Emoji Codes
************/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

/*********
* Remove wlwmanifest, shortlink, rsd link, feed links, wp generator
************/

remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'wp_generator');

/*********
* Remove WP Version From Styles and Scripts	
************/

add_filter( 'style_loader_src', 'as_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'as_remove_ver_css_js', 9999 );
function as_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/*********
* Remove Comments	
************/
 
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'init', 'remove_comment_support', 100 );
function remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

/*********
* Remove HTML Comments	
************/

function callback($buffer){ $buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer); return $buffer; }
function buffer_start(){ ob_start("callback"); }
function buffer_end(){ ob_end_flush(); }
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');

/*********
* Add title to <a> in [gallery] shortcode.
************/

// function as_get_attachment_link( $output, $id ) {
// 	$attachment = get_post( $id );
// 	return str_replace( '<a', "<a title='{$attachment->post_excerpt}'", $output );
// }
// add_filter( 'wp_get_attachment_link', 'as_get_attachment_link', 10, 2 );

/*********
* Customize excerpt and read more 
************/

// LENGTH
function custom_excerpt_length( $length ) {

	return 120;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*********
* READ MORE
************/

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {

	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . '...<h3><a title="See case" data-toggle="tooltip" data-placement="right" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( '↪' ) . '</a></h3>';
		}
		return $post_excerpt;
	}
}

/*********
* GUTENBERG
************/

function custom_admin_css() {
    echo '<style type="text/css">
    .wp-block { max-width: 1300px; }
    </style>';
    }
    add_action('admin_head', 'custom_admin_css');
    
/*********
* ACF DEFAULT IMAGE
************/

add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
    function add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
        'label'			=> 'Default Image',
        'instructions'		=> 'Appears when creating a new post',
        'type'			=> 'image',
        'name'			=> 'default_value',
    ));
}

add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');
    function enqueue_uploader_for_image_default() {
    $screen = get_current_screen();
        if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
            acf_enqueue_uploader();
    }
}
