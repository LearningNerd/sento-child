<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Sento
 */
?>

		<div id="sidebar">
		<div id="sidebar-core">

			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( thinkup_input_sidebars() ) ) : ?>

				<aside class="widget widget_text">
					<h3 class="widget-title"><?php _e( 'Please Add Widgets', 'sento' ); ?></h3>
					<div class="textwidget"><div class="error-icon">
						<p><?php _e( 'Remove this message by adding widgets to the Sidebar from the Widgets section of the Wordpress admin area.', 'sento' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" title="<?php _e( 'No Widgets Selected', 'sento' ); ?>"><?php _e( 'Click here to go to Widget area.', 'sento' ); ?></a>
					</div></div>
				</aside>

			<?php endif; ?>

		</div>
		</div><!-- #sidebar -->
				