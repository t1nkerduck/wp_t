<?php
/**
 * Template Name: Full Width
 *
 * @package Slimmy
 */
?>
<?php
get_header();
?>

<div class="units-row">
	<article class="unit-100">
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
</div>
</div>
		
<?php
get_footer();
?>