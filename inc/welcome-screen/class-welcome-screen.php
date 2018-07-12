<?php
/**
 * Envy Blog Welcome Screen
 *
 * @package Envy Blog
 * @since   1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Envy_Blog_Welcome_Screen' ) ) :

    /**
     * Envy_Blog_Welcome_Screen Class.
     */
    class Envy_Blog_Welcome_Screen {

        /**
         * Constructor.
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( 'PAnD', 'init' ) );
            add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
        }

        /**
         * Add admin menu.
         */
        public function admin_menu() {

            add_theme_page(
                esc_html__( 'Getting Started', 'envy-blog' ),
                esc_html__( 'Getting Started', 'envy-blog' ),
                'edit_theme_options',
                'envy-blog-welcome' ,
                array( $this, 'welcome_screen' )
            );
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice() {
            if ( ! PAnD::is_admin_notice_active( 'envy-blog-welcome-forever' ) ) {
                return;
            } ?>

            <div data-dismissible="envy-blog-welcome-forever" class="updated notice notice-success is-dismissible welcome-notice">

                <h1><?php printf( esc_html__( 'Welcome to %s', 'envy-blog' ), ENVY_BLOG_THEME_NAME ); ?></h1>
                <p><?php printf( esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.', 'envy-blog' ),ENVY_BLOG_THEME_NAME,'<a href="' . esc_url( admin_url( 'themes.php?page=envy-blog-welcome' ) ) . '">', '</a>' ); ?></p>
                <p>
                    <a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=envy-blog-welcome' ) ); ?>">
                        <?php printf( esc_html__( 'Get started with %s', 'envy-blog' ), ENVY_BLOG_THEME_NAME ); ?>
                    </a>
                </p>
                <button type="button" class="notice-dismiss">
                    <a class="envy-blog-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'envy-blog-hide-notice', 'welcome' ) ), 'envy-blog_hide_notices_nonce', '_envy-blog_notice_nonce' ) ); ?>">
                        <span class="screen-reader-text"><?php esc_html_e( 'Dismiss', 'envy-blog' ); ?></span>
                    </a>
                </button>

            </div>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen() {
            $user = wp_get_current_user();
            $rating_url     = 'https://wordpress.org/support/theme/envy-blog/reviews/#new-post';
            $rating_link    = sprintf( __( '<a href="%s" target="_blank">Envy Blog</a>', 'envy-blog' ), esc_url( $rating_url ) ); ?>

            <div class="about-container">
                <div class="flex theme-info">
                    <div class="theme-details">
                        <h4><?php echo sprintf( __( 'Hello, %s,', 'envy-blog' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></h4>
                        <h1 class="entry-title"><?php echo sprintf( __( 'Welcome to %1$s version %2$s', 'envy-blog' ), ENVY_BLOG_THEME_NAME, ENVY_BLOG_THEME_VERSION ); ?></h1>
                        <p class="entry-content"><?php echo wp_kses_post( ENVY_BLOG_THEME_DESC ); ?></p>
                    </div>

                    <figure class="theme-screenshot">
                        <img src="<?php echo esc_url( ENVY_BLOG_THEME_URI ) . '/screenshot.png'; ?>" />
                    </figure>
                </div>

                <div class="about-theme-tabs">
                    <ul class="about-theme-tab-nav">
                        <li class="tab-link active" data-tab="getting_started"><?php esc_html_e( 'Getting Started', 'envy-blog' ); ?></li>
                        <li class="tab-link" data-tab="support"><?php esc_html_e( 'Support Forum', 'envy-blog' ); ?></li>
                        <li class="tab-link" data-tab="free_vs_pro"><?php esc_html_e( 'Free vs Pro', 'envy-blog' ); ?></li>
                        <li class="tab-link" data-tab="changelog"><?php esc_html_e( 'Changelog', 'envy-blog' ); ?></li>
                    </ul>

                    <?php $this->getting_started();?>

                    <?php $this->supports();?>

                    <?php $this->free_vs_pro();?>

                    <?php $this->changelog();?>
                    <div class="about-page-theme-rating">
                        <p><?php
                            printf( __( 'Have you ❤ using %1$s? Please rate ⭐⭐⭐⭐⭐ our theme %2$s on WordPress.org ☺ Thank you', 'envy-blog' ), ENVY_BLOG_THEME_NAME, $rating_link ); ?></p>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Show Getting Started Content.
         */
        public function getting_started() { ?>

            <div id="getting_started" class="about-theme-tab active">
                <section>
                    <h3><?php esc_html_e( 'Documentation & Installation Guide', 'envy-blog' ); ?></h3>

                    <p><?php esc_html_e( 'Theme documentation page will guide you to install and configure theme quick and easy. We have included details, screenshots and stepwise description about theme installation guides and tutorials.', 'envy-blog' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/envy-blog-documentation/' ); ?>" target="_blank"><?php esc_html_e( 'View Documentation', 'envy-blog' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'envy-blog' ); ?></h3>

                    <p><?php printf( __( 'Need help to setup your website with %s theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'envy-blog' ), ENVY_BLOG_THEME_NAME ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/envy-blog/' ); ?>" target="_blank"><?php esc_html_e( 'Support Forum', 'envy-blog' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Demo content', 'envy-blog' ); ?></h3>

                    <h4><?php esc_html_e( 'Install:  One Click Demo Import', 'envy-blog' ); ?></h4>
                    <p><?php esc_html_e( 'Install the following plugin and then come back here to access the importer. With it you can import all demo content and change your homepage and blog page to the ones from our demo site, automatically. It will also assign a menu.', 'envy-blog' ); ?></p>

                    <?php if ( !class_exists('OCDI_Plugin') ) : ?>
                        <?php $odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
                        <p>
                            <a target="_blank" class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Install and Activate', 'envy-blog' ); ?></a>
                            <a style="display:none;" class="button button-primary button-large importer-button" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the importer', 'envy-blog' ); ?></a>
                        </p>
                    <?php else : ?>
                        <p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'envy-blog' ); ?></p>
                        <a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'envy-blog' ); ?></a>
                    <?php endif; ?>

                    <br> <br>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Theme Option & Customization', 'envy-blog' ); ?></h3>

                    <p><?php esc_html_e( 'Most of theme settings customization options are available through theme customizer. To setup and customise your website elements and sections.', 'envy-blog' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Go to Customizer', 'envy-blog' ); ?></a></p>
                </section>

            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function supports() { ?>

            <div id="support" class="about-theme-tab flex">
                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'envy-blog' ); ?></h3>

                    <p><?php printf( __( 'Need help to setup your website with %s theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'envy-blog' ), ENVY_BLOG_THEME_NAME ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/envy-blog/' ); ?>" target="_blank"><?php esc_html_e( 'Visit Support Forum', 'envy-blog' ); ?></a></p>
                </section>
            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function free_vs_pro() { ?>

            <div id="free_vs_pro" class="about-theme-tab">
                <table>
                    <tr>
                        <td><?php esc_html_e( 'Theme Features', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( 'Free Version', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( 'Pro Version', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Coming Soon Page', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Header Layouts', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '2', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '6', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Header', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Header Separator', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Smooth Page Scroll', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Hero Section Layout', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '2', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '7', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Hero Section Video Support', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Built-in Custom Widgets', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '3', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '6', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Sidebar', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unlimited Widget Area (Sidebar) Generator', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unique Posts/Pages Sidebar', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Typography Option (850+ Google Fonts)', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Archive/Blog Settings', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Archive/Blog Header', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Blog Layouts', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '2', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '10', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Post Navigation Layout', 'envy-blog' ); ?></td>
                        <td class="redFeature"><?php esc_html_e( '1', 'envy-blog' ); ?></span></td>
                        <td class="greenFeature"><?php esc_html_e( '3', 'envy-blog' ); ?></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Show Related Posts', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Post Settings', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Post Layouts', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '1', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '2', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sortable Post Elements', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Social Share Option', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Page Settings', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sortable Page Elements', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced 404 Error Page Editor', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced WooCommerce Settings', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Footer Widgets Position Layouts', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '1', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '10', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Footer Bar Elements', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '2', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( '3', 'envy-blog' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sortable Footer Bar Elements', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Footer Copyright Editor', 'envy-blog' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Contact Form 7 Compatible', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'WooCommerce Compatible', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Polylang Compatible', 'envy-blog' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Theme Support', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( 'Support via Forum', 'envy-blog' ); ?></td>
                        <td><?php esc_html_e( 'Quick Ticket Support', 'envy-blog' ); ?></td>
                    </tr>
                </table>

                <br>

                <p><?php printf( __( 'Need more features and customization option? Try Pro Version of %s theme.', 'envy-blog' ), ENVY_BLOG_THEME_NAME ); ?>
                <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/envy-blog-pro/' );?>" target="_blank"><?php printf( __( '<span>View %s Pro Details', 'envy-blog'), ENVY_BLOG_THEME_NAME ); ?></a><br></p>
            </div>
            <?php
        }

        /**
         * Show Changelog Content.
         */
        public function changelog() {
            global $wp_filesystem; ?>

            <div id="changelog" class="about-theme-tab">
                <div class="wrap about-wrap">

                    <?php

                    $changelog_file = apply_filters( 'envy_blog_changelog_file', get_template_directory() . '/readme.txt' );

                    // Check if the changelog file exists and is readable.
                    if ( $changelog_file && is_readable( $changelog_file ) ) {
                        WP_Filesystem();
                        $changelog = $wp_filesystem->get_contents( $changelog_file );
                        $changelog_list = $this->parse_changelog( $changelog );

                        echo wp_kses_post( $changelog_list );
                    }

                    ?>

                </div>
            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         */
        private function parse_changelog( $content ) {
            $matches   = null;
            $regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if ( preg_match( $regexp, $content, $matches ) ) {
                $changes = explode( '\r\n', trim( $matches[1] ) );

                $changelog .= '<pre class="changelog">';

                foreach ( $changes as $index => $line ) {
                    $changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post( $changelog );
        }
    }

endif;

return new Envy_Blog_Welcome_Screen();
