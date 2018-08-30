<?php
   $columns = 6;
   $image = get_sub_field($side . '_image');
   if ($layout_style == 2 && $side == 'left') {
      $columns = $left_side_width;
   } elseif ($layout_style == 2 && $side == 'right') {
      $columns = 12 - $left_side_width;
   }
 ?>

<div class="image-side col-lg-<?php echo $columns ?> col-md-<?php echo $columns ?>">
   <img class="img-responsive" src="<?php echo $image ?>">
</div>