<?php

/**
 * Displays HDF files
 * Inspired from MP3MediaHandler
 */
class HdfMediaHandler extends AbstractMediaHandler {

	/**
	 * @param File $file
	 * @param string $dstPath
	 * @param string $dstUrl
	 * @param array $params
	 * @param int $flags
	 * @return HdfOutputRenderer
	 */
	public function doTransform( $file, $dstPath, $dstUrl, $params, $flags = 0 ) {
		return new HdfOutputRenderer( $file->getFullUrl(), $file->getTitle(), $file->getName(), $params );
	}
}