<?php
/**
* This function is responsible for rendering meta-boxes in single post/page area
* 
* @package Envy Blog
*/

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* --------------------------------------------- 
# Page/Post Layout Options
---------------------------------------------*/
class Envy_Blog_Layout_Meta_Box {

	public function __construct() {

		if( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		// Adding layout meta box for Page/post/wc product
		add_meta_box( 
			'page_layout', 
			esc_html__( 'Select Layout', 'envy-blog' ),
			array( $this, 'render_metabox' ),
			array( 'post', 'page', 'product' ),
			'advanced', 
			'high' 
		);
	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( basename( __FILE__ ), 'envy_blog_layout_metabox_nonce' );

        // Retrieve an existing value from the database.
        $layout = get_post_meta( $post->ID, 'specific_page_layout', true );

        // Set default values.
        if( empty( $layout ) ) $layout = 'default-sidebar'; ?>

        <div class="inside">
            <div id="specific-page-layout">
                <fieldset>

                    <input type="radio" name="specific_page_layout" id="has-default-sidebar" value="default-sidebar" <?php echo checked( $layout, 'default-sidebar', false ); ?>>
                    <label for="has-default-sidebar" class="has-default-sidebar"><?php echo esc_html__( 'Default Sidebar', 'envy-blog' ); ?></label>

                    <input type="radio" name="specific_page_layout" id="has-left-sidebar" value="left-sidebar" <?php echo checked( $layout, 'left-sidebar', false ); ?>>
                    <label for="has-left-sidebar" class="has-left-sidebar"><?php echo esc_html__( 'Left Sidebar', 'envy-blog' ); ?></label>

                    <input type="radio" name="specific_page_layout" id="has-no-sidebar" value="full-width" <?php echo checked( $layout, 'full-width', false ); ?>>
                    <label for="has-no-sidebar" class="has-no-sidebar"><?php echo esc_html__( 'Full Width', 'envy-blog' ); ?></label>

                    <input type="radio" name="specific_page_layout" id="has-right-sidebar" value="right-sidebar" <?php echo checked( $layout, 'right-sidebar', false ); ?>>
                    <label for="has-right-sidebar" class="has-right-sidebar"><?php echo esc_html__( 'Right Sidebar', 'envy-blog' ); ?></label>

                </fieldset>
            </div>
        </div>

		<?php
	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		if( !isset( $_POST['envy_blog_layout_metabox_nonce'] ) || !wp_verify_nonce( $_POST['envy_blog_layout_metabox_nonce'], basename( __FILE__ ) ) )
    		return;

		// Stop WP from clearing custom fields on auto-save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if( 'page' == $_POST['post_type'] ) {
			if( !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		}
		elseif( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

        // Layout update the meta field in the database.
        if( isset( $_POST['specific_page_layout'] ) ) {
            update_post_meta( $post_id, 'specific_page_layout', sanitize_text_field( $_POST['specific_page_layout'] ) );
        } else {
            delete_post_meta( $post_id, 'specific_page_layout' );
        }
	}
}
new Envy_Blog_Layout_Meta_Box;
