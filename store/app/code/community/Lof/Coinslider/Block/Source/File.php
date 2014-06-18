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
if(!class_exists("Lof_Coinslider_Block_Source_File")){
	require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."List.php";
}
class Lof_Coinslider_Block_Source_File extends Lof_Coinslider_Block_List 
{
	function _toHtml() 
	{
		if( !$this->_show || !$this->getConfig('show') ) return;
		$theme = ($this->getConfig('theme')!="") ? $this->getConfig('theme') : "default";
		// check the source used ?
		$this->__renderSlideShowImagegroup();
		// render html
		$this->assign('config', $this->_config);
		$this->setTemplate($this->_config['template']);
        return parent::_toHtml();
	}
	/**
	 * render block content for the slideshow using the list of products.
	 */
	private function __renderSlideShowImagegroup() 
	{		
		$_model = Mage::getModel('lof_coinslider/banner');
		$theme = ($this->getConfig('theme')!="") ? $this->getConfig('theme') : "default";
		$list = $_model	->getCollection()
						->addFieldToFilter('label', $this->_config['imagecategory'])
						->addFieldToFilter('is_active', 1)
						->setOrder('position', 'asc');
		$items = array();
		foreach($list as $item){
			$imageArray = array();
			$imageArray[] = Mage::getBaseUrl('media').$item->getFile(); 
			$itemArray = array();
			$mainImage = $this->buildThumbnail( $imageArray,
												  $this->_config['mainWidth'],
												  $this->_config['mainHeight'] );
			/*$thumbnail = $this->buildThumbnail( $imageArray,
												  $this->_config['thumbWidth'],
												  $this->_config['thumbHeight'] );*/
			$itemArray['mainImage'] = $mainImage[0];
			/*$itemArray['thumbnail'] = $thumbnail[0];*/
			$itemArray['title'] = $item->getTitle();
			$itemArray['link'] = $item->getLink();
			$itemArray['description'] = $item->getDescription();
			$items[] = $itemArray;
		}
		
		$this->assign( 'items', $items);
		$this->assign( 'list', $list);
		$this->_config['template'] = 'lof/coinslider/'.$theme.'/list_sliders.phtml';	
	}
	/**
	 * Get List of Images File In Configured Directory
	 */
	public function getFileInDir()
	{
		if(!$this->_config['folder']) return ;
		
		$imagePath = Mage::getBaseDir().DIRECTORY_SEPARATOR.$this->_config['folder'];
		if(!is_dir($imagePath)) return array();
		$imgFiles   = $this->files($imagePath,".bmp|.gif|.jpg|.png|.jpeg");
		
		return $imgFiles;
	}

	function files($path, $filter = '.', $recurse = false, $fullpath = false, $exclude = array('.svn', 'CVS'))
	{
		// Initialize variables
		$arr = array ();
		// Is the path a folder?
		if (!is_dir($path)) {
			return array();
		}
		// read the source directory
		$handle = opendir($path);
		while (($file = readdir($handle)) !== false)
		{
			$dir = $path.DIRECTORY_SEPARATOR.$file;
			$isDir = is_dir($dir);
			if (($file != '.') && ($file != '..') && (!in_array($file, $exclude))) {
				if ($isDir) {
					if ($recurse) {
						if (is_integer($recurse)) {
							$recurse--;
						}
						$arr2 = files($dir, $filter, $recurse, $fullpath);
						$arr = array_merge($arr, $arr2);
					}
				} else {
					if (preg_match("/$filter/", $file)) {
						if ($fullpath) {
							$arr[] = $path.'/'.$file;
						} else {
							$arr[] = $file;
						}
					}
				}
			}
		}
		closedir($handle);
		asort($arr);
		return $arr;
	}
}
