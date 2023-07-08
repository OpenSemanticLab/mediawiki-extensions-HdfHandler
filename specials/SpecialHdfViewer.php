<?php
/**
 * HelloWorld SpecialPage for HdfHandler extension
 *
 * @file
 * @ingroup Extensions
 */

use SpecialPage;

class SpecialHdfViewer extends SpecialPage {
	public function __construct() {
		parent::__construct( 'HdfViewer', '' );
		$this->mIncludable = true; // make it includeable in other pages
	}

	/**
	 * Show the page to the user
	 *
	 * @param string $par The subpage string argument (if any) => interpreted as file name.
	 *  [[Special:HdfViewer/subpage]].
	 */
	public function execute( $par ) {
		$out = $this->getOutput();

		// request params if needed
		// $request = $this->getRequest();
		// $myparam = $request->getText( 'myparam' );

		$out->setPageTitle( $this->msg( 'hdfhandler-special-hdfviewer-title' ) );

		// $out->addHelpLink( 'Displays Hierarchical Data Format (HDF) Files' );

		$out->addWikiMsg( 'hdfhandler-special-hdfviewer-intro' );

		$params = "";
		if ($par) $params = "?url=/w/index.php?title=Special:Redirect/file/$par";

		$iframe = <<<EOD
		<iframe 
			id="Iframe1" 
			src="/w/extensions/HdfHandler/dist/$params" 
			width="100%" 
			height="1000px" 
			frameborder="0">
		</iframe>
		EOD;
		$out->addHTML($iframe);
	}

	protected function getGroupName() {
		return 'media';
	}
}

