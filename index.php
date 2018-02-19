<?php
/*
Plugin Name: kk admin extension
Plugin URI: www.krankikom.de
Description: Erweiterung - "Mitarbeiter" und "Unternehmen"
Version: 1.0
Author: Benedikt Hiepler
Author URI: 
*/

require 'plugin-update-checker-4.4/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/Hiepler/wp_admin_extension/master/plugin.json',
	__FILE__,
	'unique-plugin-or-theme-slug'
);

//* Register Projects Post Type

add_action( 'init', 'add_company' );
function add_company() {
    $labels = array(
        'name'               => _x( 'Unternehmen', 'post type general name' ),
        'singular_name'      => _x( 'Unternehmen', 'post type singular name' ),
        'menu_name'          => _x( 'Unternehmen', 'admin menu' ),
        'name_admin_bar'     => _x( 'Unternehmen', 'add new on admin bar' ),
        'add_new'            => _x( 'Neues Unternehmen hinzufügen', 'unternehmen' ),
        'add_new_item'       => __( 'Unternehmen hinzufügen' ),
        'new_item'           => __( 'Neues Unternehmen' ),
        'edit_item'          => __( 'Unternehmen bearbeiten' ),
        'view_item'          => __( 'Unternehmen ansehen' ),
        'all_items'          => __( 'Alle Unternehmen' ),
        'search_items'       => __( 'Unternehmen suchen' ),
        'parent_item_colon'  => __( 'Unternehmen:' ),
        'not_found'          => __( 'Keine Unternehmen gefunden.' ),
        'not_found_in_trash' => __( 'Keine Unternehmen gelöscht.' )
    );
    
    $args = array  (
        'labels' => $labels,
       'hierarchical' => true,
       'public'      => true,
       'has_archive' => true,
       // 'show_ui'     => false,
       'rewrite'     => array(
        //    'slug' => 'portfolio-items',
       ),
       'supports'    => array( 'title', 'editor','thumbnail', 'comments', 'revisions',),
       'can_export'  => true,
       'menu_position' => 5,
    //    'taxonomies'  => array( 'portfolio_category'),
   );

    register_post_type('portfolio_new',$args);
}

add_action( 'init', 'add_worker');
function add_worker() {
    $labels = array(
        'name'               => _x( 'Mitarbeiter', 'post type general name' ),
        'singular_name'      => _x( 'Mitarbeiter', 'post type singular name' ),
        'menu_name'          => _x( 'Mitarbeiter', 'admin menu' ),
        'name_admin_bar'     => _x( 'Mitarbeiter', 'add new on admin bar' ),
        'add_new'            => _x( 'Neuen Mitarbeiter hinzufügen', 'mitarbeiter' ),
        'add_new_item'       => __( 'Mitarbeiter hinzufügen' ),
        'new_item'           => __( 'Neuen Mitarbeiter' ),
        'edit_item'          => __( 'Mitarbeiter bearbeiten' ),
        'view_item'          => __( 'Mitarbeiter ansehen' ),
        'all_items'          => __( 'Alle Mitarbeiter' ),
        'search_items'       => __( 'Mitarbeiter suchen' ),
        'parent_item_colon'  => __( 'Mitarbeiter:' ),
        'not_found'          => __( 'Keine Mitarbeiter gefunden.' ),
        'not_found_in_trash' => __( 'Keine Mitarbeiter gelöscht.' )
    );
    
    $args = array  (
       'labels' => $labels,
       'hierarchical' => true,
       'public'      => true,
       'has_archive' => true,
       'show_in_menu' => true,
       'publicly_queryable' => true,
       'taxonomies' => array('post_tag'),
       'show_ui'     => true,
       'rewrite'     => array(
        //    'slug' => 'portfolio-item',
       ),
       'supports'    => array( 'title', 'editor','thumbnail', 'comments', 'revisions',),
       'can_export'  => true,
       'menu_position' => 5,
    //    'taxonomies'  => array( 'portfolio_category'),
   );

    register_post_type('portfolio',$args);
}

function change_label() {
   global $submenu;
   $submenu['edit.php?post_type=portfolio_new'][15][0] = 'Kategorien'; 
   $submenu['edit.php?post_type=portfolio'][15][0] = 'Kategorien'; 
}
add_action( 'admin_menu', 'change_label' );