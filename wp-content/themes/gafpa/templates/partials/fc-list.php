<?php
   $color_style = get_sub_field('color_style');
   $columns_large = 12 / get_sub_field('columns_large');
   $columns_desktop = 12 / get_sub_field('columns_desktop');
   $columns_tablet = 12 / get_sub_field('columns_tablet');
   $columns_phone = 12 / get_sub_field('columns_phone');
   $padding_top = get_sub_field('padding_top') . 'px';
   $padding_bottom = get_sub_field('padding_bottom') . 'px';
   $heading_alignment = get_sub_field('heading_alignment');
   $unique_class = get_sub_field('unique_class_name');
   $unique_id = get_sub_field('unique_id');
   $background_image = get_sub_field('background_image');
?>

<div id="<?= $unique_id ?>" class="<?= $unique_class ?> fc-list container-fluid color-style-<?= $color_style ?>" style="padding-top:<?= $padding_top ?>; padding-bottom:<?= $padding_bottom?>;  background-image: url(<?=$background_image?>); background-size:cover;">
<?php include('color-style-dropdown.php'); ?>
   <div class="container">
      <?php if(get_sub_field('top_heading')) : ?>
         <div class="row">
            <div class="col-md-8 col-md-push-2">
               <h3 class="heading" style="text-align: center;"><?php the_sub_field('top_heading'); ?></h3>
            </div>
         </div>
      <?php endif; ?>
         <div class="row">
            <?php
            if( have_rows('list') ):
               while ( have_rows('list') ) : the_row();
               $contentToShow = get_sub_field('content');
               $icon = get_sub_field('icon');
               $text = get_sub_field('text');
               $button = get_sub_field('button'); ?>
                  <div class="item <?= 'col-lg-' . $columns_large . ' col-md-'. $columns_desktop . ' col-sm-' . $columns_tablet . ' col-xs-' . $columns_phone?>">

                     <?php
                     error_reporting(E_ALL & ~E_WARNING); // suppress warnings for the in_array() functions below

                     $posts = get_sub_field('icon_relationship');
                     if( $posts ): ?>
                        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                           <?php setup_postdata($post); ?>
                           <?php $svg = get_field('svg'); ?>
                              <div class="icon" style="text-align: <?= $heading_alignment ?>">
                                 <?php echo file_get_contents($svg); ?>
                              </div>
                           <?php endforeach; ?>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                     <?php endif; ?>

                     <?php if(in_array('image/heading/text', $contentToShow) && $text) : ?>
                        <div class="text">
                           <?= $text ?>
                        </div>
                     <?php endif; ?>

                     <?php
                     $posts = get_sub_field('relationship');

                     if( $posts ): ?>
                         <div class="row relationship">
                         <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                             <?php setup_postdata($post); ?>
                             <div class="col-sm-4 column">
                                <?php if(get_field('start_date')) : ?>
                                    <div class="dates">
                                       <p><?php the_field('start_date'); ?> &mdash; <?php the_field('end_date'); ?></p>
                                    </div>
                                 <?php endif; ?>

                                 <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                 <?php if(get_field('excerpt')) : ?>
                                    <div class="excerpt">
                                       <?php the_field('excerpt'); ?>
                                    </div>
                                 <?php endif; ?>
                                 <h6><a href="<?php the_permalink(); ?>" class="">Learn More</a></h6>

                             </div>
                         <?php endforeach; ?>
                         </div>
                         <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                     <?php endif; ?>



                     <?php if(in_array('button', $contentToShow) && $button) : ?>
                        <div class="btn-wrapper">
                           <a style="float: <?= $heading_alignment ?>" href="<?php echo $button['url']; ?>" class="btn btn-default btn-light" <?php echo $button['target']; ?>><?php echo $button['text']; ?></a>
                        </div>
                     <?php endif; ?>
                  </div>
               <?php
               endwhile;
            endif;
            ?>
      </div>
   </div>
</div>
