<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
# Prints HTML with meta information for the current post-date/time and author.
-------------------------------------------------------------------------*/
if( !function_exists( 'envy_blog_posts_date' ) ) {
	function envy_blog_posts_date() {
		$date_label    = esc_html__( 'Published on: ', 'envy-blog' );

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '';
		if ( is_single() && $date_label != '' ) {
            $posted_on .= '<label class="date-label">'.esc_html( $date_label ).'</label>';
        }
		$posted_on .= '<span class="date-format">';
		$posted_on .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		$posted_on .= $time_string;
		$posted_on .= '</a>';
		$posted_on .= '</span>';

		return $posted_on;
	}
}

if( !function_exists( 'envy_blog_posts_author' ) ) {
	function envy_blog_posts_author() {
		$author_label  = esc_html__( 'Author: ', 'envy-blog' );

		$byline = '';
		if ( is_single() && $author_label != '' ) {
            $byline .= '<label class="author-label">'.esc_html( $author_label ).'</label>';
        }
		$byline .= '<span class="author vcard">';
		$byline .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>';
		$byline .= '</span>';

		return $byline;
	}
}

if( !function_exists( 'envy_blog_posts_comment' ) ) {
	function envy_blog_posts_comment() {
        
        $comment_singular_label    = esc_html__( 'Comment: ', 'envy-blog' );
        $comment_plural_label      = esc_html__( 'Comments: ', 'envy-blog' );

		$comment_count   = (int) get_comments_number( get_the_ID() );

		$comment 		 = '';
		if ( is_single() && ( $comment_plural_label || $comment_singular_label ) != '' ) {
            if ( 1 < $comment_count ) {
                $comment .= '<label class="comments-label">'.esc_html( $comment_plural_label ).'</label>';
            } else {
                $comment .= '<label class="comment-label">'.esc_html( $comment_singular_label ).'</label>';
            }
        }
		$comment 		.= '<span class="comment">';
		$comment 		.= '<a href="' . esc_url( get_comments_link() ) .'">';
		$comment 		.= absint( $comment_count );
		$comment 		.= '</a>';
		$comment 		.= '</span>';

		return $comment;
	}
}

if( !function_exists( 'envy_blog_posts_category' ) ) {
	function envy_blog_posts_category() {

        $category_singular_label   = esc_html__( 'Category: ', 'envy-blog' );
        $category_plural_label     = esc_html__( 'Categories: ', 'envy-blog' );

		/* translators: used between list items, there is a space after the comma */
		$separate_meta 	 = ', ';

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );
		$category 		 = '';
		// We don't want to output.
		if ( ( envy_blog_categorized_blog() && $categories_list ) ) {

			if ( is_single() && ( $category_singular_label || $category_plural_label ) != '' ) {
                if ( 1 < count( get_the_category() ) ) {
                    $category .= '<label class="categories-label">'.esc_html( $category_plural_label ).'</label>';
                } else {
                    $category .= '<label class="category-label">'.esc_html( $category_singular_label ).'</label>';
                }
            }
			$category 		.= '<span class="cat-links">';
			$category 		.= $categories_list;
			$category 		.= '</span>';
		}
		return $category;
	}
}

if( !function_exists( 'envy_blog_posts_tags' ) ) {
	function envy_blog_posts_tags() {
        $post_tag_label   = esc_html__( ' and tagged in: ', 'envy-blog' );

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = ', ';

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );
		$tags 		 = '';
        // We don't want to output.
        if ( $tags_list ) {
            if ( is_single() && ( $post_tag_label  ) != '' ) {

                $tags .= '<label class="tag-label">';
                $tags .= esc_html( $post_tag_label );
                $tags .= '</label>';

            }
			$tags 		.= '<span class="tag-links">';
			$tags 		.= $tags_list;
			$tags 		.= '</span>';
		}
		return $tags;
	}
}

/*----------------------------------------------------------------------
# Returns an accessibility-friendly link to edit a post or page.
-------------------------------------------------------------------------*/
if( ! function_exists( 'envy_blog_edit_link' ) ) {
    function envy_blog_edit_link() {

        $link = edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'envy-blog' ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );

        return $link;
    }
}

/*----------------------------------------------------------------------
# Returns true if a blog has more than 1 category.
-------------------------------------------------------------------------*/
function envy_blog_categorized_blog() {
	$category_count = get_transient( 'envy_blog_categories' );

	if( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'envy_blog_categories', $category_count );
	}

	return $category_count > 1;
}

/*----------------------------------------------------------------------
# Flush out the transients used in envy_blog_categorized_blog.
-------------------------------------------------------------------------*/
function envy_blog_category_transient_flusher() {
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'envy_blog_categories' );
}
add_action( 'edit_category', 'envy_blog_category_transient_flusher' );
add_action( 'save_post',     'envy_blog_category_transient_flusher' );


/*----------------------------------------------------------------------
# Display the archive title based on the queried object.
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_archive_title' ) ) {
	function envy_blog_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( '<label><span>Category %s', 'envy-blog' ), '</span></label>' . single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( '<label><span>Tag %s', 'envy-blog' ), '</span></label>' . single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = get_the_author();
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'envy-blog' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'envy-blog' ) ) . '</span>' );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'envy-blog' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'envy-blog' ) ) . '</span>' );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'envy-blog' ), '<span>' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'envy-blog' ) ) . '</span>' );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'envy-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'envy-blog' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'envy-blog' ), '<span>' . post_type_archive_title( '', false ) . '</span>' );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'envy-blog' ), $tax->labels->singular_name, '<span>' . single_term_title( '', false ) . '</span>' );
		} else {
			$title = __( 'Archives', 'envy-blog' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
}

