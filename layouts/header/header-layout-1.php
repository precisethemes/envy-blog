<?php
/**
 * The Header Layout-1
 *
 * @package Envy Blog
 */

$search_activate = get_theme_mod( 'envy-blog_header_search_icon_activate', true );
$cart_activate   = get_theme_mod( 'envy-blog_header_wc_cart_icon_activate', true ); ?>

<div class="site-branding">

    <?php if ( is_front_page() ) : ?>
        <h1 class="site-title">
            <?php the_custom_logo(); ?>

            <?php if( true == get_theme_mod( 'envy-blog_header_site_title_activate', true ) ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php } ?>
        </h1>
    <?php else : ?>
        <p class="site-title">
            <?php the_custom_logo(); ?>

            <?php if( true == get_theme_mod( 'envy-blog_header_site_title_activate', true ) ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php } ?>
        </p>
    <?php endif; ?>

    <?php
    if ( true == get_theme_mod( 'envy-blog_header_site_tagline_activate', true ) ) :
        $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
            <?php
        endif;
    endif;
    ?>
</div><!-- .site-branding -->

<div id="site-navigation" class="main-navigation" role="navigation">
    <div class="main-navigation-wrap d-none d-lg-block">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </div>

    <div class="main-navigation-wrap main-navigation-sm d-lg-none">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </div>

    <div class="nav-bar-extended">
        <?php if ( true == $search_activate || true == $cart_activate ) : ?>
            <ul>
                <?php if ( true == $search_activate ) { ?><li class="nav-bar-search-icon"><i class="pt-icon-search"></i></li><?php } ?>

                <?php if ( true == $cart_activate && class_exists( 'WooCommerce' ) ) { ?>
                    <li class="nav-bar-cart-icon">
                        <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
                            <i class="pt-icon-cart"></i>
                            <span class="nav-bar-cart">
                                <span class="nav-bar-cart-value">
                                    <?php echo wp_kses_data ( WC()->cart->get_cart_contents_count() ); ?>
                                </span>
                            </span>
                        </a>

                        <div class="nav-bar-shopping-cart-widget transition-35">
                            <?php the_widget('WC_Widget_Cart');  ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php endif; ?>

        <div class="hamburger-menu hamburger-menu-primary">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div><!-- .hamburger-menu -->
    </div><!-- .nav-bar-extended -->
</div><!-- #site-navigation -->

<?php if ( true == $search_activate ) { ?>
    <div class="nav-bar-search-wrap transition-5">
        <div class="nav-bar-search-close"><i class="pt-icon-close transition-5"></i></div>

        <div class="nav-bar-search-holder">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Start Typing Here&hellip;', 'placeholder', 'envy-blog' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'envy-blog' ); ?>" />
                <p><?php echo esc_html__( 'Press Enter/Return to start Search', 'envy-blog'); ?></p>
                <input type="hidden" name="post_type" value="Search" />
            </form>
        </div><!-- .nav-bar-search-holder -->
    </div><!-- .nav-bar-search-wrap -->
<?php } ?>