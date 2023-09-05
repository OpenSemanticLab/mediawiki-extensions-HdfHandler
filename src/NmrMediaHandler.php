<?php

/**
 * Displays HDF files
 * Inspired from MP3MediaHandler
 */
class NmrMediaHandler extends AbstractMediaHandler {

	/**
	 * @param File $file
	 * @param string $dstPath
	 * @param string $dstUrl
	 * @param array $params
	 * @param int $flags
	 * @return NmrOutputRenderer
	 */
	public function doTransform( $file, $dstPath, $dstUrl, $params, $flags = 0 ) {
		return new NmrOutputRenderer( $file->getFullUrl(), $file->getTitle(), $file->getName(), $params );
	}
}