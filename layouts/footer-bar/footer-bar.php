<?php
/**
 * Footer Bar layout.
 *
 * @package Envy Blog
 */


$default_order = array (
    'footer-bar-text',
);
$content_order_lists    = get_theme_mod( 'envy-blog_footer_bar_content_order_list', $default_order );
$footer_class           = array( 'footer-bar' );
$count                  = count( $content_order_lists );

if ( $count == 1 ) {
    $footer_class[] = 'align-center';
}

if ( ! empty( $content_order_lists ) ) : ?>

    <div id="colophon" class="<?php echo esc_attr( implode( ' ', $footer_class ) ); ?> has-footer-bar-col-<?php echo esc_attr( $count )?>" role="contentinfo">

        <?php foreach ( $content_order_lists as $key => $content_order )  :

            if ( $content_order == 'footer-bar-text' ) { ?>

                <div class="footer-copyright has-footer-bar-col-<?php echo esc_attr( $count )?>">
                    <?php do_action( 'envy_blog_footer' ); ?>
                </div><!-- .footer-copyright -->

            <?php } elseif ( $content_order == 'footer-bar-social' ) { ?>

                <div class="footer-social has-footer-bar-col-<?php echo esc_attr( $count )?>">
                    <?php the_widget( 'Envy_Blog_Social_Profiles_Widget' ); ?>
                </div><!-- .footer-social -->

            <?php }

        endforeach; ?>

    </div><!-- #colophon -->

<?php endif;
