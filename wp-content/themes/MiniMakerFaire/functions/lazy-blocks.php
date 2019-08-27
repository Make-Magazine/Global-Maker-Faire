<?php
// this could potentially be split up into files per block like we had for make g blocks, with the main part part of the make-g-blocks plugin again

// filter for Frontend output.
add_filter( 'lazyblock/featured-makers/frontend_callback', 'featured_makers', 10, 2 );
// filter for Editor output.
add_filter( 'lazyblock/featured-makers/editor_callback', 'featured_makers', 10, 2 );

if ( ! function_exists( 'featured_makers' ) ) {
    function featured_makers( $output, $attributes ) {
	   if($attributes['activeinactive'] == "show") {
        ob_start();
        ?>

        <section class="featured-maker-panel<?php echo($attributes["background_color"] == "Red" ? ' red-back' : ''); ?>">
				<div class="container-fluid">
				  <?php if ( $attributes["title"]) { ?>
						<div class="row text-center">
						  <div class="title-w-border-y">
							 <h2><?php echo($attributes["title"]); ?></h2>
						  </div>
						</div>
				  <?php } ?>

						<div class="row padbottom">
							<?php
								foreach ($attributes["featured_makers"] as $maker) {
									if (!empty($maker['maker_url'])) {
							?>
							<a href="<?php echo($maker['maker_url']); ?>">
							<?php } ?>
								<div class="featured-maker col-xs-6 col-sm-3">
									<div class="maker-img" style="background-image: url('<?php echo($maker['maker_image']['url']); ?>');"></div>
									<div class="maker-panel-text">
										<h4><?php echo($maker['name']); ?></h4>
										<p class="hidden-xs"><?php echo($maker['desc']); ?></p>
									</div>
								</div>
							<?php 
									if (!empty($maker['maker_url'])) {
							?>
							</a>
							<?php }
								} // end foreach loop
							?>
						</div>
				  <?php if ($attributes["more_makers_button"]) { ?>
						<div class="row padbottom">
							<div class="col-xs-12 padbottom text-center">
							  <a class="btn btn-b-ghost" href="<?php echo(attributes["more_makers_button"]); ?>">More Makers</a>
							</div>
						 </div>
				  <?php } ?>
			</div>
			<div class="flag-banner"></div>
		</section>

        <?php
        return ob_get_clean();
		}
    }
}
?>