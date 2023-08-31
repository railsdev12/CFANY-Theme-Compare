<?php

// Make speaker consent form date field read only. event title read only
add_filter( 'gform_pre_render_118', 'add_readonly_script' );
add_filter( 'gform_pre_render_102', 'add_readonly_script' );
function add_readonly_script( $form ) {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            /* apply only to a input with a class of gf_readonly */
            jQuery("li.gf_readonly input").attr("readonly","readonly");
        });
    </script>
    <?php
    return $form;
}