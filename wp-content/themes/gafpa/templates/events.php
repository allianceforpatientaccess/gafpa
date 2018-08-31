<?php
/*
Template Name: Events
*/

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
endif; ?>

<?php /* STATIC CONTENT */
if (strpos(get_permalink($post->ID), 'event') !== false) :
   get_template_part('templates/partials/sc', 'event-list');
endif;

?>

<section id="split-page-main">

      <div id="split-page-container" class="search-page">

         <!-- article -->
         <?php while ( have_posts()) : the_post(); ?>
            <?php the_content(); ?>
         <?php endwhile; ?>
         <!-- /article -->

         <h1 class="page-header" style="padding: 0;">Event Archive</h1>

         <?php
            $catObj = get_category_by_slug('events'); 
            $catId = $catObj->term_id;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
               'cat' => $catId,
               'paged' => $paged
            );

            $wp_query = new WP_Query($args);
            get_template_part('loop');
            get_template_part('pagination');
         ?>

      </div>

   </section>