<?php
/**
 * SpecialPage for SciFileHandler extension
 *
 * @file
 * @ingroup Extensions
 */

use AbstractViewer;

class SpecialNmrViewer extends AbstractViewer {
	
	public function __construct() {
		parent::__construct( 'NmrViewer', 'nmrviewer', 'NMRium', 'jcampURL' );
	}
}

