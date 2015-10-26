<?php
/**
 * The home template file.
 *
 * @package Slimmy
 */
get_header();
?>





<div class="units-row end">
	<aside class="unit-30 unit-padding">
		<?php get_sidebar(); ?>
	</aside>	
	<div class="unit-70">
		<?php 
		$loopcounter = 0;
		if (have_posts()): while (have_posts()): the_post(); 
			if ($loopcounter > 0): break; endif;
		/* First post will always be a pinned welcome page.
		 * Second, third, fourth posts will always be the most recent post from categories:  Event, Announcement, Activities.
		 * These three posts will be displayed below the welcome message (modified pinned post) in a 3 column format.
		 * There will be a link below these 3 articles to view more articles in standard blog-format.
     		*/ ?>
     		
			<?php if (in_category('Events')) : ?>
				<div class="post-category-events" <?php post_class(); ?>>
			<?php elseif (in_category('Activities')) : ?>
				<div class="post-category-activities" <?php post_class(); ?>>
			<?php elseif (in_category('Announcements')) : ?>
				<div class="post-category-announcements" <?php post_class(); ?>>
			<?php elseif (in_category('Welcome')) : ?>
				<div class="post-category-welcome" <?php post_class(); ?>>
			<?php else: ?>
				<div class="post-category-other" <?php post_class(); ?> >
			<?php endif; ?>
			<?php
				if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
				}
			?>
			<?php the_content(); ?>
		</div>
		<hr>
	  	<?php
			
			$loopcounter++;
			endwhile;
			else:
		?>
		<p>
			<?php _e('Sorry, there are no posts.', 'slimmy'); ?>
		</p>
			<?php endif; ?>								    
	</div>
	<div class="unit-70"> 
		<div class="unit-30" id="thumb-announcements" >
			<?php
				$announcementspreviewcounter = 0;
				$cat_name = "announcements";
				$latest_cat_post = new WP_Query( array('category_name' => $cat_name));
				if ($latest_cat_post->have_posts()) : while ($latest_cat_post->have_posts()) : $latest_cat_post->the_post(); $announcementspreviewcounter++; ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="top_meta"><em><?php _e('Posted on', 'slimmy');?>
						<a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format'));?></a></em> 
						<?php _e('By', 'slimmy'); ?> 
						<?php the_author_posts_link(); ?>
					</p>
					<?php the_excerpt(); ?>
					<p class="after_meta"><i class="el-icon-folder-open"></i> 
						<?php the_category(' &bull; '); ?> 
						<?php echo get_the_tag_list(' &nbsp &nbsp <i class="el-icon-tags"></i> ', ', '); ?> 
					</p> <?php
					if ($announcementspreviewcounter > 0): break; endif;
				endwhile;
				endif;
			?>
		</div>
		<div class="unit-30" id="thumb-events" >
			<?php
				$eventpreviewcounter = 0;
				$cat_name = "events";
				$latest_cat_post = new WP_Query( array('category_name' => $cat_name));
				if ($latest_cat_post->have_posts()) : while ($latest_cat_post->have_posts()) : $latest_cat_post->the_post(); $eventpreviewcounter++; ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="top_meta"><em><?php _e('Posted on', 'slimmy');?>
						<a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format'));?></a></em> 
						<?php _e('By', 'slimmy'); ?> 
						<?php the_author_posts_link(); ?>
					</p>
					<?php the_excerpt(); ?>
					<p class="after_meta"><i class="el-icon-folder-open"></i> 
						<?php the_category(' &bull; '); ?> 
						<?php echo get_the_tag_list(' &nbsp &nbsp <i class="el-icon-tags"></i> ', ', '); ?> 
					</p> <?php
					if ($eventpreviewcounter > 0): break; endif;
				endwhile;
				endif;
			?>
		</div>
		<div class="unit-30" id="thumb-activities" >
			<?php
				$activitiespreviewcounter = 0;
				$cat_name = "activities";
				$latest_cat_post = new WP_Query( array('category_name' => $cat_name));
				if ($latest_cat_post->have_posts()) : while ($latest_cat_post->have_posts()) : $latest_cat_post->the_post(); $activitiespreviewcounter++ ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="top_meta"><em><?php _e('Posted on', 'slimmy');?>
						<a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format'));?></a></em> 
						<?php _e('By', 'slimmy'); ?> 
						<?php the_author_posts_link(); ?>
					</p>
					<?php the_excerpt(); ?>
					<p class="after_meta"><i class="el-icon-folder-open"></i> 
						<?php the_category(' &bull; '); ?> 
						<?php echo get_the_tag_list(' &nbsp &nbsp <i class="el-icon-tags"></i> ', ', '); ?> 
					</p> <?php
					if ($activitiespreviewcounter > 0): break; endif;
				endwhile;
				endif;
			?>
		</div>
	</div>


</div>
		
<?php
get_footer();
?>
