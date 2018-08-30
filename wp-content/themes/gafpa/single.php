<div class="container-fluid blog-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-9 blog-main">
				<?php get_template_part('templates/content', 'single'); ?>

			</div> <!-- /.blog-main -->
			<div class="col-md-3 blog-sidebar">
            <?php dynamic_sidebar('sidebar-primary'); ?>
			</div> <!-- /.blog-sidebar -->
		</div>
	</div> <!-- /.container -->
</div>
