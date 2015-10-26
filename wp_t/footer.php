<?php
/**
* The template for displaying the footer.
*
* @package Slimmy
*/
?>
<footer id="footer"> 
	
	<?php
    get_sidebar('footer');
?>
	<div id="attr" class="units-row unit-padding end">
	<div class="unit-100">
		
		<?php
    if (get_theme_mod('slimmy_footer_text')):
?>
				<div class="footer-text">
					<?php
        echo get_theme_mod('slimmy_footer_text');
?>
				</div>
				<?php
    endif;
?>
				
				<?php
    if (!get_theme_mod('slimmy_hide_credit')):
?>
				<div class="site-credit">
				    <?php
        printf(__('Powered by <a href="%1$s">%2$s</a>', 'slimmy'), esc_url(__('http://wordpress.org/', 'slimmy')), 'WordPress');
?>
				<span class="separator"> | </span>
					<?php
        printf(__('Theme by <a href="%1$s">%2$s</a>', 'slimmy'), esc_url(__('http://www.vetrazdesigns.com/wordpress/', 'slimmy')), 'Vetraz Designs');
?>
					</div>
				<?php
    endif;
?>
	</div>
	</div>
</footer>
	</div>
	<?php
    wp_footer();
?>
</body>
</html>