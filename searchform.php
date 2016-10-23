<?php
/**
 * The template for displaying search forms.
 *
 * @package Sento
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php _e( 'Search', 'sento' ) . ' &hellip;'; ?>" />
		<input type="submit" class="searchsubmit" name="submit" value="<?php _e( 'Search', 'sento' ); ?>" />
	</form>