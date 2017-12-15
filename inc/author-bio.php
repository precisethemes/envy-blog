<?php
/**
 * Displays Author Bio Info in Single Post
 *
 * @package Envy Blog
 */

$user_id            = get_current_user_id();
$author             = get_the_author();
$author_description = get_the_author_meta( 'description' );
$author_website     = get_the_author_meta( 'url' );
$author_url         = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
$author_avatar      = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'envy_blog_author_bio_avatar_size', 75 ) ); ?>

<div class="author-box">
    <header>
        <?php if ( $author_avatar ) { ?>
            <figure class="author-avatar">
                <?php echo $author_avatar; ?>
            </figure><!-- .author-avatar -->
        <?php } ?>

        <div class="author-content">
            <h4><a href="<?php echo esc_url( $author_url ); ?>" class="author-name" rel="author"><?php echo esc_html( $author ); ?></a></h4>

            <?php if ( $author_website != '' ) : ?>
                <div class="author-website">
                    <a href="<?php echo esc_url( $author_website ); ?>" target="_blank"><?php echo esc_url( $author_website ); ?></a>
                </div>
            <?php endif; ?>

        </div>
    </header>

    <?php if ( $author_description ) : ?>
        <div class="author-info">
            <p><?php echo wp_kses_post( $author_description ); ?></p>
        </div><!-- .author-info -->
    <?php endif; ?>

</div><!-- .author-box -->
