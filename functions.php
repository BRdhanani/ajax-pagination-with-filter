<?php

add_action('wp_enqueue_scripts', 'myscripts');
function myscripts() { 
    wp_register_script('like_post', get_template_directory_uri() .'/functions.js');
    wp_localize_script( 'like_post', 'ajax_var', array(
    'url' => admin_url( 'admin-ajax.php' ),
));
 wp_enqueue_script('like_post');
}


function learningWordPress_resources(){
    wp_enqueue_style( 'style', get_stylesheet_uri( ) );
}

add_action( 'wp_enqueue_scripts', 'learningWordPress_resources' );

//navigation Menus
register_nav_menus( array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),
) );

// custom post type
add_action( 'init', 'codex_competition_init' );

function codex_competition_init() {
	$labels = array(
		'name'               => _x( 'competition', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'competition', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'competition', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'competition', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'competition', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New competition', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New competition', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit competition', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View competition', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All competitions', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search competition', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent competition:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No competitions found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No competitions found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'competition' ),
		'capability_type'    => 'page',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'competition', $args );
}


add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
	$paged = $_POST['page'];
	
	$valueOf = 'none';

	if(isset($_POST['valueOf'])){
	$valueOf =$_POST['valueOf'];
	}

	
	if($valueOf == 'none'){
		$args = array(
    	    'post_type' => 'competition',
    	    'post_status' => 'publish',
    	    'paged' => $paged,
		);
		
	} else {/*
		
		$args = array(
            'post_type' => 'competition',
            'post_status' => 'publish',
            'paged' => $paged,
            'meta_query' => array(
                array(
                    'key'     => 'select',
                    'value'   => $valueOf,
                    'compare' => '=',
                ),
            ),
        );
	*/}
	
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
        <?php while ( $my_posts->have_posts() ) : $my_posts->the_post() ?>
            <h2><?php the_title() ?></h2>
            <?php the_excerpt() ?>
        <?php endwhile ?>
        <?php
    endif;
 
    wp_die();
}

?>
