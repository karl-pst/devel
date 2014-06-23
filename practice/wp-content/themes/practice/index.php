<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Practice
 * @since 2014
 */

get_header(); ?>

<div class="content-wrapper">
	<div class="content">		
		<?php

			if (have_posts()){
				while (have_posts()){
					the_post();
										
					//the_content();
					$post_date = date_create($post->post_date);
						
					echo "<h2 id='post-" . $post->ID . "'>";
					echo "<a href='" . $post->guid . "' rel='bookmark' title='Permanent Link to " . $post->post_name . "'>";
					echo $post->post_title . "</a></h2>";
					echo "<small>" . date_format($post_date, 'F j, Y') . " <!-- by " . $post->post_author . "--></small>";

					echo "<div class='entry'>";
					echo "<p>" . $post->post_content . "</p>"; 
					echo "</div>";

		
					echo "<pre>";
					//print_r($post);
					echo "</pre>";
				}
			}
		?>
	</div><!--#content-->

	<?php get_sidebar('right'); ?>
</div><!--#wrapper-->

<?php
get_footer();
?>