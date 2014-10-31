<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2014 Designs & Code
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
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

			<p class="byline vcard">
                    <?php 
                    
                    $years = get_the_term_list( $post->ID, 'pub_year', 'Published: ', ', ' ); 
                    echo ("<div class='pub-meta tax-years'>" . $years . "</div>");

                    $authors = get_the_term_list( $post->ID, 'authors', 'Author(s): ', ', ' ); 
                    echo ("<div class='pub-meta tax-authors'>" . $authors . "</div>");


                    ?>
                  
                  </p>
		</header>

			

			<?php the_excerpt(); ?>


			<?php 
				if ( has_post_thumbnail() ) {
					echo '<p>';
					the_post_thumbnail("small");
					echo '</p>';
				}
			?>


			<?php if ('publication' == get_post_type() ){ echo "<span class='download btn'>Download</span>"; } ?>

			<!-- <p><?php the_tags(); ?><p>
			<p><small><?php the_date(); ?></small><p> -->



				<span class="readmore"><a href="<?php the_permalink(); ?>">Read More</a></span>
			

			 <?php if ('publication' == get_post_type() ){
				
				 	

				 		$topics = get_the_term_list( $post->ID, 'topics', 'Topics: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-topics'>" . $topics . "</div>");

				 		$themes = get_the_term_list( $post->ID, 'themes', 'Themes: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-themes'>" . $themes . "</div>");

				 		echo "</div>";



					} // end if publication
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