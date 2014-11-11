    <?php
    /*
    Plugin Name: Single Post
    Plugin URI: http://ch4ze.com
    Description: Define a widget for displaying a single post
    Author: Chase Crawford
    Author URI: http://ch4ze.com
    Version: 0.1
    */
     
     
    class singlePostWidget extends WP_Widget
	    {
	    	function thissinglePostWidget()
		    {
		    	$widget_ops = array('classname' => 'thissinglePostWidget', 'description' => 'Displays a single post' );
		    	$this->WP_Widget('thissinglePostWidget', 'FDSD Single Post', $widget_ops);
	   		}
     
		    function form($instance)
			    {
				    $instance = wp_parse_args( (array) $instance, array( 'pid' => '' ) );
				    $pid = $instance['pid'];
				    if($pid == '') {
				     
					    $args = array(
					    'post_type' => 'post'
					    );
					    $the_query = new WP_Query($args);
					    print '<select name="' . $this->get_field_name('pid') . '"><option value ="">Choose a post to display</option>';
					    while ( $the_query->have_posts() ) :
					    	$the_query->the_post();
					     
					    	print '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
					     
					    endwhile;
					    print '</select>';
					     
					} else {
					     
				    	$post = query_posts('p=' . $pid);
				    	while ( have_posts() ) : the_post();
				     
				    		print "<strong>" . get_the_title() . "</strong>";
				     
				    	endwhile;
				     
				    }
			     
			    }
	     
		    function update($new_instance, $old_instance)
			    {
				    $instance = $old_instance;
				    $instance['pid'] = $new_instance['pid'];
				    return $instance;
				}
		     
		    function widget($args, $instance)
			    {
				    extract($args, EXTR_SKIP);
		     
				    $post = query_posts('p=' . $instance['pid']);
				    while ( have_posts() ) : the_post();
		     
		    /*=======================================================
		      add template code to display your post here
		      =======================================================*/
		      the_content();
		     
				    endwhile;
		     
	     
	    		}
     
   		}
    add_action( 'widgets_init', create_function('', 'return register_widget("thissinglePostWidget");') );



    ?>