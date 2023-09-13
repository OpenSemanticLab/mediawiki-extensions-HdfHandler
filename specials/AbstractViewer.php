<?php
/**
 * Abstract SpecialPage for SciFileHandler viewers
 *
 * @file
 * @ingroup Extensions
 */

use SpecialPage;

abstract class AbstractViewer extends SpecialPage {

    protected $mId;
    protected $mApp;
    protected $mUrlParam;
	protected $mHash;

	public function __construct($name, $id, $app, $url_param, $hash=false) {
		parent::__construct( $name, '' );
		$this->mIncludable = true; // make it includeable in other pages
        $this->mId = $id;
        $this->mApp = $app;
        $this->mUrlParam = $url_param;
		$this->mHash = $hash;
	}

	/**
	 * Show the page to the user
	 *
	 * @param string $par The subpage string argument (if any) => interpreted as file name.
	 *  [[Special:HdfViewer/subpage]].
	 */
	public function execute( $par ) {
		global $wgScriptPath;
		global $wgServerName;

		$out = $this->getOutput();

		// request params if needed
		// $request = $this->getRequest();
		// $myparam = $request->getText( 'myparam' );

		$out->setPageTitle( $this->msg( "scifilehandler-special-" . $this->mId . "-title" ) );

		// $out->addHelpLink( 'Displays Hierarchical Data Format (HDF) Files' );

		$out->addWikiMsg( "scifilehandler-special-" . $this->mId . "-intro" );

		$params = "";
		if ($par) {
			$params = "?{$this->mUrlParam}=https://{$wgServerName}{$wgScriptPath}/index.php?title=Special:Redirect/file/$par";
			if ($this->mHash) $params = "#" . $params;
		}

		$iframe = <<<EOD
		<iframe 
			id="Iframe1" 
			src="/w/extensions/SciFileHandler/dist/{$this->mApp}/$params" 
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

