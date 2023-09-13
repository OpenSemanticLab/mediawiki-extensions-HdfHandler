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

	public static function onMimeMagicInit( $mime ) {
		$mime->addExtraTypes( 'chemical/x-jcamp-dx dx jdx jcm' );
	}
	
	public static function onMimeMagicImproveFromExtension( $mimeAnalyzer, $ext, &$mime ) {
	    if ( in_array( $ext, ['dx', 'jdx', 'jcm'] ) ) {
	        $mime = 'chemical/x-jcamp-dx';
	    }
		if ( in_array( $ext, ['mpr', 'mpt', 'mps'] ) ) {
			
			#.mpr : Raw binary file containing the data
			#.mpt : .mpr into Text file
			#.mps : experiment Settings text file.
		
			#$mime = 'application/octet-stream'
	        $mime = 'application/x-biologic';
	    }
		
	}
	
	public static function onMimeMagicGuessFromContent( $mimeAnalyzer, &$head, &$tail, $file, &$mime ) {
		#if ( str_contains( $head, '##JCAMP' ) ) {
		#	$mime = 'chemical/x-jcamp-dx';
		#}
		return;
	}
}
