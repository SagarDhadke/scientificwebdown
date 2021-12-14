<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('BetterDocsStyleHandler')) {
    final class BetterDocsStyleHandler
    {
        private static $instance;

        private $media_desktop = [
            'name' => 'desktop',
            'screen_size' => ''
        ];
        private $media_tab = [
            'name' => 'tab',
            'screen_size' => 1024
        ];
        private $media_mobile = [
            'name' => 'mobile',
            'screen_size' => 767
        ];


        public static function init()
        {
            if (null === self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct()
        {
            add_action('admin_enqueue_scripts', [$this, 'better_docs_edit_post']);
            add_action('wp_ajax_better_docs_write_block_css', [$this, 'write_block_css']);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_css']);
        }

        /**
         * Enqueue a script in the WordPress admin on edit.php.
         * @param int $hook Hook suffix for the current admin page.
         */
        public function better_docs_edit_post($hook)
        {
            global $post;
            if ($hook == 'post-new.php' || $hook == 'post.php') {
                $frontend_js = "style-handler.js";
                wp_enqueue_script('better-docs-edit-post', BETTERDOCS_URL . "public/js/style-handler.js", array("jquery", "wp-editor"), BETTERDOCS_VERSION, true);
                wp_localize_script('better-docs-edit-post', 'better_docs_style_handler', [
                    'sth_nonce' => wp_create_nonce('better_docs_style_handler_nonce')
                ]);
            }
        }

        /**
         * Ajax callback to write css in upload directory
         * @retun void
         * @since 1.0.2
         */
        public function write_block_css()
        {
            if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'better_docs_style_handler_nonce') || !current_user_can('manage_options')) {
                echo 'Invalid request';
                wp_die();
            }
            if (!empty($css = $this->build_css($_POST['data']))) {
                $upload_dir = wp_upload_dir()['basedir'] . '/betterdocs-style/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir);
                }
                file_put_contents($upload_dir . 'betterdocs-style-' . abs($_POST['id']) . '.min.css', $css);
            }

            wp_die();
        }

        /**
         * Enqueue frontend css for post if have one
         * @return void
         * @since 1.0.2
         */
        public function enqueue_frontend_css()
        {
            global $post;
            if (!empty($post) && !empty($post->ID)) {
                $upload_dir = wp_upload_dir();
                if (file_exists($upload_dir['basedir'] . '/betterdocs-style/betterdocs-style-' . $post->ID . '.min.css')) {
                    wp_enqueue_style('eb-block-style-' . $post->ID, $upload_dir['baseurl'] . '/betterdocs-style/betterdocs-style-' . $post->ID . '.min.css', [], substr(md5(microtime(true)), 0, 10));
                }
            }
        }

        /**
         * Enqueue frontend css for post if have one
         * @param string
         * @return string
         * @since 1.0.2
         */
        private function build_css($style_object)
        {
            $block_styles = (array)json_decode(stripslashes($style_object));

            $css = '';
            foreach ($block_styles as $block_style) {
                if (!empty($block_css = (array) $block_style)) {
                    foreach ($block_css as $media => $style) {
                        switch ($media) {
                            case $this->media_desktop['name']:
                                $css .= preg_replace('/\s+/', ' ', $style);
                                break;
                            case $this->media_tab['name']:
                                $css .= ' @media(max-width: 1024px){';
                                $css .= preg_replace('/\s+/', ' ', $style);
                                $css .= '}';
                                break;
                            case $this->media_mobile['name']:
                                $css .= ' @media(max-width: 767px){';
                                $css .= preg_replace('/\s+/', ' ', $style);
                                $css .= '}';
                                break;
                        }
                    }
                }
            }
            return trim($css);
        }
    }
    BetterDocsStyleHandler::init();
}
