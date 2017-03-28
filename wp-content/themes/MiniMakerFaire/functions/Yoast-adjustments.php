<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Remove Canonical
add_filter( 'wpseo_canonical', '__return_false' );