<?php
/**
 * Template Name: One column
 * Template Post Type: post, page
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( is_single() ) {
	get_template_part('single');
} else {
	get_template_part('page');
}

