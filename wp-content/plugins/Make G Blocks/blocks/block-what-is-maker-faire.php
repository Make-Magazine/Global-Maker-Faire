<?php
/* 
 * Static block users can turn on or off
 */
   if (block_field('show_what_is_maker_faire', false) == 'show') {
?>
		<section class="what-is-maker-faire">
            <div class="container">
              <div class="row text-center">
                <div class="title-w-border-y">
                  <h2>What is Maker Faire?</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <p class="text-center">Maker Faire is a gathering of fascinating, curious people who enjoy learning and who love sharing what they can do. From engineers to artists to scientists to crafters, Maker Faire is a venue for these "makers" to show hobbies, experiments, projects.</p>
                  <p class="text-center">We call it the Greatest Show (&amp; Tell) on Earth - a family-friendly showcase of invention, creativity, and resourcefulness.</p>
						<p class="text-center">Glimpse the future and get inspired!</p>
                 </div>
              </div>
            </div>
            <div class="wimf-border">
              <div class="wimf-triangle"></div>
            </div>
            <img src="<?php echo(get_bloginfo('template_directory')); ?>/img/makey.png" alt="Maker Faire information Makey icon" />
          </section>
<?php
	}
?>