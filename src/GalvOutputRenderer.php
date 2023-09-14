<?php

class GalvOutputRenderer extends AbstractOutputRenderer {

	/**
	 * @param string $SourceFileURL
	 * @param string $FileTitle
     * @param string $FileName
     * @param array $params
	 */
	public function __construct( $SourceFileURL, $FileTitle, $FileName, $params ) {
		parent::__construct( $SourceFileURL, $FileTitle, $FileName, $params, 'Galvanicium', 'galvanicium_logo.svg', 'file', true);
	}

}