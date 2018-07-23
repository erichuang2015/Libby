<?php 

// add_action( 'init', 'create_song_taxonomy', 0 );

function create_song_taxonomy() {

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Songs', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Song', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Songs', 'textdomain' ),
        'popular_items'              => __( 'Popular Songs', 'textdomain' ),
        'all_items'                  => __( 'All Songs', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Song', 'textdomain' ),
        'update_item'                => __( 'Update Song', 'textdomain' ),
        'add_new_item'               => __( 'Add New Song', 'textdomain' ),
        'new_item_name'              => __( 'New Song Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate songs with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove songs', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used songs', 'textdomain' ),
        'not_found'                  => __( 'No songs found.', 'textdomain' ),
        'menu_name'                  => __( 'Songs', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'song' ),
    );

    register_taxonomy( 'song', 'post', $args );
} ?>