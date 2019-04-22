<?php /*Template Name: Europe*/ ?>

<!-- EAfPA logo -->
<style>
	.navbar-brand {
		height: 150px;
		width: 150px;

		display: block;
		background: url(http://gafpa.staging.wpengine.com/wp-content/uploads/EAfPA-logo.png) no-repeat;
		background-size: 150px;
		overflow: hidden;
	}

	.navbar-brand > img:nth-child(1) {
		margin-left: -150px;
	}
</style>
<!-- /EAfPA logo -->

<?php set_query_var( 'region', 'europe' ); // pass this variable & value to the called template part
get_template_part( 'templates/resources' ); ?>