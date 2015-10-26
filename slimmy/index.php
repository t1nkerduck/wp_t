<?php
/**
 * The main template file.
 *
 * This template was originally based upon the Slimmy Wordpress theme.
 * It has now been butchered beyond all recognition by Sarah Gori.
 * For any questions or concerns, please contact sarah.gori@gmail.com
 * 
 */
get_header();
?>


<div class="units-row end">
	<aside class="unit-30 unit-padding">
	    <?php get_sidebar(); ?>
	</aside>

	<div class="unit-70">
		<?php
		if (have_posts()):
			while (have_posts()):
				the_post();
		?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="top_meta"><em><?php _e('Posted on', 'slimmy'); ?> 

				<a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a></em> 
				<?php
					_e('By', 'slimmy');
					the_author_posts_link();
				?>
			</p>

			<?php
				if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
				}	
			the_post();
			edit_post_link();
			//wp_link_pages();
			?>
		</div>
		<hr>
		<?php
			endwhile;
			else:
		?>
		<p>
			<?php _e('Sorry, no posts matched your criteria.', 'slimmy'); ?>
		</p>
		<?php
			endif;
		?>

		<ul class="pagination"> 
			<li><?php next_posts_link(__('&larr; Older Entries', 'slimmy')); ?></li>
			<li class="next"><?php previous_posts_link(__('Newer Entries &rarr;', 'slimmy')); ?></li>
		</ul>
	</div>
</div>
<?php
get_footer();
?>
