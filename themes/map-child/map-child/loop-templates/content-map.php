<?php
/**
 * Map query
 * 
 * 
 * @package understrap
 */

?>

<?php $args = array('post_type' => 'content',
					'post_status' => 'publish',
					'no_found_rows' => true, // counts posts, remove if pagination required
					'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
					'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
					'posts_per_page' => 200
   					); query_posts( $args );?>
<?php echo GeoMashup::map(); ?>
<?php wp_reset_query(); ?>