<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style();

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'idea-thumb', 378, 212 );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

//add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home',
		'name' => __( 'Homepage', 'bonestheme' ),
		'description' => __( 'The Homepage Content area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget homewidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  //wp_enqueue_style('googleFontsLato', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  wp_enqueue_style('googleFontsOSans', 'http://fonts.googleapis.com/css?family=Open+Sans');
  wp_enqueue_style('googleFontsRoboto', 'http://fonts.googleapis.com/css?family=Roboto:500');
  
}

add_action('wp_enqueue_scripts', 'bones_fonts');



/////////////////////////////////////////////////////////////////////////
//////// AFTER BONES //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////


   
/**
* Enqueue Font Awesome Stylesheet from MaxCDN
*
*/   
   add_action( 'wp_enqueue_scripts', 'webendev_load_font_awesome', 99 );

function webendev_load_font_awesome() {

wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css', null, '4.0.1' );
 
}




// Register top navigation
register_nav_menus( array(
  'minitop' => 'Mini Top Navigation Menu'
) );


// Add search box to menu
function add_search_to_wp_menu ( $items, $args ) {
  if( 'minitop' === $args -> theme_location ) {
$items .= '<li class="menu-item menu-item-search">';
$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('home') . '/"><input class="text_input" type="text" value="Search" name="s" id="s" onfocus="if (this.value == \'Search\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Search\';}" /><input type="submit" class="my-wp-search" id="searchsubmit" value="search" /></form>';
$items .= '</li>';
  }
return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);



// Change order of comment fields (textbox to top)
// We use just one function for both jobs.
add_filter( 'comment_form_defaults', 'remove_textarea' );
add_action( 'comment_form_top', 'add_textarea' );


function remove_textarea($defaults)
{
    $defaults['comment_field'] = '';
    return $defaults;
}

function add_textarea()
{
    echo '<p class="comment-form-comment"><label for="comment">If you know of any practical examples which link democracy and sustainable development, please provide a few details and a web link below. Many thanks.</label><textarea id="comment" name="comment" cols="60" rows="6" placeholder="Enter your comment here..." aria-required="true"></textarea></p>';
}




// Add class to searchfilter results


// Add specific CSS class by filter
add_filter( 'body_class', 'searchfilterclass' );
function searchfilterclass( $classes ) {
  // add 'class-name' to the $classes array
  if (isset($_POST)){
   $classes[] = 'searchfilter'; 
  }
  
  // return the $classes array
  return $classes;
}

////////// Custom Columns ///////



function add_idea_columns($columns) {
    //unset($columns['author']);
    return array_merge($columns, 
              array('featured_idea' => __('Featured')));
}
add_filter('manage_idea_posts_columns' , 'add_idea_columns');



add_action( 'manage_posts_custom_column' , 'custom_columns', 10, 2 );

function custom_columns( $column, $post_id ) {
    switch ( $column ) {
  case 'featured_idea' :
      $field = get_field('featured_idea');

      //$terms = get_the_term_list( $post_id , 'featured_idea' , '' , ',' , '' );
     // print_r($field);
            if ($field[0] != "" )
              echo "Y";
            break;

  case 'publisher' :
      echo get_post_meta( $post_id , 'publisher' , true ); 
      break;
    }
}



// Remove duplicate admin pages for themes & topics
function tw_remove_menu_pages() {

	remove_submenu_page( 'edit.php?post_type=idea', 'edit-tags.php?taxonomy=themes&amp;post_type=idea' );
	remove_submenu_page( 'edit.php?post_type=idea', 'edit-tags.php?taxonomy=topics&amp;post_type=idea' );
	
	remove_submenu_page( 'edit.php?post_type=event', 'edit-tags.php?taxonomy=themes&amp;post_type=event' );
	remove_submenu_page( 'edit.php?post_type=event', 'edit-tags.php?taxonomy=topics&amp;post_type=event' );
	
	remove_submenu_page( 'edit.php?post_type=publication', 'edit-tags.php?taxonomy=themes&amp;post_type=publication' );
	remove_submenu_page( 'edit.php?post_type=publication', 'edit-tags.php?taxonomy=topics&amp;post_type=publication' );
	
	remove_submenu_page( 'edit.php?post_type=press', 'edit-tags.php?taxonomy=themes&amp;post_type=press' );
	remove_submenu_page( 'edit.php?post_type=press', 'edit-tags.php?taxonomy=topics&amp;post_type=press' );
	 
}
 
add_action( 'admin_menu', 'tw_remove_menu_pages', 999 );


// Include tags in search
// add_action( 'pre_get_posts', 'include_tags_in_search' );
// function include_tags_in_search($query){
//     if($query->is_search){
//         $terms = explode(' ', $query->get('s'));
//         $query->set('tax_query', array(
//             'relation'=>'OR',
//             array(
//                 'taxonomy'=>'post_tag',
//                 'field'=>'slug',
//                 'terms'=>$terms
//             )
//         ));
//     }
// }


function custom_search_where($where){
  global $wpdb;
  if (is_search())
    $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
  return $where;
}

function custom_search_join($join){
  global $wpdb;
  if (is_search())
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
  return $join;
}

function custom_search_groupby($groupby){
  global $wpdb;

  // we need to group on post ID
  $groupby_id = "{$wpdb->posts}.ID";
  if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

  // groupby was empty, use ours
  if(!strlen(trim($groupby))) return $groupby_id;

  // wasn't empty, append ours
  return $groupby.", ".$groupby_id;
}

/*add_filter('posts_where','custom_search_where');
add_filter('posts_join', 'custom_search_join');
add_filter('posts_groupby', 'custom_search_groupby');*/

/* DON'T DELETE THIS CLOSING TAG */ ?>
