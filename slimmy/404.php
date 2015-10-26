<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Slimmy
 */
get_header();
?>  

	<div class="units-row unit-100">

				<h1 class="page-title"><?php
_e('Not found', 'slimmy');
?></h1>

					<h2><?php
_e('This is somewhat embarrassing, isn&rsquo;t it?', 'slimmy');
?></h2>
					<p><?php
_e('It looks like nothing was found at this location. Maybe try a search?', 'slimmy');
?></p>

					<?php
get_search_form();
?>

	</div>

<?php
get_footer();
?>