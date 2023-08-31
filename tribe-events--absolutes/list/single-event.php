<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
   
 $time_format = get_option('time_format', Tribe__Date_Utils::TIMEFORMAT);
   $time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');
   
   $start_datetime = tribe_get_start_date();
   $start_date = tribe_get_start_date(null, false);
   $start_time = tribe_get_start_date(null, false, $time_format);
   $start_ts = tribe_get_start_date(null, false, Tribe__Date_Utils::DBDATEFORMAT);
   
   $end_datetime = tribe_get_end_date();
   $end_date = tribe_get_display_end_date(null, false);
   $end_time = tribe_get_end_date(null, false, $time_format);
   $end_ts = tribe_get_end_date(null, false, Tribe__Date_Utils::DBDATEFORMAT);
   
   $time_formatted = null;
   if ($start_time == $end_time)
   {
       $time_formatted = esc_html($start_time);
   }
   else
   {
       $time_formatted = esc_html($start_time . $time_range_separator . $end_time);
   }
   
   $event_id = Tribe__Main::post_id_helper();
   $time_formatted = apply_filters('tribe_events_single_event_time_formatted', $time_formatted, $event_id);

?>


<div class="custom-tribe-list-card">
<!-- Event Title -->
    <?php do_action( 'tribe_events_before_the_event_title' ) ?>

    <div class="tribe-date-block">
      <div class ="month"><?php echo tribe_get_start_date($post->ID, false, 'M'); ?></div>
      <div class ="date-num"><?php echo tribe_get_start_date($post->ID, false, 'j'); ?></div>
      <div class ="day-week"><?php echo tribe_get_start_date($post->ID, false, 'D'); ?></div>
    </div>

    <?php do_action( 'tribe_events_after_the_event_title' ) ?>


  <!-- Event Meta -->
  <?php do_action( 'tribe_events_before_the_meta' ) ?>

  <div class="tribe-event-info">
    	
      <h3 class="custom-tribe-events-list-event-title">
    	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
    		<?php the_title() ?>
    	</a>
      </h3>
      
  <!-- Event Image -->

      <div class="custom-tribe-events-list-event-description tribe-events-content description entry-summary">
      	<div class="custom-tribe-excerpt"><?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?></div>
      	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?> &raquo;</a>
      </div>
      
       <?php if (!empty(tribe_get_text_categories ())): ?>
 <div class="more-details">
    	<div class="custom-tribe-cat"><?php echo tribe_get_text_categories (); ?></div>
    </div>
<?php endif; ?>
  
  </div>
  <!-- .tribe-events-event-meta -->
    
</div>

<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ); ?>


<!-- .tribe-events-list-event-description -->
<?php
do_action( 'tribe_events_after_the_content' );