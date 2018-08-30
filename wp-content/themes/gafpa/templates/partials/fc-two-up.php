<?php
   $color_style = get_sub_field('color_style');
   $layout_style = get_sub_field('layout_style');
   $left_side_width = get_sub_field('left_side_width');
   $left_side = get_sub_field('left_side');
   $right_side = get_sub_field('right_side');
   $padding_top = get_sub_field('padding_top') . 'px';
   $padding_bottom = get_sub_field('padding_bottom') . 'px';
   $heading_alignment = get_sub_field('heading_alignment');
   $heading_style = get_sub_field('heading_style');
   $unique_class = get_sub_field('unique_class_name');
   $unique_id = get_sub_field('unique_id');
   $background_image = get_sub_field('background_image');

   echo "<div id='$unique_id' class='fc-two-up container-fluid color-style-$color_style layout-style-$layout_style $unique_class' style='padding-top: $padding_top; padding-bottom: $padding_bottom; background-image: url($background_image); background-size:cover;'>";
   include('color-style-dropdown.php');
   echo "<div class='container'>";
?>

<?php if(get_sub_field('top_heading')) : ?>
   <div class="row">
      <div class="col-md-8 col-md-push-2">
         <h3 class="top-heading" style="text-align: center;"><?php the_sub_field('top_heading'); ?></h3>
      </div>
   </div>
<?php endif; ?>


<?php
   $side = 'left';
   if ($left_side == 'text') {
      include('fc-two-up-text-side.php');
   } else if ($left_side == 'image') {
      include('fc-two-up-image-side.php');
   }

   $side = 'right';
   if ($right_side == 'text') {
      include('fc-two-up-text-side.php');
   } else if ($right_side == 'image') {
      include('fc-two-up-image-side.php');
   }

   echo "</div>";
   echo "</div>";
?>
