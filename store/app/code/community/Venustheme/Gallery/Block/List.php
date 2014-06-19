<?php

class Venustheme_Gallery_Block_List extends Mage_Catalog_Block_Product_Abstract 
{
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_config = '';
	
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_listDesc = array();
	
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_show = 0;
	protected $_theme = "";
	
	/**
	 * Contructor
	 */
	public function __construct($attributes = array())
	{
		$helper =  Mage::helper('venustheme_gallery/data');
		$this->_config = $helper->get($attributes);
		$this->_show = $this->getConfig("show");
		if(!$this->_show) return;
		/*End init meida files*/
		$mediaHelper =  Mage::helper('venustheme_gallery/media');
		$this->_theme = $this->getConfig("theme",'default');
		
		$mediaHelper->addMediaFile("skin_css", "venustheme_gallery/".$this->_theme."/colorbox.css" );
		$mediaHelper->addMediaFile("skin_css", "venustheme_gallery/style.css" );
		parent::__construct();		
	}
	/**
	 * get value of the extension's configuration
	 *
	 * @return string
	 */
	function getConfig( $key, $default= "" ){
		return (!isset($this->_config[$key])||(isset($this->_config[$key]) && empty($this->_config[$key])))?$default:$this->_config[$key] ;
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
 	
  	/**
	 *
	 */
    function parseParams($params) {
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
	function set($params){
		$params = preg_split ("/\n/", $params);
		foreach ($params as $param){	
			$param = trim($param);
			if (!$param) continue;
			$param = split ("=", $param, 2);
			if (count($param) == 2 && strlen(trim($param[1])) > 0)
				$this->_config[trim($param[0])] =  trim($param[1]);
		}
		$theme =  $this->getConfig("theme");
		if($theme != $this->_theme){
			$mediaHelper =  Mage::helper('venustheme_gallery/media');
			$mediaHelper->addMediaFile("skin_css", "venustheme_gallery/".$theme."/style.css" );
		}
	}
	
	/**
	 * render thumbnail image
	 */
	public function buildThumbnail ( $imageArray, $twidth, $theight ) {
		$thumbnailMode = $this->_config['thumbnailMode'];
		if( $thumbnailMode != 'none' ) {
			$imageProcessor =  Mage::helper('venustheme_gallery/vesimage');
			$imageProcessor->setStoredFolder();
			if(is_array($imageArray)){
				foreach ($imageArray as $image) {
					$thumbs[]  = $imageProcessor->resize( $image,$twidth, $theight );
				}
			}else{
				$thumbs  = $imageProcessor->resize( $imageArray,$twidth, $theight );
			}
			return $thumbs;
		}
		
		return $imageArray;
	}
	public function substring( $producttext, $length = 100, $replacer='...', $isStriped=true ){
    		$producttext = strip_tags($producttext);
    		if(strlen($producttext) <= $length){
    			return $producttext;
    		}
    		$producttext = substr($producttext,0,$length);
    		$posSpace = strrpos($producttext,' ');
    		return substr($producttext,0,$posSpace).$replacer;
	}
}