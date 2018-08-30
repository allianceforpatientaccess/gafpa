<?php
   $color_style = get_sub_field('color_style');
   $padding_top = get_sub_field('padding_top') . 'px';
   $padding_bottom = get_sub_field('padding_bottom') . 'px';
   $captions = get_sub_field('captions');
   $slider_size = get_sub_field('slider_size');
   $infinite = get_sub_field('infinite');
   $alignment = get_sub_field('alignment');
   $image_padding = get_sub_field('image_padding');
?>

<div class="fc-slider container-fluid color-style-<?php echo $color_style ?>" style="padding-top:<?php echo $padding_top ?>; padding-bottom:<?php echo $padding_bottom ?>;">
   <?php include('color-style-dropdown.php'); ?>
      <div class="slick-slider <?php echo $slider_size . ' ' . $captions . ' image-padding-' . $image_padding ?>" alignment="<?php echo $alignment ?>" infinite="<?php echo $infinite ?>">
         <?php
         if( have_rows('images') ):
            while ( have_rows('images') ) : the_row();
            $image = get_sub_field('image');
            $link = get_sub_field('link');
            ?>
               <div>
                  <?php if($link) { echo "<a href='$link'>"; } ?>
                  <img class="slick-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                  <?php
                     if($image['caption']):
                  ?>
                     <p class="slick-caption <?php echo 'center-' . $alignment ?>"><?php echo $image['caption']; ?></p>
                  <?php
                     endif;
                  ?>
                  <?php if($link) { echo "</a>"; } ?>
               </div>
         <?php
            endwhile;
         endif;
         ?>
      </div>
</div>
