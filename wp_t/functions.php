<?php

/**
 * Slimmy functions and definitions
 *
 * @package Slimmy
 */

/**
 * Enqueue scripts and styles.
 */
function slimmy_scripts() {
	wp_enqueue_style('slimmy-googleFonts', '//fonts.googleapis.com/css?family=Cabin+Condensed|Oswald:400,300', false);
    wp_enqueue_style('slimmy-style-kube', get_template_directory_uri() . '/css/kube.css', false);
    wp_enqueue_style('slimmy-style-elusive-webfont', get_template_directory_uri() . '/css/elusive-webfont.css', false);
    wp_enqueue_style('slimmy-style', get_stylesheet_uri());
    
    wp_enqueue_script('slimmy-custom-script', get_template_directory_uri() . '/js/misc.js', array(
        'jquery'
    ), true);
    
    if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'slimmy_scripts');

// Register Sidebar
function slimmy_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'slimmy'),
        'id' => 'sidebar-1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Left Footer Column', 'slimmy'),
        'id' => 'left_column',
        'description' => __('Widget area for footer left column', 'slimmy'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
        'name' => __('Right Footer Column', 'slimmy'),
        'id' => 'right_column',
        'description' => __('Widget area for footer right column', 'slimmy'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}
add_action('widgets_init', 'slimmy_widgets_init');

// Register Menu	
function slimmy_register_menu() {
    register_nav_menu('header-menu', __('Header Menu', 'slimmy'));
}
add_action('init', 'slimmy_register_menu');

// Define content width
if (!isset($content_width)) {
    $content_width = 511;
}

// Add theme support
function slimmy_custom_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-background', apply_filters('slimmy_custom_background_args', array(
        'default-color' => '#f4f4f4',
        'default-image' => ''
    )));
    add_theme_support('custom-header');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'slimmy_custom_theme_setup');

// Add support for flexible headers
$header_args = array(
    'default-image' => '',
    'default-text-color'     => '#333333',
    'random-default' => false,
    'flex-height' => true,
    'height' => 150,
    'flex-width' => true,
    'width' => 780
);
add_theme_support('custom-header', $header_args);

function slimmy_comment_layout($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
?>

<?php
}

// Make theme translatable	
load_theme_textdomain('slimmy', get_template_directory() . '/languages');

// Custom editor style
function slimmy_add_editor_styles() {
    add_editor_style('/custom-editor-style.css');
}
add_action('after_setup_theme', 'slimmy_add_editor_styles');

// Allow HTML In Category description
foreach (array(
    'pre_term_description'
) as $filter) {
    remove_filter($filter, 'wp_filter_kses');
}
foreach (array(
    'term_description'
) as $filter) {
    remove_filter($filter, 'wp_kses_data');
}

// Changing excerpt more
function slimmy_excerpt_more($more) {
    global $post;
    return '... <a href="' . get_permalink($post->ID) . '">' . '<p><button class="btn btn-smaller btn-outline in_cat">' . __('Read More', 'slimmy') . '</button></p>' . '</a>';
}
add_filter('excerpt_more', 'slimmy_excerpt_more');

// Custom search form
function slimmy_search_form($form) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
	<input type="text" class="input-search input-search-icon width-100" placeholder="Search" value="' . get_search_query() . '" name="s" id="s" />
	</form>';
    
    return $form;
}
add_filter('get_search_form', 'slimmy_search_form');

// Responsive Youtube
add_filter('embed_oembed_html', 'slimmy_embed_oembed_html', 99, 4);
function slimmy_embed_oembed_html($html, $url, $attr, $post_id) {
    return '<div class="video-wrapper">' . $html . '</div>';
}

// Adding Options to Customizer
function slimmy_customize_register($wp_customize) {
	
	// remove control
	$wp_customize->remove_control('header_textcolor');
	
    //* Custom Colors	
    $colors   = array();
    $colors[] = array(
        'slug' => 'header_text_color',
        'default' => '#333333',
        'label' => __('Header Text Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'menu_color',
        'default' => '#3b7687',
        'label' => __('Menu Background Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'menu_link_color',
        'default' => '#c5d6db',
        'label' => __('Menu Link Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'content_text_color',
        'default' => '#444',
        'label' => __('Content Text Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'content_link_color',
        'default' => '#134da5',
        'label' => __('Content Link Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'post_title_color',
        'default' => '#869841',
        'label' => __('Post Title Color', 'slimmy')
    );
    $colors[] = array(
        'slug' => 'subheading_color',
        'default' => '#3b7687',
        'label' => __('Subheading Color', 'slimmy')
    );
    foreach ($colors as $color) {
        
        $wp_customize->add_setting($color['slug'], array(
            'default' => $color['default'],
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array(
            'label' => $color['label'],
            'section' => 'colors',
            'settings' => $color['slug']
        )));
    }
    
    // Custom Logo
    $wp_customize->add_section('slimmy_logo_section', array(
        'title' => __('Logo', 'slimmy'),
        'priority' => 30,
        'description' => __('Upload a logo to replace the default site name and description in the header', 'slimmy')
    ));
    
    $wp_customize->add_setting('slimmy_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'slimmy_logo', array(
        'label' => __('Logo', 'slimmy'),
        'section' => 'slimmy_logo_section',
        'settings' => 'slimmy_logo'
    )));
    
    // Custom Footer text
    class Slimmy_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
        public function render_content() {
?>

  <label>
    <span class="customize-control-title"><?php
            echo esc_html($this->label);
?></span>
    <textarea rows="5" style="width:100%;" <?php
            $this->link();
?>><?php
            echo esc_textarea($this->value());
?></textarea>
  </label>

<?php
        }
    }
    $wp_customize->add_section('slimmy_footer', array(
        'title' => __('Footer', 'slimmy'),
        'description' => __('You can use a and br HTML tags.', 'slimmy'),
        'priority' => 100
    ));
    $wp_customize->add_setting('slimmy_footer_text', array(
        'default' => '',
        'sanitize_callback' => 'slimmy_sanitize_text'
    ));
    $wp_customize->add_control(new Slimmy_Customize_Textarea_Control($wp_customize, 'slimmy_footer_text', array(
        'label' => __('Footer Text', 'slimmy'),
        'section' => 'slimmy_footer',
        'priority' => 11
    )));
    $wp_customize->add_setting('slimmy_hide_credit', array(
        'default' => '',
        'sanitize_callback' => 'slimmy_sanitize_checkbox'
    ));
    $wp_customize->add_control('slimmy_hide_credit', array(
        'label' => __('Hide Credit', 'slimmy'),
        'section' => 'slimmy_footer',
        'type' => 'checkbox',
        'priority' => 12
    ));
}
add_action('customize_register', 'slimmy_customize_register');

// Custom Sanitize Functions for Customizer
function slimmy_sanitize_checkbox($value) {
    if ($value == 1) {
        return 1;
    } else {
        return '';
    }
}

function slimmy_sanitize_text($value) {
    $value = wp_kses($value, array(
        'a' => array(
            'href' => array(),
            'target' => array(),
            'rel' => array()
        ),
        'br' => array()
    ));
    return $value;
}

// Output Custom Styles to the header
function slimmy_customizer_css() {	
?>
    <style type="text/css">
	    <?php
    if ($header_text_color = get_theme_mod('header_text_color')):
?>
        #header h1 a, .tagline { color: <?php
        echo esc_attr($header_text_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($content_link_color = get_theme_mod('content_link_color')):
?>
        a { color: <?php
        echo esc_attr($content_link_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($menu_link_color = get_theme_mod('menu_link_color')):
?>
        #header nav a { color: <?php
        echo esc_attr($menu_link_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($content_text_color = get_theme_mod('content_text_color')):
?>
        body { color: <?php
        echo esc_attr($content_text_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($menu_color = get_theme_mod('menu_color')):
?>
        #header nav, #header nav ul ul.sub-menu, #header nav ul ul.children { background: <?php
        echo esc_attr($menu_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($post_title_color = get_theme_mod('post_title_color')):
?>
        #main h1 { color: <?php
        echo esc_attr($post_title_color);
?>; }
        <?php
    endif;
?>
        <?php
    if ($subheading_color = get_theme_mod('subheading_color')):
?>
        #main h2, h3, h4, h5 { color: <?php
        echo esc_attr($subheading_color);
?>; }
        <?php
    endif;
?>  
<?php
	if ( ! display_header_text() ) :
?>
		#header h1 a, .tagline {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	    <?php 
    endif;
?>        	    
    </style>
    <?php
}
add_action('wp_head', 'slimmy_customizer_css');

?>

<?php 
	function display_post() {
			//Note:  Will need to refactor to echo instead of display PHP code			
			//display a single post - begin
			//assigns post div a class based on key categories:  Events, Activities, Announcements.
			?>
			
			<!-- commenting out all HTML, and DO NOT CALL THIS FUNCTION until this is cleaned up
			
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
				//note:  removed adding "the_ID() to div ID
			?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="top_meta"><em><?php _e('Posted on', 'slimmy');?>
				<a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format'));?></a></em> 
				<?php _e('By', 'slimmy'); ?> 
				<?php the_author_posts_link(); ?>
			</p>
			<?php
				if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
				}
			?>
			<?php the_content(); ?>
			<p class="after_meta"><i class="el-icon-folder-open"></i> 
				<?php the_category(' &bull; '); ?> 
				<?php echo get_the_tag_list(' &nbsp &nbsp <i class="el-icon-tags"></i> ', ', '); ?> 
			</p>
		</div>
		<hr>
		// the pagination class calls the next posts to be displayed in the while loop
		    
		<ul class="pagination"> 
				<li><?php next_posts_link(__('&larr; Older Entries', 'slimmy')); ?></li>
			<li class="next">
				<?php previous_posts_link(__('Newer Entries &rarr;', 'slimmy')); ?>
			</li>
		</ul>	
		
		-->
		<?php
			//display a single post - end
	}
?>
