<?php
if(!class_exists("Venustheme_Gallery_Block_List")){
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR."List.php";
}

class Venustheme_Gallery_Block_Image extends Venustheme_Gallery_Block_List 
{
	private $thumbdir;
	
	/**
     * Rendering block content
     *
     * @return string
     */
	function _toHtml() 
	{
		$folder = $this->getConfig("image_folder","gallery/upload");
		$path = str_replace( DS.DS,DS, Mage::getBaseDir('media') . DS . str_replace("/",DS, $folder ));		
		$files = array();
		
		
		if( is_dir($path) ){ 
			$files = $this->dirFiles( $path );
		}
		$mediaURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
		$this->thumbdir = 
		$output = array();
		if( $files ){
			foreach( $files as $file ){
				$tmp = new stdClass();
				$tmp->filename = $file;
				$tmp->imageURL = $mediaURL. str_replace(DS,"/",$folder)."/".$file;
				$tmp->thumbnailURL = $mediaURL.$this->resizeImage( $folder.DS.$file, $this->getConfig("thumbWidth",200), $this->getConfig("thumbHeight",200) );

				$output[] = $tmp;
			}
		}
		
		$this->assign( 'images', $output );	
		$this->_config['template'] = 'venustheme/gallery/image.phtml';
		$this->setTemplate($this->_config['template']);
		  
		return parent::_toHtml();
    }
	
	public function resizeImage( $image, $width, $height ){
		$image= str_replace("/",DS, $image);
		$_imageUrl = Mage::getBaseDir('media').DS.$image;
		$imageResized = Mage::getBaseDir('media').DS."resized".DS."{$width}x{$height}".DS.$image;
	
		if (!file_exists($imageResized)&&file_exists($_imageUrl)) {
			$imageObj = new Varien_Image($_imageUrl);
			$imageObj->constrainOnly(TRUE);
			$imageObj->keepAspectRatio(TRUE);
			$imageObj->keepFrame(FALSE);
			$imageObj->resize( $width, $height);
			$imageObj->save($imageResized);
			
		}
		return 'resized/'."{$width}x{$height}/".str_replace(DS,"/",$image);
	}
	
	function dirFiles($directry) {
		$dir = dir($directry);
		$filesall = array();
		while (false!== ($file = $dir->read())) 
		{
			$extension = substr($file, strrpos($file, '.')); 
			if($extension == ".png" || $extension == ".gif" || $extension == ".jpg" |$extension == ".jpeg") 
			$filesall[$file] = $file; 
		}
		$dir->close(); // Close Directory
		asort($filesall); // Sorts the Array
		return $filesall;
	}

}
