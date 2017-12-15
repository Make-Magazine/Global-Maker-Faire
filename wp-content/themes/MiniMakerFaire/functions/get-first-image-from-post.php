<?php
//function to call first uploaded image in functions file
function get_first_post_image( $recent ) {
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $recent['post_content'], $matches);
  $first_img = (isset($matches[1][0])?$matches[1][0]:'');

  if(!empty($first_img)){
    return "<div class='recent-post-img' style='background-image: url(" . $first_img . ");'></div>";
  }
}
?>