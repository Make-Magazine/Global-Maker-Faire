<?php
//add rewrite rule for public facing entry page
function maker_url_vars($rules) {
  $newrules = array();
  $newrules['maker/entry/(\d*)/?'] = 'index.php?post_type=page&pagename=entry-page-do-not-delete&e_id=$matches[1]';
  return $newrules + $rules;
}
add_filter('rewrite_rules_array', 'maker_url_vars');

add_filter('query_vars', 'mf_query_vars');
//set up query vars for public facing entry page
function mf_query_vars($query_vars) {
  $query_vars[] = 'e_id';
  return $query_vars;
}