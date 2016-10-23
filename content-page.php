<?php
/**
 * The Page content template file.
 *
 * @package Sento
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content(); ?>

		</article>

