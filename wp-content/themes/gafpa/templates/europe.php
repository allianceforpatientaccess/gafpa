<?php /*Template Name: Europe*/ ?>
	<!-- EAfPA logo -->
	<style>
		.navbar-brand > img:nth-child(1) {
			display: block;
  		box-sizing: border-box;

			background: url(http://gafpa.staging.wpengine.com/wp-content/uploads/EAfPA-logo.png) no-repeat;
			background-size: 100px;
			padding-left: 100px;
		}
	</style>

	<?php set_query_var( 'region', 'europe' ); // pass this variable & value to the called template part
	get_template_part( 'templates/resources' ); 
?>