<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );

// Check for skeleton mode (no outer wrappers per section)
$not_skeleton = ! apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, get_the_ID() );

// Do we want to group venue meta separately?
$set_venue_apart = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, get_the_ID() );

$start_date = tribe_get_start_date( null, false );
$compare_date_min = strtotime( "2020-09-28" );
$compare_date_current = strtotime($start_date);
$is_advanced_config = get_field('advanced_config');

?>

<?php if ( $not_skeleton ) : ?>
<?php if ( $compare_date_current > $compare_date_min ) : ?>
<div <?php if($is_advanced_config) { echo "id=\"advanced-config\""; } ?>
    class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix cvent-ready">
    <?php else : ?>
    <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix aa-legacy-keep">
        <?php endif; ?>
        <?php endif; ?>

        <?php
do_action( 'tribe_events_single_event_meta_primary_section_start' );

$posts = get_field('the_organizers');
$postmaster = get_field('ceremony_master');
$posthost = get_field('host');

$globalPassport = get_field('global_passport');

$is_aos = has_term( 'Asset Owner Series', 'tribe_events_cat');

$is_aos_virtual = has_term( 'AOS Virtual Keynotes', 'tribe_events_cat');

$is_policymakers = has_term( 'Global Policymakers Series', 'tribe_events_cat');

$is_invitation_only = get_field('reg_settings') === 'All';

?>


        <?php
if ( $is_aos && ! ($is_aos_virtual || $is_policymakers) ) {
 	tribe_get_template_part ( 'modules/meta/aos' );
 } elseif ($is_aos_virtual) {
    tribe_get_template_part ( 'modules/meta/aos_virtual' );
  } elseif ($is_policymakers) {
    tribe_get_template_part ( 'modules/meta/policymakers' );
  } elseif ($is_advanced_config) {
	tribe_get_template_part ( 'modules/meta/advanced-details' );
	} elseif ( $is_invitation_only && ! ($is_aos || $is_aos_virtual || $is_policymakers) ) {
  tribe_get_template_part ( 'modules/meta/invitation_only' );
  } else {
  tribe_get_template_part( 'modules/meta/details' );
  } 
  
  ?>

        <?php

if ($globalPassport && in_array('Global Passport Event', $globalPassport)) {
	tribe_get_template_part( 'modules/meta/global_passport' );
}

// Include speaker, organizer and master of ceremony sections
if( ( tribe_has_organizer() && $posts && $postmaster )  )  {
	tribe_get_template_part( 'modules/meta/organizer' );
	tribe_get_template_part( 'modules/meta/theorganizers' );
	tribe_get_template_part( 'modules/meta/ceremony_master' );
}

// Include speaker, organizer, and host sections
if( ( tribe_has_organizer() && $posts && $posthost )  )  {
	tribe_get_template_part( 'modules/meta/host' );
	tribe_get_template_part( 'modules/meta/organizer' );
	tribe_get_template_part( 'modules/meta/theorganizers' );
}

// Include speaker and organizer sections
elseif ( tribe_has_organizer() && $posts ) {
	tribe_get_template_part( 'modules/meta/organizer' );
	tribe_get_template_part( 'modules/meta/theorganizers' );
}

// Include organizer and host sections
elseif ( tribe_has_organizer() && $posthost ) {
	tribe_get_template_part( 'modules/meta/host' );
	tribe_get_template_part( 'modules/meta/theorganizers' );
}

// Include speaker and master of ceremony sections
elseif ( tribe_has_organizer() && $postmaster ) {
	tribe_get_template_part( 'modules/meta/organizer' );
	tribe_get_template_part( 'modules/meta/ceremony_master' );
	}

// Include only old template i.e. Speakers | Organizers
elseif ( tribe_has_organizer() ) {
	tribe_get_template_part( 'modules/meta/noacf' );
}

elseif ( $posts && $posthost) {
	tribe_get_template_part( 'modules/meta/host' );
	tribe_get_template_part( 'modules/meta/theorganizers' );
}

elseif ( $posts ) {
	tribe_get_template_part( 'modules/meta/theorganizers' );
}
	
elseif ( $postmaster ) {
	tribe_get_template_part( 'modules/meta/ceremony_master' );
	}


// If we have no map to embed and no need to keep the venue separate...
if ( ! $set_venue_apart && ! tribe_embed_google_map() ) {
	tribe_get_template_part( 'modules/meta/venue' );
} elseif ( ! $set_venue_apart && ! tribe_has_organizer() && tribe_embed_google_map() ) {
	// If we have no organizer, no need to separate the venue but we have a map to embed...
	tribe_get_template_part( 'modules/meta/venue' );
	echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
	tribe_get_template_part( 'modules/meta/map' );
	echo '</div>';
} else {
	// Ifif the venue meta has not already been displayed then it will be printed separately by default
	$set_venue_apart = true;
}
?>


        <?php
// ADD SOCIAL SHARING EL to btm of sidebar
 echo '<div class="tribe-events-meta-group tribe-events-social-share">';

echo do_shortcode('[fusion_sharing social_share_links="facebook,twitter,linkedin,email" layout_medium=""
	layout_small="stacked" layout="floated" tagline_visibility="show" tagline="Share Event" title="" link="" description=""
	tooltip_placement="" pinterest_image="" hide_on_mobile="small-visibility,medium-visibility,large-visibility"
	sticky_display="normal,sticky" class="" id="" margin_top="" margin_right="" margin_bottom="" margin_left=""
	wrapper_padding_top="" wrapper_padding_right="" wrapper_padding_bottom="" wrapper_padding_left="" backgroundcolor=""
	hue="" saturation="" lightness="" alpha="" border_top="" border_right="" border_bottom="" border_left=""
	border_color="#cccccc" border_radius_top_left="" border_radius_top_right="" border_radius_bottom_right=""
	border_radius_bottom_left="" tagline_color="" stacked_align_medium="" stacked_align_small="center"
	stacked_align="flex-start" alignment_medium="" alignment_small="space-between" alignment="flex-end" icons_boxed=""
	icons_boxed_radius="" icon_size="" color_type="" icon_colors="" box_colors="" pinterest_image_id="" padding_top=""
	padding_right="" padding_bottom="" padding_left="" icon_taglines="" tagline_placement="after" tagline_text_size=""
	icon_tagline_color="" icon_tagline_color_hover="" separator_border_sizes="0" separator_border_color="#cccccc"
	animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" /]');
	
	echo '</div>';
	

?>

        <?php if( (! $is_aos) && (get_field('reg_settings') !== 'None') ): ?>

        <?php echo do_shortcode('[fusion_modal name="request" title="Request
Invitation" size="large" background="" border_color="" show_footer="yes"
class="" id=""][gravityform id="47" title="false" description="false"
ajax="true" field_values="eventname='. get_the_title() .'
"][/fusion_modal]');?>

        <?php endif; ?>


        <?php
do_action( 'tribe_events_single_event_meta_primary_section_end' );
?>



        <?php if ( $not_skeleton ) : ?>
    </div>
    <?php endif; ?>


    <?php if ( $set_venue_apart ) : ?>
    <?php if ( $not_skeleton ) : ?>
    <div class="tribe-events-single-section tribe-events-event-meta secondary tribe-clearfix">
        <?php endif; ?>

        <?php
	if ( $not_skeleton ) : ?>
    </div>
    <?php endif; ?>
    <?php
endif;
do_action( 'tribe_events_single_meta_after' );