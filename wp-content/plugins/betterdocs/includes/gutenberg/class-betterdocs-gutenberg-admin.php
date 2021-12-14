<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class BetterDocsGutenbergAdmin
{

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_filter('block_categories_all', [$this, 'add_block_categories']);
    }
    public function enqueue_styles()
    {
        /**
         * Only for Admin Add/Edit Pages
         */
        if ($this->eb_is_edit_page()) {
            wp_enqueue_style(
                'fontpicker-default-theme',
                BETTERDOCS_URL . 'admin/assets/css/fonticonpicker.base-theme.react.css',
                array(),
                BETTERDOCS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'eb-fontawesome-admin',
                BETTERDOCS_URL . 'admin/assets/css/font-awesome5.css',
                array(),
                BETTERDOCS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'fontpicker-material-theme',
                BETTERDOCS_URL . 'admin/assets/css/fonticonpicker.material-theme.react.css',
                array(),
                BETTERDOCS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'betterdocs-admin-editor-css',
                BETTERDOCS_URL . 'includes/gutenberg/admin/editor-css/style.css',
                array(),
                BETTERDOCS_VERSION,
                'all'
            );
        }
    }

    public function enqueue_scripts()
    {
        if ($this->eb_is_edit_page()) {
            // wp_enqueue_script(
            //     'betterdocs-categorygrid-js',
            //     BETTERDOCS_URL . 'includes/gutenberg/blocks/categorygrid/assets/js/categorygrid.js',
            //     array(),
            //     BETTERDOCS_VERSION,
            //     true
            // );

            // wp_enqueue_script(
            //     'betterdocs-gutenberg-admin-js',
            //     BETTERDOCS_URL . 'includes/gutenberg/admin/js/getenberg-admin.js',
            //     array(),
            //     BETTERDOCS_VERSION,
            //     true
            // );
        }
    }

    /**
     * Add a block category
     *
     * @param array $categories Block categories.
     *
     * @return array
     */
    public function add_block_categories($categories)
    {
        $categories_slugs = wp_list_pluck($categories, 'slug');

        return in_array('betterdocs', $categories_slugs, true) ? $categories : array_merge(
            $categories,
            [
                [
                    'slug' => 'betterdocs',
                    'title' => __('Betterdocs', 'betterdocs'),
                ]
            ]
        );
    }

    /**
     * eb_is_edit_page 
     * function to check if the current page is a post edit page
     * 
     * @author Ohad Raz <admin@bainternet.info>
     * 
     * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
     * @return boolean
     */
    public function eb_is_edit_page($new_edit = null)
    {
        global $pagenow;
        //make sure we are on the backend
        if (!is_admin()) return false;


        if ($new_edit == "edit")
            return in_array($pagenow, array('post.php',));
        elseif ($new_edit == "new") //check for new post page
            return in_array($pagenow, array('post-new.php'));
        else //check for either new or edit
            return in_array($pagenow, array('post.php', 'post-new.php'));
    }
}
