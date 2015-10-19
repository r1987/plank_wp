<?php
/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Regular resets/disables/enables
**  - - - - - - - - - - - - - - - - - - - - - -
*/
add_filter( 'show_admin_bar', '__return_false' );
add_theme_support('menus');
add_editor_style('editor-style.css');
add_theme_support( 'post-thumbnails' );


/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Load theme translation
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function setup() {
    load_theme_textdomain('plank_wp', get_template_directory() . '/lang');
}
add_action( 'after_setup_theme', 'setup' );


/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Remove menu pages
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function remove_menu_pages() {
	//remove_menu_page('tools.php');
	remove_menu_page('edit-comments.php');
	//remove_menu_page('edit.php');
	//remove_menu_page('plugins.php');
}

add_action( 'admin_menu', 'remove_menu_pages' );

/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Sitemap for Grunt
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function show_sitemap() {
  if(isset($_GET['show_sitemap'])) {
    $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
    $urls = array();
    while($the_query->have_posts()) {
      $the_query->the_post();
      $urls[] = get_permalink();
    }
    die(json_encode($urls));
  }
}
add_action('template_redirect', 'show_sitemap');


/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Remove header links
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function remove_header_links() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'rel_canonical');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'remove_header_links');


/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  Remove emoji support
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	Rename Posts to News
**	- - - - - - - - - - - - - - - - - - - - - -
*/
// function change_post_menu_label() {
// 	global $menu;
// 	global $submenu;
// 	$menu[5][0] = 'News';
// 	$submenu['edit.php'][5][0] = 'All News';
// 	$submenu['edit.php'][10][0] = 'Add News';
// 	$submenu['edit.php'][16][0] = 'News Tags';
// 	echo '';
// }
// function change_post_object_label() {
// 	global $wp_post_types;
// 	$labels = &$wp_post_types['post']->labels;
// 	$labels->name = 'News';
// 	$labels->singular_name = 'News';
// 	$labels->add_new = 'Add News';
// 	$labels->add_new_item = 'Add News';
// 	$labels->edit_item = 'Edit News';
// 	$labels->new_item = 'News';
// 	$labels->view_item = 'View News';
// 	$labels->search_items = 'Search News';
// 	$labels->not_found = 'No News found';
// 	$labels->not_found_in_trash = 'No News found in Trash';
// }
// add_action( 'init', 'change_post_object_label' );
// add_action( 'admin_menu', 'change_post_menu_label' );


/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	Remove unneccessary classes from wp_nav_menu
**	- - - - - - - - - - - - - - - - - - - - - -

add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
  return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
*/


/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	ENQUEUE SCRIPTS
**	- - - - - - - - - - - - - - - - - - - - - -
*/
function enqueue_plank_scripts() {

	// jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );

	// JS Scripts
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/javsscripts/scripts.min.js', array('jquery'), '', true);

	// AJAX
    // wp_localize_script( 'scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action('wp_enqueue_scripts', 'enqueue_plank_scripts');

/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	ENQUEUE STYLES
**	- - - - - - - - - - - - - - - - - - - - - -
*/
function enqueue_plank_styles() {

    // Main Stylesheet
    wp_enqueue_style('stylesheet', get_template_directory_uri() . '/stylesheets/style.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'enqueue_plank_styles');


/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	IMAGES
**	- - - - - - - - - - - - - - - - - - - - - -
*/
// add_image_size( 'image-name', height, width );

// function wp_get_attachment_medium_url( $id ) {
//     $medium_array = image_downsize( $id, 'project-image' );
//     $medium_path = $medium_array[0];

//     return $medium_path;
// }

// add_filter('image_size_names_choose', 'my_image_sizes');
// function my_image_sizes($sizes) {
//   $addsizes = array(
//     "news-image" => __( "News Image")
//   );
//   $newsizes = array_merge($sizes, $addsizes);
//   return $newsizes;
// }

/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	RETINA IMAGES GENERATOR
**	- - - - - - - - - - - - - - - - - - - - - -
*/
require_once(TEMPLATEPATH . '/includes/retina-images-generator.php');

/*
**	- - - - - - - - - - - - - - - - - - - - - -
**	LAZYSIZES IMAGES
**	- - - - - - - - - - - - - - - - - - - - - -
*/
require_once(TEMPLATEPATH . '/includes/lazy-images.php');


/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  PLUGIN: Gallery Metabox
**  - - - - - - - - - - - - - - - - - - - - - -
*/
require_once(TEMPLATEPATH . '/includes/gallery-metabox/gallery.php');
?>
