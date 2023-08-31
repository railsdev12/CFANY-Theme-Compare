<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$the_customdate = date("l, M. j", strtotime($start_date));

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'the-events-calendar' ), $event_id );


// Cost to attend text
$toattend = get_field('to_attend_copy');


if(!empty (get_field('attend_reg_link'))) {
		$website = get_field('attend_reg_link');
	} else {
		$website = tribe_get_event_website_url();
	}


// Cost for livestream text
$livestream = get_field('livestream');
// Livestream registration URL for link or button
$live_link = get_field('live_reg_link');

if($toattend && $website && $livestream && $live_link) {
	$live_btn_txt = 'Register';
} else {
	$live_btn_txt = 'Register for Livestream';
}

$misc_title = get_field('misc_title');
$misc_copy = get_field('misc_copy');
$misc_cta = get_field('misc_cta');

// CVENT registration URL for link or button
$cvent_link = get_field('cvent_reg_link');



// Cost to attend text
$toattend = get_field('to_attend_copy');
// Attend registration URL for link or button
$direct_reg_url = get_field('attend_reg_link');
// Cost for livestream text
$invite_reqs = get_field('livestream');
// Livestream registration URL for link or button
$live_link = get_field('live_reg_link');
// CVENT registration URL for link or button
$cvent_link = get_field('cvent_reg_link');


$invitation_requirements = get_field('reg_settings');
$is_invitation_only = get_field('reg_settings') === 'All';


?>


<h2 class="tribe-events-single-section-title"> <?php esc_html_e( 'Details', 'the-events-calendar' ) ?> </h2>



<div class="tribe-events-meta-group tribe-events-meta-group-details">

  <?php do_action( 'tribe_events_single_meta_details_section_start' );

		// All day (multiday) events
		if ( tribe_event_is_all_day() || tribe_event_is_multiday() ) :
			?>

  <dt class="tribe-events-start-date-label"> <?php esc_html_e( 'Start Date:', 'the-events-calendar' ) ?> </dt>
  <dd>
    <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="<?php esc_attr_e( $start_ts ) ?>">
      <?php esc_html_e( $start_date ) ?> </abbr>
  </dd>

  <dt class="tribe-events-end-date-label"> <?php esc_html_e( 'End Date:', 'the-events-calendar' ) ?> </dt>
  <dd>
    <abbr class="tribe-events-abbr tribe-events-end-date dtend" title="<?php esc_attr_e( $end_ts ) ?>">
      <?php esc_html_e( $end_date ) ?> </abbr>
  </dd>

  <?php
		// Single day events
		else :
			?>



  <dt class="tribe-events-start-date-label"> <?php esc_html_e( 'Date & Time', 'the-events-calendar' ) ?> </dt>
  <dd>
    <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="<?php esc_attr_e( $start_ts ) ?>">
      <?php esc_html_e( $start_date ) ?> </abbr>

    <div class="tribe-events-abbr tribe-events-start-time published dtstart" title="<?php esc_attr_e( $end_ts ) ?>">
      <?php echo $time_formatted; ?>
    </div>
  </dd>

  <?php endif ?>


  <!-- Start DESKTOP registration option section -->
    <?php if ( $toattend ) : ?>
  <div class="meta-box">
    <dl class="meta-details">
      <dt>
        <div class="meta-to-attend"><?php esc_html_e( 'To Attend', 'the-events-calendar' ) ?></div>
      </dt>
      <dd class="meta-grid">
        <div class="meta-cost"><?php echo the_field('to_attend_copy'); ?></div>
        
        <br>

        <div class="register-attend cvent-reg invitation-only desktop"><?php echo do_shortcode('[fusion_button link="" text_transform="" title="" target="_self" link_attributes="" alignment="center" modal="request" class="aos-reg-button non-aos" id="]Request Invitation[/fusion_button]'); ?>
        <?php if ( $invite_reqs ) : ?>
        <div class="meta-livestream invitation-reqs-text"><?php echo the_field('livestream'); ?></div>
        <?php endif; ?>
        </div>
         
        </div>
      </dd>
    </dl>
  </div>

  <?php endif; ?>



  <div class="mobile-meta-section-title">

<?php if( tribe_event_is_all_day() || tribe_event_is_multiday() ): ?>
  
  <div class="event-timing-mobile">
    <?php esc_html_e( $start_date ) ?> <?php esc_html_e( ' - ', 'the-events-calendar' ) ?>
    <?php echo $end_date; // WPCS: XSS ok. ?> <p>
      <?php esc_html_e( ' @ ', 'the-events-calendar' ) ?><?php echo get_the_title( tribe_get_venue_id() ) ?></p>
</div>
<?php else : ?>
  <div class="event-timing-mobile">
    <div class="date-then-time">
<?php echo $the_customdate; ?> <?php esc_html_e( ' | ', 'the-events-calendar' ) ?> <?php echo $time_formatted; ?>
</div>
  <p><?php esc_html_e( ' @ ', 'the-events-calendar' ) ?><?php echo get_the_title( tribe_get_venue_id() ) ?></p>
</div>
<?php endif; ?>
</div>

<div class="main-mobile-metabox">


<!-- Start MOBILE registration option section -->
<?php if ( $toattend ) : ?>

  <div class="mobile-meta-attend-box">

    <div class="mobile-meta-to-attend"><?php esc_html_e( 'Attend:', 'the-events-calendar' ) ?></div>

    <div class="mobile-meta-cost"><?php echo the_field('to_attend_copy'); ?></div>

      <div class="mobile-register-attend cvent-reg invitation-only mobile"><?php echo do_shortcode('[fusion_modal_text_link name="request" class="non-aos mobile-invite-request" id=""]Request Invitation »[/fusion_modal_text_link]'); ?></div>

    <?php if ( $invite_reqs ) : ?>
        <div class="meta-livestream invitation-reqs-text"><?php echo the_field('livestream'); ?></div>
        <?php endif; ?>

  </div>

  <?php endif; ?>

</div>



<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>