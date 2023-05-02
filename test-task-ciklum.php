<?php
/*
 * Plugin Name: Test Task Ciklum
 * Description: allows you to search post/pages/post_types by slug inside /wp-admin area
 * Version: 1.0
 * Author: Popovych Sergiy
 * Author URI: https://www.linkedin.com/in/sergiofollean/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists('TestTaskCiklum') ) {
    class TestTaskCiklum {
        public function __construct() {
            add_filter( 'posts_search', array( $this, 'search_by_slug' ) );
        }

        public function search_by_slug( $search ) {
            global $wpdb, $wp_query;

            if ( empty( $search ) )
                return $search;

            // check if is admin or ajax request
            if (is_admin()) {
                $s = $wp_query->query_vars['s'] ?? $_POST['q'] ?? $_POST['s'] ?? '';

                // check if search string have a "slug:" prefix
                if (strpos($s, 'slug:') === 0) {
                    $slug = explode(':', $s)[1];

                    $search = $wpdb->prepare(
                        " AND {$wpdb->posts}.post_name LIKE %s ",
                        '%' . $wpdb->esc_like( $slug ) . '%'
                    );

                    $wp_query->set('orderby', 'post_name' );
                    $wp_query->set('order', 'ASC' );
                }
            }

            return $search;
        }
    }

    new TestTaskCiklum();
}