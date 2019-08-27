<?php
/* 
 * Pulls in the list of sponsors, automagically
 */
$sponsor_ID = 0;
// Get the sponsors template page ID
$sponsor_pages = get_pages(array(
	 'meta_key' => '_wp_page_template',
	 'meta_value' => 'page-sponsors.php'
));

foreach ($sponsor_pages as $sponsor_page) {
	$sponsor_ID = $sponsor_page->ID;
}

// check if the nested repeater field has rows of data and the sponsor block is active
if (have_rows('sponsors', $sponsor_ID) && block_field('activeinactive', false) == "show") {
?>
    <section class="sponsor-slide">
      <div class="container">
        <div class="row sponsor_panel_title">
          <div class="col-xs-12 text-center">
            <div class="title-w-border-r">
              <h2 class="sponsor-slide-title"><?php block_field('title-sponsor-panel'); ?></h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
		<?php
      // loop through the rows of data
      while (have_rows('sponsors', $sponsor_ID)) {
         the_row();
         $sponsor_group_title = get_sub_field('sponsor_group_title'); // Sponsor group title

         if (get_row_layout() == 'sponsors_with_image') {
            $sub_field_3 = get_sub_field('sponsors_image_size'); // size option
            // check if the nested repeater field has rows of data
            if (have_rows('sponsors_with_image')) {
               ?>
					 <div class="item">
						<div class="row spnosors-row">
						  <div class="col-xs-12">
						<?php
						  if (!empty($sponsor_group_title)) { ?>
							  <h5 class="text-center sponsors-type"><?php echo($sponsor_group_title); ?></h5>
						<?php } ?>
							  <div class="faire-sponsors-box">
						<?php
							// loop through the rows of data
							while (have_rows('sponsors_with_image')) {
								the_row();

								$sub_field_1 = get_sub_field('image'); // Photo
								$sub_field_2 = get_sub_field('url'); // URL
								$args = array(
									 'w' => '300',
									 'quality' => '80',
									 'strip' => 'all'
								);
								$photon = jetpack_photon_url($sub_field_1['url'], $args);
						 ?>
									<div class="<?php echo $sub_field_3; ?>">
									<?php if ($sub_field_2) { ?>
									  <a href="<?php echo $sub_field_2; ?>" target="_blank">';
									<?php } ?>
										<img src="<?php echo $photon; ?>" alt="Maker Faire sponsor logo" class="img-responsive" />
									<?php if ($sub_field_2) { ?>
									  </a>
									<?php } ?>
									</div>
						  <?php } // end sponsors with image while loop ?>

								</div>
						  </div>
						</div>
					 </div>
		   <?php
            } // end if have_rows(image)
         } // end row layout
      } // end sponsors while loop
	   ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row sponsor_panel_bottom">
          <div class="col-xs-12 text-center">
            <p><?php if (block_field('become-a-sponsor-button', false)) { ?>
              <a href="<?php block_field('become-a-sponsor-button'); ?>">Become a Sponsor</a><span>&bull;</span> <?php } ?>
              <a href="/sponsors">All Sponsors</a>
            </p>
          </div>
        </div>
      </div>
    </section>
    <script>
      jQuery(".sponsor-slide .carousel-inner .item:first-child").addClass("active");
      jQuery(function() {
        var title = jQuery(".item.active .sponsors-type").html();
      });
    </script>
<?php 
} 
?>