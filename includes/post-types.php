<?php 
add_action('init', 'create_post_type_custom');

function create_post_type_custom() {
    register_taxonomy_for_object_type('category', 'custom-post'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'custom-post');
    register_post_type('custom-post', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Custom Post', ''), // Rename these to suit
            'singular_name' => __('Custom Post', ''),
            'add_new' => __('Add New', ''),
            'add_new_item' => __('Add New Custom Post', ''),
            'edit' => __('Edit', ''),
            'edit_item' => __('Edit Custom Post', ''),
            'new_item' => __('New Custom Post', ''),
            'view' => __('View Custom Post', ''),
            'view_item' => __('View Custom Post', ''),
            'search_items' => __('Search Custom Post', ''),
            'not_found' => __('No Custom Posts found', ''),
            'not_found_in_trash' => __('No Custom Posts found in Trash', '')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}?>