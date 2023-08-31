<?php
/**
 * Single Event Template for Widgets
 *
 * This template is used to render single events for both the calendar and advanced
 * list widgets, facilitating a common appearance for each as standard.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/pro/widgets/modules/single-event.php
 *
 * @version 4.4.18
 *
 * @package TribeEventsCalendarPro
 */

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

<div id="featured-tribe" class="custom-tribe-list-card">
<!-- Event Title -->
    <?php do_action( 'tribe_events_before_the_event_title' ) ?>

   <div class="tribe-date-block">
      <div class ="month"><?php echo tribe_get_start_date(null, false, 'M'); ?></div>
      <div class ="date-num"><?php echo tribe_get_start_date(null, false, 'j'); ?></div>
      <div class ="day-week"><?php echo tribe_get_start_date(null, false, 'D'); ?></div>
    </div>

    <?php do_action( 'tribe_events_after_the_event_title' ) ?>


  <!-- Event Meta -->
  <?php do_action( 'tribe_events_before_the_meta' ) ?>

  <div class="tribe-event-info">
      <div class="featured-title-row">
      <h3 class="custom-tribe-events-list-event-title">
      <a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h3>
      </div>
      
  <!-- Event Image -->

      <div class="custom-tribe-events-list-event-description tribe-events-content description entry-summary">

      


        <div class="custom-tribe-excerpt"><?php the_excerpt(); ?></div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="font-weight: bold;">Find out more &raquo;</a>
			</div>

      
      </div>
  </div>
  <!-- .tribe-events-event-meta -->

<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ); ?>


<!-- .tribe-events-list-event-description -->
<?php
do_action( 'tribe_events_after_the_content' );