<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Envy Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="container">
    <div class="row">

        <?php
        $is_sticky          = get_theme_mod( 'envy-blog_sticky_header_activate' );
        $header_class       = array( 'nav-bar' );
        $header_class[]     = 'nav-down';

        if ( true == $is_sticky ) {
            $header_class[] = 'is-sticky';
        }
        ?>

        <header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">

            <?php $header_layout = get_theme_mod( 'envy-blog_header_layout', 'header-layout-1' ); ?>

            <div class="nav-bar-container <?php echo esc_attr( $header_layout ); ?>">

                <?php

                    // Header Layout
                    if ( $header_layout == 'header-layout-1' ) {
                        get_template_part( 'layouts/header/header-layout-1', get_post_format() );
                    } elseif ( $header_layout == 'header-layout-6' ) {
                        get_template_part( 'layouts/header/header-layout-6', get_post_format() );
                    }
                ?>

            </div><!-- .nav-bar-container -->
        </header><!-- .nav-bar -->

        <div class="nav-bar-separator"></div><!-- .nab-bar-separator -->
    </div><!-- .row -->

    <?php
    $hero_homepage_activate         = get_theme_mod( 'envy-blog_hero_section_activate' );
    $hero_static_homepage_activate  = get_theme_mod( 'envy-blog_hero_section_on_static_page_activate' );
    if( ( true == $hero_homepage_activate  && is_home() ) || ( true == $hero_static_homepage_activate  && is_front_page() ) ) : ?>
    <div class="row">
        <?php
        // Hero Section
        $hero_layout = get_theme_mod( 'envy-blog_hero_layout', 'hero-layout-1' );

        if ( $hero_layout == 'hero-layout-1' ) {
            get_template_part( 'layouts/hero/hero-layout-1', get_post_format() );
        } elseif ( $hero_layout == 'hero-layout-2' ) {
            get_template_part('layouts/hero/hero-layout-2', get_post_format());
        } ?>
    </div>
<?php endif;

// Breadcrumbs
if ( get_theme_mod( 'envy-blog_general_breadcrumbs_activate', 1 ) == true ) {
    get_template_part( 'template-parts/breadcrumbs' );
}

