<div class="container-fluid page-title">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1>GAfPA Blog</h1>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid blog-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="blog-title">The GAfPA Patient Advocacy Blog</h1>
         </div>
      </div>
   </div>
	<div class="container">
		<div class="row">
			<div class="col-md-9 blog-main">
				<?php if (!have_posts()) : ?>
				  <div class="alert alert-warning">
				    <?php _e('Sorry, no results were found.', 'roots'); ?>
				  </div>
				<?php endif; ?>

				<?php while (have_posts()) : the_post(); ?>
               <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
            <?php endwhile; ?>
				<?php the_posts_navigation(); ?>
			</div> <!-- /.blog-main -->
			<div class="col-md-3 blog-sidebar">
            <?php dynamic_sidebar('sidebar-primary'); ?>
			</div> <!-- /.blog-sidebar -->
		</div>
	</div> <!-- /.container -->
</div>
