<?php 
 /*------------------------------------------------------------------------
  # VenusTheme Blog Module 
  # ------------------------------------------------------------------------
  # author:    VenusTheme.Com
  # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
  # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.venustheme.com
  # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/
class Venustheme_Blog_PostController extends Mage_Core_Controller_Front_Action
{  	
	public function indexAction(){
		 
		
		
		$this->loadLayout();
 
		$this->renderLayout();
	 //	Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
	}
	public function commentAction(){
		if($data = $this->getRequest()->getPost()) {
			$check = true; 
			if( Mage::getStoreConfig('venustheme_blog/general_setting/enable_recaptcha') ){
				$recaptcha = Mage::helper('venustheme_blog/recaptcha')
							->setKeys( Mage::getStoreConfig('venustheme_blog/general_setting/privatekey'), 
									   Mage::getStoreConfig("venustheme_blog/general_setting/publickey") )
							->getReCapcha();
				$check = $recaptcha->verify( $this->getRequest()->getParam('recaptcha_challenge_field'), 
											$this->getRequest()->getParam('recaptcha_response_field') )->isValid();
				if( !$check ){
					Mage::getSingleton( 'core/session') ->addError( $this->__("You put wrong captcha, please try again!!!") );
					$this->_redirectUrl( Mage::getModel('venustheme_blog/post')->load($this->getRequest()->getParam('id'))->getUrl() );
					return ;
				}
			 }
			if (!Zend_Validate::is(trim($data['user']) , 'NotEmpty')) { $check = false;	}
			if (!Zend_Validate::is(trim($data['email']) , 'NotEmpty')) { $check = false;	}
			if (!Zend_Validate::is(trim($data['comment']) , 'NotEmpty')) { $check = false;	}
		
	
			if( $check ){ 
				$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
				try {
					$active = Mage::getStoreConfig('venustheme_blog/general_setting/comment_publish') ;
					Mage::getModel( 'venustheme_blog/comment' )->setData( $data )
						->setPostId( $this->getRequest()->getParam('id') )
						->setCreated( $todayDate )
						->setIsActive( $active )
						->save();
					Mage::getSingleton('core/session')->addSuccess( 'Your comment added, it will be published very soon.' );	
				} catch (Exception $e) {
					Mage::getSingleton( 'core/session') ->addError( $e->getMessage() );
				}
			}	
			//echo '<pre>'.print_r( $data, 1 ); die;
		}
		
		$this->_redirectUrl( Mage::getModel('venustheme_blog/post')->load($this->getRequest()->getParam('id'))->getUrl() );
	}
	public function viewAction(){
		
		$this->loadLayout();
 	
		$this->renderLayout();
	// 	Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
	}
}
?>