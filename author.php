<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title">
					<?php
						/*
						 * Queue the first post, that way we know what author
						 * we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop properly
						 * with a call to rewind_posts().
						 */
						the_post();

						//printf( __( 'All posts by %s', 'twentyfourteen' ), get_the_author() );
					?>
				</h1>
				<div id="author-info">
					<div id="author-description">

						<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>


						<h2><?php printf( __( 'About %s', 'cmw_2014' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?>
						<?php 
						/*echo "<br>"; */
						/*the_author_meta( 'aim' ); */
						/*the_author_meta( 'description' ); */
						/*the_author_meta( 'display_name' ); */
						/*the_author_meta( 'first_name' ); */
						/*the_author_meta( 'ID' ); */
						/*the_author_meta( 'jabber' ); */
						/*the_author_meta( 'last_name' ); */
						/*the_author_meta( 'nickname' ); */
						/*the_author_meta( 'user_email' ); */
						/*the_author_meta( 'user_login' ); */
						/*the_author_meta( 'user_nicename' ); */
						/*the_author_meta( 'user_registered' ); */
						/*the_author_meta( 'user_url' ); */
						/*the_author_meta( 'yim' ); */ ?>

					</p></div><!-- #author-description	-->
					<?php if ( get_the_author_meta( 'google_profile' ) ) : ?>
						<a href="<?php the_author_meta( 'google_profile' ); ?> " rel="me">Google+</a>
					<?php endif; ?>

				</div><!-- #entry-author-info -->

			</header><!-- .archive-header -->

			<?php
					/*
					 * Since we called the_post() above, we need to rewind
					 * the loop back to the beginning that way we can run
					 * the loop properly, in full.
					 */
					rewind_posts();

					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
