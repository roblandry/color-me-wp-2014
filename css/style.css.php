<?php
//require('../inc/options-framework.php');
require '../../../../wp-load.php'; // load wordpress bootstrap, this is what I don't like
header("Content-type: text/css; charset: UTF-8");
$opt = get_option( 'cmw_2014_options' ); ?>

/* Colors */

/* TwentyFourteen */
body,button,input,select,textarea{color:<?php echo $opt['content_text_color']; ?>}
body{background:<?php echo $opt['article_bg_color']; ?>}
body.custom-background{background:<?php echo $opt['article_bg_color']; ?> !important}
a{color: <?php echo $opt['primary_link_color']; ?>}
a:active,a:hover{color: <?php echo $opt['primary_link_hover_color']; ?>}
ins,mark{background:#fff9c0}
blockquote{color:#767676}
blockquote cite,blockquote small{color:#2b2b2b}
del{color:#767676}
::selection{background:<?php echo $opt['nav_text_hover_color'];?>;color:#fff}
::-moz-selection{background:<?php echo $opt['nav_text_hover_color'];?>;color:<?php echo $opt['nav_text_color'];?>}
input,textarea{color:#2b2b2b}
.contributor-posts-link,button,input[type=button],input[type=reset],input[type=submit]{background-color:<?php echo $opt['primary_link_color']; ?>;color:#fff}
.contributor-posts-link:hover,button:focus,button:hover,input[type=button]:focus,input[type=button]:hover,input[type=reset]:focus,input[type=reset]:hover,input[type=submit]:focus,input[type=submit]:hover{background-color:<?php echo $opt['primary_link_hover_color']; ?>;color:#fff}
.contributor-posts-link:active,button:active,input[type=button]:active,input[type=reset]:active,input[type=submit]:active{background-color:#55d737}
::-webkit-input-placeholder{color:#939393}
:-moz-placeholder{color:#939393}
::-moz-placeholder{color:#939393}
:-ms-input-placeholder{color:#939393}
.wp-caption{color:#767676}
.screen-reader-text:focus{background-color:#f1f1f1;color:#21759b}
.site{background-color:<?php echo $opt['article_bg_color']; ?>}
.site-header{background-color:<?php echo $opt['nav_bg_color']; ?>}
.site-title a{color:<?php echo $opt['title_color']; ?>}
.site-title a:hover{color:<?php echo $opt['title_hover_color']; ?>}
.search-toggle{background-color:<?php echo $opt['search_bar_color']; ?>}
.search-toggle.active,.search-toggle:hover{background-color:<?php echo $opt['search_bar_color']; ?>}
.search-toggle:before{color:#fff}
.search-box{background-color:<?php echo $opt['search_bar_color']; ?>}
.search-box .search-field{background-color:#fff}
.site-navigation a{color:<?php echo $opt['nav_text_color']; ?>}
.site-navigation a:hover{color:<?php echo $opt['nav_text_hover_color']; ?>}
.site-navigation .current-menu-ancestor>a,.site-navigation .current-menu-item>a,.site-navigation .current_page_ancestor>a,.site-navigation .current_page_item>a{color:<?php echo $opt['content_text_color']; ?>}
.menu-toggle:before{color:#fff}
a.post-thumbnail:hover{background-color:#999}
.entry-title a{color:<?php echo $opt['title_color'];?>}
.entry-title a:hover{color:<?php echo $opt['title_hover_color'];?>}
.site-content .entry-header{background-color: <?php echo $opt['article_color']; ?>}
.entry-meta,.entry-meta a{color:<?php echo $opt['primary_link_color']; ?>}
.entry-meta a:hover{color:<?php echo $opt['primary_link_hover_color']; ?>}
.cat-links a{color:<?php echo $opt['primary_link_color']; ?>}
.cat-links a:hover{color:<?php echo $opt['primary_link_hover_color']; ?>}
.site-content .entry-meta{background-color:#fff}
.entry-meta .tag-links a{background:<?php echo $opt['nav_bg_hover_color']; ?>;color:<?php echo $opt['content_text_color']; ?>}
.entry-meta .tag-links a:before{border-right: 8px solid <?php echo $opt['nav_bg_hover_color']; ?>}
.entry-meta .tag-links a:hover{background:<?php echo $opt['nav_text_color']; ?>;color:<?php echo $opt['nav_bg_color']; ?>}
.entry-meta .tag-links a:hover:before{border-right-color:<?php echo $opt['nav_text_color']; ?>}
.entry-meta .tag-links a:after,.page-content,.site-content .entry-content,.site-content .entry-summary{background-color:#fff}
.entry-content .edit-link a{color:#767676;}
.entry-content .edit-link a:hover{color:#41a62a}
.hentry .mejs-container .mejs-controls,.hentry .mejs-mediaelement{background:#000}
.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,.hentry .mejs-controls .mejs-time-rail .mejs-time-loaded{background:#fff}
.hentry .mejs-controls .mejs-time-rail .mejs-time-current{background:#24890d}
.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,.hentry .mejs-controls .mejs-time-rail .mejs-time-total{background:rgba(255,255,255,.33)}
.page-links a,.page-links>span{background:<?php echo $opt['nav_text_color']; ?>;color:<?php echo $opt['nav_bg_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
.page-links a{background:<?php echo $opt['nav_bg_hover_color']; ?>;color:<?php echo $opt['content_text_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
.page-links a:hover{background:<?php echo $opt['nav_text_color']; ?>;color:<?php echo $opt['nav_bg_color']; ?>;border:1px solid <?php echo $opt['nav_text_color']; ?>}
.gallery-caption{color:#fff}
.post-navigation .meta-nav{color:#767676}
.image-navigation a,.post-navigation a{color:#2b2b2b}
.image-navigation a:hover,.post-navigation a:hover{color:#41a62a}
.paging-navigation a{color:#2b2b2b}
.paging-navigation a:hover{color:#2b2b2b}
.author-description,.taxonomy-description{color:#767676}
.comment-author a{color:#2b2b2b}
.comment-list .pingback a,.comment-list .trackback a,.comment-metadata a{color:#767676}
.comment-author a:hover,.comment-list .pingback a:hover,.comment-list .trackback a:hover,.comment-metadata a:hover{color:#41a62a}
.comment-awaiting-moderation,.comment-notes,.form-allowed-tags,.form-allowed-tags code,.logged-in-as,.no-comments{color:#767676}
.required{color:#c0392b}
.comment-reply-title small a{color:#2b2b2b}
.comment-reply-title small a:hover{color:#41a62a}
#secondary{background-color:<?php echo $opt['widget_bg_color']; ?>}
.content-sidebar{color:#767676}
.widget a{color:<?php echo $opt['widget_link_color']; ?>}
.widget a:hover{color:<?php echo $opt['widget_link_hover_color']; ?>}
.widget ins,.widget mark{color:#000}
.widget blockquote{color:rgba(255,255,255,.7)}
.widget blockquote cite{color:#fff}
.widget del{color:rgba(255,255,255,.4)}
.widget hr{background-color:rgba(255,255,255,.2)}
.widget input,.widget textarea{background-color:rgba(255,255,255,.1);color:#fff}
.widget input:focus,.widget textarea:focus{border-color:rgba(255,255,255,.3)}
.widget button,.widget input[type=button],.widget input[type=reset],.widget input[type=submit]{background-color:#24890d}
.widget input[type=button]:focus,.widget input[type=button]:hover,.widget input[type=reset]:focus,.widget input[type=reset]:hover,.widget input[type=submit]:focus,.widget input[type=submit]:hover{background-color:#41a62a}
.widget input[type=button]:active,.widget input[type=reset]:active,.widget input[type=submit]:active{background-color:#55d737}
.widget .wp-caption{color:rgba(255,255,255,.7)}
.widget-title,.widget-title a{color:<?php echo $opt['title_color'];?>}
.widget-title a:hover{color:<?php echo $opt['title_hover_color'];?>}
.widget_calendar caption{color:#fff}
.widget_calendar thead th{background-color:rgba(255,255,255,.1)}
.widget_calendar tbody a{background-color:#24890d;color:#fff}
.widget_calendar tbody a:hover{background-color:#41a62a;color:#fff}
.widget_twentyfourteen_ephemera .entry-meta a{color:rgba(255,255,255,.7)}
.widget_twentyfourteen_ephemera .entry-meta a:hover{color:#41a62a}
.content-sidebar .widget a{color:#24890d}
.content-sidebar .widget a:hover{color:#41a62a}
.content-sidebar .widget ins,.content-sidebar .widget mark{color:#2b2b2b}
.content-sidebar .widget blockquote{color:#767676}
.content-sidebar .widget blockquote cite{color:#2b2b2b}
.content-sidebar .widget del{color:#767676}
.content-sidebar .widget hr{background-color:rgba(0,0,0,.1)}
.content-sidebar .widget input,.content-sidebar .widget textarea{background-color:#fff;color:#2b2b2b}
.content-sidebar .widget input[type=button],.content-sidebar .widget input[type=reset],.content-sidebar .widget input[type=submit]{background-color:#24890d;color:#fff}
.content-sidebar .widget input[type=button]:focus,.content-sidebar .widget input[type=button]:hover,.content-sidebar .widget input[type=reset]:focus,.content-sidebar .widget input[type=reset]:hover,.content-sidebar .widget input[type=submit]:focus,.content-sidebar .widget input[type=submit]:hover{background-color:#41a62a}
.content-sidebar .widget input[type=button]:active,.content-sidebar .widget input[type=reset]:active,.content-sidebar .widget input[type=submit]:active{background-color:#55d737}
.content-sidebar .widget .wp-caption{color:#767676}
.content-sidebar .widget .widget-title{border-top:5px solid #000;color:#2b2b2b}
.content-sidebar .widget .widget-title a{color:#2b2b2b}
.content-sidebar .widget .widget-title a:hover{color:#41a62a}
.content-sidebar .widget_calendar caption{color:#2b2b2b}
.content-sidebar .widget_calendar thead th{background-color:rgba(0,0,0,.02)}
.content-sidebar .widget_calendar tbody a,.content-sidebar .widget_calendar tbody a:hover{color:#fff}
.content-sidebar .widget_twentyfourteen_ephemera .widget-title:before{background-color:#000;color:#fff}
.content-sidebar .widget_twentyfourteen_ephemera .entry-meta{color:#ccc}
.content-sidebar .widget_twentyfourteen_ephemera .entry-meta a{color:#767676}
.content-sidebar .widget_twentyfourteen_ephemera .entry-meta a:hover{color:#41a62a}
.site-footer,.site-info,.site-info a{color:rgba(255,255,255,.7)}
.site-footer{background-color:#000}
.site-info a:hover{color:#41a62a}
.featured-content .hentry{color:#fff}
.featured-content .entry-header{background-color:#000}
.featured-content a{color:#fff}
.featured-content a:hover{color:#41a62a}
.featured-content .entry-meta{color:#fff}
.slider-control-paging{background-color:#000}
.slider-control-paging a:before{background-color:#4d4d4d}
.slider-control-paging a:hover:before{background-color:#41a62a}
.slider-control-paging .slider-active:before,.slider-control-paging .slider-active:hover:before{background-color:#24890d}
.slider-direction-nav a{background-color:#000}
.slider-direction-nav a:hover{background-color:#24890d}
.slider-direction-nav a:before{color:#fff}
.widget_wrapper{background-color:<?php echo $opt['widget_color']; ?>}
@media screen and (min-width:783px){
.site-navigation li .current-menu-ancestor>a,.site-navigation li .current-menu-item>a,.site-navigation li .current_page_ancestor>a,.site-navigation li .current_page_item>a{color:<?php echo $opt['nav_text_color'];?>}
.primary-navigation ul ul{background-color:<?php echo $opt['nav_bg_color'];?>}
.primary-navigation li.focus>a,.primary-navigation li:hover>a{background-color:<?php echo $opt['nav_bg_hover_color'];?>;color:<?php echo $opt['nav_text_hover_color'];?>}
.primary-navigation ul ul a:hover,.primary-navigation ul ul li.focus>a{background-color:<?php echo $opt['nav_bg_hover_color'];?>}
}
@media screen and (min-width:1008px){.site:before{background-color:<?php echo $opt['widget_bg_color']; ?>}
#secondary{background-color:<?php echo $opt['widget_bg_color']; ?>}
.secondary-navigation ul ul{background-color:#24890d}
.secondary-navigation li.focus>a,.secondary-navigation li:hover>a{background-color:#24890d;color:#fff}
.secondary-navigation ul ul a:hover,.secondary-navigation ul ul li.focus>a{background-color:#41a62a}
}
@media print{.entry-meta,.entry-meta a,.featured-content .hentry,.featured-content a,.site-title a,body{color:#2b2b2b}
.entry-meta .tag-links a{color:#fff}
}

/* Custom */
article {margin: 0 10px !important}
article, .entry-header, .entry-meta, .entry-content	{ background-color:  <?php echo $opt['article_color']; ?> !important}
