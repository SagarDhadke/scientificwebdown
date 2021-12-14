( function( api ) {

    // Extends our custom "example-1" section.
    api.sectionConstructor['pro-section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );

jQuery(document).ready(function($) {
	/* Move widgets to their respective sections */
	wp.customize.section( 'sidebar-widgets-bottom-widget' ).panel( 'app_landing_page_home_page_settings' )
	wp.customize.section( 'sidebar-widgets-bottom-widget' ).priority( '81' );

	// Scroll to Home section starts
    $('body').on('click', '#sub-accordion-panel-app_landing_page_home_page_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

    function scrollToSection( section_id ){
        var preview_section_id = "banner";
        var $contents = jQuery('#customize-preview iframe').contents();

        switch ( section_id ) {
            
            case 'accordion-section-app_landing_page_banner_settings':
            preview_section_id = "banner";
            break;

            case 'accordion-section-app_landing_page_featured_settings':
            preview_section_id = "featured";
            break;

            case 'accordion-section-app_landing_page_features_settings':
            preview_section_id = "features";
            break;

            case 'accordion-section-app_landing_page_vedio_settings':
            preview_section_id = "vedio";
            break;

            case 'accordion-section-app_landing_page_intro_settings':
            preview_section_id = "intro";
            break;

            case 'accordion-section-app_landing_page_service_settings':
            preview_section_id = "service";
            break;

            case 'accordion-section-app_landing_page_stats_settings':
            preview_section_id = "stats";
            break;

            case 'accordion-section-app_landing_page_social_settings':
            case 'accordion-section-sidebar-widgets-bottom-widget':
            preview_section_id = "stay-tuned";
            break;
            
        }

        if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
            }, 1000);
        }
    }

});