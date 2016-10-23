<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Sento
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sento' ), 'after'  => '</div>', ) ); ?>

				<?php /* Add Social Share */  thinkup_input_share(); ?>

				<?php thinkup_input_nav( 'nav-below' ); ?>

				<?php /* Add comments */ thinkup_input_allowcomments(); ?>

			<?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ?>