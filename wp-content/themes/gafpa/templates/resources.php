<?php /* Template Name: Resources */

error_reporting(E_ALL & ~E_NOTICE); // ignore the offset notices (used in the below syntax)

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

   /* RESOURCES */

   // TAXONOMY ARRAYS
   $region_queries = array(
                        'europe',
                        'latin-america',
                        'international'
                     );

   $media_queries = array(
                        'posters',
                        'reports',
                        'fast-facts',
                        'policy-papers',
                        'infographics'
                     );

   // the static part of the taxonomy queries
   $tax_query_slug                  =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'operator'  => 'AND',
                                       );

   $tax_arrays          = array();
   $regionQueriesCount  = 0;

   // generates an array of the specific taxonomy for each query
   for ($count = 0; $count < 15; $count++) {
      array_push( $tax_arrays, array_merge( $tax_query_slug, array( 'terms' => array( $region_queries[$regionQueriesCount], $media_queries[$count % 5] ) ) ) );

      if($count % 5 == 4) {
         $regionQueriesCount++;  // only increment every 5 cycles (to cycle through each media type for each region)
      }
   }

   // ARGUMENT ARRAYS
   // the static "resources" query
   $resources_tax_query =  array(
                           'taxonomy'  => 'attachment_category',
                           'field'     => 'slug',
                           'terms'     => 'resources',
                        );

   // the static part of the WP_Query argument arrays
   $arg_array_slug = array(
                        'post_type'       => 'attachment',  // media queries
                        'posts_per_page'  => -1,            // all posts
                        'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
                     );

   $arg_arrays = array();
   $queries    = array();

   // generates an array of complete argument arrays for each query
   foreach ($tax_arrays as $tax_array) {
      array_push( $arg_arrays, array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $tax_array ) ) ) );
   }

   // generates an array of the WP_Query objects
   foreach ($arg_arrays as $args) {
      array_push( $queries, new WP_Query( $args ) );
   }

   /* PRINTING */

   $region = array(
      "Europe",
      "Latin America",
      "International",
   );

   $media = array(
      "Posters",
      "Reports",
      "Fast Facts",
      "Policy Papers",
      "Infographics",
   );

   $count = 0;       // print the corresponding header text for each query
   $regionCount = 0; // print the region every 5 cycles (1 cycle of the media array) ?>

   <section style="background: white;">
      <?php foreach ($queries as $query) :

         if ($count % 5 == 0 && $count < 15) : ?>
            <h2 style="text-align: center; color: #142945;"><?php echo $region[$regionCount]; ?></h2>
            <?php $regionCount++;
         endif;
         
         if ($query->have_posts()) : ?>
            <p style="text-align: center; font-weight: 500; color: #142945;"><?php echo $media[$count % 5]; ?></p>
         <?php endif;

         $count++;

         while ($query->have_posts()) :
            $query->the_post() ?>
            <p style="text-align: center;"><a style="color: #142945;" href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></p>
         <?php endwhile;

         wp_reset_postdata();
      endforeach; ?>
   </section>

   <?php /* STATIC CONTENT */
   if (strpos(get_permalink($post->ID), 'event') !== false) :
      get_template_part('templates/partials/sc', 'event-list');
   endif;
?>