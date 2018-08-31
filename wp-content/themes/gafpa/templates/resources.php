<?php /* Template Name: Resources */

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
   $resources_tax_query             =  array(
                                          'taxonomy'  => 'attachment_category',
                                          'field'     => 'slug',
                                          'terms'     => 'resources',
                                       );

   // Europe tax arrays
   $europe_posters_tax_query        =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'terms'     => array( 'europe', 'poster' ),
                                          'operator'  => 'AND',
                                       );
   $europe_reports_tax_query        =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'terms'     => array( 'europe', 'report' ),
                                          'operator'  => 'AND',
                                       );
   $europe_fastfacts_tax_query      =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'terms'     => array( 'europe', 'fast-facts' ),
                                          'operator'  => 'AND',
                                       );
   $europe_policypapers_tax_query   =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'terms'     => array( 'europe', 'policy-papers' ),
                                          'operator'  => 'AND',
                                       );
   $europe_infographics_tax_query   =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'terms'     => array( 'europe', 'infographics' ),
                                          'operator'  => 'AND',
                                       );

   // Latin America tax arrays
   $latin_america_posters_tax_query       =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'latin-america', 'poster' ),
                                                'operator'  => 'AND',
                                             );
   $latin_america_reports_tax_query       =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'latin-america', 'report' ),
                                                'operator'  => 'AND',
                                             );
   $latin_america_fastfacts_tax_query     =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'latin-america', 'fast-facts' ),
                                                'operator'  => 'AND',
                                             );
   $latin_america_policypapers_tax_query  =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'latin-america', 'policy-papers' ),
                                                'operator'  => 'AND',
                                             );
   $latin_america_infographics_tax_query  =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'latin-america', 'infographics' ),
                                                'operator'  => 'AND',
                                             );

   // International tax arrays
   $international_posters_tax_query       =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'international', 'poster' ),
                                                'operator'  => 'AND',
                                             );
   $international_reports_tax_query       =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'international', 'report' ),
                                                'operator'  => 'AND',
                                             );
   $international_fastfacts_tax_query     =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'international', 'fast-facts' ),
                                                'operator'  => 'AND',
                                             );
   $international_policypapers_tax_query  =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'international', 'policy-papers' ),
                                                'operator'  => 'AND',
                                             );
   $international_infographics_tax_query  =  array(
                                                'taxonomy'  => 'attachment_tag',
                                                'field'     => 'slug',
                                                'terms'     => array( 'international', 'infographics' ),
                                                'operator'  => 'AND',
                                             );

   // ARGUMENT ARRAYS
   // Europe arg arrays
   $europe_posters      =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit', // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $europe_posters_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $europe_reports      =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $europe_reports_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $europe_fastfacts    =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $europe_fastfacts_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $europe_policypapers =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $europe_policypapers_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $europe_infographics =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $europe_infographics_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );

   // Latin America arg arrays
   $latin_america_posters     =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $latin_america_posters_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $latin_america_reports      =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $latin_america_reports_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $latin_america_fastfacts    =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $latin_america_fastfacts_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $latin_america_policypapers =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $latin_america_policypapers_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $latin_america_infographics =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $latin_america_infographics_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );

   // International arg arrays
   $international_posters      =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $international_posters_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $international_reports      =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $international_reports_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $international_fastfacts    =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $international_fastfacts_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $international_policypapers =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $international_policypapers_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );
   $international_infographics =  array(
                              'post_type'       => 'attachment',
                              'post_status'     => 'inherit',
                              'tax_query'       => array(
                                                      $resources_tax_query,
                                                      $international_infographics_tax_query,
                                                   ),
                              'posts_per_page'  => -1,        // all posts
                           );


   // QUERY OBJECTS
   $europe_posters_query = new WP_Query($europe_posters);
   $europe_reports_query = new WP_Query($europe_reports);
   $europe_fastfacts_query = new WP_Query($europe_fastfacts);
   $europe_policypapers_query = new WP_Query($europe_policypapers);
   $europe_infographics_query = new WP_Query($europe_infographics);

   $latin_america_posters_query = new WP_Query($latin_america_posters);
   $latin_america_reports_query = new WP_Query($latin_america_reports);
   $latin_america_fastfacts_query = new WP_Query($latin_america_fastfacts);
   $latin_america_policypapers_query = new WP_Query($latin_america_policypapers);
   $latin_america_infographics_query = new WP_Query($latin_america_infographics);

   $international_posters_query = new WP_Query($international_posters);
   $international_reports_query = new WP_Query($international_reports);
   $international_fastfacts_query = new WP_Query($international_fastfacts);
   $international_policypapers_query = new WP_Query($international_policypapers);
   $international_infographics_query = new WP_Query($international_infographics);

   $queries = array(
      $europe_posters_query,
      $europe_reports_query,
      $europe_fastfacts_query,
      $europe_policypapers_query,
      $europe_infographics_query,
      $latin_america_posters_query,
      $latin_america_reports_query,
      $latin_america_fastfacts_query,
      $latin_america_policypapers_query,
      $latin_america_infographics_query,
      $international_posters_query,
      $international_reports_query,
      $international_fastfacts_query,
      $international_policypapers_query,
      $international_infographics_query,
   );

   foreach ($queries as $query) :
      
      if ($query->have_posts()) {
         
      }

      while ($query->have_posts()) : $query->the_post();
?>
         <a style="text-align: center;" href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
<?php
      endwhile;
   endforeach;

   wp_reset_postdata();

   /* STATIC CONTENT */
   if (strpos(get_permalink($post->ID), 'event') !== false) :
      get_template_part('templates/partials/sc', 'event-list');
   endif;
?>