<?php

class Lof_Coinslider_Helper_String extends Mage_Core_Helper_Abstract {
	
	function strlen($str){
		return mb_strlen($str);
	}
	function substr($str, $offset, $length = FALSE)
	{
		if ( $length === FALSE ) {
			return mb_substr($str, $offset);
		} else {
			return mb_substr($str, $offset, $length);
		}
	}
	function substring( $text, $length = 100, $replacer='...' ){
		$string = strip_tags( $text );
		return $this->strlen( $string ) > $length ? $this->substr( $string, 0, $length ).$replacer: $string;
	}
}
?>