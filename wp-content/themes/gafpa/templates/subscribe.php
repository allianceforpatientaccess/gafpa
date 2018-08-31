<?php
/*
Template Name: Subscribe
*/

// remove the "subscribe" button in the footer
$isSubscribe = true;

/* FLEXIBLE CONTENT */
if( have_rows('fc_panels') ):
   while ( have_rows('fc_panels') ) : the_row();
      if( get_row_layout() == 'fc_hero' ):
         get_template_part('templates/partials/fc', 'hero');
      elseif( get_row_layout() == 'fc_list' ):
         get_template_part('templates/partials/fc', 'list');
      elseif( get_row_layout() == 'fc_page_title' ):
         get_template_part('templates/partials/fc', 'page-title');
      elseif( get_row_layout() == 'fc_slider' ):
         get_template_part('templates/partials/fc', 'slider');
      elseif( get_row_layout() == 'fc_two_up' ):
         get_template_part('templates/partials/fc', 'two-up');
      elseif( get_row_layout() == 'fc_heading' ):
         get_template_part('templates/partials/fc', 'heading');
      endif;
      endwhile;
endif;

/* STATIC CONTENT */
if (strpos(get_permalink($post->ID), 'event') !== false) :
   get_template_part('templates/partials/sc', 'event-list');
endif;

?>
