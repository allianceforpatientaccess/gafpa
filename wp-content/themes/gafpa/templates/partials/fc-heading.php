<?php
   $heading = get_sub_field('heading');
   $color_style = get_sub_field('color_style');
   $heading_style = get_sub_field('heading_style');
   $heading_alignment = get_sub_field('heading_alignment');
   $padding_top = get_sub_field('padding_top') . 'px';
   $padding_bottom = get_sub_field('padding_bottom') . 'px';


   echo "<div class='fc-heading container-fluid color-style-$color_style' style='padding-top: $padding_top; padding-bottom: $padding_bottom;'>";
   include('color-style-dropdown.php');
   if($heading) {
      echo "<$heading_style class='heading' style='text-align: $heading_alignment;'>$heading</$heading_style>";
   }
   echo "</div>";
?>