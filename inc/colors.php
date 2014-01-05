<?php
/**
 * Color Me WP 2014 ChildTheme Colors Class.
 *
 * @category   Wordpress Plugin
 * @package    Color Me WP 2014
 * @author     Rob Landry <rob@landry.me>
 * @copyright  2013 Rob Landry
 * @license    http://www.gnu.org/licenses/gpl-3.0.html  GPLv3
 * @version    Release: 1.0
 * @link       http://www.landry.me/extend/plugins/color-me-wp-2014/
 * @see        http://redmine.landry.me/projects/color-me-wp-2014/
 * @since      Class available since Release 1.0
 *  
 */

class CMW_Colors {

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $theme_slug = 'cmw_2014';

	/**
	 * The option value in the database will be based on get_stylesheet()
	 * so child themes don't share the parent theme's option value.
	 *
	 * @access public
	 * @var string
	 */
	public $option_key = 'cmw_2014_options';

	/**
	 * Constructor.
	 *
	 * @access public
	 *
	 * @return Color_Me_WP_Options
	 */
	public function __construct() {

        add_action( 'admin_init',           array( $this, '_admin_init'			) );
        add_action( 'wp_head' ,             array( $this, '_wp_head'			) );
		add_action( 'customize_register',	array( $this, '_customize_register'	) );
		//add_action( 'wp_enqueue_scripts', 	array( $this, '_enqueue_styles'		) );
	}

	/**
	 * Registers the form setting for our options array.
	 *
	 * This function is attached to the admin_init action hook.
	 *
	 * This call to register_setting() registers a validation callback, validate(),
	 * which is used when the option is saved, to ensure that our option values are properly
	 * formatted, and safe.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function _admin_init() {

		$_arr = array(
			'header_color' => 'Main Header Color',
			'search_bar_color' => 'Search Bar Color',
			'title_color' => 'Title Color',
			'title_hover_color' => 'Title Hover Color',
			'h1_color' => 'h1,h2,h3,h4,h5,h6 Colors',

			'nav_bg_color' => 'Primary Navigation BG Color',
			'nav_bg_hover_color' => 'Primary Navigation BG Hover Color',
			'nav_text_color' => 'Primary Navigation Text Color',
			'nav_text_hover_color' => 'Primary Navigation Text Hover Color',

			'article_color' => 'Article Color',
			'article_bg_color' => 'Article Background Color',
			'primary_link_color' => 'Primary Link Color',
			'primary_link_hover_color' => 'Primary Link Hover Color',
			'content_text_color' => 'Content Text Color',

			'widget_color' => 'Widget Color',
			'widget_bg_color' => 'Widget Background Color',
			'widget_link_color' => 'Widget Link Color',
			'widget_link_hover_color' => 'Widget Link Hover Color'
		);

		foreach ($_arr as $_value => $_text) {

			// Register our individual settings fields.
			add_settings_field(
				$_value,
				sprintf( __( '%s' , 'cmw_2014' ) , $_text ) ,
				array( $this, 'settings_field_'.$_value ),
				'theme_options',
				'general'
			);
		}

	}

	/**
	 * Enqueues the Admin Scripts.
	 *
	 * @access public
	 *
	 * @return void
	 */
    public function _wp_head() {
        $opt = get_option( $this->option_key ); ?>

		<!--Customizer CSS-->
		<style>

			/* .entry-header, .entry-meta, .entry-content, article, .nav-links
				{ background-color:  <?php echo $opt['article_color']; ?> !important; }

			.paging-navigation .page-numbers.current { border-top: 5px solid <?php echo $opt['nav_text_color']; ?> }
			.paging-navigation a:hover { border-top: 5px solid <?php echo $opt['nav_text_hover_color']; ?> }

			.page-links a { background: <?php echo $opt['nav_text_color'];?>  }
			.page-links a:hover { background: <?php echo $opt['nav_text_hover_color'];?>  } */

			/* Colors */

			/* Custom */

			article.post, .entry-header, .entry-meta, .entry-content, .comments-wrapper	{ background-color:  <?php echo $opt['article_color']; ?> !important}
			.widget-wrapper{background-color:<?php echo $opt['widget_color']; ?>}
			table, th, td { border: 1px solid <?php echo $opt['article_bg_color']; ?>; }

			/* TwentyFourten */
			body,button,input,select,textarea{color:<?php echo $opt['content_text_color']; ?>}
			body{background:<?php echo $opt['article_bg_color']; ?>}
			body.custom-background{background:<?php echo $opt['article_bg_color']; ?> !important}
			a{color: <?php echo $opt['primary_link_color']; ?>}
			a:active,a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			ins,mark{background:<?php echo $opt['primary_link_color']; ?>}
			blockquote{color:<?php echo $opt['primary_link_color']; ?>}
			blockquote cite,blockquote small{color: <?php echo $opt['primary_link_color']; ?>}
			del{color:<?php echo $opt['primary_link_color']; ?>}
			::selection{background:<?php echo $opt['nav_text_hover_color'];?>;color:#fff}
			::-moz-selection{background:<?php echo $opt['nav_text_hover_color'];?>;color:<?php echo $opt['nav_text_color'];?>}
			input,textarea{color: <?php echo $opt['primary_link_color']; ?>}
			.contributor-posts-link,button,input[type=button],input[type=reset],input[type=submit]{
				background-color:<?php echo $opt['primary_link_color']; ?>;color:#fff}
			.contributor-posts-link:hover,button:focus,button:hover,input[type=button]:focus,input[type=button]:hover,
				input[type=reset]:focus,input[type=reset]:hover,input[type=submit]:focus,input[type=submit]:hover{
				background-color:<?php echo $opt['primary_link_hover_color']; ?>;color:#fff}
			/*.contributor-posts-link:active,button:active,input[type=button]:active,
				input[type=reset]:active,input[type=submit]:active{background-color:#55d737}*/
			/*::-webkit-input-placeholder{color:#939393}*/
			/*:-moz-placeholder{color:#939393}*/
			/*::-moz-placeholder{color:#939393}*/
			/*:-ms-input-placeholder{color:#939393}*/
			/*.wp-caption{color:#767676}*/
			/*.screen-reader-text:focus{background-color:#f1f1f1;color:#21759b}*/
			.site{background-color:<?php echo $opt['article_bg_color']; ?>}
			.site-header{background-color:<?php echo $opt['nav_bg_color']; ?>}
			.site-title a{color:<?php echo $opt['title_color']; ?>}
			.site-title a:hover{color:<?php echo $opt['title_hover_color']; ?>}
			.search-toggle{background-color:<?php echo $opt['search_bar_color']; ?>}
			.search-toggle.active,.search-toggle:hover{background-color:<?php echo $opt['search_bar_color']; ?>}
			/*.search-toggle:before{color:#fff}*/
			.search-box{background-color:<?php echo $opt['search_bar_color']; ?>}
			/*.search-box .search-field{background-color:#fff}*/
			.site-navigation a{color:<?php echo $opt['nav_text_color']; ?>}
			.site-navigation a:hover{color:<?php echo $opt['nav_text_hover_color']; ?>}
			.site-navigation .current-menu-ancestor>a,.site-navigation .current-menu-item>a,
			.site-navigation .current_page_ancestor>a,.site-navigation .current_page_item>a{color:<?php echo $opt['content_text_color']; ?>}
			/*.menu-toggle:before{color:#fff}*/
			/*a.post-thumbnail:hover{background-color:#999}*/
			.entry-title a{color:<?php echo $opt['title_color'];?>}
			.entry-title a:hover{color:<?php echo $opt['title_hover_color'];?>}
			.site-content .entry-header{background-color: <?php echo $opt['article_color']; ?>}
			.entry-meta,.entry-meta a{color:<?php echo $opt['primary_link_color']; ?>}
			.entry-meta a:hover{color:<?php echo $opt['primary_link_hover_color']; ?>}
			.cat-links a{color:<?php echo $opt['primary_link_color']; ?>}
			.cat-links a:hover{color:<?php echo $opt['primary_link_hover_color']; ?>}
			/*.site-content .entry-meta{background-color:#fff}*/
			.entry-meta .tag-links a{background:<?php echo $opt['nav_bg_hover_color']; ?>;color:<?php echo $opt['content_text_color']; ?>}
			.entry-meta .tag-links a:before{border-right: 8px solid <?php echo $opt['nav_bg_hover_color']; ?>}
			.entry-meta .tag-links a:hover{background:<?php echo $opt['nav_text_color']; ?>;color:<?php echo $opt['nav_bg_color']; ?>}
			.entry-meta .tag-links a:hover:before{border-right-color:<?php echo $opt['nav_text_color']; ?>}
			/*.entry-meta .tag-links a:after,.page-content,.site-content .entry-content,.site-content .entry-summary{background-color:#fff}*/
			/*.entry-content .edit-link a{color:#767676;}*/
			.entry-content .edit-link a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.hentry .mejs-container .mejs-controls,.hentry .mejs-mediaelement{background:#000}*/
			/*.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
				.hentry .mejs-controls .mejs-time-rail .mejs-time-loaded{background:#fff}*/
			/*.hentry .mejs-controls .mejs-time-rail .mejs-time-current{background:#24890d}*/
			/*.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,
				.hentry .mejs-controls .mejs-time-rail .mejs-time-total{background:rgba(255,255,255,.33)}*/
			.page-links a,.page-links>span{background:<?php echo $opt['nav_text_color']; ?>;
				color:<?php echo $opt['nav_bg_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
			.page-links a{background:<?php echo $opt['nav_bg_hover_color']; ?>;
				color:<?php echo $opt['content_text_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
			.page-links a:hover{background:<?php echo $opt['nav_text_color']; ?>;
				color:<?php echo $opt['nav_bg_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
			/*.gallery-caption{color:#fff}*/
			/*.post-navigation .meta-nav{color:#767676}*/
			.image-navigation a,.post-navigation a{color: <?php echo $opt['primary_link_color']; ?>}
			.image-navigation a:hover,.post-navigation a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			.paging-navigation a{color: <?php echo $opt['primary_link_color']; ?>}
			.paging-navigation .page-numbers.current {border-top: 5px solid <?php echo $opt['primary_link_color']; ?>}
			.paging-navigation a:hover{color: <?php echo $opt['primary_link_color']; ?>;border-top: 5px solid <?php echo $opt['primary_link_hover_color']; ?>;}
			/*.author-description,.taxonomy-description{color:#767676}*/
			.comment-author a{color: <?php echo $opt['primary_link_color']; ?>}
			/*.comment-list .pingback a,.comment-list .trackback a,.comment-metadata a{color:#767676}*/
			.comment-author a:hover,.comment-list .pingback a:hover,.comment-list .trackback a:hover,.comment-metadata a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.comment-awaiting-moderation,.comment-notes,.form-allowed-tags,.form-allowed-tags code,.logged-in-as,.no-comments{color:#767676}*/
			/*.required{color:#c0392b}*/
			.comment-reply-title small a{color: <?php echo $opt['primary_link_color']; ?>}
			.comment-reply-title small a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			#secondary{background-color:<?php echo $opt['widget_bg_color']; ?>}
			/*.content-sidebar{color:#767676}*/
			.widget a{color:<?php echo $opt['widget_link_color']; ?>}
			.widget a:hover{color:<?php echo $opt['widget_link_hover_color']; ?>}
			/*.widget ins,.widget mark{color:#000}*/
			/*.widget blockquote{color:rgba(255,255,255,.7)}*/
			/*.widget blockquote cite{color:#fff}*/
			/*.widget del{color:rgba(255,255,255,.4)}*/
			/*.widget hr{background-color:rgba(255,255,255,.2)}*/
			/*.widget input,.widget textarea{background-color:rgba(255,255,255,.1);color:#fff}*/
			/*.widget input:focus,.widget textarea:focus{border-color:rgba(255,255,255,.3)}*/
			/*.widget button,.widget input[type=button],.widget input[type=reset],.widget input[type=submit]{background-color:#24890d}*/
			.widget input[type=button]:focus,.widget input[type=button]:hover,.widget input[type=reset]:focus,
				.widget input[type=reset]:hover,.widget input[type=submit]:focus,.widget input[type=submit]:hover{background-color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.widget input[type=button]:active,.widget input[type=reset]:active,.widget input[type=submit]:active{background-color:#55d737}*/
			/*.widget .wp-caption{color:rgba(255,255,255,.7)}*/
			.widget-title,.widget-title a{color:<?php echo $opt['title_color'];?>}
			.widget-title a:hover{color:<?php echo $opt['title_hover_color'];?>}
			/*.widget_calendar caption{color:#fff}*/
			/*.widget_calendar thead th{background-color:rgba(255,255,255,.1)}*/
			/*.widget_calendar tbody a{background-color:#24890d;color:#fff}*/
			.widget_calendar tbody a:hover{background-color: <?php echo $opt['primary_link_hover_color']; ?>;color:#fff}
			/*.widget_twentyfourteen_ephemera .entry-meta a{color:rgba(255,255,255,.7)}*/
			.widget_twentyfourteen_ephemera .entry-meta a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.content-sidebar .widget a{color:#24890d}*/
			.content-sidebar .widget a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			.content-sidebar .widget ins,.content-sidebar .widget mark{color: <?php echo $opt['primary_link_color']; ?>}
			/*.content-sidebar .widget blockquote{color:#767676}*/
			.content-sidebar .widget blockquote cite{color: <?php echo $opt['primary_link_color']; ?>}
			/*.content-sidebar .widget del{color:#767676}*/
			/*.content-sidebar .widget hr{background-color:rgba(0,0,0,.1)}*/
			.content-sidebar .widget input,.content-sidebar .widget textarea{background-color:#fff;color: <?php echo $opt['primary_link_color']; ?>}
			/*.content-sidebar .widget input[type=button],.content-sidebar .widget input[type=reset],
				.content-sidebar .widget input[type=submit]{background-color:#24890d;color:#fff}*/
			.content-sidebar .widget input[type=button]:focus,.content-sidebar .widget input[type=button]:hover,
				.content-sidebar .widget input[type=reset]:focus,.content-sidebar .widget input[type=reset]:hover,
				.content-sidebar .widget input[type=submit]:focus,.content-sidebar .widget input[type=submit]:hover{background-color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.content-sidebar .widget input[type=button]:active,.content-sidebar .widget input[type=reset]:active,
				.content-sidebar .widget input[type=submit]:active{background-color:#55d737}*/
			/*.content-sidebar .widget .wp-caption{color:#767676}*/
			.content-sidebar .widget .widget-title{border-top:5px solid #000;color: <?php echo $opt['primary_link_color']; ?>}			.content-sidebar .widget .widget-title a{color: <?php echo $opt['primary_link_color']; ?>}
			.content-sidebar .widget .widget-title a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			.content-sidebar .widget_calendar caption{color: <?php echo $opt['primary_link_color']; ?>}
			/*.content-sidebar .widget_calendar thead th{background-color:rgba(0,0,0,.02)}*/
			/*.content-sidebar .widget_calendar tbody a,.content-sidebar .widget_calendar tbody a:hover{color:#fff}*/
			/*.content-sidebar .widget_twentyfourteen_ephemera .widget-title:before{background-color:#000;color:#fff}*/
			/*.content-sidebar .widget_twentyfourteen_ephemera .entry-meta{color:#ccc}*/
			/*.content-sidebar .widget_twentyfourteen_ephemera .entry-meta a{color:#767676}*/
			.content-sidebar .widget_twentyfourteen_ephemera .entry-meta a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.site-footer,.site-info,.site-info a{color:rgba(255,255,255,.7)}*/
			/*.site-footer{background-color:#000}*/
			.site-info a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.featured-content .hentry{color:#fff}*/
			/*.featured-content .entry-header{background-color:#000}*/
			/*.featured-content a{color:#fff}*/
			.featured-content a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.featured-content .entry-meta{color:#fff}*/
			/*.slider-control-paging{background-color:#000}*/
			/*.slider-control-paging a:before{background-color:#4d4d4d}*/
			.slider-control-paging a:hover:before{background-color: <?php echo $opt['primary_link_hover_color']; ?>}
			/*.slider-control-paging .slider-active:before,.slider-control-paging .slider-active:hover:before{background-color:#24890d}*/
			/*.slider-direction-nav a{background-color:#000}*/
			/*.slider-direction-nav a:hover{background-color:#24890d}*/
			/*.slider-direction-nav a:before{color:#fff}*/
			@media screen and (min-width:783px){
				.site-navigation li .current-menu-ancestor>a,.site-navigation li .current-menu-item>a,
					.site-navigation li .current_page_ancestor>a,
					.site-navigation li .current_page_item>a{color:<?php echo $opt['nav_text_color'];?>}
				.primary-navigation ul ul{background-color:<?php echo $opt['nav_bg_color'];?>}
				.primary-navigation li.focus>a,.primary-navigation li:hover>a{
					background-color:<?php echo $opt['nav_bg_hover_color'];?>;
					color:<?php echo $opt['nav_text_hover_color'];?>}
				.primary-navigation ul ul a:hover,.primary-navigation ul ul li.focus>a{
					background-color:<?php echo $opt['nav_bg_hover_color'];?>}
			}
			@media screen and (min-width:1008px){
				.site:before{background-color:<?php echo $opt['widget_bg_color']; ?>}
				#secondary{background-color:<?php echo $opt['widget_bg_color']; ?>}
				/*.secondary-navigation ul ul{background-color:#24890d}*/
				/*.secondary-navigation li.focus>a,.secondary-navigation li:hover>a{background-color:#24890d;color:#fff}*/
				.secondary-navigation ul ul a:hover,.secondary-navigation ul ul li.focus>a{background-color: <?php echo $opt['primary_link_hover_color']; ?>}
			}
			@media print{
				.entry-meta,.entry-meta a,.featured-content .hentry,.featured-content a,.site-title a,body{color: <?php echo $opt['primary_link_color']; ?>}*/
				/*.entry-meta .tag-links a{color:#fff}*/
			}
		</style> 
		<!--/Customizer CSS-->

	<?php 
    }

	/**
	 * Implements Color Me WP theme options into Theme Customizer.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return void
	 */
	public function _customize_register( $wp_customize ) {
		$colors = array();
// Header
		$colors[] = array(
			'slug'=>'title_color', 
			'default' => '#21759B',
			'label' => __('Title Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'title_hover_color', 
			'default' => '#64b7dd',
			'label' => __('Title Hover Color', 'cmw_2014'),
		);
		$colors[] = array(
			'slug'=>'search_bar_color', 
			'default' => '#21759B',
			'label' => __('Search Bar Color', 'cmw_2014')
		);
// Navigation
		//$colors[] = array(
		//	'slug'=>'h1_color', 
		//	'default' => '#21759B',
		//	'label' => __('h1,h2,h3,h4,h5,h6 Colors', 'cmw_2014')
		//);
		$colors[] = array(
			'slug'=>'nav_bg_color', 
			'default' => '#111',
			'label' => __('Navigation BG Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'nav_bg_hover_color', 
			'default' => '#000',
			'label' => __('Navigation BG Hover Color', 'cmw_2014')
		);

		$colors[] = array(
			'slug'=>'nav_text_color', 
			'default' => '#21759B',
			'label' => __('Navigation Text Color', 'cmw_2014')
		);

		$colors[] = array(
			'slug'=>'nav_text_hover_color', 
			'default' => '#64b7dd',
			'label' => __('Navigation Text Hover Color', 'cmw_2014')
		);

// Primary
		$colors[] = array(
			'slug'=>'primary_link_color', 
			'default' => '#21759B',
			'label' => __('Primary Link Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'primary_link_hover_color', 
			'default' => '#64b7dd',
			'label' => __('Primary Link Hover Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'article_color', 
			'default' => '#111',
			'label' => __('Article Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'article_bg_color', 
			'default' => '#000',
			'label' => __('Article Background Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'content_text_color', 
			'default' => '#fff',
			'label' => __('Content Text Color', 'cmw_2014')
		);

//Secondary
		$colors[] = array(
			'slug'=>'widget_link_color', 
			'default' => '#21759B',
			'label' => __('Widget Link Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'widget_link_hover_color', 
			'default' => '#64b7dd',
			'label' => __('Widget Link Hover Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'widget_bg_color', 
			'default' => '#000',
			'label' => __('Widget Background Color', 'cmw_2014')
		);
		$colors[] = array(
			'slug'=>'widget_color', 
			'default' => '#111',
			'label' => __('Widget Color', 'cmw_2014')
		);
		$i = 50;
		foreach( $colors as $color ) {

			$i++;
			$wp_customize->add_setting(
				$this->option_key . '['. $color['slug'] .']', array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					//'transport' => 'postMessage'
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$this->option_key . '_' . $color['slug'], 
					array(	'label' => $color['label'], 
							'section' => 'colors',
							'settings' => $this->option_key . '['. $color['slug'] .']',
							'priority' => $i )
				)
			);
		}

	}

	/**
	 * Not used
	 */
	function _enqueue_styles()  { 
			wp_register_style( 'color-me-wp-2014-colors', 
				get_stylesheet_directory_uri() . '/css/style.css.php', 
				array(), 
				date("Ymd"), 
				'all' );
			wp_enqueue_style( 'color-me-wp-2014-colors' );
	}

}
$_colors = new CMW_Colors();
