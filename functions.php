<?php
/**
 * purp functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package purp
 */

if ( ! function_exists( 'purp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function purp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on purp, use a find and replace
	 * to change 'purp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'purp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size(828, 360, true);
	add_image_size('purp-small-thumb', 300, 150, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'purp' ),
		'secondary' => esc_html__( 'Secondary', 'purp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'purp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'purp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function purp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'purp_content_width', 640 );
}
add_action( 'after_setup_theme', 'purp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function purp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widgets', 'purp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'purp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'purp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function purp_scripts() {
	wp_enqueue_style( 'purp-style', get_stylesheet_uri() );

    // wp_enqueue_script('purp-typekit', '//use.typekit.net/qgr2ggk.js');
    // wp_enqueue_style('purp-google-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900i,900%7CCourgette');

	// wp_enqueue_script( 'purp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	// wp_enqueue_script( 'purp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// wp_enqueue_script( 'three-js', get_template_directory_uri() . '/js/three.min.js', array(), '0.84.0', true);
	// deregister default jQuery included with Wordpress
	wp_deregister_script( 'jquery' );

	$jquery_cdn = '//code.jquery.com/jquery-3.1.1.min.js';
	wp_enqueue_script( 'jquery', $jquery_cdn, array(), '3.1.1', true );

	// wp_enqueue_script( 'purp-header-animation', get_template_directory_uri() . '/js/header-animation-simple.js', array('jquery'), '1.0', true);

	wp_enqueue_script( 'purp-combined', get_template_directory_uri() . '/js/purp-min.js', array('jquery'), '1.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'purp_scripts' );


// adding inline function to call typekit load
// adapted from here: https://gist.github.com/FernE97/5581174
function purp_typekit_inline() {
   // if ( wp_script_is( 'purp-typekit', 'done' ) ) {
   //     echo '<script>try{Typekit.load();}catch(e){}</script>';
   // }
	// advanced typekit embed code, quotations fixed
	echo "<script>
		  (function(d) {
		    var config = {
		      kitId: 'qgr2ggk',
		      scriptTimeout: 3000,
		      async: true
		    },
		    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,'')+' wf-inactive';},config.scriptTimeout),tk=d.createElement('script'),f=false,s=d.getElementsByTagName('script')[0],a;h.className+=' wf-loading';tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!='complete'&&a!='loaded')return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>";
}
add_action('wp_head', 'purp_typekit_inline');

function purp_inline_styles() {
	print '
	<style type="text/css">html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}h1{font-size:2em;margin:.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em auto}@media only screen and (min-width:40em){figure{margin:1em 40px}}hr{-webkit-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type=checkbox],input[type=radio]{-webkit-box-sizing:border-box;box-sizing:border-box;padding:0}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{height:auto}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{border:0;padding:0}textarea{overflow:auto}optgroup{font-weight:700}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}body,button,input,select,textarea{color:#404040;font-family:macho,sans-serif;font-size:16px;font-size:1rem;line-height:1.5}h1,h2,h3,h4,h5,h6{font-weight:700;clear:both;line-height:1.3em;margin-top:0;margin-bottom:.875em;color:#32004b}p{margin-top:0;margin-bottom:1.5em}cite,dfn,em,i{font-style:italic}blockquote{margin:0 1.5em}address{margin:0 0 1.5em}pre{background:#dbdbdb;color:#32004b;font-family:"Courier 10 Pitch",Courier,monospace;font-size:15px;font-size:.9375rem;line-height:1.6;margin-bottom:1.6em;max-width:100%;overflow:auto;padding:1.6em}code,kbd,tt,var{font-family:Monaco,Consolas,"Andale Mono","DejaVu Sans Mono",monospace;font-size:15px;font-size:.9375rem}abbr,acronym{border-bottom:1px dotted #666;cursor:help}ins,mark{background:#fff9c0;text-decoration:none}big{font-size:125%}.accent-text{color:#32004b}.entry-title{margin-top:0;margin-bottom:.5625rem;font-size:26px;font-size:1.75rem;color:#32004b}.entry-title.index-excerpt{font-size:24px;font-size:1.5rem}.entry-header .entry-title a{color:#32004b;text-decoration:none;-webkit-transition:all .35s;transition:all .35s;text-shadow:0 0 0 #FFF;margin-left:0}@media only screen and (min-width:40em){.entry-title{margin-bottom:1.25rem}}html{-webkit-box-sizing:border-box;box-sizing:border-box}*,:after,:before{-webkit-box-sizing:inherit;box-sizing:inherit}body{background:#fff;background-image:url(http://rahtz.net/blog/img/subtle-pattern/cream_dust.png);background-size:50px 50px}@media only screen and (-webkit-min-device-pixel-ratio:1.5),only screen and (-o-min-device-pixel-ratio:3/2),only screen and (min--moz-device-pixel-ratio:1.5),only screen and (min-device-pixel-ratio:1.5){body{background-image:url(http://rahtz.net/blog/img/subtle-pattern/cream_dust_@2X.png)}}blockquote:after,blockquote:before,q:after,q:before{content:""}blockquote:before{display:block;-webkit-box-shadow:0 2px 4px #2b2b2b;box-shadow:0 2px 4px #2b2b2b;width:100%;height:1px;margin-bottom:14px}blockquote,q{quotes:"" "";padding:0 1em;color:#32004b;font-style:italic}hr{background-color:#ccc;border:0;height:1px;margin-bottom:1.5em}ol,ul{margin:0 0 1.5em 1em}ul{list-style:disc}ol{list-style:decimal}li>ol,li>ul{margin-bottom:0;margin-left:0}dt{font-weight:700}dd{margin:0 1.5em 1.5em}img{height:auto;max-width:100%}table{margin:0 0 1.5em;width:100%}td,th{border:1px solid #999;padding:.5em}button,input[type=button],input[type=reset],input[type=submit]{border:0;border-color:transparent;border-radius:0;background:#6a0f97;-webkit-box-shadow:0 0;box-shadow:0 0;color:#fff;font-size:16px;font-size:1rem;line-height:1;padding:.5em 1em;font-weight:600}button:hover,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover{border-color:#ccc #bbb #aaa;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.8),inset 0 15px 17px rgba(255,255,255,.8),inset 0 -5px 12px rgba(0,0,0,.02);box-shadow:inset 0 1px 0 rgba(255,255,255,.8),inset 0 15px 17px rgba(255,255,255,.8),inset 0 -5px 12px rgba(0,0,0,.02)}button:active,button:focus,input[type=button]:active,input[type=button]:focus,input[type=reset]:active,input[type=reset]:focus,input[type=submit]:active,input[type=submit]:focus{border-color:#aaa #bbb #bbb;-webkit-box-shadow:inset 0 -1px 0 rgba(255,255,255,.5),inset 0 2px 5px rgba(0,0,0,.15);box-shadow:inset 0 -1px 0 rgba(255,255,255,.5),inset 0 2px 5px rgba(0,0,0,.15)}input[type=text],input[type=email],input[type=url],input[type=password],input[type=tel],input[type=range],input[type=date],input[type=month],input[type=week],input[type=time],input[type=datetime],input[type=datetime-local],input[type=color],input[type=number],input[type=search],textarea{color:#666;border:1px solid #ccc;border-radius:3px;padding:3px}select{border:1px solid #ccc}input[type=text]:focus,input[type=email]:focus,input[type=url]:focus,input[type=password]:focus,input[type=tel]:focus,input[type=range]:focus,input[type=date]:focus,input[type=month]:focus,input[type=week]:focus,input[type=time]:focus,input[type=datetime]:focus,input[type=datetime-local]:focus,input[type=color]:focus,input[type=number]:focus,input[type=search]:focus,textarea:focus{color:#111}textarea{width:100%}.main-navigation .contact{position:absolute;right:8px;top:25px}.main-navigation .contact p{display:inline-block;vertical-align:middle;margin:0;margin-right:6px}.main-navigation .contact .custom-logo-link{display:inline-block;vertical-align:middle;margin:0}.main-navigation .contact .custom-logo-link img{width:52px;height:auto;border:#fff solid 4px;border-radius:50%;margin-top:6px}.main-navigation .contact a{color:#fff;font-weight:700}.main-navigation .contact a:focus{outline:0}@media only screen and (min-width:40em){.main-navigation .contact{position:absolute;top:36px}}@media only screen and (min-width:52em){.main-navigation .contact{top:-23px}.main-navigation .contact a{color:#32004b}.main-navigation .contact .custom-logo-link img{width:82px;top:46px}}a{color:#404040;text-decoration:none;font-weight:600;text-decoration:underline}a:visited{color:#888;text-decoration:none}a:active,a:focus,a:hover{text-decoration:none}a:focus{outline:thin dotted}a:active,a:hover{outline:0}.main-navigation{clear:both;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;float:left;width:100%;background-color:#fff;color:#5e5e5e;padding:.65em 0;border-top:8px solid #32004b;border-bottom:40px solid #32004b;font-size:.8em;position:relative;-webkit-box-align:center;-ms-flex-align:center;align-items:center}@media only screen and (min-width:52em){.main-navigation{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;border-bottom:8px solid #32004b}}@media only screen and (min-width:40em){.main-navigation{font-size:1.1em}}.main-navigation ul{display:none;list-style:none;margin:0;padding-left:0}.main-navigation ul::before{content:"// ";display:inline-block;margin-right:.4em}.main-navigation ul::after{content:"// ";display:inline-block;margin-left:.3em}.main-navigation li{position:relative;display:inline-block}.main-navigation li a::after{content:"::";display:inline-block;margin:0 .2em 0 .5em;letter-spacing:2px}.main-navigation li:last-of-type a::after{content:"";margin:0}.main-navigation a{display:block;text-decoration:none;color:#5e5e5e;font-weight:400}.main-navigation ul ul{-webkit-box-shadow:0 3px 3px rgba(0,0,0,.2);box-shadow:0 3px 3px rgba(0,0,0,.2);float:left;position:absolute;top:1.5em;left:-999em;z-index:99999}.main-navigation ul ul ul{left:-999em;top:0}.main-navigation ul ul a{width:200px}.main-navigation ul li.focus>ul,.main-navigation ul li:hover>ul{left:auto}.main-navigation ul ul li.focus>ul,.main-navigation ul ul li:hover>ul{left:100%}.menu-toggle{display:none}.main-navigation ul{display:block}.site-main .comment-navigation,.site-main .paging-navigation,.site-main .post-navigation,.site-main .posts-navigation{margin:0 0 1.5em;overflow:hidden}.site-main .comment-navigation a,.site-main .post-navigation a,.site-main .posts-navigation a{color:#fff;font-weight:600;text-decoration:none}.site-main .post-navigation{margin-top:3em}.comment-navigation .nav-next,.comment-navigation .nav-previous,.post-navigation .nav-next,.post-navigation .nav-previous,.posts-navigation .nav-next,.posts-navigation .nav-previous{border-right:4px solid transparent}.comment-navigation .nav-previous a,.post-navigation .nav-previous a,.posts-navigation .nav-previous a{display:block;background-color:#6a0f97;padding:.4em .5em .6em;font-size:90%;text-align:center;margin-bottom:.5em}.continue-reading a{display:inline-block;background-color:#6a0f97;color:#fff;padding:.1em .7em;margin-bottom:1em;text-decoration:none;font-size:90%}.comment-navigation .nav-next a,.post-navigation .nav-next a,.posts-navigation .nav-next a{display:block;background-color:#6a0f97;padding:.4em .5em .6em;font-size:90%;text-align:center;margin-bottom:.5em}.post-navigation .nav-previous a::before,.posts-navigation .nav-previous a::before{content:"\00ab";color:#fff;font-size:1.3em;margin-right:.2em;font-weight:600}.post-navigation .nav-next a::after,.posts-navigation .nav-next a::after{content:"\00bb";color:#fff;font-size:1.3em;margin-left:.2em;font-weight:600}.paging-navigation ul{list-style-type:none;margin:0;padding:0;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-ms-flex-pack:distribute;justify-content:space-around}.paging-navigation ul li{margin-right:1em}.paging-navigation ul li:first-of-type,.paging-navigation ul li:last-of-type{margin-right:0;width:100%}.paging-navigation a{display:inline-block;background-color:#6a0f97;color:#fff;padding:.4em 1.1em .7em;margin-bottom:1em;text-decoration:none;font-size:120%}.paging-navigation .page-numbers.current{display:inline-block;color:#6a0f97;padding:.3em .8em .4em;margin-bottom:1em;text-decoration:none;font-size:120%;border:solid .3em #6a0f97;-webkit-box-sizing:border-box;box-sizing:border-box;font-weight:700}.paging-navigation a.prev{padding:.4em 2em .4em 1.5em;font-size:90%;width:100%;text-align:center}.paging-navigation a.next{padding:.4em 2em;font-size:90%;width:100%;text-align:center}@media only screen and (min-width:40em){.post-navigation .nav-links,.posts-navigation .nav-links{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}.comment-navigation .nav-previous a,.post-navigation .nav-previous a{padding:1em 2em}.posts-navigation .nav-previous a{padding:1em 2em 1em 1.5em}.comment-navigation .nav-next a,.post-navigation .nav-next a,.posts-navigation .nav-next a{padding:1em 2em}.paging-navigation ul{max-width:33em;margin:0 auto;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}.paging-navigation ul li:first-of-type,.paging-navigation ul li:last-of-type{width:auto}.paging-navigation ul li:first-of-type{margin-right:1em}.paging-navigation a.prev{padding:1em 2em 1em 1.5em;font-size:90%;width:auto}.paging-navigation a.next{padding:1em 2em;font-size:90%;width:auto}}@media only screen and (min-width:59em){.site-main .posts-navigation{max-width:48em;margin:0 auto}.paging-navigation ul,.posts-navigation .nav-previous{margin-left:25%}.archive .posts-navigation .nav-previous{margin-left:0}}.screen-reader-text{clip:rect(1px,1px,1px,1px);position:absolute!important;height:1px;width:1px;overflow:hidden}.screen-reader-text:focus{background-color:#f1f1f1;border-radius:3px;-webkit-box-shadow:0 0 2px 2px rgba(0,0,0,.6);box-shadow:0 0 2px 2px rgba(0,0,0,.6);clip:auto!important;color:#21759b;display:block;font-size:14px;font-size:.875rem;font-weight:700;height:auto;left:5px;line-height:normal;padding:15px 23px 14px;text-decoration:none;top:5px;width:auto;z-index:100000}#content[tabindex="-1"]:focus{outline:0}.alignleft{display:inline;float:left;margin-right:1.5em}.alignright{display:inline;float:right;margin-left:1.5em}.aligncenter{clear:both;display:block;margin-left:auto;margin-right:auto}.clear:after,.clear:before,.comment-content:after,.comment-content:before,.entry-content:after,.entry-content:before,.site-content:after,.site-content:before,.site-footer:after,.site-footer:before,.site-header:after,.site-header:before{content:"";display:table;table-layout:fixed}.clear:after,.comment-content:after,.entry-content:after,.site-content:after,.site-footer:after,.site-header:after{clear:both}.widget{margin:1em 0 0 0;background-color:#fff;padding:1em;-webkit-box-sizing:border-box;box-sizing:border-box}.widget ul{padding-top:0}.widget li{margin-bottom:.3em}.widget a{text-decoration:none}.widget a:hover{text-decoration:underline}.widget select{max-width:100%}.widget-area{font-size:16px;font-size:1rem}.widget-area:before{content:"";display:block;width:100%;height:1px;margin-bottom:1em;background-color:#32004b}.widget-title{font-size:18px;font-size:1rem;margin-bottom:.6em}.widget ol,.widget ul{margin:0;list-style-type:none;padding:0 0 0 .3em}@media only screen and (min-width:40em){.widget{float:left;width:256px;width:16rem}}@media only screen and (min-width:59em){.posts-home .widget-area{font-size:85%;width:auto}.posts-home .widget-area:before{content:none}.posts-home .widget{background-color:transparent;padding:0;margin:2em 0 0 0}.posts-home .widget:first-of-type{margin-top:0}}.widget_nav_menu .sub-menu,.widget_pages .children{padding-bottom:.5em}input[type=search]{width:65%}.widget_search .search-submit{width:30%;padding:.5em 0}.widget_calendar caption{padding:.5em 0;font-size:1em;font-weight:600;text-align:left}.widget_calendar thead{background:#32004b;color:#fff}.widget_calendar thead th{border-bottom-width:2px}.widget_calendar td{padding:.2em;font-size:.8em;text-align:center;background:#d6d6d6;border:3px solid #fff}.widget_calendar th{border:none}.widget_calendar .pad{background:#eaeaea}.widget_nav_menu a,.widget_pages a{width:100%;display:block;border-bottom:1px #32004b solid;padding-bottom:.5em}.widget_nav_menu a:hover,.widget_pages a:hover{background-color:#6a0f97;color:#fff;text-decoration:none;padding-left:.5em}.widget_rss li{margin-bottom:1em}.widget li a.rsswidget{padding-right:.5em;font-size:1em;line-height:1.4em}.rss-date,.widget_rss cite{font-size:1em}.rssSummary{padding:.5em 0;font-size:1em;line-height:1.4em}.site-header{background-color:transparent;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.identity-wrap{-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start;background-color:#d3d3d3;background-size:cover;position:relative}.site-logo{position:relative;-webkit-box-flex:0;-ms-flex:0 1 3em;flex:0 1 3em;margin-top:.4em;display:none}.site-logo a{position:absolute;z-index:10;top:1.2em;left:1em;display:block;width:2em;height:2em;background:#fff;border:2px solid #000;color:#000;text-decoration:none}.site-logo.single a{top:.4em}.site-logo a:focus,.site-logo a:hover{outline:2px solid #000}.site-logo.single a:focus,.site-logo.single a:hover{outline:2px solid #fff}.site-firstletter{font-size:1.5em;font-weight:700;text-align:center;line-height:1.3em}.site-logo a:focus .site-firstletter,.site-logo a:hover .site-firstletter{background:#000;color:#fff}.site-branding{-webkit-box-flex:0;-ms-flex:0 1 auto;flex:0 1 auto;text-align:left;z-index:1}.site-title{margin:.4em 0 0;font-family:baskerville-urw,Times,sans-serif;font-size:2em;font-weight:700;line-height:1em;color:#32004b;display:inline-block;background-color:#fff;padding:.2em .4em .4em}.site-title a{text-decoration:none;color:inherit}.site-title a:focus,.site-title a:hover{color:#7d7d7d}.site-description{margin:.6em 0 1em;font-size:90%;line-height:135%;color:#fff;background-color:#32004b;padding:.2em 1em .3em}#header-canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:0}@media only screen and (min-width:40em){.identity-wrap{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.site-title{font-size:2.4em;line-height:1.3em;padding:.1em .4em}.site-description{font-size:105%;line-height:135%;margin-top:0;padding-bottom:.2em}.site-logo{display:block}.posts-home .site-logo{display:none}}@media only screen and (min-width:77.5em){.posts-home .site-logo{display:block}}.entry-header{width:98%;margin-bottom:1.5em;text-align:left}.entry-header a{color:#000}.entry-content{width:98%;position:relative}.page-title{text-align:left;font-style:italic;font-size:1.2rem;margin-bottom:2.1em;color:#6a0f97;font-weight:400}.not-found .secondary-title{margin-top:3em}.archive-description{padding:1em 1em;text-align:center;font-style:italic;width:75%;margin:0 auto 3em}.archive-description::after{display:block;content:"";-webkit-box-shadow:0 2px 4px #2b2b2b;box-shadow:0 2px 4px #2b2b2b;width:100%;height:1px;margin-top:1em}.archive-description p{margin:0}.entry-footer span{display:block}.entry-footer .edit-link{display:block}@media only screen and (min-width:40em){.entry-header{text-align:center}.page-title{text-align:center}.entry-footer span{display:inline-block;margin-right:.4em}.entry-footer .cat-links::after{content:"|";display:inline-block;margin-left:.4em}}@media only screen and (min-width:59em){.posts-home .entry-header{text-align:left;width:25%;float:left}.entry-header{text-align:center;width:100%;float:none;margin-bottom:2em;padding-right:2%;-webkit-box-sizing:border-box;box-sizing:border-box}.page .entry-header{padding-right:0}.posts-home .entry-content{width:74%;float:right}.entry-content{padding:0 0 0 .25em;width:100%;float:none;-webkit-box-sizing:border-box;box-sizing:border-box;max-width:48em}.page .entry-content{padding-left:0}}#primary{-webkit-box-sizing:border-box;box-sizing:border-box;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;margin:0 auto;width:98%}.site-main{-webkit-box-sizing:border-box;box-sizing:border-box;line-height:1.6em;margin:1.8rem auto;width:94%}.widget-area{-webkit-box-sizing:border-box;box-sizing:border-box;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-ms-flex-wrap:nowrap;flex-wrap:nowrap;margin:1.8rem auto;width:100%}.posts-home .widget-area{width:94%}@media only screen and (min-width:40em){.site-main{margin-top:2.875rem}.widget-area{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-pack:distribute;justify-content:space-around}.posts-home .widget-area{margin-top:2.875rem}}@media only screen and (min-width:59em){#primary{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;max-width:56rem}#primary.posts-home{-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;max-width:60rem}.posts-home .site-main{padding-right:2em;width:75%}.posts-home .widget-area{padding-left:1em;width:25%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}}.sticky{display:block}.hentry{margin:0}.entry-meta{font-size:16px;font-size:1rem}.posts-home .entry-meta .border-top::before{content:"";display:block;width:75%;border-top:2px solid #000;padding-top:3px}.entry-meta .border-top{border-top:2px solid #000;display:inline-block;padding-top:3px}.posts-home .entry-meta .border-top{border-top:0;padding-top:0}.entry-meta a{text-decoration:none;font-weight:400}.entry-meta a:hover{text-decoration:underline}.entry-meta .author a{font-weight:700}.author-avatar{height:4rem;width:4rem;margin:0 auto 1em}.author-avatar img{border-radius:50%}.byline,.posted-on{padding:0}.entry-meta .comments-link{display:block;padding:0}.posted-on{padding-top:.1em}.byline,.updated:not(.published){display:none}.group-blog .byline,.single .byline{display:inline}.entry-content,.entry-summary,.page-content{margin:0}.entry-content{margin-left:auto;margin-right:auto}.page-links{clear:both;margin:0 0 1.5em}.entry-excerpt::after{content:"";display:block;width:3em;border-bottom:2px solid #32004b;margin-bottom:1em}.entry-excerpt p{font-weight:600;margin-bottom:4px}.site-main article.page,.site-main article.post{margin-bottom:6em}.site-main article.post::after{content:"";clear:both;display:block}.page-content .search-form{text-align:center}.comments-area{margin-top:4em}.comment-content a{word-wrap:break-word}.bypostauthor{display:block}.comments-title{font-size:19px;font-size:1.1875rem}.comments-title::before{display:block;content:"";width:25%;border-bottom:solid 2px #32004b;margin-bottom:.75em}.comment-list,.comment-list ol{list-style-type:none}.comment,.pingback{margin-bottom:2.5em}.comment-list .avatar.photo{position:absolute;width:48px;height:auto;left:-56px;top:3px}.comment-list .comment-content{clear:left;margin-left:56px;margin-top:10px}.comment-list .reply{text-align:right}.comment-list .reply a{color:#fff;text-decoration:none;background-color:#6a0f97;padding:.5em 1.5em}.comment-author .fn,.comment-author .fn a{color:#32004b}.comment-metadata time{font-size:85%}.comment-meta{position:relative;margin-left:56px}.bypostauthor{-webkit-box-shadow:0 -1px 9px 7px #ddd;box-shadow:0 -1px 9px 7px #ddd;padding:1em;margin-right:-1em;margin-left:0}.comment-respond{margin:1em 0 1.5em 3.5em}#commentform::after{display:block;content:"";clear:both}@media only screen and (min-width:40em){.comment-form .form-submit{float:right}}.infinite-scroll .posts-navigation,.infinite-scroll.neverending .site-footer{display:none}.infinity-end.neverending .site-footer{display:block}.comment-content .wp-smiley,.entry-content .wp-smiley,.page-content .wp-smiley{border:none;margin-bottom:0;margin-top:0;padding:0}embed,iframe,object{max-width:100%}.wp-caption{margin-bottom:1.5em;max-width:100%}.wp-caption img[class*=wp-image-]{display:block;margin-left:auto;margin-right:auto}.wp-caption .wp-caption-text{margin:.8075em 0}.wp-caption-text{text-align:center}.featured-image{margin-top:3em;margin-bottom:1em}.featured-image.page{margin-top:0;margin-bottom:3em}.featured-image a:focus,.featured-image a:hover{outline:0}.featured-image a:focus img,.featured-image a:hover img{outline:dotted 2px #6a0f97}@media only screen and (min-width:40em){.posts-home .featured-image{margin:0 0 1em;text-align:center}}.gallery{margin-bottom:1.5em}.gallery-item{display:inline-block;text-align:center;vertical-align:top;width:100%}.gallery-columns-2 .gallery-item{max-width:50%}.gallery-columns-3 .gallery-item{max-width:33.33%}.gallery-columns-4 .gallery-item{max-width:25%}.gallery-columns-5 .gallery-item{max-width:20%}.gallery-columns-6 .gallery-item{max-width:16.66%}.gallery-columns-7 .gallery-item{max-width:14.28%}.gallery-columns-8 .gallery-item{max-width:12.5%}.gallery-columns-9 .gallery-item{max-width:11.11%}.gallery-caption{display:block;font-size:75%;line-height:1.2em}.site-footer{padding:2em 1em;text-align:center;color:#fff;background-color:#32004b}.site-footer a{color:#fff;text-decoration:none}.site-footer a:hover{text-decoration:underline}.portfolio-categories{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-sizing:border-box;box-sizing:border-box;margin-top:2em;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;top:0;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.portfolio-categories .category-section{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-ms-flex:1;flex:1;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center;text-align:center;-webkit-box-sizing:border-box;box-sizing:border-box;cursor:pointer;max-width:86%;margin-bottom:2em}@media only screen and (min-width:40em){.portfolio-categories{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.portfolio-categories .category-section{max-width:100%}.portfolio-categories .category-section h2{border-right:1px solid #32004b}.portfolio-categories .category-section:last-of-type h2{border:0}}h2.category-headline{font-size:1.6em;padding:0 .9em;margin-bottom:.7em}h2.category-headline a{color:#32004b;text-decoration:none}h2.category-headline a:active,h2.category-headline a:hover{text-decoration:underline}.portfolio-categories .category-section p{font-family:baskerville-urw,Times,sans-serif;padding:0 1.5em;color:#5e5e5e;font-size:1.2em}.category-section-icon{width:50%;height:5em;margin-bottom:2em}.category-section-icon img{width:100%;height:100%}.category-section-icon.interactive img{width:90%;height:95%;padding:5%}.category-section-icon{-webkit-animation-name:iconIn;animation-name:iconIn;-webkit-animation-duration:250ms;animation-duration:250ms;-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;-webkit-animation-iteration-count:1;animation-iteration-count:1;-webkit-animation-fill-mode:both;animation-fill-mode:both}.category-section-icon.icon-1{-webkit-animation-delay:.2s;animation-delay:.2s}.category-section-icon.icon-2{-webkit-animation-delay:.4s;animation-delay:.4s}.category-section-icon.transition-out{-webkit-animation-name:iconOut;animation-name:iconOut}.category-section-icon.transition-out.icon-1{-webkit-animation-delay:80ms;animation-delay:80ms}.category-section-icon.transition-out.icon-2{-webkit-animation-delay:160ms;animation-delay:160ms}@-webkit-keyframes iconIn{from{-webkit-transform:scaleX(0);transform:scaleX(0)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}@keyframes iconIn{from{-webkit-transform:scaleX(0);transform:scaleX(0)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}@-webkit-keyframes iconOut{from{-webkit-transform:scaleX(1);transform:scaleX(1)}to{-webkit-transform:scaleX(0);transform:scaleX(0)}}@keyframes iconOut{from{-webkit-transform:scaleX(1);transform:scaleX(1)}to{-webkit-transform:scaleX(0);transform:scaleX(0)}}@media only screen and (min-width:59em){.expertise .entry-content{max-width:100%}}#feature-skill{position:relative;-webkit-perspective:1400px;perspective:1400px}#category-title{text-align:center}.demo-bar{width:100%;margin:.7em 0 1.4em 0;-webkit-box-shadow:0 .4em .4em 1em #555;box-shadow:0 0 15px 5px rgba(187,187,187,.5);cursor:pointer;-webkit-animation-name:demoBarRotate;animation-name:demoBarRotate;-webkit-animation-duration:350ms;animation-duration:350ms;-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out;-webkit-animation-iteration-count:1;animation-iteration-count:1;-webkit-animation-fill-mode:forwards;animation-fill-mode:forwards;-webkit-animation-delay:.2s;animation-delay:.2s;-webkit-transform:rotateX(50deg);transform:rotateX(50deg);opacity:0;-webkit-box-sizing:border-box;box-sizing:border-box;padding:.75em}.bar-1{-webkit-animation-delay:.4s;animation-delay:.4s}.bar-2{-webkit-animation-delay:.6s;animation-delay:.6s}.bar-3{-webkit-animation-delay:.8s;animation-delay:.8s}.bar-4{-webkit-animation-delay:1s;animation-delay:1s}.bar-5{-webkit-animation-delay:1.2s;animation-delay:1.2s}.bar-6{-webkit-animation-delay:1.4s;animation-delay:1.4s}.demo-bar img{height:auto;width:20%;margin-right:.625em;display:inline-block}.demo-description{display:inline-block;width:70%;vertical-align:top}.demo-description h2{margin-top:-.2em;margin-bottom:0;font-size:1.25em;font-weight:400}.demo-description h2 a{color:#32004b;text-decoration:none}.demo-description h2 a:active,.demo-description h2 a:hover{text-decoration:underline}.demo-description p{margin-bottom:.65em}.demo-description .role{font-size:.9em;margin-bottom:.3em;font-weight:500}@-webkit-keyframes demoBarRotate{from{-webkit-transform:rotateX(50deg);transform:rotateX(50deg);opacity:0}to{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}@keyframes demoBarRotate{from{-webkit-transform:rotateX(50deg);transform:rotateX(50deg);opacity:0}to{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}
		</style>
	';
}
add_action('wp_head', 'purp_inline_styles');




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';
