<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 /*
 * @package    miniOrange
 * @subpackage Plugins
 * @license    GNU/GPLv3
 * @copyright  Copyright 2015 miniOrange. All Rights Reserved.
*/
jimport( 'joomla.plugin.plugin' );
 
/**
 * miniOrange SAML System plugin
 */
class plgSystemSamlredirect extends JPlugin
{
	
	public function onAfterRoute(){
		
		$user = JFactory::getUser();
		$app = JFactory::getApplication('site');
		$app->initialise();
		if (!$app->isAdmin()){
			if(!$user->id) {
				jimport('miniorangesamlplugin.utility.Utilities');
		
				$customerResult = Utilities::getCustomerDetails();
				
			}
		}   
	}
	
	public function onAfterInitialise()
	{
		$get = JFactory::getApplication()->input->get->getArray();
		$post = JFactory::getApplication()->input->post->getArray();
		
		jimport('miniorangesamlplugin.utility.Utilities');
		


		 if(isset($post['mojsp_feedback']))
        {

            jimport('miniorangesamlplugin.utility.Utilities');



            $radio=$post['deactivate_plugin'];
            $data=$post['query_feedback'];
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            // Fields to update.
            $fields = array(
                $db->quoteName('uninstall_feedback') . ' = ' . $db->quote(1)
            );

            // Conditions for which records should be updated.
            $conditions = array(
                $db->quoteName('id') . ' = 1'
            );

            $query->update($db->quoteName('#__miniorange_saml_config'))->set($fields)->where($conditions);
            $db->setQuery($query);
            $result = $db->execute();


            $current_user =  JFactory::getUser();
            //$result = Utilities::getCustomerDetails();

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(array('*'));
            $query->from($db->quoteName('#__miniorange_saml_customer_details'));
            $query->where($db->quoteName('id')." = 1");
            $db->setQuery($query);
            $customerResult = $db->loadAssoc();

            $admin_email = $customerResult['email'];
            $admin_phone = $customerResult['admin_phone'];


            $data1 = $radio.' : '.$data;

            require_once JPATH_BASE . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_miniorange_saml' . DIRECTORY_SEPARATOR . 'helpers' .DIRECTORY_SEPARATOR . 'mo-saml-customer-setup.php';

            Mo_saml_Local_Customer::submit_feedback_form($admin_email,$admin_phone,$data1);



            require_once JPATH_SITE . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Installer' .DIRECTORY_SEPARATOR . 'Installer.php';


			foreach ($post['result'] as $fbkey) {



            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('type');
            $query->from('#__extensions');
            $query->where($db->quoteName('extension_id') . " = " . $db->quote($fbkey));
            $db->setQuery($query);
            $result = $db->loadColumn();

            

                $identifier=$fbkey;

$type=0;
                 foreach ($result as $results){
                        
                    $type=$results;
                }
           
           if($type){

            $cid=0;

            $installer = new JInstaller();
            $installer->uninstall ($type,$identifier,$cid);

           }

}

 
        }
		if (isset($get['morequest']) && $get['morequest']=='sso') {
			$pluginconfig = Utilities::getSAMLConfiguration();
			$this->sendSamlRequest($pluginconfig);
		}
		else if (isset($get['morequest']) && $get['morequest']=='metadata') {
			$pluginconfig = Utilities::getSAMLConfiguration();
			$this->generateMetadata($pluginconfig);
		} else if (isset($get['morequest']) && $get['morequest']=='acs') {
			$pluginconfig = Utilities::getSAMLConfiguration();
			$this->getSamlResponse($pluginconfig);
		} else if (isset($get['q']) && $get['q']=='ex') {
            //echo "here";

          $this->miniorangeExport();
            // $pluginconfig = Utilities::getSAMLConfiguration();
            // $this->getSamlResponse($pluginconfig);
        } 
		
	}
	 function onExtensionBeforeUninstall($id){

	 $post = JFactory::getApplication()->input->post->getArray();


        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('extension_id');
        $query->from('#__extensions');

        $query->where($db->quoteName('name') . " = " . $db->quote('com_miniorange_saml' ));
        $db->setQuery($query);
        $result = $db->loadColumn();







        $tables = JFactory::getDbo()->getTableList();

	$tab=0;
        foreach ($tables as $table) {
            if(strpos($table,"miniorange_saml_config"))
                $tab=$table;
        }

        if($tab){

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('uninstall_feedback');
            $query->from('#__miniorange_saml_config');
            $query->where($db->quoteName('id') . " = " . $db->quote(1));
            $db->setQuery($query);
            $fid = $db->loadColumn();
           

            $tpostData = $post;



            foreach ($fid as $value) {

                if ($value == 0) {
                    foreach ($result as $results) {

                        if ($results == $id) {
                            ?>

                            <div class="mojsp_modal-content ">
                                <span class="mojsp_close">&times;</span>
                                <h3>What Happened? </h3>

                                <form name="f" method="post" action="" id="mojsp_feedback">
                                    <input type="hidden" name="mojsp_feedback" value="mojsp_feedback"/>
                                    <div>
                                        <p style="margin-left:2%">
                                            <?php
                                            $deactivate_reasons = array(
                                                "Facing issues During Registration",
                                                "Does not have the features I'm looking for",
                                                "Not able to Configure",
                                                "Other Reasons:"
                                            );


                                            foreach ($deactivate_reasons

                                            as $deactivate_reasons) { ?>

                                        <div class="radio" style="padding:1px;margin-left:2%">
                                            <label style="font-weight:normal;font-size:14.6px"
                                                   for="<?php echo $deactivate_reasons; ?>">
                                                <input type="radio" name="deactivate_plugin"
                                                       value="<?php echo $deactivate_reasons; ?>" required>
                                                <?php echo $deactivate_reasons; ?></label>
                                        </div>

                                        <?php } ?>
                                        <br>

                                        <textarea id="query_feedback" name="query_feedback" rows="4" style="margin-left:2%"
                                                  cols="50" placeholder="Write your query here"></textarea>


            
                    <?php
                    foreach($tpostData['cid']  as $key){ ?>
                    <input type="hidden" name="result[]" value=<?php echo $key ?>>

                    <?php   } ?>
                                        


                                        <br><br>
                                        <div class="mojsp_modal-footer">
                                            <input type="submit" name="miniorange_feedback_submit"
                                                   class="button button-primary button-large" value="Submit"/>
                                        </div>
                                    </div>
                                </form>
                                <form name="f" method="post" action="" id="mojsp_feedback_form_close">
                                    <input type="hidden" name="option" value="mojsp_skip_feedback"/>
                                </form>

                            </div>
                            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                            <script>


                                jQuery('input:radio[name="deactivate_plugin"]').click(function () {
                                    var reason = jQuery(this).val();
                                    jQuery('#query_feedback').removeAttr('required')

                                    if (reason == 'Facing issues During Registration') {
                                        jQuery('#query_feedback').attr("placeholder", "Can you please describe the issue in detail?");
                                    } else if (reason == "Does not have the features I'm looking for") {
                                        jQuery('#query_feedback').attr("placeholder", "Let us know what feature are you looking for");
                                    } else if (reason == "Other Reasons:") {
                                        jQuery('#query_feedback').attr("placeholder", "Can you let us know the reason for deactivation");
                                        jQuery('#query_feedback').prop('required', true);
                                    } else if (reason == "Not able to Configure") {
                                        jQuery('#query_feedback').attr("placeholder", "Not able to Configure? let us know so that we can improve the interface");
                                    }
                                });


                                // When the user clicks on <span> (x), mojsp_close the mojsp_modal
                                var span = document.getElementsByClassName("mojsp_close")[0];
                                span.onclick = function () {
                                    mojsp_modal.style.display = "none";
                                    jQuery('#mojsp_feedback_form_close').submit();

                                }


                            </script>
                            <style>
                                .mojsp_modal {
                                    display: none;
                                    position: fixed;
                                    z-index: 1;
                                    padding-top: 100px;
                                    left: 100px;
                                    top: 0;
                                    margin-left: 220px;
                                    width: 50%;
                                    height: 100%;

                                }

                                .mojsp_modal-content {
                                    background-color: #fefefe;
                                    margin: auto;
                                    padding: 20px;
                                    border: 1px solid #888;
                                    width: 55%;
                                }

                                .mojsp_close {
                                    color: #aaaaaa;
                                    float: right;
                                    font-size: 28px;
                                    font-weight: bold;
                                }

                                .mojsp_close:hover,
                                .mojsp_close:focus {
                                    color: #000;
                                    text-decoration: none;
                                    cursor: pointer;
                                }

                                .alert {
                                    padding: 5px;
                                    margin-bottom: 10px;
                                    border: 1px solid transparent;
                                    border-radius: 4px
                                }

                                .alert-info {
                                    color: #31708f;
                                    background-color: #d9edf7;
                                    border-color: #bce8f1
                                }
                            </style>

                            <?php
                            exit;
                        }
                    }
                }
            }

        }
    }

	function sendSamlRequest($pluginconfig){
		
		$get = JFactory::getApplication()->input->get->getArray();
		
		$sp_base_url = ""; 
		$sp_entity_id = "";
		
		$siteUrl = JURI::root();
		
		$sp_base_url = $siteUrl;
		
			$sp_entity_id = $siteUrl.'plugins/authentication/miniorangesaml/';
		
		if (!defined('_JDEFINES')) {
			require_once JPATH_BASE . '/includes/defines.php';
		}
		require_once JPATH_BASE . '/includes/framework.php';
			
		// Instantiate the application.
		$app = JFactory::getApplication('site');
		$app->initialise();
		$login_url = $sp_base_url;
		
		$user = JFactory::getUser(); #Get current user info
		
		$acsUrl = $sp_base_url . '?morequest=acs';
		$ssoUrl = $pluginconfig['single_signon_service_url'];
		$sso_binding_type = $pluginconfig['binding'];
		$name_id_format = $pluginconfig['name_id_format'];
				
		$sendRelayState = $this->getRelayState($sp_base_url, $_REQUEST);
		
		$samlRequest = Utilities::createAuthnRequest($acsUrl, $sp_entity_id, $ssoUrl, 'false', $sso_binding_type, $name_id_format);
		
	if(isset($get['q']))
        if($get['q']=="sso") {

            $this->mo_saml_show_SAML_log($samlRequest, "displaySAMLRequest");
        } 
        
       $samlRequest = Utilities::samlRequestBind($samlRequest, $sso_binding_type);
      

		$this->sendSamlRequestByBindingType($samlRequest, $sso_binding_type, $sendRelayState,  $ssoUrl);
	}


      public static function mo_saml_show_SAML_log($samlRequestResponceXML,$type){
        //echo "here";

        header("Content-Type: text/html");
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($samlRequestResponceXML);
      
        if($type=='displaySAMLRequest')
            $show_value='SAML Request';
        else
        $show_value='SAML Response';
        $out = $doc->saveXML();

        $out1 = htmlentities($out);
        $out1 = rtrim($out1);
     
        $xml   = simplexml_load_string( $out );
       
        $json  = json_encode( $xml );
       
        $array = json_decode( $json );

       
     echo '<link rel="stylesheet" type="text/css" href="' . JURI::root() . 'media/com_miniorange_saml/css/style_settings.css"/>

        
            
            <div class="mo-display-logs" ><p type="text"   id="SAML_type">'.$show_value.'</p></div>
            
            <div type="text" id="SAML_display" class="mo-display-block"><pre class=\'brush: xml;\'>'.$out1.'</pre></div>
            <br>
            <div style="margin:3%;display:block;text-align:center;">
            
            <div style="margin:3%;display:block;text-align:center;" >
    
            </div>
            <button id="copy" onclick="copyDivToClipboard()"  style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;" >Copy</button>
            &nbsp;
               <input id="dwn-btn" style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="button" value="Download" 
               ">
            </div>
            </div>
            
        ';

        ob_end_flush();?>

        <script>

            function copyDivToClipboard() {
                var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById("SAML_display").textContent);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");
                document.body.removeChild(aux);
                document.getElementById('copy').textContent = "Copied";
                document.getElementById('copy').style.background = "grey";
                window.getSelection().selectAllChildren( document.getElementById( "SAML_display" ) );
            }

            function download(filename, text) {
                var element = document.createElement('a');
                element.setAttribute('href', 'data:Application/octet-stream;charset=utf-8,' + encodeURIComponent(text));
                element.setAttribute('download', filename);

                element.style.display = 'none';
                document.body.appendChild(element);

                element.click();

                document.body.removeChild(element);
            }

            document.getElementById("dwn-btn").addEventListener("click", function () {

                var filename = document.getElementById("SAML_type").textContent+".xml";
                var node = document.getElementById("SAML_display");
                htmlContent = node.innerHTML;
                text = node.textContent;
                console.log(text);
                download(filename, text);
            }, false);

        </script>
        <?php
        exit;
    }

	
	function sendSamlRequestByBindingType($samlRequest, $sso_binding_type, $sendRelayState, $ssoUrl){
		
		if(empty($sso_binding_type) || $sso_binding_type == 'HttpRedirect') {
						
			$samlRequest = "SAMLRequest=" . $samlRequest . "&RelayState=" . $sendRelayState;
			
			$param =array( 'type' => 'private');
			
			$redirect = $ssoUrl;
			if (strpos($ssoUrl,'?') !== false) {
				$redirect .= '&';
			} else {
				$redirect .= '?';
			}
			$redirect .=  $samlRequest;
			
			header('Location: '.$redirect);
			exit();
			
		}else{
			
			
			$base64EncodedXML = Utilities::signXML( $samlRequest, $publicCertPath, $privateKeyPath, 'NameIDPolicy' );
			Utilities::postSAMLRequest($ssoUrl, $samlRequest, $sendRelayState);
						
		}
	}
	
	function getRelayState($sp_base_url, $request){
		
		$sendRelayState = $sp_base_url;
		
		if(isset($request['q'])) {
			if($request['q'] == 'test_config'){
				$sendRelayState = 'testValidate';
			}
		}
		
		else if(isset($request['RelayState']) && $request['RelayState'] != '/' && $request['RelayState'] != ''){
			$sendRelayState = $request['RelayState'];
		}
		
		else if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''){
			$sendRelayState = $_SERVER['HTTP_REFERER'];
		}
		
		
		
		return $sendRelayState;
	}
	
	function getSamlResponse($pluginconfig){

		$post = JFactory::getApplication()->input->post->getArray();
        


		if (!defined('_JDEFINES')) {
			require_once JPATH_BASE . '/includes/defines.php';
		}
		require_once JPATH_BASE . '/includes/framework.php';
		
		$authBase = JPATH_BASE. DIRECTORY_SEPARATOR. 'plugins'. DIRECTORY_SEPARATOR. 'authentication' . DIRECTORY_SEPARATOR .		 'miniorangesaml';
		include_once $authBase . DIRECTORY_SEPARATOR  . 'saml2' . DIRECTORY_SEPARATOR. 'Response.php';
		
		jimport('miniorangesamlplugin.utility.encryption');
		jimport ( 'joomla.application.application' );
		jimport ( 'joomla.html.parameter' );
		
		$sp_base_url = ""; 
		$sp_entity_id = "";
		if(isset($pluginconfig['sp_base_url'])){
			$sp_base_url= $pluginconfig['sp_base_url'];
			$sp_entity_id = $pluginconfig['sp_entity_id'];
		}
		
		$siteUrl = JURI::root();
		
		if(empty($sp_base_url))
			$sp_base_url = $siteUrl;
		if(empty($sp_entity_id))
			$sp_entity_id = $siteUrl.'plugins/authentication/miniorangesaml/';
		
		$app = JFactory::getApplication('site');
		$app->initialise();
		$get = JFactory::getApplication()->input->get->getArray();
      
		if (array_key_exists ( 'SAMLResponse', $post )) {

			$this->validateSamlResponse($post, $sp_base_url, $sp_entity_id, $pluginconfig, $app);
		}else{
			throw new Exception ( 'Missing SAMLRequest or SAMLResponse parameter.' );
		}
	}
	
	function validateSamlResponse($post, $sp_base_url, $sp_entity_id, $attribute, $app) {
		
		$samlResponse = $post ['SAMLResponse'];
	//  echo "here"; echo $samlResponse;

		if (array_key_exists ( 'RelayState', $_REQUEST ) && ($_REQUEST['RelayState'] != '') && ($_REQUEST['RelayState'] != '/')) {
			$relayState = $_REQUEST ['RelayState'];
		} else {
			$relayState = $sp_base_url;
		}
		
		$samlResponse = base64_decode ( $samlResponse );
       

		$document = new DOMDocument ();
		$document->loadXML ( $samlResponse );
		$samlResponseXml = $document->firstChild;
		
		$doc = $document->documentElement;
		$xpath = new DOMXpath($document);
		$xpath->registerNamespace('samlp', 'urn:oasis:names:tc:SAML:2.0:protocol');
		$xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');
		
		$status = $xpath->query('/samlp:Response/samlp:Status/samlp:StatusCode', $doc);
		$statusString = $status->item(0)->getAttribute('Value');
		$statusChildString = '';
		if($status->item(0)->firstChild !== null){
			$statusChildString = $status->item(0)->firstChild->getAttribute('Value');
		}
		
		$stat = explode(":",$statusString);
		$status = $stat[7];
		
        if($relayState=="response") {

            $this->mo_saml_show_SAML_log($samlResponse, "displaySAMLResponse");
        } 

		if($status!="Success"){
			if(!empty($statusChildString)){
				$stat = explode(":", $statusChildString);
				$status = $stat[7];
			}
			$this->show_error_message($status, $relayState);
		}
		
		
		$acsUrl = $sp_base_url . '?morequest=acs';
		
		$certFromPlugin = $attribute['certificate'];
		if(!empty($certFromPlugin)){
			$certFromPlugin = Utilities::sanitize_certificate ( $certFromPlugin );
		}
		$certfpFromPlugin = XMLSecurityKey::getRawThumbprint ( $certFromPlugin );
		$samlResponse = new SAML2_Response ( $samlResponseXml );
		
		$responseSignatureData = $samlResponse->getSignatureData();
			
		$assertionSignatureData = current($samlResponse->getAssertions())->getSignatureData();
		/* convert to UTF-8 character encoding */
		$certfpFromPlugin = iconv ( "UTF-8", "CP1252//IGNORE", $certfpFromPlugin );
				
		/* remove whitespaces */
		$certfpFromPlugin = preg_replace ( '/\s+/', '', $certfpFromPlugin );
		
		// /* Validate signature */
			if(!empty($certfpFromPlugin)) {
		if(!empty($responseSignatureData)) {
				$validSignature = Utilities::processResponse($acsUrl, $certfpFromPlugin, $responseSignatureData, $samlResponse, $certFromPlugin, $relayState);
				if($validSignature === FALSE) {
					echo "Invalid signature in the SAML Response.<br><br>";
					exit;
				}
		}
			
		if(!empty($assertionSignatureData)) {
				$validSignature = Utilities::processResponse($acsUrl, $certfpFromPlugin, $assertionSignatureData, $samlResponse, $certFromPlugin, $relayState);
				if($validSignature === FALSE) {
					echo "Invalid signature in the SAML Assertion.<br><br>";
					exit;
				}
		}
			}
		
		// if(empty($assertionSignatureData) && empty($responseSignatureData) ) {
			// if(!empty($certFromPlugin)){
				// echo "No signature in SAML Response or Assertion.";
				// exit;
			// }
		// }
		
		// verify the issuer and audience from saml response
		$issuer = $attribute['idp_entity_id']; 
				
		Utilities::validateIssuerAndAudience ( $samlResponse, $sp_entity_id, $issuer, $relayState);
		
		$username = current ( current ( $samlResponse->getAssertions () )->getNameId () );
		$attrs = current ( $samlResponse->getAssertions () )->getAttributes ();
		$attrs ['NameID'] = current ( current ( $samlResponse->getAssertions () )->getNameId () );
		
		if($relayState=='testValidate'){
			Utilities::mo_saml_show_test_result($username,$attrs,$sp_base_url);
		}
					
		$sessionIndex = current ( $samlResponse->getAssertions () )->getSessionIndex ();
		$attrs ['ASSERTION_SESSION_INDEX'] = $sessionIndex;
		
		$email = $username;
		$name = '';
		$saml_groups = '';
		
		$NameMapping = (string) $attribute['name'];
		$usernameMapping = $attribute['username'];
		$mailMapping = $attribute['email'];
		
		if (!empty($usernameMapping) && isset($attrs[$usernameMapping]) && !empty($attrs[$usernameMapping])) {
			$username = $attrs[$usernameMapping];
			if(is_array($username))
				$username = $username[0];
		}
		if (!empty($mailMapping) && isset($attrs[$mailMapping]) && !empty($attrs[$mailMapping])) {
			$email = $attrs[$mailMapping];
			if(is_array($email))
				$email = $email[0];
		}
		
		if (!empty($NameMapping) && isset($attrs[$NameMapping]) && !empty($attrs[$NameMapping])) {
			$name = $attrs[$NameMapping];
		
		}
			if(is_array($name)){
				$name = $name[0];
		}
	
		if (!empty($groupsMapping) && isset($attrs[$groupsMapping]) && !empty($attrs[$groupsMapping])) {
			$saml_groups = $attrs[$groupsMapping];
		} else {
			$saml_groups = array();
		}
		
		if(isset($attribute['enable_email']) && $attribute['enable_email']==0){
			$matcher = 'username';
		}else{
			$matcher = 'email';
		}
		
		
		$result = Utilities::get_user_from_joomla($matcher,$username,$email);
		
		$login_url = isset($relayState) ? $relayState : $sp_base_url;
		
		if($result){
			$this->loginCurrentUser($result, $attrs, $login_url, $name, $username, $email, $matcher, $app);
		}else{
			$this->RegisterCurrentUser($attrs, $login_url, $name, $username, $email, $saml_groups, $matcher, $app);
		}
		
	}
	
	function loginCurrentUser($result, $attrs, $login_url, $name, $username, $email, $matcher, $app){
		
		$user = JUser::getInstance($result->id);
		
		
		Utilities::updateCurrentUserName($user->id, $name);
		
		$role_mapping = Utilities::getRoleMapping();
		
		if(isset($role_mapping['enable_saml_role_mapping']))
		{
			if($role_mapping['enable_saml_role_mapping']==1)
				$enable_rolemapping=1;
			else
				$enable_rolemapping=0;
			
		}else{
			$enable_rolemapping=0;
		}
		
		jimport('joomla.user.helper'); 
		if($enable_rolemapping){
			
			if(isset($role_mapping['mapping_value_default']))
					$default_group = $role_mapping['mapping_value_default'];
		
				JUserHelper::addUserToGroup($user->id, $default_group);
				
				foreach($user->groups as $existinggroup){
					if($existinggroup!=$default_group && $existinggroup!=7 && $existinggroup!=8 )
						JUserHelper::removeUserFromGroup($user->id, $existinggroup);
				}
				
				
		}

		
		
		//$this->updateUserProfileAttributes($user->id, $attrs, $user_profile_attributes);
		
		$session = JFactory::getSession(); #Get current session vars
		// Register the needed session variables
		$session->set('user', $user);
		$session->set('MO_SAML_NAMEID', isset($attrs['NAME_ID'])? $attrs['NAME_ID']:'');
		$session->set('MO_SAML_SESSION_INDEX',isset($attrs['ASSERTION_SESSION_INDEX'])? $attrs['ASSERTION_SESSION_INDEX']:'');
		
		$app->checkSession();
		$sessionId = $session->getId();
		Utilities::updateUsernameToSessionId($user->id,$user->username, $sessionId);
		
		$user->setLastVisit();
		
			$app->redirect(urldecode($login_url));
		
	}
	
	function show_error_message($statusCode, $relayState){
		if($relayState=='testValidate'){

			echo '<div style="font-family:Calibri;padding:0 3%;">';
			echo '<div style="color: #a94442;background-color: #f2dede;padding: 15px;margin-bottom: 20px;text-align:center;border:1px solid #E6B3B2;font-size:18pt;"> ERROR</div>
			<div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong> Invalid SAML Response Status.</p>
			<p><strong>Causes</strong>: Identity Provider has sent \''.$statusCode.'\' status code in SAML Response. </p>
							<p><strong>Reason</strong>: '.$this->get_status_message($statusCode).'</p><br>
			</div>

			<div style="margin:3%;display:block;text-align:center;">
			<div style="margin:3%;display:block;text-align:center;"><input style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="button" value="Done" onClick="self.close();"></div>';
							exit;
		  }
		  else{
				if($statusCode == 'RequestDenied' ){
					echo 'You are not allowed to login into the site. Please contact your Administrator.';
					exit;
				}else{
					echo 'We could not sign you in. Please contact your Administrator.';
					exit;
				}

		  }
	}
	
	function get_status_message($statusCode){
		switch($statusCode){
			case 'RequestDenied':
				return 'You are not allowed to login into the site. Please contact your Administrator.';
				break;
			case 'Requester':
				return 'The request could not be performed due to an error on the part of the requester.';
				break;
			case 'Responder':
				return 'The request could not be performed due to an error on the part of the SAML responder or SAML authority.';
				break;
			case 'VersionMismatch':
				return 'The SAML responder could not process the request because the version of the request message was incorrect.';
				break;
			default:
				return 'Unknown';
		}
	}
	
	function generateMetadata($attribute){
		
		$sp_base_url = ""; 
		$sp_entity_id = "";
		$name_id_format = "";
		if(isset($attribute['sp_base_url'])){
			$sp_base_url= $attribute['sp_base_url'];
			$sp_entity_id = $attribute['sp_entity_id'];
			$name_id_format = $attribute['name_id_format'];
		}
		
		$siteUrl = JURI::root();
		
		if(empty($sp_base_url))
			$sp_base_url = $siteUrl;
		if(empty($sp_entity_id))
			$sp_entity_id = $siteUrl.'plugins/authentication/miniorangesaml/';
		
		$acs_url = $sp_base_url . '?morequest=acs';
		$logout_url =  $sp_base_url.'index.php?option=com_users&amp;task=logout';
		
		$certificate = JPATH_BASE . DIRECTORY_SEPARATOR. 'plugins'. DIRECTORY_SEPARATOR. 'authentication' . DIRECTORY_SEPARATOR . 'miniorangesaml' . DIRECTORY_SEPARATOR . 'saml2' . DIRECTORY_SEPARATOR .'cert' . DIRECTORY_SEPARATOR . 'sp-certificate.crt';
		
		$certificate = file_get_contents( $certificate );
		$certificate = Utilities::desanitize_certificate($certificate);
		header('Content-Type: text/xml');
		echo '<?xml version="1.0"?>
		<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata" validUntil="2020-10-28T23:59:59Z" cacheDuration="PT1446808792S" entityID="' . $sp_entity_id . '">
		  <md:SPSSODescriptor AuthnRequestsSigned="false" WantAssertionsSigned="true" protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">
			<md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified</md:NameIDFormat>
			<md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress</md:NameIDFormat>
			<md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:transient</md:NameIDFormat>
			<md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" Location="' . $acs_url . '" index="1"/>
		  </md:SPSSODescriptor>
		  <md:Organization>
			<md:OrganizationName xml:lang="en-US">miniOrange</md:OrganizationName>
			<md:OrganizationDisplayName xml:lang="en-US">miniOrange</md:OrganizationDisplayName>
			<md:OrganizationURL xml:lang="en-US">http://miniorange.com</md:OrganizationURL>
		  </md:Organization>
		  <md:ContactPerson contactType="technical">
			<md:GivenName>miniOrange</md:GivenName>
			<md:EmailAddress>info@xecurify.com</md:EmailAddress>
		  </md:ContactPerson>
		  <md:ContactPerson contactType="support">
			<md:GivenName>miniOrange</md:GivenName>
			<md:EmailAddress>info@xecurify.com</md:EmailAddress>
		  </md:ContactPerson>
		</md:EntityDescriptor>';
		exit();
	}

	function RegisterCurrentUser($attrs, $login_url, $name, $username, $email, $saml_groups, $matcher, $app){
		
		$role_mapping = Utilities::getRoleMapping();
		$default_group  = 2;
		if(isset($role_mapping['mapping_value_default']))
			$default_group = $role_mapping['mapping_value_default'];
		
		$role_mapping_key_value = array();
		if(isset($role_mapping['role_mapping_key_value']))
			$role_mapping_key_value = json_decode($role_mapping['role_mapping_key_value']);
		
		$enable_saml_role_mapping = 0;
		if(isset($role_mapping['enable_saml_role_mapping']))
			$enable_saml_role_mapping = json_decode($role_mapping['enable_saml_role_mapping']);
		
		// user data
		$data['name'] = (isset($name) && !empty($name)) ? $name : $username;
		$data['username'] = $username;
		$data['email'] = $data['email1'] = $data['email2'] = JStringPunycode::emailToPunycode($email);
		$data['password'] = $data['password1'] = $data['password2'] = JUserHelper::genRandomPassword();
		$data['activation'] = '0';
		$data['block'] = '0';
		
		if($enable_saml_role_mapping==1){
			$groups = Utilities::get_mapped_groups($role_mapping_key_value , $saml_groups);
			if (empty($groups)) {
				$data['groups'][] = $default_group;
			}else{
				foreach ($groups as $group) {
					$data['groups'][] = $group;
				}
			}
		}
		
		// Get the model and validate the data.
		jimport('joomla.application.component.model');

		if (!defined('JPATH_COMPONENT')) {
			define('JPATH_COMPONENT', JPATH_BASE . '/components/');
		}
		
		$user = new JUser;
		//Write to database
		if(!$user->bind($data)) {
			//print_r($user->getError());exit;
			throw new Exception("Could not bind data. Error: " . $user->getError());
		}
		if (!$user->save()) {
			//print_r($user->getError());exit;
			$siteUrl = JURI::root();
			ob_end_clean();
			$siteUrl = $siteUrl. '/plugins/authentication/miniorangesaml/';
			echo '<div style="font-family:Calibri;padding:0 3%;">';
			echo '<div style="color: #a94442;background-color: #f2dede;padding: 15px;margin-bottom: 20px;text-align:center;border:1px solid #E6B3B2;font-size:18pt;">
			<img style="width:15;"src="'. $siteUrl . 'images/wrong.png"> ERROR</div>
			<div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>Could not save user. '. $user->getError().'</p>
			<p>You are receiving this error because your email address is invalid.</p>
			<p>If you have checked your email address and the error still persists then please report following error to your System Administrator:
					<ul>
					<li>Attribute name for e-mail should be NAME_ID only.</li>
					<li>Please change the attribute name in your IdP.</li> <li>You can Upgrade to <b>Premium</b> version if you wish to create custom attribute name for e-mail.</li></ul>
					</p>

				</div>
				<div style="text-align:center;"><a href="index.php" target="_blank">Back to Home</a></div>';
			exit;
			
		}
		
		
		//Utilities::updateActivationStatusForUser($username);
		
		$result = Utilities::get_user_from_joomla($matcher,$username,$email);
		if($result){
			$user = JUser::getInstance($result->id);
			
			//$this->updateUserProfileAttributes($user->id, $attrs, $user_profile_attributes);
			
			$session = JFactory::getSession(); #Get current session vars
			// Register the needed session variables
			$session->set('user',$user);
			$session->set('MO_SAML_NAMEID', $attrs['NAME_ID']);
			$session->set('MO_SAML_SESSION_INDEX', $attrs['ASSERTION_SESSION_INDEX']);
			
			$app->checkSession();
			$sessionId = $session->getId();
			Utilities::updateUsernameToSessionId($user->id,$user->username, $sessionId);
			
			/* Update Last Visit Date */
			$user->setLastVisit();
			$app->redirect(urldecode($login_url), "Welcome $user->username", 'message');
		}
		
	}
	
/*	
public function miniorangeExport(){
   
//require_once JPATH_BASE . 'plugins/system/samlredirect/miniorange_saml_enum.php';
include 'miniorange_saml_enum.php';

// require_once JPATH_BASE . '/includes/defines.php';
    $tab_class_name      = new Initialize(JURI::root());
    //print_r($tab_class_name->idpOptions->miniorange_saml_sp_issuer);exit;
    
    $configuration_array = array();
    foreach ( $tab_class_name as $key => $value ) {
        $configuration_array[ $key ] = $this->mo_get_configuration_array( $value );
    }

    $configuration_array["Version_dependencies"]=$this->mo_get_version_informations();


    header( "Content-Disposition: attachment; filename=miniorange-saml-config.json" );
    echo( json_encode( $configuration_array, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) );
    exit;
}
function mo_get_configuration_array( $obj ) {
     
    $mo_array = array();

    foreach ( $obj as $key => $value ) {
        //echo "$key => $value\n";
        //$mo_option_exists=variable_get($value);
        if($value){
            if(@unserialize($value)!==false){
                $value = unserialize($value);
            }
            $mo_array[ $key ] = $value;
        }
    }
    return $mo_array;
}
*/
function mo_get_version_informations(){
    $array_version = array();
    $array_version["PHP_version"] = phpversion();
    //$array_version["Drupal_version"] = VERSION;
    $array_version["OPEN_SSL"] = $this->mo_saml_is_openssl_installed();
    $array_version["CURL"] = $this->mo_saml_is_curl_installed();
    $array_version["ICONV"] = $this->mo_saml_is_iconv_installed();
    $array_version["DOM"] = $this->mo_saml_is_dom_installed();

    return $array_version;
}


function mo_saml_is_openssl_installed() {
    if ( in_array( 'openssl', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_curl_installed() {
    if ( in_array( 'curl', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_iconv_installed(){

    if ( in_array( 'iconv', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_dom_installed(){

    if ( in_array( 'dom', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

}