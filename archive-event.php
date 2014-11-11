<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">

						<h1 class="archive-title"><i class="fa fa-calendar"></i><?php post_type_archive_title(); ?></h1>

						<?php
						// Only show posts with start date in the future
						// order with first up first...

						
					//global $wp_query;
					//$argss = array_merge( $wp_query->query_vars, array( 'post_type' => 'event' ) );
					//query_posts( $args );


						if ( !is_year()){
							$status = "future";

						} else { $status = "publish,future";}

						//print_r($wp_query->query_vars);

						// $args = array_merge( $wp_query->query_vars, array(
						// 	'post_status' => array('future'),
						// 	'post_type'		=> 'event',
						// 	'posts_per_page'	=> -1,
							
						// 	'order'			=> 'ASC',


						// ));

						//$posts = query_posts($args); 

						global $query_string;
						$posts = query_posts( $query_string . '&post_type=event&order=ASC&post_status=' . $status  );

						?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard">
										Date: <?php echo get_post_time('F jS, Y'); ?>									
										
									</p>

								</header>

								<section class="entry-content cf">

									<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
									
									
								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
