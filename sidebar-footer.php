<?php
/**
 * The footer widgets
 *
 * @package Slimmy
 *
 */
if (!is_active_sidebar('left_column') && !is_active_sidebar('right_column'))
    return;
?>

<div id="blocks" class="units-row unit-padding end">
	<div class="block-left unit-50">
		<?php
if (is_active_sidebar('left_column') && dynamic_sidebar('left_column')):
else:
?>
        <?php
endif;
?> 
	</div>
	<div class="block-right unit-50">
		<?php
if (is_active_sidebar('right_column') && dynamic_sidebar('right_column')):
else:
?>
        <?php
endif;
?>
	</div>				
</div>
