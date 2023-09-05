<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'SciFileHandler' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['SciFileHandler'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['SciFileHandlerAlias'] = __DIR__ . '/SciFileHandler.i18n.alias.php';
	$wgExtensionMessagesFiles['SciFileHandlerMagic'] = __DIR__ . '/SciFileHandler.i18n.magic.php';
	wfWarn(
		'Deprecated PHP entry point used for SciFileHandler extension. Please use wfLoadExtension ' .
		'instead, see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return true;
} else {
	die( 'This version of the SciFileHandler extension requires MediaWiki 1.25+' );
}
