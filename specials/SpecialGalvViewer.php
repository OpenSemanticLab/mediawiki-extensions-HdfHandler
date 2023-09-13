<?php
/**
 * SpecialPage for SciFileHandler extension
 *
 * @file
 * @ingroup Extensions
 */

use AbstractViewer;

class SpecialGalvViewer extends AbstractViewer {
	
	public function __construct() {
		parent::__construct( 'GalvViewer', 'galvviewer', 'Galvanicium', 'file', true );
	}
}

