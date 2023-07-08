<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'HdfHandler' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['HdfHandler'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['HdfHandlerAlias'] = __DIR__ . '/HdfHandler.i18n.alias.php';
	$wgExtensionMessagesFiles['HdfHandlerMagic'] = __DIR__ . '/HdfHandler.i18n.magic.php';
	wfWarn(
		'Deprecated PHP entry point used for HdfHandler extension. Please use wfLoadExtension ' .
		'instead, see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return true;
} else {
	die( 'This version of the HdfHandler extension requires MediaWiki 1.25+' );
}
