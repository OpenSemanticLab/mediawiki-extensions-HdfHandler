<?php
/**
 * SpecialPage for SciFileHandler extension
 *
 * @file
 * @ingroup Extensions
 */

use AbstractViewer;

class SpecialHdfViewer extends AbstractViewer {
	
	public function __construct() {
		parent::__construct( 'HdfViewer', 'hdfviewer', 'H5WasmApp', 'url' );
	}
}

