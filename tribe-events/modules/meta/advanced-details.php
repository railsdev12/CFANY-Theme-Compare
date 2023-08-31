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

$advanced_config = get_field('advanced_config');
if( $advanced_config && in_array('extra', $advanced_config) ) {
    $price_modal_link = 'Hello';
    $price_modal_btn = `<a class="my-button-class live-btn fusion-button-wrapper fusion-aligncenter" target="_self" href="#" data-toggle="modal" data-target=".fusion-modal.all_pricing_info"><span lass="fusion-button-text">View Pricing</span></a>`;
}

 //  if( $advanced_config && in_array('extra', $advanced_config) ) {
//       echo $price_modal_btn;
//     }

$multi_day_on = get_field('multi-day_details');
$price_modal_on = get_field('pricing_info_modal');
$hide_modal_desktop = get_field('');

if( ($advanced_config && in_array('extra', $advanced_config)) && ($advanced_config && !in_array('nomodal', $advanced_config)) ) {

}

if ( $advanced_config && in_array('extra', $advanced_config) ) {
$pricing_modal_on = true;
}

if ( $advanced_config && in_array('nomodal', $advanced_config) ) {
$pricing_modal_desktop_only = true;
}


?>


<h2 class="tribe-events-single-section-title"> <?php esc_html_e( 'Details', 'the-events-calendar' ) ?> </h2>

<!-- <div id="advanced-config" class="tribe-events-meta-group tribe-events-meta-group-details"> -->
<div class="tribe-events-meta-group tribe-events-meta-group-details">

  <?php do_action( 'tribe_events_single_meta_details_section_start' );

  if ( $advanced_config && in_array('multi', $advanced_config) ) : ?>
  <div class="multi-day-custom">

    <?php the_field('multi-day_details'); ?>
    
    </div> 

    <?php
		// Single day events
		else :
			?>

		<!-- // All day (multiday) events -->
		<?php if ( tribe_event_is_all_day() || tribe_event_is_multiday() ) :
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

  <?php endif ?>

  <?php 

				// Start registration option section

		if ( ($toattend && $website) || ($toattend && $cvent_link) || ($advanced_config && $cvent_link) ) : ?>

  <div class="meta-box">
    <dl class="meta-details">
      <dt>
        <div class="meta-to-attend"><?php esc_html_e( 'To Attend', 'the-events-calendar' ) ?></div>
      </dt>
      <dd class="meta-grid">
     <?php if ( ($toattend && $pricing_modal_desktop_only) || ($toattend && !$pricing_modal_on) ) : ?>
        <div class="meta-cost"><?php echo the_field('to_attend_copy'); ?></div><br>
        <?php endif ?>
        <div class="register-attend aa-legacy"><a href="<?php echo $website; ?>"
            class="my-button-class fusion-button-wrapper fusion-aligncenter">Register to Attend</a></div>
          <div class="register-attend cvent-reg"><a href="<?php echo $cvent_link; ?>"
                                                    class="my-button-class fusion-button-wrapper fusion-aligncenter">Register to Attend</a></div>
          <div class="meta-membership"><?php echo ' <a href="/membership/">Not a Member Yet?</a> '?>
        </div>
        <?php if( ($advanced_config && in_array('extra', $advanced_config)) && ($advanced_config && !in_array('nomodal', $advanced_config)) ) : ?>
    <a class="my-button-class pricing-modal-btn" target="_self" href="#" data-toggle="modal" data-target=".fusion-modal.all_pricing_info"><span lass="fusion-button-text">View Pricing</span></a>
   <?php endif; ?>
      </dd>
    </dl>
  </div>



  <?php endif; ?>

  <?php if ( $livestream && $live_link ) : ?>

  <div class="meta-box">
    <dl class="meta-details">
      <dt>
        <div class="meta-to-attend"><?php esc_html_e( 'Livestream', 'the-events-calendar' ) ?></div>
      </dt>
      <dd class="meta-grid">
        <div class="meta-livestream"><?php echo the_field('livestream'); ?></div>
        <div class="live-register-link aa-legacy"><a href="<?php echo $live_link; ?>"
            class="my-button-class live-btn fusion-button-wrapper fusion-aligncenter"><?php echo esc_html($live_btn_txt); ?></a>
        </div>
      </dd>
    </dl>
  </div>

  <?php endif; ?>
  <!-- Start registration option section -->
  <?php if( get_field('reg_settings') === 'comps' ): ?>

  <div class="meta-box comp">
    <dl class="meta-details">
      <dt>
        <div class="meta-to-attend"><?php echo the_field('misc_title'); ?></div>
      </dt>
      <dd class="meta-grid">
        <div class="meta-livestream"> <?php echo the_field('misc_copy'); ?></div>
        <div class="live-register-link">
          <a class="my-button-class live-btn fusion-button-wrapper fusion-aligncenter" target="_self" href="#"
            data-toggle="modal" data-target=".fusion-modal.request"><span
              class="fusion-button-text"><?php echo the_field('misc_cta'); ?></span>
          </a>

        </div>
      </dd>
    </dl>
  </div>

  <?php endif; ?>


</div>

<div class="mobile-meta-section-title">

  <?php if( tribe_event_is_all_day() || tribe_event_is_multiday() ): ?>

  <?php esc_html_e( $start_date ) ?> <?php esc_html_e( ' - ', 'the-events-calendar' ) ?>
  <?php echo $end_date; // WPCS: XSS ok. ?> <p>
    <?php esc_html_e( ' @ ', 'the-events-calendar' ) ?><?php echo get_the_title( tribe_get_venue_id() ) ?></p>

  <?php else : ?>

  <?php echo $the_customdate; ?> <?php esc_html_e( ' | ', 'the-events-calendar' ) ?> <?php echo $time_formatted; ?> <p>
    <?php esc_html_e( ' @ ', 'the-events-calendar' ) ?><?php echo get_the_title( tribe_get_venue_id() ) ?></p>

  <?php endif; ?>
</div>

<div class="main-mobile-metabox">


  <?php
			// Mobile with Attend & Livestream
			 if ( ($toattend && $website && $livestream && $live_link) || ($toattend && $website && $livestream && $live_link && $cvent_link) || ($toattend && $cvent_link && $livestream && $live_link) ) : ?>

  <div class="mobile-meta-attend-box">

    <div class="mobile-meta-to-attend"><?php esc_html_e( 'Attend:', 'the-events-calendar' ) ?></div>
    <div class="mobile-register-attend aa-legacy"><a href="<?php echo $website; ?>">Register »</a></div>
      <div class="mobile-register-attend cvent-reg"><a href="<?php echo $website; ?>">Register »</a></div>
      <div class="mobile-register-attend cvent-reg pricing-modal-link"><a href="<?php echo $website; ?>">Register »</a></div>

    
    <div class="mobile-meta-cost"><?php echo the_field('to_attend_copy'); ?></div>

  </div>

  <hr class="mobile-meta-sep">

  <div class="mobile-meta-livestream-box">

    <div class="mobile-meta-to-attend aa-legacy"><?php esc_html_e( 'Livestream:', 'the-events-calendar' ) ?></div>
    <div class="mobile-meta-livestream aa-legacy"><?php echo the_field('livestream'); ?></div>
    <div class="mobile-live-register-link aa-legacy"><a href="<?php echo $live_link; ?>">Register »</a></div>


  </div>



  <?php
			// Mobile with Attend Only
			 elseif ( ($toattend && $website) || ($toattend && $cvent_link) || ($advanced_config && $cvent_link) ) : ?>

<?php if ( $advanced_config && in_array('extra', $advanced_config) ) : ?>

  <div class="mobile-meta-attend-box extra-info">

    <a class="my-button-class pricing-modal-btn" target="_self" href="#" data-toggle="modal" data-target=".fusion-modal.all_pricing_info"><span lass="fusion-button-text">View Pricing</span></a>
    <div class="mobile-register-attend cvent-reg is-btn"><a href="<?php echo $cvent_link; ?>">Register »</a></div>
  
  </div>
  
  <?php else : ?>

  <div class="mobile-meta-attend-box">

    <div class="mobile-meta-to-attend"><?php esc_html_e( 'Attend:', 'the-events-calendar' ) ?></div>

    <div class="mobile-register-attend aa-legacy"><a href="<?php echo $website; ?>">Register »</a></div>
      <div class="mobile-register-attend cvent-reg"><a href="<?php echo $cvent_link; ?>">Register »</a></div>
    <div class="mobile-meta-cost"><?php echo the_field('to_attend_copy'); ?></div>
   
  </div>

  <?php endif; ?>

  <?php
			// Mobile with Livestream Only
			 elseif ( $livestream && $live_link ) : ?>

  <div class="mobile-meta-livestream-box">

    <div class="mobile-meta-to-attend"><?php esc_html_e( 'Livestream:', 'the-events-calendar' ) ?></div>

    <div class="mobile-meta-livestream aa-legacy"><?php echo the_field('livestream'); ?></div>
    <div class="mobile-live-register-link aa-legacy"><a href="<?php echo $live_link; ?>">Register »</a></div>


  </div>

  <?php endif; ?>

</div>



<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>