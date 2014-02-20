<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*******************************************************
 * FOR DOCUMENTATION ON TITAN FRAMEWORK, VISIT
 * http://www.titanframework.net
 *******************************************************/

/*******************************************************
 * TITAN FRAMEWORK CODE START
 *******************************************************/
/*
 * Check if the plugin is activated. Our site will blow up if we don't have the plugin.
 * Prevent the site from loading to supress the errors.
 */
if ( ! class_exists( 'TitanFramework' ) ) {
    if ( ! class_exists( 'TitanFrameworkThemeChecker' ) ) {
        class TitanFrameworkThemeChecker {
            function __construct() {
                if ( ! is_admin() ) {
                    add_action( 'init', array( $this, 'displaySiteNotification' ) );
                } else {
                    add_filter( 'admin_notices', array( $this, 'displayAdminNotification' ) );
                }
            }

            public function displaySiteNotification() {
                die( __( "This theme requires the plugin Titan Framework. Please install it in the admin first before continuing.", "default" ) );
            }

            public function displayAdminNotification() {
                echo "<div class='error'><p><strong>"
                    . __( "This theme requires the Titan Framework plugin.", "default" )
                    . sprintf( " <a href='%s'>%s</a>",
                        admin_url( "plugin-install.php?tab=search&type=term&s=titan+framework" ),
                        __( "Click here to search for the plugin.", "default" ) )
                    . "</strong></p></div>";
            }
        }
        new TitanFrameworkThemeChecker();
    }
    return;
}


/*
 * Create our admin page
 */

$titan = TitanFramework::getInstance( 'titan-demo-theme' );
$adminPanel = $titan->createAdminPanel( array(
    'name' => 'Sample Admin Panel',
) );


/*
 * Create our normal options tab
 */
$normalTab = $adminPanel->createTab( array(
    'name' => 'Normal Options',
) );
$normalTab->createOption( array(
    'name' => 'My Text Option',
    'id' => 'my_text_option',
    'type' => 'text',
    'desc' => 'This is our option',
    'default' => 'A default value',
) );
$normalTab->createOption( array(
    'name' => 'My Radio Palette Option',
    'id' => 'my_palette_option',
    'type' => 'radio-palette',
    'desc' => 'Choose a style',
    'options' => array(
        array(
            "#69D2E7",
            "#A7DBD8",
            "#E0E4CC",
            "#F38630",
            "#FA6900",
        ),
        array(
            "#D9CEB2",
            "#948C75",
            "#D5DED9",
            "#7A6A53",
            "#99B2B7",
        ),
        array(
            "#3FB8AF",
            "#7FC7AF",
            "#DAD8A7",
            "#FF9E9D",
            "#FF3D7F",
        ),
        array(
            "#D1E751",
            "#FFFFFF",
            "#000000",
            "#4DBCE9",
            "#26ADE4",
        )
    ),
    'default' => '1',
) );
$normalTab->createOption( array(
    'name' => 'My Checkbox Option',
    'id' => 'my_checkbox_option',
    'type' => 'checkbox',
    'desc' => 'This is our option',
    'default' => false,
) );
$normalTab->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color',
    'type' => 'color',
    'desc' => 'Pick a color',
    'default' => '#555555',
) );
$normalTab->createOption( array(
    'name' => 'My Number Option',
    'id' => 'my_number_option',
    'type' => 'number',
    'desc' => 'This is our option',
    'default' => '10',
    'max' => '100',
) );
$normalTab->createOption( array(
    'name' => 'My Multicheck Option',
    'id' => 'my_multicheck_option',
    'type' => 'multicheck',
    'desc' => 'Check whichever applies',
    'options' => array(
        '1' => 'Option one',
        '2' => 'Option two',
        '3' => 'Option three',
    ),
    'default' => array( '2', '3' ),
) );
$normalTab->createOption( array(
    'name' => 'My Select Option',
    'id' => 'my_select_option',
    'type' => 'select',
    'desc' => 'This is our option',
    'options' => array(
        '1' => 'Option one',
        '2' => 'Option two',
        '3' => 'Option three',
    ),
    'default' => '2',
) );
$normalTab->createOption( array(
    'name' => 'My Grouped Select Option',
    'id' => 'my_grouped_select_option',
    'type' => 'select',
    'desc' => 'This is our option',
    'options' => array(
        'Group 1' => array(
            '1' => 'Option one',
            '2' => 'Option two',
        ),
        'Group 2' => array(
            '3' => 'Option three',
        ),
    ),
    'default' => '2',
) );
$normalTab->createOption( array(
    'name' => 'My Editor Option',
    'id' => 'my_editor_option',
    'type' => 'editor',
    'desc' => 'Enter some text',
    'default' => 'Copyright &copy; ' . date('Y') . ' by your company, all rights reserved',
) );
$normalTab->createOption( array(
    'type' => 'save',
) );



/*
 * Create our image upload options tab
 */
$imageTab = $adminPanel->createTab( array(
    'name' => 'Image Upload Option',
) );
$imageTab->createOption( array(
    'name' => 'My Upload Option',
    'id' => 'my_upload_option',
    'type' => 'upload',
    'desc' => 'Upload your image'
) );
$imageTab->createOption( array(
    'name' => 'My Upload Option',
    'id' => 'my_upload_option2',
    'type' => 'upload',
    'desc' => 'Upload your image'
) );
$imageTab->createOption( array(
    'name' => 'My Upload Option',
    'id' => 'my_upload_option3',
    'type' => 'upload',
    'desc' => 'Upload your image'
) );
$imageTab->createOption( array(
    'type' => 'save',
) );



/*
 * Create our textarea options tab
 */
$textareaTab = $adminPanel->createTab( array(
    'name' => 'Textarea Option',
) );
$textareaTab->createOption( array(
    'name' => 'My Textarea Option',
    'id' => 'my_textarea_option',
    'type' => 'textarea',
    'desc' => 'This is our option'
) );
$textareaTab->createOption( array(
    'name' => 'Custom CSS',
    'id' => 'custom_css',
    'type' => 'textarea',
    'desc' => 'Put your additional CSS rules here',
    'is_code' => true,
) );
$textareaTab->createOption( array(
    'type' => 'save',
) );



/*
 * Create our google font options tab
 */
$fontTab = $adminPanel->createTab( array(
    'name' => 'Google Font Option',
) );
$fontTab->createOption( array(
    'name' => 'Heading Font',
    'id' => 'my_heading_font',
    'type' => 'select-googlefont',
    'default' => array(
        'name' => 'Lobster',
        'variants' => array( '400' ),
        'subsets' => array( 'latin' )
    )
) );
$fontTab->createOption( array(
    'type' => 'save',
) );
$fontTab->createOption( array(
    'name' => 'SubHeading Font',
    'id' => 'my_subheading_font',
    'type' => 'select-googlefont',
    'default' => array(
        'name' => 'Open Sans',
        'variants' => array( '400' ),
        'subsets' => array( 'latin' )
    )
) );
$fontTab->createOption( array(
    'type' => 'save',
) );


/*
 * Create our select options tab
 */
$selectTab = $adminPanel->createTab( array(
    'name' => 'Page, Post, Category Options',
) );
$selectTab->createOption( array(
    'name' => 'Select a post',
    'id' => 'my_post_option',
    'type' => 'select-posts',
    'desc' => 'This is an option'
) );
$selectTab->createOption( array(
    'name' => 'My Select Page Option',
    'id' => 'my_selectpage_option',
    'type' => 'select-pages',
    'desc' => 'Select a page'
) );
$selectTab->createOption( array(
    'name' => 'Post Categories',
    'id' => 'my_categories_option',
    'type' => 'select-categories',
    'desc' => 'This is an option'
) );
$selectTab->createOption( array(
    'name' => 'My Posts',
    'id' => 'my_multicheck_option',
    'type' => 'multicheck-posts',
    'desc' => 'Check a post',
) );
$selectTab->createOption( array(
    'name' => 'My Pages',
    'id' => 'my_multicheck_option',
    'type' => 'multicheck-pages',
    'desc' => 'Check a page',
) );
$selectTab->createOption( array(
    'name' => 'My Post Categories',
    'id' => 'my_multicheck_option',
    'type' => 'multicheck-categories',
    'desc' => 'Check a category',
) );
$selectTab->createOption( array(
    'type' => 'save',
) );




/*
 * Create our meta box for pages and posts
 */
$postMetaBox = $titan->createMetaBox( array(
    'name' => 'Sample Post Meta Box',
    'post_type' => 'post',
) );
$postMetaBox->createOption( array(
    'name' => 'My Text Option',
    'id' => 'my_text_option',
    'type' => 'text',
    'desc' => 'This is our option',
    'default' => 'A default value',
) );
$postMetaBox->createOption( array(
    'name' => 'My Checkbox Option',
    'id' => 'my_checkbox_option',
    'type' => 'checkbox',
    'desc' => 'This is our option',
    'default' => false,
) );
$postMetaBox->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color',
    'type' => 'color',
    'desc' => 'Pick a color',
    'default' => '#555555',
) );
$postMetaBox->createOption( array(
    'name' => 'My Number Option',
    'id' => 'my_number_option',
    'type' => 'number',
    'desc' => 'This is our option',
    'default' => '10',
    'max' => '100',
) );


$pageMetaBox = $titan->createMetaBox( array(
    'name' => 'Sample Page Meta Box',
) );
$pageMetaBox->createOption( array(
    'name' => 'My Text Option',
    'id' => 'my_text_option',
    'type' => 'text',
    'desc' => 'This is our option',
    'default' => 'A default value',
) );
$pageMetaBox->createOption( array(
    'name' => 'My Checkbox Option',
    'id' => 'my_checkbox_option',
    'type' => 'checkbox',
    'desc' => 'This is our option',
    'default' => false,
) );
$pageMetaBox->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color',
    'type' => 'color',
    'desc' => 'Pick a color',
    'default' => '#555555',
) );
$pageMetaBox->createOption( array(
    'name' => 'My Number Option',
    'id' => 'my_number_option',
    'type' => 'number',
    'desc' => 'This is our option',
    'default' => '10',
    'max' => '100',
) );



/*
 * Create our theme customizer
 */
$section = $titan->createThemeCustomizerSection( array(
    'name' => 'Sample Section',
    'desc' => 'Change the values below to see the live preview change'
) );
$section->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color4',
    'type' => 'color',
    'default' => '#3498db',
    'livepreview' => '$("article").css("backgroundColor", value);',
) );
$section->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color5',
    'type' => 'color',
    'default' => '#27ae60',
    'livepreview' => '$("#navbar").css("backgroundColor", value);',
) );
$section->createOption( array(
    'name' => 'My Color Picker Option',
    'id' => 'background_color6',
    'type' => 'color',
    'default' => '#8e44ad',
    'livepreview' => '$(".site-title").css("color", value);',
) );
$section->createOption( array(
    'name' => 'Heading Font',
    'id' => 'my_heading_font_customizer2',
    'type' => 'select-googlefont',
    'default' => array(
        'name' => 'Lobster',
        'variants' => array( '400' ),
        'subsets' => array( 'latin' )
    )
) );



/*
 * We add our custom styling here
 */
add_action( 'wp_head', 'titan_demo_head' );
function titan_demo_head() {
    $titan = TitanFramework::getInstance( 'titan-demo-theme' );
    $font = $titan->getOption( 'my_heading_font_customizer2' );
    ?>
    <style>
    h1, h2, h3, h4, h5, h6 {
        <?php echo $font['css'] ?>
    }
    article {
        background-color: <?php echo $titan->getOption( 'background_color4' ) ?>;
    }
    #navbar {
        background-color: <?php echo $titan->getOption( 'background_color5' ) ?>;
    }
    .site-title {
        color: <?php echo $titan->getOption( 'background_color6' ) ?>;
    }
    </style>
    <?php
}
/*******************************************************
 * TITAN FRAMEWORK CODE END
 *******************************************************/






/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
    $content_width = 604;

/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
    require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_setup() {
    /*
     * Makes Twenty Thirteen available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Twenty Thirteen, use a find and
     * replace to change 'twentythirteen' to the name of your theme in all
     * template files.
     */
    load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Switches default core markup for search form, comment form,
     * and comments to output valid HTML5.
     */
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    /*
     * This theme supports all available post formats by default.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
    ) );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 604, 270, true );

    // This theme uses its own gallery styles.
    add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
     * supported by Source Sans Pro, translate this to 'off'. Do not translate
     * into your own language.
     */
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

    /* Translators: If there are characters in your language that are not
     * supported by Bitter, translate this to 'off'. Do not translate into your
     * own language.
     */
    $bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

    if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
        $font_families = array();

        if ( 'off' !== $source_sans_pro )
            $font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

        if ( 'off' !== $bitter )
            $font_families[] = 'Bitter:400,700';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
        $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Adds Masonry to handle vertical alignment of footer widgets.
    if ( is_active_sidebar( 'sidebar-1' ) )
        wp_enqueue_script( 'jquery-masonry' );

    // Loads JavaScript file with functionality specific to Twenty Thirteen.
    wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

    // Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
    wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

    // Add Genericons font, used in the main stylesheet.
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

    // Loads our main stylesheet.
    wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

    // Loads the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
    wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Widget Area', 'twentythirteen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 )
        return;
    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
        <div class="nav-links">

            <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
            <?php endif; ?>

            <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
            <?php endif; ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
        <div class="nav-links">

            <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
            <?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
    if ( is_sticky() && is_home() && ! is_paged() )
        echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

    if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
        twentythirteen_entry_date();

    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
    if ( $categories_list ) {
        echo '<span class="categories-links">' . $categories_list . '</span>';
    }

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
    if ( $tag_list ) {
        echo '<span class="tags-links">' . $tag_list . '</span>';
    }

    // Post author
    if ( 'post' == get_post_type() ) {
        printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
            get_the_author()
        );
    }
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
        $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
    else
        $format_prefix = '%2$s';

    $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
        esc_url( get_permalink() ),
        esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );

    if ( $echo )
        echo $date;

    return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_the_attached_image() {
    /**
     * Filter the image attachment size to use.
     *
     * @since Twenty thirteen 1.0
     *
     * @param array $size {
     *     @type int The attachment height in pixels.
     *     @type int The attachment width in pixels.
     * }
     */
    $attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
    $next_attachment_url = wp_get_attachment_url();
    $post                = get_post();

    /*
     * Grab the IDs of all the image attachments in a gallery so we can get the URL
     * of the next adjacent image in a gallery, or the first image (if we're
     * looking at the last image in a gallery), or, in a gallery of one, just the
     * link to that image file.
     */
    $attachment_ids = get_posts( array(
        'post_parent'    => $post->post_parent,
        'fields'         => 'ids',
        'numberposts'    => -1,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID'
    ) );

    // If there is more than 1 attachment in a gallery...
    if ( count( $attachment_ids ) > 1 ) {
        foreach ( $attachment_ids as $attachment_id ) {
            if ( $attachment_id == $post->ID ) {
                $next_id = current( $attachment_ids );
                break;
            }
        }

        // get the URL of the next image attachment...
        if ( $next_id )
            $next_attachment_url = get_attachment_link( $next_id );

        // or get the URL of the first image attachment.
        else
            $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }

    printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
        esc_url( $next_attachment_url ),
        the_title_attribute( array( 'echo' => false ) ),
        wp_get_attachment_image( $post->ID, $attachment_size )
    );
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
    $content = get_the_content();
    $has_url = get_url_in_content( $content );

    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
    if ( ! is_multi_author() )
        $classes[] = 'single-author';

    if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
        $classes[] = 'sidebar';

    if ( ! get_option( 'show_avatars' ) )
        $classes[] = 'no-avatars';

    return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
    global $content_width;

    if ( is_attachment() )
        $content_width = 724;
    elseif ( has_post_format( 'audio' ) )
        $content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_customize_preview_js() {
    wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );
