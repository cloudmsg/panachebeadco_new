<?php


class Lof_Coinslider_Block_List extends Mage_Catalog_Block_Product_Abstract 
{
	protected $_config = '';
	protected $_listDesc = array();
	protected $_show = 0;
	protected $_helper = null;
	protected $_theme = "";

	public function __construct($attributes = array())
	{
		$helper =  Mage::helper('lof_coinslider/data');
		$this->_helper = &$helper;
		$mediaHelper = Mage::helper("lof_coinslider/media");
		$this->_config = $helper->get($attributes);
		$this->_show = $this->getConfig('show');
		$this->_theme = isset($this->_config["theme"])?$this->_config["theme"]:"";
		if(!$this->_show) return;
		/*Init media files*/
		$mediaHelper->addMediaFile("skin_css",'lof_coinslider/'.$this->_theme.'/style.css');
		/*End init meida files*/
		parent::__construct();
	}
	
	/**
	 * get value of the extension's configuration
	 *
	 * @return string
	 */
	function getConfig( $key ){
		return $this->_config[$key];
	}
	
	/**
	 * overrde the value of the extension's configuration
	 *
	 * @return string
	 */
	function setConfig( $key, $value ){
		$this->_config[$key] = $value;
		return $this;
	}	
	function isStaticBlock(){
		$name = isset($this->_config["name"])?$this->_config["name"]:"";
		if(!empty($name)){
			$regex1 = '/static_(\s*)/';
			if (preg_match_all($regex1,$name,$matches)){
				return true;
			}
		}
		return false;
	}		
	protected function __renderErrorMessage($msg = ""){
		
	}
	
	public function buildThumbnail ( $imageArray, $twidth, $theight ) 
	{

		$thumbnailMode = $this->_config['thumbnailMode'];
		if( $thumbnailMode ==1 )
		{
			$imageProcessor =  Mage::helper('lof_coinslider/lofimage');
			
			$imageProcessor->setStoredFolder();
			if(is_array($imageArray)){
				foreach ($imageArray as $image) 
				{
					$thumbs[]  = $imageProcessor->resize( $image,$twidth, $theight );
				}
			}
			else{
				$thumbs  = $imageProcessor->resize( $imageArray,$twidth, $theight );
			}
		} else 
		{
			return $imageArray;
		}
		return $thumbs;
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
		
	function parseDescOld ($description) 
	{
      $description = str_replace("<br />", "\n", $description);
      $description = explode("\n",$description);
      $descriptionArray = array();
      foreach($description as $desc)
	  {
        if ($desc) 
		{
          $list = split(":", $desc, 2);
          $list[1] = (count($list) > 1) ? split("&", $list[1]) : array();
          $temp = array();
          for ($i = 0; $i < count($list[1]); ++$i) {
            $l = split("=", $list[1][$i]);
            if(isset($l[1]))
            	$temp[trim($l[0])] = trim($l[1]);
          }
          $descriptionArray[$list[0]] = $temp;
        }
      }
      return $descriptionArray;
    }
    
    function parseDescNew($description) {
      $regex = '#\[desc ([^\]]*)\]([^\[]*)\[/desc\]#m';
  
      preg_match_all ($regex, $description, $matches, PREG_SET_ORDER);
  
      $descriptionArray = array();
      foreach ($matches as $match) {
        $params = $this->parseParams($match[1]);
        if (is_array($params)) {
          $img = isset($params['img'])?trim($params['img']):'';
          if (!$img) continue;
          $url = isset($params['url'])?trim($params['url']):'';
          $descriptionArray[$img] = array('url'=>$url,'caption'=>str_replace("\n","<br />",trim($match[2])));
        }
      }
      return $descriptionArray;
    }
  
    function parseParams($params) 
	{
      $params = html_entity_decode($params, ENT_QUOTES);
      $regex = "/\s*([^=\s]+)\s*=\s*('([^']*)'|\"([^\"]*)\"|([^\s]*))/";
      preg_match_all($regex, $params, $matches);
       $paramarray = null;
       if(count($matches)){
        $paramarray = array();
          for ($i=0;$i<count($matches[1]);$i++){ 
            $key = $matches[1][$i];
            $val = $matches[3][$i]?$matches[3][$i]:($matches[4][$i]?$matches[4][$i]:$matches[5][$i]);
            $paramarray[$key] = $val;
          }
        }
        return $paramarray;
    }    	
	
	
	function set($params){
		$params = preg_split ("/\n/", $params);
		foreach ($params as $param){	
			$param = trim($param);
			if (!$param) continue;
			$param = split ("=", $param, 2);
			if (count($param) == 2 && strlen(trim($param[1])) > 0)
				$this->_config[trim($param[0])] =  trim($param[1]);
		}
		/*Override theme*/
		$theme = $this->getConfig( "theme" );
		if(!empty($theme) && $theme != $this->_theme){
			$mediaHelper = Mage::helper("lof_coinslider/media");
			$mediaHelper->addMediaFile("skin_css",'lof_coinslider/'.$theme.'/style.css');
		}
		/*End override*/
	}
	function inArray($source, $target) {
		for($j = 0; $j < sizeof ( $source ); $j ++) {
			if (in_array ( $source [$j], $target )) {
				return true;
			}
		}
	}
}
