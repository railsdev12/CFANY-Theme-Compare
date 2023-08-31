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
   
   $time_format = get_option('time_format', Tribe__Date_Utils::TIMEFORMAT);
   $time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');
   
   $start_datetime = tribe_get_start_date();
   $start_date = tribe_get_start_date(null, false);
   $start_time = tribe_get_start_date(null, false, $time_format);
   $start_ts = tribe_get_start_date(null, false, Tribe__Date_Utils::DBDATEFORMAT);
   
   $the_customdate = date("l, M. j", strtotime($start_date));
   
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
   
   /**
    * Returns a formatted time for a single event
    *
    * @var string Formatted time string
    * @var int Event post id
    */
   $time_formatted = apply_filters('tribe_events_single_event_time_formatted', $time_formatted, $event_id);
   
   /**
    * Returns the title of the "Time" section of event details
    *
    * @var string Time title
    * @var int Event post id
    */
   $time_title = apply_filters('tribe_events_single_event_time_title', __('Time:', 'the-events-calendar') , $event_id);
   
   $cost = tribe_get_formatted_cost();
   
   if (!empty(get_field('attend_reg_link')))
   {
       $website = get_field('attend_reg_link');
   }
   else
   {
       $website = tribe_get_event_website_url();
   }
   
   $toattend = get_field('to_attend_copy');
   $livestream = get_field('livestream');
   
   $live_link = get_field('live_reg_link');
   ?>

  <div class="mobile-meta-section-title"> <?php echo $the_customdate; ?> <?php esc_html_e( ' | ', 'the-events-calendar' ) ?> <?php echo $time_formatted; ?></div>
  <div class="main-mobile-metabox">
   <div class="mobile-meta-attend-box">
      <div class="mobile-meta-to-attend"><?php
         esc_html_e('Attend:', 'the-events-calendar');
         ?></div>

      <div class="mobile-register-attend"><a href="<?php
         echo $website;
         ?>">Register »</a></div>
         <div class="mobile-meta-cost"><?php
         echo the_field('to_attend_copy');
         ?></div>
</div>
</div>
<?php
   do_action('tribe_events_single_meta_details_section_end');
   ?>
