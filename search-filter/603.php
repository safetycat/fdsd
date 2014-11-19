<?php
/**
 * Search & Filter Pro 
 *
 *  Results Template
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
		<?php
											echo '<li class="d-1of3 t-1of3 .m-all">';
											the_post_thumbnail( 'idea-thumb' );
											echo "<div class='ideabox'>";
											echo "<h3 class=''><a href='" . get_permalink() . "'>" . get_the_title( ) . "</a></h3>";
											echo '</div></li>';
											
										
								?>
		
		
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