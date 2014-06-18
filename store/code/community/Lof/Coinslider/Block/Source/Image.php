<?php
	 	
if(!class_exists("Lof_Coinslider_Block_Source_Image")){
	
	require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."List.php";
}
class Lof_Coinslider_Block_Source_Image extends Lof_Coinslider_Block_List 
{
	function _toHtml() 
	{
		/*Init media files*/
		if( !$this->_show || !$this->getConfig('show') ) return;
		$theme = ($this->getConfig('theme')!="") ? $this->getConfig('theme') : "default";
		// check the source used ?
		$this->__renderSlideShowImages();
		$this->_config['template'] = 'lof/coinslider/'.$theme.'/list.phtml';
		
		// render html
		$this->assign('config', $this->_config);
		$this->setTemplate($this->_config['template']);				
        return parent::_toHtml();
	}
	
	/**
	 * render block content for the slideshow using the list of images in a folder.
	 */
	private function __renderSlideShowImages(){
		// init values.
		$descriptionArray = $mainsThumbs = $imageArray     = array();
		$thumbArray = array();
		$captionsArray = array();
		$urls = array();
		
		$listImgs = $this->getFileInDir();
		
		
		if($this->_config['showdesc'])
		{			
			$descriptionArray = $this->parseDescNew ( $this->getConfig('description') );
			if ( !count($descriptionArray) )
			{
				$descriptionArray = $this->parseDescOld ( $this->getConfig('description') );	
			}
		}
			
			
		if (count($listImgs) > 0) 
		{			
			foreach($listImgs as $k=>$img) 
			{
				$imageArray[] = $this->_config['folder'].'/'.$img;
				if($this->_config['showdesc'])
				{
					$captionsArray[] = (isset($descriptionArray) 
											  && isset($descriptionArray[$img])
											  && isset($descriptionArray[$img]['caption']))
									? str_replace("'", "\'", $descriptionArray[$img]['caption']) :'';
					
				}
				$url = (isset($descriptionArray[$img]) 
												&& isset($descriptionArray[$img]['url']))
					? $descriptionArray[$img]['url'] :'';
					
				$urls[] = $url;
				
			}
			// generate mainImages and thumbnail Images.
			$mainsThumbs = $this->buildThumbnail( $imageArray, $this->_config['mainWidth'], $this->_config['mainHeight'] );
		/*$thumbArray = $this->buildThumbnail ( $imageArray, $this->getConfig('thumbWidth'), $this->getConfig('thumbHeight') );*/
		}

	/*	$this->assign('thumbArray', $thumbArray);		*/
		$this->assign('mainsThumbs', $mainsThumbs);		
		$this->assign('listImgs', $imageArray);
		$this->assign('descriptionArray', $descriptionArray);		
		$this->assign('captionsArray', $captionsArray);		
		$this->assign('urls', $urls);		
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
