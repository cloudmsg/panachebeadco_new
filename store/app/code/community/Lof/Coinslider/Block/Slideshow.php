<?php 
class Lof_Coinslider_Block_Slideshow extends Lof_Coinslider_Block_List 
{
	public function _toHtml(){
		$source = $this->getConfig( "source" );
		if( $source ){ 
			return $this->getLayout()->createBlock("lof_coinslider/source_".$source)->toHtml();
		}
	 
	}
}
?>