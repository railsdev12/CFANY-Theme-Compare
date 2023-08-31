<?php


function theme_enqueue_styles() {

  // wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
  
//   $css_timestamp = filemtime( get_stylesheet_directory() . 'tribe-events/tribe-events.css' );
//   define( 'THEME_VERSION', $css_timestamp );

  // Single Event Stylesheets
  if ( tribe_is_event() ) {
  
  	// wp_enqueue_style( 'js-custom-events', get_stylesheet_directory_uri() . '/tribe-events/tribe-events.css', array( 'fusion-dynamic-css' ) );
   
    if ( is_single('45214') ) {
      wp_enqueue_style( 'bg-style', get_stylesheet_directory_uri() . '/bg.css', array( 'fusion-dynamic-css' ) );
    }
    if ( is_single( array('51136', '63076') ) ) {
      wp_enqueue_style( 'dinner19-style', get_stylesheet_directory_uri() . '/dinner19-style.css', array( 'fusion-dynamic-css' ) );
      }
  }

  // Calendar List View Stylesheet
//   if ( tribe_is_past() || tribe_is_event_category() || tribe_is_upcoming() && !is_tax() ) {
//   	wp_dequeue_style( 'tribe-events-calendar-override-style' );
//     wp_enqueue_style( 'tribe-calendar', get_stylesheet_directory_uri() . '/tribe-events/pro/tribe-calendar.css', array( 'fusion-dynamic-css' ), '2.0.1' );
//   }

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );


// Preload Icon Fonts on Homepage Only
add_filter('autoptimize_filter_extra_tobepreloaded', 'insect_preloadfonts');
function insect_preloadfonts($preloads) {
  if ( is_front_page() ) {
    // $preloads[]='/wp-content/themes/Avada/includes/lib/assets/fonts/icomoon/icomoon.woff';
    $preloads[]='/wp-content/themes/Avada/includes/lib/assets/fonts/fontawesome/webfonts/fa-regular-400.woff2';
    $preloads[]='/wp-content/themes/Avada/includes/lib/assets/fonts/fontawesome/webfonts/fa-solid-900.woff2';
  }
  return $preloads;
}


add_action('wp_enqueue_scripts', 'owl_library');
function owl_library() {
// wp_enqueue_style( 'owl-min', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css' );
// wp_enqueue_style( 'owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css');
// wp_enqueue_script( 'owl-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array(), '1.0.0', true );

wp_enqueue_style( 'owl-min', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
wp_enqueue_style( 'owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
wp_enqueue_script( 'owl-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
wp_enqueue_script( 'vimeo-js', 'https://player.vimeo.com/api/player.js');
wp_enqueue_script( 'paginate-js', site_url().'/wp-content/themes/Avada-Child-Theme/js/jquery.pagination-with-hash-change-2.js');
}



// custom jquery cards
// function my_theme_scripts() {
// if (is_page( 63018 )) {
//     wp_enqueue_script( 'person-card', get_stylesheet_directory_uri() . '/js/person-card.js', array( 'jquery' ), '1.0.0', true );
// 
// }
// }
// add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

function add_this_social_script() {
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64e5d311a6e78100191d5a90&product=inline-share-buttons' async='async'></script> -->
      <!-- <script async src="https://static.addtoany.com/menu/page.js"></script> -->
  <?php
}
add_action('wp_head', 'add_this_social_script');



add_post_type_support( 'page', 'excerpt' );


// apply to a specific form and field
add_filter( 'gform_field_content_92', function( $field_content, $field ) {
    if ( $field->id == 31 ) {
        return str_replace( 'Peter Sang Mentorship Award New Award Category', "<div class='award-title'>Peter Sang Mentorship Award</div><div class='special-award-note'>New Award Category</div>", $field_content );
    }
    return $field_content;
}, 10, 2 );


// Remove unnecessary tribe stylesheets
function deregister_tribe_styles() {
if( tribe_is_event() && is_single() && !tribe_is_event_category() ) {
wp_dequeue_style( 'tribe-filterbar-styles' );
  wp_deregister_style( 'tribe-filterbar-styles' );
wp_dequeue_style( 'tribe-filterbar-mobile-styles' );
  wp_deregister_style( 'tribe-filterbar-mobile-styles' );
wp_dequeue_style( 'tribe-events-calendar-mobile-style' );
  wp_deregister_style( 'tribe-events-calendar-mobile-style' );
wp_dequeue_style( 'tribe-events-calendar-style' );
  wp_deregister_style( 'tribe-events-calendar-style' );
wp_dequeue_style( 'tribe-events-calendar-pro-mobile-style' );
  wp_deregister_style( 'tribe-events-calendar-pro-mobile-style' );
wp_dequeue_style( 'tribe-events-calendar-pro-theme-mobile-style' );
  wp_deregister_style( 'tribe-events-calendar-pro-theme-mobile-style' );
wp_dequeue_style( 'tribe-events-calendar-pro-style' );
  wp_deregister_style( 'tribe-events-calendar-pro-style' );
wp_dequeue_style( 'tribe-events-calendar-full-pro-mobile-style' );
  wp_deregister_style( 'tribe-events-calendar-full-pro-mobile-style' );
  }
}
add_action( 'wp_enqueue_scripts', 'deregister_tribe_styles' );

// Remove tippy css file
add_action( 'wp_enqueue_scripts', 'gv_dequeue_main_css', 30 );
// add_action( 'wp_print_footer_scripts', 'gv_dequeue_main_css', 2 );
function gv_dequeue_main_css() {
	wp_dequeue_style( 'gravityview-field-approval-tippy' );
}


function js_deregister_styles() {
if( ! is_page('58223') ) {
  wp_deregister_style( 'slickmap.css' );
  }
}
add_action( 'wp_enqueue_scripts', 'js_deregister_styles' );


// Fix Avada Theme JS Compiler
add_filter( 'fusion_compiler_js_file_is_readable', '__return_true' );



function wpdocs_dequeue_dashicon() {
        if ((is_user_logged_in()) || ( tribe_is_past() || tribe_is_upcoming() && !is_tax())) {
            return;
        }
        wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );



// add_filter( 'fusion_load_live_editor', '__return_false', 999 );

add_action( 'wp_print_scripts', 'ecp_remove_google_maps_api', 100 );
function ecp_remove_google_maps_api() {
	if( tribe_is_event() && is_single() ) {
	wp_deregister_script( 'tribe-gmaps' );
	}
}

function my_custom_head_function_for_avada() {
?>


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR87D6T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<?php
}
add_filter( 'avada_before_body_content', 'my_custom_head_function_for_avada' );

function customize_tribe_events_breakpoint() {
return 800;
}
add_filter( 'tribe_events_mobile_breakpoint', 'customize_tribe_events_breakpoint' );




// Disable jQuery Migrate in WordPress.
// add_filter( 'wp_default_scripts', $af = static function( &$scripts) {
//     if(!is_admin()) {
//         $scripts->remove( 'jquery');
//         $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
//     }    
// }, PHP_INT_MAX );
// unset( $af );


// redirect to cfany homepage on logout
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}


// child form to own page for edit
add_filter( 'gravityflowparentchild_add_child_entry_link', 'sh_filter_gravityflowparentchild_new_entry_link', 10, 5 );
/**
 * Modify the new child entry link to link to a form on a page on the site instead of opening the modal.
 * Dynamically populate Event Title and Event Page URL fields at creation of new child entry
 */
function sh_filter_gravityflowparentchild_new_entry_link( $form_link, $form_url, $parent_form_id, $child_form_id, $parent_entry_id ) {
	$original_entry = GFAPI::get_entry( $parent_entry_id );
	$original_entry_title = $original_entry[1];
	    $encode_title_orig = esc_attr( urlencode( $original_entry_title ) );
	$original_entry_url = $original_entry[33];
	$current_event_id = url_to_postid($original_entry[33]);
	$current_event_title = get_the_title( $current_event_id );
    $encode_title_curr = esc_attr( urlencode( $current_event_title ) );
	$form_url = site_url() . '/gravity-event-updates-additions/?workflow_parent_entry_id=' . $parent_entry_id . '&event-title=' . $encode_title_orig . '&current-title=' . $encode_title_curr . '&eventpg-url=' . $original_entry_url;
	$form_url = esc_url( $form_url );
	$form_link = sprintf( '<a href="%s">Add Request</a>', $form_url );
	return $form_link;
}

/**
 * Disable the State Saving on your DataTables view
 * @link https://datatables.net/reference/option/stateSave
 */
add_filter( 'gravityview_datatables_js_options', 'my_gv_state_save', 20, 2 );

/**
 * @param array $config Holds the DataTables table configuration 
 * @param string $view_id The current view id
 */
function my_gv_state_save( $config, $view_id ) {
	$config['stateSave'] = false;
	return $config;
}



add_filter( 'gform_column_input_43_87_1', 'set_column', 10, 5 );
function set_column( $input_info, $field, $column, $value, $form_id ) {
    return array( 'type' => 'select', 'choices' => ',Asset Owner,Institutional Investment Manager,Sell-Side Research Analyst/Trader/Investment Banker/Salesperson,Vendor,Government Official,Corporate Executive,Academic' );
}


// Add https to gforms website field type entries values and validate URL
add_filter( 'gform_pre_render', 'jms_check_website_field_value' );
add_filter( 'gform_pre_validation', 'jms_check_website_field_value' );
function jms_check_website_field_value( $form ) {
	foreach ( $form['fields'] as &$field ) {  // for all form fields
		if ( 'website' == $field['type'] || ( isset( $field['inputType'] ) && 'website' == $field['inputType'] ) ) {  // select the fields that are 'website' type
			$value = RGFormsModel::get_field_value( $field );  // get the value of the field
			if ( ! empty( $value ) ) { // if value not empty
				$field_id = $field['id'];  // get the field id
				if ( ! preg_match( "~^(?:f|ht)tps?://~i", $value ) ) {  // if value does not start with ftp:// http:// or https://
					$value = "https://" . $value;  // add https:// to start of value
				}

				$_POST[ 'input_' . $field_id ] = $value; // update post with new value
			}
		}
	}
	return $form;
}


//remove comments btn from admin bar
function remove_comments(){
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'remove_comments' );


// restrict simple cal scripts
// function my_script_cleanup() {
//   if ( !is_page( 46250 )) {
//   	wp_dequeue_script( 'wpsbc-script' );
//     wp_deregister_script( 'wpsbc-script' );
//     wp_dequeue_style( 'wpsbc-style' );
//     wp_deregister_style( 'wpsbc-style' );
//   }
// }
// add_action( 'wp_print_scripts', 'my_script_cleanup', 100 );
// add_action( 'wp_print_styles', 'my_script_cleanup', 100 );


function my_script_cleanup() {
  if ( !is_page( array(46250,63400,67352) )) {
  	wp_dequeue_script( 'wpsbc-script' );
    wp_deregister_script( 'wpsbc-script' );
    wp_dequeue_style( 'wpsbc-style' );
    wp_deregister_style( 'wpsbc-style' );
  }
}
add_action( 'wp_print_scripts', 'my_script_cleanup', 100 );
add_action( 'wp_print_styles', 'my_script_cleanup', 100 );


// WP-Admin Custom Styling
add_action('admin_head', 'admin_custom_styles');
function admin_custom_styles() {
  echo '<style>
  
  .cvent-reg-link {
  background-color: yellow;
  }

table#event_cost, table#event_url {
    display: none;
}

.fusion-builder-module-settings.fusion_code,
.fusion-builder-option.code {
    height: 100%;
    display: block;
    position: relative;
}

.fusion-builder-module-settings.fusion_code .option-field.fusion-builder-option-container {
    width: 100%;
    height: 100%;
    max-height: 850px;
    padding-left: 0;
    padding-top: 0;
    float: none;
}

.fusion-builder-module-settings.fusion_code .option-details {
    display: block;
    width: 100%;
}

.fusion-builder-module-settings.fusion_code .CodeMirror {
    display: block;
    width: 100%;
    margin-top: 15px;
    position: relative;
    max-height: 850px;
    height: 100%;
}

.fusion-builder-module-settings.fusion_code .CodeMirror .CodeMirror-scroll {
    max-height: 850px;
    height: 100%;
}

table.widefat>tbody>tr:last-of-type>.entry-view-field-value {
    padding: 20px
}

#gform_118 .gpnf-nested-entries-container>table.gpnf-nested-entries {
    width: 100%;
    border: solid 2px #dad9d9;
    border-top: none;
    background-color: #168fd4;
    padding: 3px 0 0;
}

#gform_118 .entry-view-field-value.jms {
    background-color: white;
    padding: 7px 7px 7px 40px;
}

#gform_118 .gpnf-nested-entries td.entry-view-field-name {
    background-color: #F9F2E6;
}

.wp-admin.toplevel_page_gravityflow-inbox #gform_118 .entry-view-section-break {
    margin-top: 30px;
    border-top: solid 5px #168fd4;
    padding-top: 20px;
    text-transform: uppercase;
    color: #063e5e;
}

.wp-admin.toplevel_page_gravityflow-inbox #gform_118 .gpnf-nested-entries>tbody .entry-view-section-break {
    margin-top: 0;
    border-top: none;
    padding-top: 7px;
    text-transform: none;
    color: #000
}

#mo_idp_feedback_modal, #embed-popup-wrap {
display: none;
}
   
  </style>';
}

//Show the Edit Organizer and Edit Venue links on single Organizer and single Venue pages
function tribe_enable_show_in_admin_bar( $args ) {
	$args['show_in_admin_bar'] = true; // Default: false
	return $args;
}
add_filter( 'tribe_events_register_organizer_type_args', 'tribe_enable_show_in_admin_bar' );
add_filter( 'tribe_events_register_venue_type_args', 'tribe_enable_show_in_admin_bar' );

// unregister default widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);



function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


// REDIRECT TO HTTPS
// function tcb_redirect_to_primary_domain() {
//   $schema           = is_ssl() ? 'https://' : 'http://';
//   $requested_domain = strtolower($schema . $_SERVER['HTTP_HOST']);
// 
//   $primary_domain = get_bloginfo('url');
//   if( defined('WP_SITEURL') && '' != WP_SITEURL )
//     $primary_domain = WP_SITEURL;
// 
//   if( empty($primary_domain) ) return; // Something is really wrong.
// 
//   $primary_domain = strtolower($primary_domain);
// 
//   // strip subdirectories.
//   if( preg_match('|^(https?://)([^/]+)/.+|', $primary_domain, $matches) )
//     $primary_domain = $matches[1] . $matches[2];
// 
//   $primary_domain    = rtrim($primary_domain, '/');
//   $requested_domain  = rtrim($requested_domain, '/');
// 
//   if( $primary_domain !== $requested_domain ){
//     $redirect = $primary_domain . $_SERVER['REQUEST_URI'];
//     wp_redirect( $redirect, 302 );
//     exit;
//   }
// }
// add_action('template_redirect', 'tcb_redirect_to_primary_domain');







// enable gravity flow customizations file 
require_once 'gravity-flow.php';

// enable GF readonly customizations file 
// require_once 'gf_readonly.php';








//The add-on doesn't support performing authorization only transactions out of the box, however, you could try using //the gform_paypalpaymentspro_args_before_payment filter in the theme functions.php file to set $args['TRXTYPE'] //property to 'A'.
//https://www.gravityhelp.com/documentation/article/gform_paypalpaymentspro_args_before_payment/
add_filter( 'gform_paypalpaymentspro_args_before_payment', function ( $args, $form_id ) {

    if ( $form_id == 85 ) {
        //$args['TRXTYPE'] = 'A';
	$args['COMMENT2'] = "New Candidate Membership Application from Website";
    }
    if ( $form_id == 86 ) {
        //$args['TRXTYPE'] = 'A';
	$args['COMMENT2'] = "New Professional Membership Application from Website";
    }
	if ( $form_id == 77 ) {
        //$args['TRXTYPE'] = 'A';
	$args['COMMENT2'] = "Kaplan Promo Membership Application from Website";
    }
    if ( $form_id == 90 ) {
        //$args['TRXTYPE'] = 'A';
	$args['COMMENT2'] = "2019 Professional Review Day from Website";
    }
    if ( $form_id == 64 ) {
        //$args['TRXTYPE'] = 'A';
	$args['COMMENT2'] = "2019 Congratulatory Reception from Website";
    }
    return $args;
}, 15, 5 );


// CHANGE LOGIN LOGO
function cfany_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.jpg);
				height:143px;
				width:300px;
				background-size: 300px 143px;;
				background-repeat: no-repeat;
    			padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'cfany_login_logo' );


// REMOVE THEMEFUSION NEWS WIDGET
function remove_dashboard_meta() {
remove_meta_box( 'themefusion_news', 'dashboard', 'normal' ); // Theme Fusion
remove_meta_box( 'tribe_dashboard_widget', 'dashboard', 'normal' ); // Theme Fusion
}
add_action( 'admin_init', 'remove_dashboard_meta' );



// Single organizer
add_filter( 'tribe_organizer_label_singular', 'change_single_organizer_label' );
function change_single_organizer_label() {
    return 'Speaker | Organizer';
}
add_filter( 'tribe_organizer_label_singular_lowercase', 'change_single_organizer_label_lowercase' );
function change_single_organizer_label_lowercase() {
    return 'speaker | organizer';
}


// Plural organizer
add_filter( 'tribe_organizer_label_plural', 'change_plural_organizer_label' );
function change_plural_organizer_label() {
    return 'Speakers | Organizers';
}
add_filter( 'tribe_organizer_label_plural_lowercase', 'change_plural_organizer_label_lowercase' );
function change_plural_organizer_label_lowercase() {
    return 'speakers | organizers';
}




add_filter( 'widget_display_callback', 'clean_widget_display_callback', 10, 3 );
function clean_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

// add_filter('widget_display_callback', 'increase_event_widget_limit', 10, 2);
// // Test if the current widget is an Advanced List Widget and fix the event limit if it is.
// function increase_event_widget_limit(array $instance, $widget) {
//     if (is_a($widget, 'Tribe__Events__Pro__Advanced_List_Widget'))
//         $instance['limit'] = 15;
//     return $instance;
// }









// Remove categories from filter bar
function remove_specific_categories_from_filterbar( $values, $filter_slug ) {
	if ( 'eventcategory' !== $filter_slug ) {
		return $values;
	}
	$unwanted = array( 'ce-credits','conference','final-date-tbd','save-the-date','industry-conference','interest-group','committee-meeting','member-exclusive-rate','seminar','programs-for-members'  );
	foreach ( $values as $key => $value ) {
		if ( in_array( $value['data']['slug'], $unwanted ) ) {
			unset( $values[ $key ] );
		}
	}
	return $values;
}
add_filter( 'tribe_events_filter_values',  'remove_specific_categories_from_filterbar', 10, 2 );



add_filter( 'gform_validation_43', 'validate_time', 10, 4 );
function validate_time( $validation_result ) {
    
    //Adjust these to match the field IDs
    $start_field_id = 4;
    $end_field_id = 148;

    //Convert field values to timestamps
    $start_timestamp = gf_get_timestamp( rgpost( 'input_' . $start_field_id ) );   
    $end_timestamp = gf_get_timestamp( rgpost( 'input_' . $end_field_id ) );

    $form = $validation_result['form'];

    if ( $end_timestamp < $start_timestamp ) {
        // set the form validation to false
        $validation_result = false;
        
        //finding the end field and marking it as failed validation
        foreach( $form['fields'] as &$field ) {
 
            if ( $field->id == $end_field_id ) {
                $field->failed_validation = true;
                $field->validation_message = 'Make sure end time is later than start time!';
                break;
            }
        }
    }

    $validation_result['form'] = $form;
    return $validation_result;
}

function gf_get_timestamp( $value ) {
    return strtotime( substr_replace( implode(':', $value), ' ', -3, 1 ) );
}



add_filter( 'nav_menu_css_class', 'add_custom_class', 10, 2 );
function add_custom_class( $classes = array(), $menu_item = false ) {
    //Check if already have the class
    if (! in_array( 'current-menu-item', $classes ) ) {
        //Check if it's the ID we're looking for
        if ( 44939 == $menu_item->ID ) {
            //Check if is in a tribe event page
            if ( tribe_is_event() && is_single() ) {
                    $classes[] = 'current-menu-item';
            }
        } 
    }
    return $classes;
}


function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
} add_filter('tiny_mce_before_init', 'override_mce_options');



if ( class_exists('Tribe__Events__Main') ){

  /* get event category names in text format */
  function tribe_get_text_categories ( $event_id = null ) {

    if ( is_null( $event_id ) ) {
      $event_id = get_the_ID();
    }

    $event_cats = '';

    $term_list = wp_get_post_terms( $event_id, Tribe__Events__Main::TAXONOMY );

    foreach( $term_list as $term_single ) {
      if ($term_single->name != 'CFA Society NY Event') {
        $event_cats .= $term_single->name . ', ';
      }
    }

    return rtrim($event_cats, ', ');

  }

}



add_filter('tribe_events_delete_old_events_sql', function() {
    global $wpdb;
    
    $excludeCategoryIds = '38, 75, 80, 82, 88, 124, 152, 178, 202, 205, 207, 209, 211, 213, 214, 220';

    $event_post_type = Tribe__Events__Main::POSTTYPE;

    $posts_with_parents_sql = "SELECT DISTINCT post_parent
		FROM {$wpdb->posts}
		WHERE post_type= '$event_post_type'
			AND post_parent <> 0
		";
                
    $posts_with_category_id_sql = "SELECT DISTINCT object_id
		FROM {$wpdb->term_relationships}
		WHERE term_taxonomy_id IN ({$excludeCategoryIds})";

    $sql = "SELECT post_id
		FROM {$wpdb->posts} AS t1
		INNER JOIN {$wpdb->postmeta} AS t2 ON t1.ID = t2.post_id
		WHERE t1.post_type = %d
			AND t2.meta_key = '_EventEndDate'
			AND t2.meta_value <= DATE_SUB( CURDATE(), INTERVAL %d MONTH )
			AND t1.post_parent = 0
			AND t1.ID NOT IN ( $posts_with_parents_sql )
			AND t1.ID NOT IN ( $posts_with_category_id_sql )
		";
    
    return $sql;
});

// Prepends or appends fields (marked by class `prepend-to-pages` or `append-to-pages` respectively) to every page of a Gravity Form
add_action( 'gform_pre_render', function( $form ) {

   add_action( 'wp_footer', function () { ?>

      <script type="text/javascript">
         jQuery(document).bind('gform_post_render', function(event, form_id, current_page) {

            jQuery(jQuery('.gfield.prepend-to-pages').get().reverse()).each(function() {
               jQuery(this).prependTo(`#gform_page_${form_id}_${current_page} .gform_page_fields`);
            });

         } );
      </script>

   <?php } );

   return $form;

} );



// add_filter( 'gform_other_choice_value', function( $placeholder, $field ) {
//     if ( $field->formId == 126 && $field->id == 6 ) {
//         $placeholder = 'Prefer to self-describe';
//     }
//     return $placeholder;
// }, 10, 2 );


add_filter( 'gpwc_script_args', 'gpwc_modify_script_args', 10, 3 );
function gpwc_modify_script_args( $args, $field, $form ) {

	$args['defaultLabel'] = '<span style="font-weight:bold;color:#063e5e">Word Count: {count}</span>';
	$args['counterLabel'] = '<span style="font-weight:bold;color:#063e5e">Word Count: {count}</span>';
// 	$args['limitReachedLabel'] = '<span style="font-weight:bold">{count}</span>';
// 	$args['limitExceededLabel'] = '<span style="font-weight:bold;color:#f00">{count}</span>';
	$args['minCounterLabel'] = '<span style="font-weight:bold;color:#063e5e">{count}</span>';
	$args['minReachedLabel'] = '<span style="font-weight:bold;color:#063e5e">Word Count: {count}</span>'; 

	return $args;
}


// Unrequire fields
// add_filter( 'gform_pre_render', 'gw_conditional_requirement' );
// add_filter( 'gform_pre_validation_114', 'gw_conditional_requirement' );
// function gw_conditional_requirement( $form ) {
//     $value = rgpost( 'input_43_1' );
//     if ( $value !== 'true' ) {
//         return $form;
//     }
//  
//     foreach ( $form['fields'] as &$field ) {
//             $field->isRequired = false;
//     }
//     return $form;
// }


/**
 * Gravity Perks // GP Limit Dates // Block Date Range via Exceptions
 */
add_filter( 'gpld_limit_dates_options_43_2', 'gpld_except_date_range', 10, 3 );
function gpld_except_date_range( $options, $form, $field ) {

	$start_date = '2021-10-18';
	$end_date   = '2021-10-30';

	// do not modify below this line

	$start_date = new DateTime( $start_date );
	$end_date   = new DateTime( $end_date );
	$period     = new DatePeriod( $start_date, new DateInterval( 'P1D' ), $end_date );

	foreach( $period as $date ) {
		array_push( $options['exceptions'], $date->format( 'm/d/Y' ) );
	}

	$options['exceptionMode'] = 'disable';

	return $options;
}



// GRAVITY FLOW - Hide hidden copyedit status field (ID 149) and Rob field (ID 151)
//// when on event or podcast proposal submission voting workflow step (ID 56)
add_filter( 'gravityflow_workflow_detail_display_field', 'sh_gravityflow_workflow_detail_display_field', 10, 5 );
function sh_gravityflow_workflow_detail_display_field( $display, $field, $form, $entry, $current_step ) {
    if ( $current_step && $current_step->get_id() == 56 && in_array( $field->id, array( 149, 151 ) ) ) {
        $display = false;
    }
    return $display;
	
	if ( $current_step && $current_step->get_id() == 265 && in_array( $field->id, array( 149, 151 ) ) ) {
        $display = false;
    }
    return $display;
}



// add_action( 'rest_api_init', function () {
//     register_rest_route( 'endpoint/v1', 'email/(?P<stringvar>[^/]+)', array(
//         'methods'             => 'GET',
//         'callback'            => 'user_email',
//         // 'permission_callback' => '__return_true',
//         'permission_callback' => function () {
//       return current_user_can( 'edit_others_posts' );
//     },
//     ) );
// });
// 
// 
// function user_email($data) {
// 
//     // Get user by their email address
//     $user = get_user_by( 'email', $data['stringvar']);
//     $userId = $user->ID;
//     $user_data = [$userId, $data['stringvar']];
// 
// 
//     wp_reset_postdata();
// 
//     return rest_ensure_response($user_data);
// }
// 
// 
// 
// register_rest_field( 'user', 'user_email',
//     array(
//         'get_callback'    => function ( $user ) {
//             return get_userdata($user['id'])->user_email;
//         },
//         'update_callback' => null,
//         'schema'          => null,
//     )
// );



add_action( 'gform_user_updated', 'add_additional_role', 10, 4 );
function add_additional_role( $user_id, $feed, $entry, $user_pass ) {
    // Run only for form id 1
    $form = GFAPI::get_form( $entry['form_id'] );
    if ( $form['id'] != 145 ) {
       return;
    }
 
    GFCommon::log_debug( __METHOD__ . '(): running for User ID: ' . $user_id );
    // Role name ID to add
    $role_to_add_one = 'society_membership_access';
    $role_to_add_two = rgar ( $entry, '5' );
 
    // Get current user object
    $user_obj = new WP_User( $user_id );
    // Add the role above to existing role(s) for the user
    $user_obj->add_role( $role_to_add_one );
     $user_obj->add_role( $role_to_add_two );
 
    GFCommon::log_debug( __METHOD__ . '(): Roles for user ' . $user_id . ': ' . print_r( $user_obj->roles, true ) );
 
}


add_filter( 'gform_user_registration_update_user_id_145', 'override_user_id', 10, 4 );
function override_user_id( $user_id, $entry, $form, $feed ) {
    // Get email address from URL query string on form display or field ID 1 during submission.
    $email = rgar( $entry, '1' );
 
    return email_exists( $email );
}



// Enable use of 'tags' on page-type template
function add_tags_to_pages() {
register_taxonomy_for_object_type( 'post_tag', 'page' );
}
add_action( 'init', 'add_tags_to_pages');


// function widget($atts) {
//     
//     global $wp_widget_factory;
//     
//     extract(shortcode_atts(array(
//         'widget_name' => FALSE
//     ), $atts));
//     
//     $widget_name = wp_specialchars($widget_name);
//     
//     if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
//         $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
//         
//         if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
//             return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
//         else:
//             $class = $wp_class;
//         endif;
//     endif;
//     
//     ob_start();
//     the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
//         'before_widget' => '',
//         'after_widget' => '',
//         'before_title' => '',
//         'after_title' => ''
//     ));
//     $output = ob_get_contents();
//     ob_end_clean();
//     return $output;
//     
// }
// add_shortcode('widget','widget'); 



// add_action( 'rest_api_init', 'adding_user_meta_rest' );
// 
//     function adding_user_meta_rest() {
//        register_rest_field( 'user', 'user_email',
//   array(
//     'get_callback'    => function ( $user ) {
//         return get_userdata($user['id'])->user_email;
//     },
//     'update_callback' => null,
//     'schema'          => null,
//   )
// );
//     }
    
    
//     add_filter('pre_user_email', 'skip_email_exist');
// function skip_email_exist($user_email){
//     define( 'WP_IMPORTING', 'SKIP_EMAIL_EXIST' );
//     return $user_email;
// }



// Add text area to Compound Insights form list field
add_filter( 'gform_column_input_content_146_4_4', 'change_column4_content', 10, 6 );
function change_column4_content( $input, $input_info, $field, $text, $value, $form_id ) {
    //build field name, must match List field syntax to be processed correctly
    $input_field_name = 'input_' . $field->id . '[]';
    $tabindex = GFCommon::get_tabindex();
    $new_input = '<textarea name="' . $input_field_name . '" ' . $tabindex . ' class="textarea medium" cols="50" rows="10">' . $value . '</textarea>';
    return $new_input;
}



// SHOW ALL POST META KEYS AND VALUES TO ADMIN
// if (current_user_can( 'manage_options' )){
//     add_action('wp_head', 'output_all_postmeta' );
// function output_all_postmeta() {
// 
// 	$postmetas = get_post_meta(get_the_ID());
// 
// 	foreach($postmetas as $meta_key=>$meta_value) {
// 		echo $meta_key . ' : ' . $meta_value[0] . '<br/>';
// 	}
// }
// };



// dynamically change the merge tag output for CI podcast list fields
// add_filter( 'gform_merge_tag_filter', function ( $value, $merge_tag, $modifier, $field, $raw_value, $format ) {
//     if ( $field->type == 'list' && $merge_tag != 'all_fields' && is_numeric( $modifier ) ) {
//         // count the actual number of columns
//         $choices      = $field->choices;
//         $column_count = count( $choices );
//  
//         if ( $column_count > 1 ) {
//             // subtract 1 from column number as the choices array is zero based
//             $column_num = $modifier - 1;
//  
//             // get the column label so we can use that as the key to the multi-column values
//             $column = rgars( $choices, "{$column_num}/text" );
//  
//             // get the list fields values from the $entry
//             $values        = unserialize( $raw_value );
//             $column_values = array();
//  
//             // loop through the rows and get only the column value we are interested in
//             foreach ( $values as $value ) {
//                 $column_values[] = rgar( $value, $column );
//             }
//  
//             $value = GFCommon::implode_non_blank( ', ', $column_values );
//         }
//     }
//  
//     return $value;
// }, 10, 6 );



// function jms_check_user_role( $roles ) {
// 
//     if ( is_user_logged_in() ) :
// 
//         $user = wp_get_current_user();
// 
//         $currentUserRoles = $user->roles;
//         /*@ Intersect both array to check any matching value */
//         $isMatching = array_intersect( $currentUserRoles, $roles);
//         $response = false;
//         /*@ If any role matched then return true */
//         if ( !empty($isMatching) ) :
//             $response = true;        
//         endif;
//         return $response;
//     endif;
// }
// $roles = [ 'society_membership_access', 'local_professional', 'local_candidate',
// 			'cfa_ny_local_member', 'cfa_institute_user_only', 'cfa_institute_member', 'cfa_charterholder_member' ];
// if ( jms_check_user_role($roles) ) :
//     add_filter('show_admin_bar', '__return_false');
// endif;




// function jms_check_user_role( $roles ) {
// 
//     if ( is_user_logged_in() ) {
//     
//      $user = wp_get_current_user();
// 
//         $currentUserRoles = $user->roles;
//        
//         $isMatching = array_intersect( $currentUserRoles, $roles);
//         $response = false;
//        
//         if ( !empty($isMatching) ) {
//         	$response = true;  
//         }
//         return $response;
//     }
// }
// 
// $roles = [ 'society_membership_access', 'local_professional', 'local_candidate',
// 			'cfa_ny_local_member', 'cfa_institute_user_only', 'cfa_institute_member', 'cfa_charterholder_member' ];
// if ( jms_check_user_role($roles) ) {
// 	
// 	function remove_admin_bar_links() {
// 	global $wp_admin_bar;
// 	$wp_admin_bar->remove_menu('wp-logo');
// 	$wp_admin_bar->remove_menu('site-name');
// }		
// }
// add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
// 
// 
// 
// function hide_admin_items() {
//   
// //  Change username "demouser"
//  $user = wp_get_current_user();
//     if($user && isset($user->user_login) && 'demouser' == $user->user_login) { 
// 
//    /* DASHBOARD */	
//    remove_submenu_page( 'index.php', 'update-core.php');  // Update
//     }
// }
// add_action('admin_head', 'hide_admin_items');


// function wps_admin_bar() {
// 
// $user = wp_get_current_user();
// 
// $roles = array (
//         'administrator',
//         'editor',
//         'programming_committee',
//         'pc_staff',
//     );
//     
//     if (is_user_logged_in() && !( array_intersect( $roles, $user->roles ) )) {
// 
// 	global $wp_admin_bar;
// 	$wp_admin_bar->remove_menu('wp-logo');
//     $wp_admin_bar->remove_menu('site-name');
// 
// 	}
//     
// }
// add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

// function my_admin_bar_render() {
//     $user = wp_get_current_user();
// 
//     if ( in_array( 'society_membership_access', (array) $user->roles ) ) {
//         global $wp_admin_bar;
//         $wp_admin_bar->remove_menu('wp-logo');
//         $wp_admin_bar->remove_menu('site-name');
//     }
// }
// add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );


add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
    if ( ! current_user_can( 'edit_posts' ) ) {
        $wp_admin_bar->remove_node( 'wp-logo' );
        $wp_admin_bar->remove_node( 'site-name' );
    }
},999);


function remove_menus(){
if ( ! current_user_can( 'edit_posts' ) ) {
        remove_menu_page( 'wpsbc-calendars' );
  		remove_menu_page( 'gravityflow-inbox' );
    }
  }
  add_filter( 'admin_menu', 'remove_menus', 999 );
	

// Filter whether jQuery UI Dialog should be used to power the Nested Forms modal experience.
// // FALSE switches to "current Tingle UI"
add_filter( 'gpnf_use_jquery_ui', '__return_false' );



// This example validates field 5 in form 159 to check that end time is greater than start time
add_filter( 'gform_field_validation_159_5', 'validate_time_outlook', 10, 4 );
function validate_time_outlook( $result, $value, $form, $field ) {

    $master_start = rgpost( 'input_4' );

    //convert the entire time field array into a string, separating values with colons
    $input_time_end = implode( ':', $value );
    $input_time_start = implode( ':', $master_start );
    //replace colon between the time and am/pm with space and convert strings into a unix timestamp
    $time_end = strtotime( substr_replace( $input_time_end, ' ', -3, 1 ) );
    $time_start = strtotime( substr_replace( $input_time_start, ' ', -3, 1 ) );

  
    if ( $input_time_end <= $input_time_start ) {
        $result['is_valid'] = false;
        $result['message'] = 'End time is less than or equal to the start time';
    }
    return $result;
}


add_action( 'gform_enqueue_scripts_114', 'dequeue_jms_flatpickr_script', 11);
add_action( 'gform_enqueue_scripts_159', 'dequeue_jms_flatpickr_script', 11);
add_action( 'gform_enqueue_scripts_160', 'dequeue_jms_flatpickr_script', 11);
function dequeue_jms_flatpickr_script() {
	Fusion_Dynamic_JS::dequeue_script( 'fusion-date-picker' );
}

add_action( 'gform_enqueue_scripts_114', 'enqueue_jms_flatpickr_script', 10, 2 );
add_action( 'gform_enqueue_scripts_159', 'enqueue_jms_flatpickr_script', 10, 2 );
add_action( 'gform_enqueue_scripts_160', 'enqueue_jms_flatpickr_script', 10, 2 );
function enqueue_jms_flatpickr_script( $form, $is_ajax ) {
    wp_register_style( 'jms_datepickerGF', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css' );
    wp_register_script( 'jms_datepickerGF', 'https://cdn.jsdelivr.net/npm/flatpickr', null, null, true );
    wp_register_script( 'jms_datepickerGF', 'https://cdn.jsdelivr.net/npm/flatpickr', null, null, true );
   

    wp_enqueue_style( 'jms_datepickerGF' );
    wp_enqueue_script( 'jms_datepickerGF' );
}




add_shortcode( 'cvent_url', 'js_acf_value_func' );
function js_acf_value_func() {


// args
$args = array(
	'numberposts'	=> 20,
	'post_type'		=> 'tribe_events',
	'meta_key'		=> 'cvent_reg_link',
	'date_query' => array(
    	'column' => 'post_date',
    	'after' => '2022-03-01',
  )
);


// query
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ): 

?>
	<ul>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); 
	
	$cvent_link = get_field('cvent_reg_link');
	
	?>
		<div class="found-instance">
				<a style="font-size: 20px; margin-bottom: 10px;" class="cfa-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<div class="jms-reg-url-row">The registration URL is: <?php echo $cvent_link; ?></div>
		</div>
		<hr style="margin: 20px 0;">
	<?php endwhile; ?>
		
	</ul>
<?php 
	endif; 
	wp_reset_query();	
	
}

/**  Success Story Post Type  **/

function cfany_post_types() {
  // Success Story Post Type
  register_post_type('success_story', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
    'rewrite' => array('slug' => 'success_stories'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Success Stories',
      'add_new_item' => 'Add New Success Story',
      'edit_item' => 'Edit Success Story',
      'all_items' => 'All Success Stories',
      'singular_name' => 'Success Story'
    ),
    'menu_icon' => 'dashicons-thumbs-up'
  ));
}

add_action('init', 'cfany_post_types');


/* ganesh codex */


/** Register cfancy video shortcode **/
add_action( 'init', 'register_cfancy_video_shortcode' );

if(!function_exists('register_cfancy_video_shortcode'))
{
  function register_cfancy_video_shortcode() {
    add_shortcode( 'cfancy-video-posts', 'cfancy_video_codex' );
  }
}

if(!function_exists('cfancy_video_codex'))
{
  function cfancy_video_codex( $atts, $content = null ) {

    ob_start();
  ?>
<section class="owl_content_carousel">
<div class="row">
  <!-- <div class="padding padding_left col-md-1 col-sm-1 col-xs-2"><button type="button" role="presentation" class="slide_btn customPrevBtn"><span aria-label="Previous">‹</span></button></div> -->
	<div class="padding_center col-md-12 col-sm-12 col-xs-12">
    
			<div class="owl-carousel owl-theme" id="owl-demo">
      <?php
      $slider_terms = get_terms('video-category');
      foreach($slider_terms as $slider_term) {
          wp_reset_query();
          $slider_args = array('post_type' => 'tribe_events',
              'tax_query' => array(
                  array(
                      'taxonomy' => 'video-category',
                      'field' => 'slug',
                      'terms' => $slider_term->slug,
                  ),
              ),
          );

          $slider_loop = new WP_Query($slider_args);
          if($slider_loop->have_posts()) {
              while($slider_loop->have_posts()) : $slider_loop->the_post();
              global $post;
                $featured_video = (get_field( "feature_in_video_hub",$post->ID ))?get_field( "feature_in_video_hub",$post->ID ):'';
                if($featured_video)
                {
                  $cover_img = (get_field( "cover_image",$post->ID ))?get_field( "cover_image",$post->ID ):'';
                  $summary = (get_field( "summary",$post->ID ))?get_field( "summary",$post->ID ):'';
                ?>
                <div class="slide">
                <a class="watch_now" href="javascript:void(0);" data-post-id="<?php echo $post->ID; ?>">
                  <div class="owl-text-overlay ">
                    <div class="txt">
                      <h2><?php the_title(); ?></h2>
                      <p><?php echo $summary; ?></p>
                      <span class="button">Watch Now</span>
                    </div>
                  </div>
                  <img class="owl-img" src="<?php echo $cover_img['url']; ?>">
                  <div class="mob" style="display:none;">
                      <h2><?php the_title(); ?></h2>
                      <p><?php echo $summary; ?></p>
                      <span class="button">Watch Now</span>
                  </div>
                </a>
                
                </div>
                <?php
                }
              endwhile;
          }
      }
      ?>
			</div>

	</div>
  <!-- <div class="padding padding_right col-md-1 col-sm-1 col-xs-2"><button type="button" role="presentation" class="slide_btn customNextBtn"><span aria-label="Next">›</span></button></div> -->
	</div>
</section>

<section class="video_post_container">
  <div class="container">
  <div class="row">
	<div class="col-md-3 step_one">
		<div class="categories">
			<h3>Categories</h3>
      <div id="dynamic_load_terms"></div>
		</div>
	</div>
	<div class="col-md-3 step_two">
		<div id="first_load" class="categories_posts">
		<h3>Most Recents</h3>
    <div id="dynamic_load_posts"></div>
		</div>
	</div>
	<div class="col-md-6 step_three">
		<div id="first_video" class="video_preview"></div>
	</div>
    </div>
    </div>
</section>
<section id="loader"><img src="<?php bloginfo('url');?>/wp-content/uploads/2023/08/ajax-load.gif" alt="loader"></section>
<style>
/* Owl Slider CSS*/
#loader{
  position: fixed;
  background: rgba(255,255,255,0.8);
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  z-index: 99999;
  display:none;
}
#loader img{
  position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: auto;
    width: 60px;
}
.video_post_container {
    margin: 0;
    width: 100%;
    display: inline-block;
    padding: 50px 0 0;
}

.owl_content_carousel {
    display: inline-block;
    width: 100%;
}

.owl_content_carousel .row{
  display: flex;
    align-items: center;
  }
.padding{    
  /* background-color: rgb(132 125 125 / 50%); */
  background-color:transparent;
    height: 350px;
  }
.padding_left{}
.padding_center{}
.padding_right{}

.owl-theme .owl-controls .owl-buttons .owl-prev {
    left: -80px;
    position: absolute;
}
.owl-theme .owl-controls .owl-buttons .owl-next {
    right: -80px;
    position: absolute;
}
.owl-carousel {
    border-right: 0px solid #fff;
    border-left: 0px solid #FFF;
}

.owl-wrapper {
  position: relative;
}
.owl-theme .owl-nav {
  position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0!important;
    top: 45%;
}

.owl-theme .owl-nav button.owl-prev{
  left: 0px;
    position: absolute;
    background-color: #5b5d5e;
    color: #fff;
    padding: 10px!important;
    border-radius: 0;
    margin:0;
}
.owl-theme .owl-nav button.owl-next{
  right: 0px;
    position: absolute;
    background-color: #5b5d5e;
    color: #fff;
    padding: 10px!important;
    border-radius: 0;
    margin:0;
}

.owl-theme .owl-nav button.owl-prev.disabled,
.owl-theme .owl-nav button.owl-next.disabled{
  display:none;
}

.owl-carousel .owl-item.active .video_heading {
    left: -80px;
    position: relative;
    width: 120%;
    right: -80px;
}

.owl-carousel .owl-item:not(.active) img{
    opacity:0.3;
}
.owl-carousel .owl-item:not(.active) iframe{
    background-color:#8a9195
}

.owl-carousel .owl-item:not(.active) .video_heading{
    visibility:hidden!important;
    opacity:0!important;
}

.owl-theme .owl-controls .owl-page span {
  background: #fff !important;
}

.owl-img {
  width: 100%;
}

.owl-text-overlay {
    position: absolute;
    text-align: center;
    width: 50%;
    top: 50%;
    transform: translateY(-50%);
    left: 50px;
    margin-left: auto;
    margin-right: auto;
    color: #fff;
    text-align:left;
}

.txt {
  font-size: 18px;
  margin-bottom: 20px;
  color:#fff;
}
.txt h2 {
  color: #fff;
    font-size: 36px;
    margin-bottom: 20px;
}
.txt p{margin-bottom:50px;margin-top:0;font-size:24px;line-height:30px;}

.txt span.button{
  color: #FFF;
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    line-height: 160%;
    border-radius: 8px;
    background: #2D63A2;
    padding: 15px 40px;
}
.txt span.button:hover{background: #1f5189;}



.owl-theme .owl-controls .owl-page span:active {
  background: #fff !important;
}


.video_post_container .categories{}
.video_post_container .categories_posts{}
.video_post_container .video_preview{}

.video_post_container .categories h3{
  color: #000;
  font-family: var(--nav_typography-font-family);
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 125%;
    text-transform: uppercase;
    border-bottom: 1px solid #8D8D8A;
    padding-bottom: 20px;
    margin-bottom: 20px;
    margin-top: 0;
}
.video_post_container .categories_posts h3{
  color: #000;
  font-family: var(--nav_typography-font-family);
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 125%;
    text-transform: uppercase;
    border-bottom: 1px solid #8D8D8A;
    padding-bottom: 20px;
    margin-bottom: 20px;
    margin-top: 0;
}
.video_post_container .video_preview h3{
  color: #000;
  font-family: var(--nav_typography-font-family);
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 125%;
    text-transform: uppercase;
    border-bottom: 1px solid #8D8D8A;
    padding-bottom: 20px;
    margin-bottom: 20px;
    margin-top: 0;
}
.video_post_container .video_preview h4.title{
  color: #000;
  font-family: var(--nav_typography-font-family);
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 125%;
    text-transform: uppercase;
    border-bottom: 1px solid #8D8D8A;
    padding-bottom: 20px;
    margin-bottom: 20px;
    margin-top: 0;
    display:none;
}

.video_post_container ul.terms_lists{
  list-style: none;
    padding: 0;
    margin: 0;
}
.video_post_container ul.terms_lists li{
  display: block;
    line-height: 40px;
    margin-bottom: 20px;
}
.video_post_container ul.terms_lists li a{
  display: block;
    padding: 5px 10px;
    border: 1px solid #fff;
    color: #000;
    font-family: var(--nav_typography-font-family);
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 160%; /* 25.6px */
    }
.video_post_container ul.terms_lists li.active a{
  border: 1px solid #2D63A2;
}
.video_post_container ul.terms_lists li a:hover{border: 1px solid #2D63A2;}

.video_post_container ul.posts{
  list-style: none;
    padding: 0;
    margin: 0;
}

.video_post_container ul.posts li{
  display: block;
    line-height: 40px;
    margin-bottom: 20px;
}
.video_post_container ul.posts li a{
  display: block;
    padding: 5px 10px;
    border: 1px solid #fff;
    color: #000;
    font-family: var(--nav_typography-font-family);
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 160%; /* 25.6px */
    }
.video_post_container ul.posts li.active a{
  border: 1px solid #2D63A2;
}
.video_post_container ul.posts li a:hover{border: 1px solid #2D63A2;}

.video_post_container .video_preview ul{
  display: flex;
    list-style: none;
    flex-wrap: wrap;
    padding: 0;
    justify-content: space-around;
    gap: 10px;
    position:relative;
  }
.video_post_container .video_preview ul li{
  flex-grow: 1;
    flex: 49%;
  position:relative;
  }
.video_post_container .video_preview ul li img{
  display: block;
    width: 100%;
    height: auto;
}

.video_post_container .video_preview ul li .bg_img{
  position:relative;
}
.video_post_container .video_preview ul li .bg_img a.play_now span{opacity:0;}
.video_post_container .video_preview ul li .bg_img a.play_now#current_playing span {

    display: block;
    text-align: center;
    align-items: center;
    justify-content: center;
    width: 100%;
    color: #fff;
    position: relative;
    top: 50px;
}
.video_post_container .video_preview ul li a.play_now {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0,0,0,0.6);
}
.video_post_container .video_preview ul li a.play_now img {
    display: block;
    width: 60px;
    height: 60px;
    margin: auto;
    position: relative;
    top: 35%;
}
.video_post_container .video_preview ul li a.play_now:hover img{
  top:34%;
}
.video_post_container .video_preview ul li h4{
  background: #EBEBE7;
color: #000;
font-family: var(--nav_typography-font-family);
font-size: 18px;
font-style: normal;
font-weight: 600;
line-height: 125%; /* 22.5px */
text-transform: uppercase;
padding: 10px;
min-height: 65px;
}
.video_post_container .video_preview ul li h4 a{color: #000!important;}
.video_post_container .video_preview ul li h4 a:hover{color: #666!important;}

.dcs_pag_loading {padding: 20px;}
.dcs-universal-pagination ul {margin: 0; padding: 0;font-family: var(--nav_typography-font-family);font-size:10px;}
.dcs-universal-pagination ul li {display: inline; margin: 3px; padding: 4px 8px; background: #FFF; color: #2D63A2; }
.dcs-universal-pagination ul li.active:hover {cursor: pointer; background: #2D63A2; color: white; }
.dcs-universal-pagination ul li.inactive {color: #2D63A2;font-size:10px;}
.dcs-universal-pagination ul li.selected {background-color: #2D63A2; color: white;}

.sort {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: space-between;
}
.sort .post_counter{
  color: #8D8D8A;
  font-family: var(--nav_typography-font-family);
  font-weight: var(--nav_typography-font-weight);
  font-size: 10px;
  font-style: normal;
  font-weight: 600;
  line-height: 125%; /* 12.5px */
  text-transform: uppercase;
}
.sort .sort_block {
    color: #8D8D8A;
    font-family: var(--nav_typography-font-family);
    font-weight: var(--nav_typography-font-weight);
    font-size: 10px;
    font-style: normal;
    font-weight: 600;
    line-height: 125%;
    text-transform: uppercase;
    padding-left: 35%;
}
.sort .sort_block select{
  border: 1px solid #2D63A2;
background: #FFF;
font-family: var(--nav_typography-font-family);
color: #2D63A2;
font-size: 10px;
font-style: normal;
font-weight: 600;
line-height: 125%; /* 12.5px */
text-transform: uppercase;
padding: 3px 5px;
border-radius: 0;
height: auto;
margin-left: 5px;
}
.sort .nav_block{
  color:#2D63A2;
  font-family: var(--nav_typography-font-family);
    font-weight: var(--nav_typography-font-weight);
}
.sort .nav_block button {
    background: transparent;
    border: 0;
    color: #2D63A2;
    font-weight: bold;
    font-size: 20px;
    margin-left: 5px;
    cursor:pointer;
}
.sort .nav_block button.prev {
    margin-right: 5px;
}
.sort .nav_block button.next {
    margin-left: 5px;
}
.sort .nav_block button img{
  width: 7px;
    max-width: 100%;
    height: auto;
    display: block;
}
.search_form {
    position: relative;
    display: block;
}
.search_form input {
    padding: 5px 30px 5px 10px;
    height: 40px;
    font-family: var(--nav_typography-font-family);
    font-size:16px;
    color:#8D8D8A;
}
.search_form button {
    position: absolute;
    right: 0;
    background: transparent;
    border: 0;
    padding: 12px 10px;
    cursor: pointer;
    color:#8D8D8A;
}
.filter{
  position: absolute;
  right: -82px;
}
.dcs-universal-pagination{
  /* position: absolute;
    top: 65px;
    right: -560px;
    z-index: 99; */
    margin-top: 100px;
    display: block;
}

.owl-item .item iframe {
  position:relative!important;
    width:100%;
    height:480px!important;
}



.slider_container .fusion-builder-column-0 > .fusion-column-wrapper{
  padding-right: 14px !important;
  padding-left: 14px !important;
  margin:0!important;
}
button.slide_btn {
    background-color: #5b5d5e;
    border: 0;
    color: #fff;
    height: 45px;
    position: absolute;
    top: 40%;
    width: 25px;
    cursor:pointer;
}
button.slide_btn.customPrevBtn{left:0;}
button.slide_btn.customPrevBtn:hover{opacity:0.8;}
button.slide_btn.customNextBtn{right:0;}
button.slide_btn.customNextBtn:hover{opacity:0.8;}

.video_heading {
    background-color: #EBEBE7;
    width: 100%;
    display: flex;
    padding: 20px 70px;
    align-items: center;
}
.video_heading .video_title {
    width: 70%;
    border-right: 1px solid #b8afaf;
}
.video_heading .video_title span.p_title {
    display: block;
    font-size: 20px;
    color: #8D8D8A;
}
.video_heading .video_title span.v_title {
    display: block;
    font-size: 24px;
    color: #000;
}
.video_heading .share {
    width: 30%;
}
.video_heading .share ul {
    display: flex;
    margin: 0;
    list-style: none;
    align-items: center;
    justify-content: center;
}
.video_heading .share ul li {
    display: inline-block;
    margin-right: 8px;
}
.video_heading .share ul li a {
    display: block;
}
.video_heading .share ul li img {
    width: 30px;
    height: 30px;
}

.video_heading .share ul li.social .fa {
    background-color: #a08076;
    width: 35px;
    font-size: 16px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    color: #ebebe7;
    border-radius: 2px;
}

.video_heading .share ul li.social a:hover .fa{
  background-color: #84685f;
}

.owl-dots{
  margin-top: 25px!important;
}

.video_post_container .video_preview ul li .mobile_show{
  display:none;
  position: relative;
    font-size: 10px;
    color: #8D8D8A;
    text-transform: uppercase;
    margin-top: 10px;
}

@media only screen and (max-width: 1024px) {
  .slider_container .fusion-builder-column-0 > .fusion-column-wrapper {
      padding-right: 4px !important;
      padding-left: 4px !important;
  }
}
@media only screen and (max-width: 992px) {
  .video_post_container .categories {
    margin-bottom: 30px;
  }
  .video_post_container .video_preview {
    margin-top: 30px;
  }
}
@media only screen and (max-width: 850px) {
  .slider_container .fusion-builder-column-0 > .fusion-column-wrapper {
      padding-right: 0px !important;
      padding-left: 0px !important;
  }
  .video_post_container .container{width:100%;}
  .padding {
      height: 240px;
  }
  .txt h2 {
      font-size: 25px!important;
  }
  .txt p {
    font-size: 18px;
  }
}
@media only screen and (max-width: 767px) {
  .video_post_container .col-md-3.step_one{display:block;}
  .video_post_container .col-md-3.step_two{display:none;}
  .video_post_container .col-md-6.step_three{display:none;}
  button#pre_cat{
    color: #8D8D8A;
    text-align: left;
    font-size: 10px;
    font-weight: normal;
    line-height: 160%;
    border-radius: 8px;
    padding: 0px 0px;
    display: block;
    margin-bottom: 30px;
    border: 0;
    cursor: pointer;
    background-color: transparent;
    font-family: inherit;
    text-transform: uppercase;
  }
  button#pre_post{
    color: #8D8D8A;
    text-align: left;
    font-size: 10px;
    font-weight: normal;
    line-height: 160%;
    border-radius: 8px;
    padding: 0px 0px;
    display: block;
    margin-bottom: 30px;
    border: 0;
    cursor: pointer;
    background-color: transparent;
    font-family: inherit;
    text-transform: uppercase;
  }
  .dcs-universal-pagination {
      margin-top: 50px;
      display: block;
      margin-bottom: 20px;
  }
  .video_post_container .video_preview {
      margin-top: 0;
  }
  .video_post_container .video_preview h3{display:none;}
  .owl-item .item iframe {
      height: 400px!important;
  }
  .video_heading {
    padding: 10px 30px;
  }
  .video_heading .video_title {
        width: 65%;
  }
  .video_heading .video_title span.p_title {
    font-size: 16px;
  }
  .video_heading .video_title span.v_title {
    font-size: 20px;
  }
  .owl-carousel .owl-item.active .video_heading {
      left: 0;
      position: relative;
      width: 100%;
      right: 0;
  }
}

@media only screen and (max-width: 750px) {
  .owl-carousel .owl-item img {
      width: 100%;
      height: auto;
      display:block;
  }
  
  .owl-text-overlay {
    width: 80%;
  }
  .owl-text-overlay .txt{opacity:0;display: none;}
  .owl-carousel .owl-item .mob{display:block!important;margin-top:25px;position:relative;margin-bottom:10px;}
  .owl-carousel .owl-item .mob h2{font-size: 30px!important;color: #000;margin-bottom: 10px;}
  .owl-carousel .owl-item .mob p{font-size:20px!important;color:#000;}
  .owl-carousel .owl-item .mob .button{
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    line-height: 160%;
    border-radius: 8px;
    background: #2D63A2;
    padding: 10px 30px;
    display: inline-block;
  }
  .txt h2 {
    font-size: 20px!important;
    margin-bottom: 10px;
  }
  .txt p {
    margin-bottom: 30px;
    margin-top: 0;
    font-size: 16px;
    line-height: 25px;
  }
  .video_post_container .video_preview h4.title {
    display: block;
  }
  .video_post_container .video_preview ul li .bg_img{
    display:none;
  }
  .video_post_container .video_preview ul li h4 {
    min-height: auto;
    line-height: 30px;
    background: transparent;
    border: 1px solid #fff;
  }
  .video_post_container .video_preview ul li h4.active{
    border: 1px solid #2D63A2;
  }

}
@media only screen and (max-width: 700px) {
  .video_heading .video_title span.p_title {
    font-size: 14px;
  }
  .video_heading .video_title span.v_title {
    font-size: 18px;
  }
  .video_heading .share ul li.social .fa {
    width: 30px;
    font-size: 14px;
    height: 30px;
    line-height: 30px;
}
}
@media only screen and (max-width: 650px) {
  .owl-item .item iframe {
    height: 345px!important;
  }
  .video_heading {
    padding: 10px 15px;
  }
  .video_heading .share {
    padding-left: 15px;
  }
}
@media only screen and (max-width: 570px) {
  .video_post_container .video_preview ul li img {
      height: auto;
  }
  .video_post_container .video_preview ul li h4 {
    min-height: auto;
  }
}
@media only screen and (max-width: 540px) {
  .owl-item .item iframe {
    height: 280px!important;
  }
  .video_heading {
    display: block;
  }
  .video_heading .video_title {
      width: 100%;
      border-right: 0;
      text-align: center;
  }
  .video_heading .share {
      width: 100%;
      margin-top: 10px;
      padding-left: 0;
  }
  .video_post_container .video_preview ul li img {
      height: auto;
  }
  .video_post_container .video_preview ul li h4 {
      min-height: auto;
  }
  .video_post_container .video_preview ul li {
      margin-bottom: 10px;
  }
}
@media only screen and (max-width: 480px) {
  .txt p {
    font-size: 14px;
    line-height: 22px;
  }
  .sort .sort_block {
    padding-left: 0%;
  }
  .owl-text-overlay {
    left: 20px;
    width: 90%;
  }
  .owl-item .item iframe {
      height: 250px!important;
  }
}
@media only screen and (max-width: 400px) {
  .owl-item .item iframe {
    height: 200px!important;
  }
}
@media only screen and (max-width: 340px) {
  .owl-item .item iframe {
    height: 170px!important;
  }
}
</style>
<script>
	jQuery(document).ready(function(){
    var owl = jQuery('#owl-demo');
    owl.owlCarousel({
    items: 1,
    stagePadding: 80,
    loop:true,
    margin:10,
    nav:true,
    dots: false,
    video:true,
    center:true,
    autoHeight:true,
    responsiveClass: true,
    responsive:{
        0:{
            items:1,
            dots: true,
            nav:false,
            margin:0,
            stagePadding: 0
        },
        600:{
            items:1,
            dots: true,
            nav:false,
            margin:0,
            stagePadding: 0
        },
        750:{
            items:1,
            dots: true,
            nav:false,
            margin:0,
            stagePadding: 0
        },
        768:{
            items:1,
            stagePadding: 50,
            dots: false,
            nav:true
        },
        1000:{
            items:1,
            stagePadding: 80,
            dots: false,
            nav:true
        }
    }
		});

  //   jQuery(document).on('click','button.customNextBtn',function(){
  //     owl.trigger('next.owl.carousel');
  //   });
  // // Go to the previous item
  //   jQuery(document).on('click','button.customPrevBtn',function(){
  //       owl.trigger('prev.owl.carousel', [300]);
  //   });

    let flag=false;
    let ajaxurl='<?php echo admin_url("admin-ajax.php"); ?>';

    function dcs_load_all_posts(page,term_id,post_id,sort,search){
        jQuery("#loader").show();
        var data = {
            page: page,
            term_id:term_id,
            post_id:post_id,
            sort:sort,
            search:search,
            action: "demo-pagination-load-posts"
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery("#dynamic_load_posts").html('').append(response);
            jQuery('#dynamic_load_posts ul.posts li:first-child').addClass('active');
            jQuery("#loader").hide();
        });
    }
    dcs_load_all_posts(1,term_id='',post_id='',sort='',search='');
    


    jQuery(document).on('click','.dcs-universal-pagination li.active',function(){
      var page = jQuery(this).attr('p');
      var term_id = jQuery(this).attr('t');
      dcs_load_all_posts(page,term_id,post_id,sort='',search='');
		});

    function dcs_load_terms(){
      var data = {
            load: 'yes',
            action: "dynamic_load_terms"
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery("#dynamic_load_terms").html('').append(response);
        });
    }
    dcs_load_terms();

    function dcs_load_video_preview(term_id='',post_id=''){
      jQuery("#loader").show();
      var data = {
            term_id: term_id,
            post_id: post_id,
            action: "dynamic_load_post_preview"
        };
        var response = jQuery.post(ajaxurl, data, function(response) {
            jQuery("#first_video").html('').append(response);
            setTimeout(function(){
                jquery_pagination();
            }, 2000);
            jQuery("#loader").hide();
        });
        return response;
    }
    dcs_load_video_preview(term_id);

    jQuery(document).on('click','ul.terms_lists li a',function(e){
      e.preventDefault();
      var viewport_size = jQuery(window).width();
      jQuery('ul.terms_lists li').removeClass('active');
      jQuery(this).parent().addClass('active');
      let term_id = jQuery(this).attr("data-id");
      jQuery("#first_load h3").text(jQuery(this).text());
      dcs_load_all_posts(1,term_id,post_id='',sort='',search='');
      dcs_load_video_preview(term_id);
      if(viewport_size <= 767)
      { 
        var prev_cat_btn = jQuery('<button type="button" id="pre_cat"><&nbsp;&nbsp;Categories</button>');
        jQuery(".video_post_container .col-md-3.step_one").fadeOut();
        jQuery(".video_post_container .col-md-3.step_two").fadeIn();
        jQuery(".video_post_container .col-md-6.step_three").fadeOut();
        jQuery(prev_cat_btn).insertAfter(".video_post_container .col-md-3.step_two h3");
      }

    });

    jQuery(document).on("click","ul.posts li a",function(e) {
      e.preventDefault();
      var viewport_size = jQuery(window).width();
      jQuery('#dynamic_load_posts ul.posts li').removeClass('active');
      jQuery(this).parent().addClass('active');
      let post_id = jQuery(this).attr("data-post-id");
      let term_id = jQuery(this).attr("data-term-id");
      dcs_load_video_preview(term_id,post_id);
      
      if(viewport_size <= 767)
      { 
        var prev_post_btn = jQuery('<button type="button" id="pre_post"><&nbsp;&nbsp;Events</button>');
        jQuery(".video_post_container .col-md-3.step_one").fadeOut();
        jQuery(".video_post_container .col-md-3.step_two").fadeOut();
        jQuery(".video_post_container .col-md-6.step_three").fadeIn();
        setTimeout(function(){
        jQuery(prev_post_btn).insertAfter(".video_post_container .col-md-6.step_three h4.title");
        }, 2000);
      }
    });

    jQuery(document).on("click","button#pre_cat",function(e) {
      jQuery(".video_post_container .col-md-3.step_one").fadeIn();
      jQuery(".video_post_container .col-md-3.step_two").fadeOut();
      jQuery(".video_post_container .col-md-6.step_three").fadeOut();
      jQuery(this).remove();
    });

    jQuery(document).on("click","button#pre_post",function(e) {
      jQuery(".video_post_container .col-md-3.step_one").fadeOut();
      jQuery(".video_post_container .col-md-3.step_two").fadeIn();
      jQuery(".video_post_container .col-md-6.step_three").fadeOut();
      jQuery(this).remove();
    });

    jQuery(document).on("change","select#sort",function(e) {
      e.preventDefault();
      let sort_selected = jQuery(this).find("option:selected").val();
      if(sort_selected==='desc'){
        sorting_date_desc(".jq_pagination ul");
      } else if(sort_selected==='asc'){
        sorting_date_asc(".jq_pagination ul");
      } else if(sort_selected==='name_asc'){
        sorting_alphabet_asc(".jq_pagination ul");
      }  else if(sort_selected==='name_desc'){
        sorting_alphabet_desc(".jq_pagination ul");
      } else {
        sorting_date_desc(".jq_pagination ul");
      } 
 
    });

    jQuery(document).on("click","button#search_btn",function(e) {
      e.preventDefault();
      let search_value = jQuery("input#search").val();
      dcs_load_all_posts(1,term_id='',post_id='',sort_selected='',search_value);
      jQuery("#first_load h3").text('Search Results');
    });

    jQuery(document).on("keydown","input#search",function(e) {
        if(e.keyCode == 13){
          let search_value = jQuery("input#search").val();
          dcs_load_all_posts(1,term_id='',post_id='',sort_selected='',search_value);
          jQuery("#first_load h3").text('Search Results');
        }
    });
    
    jQuery(document).on("click","a.play_now",function(e) {
      e.preventDefault();
      let video_id = jQuery(this).attr("data-video-id");
      let post_id = jQuery(this).attr("data-post-id");
      if(flag!=true)
      {
        jQuery("#owl-demo .owl-item").each(function(index){
          jQuery('#owl-demo').trigger('remove.owl.carousel',index).trigger('refresh.owl.carousel');
        });

        flag=true;
      }
      jQuery(".jq_pagination ul li .bg_img a").removeAttr("id");
      jQuery(".jq_pagination ul li .bg_img").find('img').css({"visibility":"visible", "opacity":"1"});
      jQuery(".jq_pagination ul li .bg_img").find('span').css({"visibility":"hidden", "opacity":"0"});
      jQuery(this).attr("id","current_playing");
      var data = {
            video_id: video_id,
            post_id: post_id,
            action: "dynamic_fetch_video"
        };
        jQuery("#loader").show();
        jQuery.post(ajaxurl, data, function(response) {
            var obj = JSON.parse(response);
            if (obj.msg == '1') {
              jQuery('#owl-demo').trigger('add.owl.carousel', ['<div class="item">'+obj.video_iframe+'</div>',0]).trigger('refresh.owl.carousel');
              jQuery('.owl-carousel').data('owl.carousel').options.loop = false;
              jQuery('.owl-carousel').trigger( 'refresh.owl.carousel' );
              scrollToTop();
              setTimeout(function(){
                
                var player_click = document.querySelector('#owl-demo .owl-item.active iframe');
                var inactive_player = document.querySelector("#owl-demo .owl-item:not(.active) iframe");
                var data = { method: "play" };
                player_click.contentWindow.postMessage(JSON.stringify(data), "*");
                var player = new Vimeo.Player(player_click);
                
                player.on('play', function() {
                 // console.log('played the video!');
                  jQuery("a#current_playing").find('img').css({"visibility":"hidden", "opacity":"0"});
                  jQuery("a#current_playing").find('span').css({"visibility":"visible", "opacity":"1"});
                });

                player.on('pause', function() {
                  //console.log('paused the video!');
                  jQuery("a#current_playing").find('img').css({"visibility":"visible", "opacity":"1"});
                  jQuery("a#current_playing").find('span').css({"visibility":"hidden", "opacity":"0"});
                });

                player.on('ended', function() {
                   // console.log('ended the video!');
                    jQuery("a#current_playing").removeAttr('id').find('img').css({"visibility":"visible", "opacity":"1"});
                    jQuery("a#current_playing").find('span').css({"visibility":"hidden", "opacity":"0"});
                });

                if(inactive_player){
                  var player_all_to_pause = new Vimeo.Player(inactive_player);
                  player_all_to_pause.pause();
                }

                

                // player.on('timeupdate', function(data) {

                //     /*if (data.percent > 0.01) {
                //         console.log('1% of video watched');
                //     }*/

                //     if (data.seconds > 10) {
                //         console.log('10s of video watched');
                //     }


                // });

              }, 2000);
              jQuery("#loader").hide();
            }
            
        });
    });

    jQuery(document).on("click","a.play_now_alt",function(e) {
      e.preventDefault();
      let video_id = jQuery(this).attr("data-video-id");
      let post_id = jQuery(this).attr("data-post-id");
      let curr_item = jQuery(this);
      if(flag!=true)
      {
        jQuery("#owl-demo .owl-item").each(function(index){
          jQuery('#owl-demo').trigger('remove.owl.carousel',index).trigger('refresh.owl.carousel');
        });

        flag=true;
      }
      jQuery(".video_post_container .video_preview ul li .mobile_show").hide();
      var data = {
            video_id: video_id,
            post_id: post_id,
            action: "dynamic_fetch_video"
        };
        jQuery("#loader").show();
        jQuery.post(ajaxurl, data, function(response) {
            var obj = JSON.parse(response);
            if (obj.msg == '1') {
              jQuery('#owl-demo').trigger('add.owl.carousel', ['<div class="item">'+obj.video_iframe+'</div>',0]).trigger('refresh.owl.carousel');
              jQuery('.owl-carousel').data('owl.carousel').options.loop = false;
              jQuery('.owl-carousel').trigger( 'refresh.owl.carousel' );
              scrollToTop();
              setTimeout(function(){
                var player_click = document.querySelector('#owl-demo .owl-item.active iframe');
                var inactive_player = document.querySelector("#owl-demo .owl-item:not(.active) iframe");
                var data = { method: "play" };
                player_click.contentWindow.postMessage(JSON.stringify(data), "*");
                var player = new Vimeo.Player(player_click);
                
                player.on('play', function() {
                 // console.log('played the video!');
                 jQuery(".video_post_container .video_preview ul li .mobile_show").hide();
                 curr_item.parent().parent().find(".mobile_show").text('Now Playing').show();
                 jQuery(".video_post_container .video_preview ul li h4").removeClass("active");
                 curr_item.parent().parent().find("h4").addClass('active');
                });

                player.on('pause', function() {
                  jQuery(".video_post_container .video_preview ul li .mobile_show").hide();
                  curr_item.parent().parent().find(".mobile_show").text('Pause').show();
                  jQuery(".video_post_container .video_preview ul li h4").removeClass("active");
                  curr_item.parent().parent().find("h4").addClass('active');
                });

                player.on('ended', function() {
                   // console.log('ended the video!');
                   jQuery(".video_post_container .video_preview ul li .mobile_show").hide();
                   curr_item.parent().parent().find(".mobile_show").text('Ended').show();
                   jQuery(".video_post_container .video_preview ul li h4").removeClass("active");
                   curr_item.parent().parent().find("h4").addClass('active');
                });

                if(inactive_player){
                  var player_all_to_pause = new Vimeo.Player(inactive_player);
                  player_all_to_pause.pause();
                }

                

                // player.on('timeupdate', function(data) {

                //     /*if (data.percent > 0.01) {
                //         console.log('1% of video watched');
                //     }*/

                //     if (data.seconds > 10) {
                //         console.log('10s of video watched');
                //     }


                // });

              }, 2000);
              jQuery("#loader").hide();
            }
            
        });
    });

    jQuery(document).on('click','a.watch_now',function(){
      var curr_post_id = jQuery(this).attr('data-post-id');
      //alert(curr_post_id);
      var data = {
          curr_post_id: curr_post_id,
          action: "dynamic_load_watch_videos_for_post"
        };
        jQuery("#loader").show();
        jQuery.post(ajaxurl, data, function(response) {
          var obj = JSON.parse(response);
          if(obj.msg[0]=='1')
          {
              jQuery("#owl-demo .owl-item").each(function(index){
                jQuery('#owl-demo').trigger('remove.owl.carousel',index).trigger('refresh.owl.carousel');
              });
          }
          if(obj.video_iframe.length>0 && obj.msg[0]=='1')
          {
            for(var i=0; i<obj.video_iframe.length; i++) {
              jQuery('#owl-demo').trigger('add.owl.carousel', ['<div class="item">'+obj.video_iframe[i]+'</div>',i]).trigger('refresh.owl.carousel');
            }
            jQuery('.owl-carousel').data('owl.carousel').options.loop = false;
            jQuery('.owl-carousel').trigger( 'refresh.owl.carousel' );

            setTimeout(function(){
                var player_click = document.querySelector('#owl-demo .owl-item.active iframe');
                var inactive_player = document.querySelector("#owl-demo .owl-item:not(.active) iframe");
                var data = { method: "play" };
                player_click.contentWindow.postMessage(JSON.stringify(data), "*");

                var player = new Vimeo.Player(player_click);
                player.on('play', function() {
                 // console.log('played the video!');
                  // jQuery("a#current_playing").find('img').css({"visibility":"hidden", "opacity":"0"});
                  // jQuery("a#current_playing").find('span').css({"visibility":"visible", "opacity":"1"});
                  //alert(ref_id);
                });

                player.on('ended', function() {
                   // console.log('ended the video!');
                    // jQuery("a#current_playing").removeAttr('id').find('img').css({"visibility":"visible", "opacity":"1"});
                    // jQuery("a#current_playing").find('span').css({"visibility":"hidden", "opacity":"0"});
                });

                if(inactive_player){
                  var player_all_to_pause = new Vimeo.Player(inactive_player);
                  player_all_to_pause.pause();
                }

              }, 2000);

              jQuery("#loader").hide();
          }
            
        });
		});


	});


function sorting_alphabet_asc(selector) {
  jQuery(selector).children("li").sort(function(a, b) {
        var A = jQuery(a).attr('data-name').toUpperCase();
        console.log(A);
        var B = jQuery(b).attr('data-name').toUpperCase();
        console.log(B);
        return (A < B) ? -1 : (A > B) ? 1 : 0;
    }).appendTo(selector);
}

function sorting_alphabet_desc(selector) {
  jQuery(selector).children("li").sort(function(a, b) {
        var A = jQuery(a).attr('data-name').toUpperCase();
        console.log(A);
        var B = jQuery(b).attr('data-name').toUpperCase();
        console.log(B);
        return (A > B) ? -1 : (A < B) ? 1 : 0;
    }).appendTo(selector);
}

function sorting_date_asc(selector) {
  jQuery(selector).children("li").sort(function(a, b) {
        var A = jQuery(a).attr('data-postdate').toUpperCase();
        console.log(A);
        var B = jQuery(b).attr('data-postdate').toUpperCase();
        console.log(B);
        return (A < B) ? -1 : (A > B) ? 1 : 0;
    }).appendTo(selector);
}

function sorting_date_desc(selector) {
  jQuery(selector).children("li").sort(function(a, b) {
        var A = jQuery(a).attr('data-postdate').toUpperCase();
        console.log(A);
        var B = jQuery(b).attr('data-postdate').toUpperCase();
        console.log(B);
        return (A > B) ? -1 : (A < B) ? 1 : 0;
    }).appendTo(selector);
}

function jquery_pagination()
{
  jQuery('div.jq_pagination > ul').Paginationwithhashchange2({
        nextSelector: '.next',
        prevSelector: '.prev',
        counterSelector: '.counter',
        numPages : '.numPages',
        itemsPerPage: 6,
        initialPage: 1
      });
}

function scrollToTop() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}

	</script>
  <?php
    return ob_get_clean();
  }	
}


/**
 * AJAX Load Posts Dynamically
 */
add_action( 'wp_ajax_demo-pagination-load-posts', 'dcs_demo_pagination_load_posts' );
add_action( 'wp_ajax_nopriv_demo-pagination-load-posts', 'dcs_demo_pagination_load_posts' ); 
function dcs_demo_pagination_load_posts() {
    global $wpdb;
    $sort_order='';
    $orderby = '';
    $meta_key='';
    $terms_array = array();
    // Set default variables
    $msg = '';
    if(isset($_POST['page'])){
      $term_id = $_POST['term_id'];
      $post_id = $_POST['post_id'];
      $sort = $_POST['sort'];
      $search = ($_POST['search'])?$_POST['search']:'';
      if(!empty($sort) && $sort=='desc')
      {
        $sort_order = 'DESC';
        $orderby = 'post_date';
      } elseif(!empty($sort) && $sort=='asc'){
        $sort_order = 'ASC';
        $orderby = 'post_date';
      } elseif(!empty($sort) && $sort=='name_asc'){
        $sort_order = 'ASC';
        $orderby = 'title';
      } elseif(!empty($sort) && $sort=='name_desc'){
        $sort_order = 'DESC';
        $orderby = 'title';
      } elseif(!empty($sort) && $sort=='popular'){
        $sort_order = 'DESC';
        $orderby = 'meta_value_num';
        $meta_key = 'wpb_post_views_count';
      } else {
        $sort_order = 'DESC';
        $orderby = 'post_date';
      }

      if(!empty($search)){
        $search = $search;
      } else {
        $search = '';
      }

    
        // Sanitize the received page   
        $page = sanitize_text_field($_POST['page']);
        $cur_page = $page;
        $page -= 1;
        $per_page = 6; //set the per page limit
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        $start = $page * $per_page;

        if(!empty($term_id) && $term_id!='all'){
          $terms_array[] = $term_id;
        }
        else
        {
          $terms = get_terms([
            'taxonomy' => 'video-category',
            'hide_empty' => false,
          ]);
  
          foreach($terms as $term){
            $terms_array[] = $term->term_id;
          }
        }

        

        $all_blog_posts = new WP_Query(
            array (
              'post_type' => 'tribe_events',
              'orderby'   => $orderby,
              'order' => $sort_order,
              'post_status' => 'publish',
              'search_title' => $search,
              'meta_key' => $meta_key,
              'posts_per_page'    => $per_page,
              'offset'            => $start,
              'tax_query' => array(
                  array(
                      'taxonomy'  => 'video-category',
                      'field'     => 'term_id',
                      'terms'     => $terms_array,
                  )
              ),
          )
        );

        $count = new WP_Query(
          array (
            'post_type' => 'tribe_events',
            'orderby'   => $orderby,
            'order' => $sort_order,
            'meta_key' => $meta_key,
            'post_status' => 'publish',
            'search_title' => $search,
            'tax_query' => array(
                array(
                    'taxonomy'  => 'video-category',
                    'field'     => 'term_id',
                    'terms'     => $terms_array,
                )
            ),
        )
        );
        $count = $count->post_count;
        //echo '<div class="filter">';
        // echo '<div class="page_counter">';
        // echo $_POST['page'].'-'.$per_page.' OF '.$count;
        // echo '</div>';
        //echo '</div>';
        echo '<ul class="posts">';
        add_filter( 'posts_where', 'title_filter', 10, 2 );
        if ( $all_blog_posts->have_posts() ) {
          while ( $all_blog_posts->have_posts() ) {
            $all_blog_posts->the_post(); 
            global $post;
            $terms = get_the_terms($post->ID, 'video-category');
                      echo '<li><a href="#" data-term-id = "'.$terms[0]->term_id.'" data-post-id="'.$post->ID.'">' . get_the_title() . '</a></li>';

          }
        }
        echo '</ul>';
        // This is where the magic happens
        $no_of_paginations = ceil($count / $per_page);
        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
        // Pagination Buttons logic     
        ?>
        <div class='dcs-universal-pagination'>
            <ul>
             <?php
         if ($first_btn && $cur_page > 1) { ?>
             <!--<li p='1' t='<?php //echo $term_id; ?>' class='active'><<</li>-->
         <?php
         } else if ($first_btn) { ?>
             <!--<li p='1'  t='<?php //echo $term_id; ?>' class='inactive'><<</li>-->
         <?php
      }
         if ($previous_btn && $cur_page > 1) {
             $pre = $cur_page - 1; ?>
             <li p='<?php echo $pre; ?>'  t='<?php echo $term_id; ?>' class='active'><</li>
         <?php
         } else if ($previous_btn) { ?>
             <li class='inactive'><</li>
         <?php
      }
         for ($i = $start_loop; $i <= $end_loop; $i++) {
             if ($cur_page == $i){ ?>
                 <li p='<?php echo $i; ?>'  t='<?php echo $term_id; ?>' class = 'selected' ><?php echo $i; ?></li>
             <?php
          }else{ ?>
                 <li p='<?php echo $i; ?>'  t='<?php echo $term_id; ?>' class='active'><?php echo $i; ?></li>
                 <?php
             }
         }
         if ($next_btn && $cur_page < $no_of_paginations) {
             $nex = $cur_page + 1; ?>
             <li p='<?php echo $nex; ?>'  t='<?php echo $term_id; ?>' class='active'>></li>
         <?php
      } else if ($next_btn) { ?>
             <li class='inactive'>></li>
         <?php 
      }
 
         if ($last_btn && $cur_page < $no_of_paginations) { ?>
             <!--<li p='<?php //echo $no_of_paginations; ?>' class='active'>>></li>-->
         <?php 
      } else if ($last_btn) { ?>
             <!--<li p='<?php //echo $no_of_paginations; ?>' class='inactive'>>></li>-->
         <?php 
      } ?>
            </ul>
        </div>
        <?php
    }
    die();
}


add_action( 'wp_ajax_dynamic_load_terms', 'dynamic_load_terms_callback' );
add_action( 'wp_ajax_nopriv_dynamic_load_terms', 'dynamic_load_terms_callback' );
function dynamic_load_terms_callback()
{
      echo '<ul class="terms_lists">';
				$terms = get_terms([
					'taxonomy' => 'video-category'
				]);
        echo '<li class="active"><a href="#" class="js-category-button" data-id="all">Most Recent</a></li>';
				foreach( $terms as $term ):
				echo '<li><a href="#" class="js-category-button" data-id="'.$term->term_id.'">' . $term->name . '</a></li>';
				endforeach;
	    echo '</ul>';

      echo '<div class="search_form">';
      echo '<input type="text" name="search" value="" id="search" placeholder="Search"><button id="search_btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>';
      echo '</div>';
die();
}

add_action( 'wp_ajax_dynamic_load_post_preview', 'dynamic_load_post_preview_callback' );
add_action( 'wp_ajax_nopriv_dynamic_load_post_preview', 'dynamic_load_post_preview_callback' );
function dynamic_load_post_preview_callback()
{
  $term_id = ($_POST['term_id'])?$_POST['term_id']:'';
  $post_id = ($_POST['post_id'])?$_POST['post_id']:'';

    $p_terms_array=array();
    echo '<h3>&nbsp;</h3>';
    echo '<h4 class="title">'.get_the_title($post_id).'</h4>';
    echo '<div class="sort">';
    echo '<span class="post_counter">';
    echo '<span>Page: <span class="counter"></span> <span class="numPages"></span></span>';
    echo '</span>';
    echo '<span class="sort_block">';
    echo 'Sort by: <select id="sort"><option value="desc">Most Recent</option><option value="asc">Oldest First</option><option value="name_asc">A-Z</option><option value="name_desc">Z-A</option></select>';
    echo '</span>';
    echo '<span class="nav_block">';
    echo '<button class="prev"><img src="'.site_url().'/wp-content/uploads/2023/08/ARROW-L.png"></button>';
    echo '<button class="next"><img src="'.site_url().'/wp-content/uploads/2023/08/ARROW-R.png"></button>';
    echo '</span>';
    echo '</div>';
    echo '<div class="jq_pagination">';
		echo '<ul>';

    if(!empty($term_id) && $term_id!='all'){
      $p_terms_array[] = $term_id;

    } else {
      $terms = get_terms([
        'taxonomy' => 'video-category',
        'hide_empty' => false,
      ]);
  
      foreach($terms as $term){
        $p_terms_array[] = $term->term_id;
      }
    }

    if($post_id){

      $post_id = $_POST['post_id'];
      $index=0;
      if( have_rows('episode_list',$post_id) ){
        // loop through the rows of data
        while ( have_rows('episode_list',$post_id) ) : the_row();
        
          // display a sub field value
          $video_object =  get_sub_field_object('video_name');
          if($video_object['value']){
            $video_id = $video_object['value']->ID;
            //$url = wp_get_attachment_url( get_post_thumbnail_id($video_id), 'thumbnail' );
            $serialize_data = get_post_meta($video_object['value']->ID,"_fusion",true);
            $get_vimeo_id = getSrcFromIframe($serialize_data['video']); 
            //$vimeo_thumbnail = getVimeoVideoThumbnailByVideoId($get_vimeo_id,'large');
            $vimeo_thumbnail = get_vimeo_data_from_id( $get_vimeo_id, 'thumbnail_url');
            if(isset($vimeo_thumbnail) && $vimeo_thumbnail!=''):
              $url = $vimeo_thumbnail;
            else:
              $url = get_bloginfo('url').'/wp-content/uploads/2023/08/default_vimeo_thumbnail.jpg';
            endif;
            echo '<li data-post="'.$video_id.'" data-name="'.get_the_title($video_id).'" data-postdate="'.get_the_date('Y-m-d h:i:s',$video_id).'">';
            echo '<div class="bg_img">';
            echo '<img src="'.$url.'">';
            echo '<a class="play_now" href="javascript:void(0);" data-post-id="'.$post_id.'" data-index ="'.$index.'" data-video-id="'.$video_id.'">
            <img src="'.site_url().'/wp-content/uploads/2023/08/play_btn.png">';
            echo '<span>Now Playing</span>';
            echo '</a>';
            echo '</div>';
            echo '<h4>'.'<a class="play_now_alt" href="javascript:void(0);" data-post-id="'.$post_id.'" data-index ="'.$index.'" data-video-id="'.$video_id.'">'.get_the_title($video_id).'</a>'.'</h4>';
            echo '<div class="mobile_show">Now Playing</div>';
            $index++;
            echo '</li>';
          }
        
        endwhile;
      }

    } else {

        $lat_post_args = 
          array (
            'post_type' => 'tribe_events',
            'orderby'   => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'posts_per_page'    => 1,
            'offset'            => 0,
            'tax_query' => array(
                array(
                    'taxonomy'  => 'video-category',
                    'field'     => 'term_id',
                    'terms'     => $p_terms_array,
                )
            ),
          );
				 $loop = new WP_Query($lat_post_args);
				 if($loop->have_posts()) {
					while($loop->have_posts()) : $loop->the_post();
					global $post;
          $index =0;
						if( have_rows('episode_list',$post->ID) ){
							// loop through the rows of data
							while ( have_rows('episode_list',$post->ID) ) : the_row();
								// display a sub field value
								$video_object =  get_sub_field_object('video_name');
                // echo "<pre>";print_r($video_object);echo "</pre>";
								if($video_object['value']){
                  $video_id = $video_object['value']->ID;
                  //$url = wp_get_attachment_url( get_post_thumbnail_id($video_id), 'thumbnail' );
									$serialize_data = get_post_meta($video_object['value']->ID,"_fusion",true);
                  $get_vimeo_id = getSrcFromIframe($serialize_data['video']); 
                  //$vimeo_thumbnail = getVimeoVideoThumbnailByVideoId($get_vimeo_id,'large');
                  $vimeo_thumbnail = get_vimeo_data_from_id( $get_vimeo_id, 'thumbnail_url');
                  if(isset($vimeo_thumbnail) && $vimeo_thumbnail!=''):
                    $url = $vimeo_thumbnail;
                  else:
                    $url = get_bloginfo('url').'/wp-content/uploads/2023/08/default_vimeo_thumbnail.jpg';
                  endif;
                  echo '<li data-post="'.$video_id.'" data-name="'.get_the_title($video_id).'" data-postdate="'.get_the_date('Y-m-d h:i:s',$video_id).'">';
                  echo '<div class="bg_img">';
                  echo '<img src="'.$url.'">';
                  echo '<a class="play_now" href="javascript:void(0);" data-post-id="'.$post->ID.'" data-index ="'.$index.'" data-video-id="'.$video_id.'">
                  <img src="'.site_url().'/wp-content/uploads/2023/08/play_btn.png">';
                  echo '<span>Now Playing</span>';
                  echo '</a>';
                  echo '</div>';
                  echo '<h4>'.'<a class="play_now_alt" href="javascript:void(0);" data-post-id="'.$post_id.'" data-index ="'.$index.'" data-video-id="'.$video_id.'">'.get_the_title($video_id).'</a>'.'</h4>';
                  echo '<div class="mobile_show">Now Playing</div>';
                  $index++;
                  echo '</li>';
								}
             
							endwhile;
						} 
					endwhile;
				 }
    }

			echo '</ul>';
      echo '</div>';
  die();
}


function getSrcFromIframe($url){
  //$url = '<iframe title="YouTube video player" width="640" height="390" src="http://www.youtube.com/embed/VvJ037b_kLs" frameborder="0" allowfullscreen></iframe> ';
    $tmpDoc = new DOMDocument();
    
    # Dirty hack to support utf-8 with loadHTML
    # http://php.net/manual/en/domdocument.loadhtml.php#95251
    @$tmpDoc->loadHTML( '<?xml encoding="UTF-8">' . $url );
    foreach ( $tmpDoc->childNodes as $item ) {
        if ( $item->nodeType == XML_PI_NODE ) {
            $tmpDoc->removeChild( $item );// remove hack
        }
    }
    $tmpDoc->encoding = 'UTF-8'; // insert proper
    
    $body = $tmpDoc->getElementsByTagName( 'body' );
    
    if ( ! $body->length ) {
        return null;
    }
    
    $nodes = $body->item( 0 )->childNodes;
    
    if ( empty( $nodes ) ) {
        return null;
    }
    return getVideoThumbnail($nodes->item( 0 )->getAttribute( 'src' ));
    //return $nodes->item( 0 )->getAttribute( 'src' );
}

function getVideoThumbnail($vimeo_src){
  if($vimeo_src){
    if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $vimeo_src, $output_array)) {
        return $output_array[5];
    }
  }
}

function getVimeoVideoThumbnailByVideoId( $id = '', $thumbType = 'medium' ) {

  $id = trim( $id );

  if ( $id == '' ) {
      return FALSE;
  }

  $apiData = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$id.php" ) );

  if ( is_array( $apiData ) && count( $apiData ) > 0 ) {

      $videoInfo = $apiData[ 0 ];

      switch ( $thumbType ) {
          case 'small':
              return $videoInfo[ 'thumbnail_small' ];
              break;
          case 'large':
              return $videoInfo[ 'thumbnail_large' ];
              break;
          case 'medium':
              return $videoInfo[ 'thumbnail_medium' ];
          default:
              break;
      }

  }

  return false;

}

/* popular posts */
function wpb_set_post_views($postID) {
  $count_key = 'wpb_post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
  }else{
      $count++;
      update_post_meta($postID, $count_key, $count);
  }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function wpb_track_post_views ($post_id) {
  if ( !is_single() ) return;
  if ( empty ( $post_id) ) {
      global $post;
      $post_id = $post->ID; 
      if(get_post_type($post_id)=='tribe_events'){
        wpb_set_post_views($post_id);
      }  
  }
}
add_action( 'wp_head', 'wpb_track_post_views');


add_filter( 'posts_where', 'qirolab_posts_where', 10, 2 );
function qirolab_posts_where( $where, &$wp_query )
{
    global $wpdb;
    if ( $title = $wp_query->get( 'search_title' ) ) {
        $where .= " AND " . $wpdb->posts . ".post_title LIKE '" . esc_sql( $wpdb->esc_like( $title ) ) . "%'";
    }
    return $where;
}


add_action( 'wp_ajax_dynamic_fetch_video', 'dynamic_fetch_video_callback' );
add_action( 'wp_ajax_nopriv_dynamic_fetch_video', 'dynamic_fetch_video_callback' );
function dynamic_fetch_video_callback()
{
  $return_array = array();
  if(isset($_POST['video_id']) && $_POST['video_id']!='')
  {
    $video_id = $_POST['video_id'];
    $post_id = $_POST['post_id'];
    $serialize_data = get_post_meta($video_id,"_fusion",true);
		//echo $serialize_data['video'];
    $text="https://player.vimeo.com/video/809824268";
    $return_array['msg'] = 1;
    //$return_array['video_iframe'] = $serialize_data['video'];
    $return_array['video_iframe'] = $serialize_data['video'].'<div class="video_heading"><div class="video_title">'.'<span class="p_title">'.get_the_title($post_id).'</span>'.'<span class="v_title">'.get_the_title($video_id).'</span>'.'</div>'.'<div class="share">'.share_btn($video_id,$text).'</div></div>';
    echo json_encode($return_array);
  }
  die();
}

add_action( 'wp_ajax_dynamic_load_watch_videos_for_post', 'dynamic_load_watch_videos_for_post_callback' );
add_action( 'wp_ajax_nopriv_dynamic_load_watch_videos_for_post', 'dynamic_load_watch_videos_for_post_callback' );
function dynamic_load_watch_videos_for_post_callback()
{
  $return_array = array();
  if(isset($_POST['curr_post_id']) && $_POST['curr_post_id']!='')
  {
    $post_id = $_POST['curr_post_id'];
    $inx = 0;
    if( have_rows('episode_list',$post_id) ){
      while ( have_rows('episode_list',$post_id) ) : the_row();
        $video_object =  get_sub_field_object('video_name');
        // echo "<pre>";print_r($video_object);echo "</pre>";
        $video_id = $video_object['value']->ID;
        $text="https://player.vimeo.com/video/809824268";
        if($video_object['value']){
          $serialize_data = get_post_meta($video_object['value']->ID,"_fusion",true);
          $return_array['msg'][$inx] = 1;
          //$return_array['video_iframe'][$inx] = $serialize_data['video'];
          $return_array['video_iframe'][$inx] = $serialize_data['video'].'<div class="video_heading"><div class="video_title">'.'<span class="p_title">'.get_the_title($post_id).'</span>'.'<span class="v_title">'.get_the_title($video_id).'</span>'.'</div>'.'<div class="share">'.share_btn($video_id,$text).'</div></div>';
        }
        $inx++;
      endwhile;

      echo json_encode($return_array);
    } 
    else
    {
        $return_array['msg'] = 0;
        echo json_encode($return_array);
    }
    
  }
  die();
}

function share_btn($id,$text)
{

ob_start();
  ?>
  <ul>
  <li class="social fb"><a href="https://facebook.com" target="_blank" rel="noopener"><span><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
  <li class="social tw"><a href="https://twitter.com" target="_blank" rel="noopener"><span><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
  <li class="social in"><a href="https://linkedin.com" target="_blank" rel="noopener"><span><i class="fa fa-linkedin" aria-hidden="true"></i></span></a></li>
  <li class="social pi"><a href="https://pinterest.com" target="_blank" rel="noopener"><span><i class="fa fa-pinterest-p" aria-hidden="true"></i></span></a></li>
  <li class="social env"><a href="mailto:?subject=Share now&amp;body=This is text" target="_blank" rel="noopener"><span><i class="fa fa-envelope" aria-hidden="true"></i></span></a></li>
  </ul>
  <?php
  //return $btn_body;
  return ob_get_clean();
}


function get_vimeo_data_from_id( $video_id, $data ) {
	$request = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $video_id );
	$response = wp_remote_retrieve_body( $request );
	$video_array = json_decode( $response, true );
	return $video_array[$data];
}




