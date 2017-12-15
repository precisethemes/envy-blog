<?php
/**
 * Hero Header Layout 1
 * @package Envy Blog
 */
$default_content_image_url       = THEME_URI . '/inc/assets/images/hero/mountain-16x9.jpg';
$hero_layout                     = get_theme_mod( 'envy-blog_hero_layout', 'hero-layout-1' );
$hero_content_title              = get_theme_mod( 'envy-blog_hero_title_text', 'Hero Header Title' );
$hero_content_subtitle           = get_theme_mod( 'envy-blog_hero_subtitle_text', 'Hero Header Subtitle' );
$hero_content_description        = get_theme_mod( 'envy-blog_hero_description_text', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat' );
$hero_content_image              = get_theme_mod( 'envy-blog_hero_background_image', $default_content_image_url );
$hero_content_button_text        = get_theme_mod( 'envy-blog_hero_settings_button_text', 'Discover' );
$hero_content_button_url         = get_theme_mod( 'envy-blog_hero_settings_button_url', '#' );
$hero_content_color_scheme       = get_theme_mod( 'envy-blog_hero_content_section_color_scheme', 'dark' );
$hero_content_align              = get_theme_mod( 'envy-blog_hero_text_alignment', 'center' );

$slide_button_activate           = get_theme_mod( 'envy-blog_hero_settings_button_activate', true );
$slide_button_type               = get_theme_mod( 'envy-blog_hero_settings_button_type', 'arrow' );
$slide_button_transparency       = get_theme_mod( 'envy-blog_hero_settings_button_transparency', true );

$hero_class                     = array('hero-section');
$hero_class[]                   = 'dark';
$hero_class[]                   = $hero_layout;

$hero_content_class             = array('hero-content');
$hero_content_class[]           = 'text-align-'.$hero_content_align;

$btn_class                      = array('btn');
$btn_class[]                    = 'dark';
$btn_class[]                    = $slide_button_type;
if ( true == $slide_button_transparency ) {
    $btn_class[]                = 'transparent';
}


if ( $hero_content_image != $default_content_image_url ) {
    $image_id = envy_blog_get_attachment_id_from_url( $hero_content_image );
    $image_path = wp_get_attachment_image_src( $image_id, 'envy-blog-1200-16x9', true );
    $image_url = $image_path[0];
} else {
    $image_url = $default_content_image_url;
}
?>

<div class="<?php echo esc_attr( implode( ' ', $hero_class ) ); ?>" <?php if ( $hero_content_image != '' ) { echo 'style="background-image: url(' . esc_url( $image_url ) . ')"'; } ?>>
    <div class="hero-image">
        <div class="<?php echo esc_attr( implode( ' ', $hero_content_class ) ); ?>">
            <?php if ( $hero_content_subtitle != '' || $hero_content_title != '' ) : ?>
                <header class="entry-title">
                    <?php if ( $hero_content_subtitle != '' ) {?><h3><?php echo esc_html( $hero_content_subtitle ); ?></h3><?php } ?>

                    <?php if ( $hero_content_title != '' ) {?><h1><?php echo esc_html( $hero_content_title ); ?></h1><?php } ?>
                </header><!-- .entry-title -->
            <?php endif; ?>

            <?php if ( $hero_content_description != '' ) : ?>
                <div class="entry-content">
                    <p><?php echo wp_kses_post( $hero_content_description ); ?></p>
                </div><!-- .entry-content -->
            <?php endif; ?>

            <?php if ( true == $slide_button_activate ) : ?>
                <footer class="entry-footer">
                    <a class="<?php echo esc_attr( implode( ' ', $btn_class ) ); ?>" href="<?php echo esc_url( $hero_content_button_url );?>"><?php echo esc_html( $hero_content_button_text ); ?></a>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
        </div><!-- .hero-content -->
    </div><!-- .hero-image -->
</div><!-- .hero-section -->
