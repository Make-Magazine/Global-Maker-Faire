<?php
/* 
 * Static block users can turn on or off
 */
   if (block_field('activeinactive', false) == 'show') {
?>
	<script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
	
	<section class="newsletter-panel">
		<div class="container">
			<!-- Mailchimp form - default for now -->
			<form class="form-inline sub-form" id="subscribe-form" name="subscribe-form" action="https://makermedia.us9.list-manage.com/subscribe/post?u=4e536d5744e71c0af50c0678c&amp;id=64d256630b" method="post" target="_blank">
				<input style="display:none" type="checkbox" value="1" name="group[926889][1]" id="mce-group[926889]-926889-0" checked>
				<div class="row row-eq-height">
					<div class="col-xs-12 col-sm-6">
            		<p><strong>Stay in Touch with the Make: Community</strong></p>
          		</div>	
					<div class="col-xs-12 col-sm-6 align-middle">
						<div class="row row-eq-height" style="width:100%">
							<div class="input-container">
								<input id="EMAIL" class="form-control nl-panel-input" name="EMAIL" placeholder="Email" required type="email" />
								<span class="error-message hidden">Please enter a valid email</span>
							</div>
							<div class="input-container">
								<input id="FNAME" class="form-control nl-panel-input" name="FNAME" placeholder="First Name" required type="text" />
								<span class="error-message hidden">Please enter your first name</span>
							</div>
							<div class="input-container">
								<input id="LNAME" class="form-control nl-panel-input" name="LNAME" placeholder="Last Name" required type="text" />
								<span class="error-message hidden">Please enter your last name</span>
							</div>
							<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4e536d5744e71c0af50c0678c_609e43360a" tabindex="-1" value=""></div>
							<input class="form-control btn-w-ghost" name="subscribe-button" id="subscribe-button" value="Go" type="submit" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

 <div class="fancybox-thx" style="display:none;">
	<div class="col-sm-4 hidden-xs nl-modal">
	  <span class="fa-stack fa-4x">
	  <i class="fa fa-circle-thin fa-stack-2x"></i>
	  <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
	  </span>
	</div>
	<div class="col-sm-8 col-xs-12 nl-modal">
	  <h3 sty;e="text-algin:center;">Awesome!</h3>
	  <p>Thanks for signing up.</p>
	</div>
	<div class="clearfix"></div>
 </div>

 <div class="nl-modal-error" style="display:none;">
	  <div class="col-xs-12 nl-modal padtop">
			<p class="lead">The reCAPTCHA box was not checked. Please try again.</p>
	  </div>
	  <div class="clearfix"></div>
 </div>

 <script>
// Newsletter code
// When you submit a newsletter
jQuery(document).ready(function(){
	jQuery("#subscribe-form").submit(function( event ) {
		var email = jQuery('#EMAIL').val();
		var fname = jQuery('#FNAME').val();
		var lname = jQuery('#LNAME').val();
		if(!email || !fname || !lname) {
			jQuery("#EMAIL").next().removeClass('hidden');
			jQuery("#FNAME").next().removeClass('hidden');
			jQuery("#LNAME").next().removeClass('hidden');
			return;
		} else {
			jQuery.post('https://makermedia.us9.list-manage.com/subscribe/post?u=4e536d5744e71c0af50c0678c&amp;id=64d256630b', jQuery('#subscribe-form').serialize());
			jQuery("#EMAIL").next().addClass('hidden');
			jQuery("#FNAME").next().addClass('hidden');
			jQuery("#LNAME").next().addClass('hidden');
			jQuery("#EMAIL").val("");
			jQuery("#FNAME").val("");
			jQuery("#LNAME").val("");
			jQuery('.fancybox-thx').trigger('click');
		}
		event.preventDefault();
	});
});
 </script>


<?php
	}
?>