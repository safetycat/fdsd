<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<h1 class="archive-title"><span><?php _e( 'Search Results for Ideas in Action', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>



<?php echo do_shortcode('[searchandfilter id="603"]');

//echo do_shortcode('[searchandfilter id="610"]');
	//echo do_shortcode('[searchandfilter id="610"  show="results"]');   ?>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										

								</header>

								<section class="entry-content">
										<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
										<?php // Links
						                    if( have_rows('link') ):
						                      while ( have_rows('link') ) : the_row();
						                        echo ("<div class='link-btn'><i class='fa fa-external-link'></i><a href='" . get_sub_field('url') . "' >" . get_sub_field('url') . "</a></div>");
						                        //the_sub_field('document');
						                      endwhile;
						                  endif;
						                 ?>
								</section>

								<footer class="article-footer">
									
									<?php if(get_the_category_list(', ') != ''): ?>
                  					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
                  					<?php endif; ?>

                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                 					<?php 
                 					$topics = get_the_term_list( $post->ID, 'topics', 'Topics: ', ', ' ); 
							 		echo ("<div class='pub-meta tax-topics'>" . $topics . "</div>");

							 		$themes = get_the_term_list( $post->ID, 'themes', 'Themes: ', ', ' ); 
							 		echo ("<div class='pub-meta tax-themes'>" . $themes . "</div>");

							 		
							 		?>
								</footer> <!-- end article footer -->

							</article>

						<?php endwhile; ?>

								<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Sorry, No Results.', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
