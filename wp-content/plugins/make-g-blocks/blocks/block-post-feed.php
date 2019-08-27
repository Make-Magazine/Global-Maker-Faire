<?php
/* 
 * Pulls in a feed of most recent posts / news
 */
   $post_feed_quantity = block_field('post-quantity', false);
   $args = array(
       'numberposts' => $post_feed_quantity,
       'post_status' => 'publish'
   );
   $recent_posts = wp_get_recent_posts($args);

   // Get the blog template page ID
   $news_pages = get_pages(array(
       'meta_key' => '_wp_page_template',
       'meta_value' => 'blog.php'
   ));
   foreach ($news_pages as $news_page) {
      $news_ID = $news_page->ID;
   }
   if (isset($news_ID)) {
      $news_slug = get_post($news_ID)->post_name;
   }
   if (block_field('activeinactive', false) == "show") {
?>

<section class="recent-post-panel"><div class="container">
		<div class="row padbottom text-center">
      	<img class="robot-head" src="<?php echo(get_bloginfo("template_directory")); ?>'/img/news-icon.png" alt="News icon" />
			<div class="title-w-border-r">
			  <h2><?php block_field('title'); ?></h2>
			</div>
      </div>
		<div class="row">
			<?php foreach ($recent_posts as $recent) { ?>
      		<div class="recent-post-post col-xs-12 col-sm-3">
            	<article class="recent-post-inner">
              		<a href="<?php echo(get_permalink($recent["ID"])); ?>">
						<?php
							if (get_the_post_thumbnail($recent['ID']) != '') {
								$thumb_id = get_post_thumbnail_id($recent['ID']);
								$url = wp_get_attachment_url($thumb_id);
								$args = array(
									 'resize' => '300,300',
									 'quality' => '80',
									 'strip' => 'all'
								);
								$photon = jetpack_photon_url($url, $args); ?>
								<div class='recent-post-img' style='background-image: url(" . $photon . ");'></div>
							<?php
							} else {
								echo(get_first_post_image($recent));
							}
						?>
							<div class="recent-post-text">
								<h4><?php echo($recent["post_title"]); ?></h4>
								<p class="recent-post-date"><?php echo(mysql2date('M j, Y', $recent["post_date"])); ?></p>
								<p class="recent-post-descripton"><?php echo(substr(wp_strip_all_tags($recent["post_content"]), 0, 150)); ?></p>
                		</div>
              		</a>
            	</article>
          	</div>
   		<?php } // end foreach
			if (isset($news_slug)) { ?>
     			<div class="col-xs-12 padtop padbottom text-center">
            	<a class="btn btn-b-ghost" href="/<?php echo($news_slug); ?>">More News</a>
          	</div>
			<?php } ?>
      </div>
	</div>
	<div class="flag-banner"></div>
</section>
<?php } ?>