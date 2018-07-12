<?php
/**
 * Hero Header Layout 2
 * @package Envy Blog
 */
$hero_layout                     = get_theme_mod( 'envy-blog_hero_layout', 'hero-layout-1' );
$hero_content_title              = get_theme_mod( 'envy-blog_hero_title_text', '' );
$hero_content_subtitle           = get_theme_mod( 'envy-blog_hero_subtitle_text', '' );
$hero_content_description        = get_theme_mod( 'envy-blog_hero_description_text', '' );
$hero_content_image              = get_theme_mod( 'envy-blog_hero_background_image', '' );
$hero_content_button_text        = get_theme_mod( 'envy-blog_hero_settings_button_text', 'Discover' );
$hero_content_button_url         = get_theme_mod( 'envy-blog_hero_settings_button_url', '#' );
$hero_content_button_open        = get_theme_mod( 'envy-blog_hero_settings_button_link_target', '_self' );
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

$inline_style                   = '';
if ( $hero_content_image && $hero_content_image !== 0  ) {
    $image_path                 = wp_get_attachment_image_src( $hero_content_image, 'envy-blog-1200-16x9', true );
    $image_url                  = $image_path[0];
    $inline_style               = ' style="background-image: url(' . esc_url( $image_url ) . ')"';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $hero_class ) ); ?>"<?php echo $inline_style; ?>>
    <div class="hero-image">
        <div class="<?php echo esc_attr( implode( ' ', $hero_content_class ) ); ?>">
            <?php if ( $hero_content_subtitle != '' || $hero_content_title != '' ) : ?>
                <header class="entry-title">
                    <?php if ( $hero_content_subtitle != '' ) {?><h3><?php echo esc_html( $hero_content_subtitle ); ?></h3><?php } ?>

                    <?php if ( $hero_content_title != '' ) {?><h2><?php echo esc_html( $hero_content_title ); ?></h2><?php } ?>
                </header><!-- .entry-title -->
            <?php endif; ?>

            <?php if ( $hero_content_description != '' ) : ?>
                <div class="entry-content">
                    <p><?php echo wp_kses_post( $hero_content_description ); ?></p>
                </div><!-- .entry-content -->
            <?php endif; ?>

            <?php if ( true == $slide_button_activate ) : ?>
                <footer class="entry-footer">
                    <a class="<?php echo esc_attr( implode( ' ', $btn_class ) ); ?>" href="<?php echo esc_url( $hero_content_button_url );?>" target="<?php echo esc_attr($hero_content_button_open); ?>"><?php echo esc_html( $hero_content_button_text ); ?></a>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
        </div><!-- .hero-content -->
    </div><!-- .hero-image -->
</div><!-- .hero-section -->
