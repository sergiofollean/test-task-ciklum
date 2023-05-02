<?php
/*
 * Plugin Name: Test Task Ciklum
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// check if class exist TestTaskCiklum
if ( !class_exists('TestTaskCiklum') ) {
    class TestTaskCiklum {
        public function __construct() {
            // add_action( 'init', array( $this, 'init' ) );
        }
    }

    new TestTaskCiklum();
}