<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
I am in the plugin
<div class="testimonial-block clearfix">
    <h2><?php block_field( 'title' ); ?></h2>
    <div><?php block_field( 'description' ); ?></div>
    <a href="<?php block_field('button-link');?>" class="button" type="button"><?php block_field( 'button-text' ); ?></a>
</div>

