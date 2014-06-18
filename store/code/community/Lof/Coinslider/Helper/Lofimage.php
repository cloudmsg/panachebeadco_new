<?php 
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Lof
 * @package     Lof_Slider
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Banner base block
 *
 * @category    Lof
 * @package     Lof_Slider
 * @author    LandOfCoder (landofcoder@gmail.com)
 */
if( !defined('PhpThumbFactoryLoaded') ) {

	require_once dirname(__FILE__).DS.'phpthumb'.DS.'ThumbLib.inc.php';
	define('PhpThumbFactoryLoaded',1);
}
 if( !class_exists("Lof_Coinslider_Helper_Lofimage") ){
	class Lof_Coinslider_Helper_Lofimage  {
		
		/**
		 * @var string $_thumbnailPath
		 *
		 * @access private 
		 */
		protected $_thumbnailPath = '';
		
		/**
		 * @var string $_thumbnailPath
		 *
		 * @access private 
		 */
		protected $_thumbnailURL = '';
		
		/**
		 * set path of folder where will store images rendered.
		 *
		 * @access private 
		 */
		public function setStoredFolder( $subpath='lofthumbs' ){
			$this->_thumbnailPath = Mage::getBaseDir().DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.$subpath.DIRECTORY_SEPARATOR;
			if(!is_dir($this->_thumbnailPath) ){
				mkdir($this->_thumbnailPath,0755);	
			}
			$this->_thumbnaiURL = Mage::getBaseUrl('media').$subpath.'/';
			
			echo $this->_thumbnaiURLs
	
		}
		
		/**
		 * precess creating thumbnail image.
		 */
		public  function resize( $path, $width=100, $height=100   ){
			
			$imagSource =Mage::getBaseDir().DIRECTORY_SEPARATOR. str_replace( '/', DIRECTORY_SEPARATOR,  $path );
	
			if( file_exists($imagSource)  ) {
				$tmp = explode("/", $path);
				$imageName = $width."x".$height."-".$tmp[count($tmp)-1];
				$thumbPath = $this->_thumbnailPath.$imageName;

				if( !file_exists($thumbPath) ) {	
					$thumb = PhpThumbFactory::create( $imagSource  );  		
					$thumb->adaptiveResize( $width, $height);
					$thumb->save( $thumbPath  ); 
				}
				$path = $this->_thumbnaiURL.$imageName;
			} 
			return $path;
		}
	}
 }
?>