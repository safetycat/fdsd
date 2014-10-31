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
		<div>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			 <?php if ('publication' == get_post_type() ){
					
						/*// Display Authors
				 		$authors = wp_get_post_terms($post->ID, 'authors', array("fields" => "names"));
					 	if($authors){
					 		echo "<div class='authors pub-meta'>Authors: ";
					 		$count = count($authors);
					 		for($i=0; $i<$count; $i++){
		    					echo $authors[$i]; 
		    					if($i<=$count-2) {echo ", ";}
							}
							echo "</div>";
				 		}
						// Display Year of publication
				 		$years = wp_get_post_terms($post->ID, 'pub_year', array("fields" => "names"));
					 	if($years){
					 		echo "<div class='years pub-meta'>Year of Publication: ";
					 		foreach( $years as $year ) {
		    					echo $year . ' '; // Added a space between the slugs with . ' '
							}
							echo "</div>";
				 		}*/
				 		echo "<div class='pubmetabox'>";
				 		$authors = get_the_term_list( $post->ID, 'authors', 'Authors: ', ', ' ); 
						echo ("<div class='pub-meta tax-authors'>" . $authors . "</div>");

						$years = get_the_term_list( $post->ID, 'pub_year', 'Year of Publication: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-years'>" . $years . "</div>");

				 		$topics = get_the_term_list( $post->ID, 'topics', 'Topics: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-topics'>" . $topics . "</div>");

				 		$themes = get_the_term_list( $post->ID, 'themes', 'Themes: ', ', ' ); 
				 		echo ("<div class='pub-meta tax-themes'>" . $themes . "</div>");

				 		echo "</div>";



					} // end if publication
			?>

			<?php the_excerpt(); ?>
			<?php 
				if ( has_post_thumbnail() ) {
					echo '<p>';
					the_post_thumbnail("small");
					echo '</p>';
				}
			?>
			
			<!-- <p><?php the_tags(); ?><p>
			<p><small><?php the_date(); ?></small><p> -->
				<span class="readmore">Read More</span>
			<?php if ('publication' == get_post_type() ){ echo "<span class='download'>Download</span>"; } ?>
		</div>
		
		
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