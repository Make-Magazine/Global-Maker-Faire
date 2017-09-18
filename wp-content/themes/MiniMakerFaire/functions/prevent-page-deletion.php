<?php
/******************************************************/
/* Prevent an array of page ID's from getting deleted */
/******************************************************/

add_action('wp_trash_post', 'restrict_post_deletion', 10, 1);
add_action('trash_post', 'restrict_post_deletion', 10, 1);
add_action('before_delete_post', 'restrict_post_deletion', 10, 1);

// Define all the page ID's to prevent from getting deleted
// home = 5
// contact = 12
// sponsors = 13
// meet the makers = 340
// scheduled = 341
// news = 366

function restrict_post_deletion($post_id) {
  $restricted_pages = array(5,12,13,71,101,340,341,366);

  if( ! is_super_admin() ) {
    if( is_page && in_array($post_id, $restricted_pages) ) {
      exit('The page you were trying to delete is protected.');
    }
  }
}