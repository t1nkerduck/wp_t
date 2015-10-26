<?php
/**
 * The template for displaying all pages.
 *
 * @package Slimmy
 */
get_header();
?>

<div class="units-row end">
		<aside class="unit-30 unit-padding">
			    <?php
get_sidebar();
?>
	</aside>
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

	  	<?php
        the_content();
?>
	  	
	  	</div>
	  	<div class="clearfix"></div>
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
