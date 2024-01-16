<?php

defined( 'ABSPATH' ) || exit;

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets, so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function fse_pilot_blocks_init(): void {
	register_block_type( FSE_PILOT_BLOCKS_DIR . 'build/dummy-subscribe-form' );
	register_block_type( FSE_PILOT_BLOCKS_DIR . 'build/table-of-contents' );
}
add_action( 'init', 'fse_pilot_blocks_init' );

/**
 * Loads the blocks plugin's translated strings.
 *
 * @since   0.1.0
 * @version 0.1.0
 *
 * @return  void
 */
function fse_pilot_blocks_load_textdomain(): void {
	load_muplugin_textdomain( FSE_PILOT_BLOCKS_METADATA['TextDomain'], dirname( plugin_basename( FSE_PILOT_BLOCKS_DIR ) ) . FSE_PILOT_BLOCKS_METADATA['DomainPath'] );

	foreach ( glob( FSE_PILOT_BLOCKS_DIR . 'build/*', GLOB_ONLYDIR ) as $fse_pilot_block_dir ) {
		$fse_pilot_block_name = basename( $fse_pilot_block_dir );
		wp_set_script_translations(
			generate_block_asset_handle( "fse-pilot/$fse_pilot_block_name", 'editorScript' ),
			FSE_PILOT_BLOCKS_METADATA['TextDomain'],
			untrailingslashit( FSE_PILOT_BLOCKS_DIR ) . FSE_PILOT_BLOCKS_METADATA['DomainPath']
		);
	}
}
add_action( 'init', 'fse_pilot_blocks_load_textdomain', 11 );
