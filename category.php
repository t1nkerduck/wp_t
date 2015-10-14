<?php
/**
 * The template for displaying category pages.
 *
 * @package Slimmy
 */
get_header();
?>

<div class="units-row end">
	<article class="unit-70">
		<h2><?php
single_cat_title('', true);
?></h2>
		<hr>
		<?php
$category_description = category_description();
if (!empty($category_description))
    echo '<div class="archive-meta">' . $category_description . '</div>';
get_template_part('loop', 'category');
?>
                
                <?php
if (have_posts()):
    while (have_posts()):
        the_post();
?>
                
		<h2><a href="<?php
        the_permalink();
?>"><?php
        the_title();
?></a></h2>
		
	  	<?php
        the_excerpt();
?>
	  	
	  	<hr>
	  	
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