<?php

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
	$content_width = 900;
}

if (function_exists('add_theme_support')) {
	// Add Menu Support
	add_theme_support('menus');

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 120, '', true); // Small Thumbnail
	add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	// add_theme_support('custom-background', array(
	//     'default-color' => 'FFF',
	//     'default-image' => get_template_directory_uri() . '/img/bg.jpg'
	// ));

	// Add Support for Custom Header - Uncomment below if you're going to use
	/*add_theme_support('custom-header', array(
	'default-image'         => get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'           => false,
	'default-text-color'        => '000',
	'width'             => 1000,
	'height'            => 198,
	'random-default'        => false,
	'wp-head-callback'      => $wphead_cb,
	'admin-head-callback'       => $adminhead_cb,
	'admin-preview-callback'    => $adminpreview_cb
	));*/

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Localisation Support
	load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
		Functions
\*------------------------------------*/

// custom navigation
function main_nav() {
	wp_nav_menu(array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	));
}

function custom_nav() {
	echo '<ul class="nav-list">';
	$top_level = array(
			'parent' => 0,
			'sort_column' => 'menu_order',
			'sort_order' => 'asc'
	);
	$pages = get_pages( $top_level );
	foreach ( $pages as $page ):
		$id = $page->ID;
		$name = $page->post_title;
		$class = 'top-level-nav';
		$link;
		$sub_level = array(
			'child_of' => $id,
			'sort_column' => 'menu_order',
			'sort_order' => 'asc'
		);
		$sub_pages = get_pages( $sub_level );
		if ( $sub_pages ) {
			$class .= ' has-children';
			foreach ($sub_pages as $sub_page) {
				$link = get_page_link( $sub_page->ID );
				break;
			}
			echo '<li class="'. $class .'"><a href="'. $link .'">'. $name .'</a>';
			echo '<ul class="sub-nav">';
			foreach ($sub_pages as $sub_page) {
				$sub_nav_name = $sub_page->post_title;
				$sub_nav_link = get_page_link( $sub_page->ID );
				echo '<li><a href="'. $sub_nav_link .'">'. $sub_nav_name .'</a></li>';
			}
			echo '</ul>';
		} else {
			$link = get_page_link( $id );
			echo '<li class="'. $class .'"><a href="'. $link .'">'. $name .'</a>';
		}
		echo '</li>';
	endforeach;
	echo '</ul>';
}

function get_js($file) {
	return get_template_directory_uri() . '/assets/js/' . $file;
}

// Load scripts
function custom_scripts() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		wp_register_script('modernizr', get_js('lib/modernizr-2.7.1.min.js'), array(), '2.7.1'); // Modernizr
		wp_register_script('index', get_js('scripts.min.js'), array('modernizr'), '1.0.0', true);
		wp_enqueue_script('index');
	}
}

// Load styles
function custom_styles() {
	wp_register_style('custom', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
	wp_enqueue_style('custom');
}

// Register Navigation
function register_menu() {
	register_nav_menus(array( // Using array to specify more menus if needed
		'header-menu' => __('Header Menu', ''),
		'sidebar-menu' => __('Sidebar Menu', ''),
		'extra-menu' => __('Extra Menu', '')
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
	// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' => __('Widget Area 1', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Widget Area 2', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function custom_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Custom Gravatar in Settings > Discussion
function custom_gravatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}


/*------------------------------------*\
		Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'custom_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'custom_styles'); // Add Theme Stylesheet
add_action('init', 'register_menu'); // Add HTML5 Blank Menu

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'custom_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', ''); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images


/*------------------------------------*\
		External files
\*------------------------------------*/

include( get_stylesheet_directory() . '/includes/post-types.php' );
include( get_stylesheet_directory() . '/includes/taxonomies.php' );
include( get_stylesheet_directory() . '/includes/short-codes.php' );