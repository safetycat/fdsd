<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}



// POST TYPE INITS //////////////////////
	// adding the EVENT function to the Wordpress init
	add_action( 'init', 'custom_post_events');
	add_action( 'init', 'custom_post_publications');
	add_action( 'init', 'custom_post_press');
	add_action( 'init', 'custom_post_idea');



// EVENT POST TYPE ///////////////////
// let's create the function for the custom type
function custom_post_events() { 
	// creating (registering) the custom type 
	register_post_type( 'event', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Events', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Event', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Events', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Event', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Events', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Event', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Event', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Event', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Events by or relating to FDSD', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/event-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'event', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'event' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'event' );
	
}



// PUBLICATION POST TYPE ///////////////////
// let's create the function for the custom type
function custom_post_publications() { 
	// creating (registering) the custom type 
	register_post_type( 'publication', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Publications', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Publication', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Publications', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Publication', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Publications', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Publication', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Publication', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Publications', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Publications by or relating to FDSD', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/publication-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'publication', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */

	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'publication' );
	
}


// PRESS POST TYPE ///////////////////
// let's create the function for the custom type
function custom_post_press() { 
	// creating (registering) the custom type 
	register_post_type( 'press', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Press Items', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Press Item', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Press Items', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Press Item', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Press Items', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Press Item', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Press Item', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Press Items', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Press Items by or relating to FDSD', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/press-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'press', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	

	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'press' );
	
}




// IDEAS IN ACTION POST TYPE ////////////////////
// let's create the function for the custom type
function custom_post_idea() { 
	// creating (registering) the custom type 
	register_post_type( 'idea', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Ideas in Action', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Idea in Action', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Ideas', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Idea', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Idea', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Idea', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Idea', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Ideas', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Ideas in Action', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/idea-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'idea', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */

	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'idea' );
	
}



	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'themes', 
		array('event', 'post', 'publication', 'page', 'press', 'idea' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'FDSD Themes', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'FDSD Theme', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search FDSD Themes', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All FDSD Themes', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent FDSD Theme', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent FDSD Theme:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit FDSD Theme', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update FDSD Theme', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New FDSD Theme', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New FDSD Theme', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'custom-slug' ),
		)
	);
	
	// now let's add custom tags (these act like categories)
	register_taxonomy( 'custom_tag', 
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>
