<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Slimmy
 *
 */
?>
<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])):
?>  	
	<?php
    die(__('You can not access this page directly!', 'slimmy'));
?>  
<?php
endif;
?>

<?php
if (post_password_required())
    return;
?>

<ol class="commentlist">
<?php
wp_list_comments();
?>
</ol>
	
	<ul class="pagination">
<li><?php
previous_comments_link(__('&larr; Older Comments', 'slimmy'));
?></li>
			<li><?php
next_comments_link(__('Newer Comments &rarr;', 'slimmy'));
?></li>
</ul>

<?php
if (!comments_open() && get_comments_number()):
?>
		<p><?php
    _e('Comments are closed.', 'slimmy');
?></p>
		<?php
endif;
?>

<?php
if (comments_open()):
?>
	<?php
    if (get_option('comment_registration') && !$user_ID):
?>
		<p><?php
        _e('You must be', 'slimmy');
?><a href="<?php
        echo get_option('siteurl');
?>/wp-login.php?redirect_to=<?php
        echo urlencode(get_permalink());
?>"><?php
        _e('logged in</a> to post a comment.', 'slimmy');
?></p><?php
    else:
?>
		
		<?php
        comment_form();
?>
		
		<?php
    endif;
?>
		
		<?php
endif;
?>