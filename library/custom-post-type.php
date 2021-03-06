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
	add_action( 'init', 'custom_post_link');


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
			'edit_item' => __( 'Edit Event', 'bonestheme' ), /* Edit Display Title */
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
			'menu_icon' => 'dashicons-calendar-alt', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'events', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
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
			'edit_item' => __( 'Edit Publication', 'bonestheme' ), /* Edit Display Title */
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
			'menu_icon' => 'dashicons-media-default', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'publications', 'with_front' => false ), /* you can specify its url slug */
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
			'name' => __( 'Press Releases', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Press Release', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Press Releases', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Press Release', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Press Release', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Press Release', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Press Release', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Press Releases', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Press Releases from FDSD', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-media-spreadsheet', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'press', 'with_front' => false ), /* you can specify its url slug */
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
			'menu_icon' => 'dashicons-universal-access-alt', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'ideas', 'with_front' => false ), /* you can specify its url slug */
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

// What we are reading (LINK) POST TYPE ////////////////////
// let's create the function for the custom type
function custom_post_link() { 
	// creating (registering) the custom type 
	register_post_type( 'link', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'What we are reading', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'What we are reading Link', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All What we are reading Links', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New What we are reading Link', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit What we are reading Link', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New What we are reading Link', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View What we are reading Link', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search What we are reading Links', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'What we are reading Links', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-admin-links', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'links', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'what-are-we-reading', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */

	
	
}

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'themes', 
		array('event', 'post', 'publication', 'press', 'idea' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
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
			'rewrite' => array( 'slug' => 'fdsd_theme' ),
		)
	);
	
	
		
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'topics', 
		array('event', 'post', 'publication', 'press', 'idea' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'FDSD Topics', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'FDSD Topic', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search FDSD Topics', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All FDSD Topics', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent FDSD Topic', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent FDSD Topic:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit FDSD Topic', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update FDSD Topic', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New FDSD Topic', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New FDSD Topic', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'fdsd_topic' ),
		)
	);
	
			
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'publication_type', 
		array( 'publication'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Publication Types', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Publication Type', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Publication Types', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Publication Types', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Publication Type', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Publication Type:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Publication Type', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Publication Type', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Publication Type', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Publication Type', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'publication_type' ),
		)
	);
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'authors', 
		array( 'publication'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Authors', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Author', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Authors', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Authors', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Author', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Author:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Author', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Author', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Author', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Author', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'Authors' ),
		)
	);
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'pub_year', 
		array( 'publication'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Year of Publication', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Year of Publication', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Publication Years', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Publication Years', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Publication Year', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Publication Year:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Publication Year', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Publication Year', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Publication Year', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Publication Year', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'pub_year' ),
		)
	);	
	
	// now let's add custom tags (these act like categories)
	/* register_taxonomy( 'custom_tag', 
		array('custom_type'), //if you change the name of register_post_type( 'custom_type', then you have to change this 
		array('hierarchical' => false,    // if this is false, it acts like tags 
			'labels' => array(
				'name' => __( 'Custom Tags', 'bonestheme' ), // name of the custom taxonomy 
				'singular_name' => __( 'Custom Tag', 'bonestheme' ), // single taxonomy name 
				'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), // search title for taxomony 
				'all_items' => __( 'All Custom Tags', 'bonestheme' ), // all title for taxonomies 
				'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), // parent title for taxonomy 
				'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title 
				'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), // edit custom taxonomy title 
				'update_item' => __( 'Update Custom Tag', 'bonestheme' ), // update title for taxonomy 
				'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), // add new title for taxonomy 
				'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) // name title for taxonomy
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
		)
	);
	*/
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>
