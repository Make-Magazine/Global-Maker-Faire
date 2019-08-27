<?php
/* 
 * Pulls in a list of makers dynamically, based on the form id
 */
   if (block_field('activeinactive', false) == 'show') {
		
		$makers_to_show = block_field('makers-to-show', false);
   	$background_color = block_field('background-color', false);
		
		// build makers array
		$makerArr = array();
		$formid = (int) block_field('enter-formid-here', false);

		$search_criteria['status'] = 'active';
		$search_criteria['field_filters'][] = array(
			 'key' => '303',
			 'value' => 'Accepted'
		);
		$search_criteria['field_filters'][] = array(
			 'key' => '304',
			 'value' => 'Featured Maker'
		);

		$entries = GFAPI::get_entries($formid, $search_criteria, null, array('offset' => 0,'page_size' => 999));

		// # Check for No data allow for pull accepted
		$pullAccepted = block_field('pull-accepted', false);
		if (empty($entries) && $pullAccepted) {
			// # Reset Criteria
			$search_criteria['field_filters'] = array();
			// # Only want the accepted ones
			$search_criteria['field_filters'][] = array(
				 'key' => '303',
				 'value' => 'Accepted'
			);
			// # Re-Run Entries
			$entries = GFAPI::get_entries($formid, $search_criteria, null, array('offset' => 0,'page_size' => 999));
		}

		// randomly order entries
		shuffle($entries);
		foreach ($entries as $entry) {
			$url = $entry['22'];
			$args = array(
				 'resize' => '300,300',
				 'quality' => '80',
				 'strip' => 'all'
			);
			$photon = jetpack_photon_url($url, $args);

			$makerArr[] = array(
				 'image'     => $photon,
				 'name'      => $entry['151'],
				 'desc'      => $entry['16'],
				 'maker_url' => '/maker/entry/' . $entry['id']
			);
		}

		// limit the number returned to $makers_to_show
		$makerArr = array_slice($makerArr, 0, $makers_to_show);
?>
   <section class="featured-maker-panel<?php echo($background_color == "Red" ? ' red-back' : ''); ?>">
      <div class="container">
		  <?php if ( block_field('title', false) ) { ?>
            <div class="row text-center">
              <div class="title-w-border-y">
                <h2><?php block_field('title') ?></h2>
              </div>
            </div>
        <?php } ?>

            <div class="row padbottom">
            	<?php
		            foreach ($makerArr as $maker) {
      					if (!empty($maker['maker_url'])) {
					?>
					<a href="<?php echo($maker['maker_url']); ?>">
					<?php } ?>
						<div class="featured-maker col-xs-6 col-sm-3">
            			<div class="maker-img" style="background-image: url('<?php echo($maker['image']); ?>');"></div>
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
        <?php if (block_field('more_makers_button', false)) { ?>
				<div class="row padbottom">
					<div class="col-xs-12 padbottom text-center">
					  <a class="btn btn-b-ghost" href="<?php block_field('more-makers-button'); ?>">More Makers</a>
					</div>
				 </div>
   	  <?php } ?>
   </div>
	<div class="flag-banner"></div></section>
<?php } ?>