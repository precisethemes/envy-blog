<?php
/**
 * Pagination for blog.
 *
 * @package Envy Blog
 */

global $wp_query;
$big = 999999999; // need an unlikely integer

if ($wp_query->max_num_pages <= 1) {
    return;
} ?>
<nav class="navigation pagination" role="navigation">
    <h2 class="screen-reader-text"><?php esc_html_e('Posts navigation', 'envy-blog'); ?></h2>

    <div class="nav-links left">
        <?php
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'add_args' => false,
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'mid_size' => 4,
            'prev_text' => __('Previous', 'envy-blog'),
            'next_text' => __('Next', 'envy-blog'),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'envy-blog') . ' </span>',
        ));
        ?>
    </div>
</nav>
