<?php

class HdfOutputRenderer extends MediaTransformOutput {

	/**
	 * @var string
	 */
	private $pSourceFileURL;

	/**
	 * @var string
	 */
	private $pFileTitle;

    /**
	 * @var string
	 */
	private $pFileName;

    /**
	 * @var string
	 */
	private $pPageUrl;

    /**
	 * @var array
	 */
	private $pParams;

    /**
	 * @var int
	 */
	private $pIframeMinWidth = 900;

    /**
	 * @var int
	 */
	private $pIframeMinHeight = 450;

    /**
	 * @var int
	 */
	private $pScaledIframeWidthThreshold = 900/3;

    /**
	 * @var int
	 */
	private $pScaledIframeHeightThreshold = 450/3;

	/**
	 * @param string $SourceFileURL
	 * @param string $FileTitle
     * @param string $FileName
     * @param array $params
	 */
	public function __construct( $SourceFileURL, $FileTitle, $FileName, $params ) {
		$this->pSourceFileURL = $SourceFileURL; // /w/img_auth.php/b/bc/....hdf
		$this->pFileTitle = $FileTitle; // "File:...hdf"
        $this->pFileName = $FileName; // "...hdf"
        $this->pParams = $params;
        $this->pPageUrl = $this->pParams["descriptionUrl"]; // "/wiki/File:....hdf"
	}

	/**
	 * @param array $options
	 *
	 * @return string
	 */
	public function toHtml( $options = [] ) {

		$params = "?url=" . $this->pSourceFileURL;

        // create an iframe to display the file
        $iframe = <<<EOD
		<iframe 
			id="Iframe1" 
			src="/w/extensions/HdfHandler/dist/$params" 
			style="width:100%; min-width:{$this->pIframeMinWidth}px; min-height:{$this->pIframeMinHeight}px;"
			frameborder="0">
		</iframe>
		EOD;

        // create an scaled iframe to display the file
        //$this->pParams["width"] = 300;
        $targetWidth = $this->pIframeMinWidth;
        $targetHeight = $this->pIframeMinHeight;
        if ( $this->pParams["width"] ) $targetWidth = 0.9*$this->pParams["width"];
        if ( $this->pParams["height"] ) $targetHeight = 0.9*$this->pParams["height"];
        $widthScale = $targetWidth / $this->pIframeMinWidth;
        $heightScale = $targetHeight / $this->pIframeMinHeight;
        $scale = min([$widthScale, $heightScale]);
        $scaledIframe = <<<EOD
		<div style="width: {$targetWidth}px; height: {$targetHeight}px;">
		<iframe 
			id="Iframe1" 
			src="/w/extensions/HdfHandler/dist/$params" 
			style="width:{$this->pIframeMinWidth}px; height: {$this->pIframeMinHeight}px; -webkit-transform: scale($scale); -webkit-transform-origin: 0 0;"
			frameborder="0">
		</iframe>
		</div>
		EOD;

        //$pParamsStr .= "<p>" . Json_encode($this->pParams) . "</p>"; #JSON.serialize($this->pParams);
        //$optionsStr .= "<p>" . Json_encode($options) . "</p>";

        // create a placeholder
        //$logo = "/w/resources/assets/file-type-icons/fileicon.png";
        $logo = "/w/extensions/HdfHandler/resources/hdf_logo.svg";
        $placeholder = <<<EOD
        <a href="$this->pPageUrl" class="image">
        <img alt="$this->pFileName" 
        src="$logo" 
        decoding="async" data-file-width="0" data-file-height="0" width="120" height="120">
        </a>
        EOD;

        $output = "";
        if ( $this->pParams["isFilePageThumb"] ) $output .= $iframe; // Preview on the file page
        elseif ( $this->pParams["width"] > $this->pScaledIframeWidthThreshold 
            && $this->pParams["height"] > $this->pScaledIframeHeightThreshold) 
                $output .= $scaledIframe; // Large thumb requested
        else $output .= $placeholder; // Small thumb requested (e. g. by search results, gallery, etc.)
        
		return $this->linkWrap( [], $output );
	}


}