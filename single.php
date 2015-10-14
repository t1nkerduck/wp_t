<?php
/**
 * The template for displaying all single posts.
 *
 * @package Slimmy
 */
get_header();
?>

<div class="units-row end">
	<article class="unit-70">
			    <?php
if (have_posts()):
    while (have_posts()):
        the_post();
?>
			    
<div id="post-<?php
        the_ID();
?>" <?php
        post_class();
?>>
	
<h1><?php
        the_title();
?></h1>

<p class="top_meta"><em><?php
        _e('Posted on', 'slimmy');
?> <a href="<?php
        the_permalink();
?>"><?php
        the_time(get_option('date_format'));
?></a></em> <?php
        _e('By', 'slimmy');
?> <?php
        the_author_posts_link();
?></p>

<?php
        if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
            the_post_thumbnail();
        }
?>

<?php
        the_content();
?>

<?php
        edit_post_link();
?>

<p class="after_meta"><i class="el-icon-folder-open"></i> <?php
        the_category(' &bull; ');
?> <?php
        echo get_the_tag_list(' &nbsp &nbsp <i class="el-icon-tags"></i> ', ', ');
?> </p>

<?php
        posts_nav_link();
?>

<ul class="pagination"> 
<li><?php
        previous_post_link(' &larr; %link');
?></li>
<li class="next"><?php
        next_post_link(' %link &rarr;');
?></li> 
</ul>

</div>
	  	
	  	<hr>
	  	
	  	<?php
        comments_template('', true);
?>
	  	
	  	<?php
    endwhile;
else:
?>
		<p><?php
    _e('Sorry, this page does not exist.', 'slimmy');
?></p>
	<?php
endif;
?>
	
	<?php
wp_link_pages(array(
    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'slimmy') . '</span>',
    'after' => '</div>',
    'link_before' => '<span>',
    'link_after' => '</span>'
));
?>
										    
	</article>
	<aside class="unit-30 unit-padding">
			    <?php
get_sidebar();
?>
	</aside>
</div>
</div>
		
<?php
get_footer();
?>