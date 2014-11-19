<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-all d-all cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();

										echo do_shortcode('[searchandfilter id="603"]'); 


										 // if( isset($_POST['_sf_submitted']) ){
										 // 	echo "post";
										 // echo do_shortcode('[searchandfilter id="603" show="results"]');
										 // }
										 	


										// Custom Query Here.
										/* The 2nd Query (without global var) */
										echo "<div id='ideas_grid' > ";
										$args = array(
											'post_type'  => 'idea',
											'posts_per_page' => 9,
											'meta_query' => array(
												array(
													'key'     => 'featured_idea',
													'value'   => '',
													'compare' => '!=',
												),
											),
										);
										$query2 = new WP_Query( $args );

										// The 2nd Loop
										while ( $query2->have_posts() ) {
											$query2->next_post();
											$query2_id = $query2->post->ID;
											echo '<li class="d-1of3 t-1of3 m-all"><a href="' . get_permalink($query2_id ) . '">';
											echo get_the_post_thumbnail($query2_id, 'idea-thumb' );
											echo "</a><div class='ideabox'>";
											echo "<h3 class=''><a href='" . get_permalink($query2_id ) . "'>" . get_the_title( $query2_id ) . "</a></h3>";
											echo '</div></li>';
											$featured = get_post_meta($query2_id, 'featured_idea', true);
											//print_r($featured[0]);
										}

										// Restore original Post Data
										wp_reset_postdata();



										?>
									</div>

								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						

				</div>

			</div>

<?php get_footer(); ?>
