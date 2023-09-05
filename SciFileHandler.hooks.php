<?php
/**
 * Hooks for SciFileHandler extension
 *
 * @file
 * @ingroup Extensions
 */

class SciFileHandlerHooks {

	public static function onParserFirstCallInit( Parser &$parser ) {
		// important: This needs 	
		// "ExtensionMessagesFiles": { "SciFileHandlerMagic": "SciFileHandler.i18n.magic.php" }
		// in extension.json

		$parser->setFunctionHook( 'hdf', 'SciFileHandlerHooks::doSomething' );
		#$parser->setFunctionHook( 'hdf', [ 'SciFileHandlerHooks', 'doSomething' ]  );
	}

	/**
	 * @param Parser &$parser
	 * @param string &$text
	 * @return true
	 */
	public static function doSomething( &$parser, &$text ) {
		// Called in MW text like this: {{#hdf: }}

		// For named parameters like {{#hdf: foo=bar | apple=orange | banana }}
		// See: https://www.mediawiki.org/wiki/Manual:Parser_functions#Named_parameters

		return "This text will be shown when calling this in MW text.";
	}
}
