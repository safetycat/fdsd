<?php
/**
 * Search & Filter Pro 
 *
 *  Results Template
 * 
 *
 */

if ( $query->have_posts() )
{
	?>
	
	Found <?php echo $query->found_posts; ?> Results<br />
	Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br />
	
	<?php sf_pagination_prev_next($query->query['paged'], $query->max_num_pages); ?><br />
	<?php sf_pagination_numbers($query->query['paged'], $query->max_num_pages, " "); ?>

	<?php
	while ($query->have_posts())
	{
		$query->the_post();
		global $post;
		
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
<?php
			$publication_type = get_the_terms( $post->ID, 'publication_type', '', ', ' ); 
                    $publication_type =(array_pop($publication_type));

                    echo ("<div class='pub-meta tax-pub_type'>" . $publication_type->name. "</div>");
?>

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			
                    <?php 
                    
                    $years = get_the_term_list( $post->ID, 'pub_year', 'Published: ', ', ' ); 
                    echo ("<div class='pub-meta tax-years'>" . $years . "</div>");

                    $authors = get_the_term_list( $post->ID, 'authors', 'Author(s): ', ', ' ); 
                    echo ("<div class='pub-meta tax-authors'>" . $authors . "</div>");


                    ?>
                  
                 
		</header>

			<?php 
				if ( has_post_thumbnail() ) {
					echo '<p>';
					the_post_thumbnail("small");
					echo '</p>';
				}
			?>			

			<?php the_excerpt(); ?>


				<span class="readmore btn"><a href="<?php the_permalink(); ?>">Read More <i class='fa fa-caret-right' ></i></a></span>




			<?php  // Download - can be multiple
                  if( have_rows('download') ):
                      while ( have_rows('download') ) : the_row();
                        echo ("<div class='btn'><a href='" . get_sub_field('document') . "' >Download <i class='fa fa-download' ></i></a></div>");
                        //the_sub_field('document');
                      endwhile;
                  endif;
 ?>

			<!-- <p><?php the_tags(); ?><p>
			<p><small><?php the_date(); ?></small><p> -->


			

			 
				<?php
				 	

				 		$topics = get_the_term_list( $post->ID, 'topics', 'Topics: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-topics'>" . $topics . "</div>");

				 		$themes = get_the_term_list( $post->ID, 'themes', 'Themes: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-themes'>" . $themes . "</div>");

				 		echo "</div>";



					
			?>


		</article>
		
		
		<?php
	}
	?>
	Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br />
	
	<?php sf_pagination_prev_next($query->query['paged'], $query->max_num_pages); ?>
	<?php sf_pagination_numbers($query->query['paged'], $query->max_num_pages, " "); ?>
	
	<?php
}
else
{
	echo "No Results Found";
}
?>