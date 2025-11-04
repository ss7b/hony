<?php
/**
 * The main template file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main id="main" class="site-main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		echo '<p>' . esc_html__( 'No content found', 'modern-fse-theme' ) . '</p>';
	}
	?>
</main>

<?php
get_footer();