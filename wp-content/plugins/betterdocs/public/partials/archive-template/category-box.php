<?php
/**
 * Template archive docs
 *
 * @link       https://wpdeveloper.com
 * @since      1.0.0
 *
 * @package    BetterDocs
 * @subpackage BetterDocs/public
 */

get_header();

echo '<div class="betterdocs-wraper betterdocs-main-wraper">';
    $live_search = BetterDocs_DB::get_settings('live_search');
    if ( $live_search == 1 ) {
        echo BetterDocs_Public::search();
    }

	echo '<div class="betterdocs-archive-wrap betterdocs-archive-main">';
        $output = betterdocs_generate_output();
        $shortcode = do_shortcode( '[betterdocs_category_box title_tag="'.BetterDocs_Helper::html_tag($output['betterdocs_category_title_tag']).'" border_bottom="'.$output['betterdocs_doc_page_box_border_bottom'].'"]' );
        echo apply_filters( 'betterdocs_category_box_shortcode', $shortcode );
	echo '</div>
</div>';

get_footer();
