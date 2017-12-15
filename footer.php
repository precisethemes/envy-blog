<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Envy Blog
 */

?>

    <footer class="site-footer">

        <?php $activate_footer_widget_area = get_theme_mod( 'envy-blog_footer_widgets_section_activate', true );
            $footer_widget_layout = get_theme_mod( 'envy-blog_footer_widgets_area_layout', 'footer-layout-8' );

            if ( true == $activate_footer_widget_area ) : ?>

                <div class="footer-widgets <?php echo esc_attr( $footer_widget_layout ); ?>">
                    <?php
                        // Footer Widget Layout
                        if ( $footer_widget_layout == 'footer-layout-8' ) {
                            get_template_part( 'layouts/footer/footer-col-4', get_post_format() );
                        }
                    ?>

                </div><!-- .footer-widgets -->
                <?php
            endif;

            get_template_part( 'layouts/footer-bar/footer-bar', get_post_format() ); // load footer bar content
            ?>

    </footer><!-- .site-footer -->

    <?php if ( true == get_theme_mod( 'envy-blog_footer_back_to_top_activate', true ) ) {
    
        $go_to_top_button_text       = get_theme_mod( 'envy-blog_footer_back_to_top_text', 'Back to Top' ); ?>

        <div class="back-to-top">
            <?php echo esc_html( $go_to_top_button_text ); ?>
        </div><!-- #back-to-top -->

    <?php } ?>

</div><!-- .container -->

<?php wp_footer(); ?>

</body>
</html>