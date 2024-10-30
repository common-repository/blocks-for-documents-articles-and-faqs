<?php

/**
 * Setup links and information on Plugins WordPress page
 *
 */


/**
 * Adds various links for plugin on the Plugins page displayed on the left
 *
 * @param   array $links contains current links for this plugin
 * @return  array returns an array of links
 */
function epbl_add_plugin_action_links ( $links ) {
	$my_links = array(
		__( 'Settings', 'blocks-for-documents-articles-and-faqs' )    => '<a href="' .  admin_url( 'admin.php?page=blocks-for-documents-articles-and-faqs' ) . '">' . __( 'Settings', 'blocks-for-documents-articles-and-faqs' ) . '</a>',
	);

	return array_merge( $my_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( ECHO_BLOCKS__FILE__ ), 'epbl_add_plugin_action_links' , 10, 2 );

/**
 * Add info about plugin on the Plugins page displayed on the right.
 *
 * @param $links
 * @param $file
 * @return array
 */
function epbl_add_plugin_row_meta($links, $file) {
	if ( $file != 'blocks-for-documents-articles-and-faqs/echo-document-blocks.php' ) {
		return $links;
	}
	$links[] = '<a href="https://www.echoplugins.com/knowledge-base/" target="_blank">' . esc_html__( 'Docs & FAQs', 'blocks-for-documents-articles-and-faqs' ) . '</a>';
	$links[] = '<a href="https://www.echoplugins.com/technical-support/" target="_blank">' . esc_html__( 'Support', 'blocks-for-documents-articles-and-faqs' ) . '</a>';

	return $links;
}
add_filter( 'plugin_row_meta', 'epbl_add_plugin_row_meta', 10, 2 );
