<?php
defined('_JEXEC') or die;
/*
 * @package    miniOrange
 * @subpackage Plugins
 * @license    GNU/GPLv3
 * @copyright  Copyright 2015 miniOrange. All Rights Reserved.
*/
	class Mo_saml_Auth_Response{

		public $status;

		public $statusMessage;

		public $userDn;

		public $attributeList;

		public $profileAttributesList;

		public function __construct(){
			//Empty constructor
		}

	}

?>