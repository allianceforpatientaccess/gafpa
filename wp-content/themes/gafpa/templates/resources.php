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
   // the static part of the taxonomy queries
   $tax_query_slug                  =  array(
                                          'taxonomy'  => 'attachment_tag',
                                          'field'     => 'slug',
                                          'operator'  => 'AND',
                                       );
   // the static "resources" query
   $resources_tax_query             =  array(
                                          'taxonomy'  => 'attachment_category',
                                          'field'     => 'slug',
                                          'terms'     => 'resources',
                                       );

   // Europe tax arrays
   $europe_posters_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'europe', 'poster' ) ) );
   $europe_reports_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'europe', 'report' ) ) );
   $europe_fastfacts_tax_query      =  array_merge( $tax_query_slug, array( 'terms' => array( 'europe', 'fast-facts' ) ) );
   $europe_policypapers_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'europe', 'policy-papers' ) ) );
   $europe_infographics_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'europe', 'infographics' ) ) );

   // Latin America tax arrays
   $latin_america_posters_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'latin-america', 'poster' ) ) );
   $latin_america_reports_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'latin-america', 'report' ) ) );
   $latin_america_fastfacts_tax_query      =  array_merge( $tax_query_slug, array( 'terms' => array( 'latin-america', 'fast-facts' ) ) );
   $latin_america_policypapers_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'latin-america', 'policy-papers' ) ) );
   $latin_america_infographics_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'latin-america', 'infographics' ) ) );

   // International tax arrays
   $international_posters_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'international', 'poster' ) ) );
   $international_reports_tax_query        =  array_merge( $tax_query_slug, array( 'terms' => array( 'international', 'report' ) ) );
   $international_fastfacts_tax_query      =  array_merge( $tax_query_slug, array( 'terms' => array( 'international', 'fast-facts' ) ) );
   $international_policypapers_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'international', 'policy-papers' ) ) );
   $international_infographics_tax_query   =  array_merge( $tax_query_slug, array( 'terms' => array( 'international', 'infographics' ) ) );

   // ARGUMENT ARRAYS
   // the static part of the WP_Query argument arrays
   $arg_array_slug = array(
                        'post_type'       => 'attachment',  // media queries
                        'posts_per_page'  => -1,            // all posts
                        'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
                     );

   // Europe arg arrays
   $europe_posters      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $europe_posters_tax_query ) ) );
   $europe_reports      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $europe_reports_tax_query ) ) );
   $europe_fastfacts    = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $europe_fastfacts_tax_query ) ) );
   $europe_policypapers = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $europe_policypapers_tax_query ) ) );
   $europe_infographics = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $europe_infographics_tax_query ) ) );

   // Latin America arg arrays
   $latin_america_posters      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $latin_america_posters_tax_query ) ) );
   $latin_america_reports      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $latin_america_reports_tax_query ) ) );
   $latin_america_fastfacts    = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $latin_america_fastfacts_tax_query ) ) );
   $latin_america_policypapers = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $latin_america_policypapers_tax_query ) ) );
   $latin_america_infographics = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $latin_america_infographics_tax_query ) ) );

   // International arg arrays
   $international_posters      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $international_posters_tax_query ) ) );
   $international_reports      = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $international_reports_tax_query ) ) );
   $international_fastfacts    = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $international_fastfacts_tax_query ) ) );
   $international_policypapers = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $international_policypapers_tax_query ) ) );
   $international_infographics = array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $international_infographics_tax_query ) ) );

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
   $regionCount = 0; // print the region every 5 cycles (1 cycle of the media array)

   foreach ($queries as $query) :

      if ($count % 5 == 0) : ?>
         <h2 class="region"><?php echo $region[$regionCount]; ?></h2>
         <?php $regionCount++;
      endif;
      
      if ($query->have_posts()) : ?>
         <h3><?php echo $media[$count % 5]; ?></h3>
      <?php endif;

      $count++;

      while ($query->have_posts()) :
         $query->the_post() ?>
         <p><a style="text-align: center;" href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></p>
      <?php endwhile;
   endforeach;

   wp_reset_postdata();

   /* STATIC CONTENT */
   if (strpos(get_permalink($post->ID), 'event') !== false) :
      get_template_part('templates/partials/sc', 'event-list');
   endif;
?>