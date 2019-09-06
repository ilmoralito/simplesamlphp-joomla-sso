<?php
defined('_JEXEC') or die;
/*
 * @package    miniOrange
 * @subpackage Plugins
 * @license    GNU/GPLv3
 * @copyright  Copyright 2015 miniOrange. All Rights Reserved.
*/
    JHtml::_('stylesheet', JUri::root() . 'media/com_miniorange_saml/css/miniorange_saml.css');
    JHtml::stylesheet(JURI::base() . 'components/com_miniorange_saml/assets/css/mo_saml_style.css', array(), true);
    JHtml::stylesheet(JURI::base() . 'components/com_miniorange_saml/assets/css/bootstrap-tour-standalone.css', array(), true);
    JHtml::script(JURI::base() . 'components/com_miniorange_saml/assets/js/bootstrap-tour-standalone.min.js');
    JHtml::script(JURI::base() . 'components/com_miniorange_saml/assets/js/jeswanth.js');
	JHtml::stylesheet('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), true);
?>
<h2>miniOrange Saml Single Sign-On</h2><input type="button" onclick="window.open('https://faq.miniorange.com/kb/joomla-saml/')" target="_blank" value="FAQ's"  style= " float: right;  margin-right: 25px;" class="btn btn-medium btn-success" />
  <input type="button" id="sp_ot_tourend" value="Start Plugin Tour" onclick="restart_tourot();" style= " float: right;  margin-right: 10px;" class="btn btn-medium btn-danger"/>
<?php
    if(!Mo_Saml_Local_Util::is_curl_installed()) {
        ?>
        
        <div id="help_curl_warning_title" class="mo_saml_title_panel">
            <p><a target="_blank" style="cursor: pointer;"><font color="#FF0000">Warning: PHP cURL extension is not installed or disabled. <span style="color:blue">Click here</span> for instructions to enable it.</font></a></p>
        </div>
        <div hidden="" id="help_curl_warning_desc" class="mo_saml_help_desc">
                <ul>
                    <li>Step 1:&nbsp;&nbsp;&nbsp;&nbsp;Open php.ini file located under php installation folder.</li>
                    <li>Step 2:&nbsp;&nbsp;&nbsp;&nbsp;Search for <b>extension=php_curl.dll</b> </li>
                    <li>Step 3:&nbsp;&nbsp;&nbsp;&nbsp;Uncomment it by removing the semi-colon(<b>;</b>) in front of it.</li>
                    <li>Step 4:&nbsp;&nbsp;&nbsp;&nbsp;Restart the Apache Server.</li>
                </ul>
                For any further queries, please <a href="mailto:info@xecurify.com">contact us</a>.                                
        </div>
                
        <?php
    }
    
$tab = "idp";
$get = JFactory::getApplication()->input->get->getArray();
if(isset($get['tab']) && !empty($get['tab'])){
    $tab = $get['tab'];
}
?>


<p>If you are looking for an Identity Provider,you can try out <a href="https://idp.miniorange.com" target="_blank">miniOrange On-Premise IdP</a></p>
      <script>
                          function restart_tourot() {
							  
							  jQuery('.nav-tabs a[href=#identity-provider]').tab('show');  
                             tourot.restart();
                          }
                      </script>
				  
    <script>


 var base_url = '<?php echo JURI::root();?>';
    
            var tourot = new Tour({
                name: "tourot",
                steps: [
					{
                        element: "#mo_saml_support_idp",
                        title: "Contact Us",
                        content: "Feel free to contact us for any queries or issues regarding plugin. We will help you with configuration too.",
                        backdrop:'body',
                        backdropPadding:'6',
                        
                        
                    },{
                        element: "#idptab",
                        title: "IDP Configuration",
                        content: "Configure this tab using IDP information which you get form IDP-Metadata XML",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){                         
                            jQuery('.nav-tabs a[href=#description]').tab('show');  
                        },
                        
                        

                    },
					{
                        element: "#descriptiontab",
                        title: "Service Provider Info",
                        content: "This tab provides details to configure your IDP.",
                        backdrop:'body',
                        backdropPadding:'6',
                        onPrev: function(){
                            jQuery('.nav-tabs a[href=#identity-provider]').tab('show');   
                        },
						onNext: function(){
                            jQuery('.nav-tabs a[href=#service-provider]').tab('show');   
                        }
                        

                    },{
                        element: "#ssotab",
                        title: "Single Sign on Settings",
                        content: "You will get the information like SSO link, auto redirect option and more",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){
                            jQuery('.nav-tabs a[href=#licensing-plans]').tab('show');   
                        },
                        onPrev: function(){                         
                            jQuery('.nav-tabs a[href=#description]').tab('show');   
                        }


                    },{
                        element: "#licensingtab",
                        title: "Licensing.",
                        content: " You can find premium features and could upgrade to our premium plans.",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){
                            jQuery('.nav-tabs a[href=#identity-provider]').tab('show');  							
                        },
                        onPrev: function(){                         
                            jQuery('.nav-tabs a[href=#service-provider]').tab('show');   
                        }
                        
                    },
					  {
                        element: "#sp_ot_tourend",
                        title: "Overall Tour Button",
                        content: "Click here to know what each tab does.",
                        backdrop:'body',
                        backdropPadding:'6',
                       onPrev: function(){                          
                            jQuery('.nav-tabs a[href=#licensing-plans]').tab('show');   
                        }
                    },
                    ]
                    
                });
                
       // tabtour.init();
        //tabtour.start();    


</script>
    
     <script>
            var touratt = new Tour({
                name: "tour5",
                steps: [
                    {
                        element: "#mo_saml_uname",
                        title: "Username in Joomla Account",
                        content: "NameID attribute is used for storing Username and Email. Make sure IDP send email in NameID.",
                        backdrop:'body',
                        backdropPadding:'6',
                        
                    },{
                        element: "#mo_sp_attr_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

        

</script>
<script>
 var toursso = new Tour({
                name: "tour4",
                steps: [
                    {
                        element: "#mo_sp_sso_link_button",
                        title: "SSO login link",
                        content: "This link is used for Single Sign-On by end users. Add a button on your site login page with the following URL",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                       
                     {
                        element: "#mo_sp_sso_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

            
</script>
                        
<div class="form-horizontal">
    <ul class="nav nav-tabs" id="myTabTabs">
		<li id="idptab" <?php if($tab=="idp") echo 'class="active"';?>><a href="#identity-provider" data-toggle="tab" onclick="hide_metadata_form()">Service Provider Setup</a></li>
        <li id="descriptiontab" <?php if($tab=="description") echo 'class="active"';?>><a href="#description" data-toggle="tab">Service Provider Metadata</a></li>
       
        <li id="ssotab"<?php if($tab=="sso_settings") echo 'class="active"';?>><a href="#service-provider" data-toggle="tab">Redirection & SSO Links</a></li>
        <li id="attributemappingtab"<?php if($tab=="attribute_mapping") echo 'class="active"';?>><a href="#attribute-mapping" data-toggle="tab">Attribute Mapping</a></li>
        <li id="groupmappingtab" <?php if($tab=="group_mapping") echo 'class="active"';?>><a href="#group-mapping" data-toggle="tab">Group Mapping</a></li>
        <li id="importexporttab" <?php if($tab=="import_export") echo 'class="active"';?>><a href="#import-export" data-toggle="tab">Import/Export Configuration</a></li>
        
        <li id="licensingtab" <?php if($tab=="licensing") echo 'class="active"';?>><a href="#licensing-plans" data-toggle="tab">Licensing Plan</a></li>
		<li id="registrationtab" <?php if($tab=="account") echo 'class="active"';?>><a  href="#account" data-toggle="tab">My Account</a></li>
   </ul>
    <div class="tab-content" id="myTabContent">
        <script>


    var tourprx = new Tour({
                name: "tour8",
                steps: [
                                                 
                     {
                        element: "#mo_sp_proxy_config",
                        title: "Host Name",
                        content: "You could configure your proxy settings here inorder to connect to internet. ",
                        backdrop:'body',
                        backdropPadding:'6',
                        
                    },
                     {
                        element: "#mo_sp_proxy_reset",
                        title: "Rest Configuration",
                        content: "Click here to restart proxy configuration",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#sp_prx_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

</script>   
        

<script>
 var tourds = new Tour({
                name: "tour",
                steps: [
					{
                        element: "#metadata-link",
                        title: "Metadata Link",
                        content: "You could use this metadata link to configure the client in IDP",
                        backdrop:'body',
                        backdropPadding:'6'
                        
                    },
                     {
                        element: "#mo_other_idp",
                        title: "EntityID/Issuer",
                        content: "You can use this configuration to configure your IDP",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#sp_ds_tourend",
                        title: "Tour End",
                        content: "Please click here to restart the tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    },

                ]});

            
</script>
<script>
var touridp = new Tour({
                name: "tour",
                steps: [
                    {
                        element: "#sp_upload_metadata",
                        title: "Upload Metadata",
                        content: "If you have a metadata URL or file provided by your IDP, click on the button or you can configure the plugin manually",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#sp_entity_id_idp",
                        title: "Entity ID",
                        content: "You can find the EntityID in Your IdP-Metadata XML file enclosed in EntityDescriptor tag having attribute as entityID.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                               
                     {
                        element: "#sp_sso_url_idp",
                        title: "Single Sign-On Service Url",
                        content: "You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in SingleSignOnService tag (Binding type: HTTP-Redirect)",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                           
                     {
                        element: "#sp_certificate_idp",
                        title: "X.509 Certificate",
                        content: "Public key of your IDP to read the signed SAML Assertion/Response",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                               
                     {
                        element: "#test-config",
                        title: "Test Configuration",
                        content: "It helps you to test the SSO and know what attributes are getting from IDP and configure them in attribute-mapping and Group-mapping Tab",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                              
                     {
                        element: "#idp_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

            
        
</script>

<script>

            var tourgrp = new Tour({
                name: "tour6",
                steps: [
                    {
                        element: "#mo_sp_grp_enable",
                        title: "Enable Group Mapping",
                        content: "Enable this option to assign the group to login user(including admin account)",
                        backdrop:'body',
                        backdropPadding:'6'
                    },{
                        element: "#mo_sp_grp_defaultgrp",
                        title: "Groups",
                        content: "Select the group to assign a default group while user creation.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },{
                        element: "#mo_sp_grp_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

            
        

</script>

<script>

 var tourexp = new Tour({
                name: "tour7",
                steps: [
                    {
                        element: "#mo_sp_exp_exportconfig",
                        title: "Export configuration",
                        content: "Click here to download the configuration file.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                               
                     {
                        element: "#mo_sp_exp_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

</script>

             <div id="account" class="tab-pane <?php if($tab=='account') echo 'active';?> ">
                 <table style="width:100%;">
                    <tr>
                        <td style="width:100%;vertical-align:top;" class="configurationForm">
                             <?php account_tab(); ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="description" class="tab-pane <?php if($tab=='description') echo 'active';?> ">
                 <table style="width:100%;">
                    <tr>
                        <td style="width:100%;vertical-align:top;" class="configurationForm">
                            <div class="mo_saml_table_layout_1">
                                 <div class="mo_saml_table_layout mo_saml_container">
                                    <?php description();?>
                                 </div>
                                 <div id="mo_saml_support1" class="mo_saml_table_layout_support_1">
                                    <?php mo_saml_local_support(); ?>
                                </div>
                        </td>
                    </tr>

                </table>
            </div>
            <div id="service-provider" class="tab-pane <?php if($tab=='sso_settings') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                    <div class="mo_saml_table_layout_1">
                        <div class="mo_saml_table_layout mo_saml_container">
                            <?php mo_sso_login();?>
                        </div>
                        <div id="mo_saml_support_login" class="mo_saml_table_layout_support_1">
                             <?php mo_saml_local_support(); ?>
                        </div>
                    </td>
                </tr>
             </table> 
            </div>
        </div>
        <div id="identity-provider" class="tab-pane <?php if($tab=='idp') echo 'active';?>">
            <div class="row-fluid">
			
              <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                    <div class="mo_saml_table_layout_1">
                        <div class="mo_saml_table_layout mo_saml_container">
                            <?php identity_provider_settings();?>
                        </div>
                       <div id="mo_saml_support_idp" class="mo_saml_table_layout_support_1">
                             <?php mo_saml_local_support(); ?>
                        </div>
                    </td>
					
                </tr>
             </table> 
            </div>
        </div>
        <div id="attribute-mapping" class="tab-pane <?php if($tab=='attribute_mapping') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                    <div class="mo_saml_table_layout_1">
                        <div class="mo_saml_table_layout mo_saml_container">
                            <?php attribute_mapping();?>
                        </div>
                        <div id="mo_saml_support_attr_mapping" class="mo_saml_table_layout_support_1">
                             <?php mo_saml_local_support(); ?>
                        </div>
                    </td>
                </tr>
             </table> 
            </div>
        </div>
        <div id="group-mapping" class="tab-pane <?php if($tab=='group_mapping') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                    <div class="mo_saml_table_layout_1">
                        <div class="mo_saml_table_layout mo_saml_container">
                            <?php group_mapping();?>
                        </div>
                        <div id="mo_saml_support_group_mapping" class="mo_saml_table_layout_support_1">
                             <?php mo_saml_local_support(); ?>
                        </div>
                    </td>
                </tr>
             </table> 
            </div>
        </div>
        <div id="import-export" class="tab-pane <?php if($tab=='import_export') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                    <tr>
                        <td style="width:65%;vertical-align:top;" class="configurationForm">
                        <div class="mo_saml_table_layout_1">
                            <div class="mo_saml_table_layout mo_saml_container">
                                <?php import_export();?>
                            </div>
                            <div id="mo_saml_support_import_export" class="mo_saml_table_layout_support_1">
                                <?php mo_saml_local_support(); ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="proxy-setup" class="tab-pane <?php if($tab=='proxy_setup') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                      <div class="mo_saml_table_layout_1">
                            <div class="mo_saml_table_layout mo_saml_container">
                                <?php proxy_setup();?>
                            </div>
                            <div id="mo_saml_support_proxy_setup" class="mo_saml_table_layout_support_1">
                                <?php mo_saml_local_support(); ?>
                            </div>
                    </td>
                </tr>
             </table> 
            </div>
        </div>
        <div id="licensing-plans" class="tab-pane <?php if($tab=='licensing') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">

                             <?php Licensing_page();?>

                    </td>
                </tr>
            </table> 
            </div>
        </div>
        <div id="help" class="tab-pane <?php if($tab=='troubleshooting') echo 'active';?>">
            <div class="row-fluid">
                <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" class="configurationForm">
                    <div class="mo_saml_table_layout_1">
                       <div class="mo_saml_table_layout mo_saml_container">
                            <?php help();?>
                       </div>
                       <div id="mo_saml_support_help" class="mo_saml_table_layout_support_1">
                            <?php mo_saml_local_support(); ?>
                       </div>
                    </td>
                </tr>
            </table>
            </div>
        </div>

    </div>
</div>

<script>
jQuery(document).ready(function() {

    jQuery('.premium').click(function() {
         jQuery('.nav-tabs a[href=#licensing-plans]').tab('show');   
    });
    
});
</script>

<?php  

function account_tab(){
    ?>
    
   <table  style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" id="registrationForm">
                        <?php 
                            $customer_details = Mo_Saml_Local_Util::getCustomerDetails();
                            $login_status = $customer_details['login_status'];
                            $registration_status = $customer_details['registration_status'];
                            
                            if($login_status){
                                mo_saml_local_login_page();
                            }else if($registration_status == 'MO_OTP_DELIVERED_SUCCESS' || $registration_status == 'MO_OTP_VALIDATION_FAILURE' || $registration_status == 'MO_OTP_DELIVERED_FAILURE'){
                            mo_saml_local_show_otp_verification();
                            }else if (! Mo_Saml_Local_Util::is_customer_registered()) {
                                mo_saml_local_registration_page();
                            }else{
                                mo_saml_local_account_page();
                            }
                        ?>
                    </td>
                </tr>
            </table>
    <?php
}

        
function mo_saml_local_login_page() {
        ?>
     <div class="mo_saml_table_layout_1">
        <div class="mo_saml_table_layout mo_saml_container">
            <form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.verifyCustomer');?>">
                <input type="hidden" name="option1" value="mo_saml_local_verify_customer" />
                <div>
                    <h3>Login with miniOrange</h3>
                    <div id="panel1">
                        <table class="mo_saml_settings_table">
                            <tr>
                                <td><b><font color="#FF0000">*</font>Email:</b></td>
                                <td><input class="mo_saml_table_textbox" type="email" name="email"required placeholder="person@example.com"value="" /></td>
                            </tr>
                            <tr>
                                <td><b><font color="#FF0000">*</font>Password:</b></td>
                                <td><input class="mo_saml_table_textbox" required type="password" name="password" placeholder="Enter your miniOrange password" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" class="btn btn-medium btn-success" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#cancel_link">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#mo_saml_local_forgot_password_link">Forgot your password?</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
            <form id="forgot_password_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.forgotPassword');?>">
                <input type="hidden" name="option1" value="user_forgot_password" />
            </form>
            <form id="cancel_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.cancelform');?>">
                <input type="hidden" name="option1" value="mo_saml_local_cancel" />
            </form>
            <script>
                jQuery('a[href=#cancel_link]').click(function(){
                    jQuery('#cancel_form').submit();
                });
                jQuery('a[href=#mo_saml_local_forgot_password_link]').click(function(){
                    jQuery('#forgot_password_form').submit();
                });
            </script>
        </div>
            <div class="mo_saml_table_layout_support_1">
            <?php echo mo_saml_local_support(); ?>
    </div>
		</div>
    <?php
}

function description(){
   
    $siteUrl = JURI::root();
    $sp_base_url= $siteUrl;
    $sp_entity_id=$siteUrl.'plugins/authentication/miniorangesaml/';
    ?>

        <input type="button" id="sp_ds_tourend" value="Start Tab Tour" onclick="restart_tourds();" style= " float: right;" class="btn btn-medium btn-success"/>
            <p>This Plugin acts as a SAML 2.0 Service Provider which can be configured to establish the trust between the plugin and various SAML 2.0 supported Identity Providers to securely authenticate the user to the Joomla site.</p><br>
                
        
        <script>
            function restart_tourds()
            {
                tourds.restart();
            }
        </script>
		
      

        <div>
            <div >
			
            <code id='metadata-link'>
                <?php echo 'Provide this metadata URL to your Identity Provider or open it and save as .xml file to upload it in your idp:'?><br></br>
                <a href='<?php echo $sp_base_url.'?morequest=metadata'; ?>' id='metadata-linkss' target='_blank'><?php echo '<b>' . $sp_base_url.'?morequest=metadata </b>';?></a>
		   </code>
            <br><br>
			<b><p class='text-center'>OR</p></b>
			 <div style="text-align: center"><b>You will need the following information to configure your IdP. Copy it and keep it handy:</b></div><br>
                <table id="mo_other_idp" class='table table-bordered table-hover table-striped'>
                   
                    <tr>
                                            <td style="width:40%"><b>SP-EntityID / Issuer</b></td>
                                            <td>						               
						                        <span id="sp_entityid"><?php echo $sp_entity_id;?></span>
                                                
												   <i class="fa fa-fw  fa-lg fa-copy mo_copy"; onclick="copyToClipboard('#sp_entityid');" style="color:red";  > </i>		
						                    </td>                                    
                                        </tr>
					<tr>
                                            <td><b>ACS (AssertionConsumerService) URL / Single Sign-On URL (SSO)</b></td>
                                            <td>						               
						                        <span id="acs_url"><?php echo $sp_base_url.'?morequest=acs';?></span>
                                                
												   <i class="fa fa-fw  fa-lg fa-copy mo_copy"; onclick="copyToClipboard('#acs_url');" style="color:red";  > </i>		
						                    </td>                                    
                                        </tr>
                    <tr id="sp_slo" class='info'>
                        <td><b>Single Logout URL (SLO)</b></td>
                        <td>Available in the <b><a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a></b> versions</td>
                    </tr>
                    
					<tr>
                                            <td ><b>Audience URI</b></td>
                                            <td>						               
						                        <span id="audience_url"><?php echo $sp_base_url.'?morequest=sso';?></span>
                                                
												   <i class="fa fa-fw  fa-lg fa-copy mo_copy"; onclick="copyToClipboard('#audience_url');" style="color:red";  > </i>		
						                    </td>                                    
                                        </tr>
                    <tr  id="sp_nameid_format" class='info'>
                        <td><b>NameID Format</b></td>
                        <td>urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified</td>
                    </tr>
                    <tr id="sp_default_relaystate" >
                        <td><b>Default Relay State (Optional)</b></td>
                        <td>Available in the <b><a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a></b> version</td>
                    </tr >
                    <tr id="sp_certificate" class='info'>
                        <td><b>Certificates (Optional)</b></td>
                        <td>Available in the <b><a href='#' class='premium'><b>Standard</b></a>, <a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a></b> version</td>
                    </tr>
					
					
                </table>
				
            </div>
				<script>               
						function copyToClipboard(element) {
							
						  jQuery(".selected-text").removeClass("selected-text");
						  var temp = jQuery("<input>");
						  jQuery("body").append(temp);
						  jQuery(element).addClass("selected-text");
						  temp.val(jQuery(element).text()).select();
						  document.execCommand("copy");
						  temp.remove();
					  }
						jQuery(window).click(function(e) {
							
							console.log(e.target.className);
							if( e.target.className == undefined || e.target.className.indexOf("fa-copy") == -1)
								
							 jQuery(".selected-text").removeClass("selected-text");
						});
				</script>
			<style>
		.selected-text, .selected-text>*{
			   background: #2196f3;
			   color: #ffffff;
			}
		</style>
            <script>
                jQuery(document).ready(function() {
                    var basepath = window.location.href;
                    basepath = basepath.substr(0,basepath.indexOf('administrator')) + 'plugins/authentication/miniorangesaml/';
                    jQuery('.site-url').text(basepath);
                    jQuery('.premium').click(function() {
                         jQuery('.nav-tabs a[href="#attrib-licensing_plans"]').tab('show');
                    });
                });
            </script>
          
            <script>
                var homepath = window.location.href;
                var homepath =  homepath.substr(0,homepath.indexOf('administrator'));
                basepath = homepath + 'plugins/authentication/miniorangesaml/';
                jQuery(document).ready(function() {
                    jQuery('#metadata-link').attr('href',homepath+'?morequest=metadata');
                });
            </script>
            <br/>
                
        </div>


        <?php
    }

function identity_provider_settings()
{
    
	
    
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_saml_config'));
    $query->where($db->quoteName('id')." = 1");

    $db->setQuery($query);
    $attribute = $db->loadAssoc();
    $idp_entity_id = ""; 
    $single_signon_service_url = ""; 
    $name_id_format = "";
    $certificate = "";
    $idp_guide="";
    
    if(isset($attribute['idp_entity_id'])){
        $idp_entity_id= $attribute['idp_entity_id']; 
        $single_signon_service_url= $attribute['single_signon_service_url']; 
        $name_id_format= $attribute['name_id_format'];
        $certificate= $attribute['certificate'];
    }   
            $isAuthEnabled = JPluginHelper::isEnabled('authentication','miniorangesaml');
            $isSystemEnabled = JPluginHelper::isEnabled('system','samlredirect');
            if(!$isSystemEnabled || !$isAuthEnabled){ 
    
    ?>
    <div id="system-message-container">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert alert-error">
                        <h4 class="alert-heading">Warning!</h4>
                            <div class="alert-message">     
                                <h4>This component requires Authentication and System Plugin to be activated. Please activate the following 2 plugins to proceed further.</h4>
                                <ul><li>Authentication - miniOrange</li>
                                <li>System - Miniorange Saml Single Sign-On</li></ul>
                                <h4>Steps to activate the plugins.</h4>
                                <ul><li>In the top menu, click on Extensions and select Plugins.</li>
                                <li>Search for miniOrange in the search box and press 'Search' to display the plugins.</li>
                                <li>Now enable both Authentication and System plugin.</li></ul>
                            </div>
                        </h4>
                    </div>
                </div>
            <?php } ?>
    
    <style>
        table.ex1 {
            border-collapse: separate;
            border-spacing: 15px;
        }
        
        </style>

            <div border="1" id="upload_metadata_form" style="background-color:#FFFFFF; border:2px solid #CCCCCC; padding:1px 1px 1px 10px; display:none ;" >
                <table class="ex1" style="width:100%;">
                    <tr>
                        <td colspan="3">
                            <h3>Upload IDP Metadata
                                <span style="float:right;margin-right:25px;">
                                    <input type="button" class="btn btn-medium btn-danger" value="Cancel" onclick = "hide_metadata_form()"/></a>
                                </span>
                                <hr>
                            </ h3>
                        </td>
                    </tr>
					
                    <form action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.handle_upload_metadata'); ?>" name="metadataForm" method="post" id="IDP_meatadata_form" enctype="multipart/form-data">
                        <input id="mo_saml_upload_metadata_form_action" type="hidden" name="option1" value="upload_metadata" />
                            <tr>
                                <td><b>Upload Metadata  :</b></td>
                                    <input type="hidden" name="action" value="upload_metadata" />
                                        <td colspan="2"><input type="file" name="metadata_file" />
                                        <input type="submit" class="btn btn-primary" name="option1" method="post" value="Upload"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" ><p style="font-size:13pt;text-align:center;"><b>OR</b></p></td>
                            </tr>
                            <tr>
                                <input type="hidden" name="action" value="fetch_metadata" />
                                <td width="20%"><b>Enter metadata URL:</b></td>
                                <td><input type="url" name="metadata_url" placeholder="Enter metadata URL of your IdP." style="width:98%"/></td>
                                <td width="20%">&nbsp;&nbsp;<input type="submit" class="btn btn-primary" name="option1" method="post" value="Fetch Metadata"/>
                            </tr>
                    </form>
                </table>
            </div>
            <form width="98%" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.saveConfig'); ?>" method="post" name="adminForm" id="identity_provider_settings_form">
                <div id="tabhead">
                    <input id="mo_saml_local_configuration_form_action" type="hidden" name="option1" value="mo_saml_save_config" />
                    <input type="button" id="idp_end_tour" value="Start Tab Tour" onclick="restart_touridp();" style= " float: right;" class="btn btn-medium btn-success" />
                    <b>Enter the information gathered from your Identity Provider OR  </b>&nbsp;&nbsp;
                    <input id="sp_upload_metadata" type="button" class='btn btn-primary' onclick='show_metadata_form()' value="Upload IDP Metadata"/></a>
                </div>
				
                <table id="idpdata" class="ex1">
				 <tr id="sp_select_idp">
                        <td><b>Select your Identity Provider for Guide:</b></td>
                        <td>
                            <select id="idp_guides" onChange="window.open(this.options[this.selectedIndex].value)"  name="idp_guides" style="width: 28%;">
                                <option>Select your IDP</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-salesforce-idp/">SalesForce</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-google-apps-idp/">Google Apps</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-onelogin-idp/">One Login</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-miniorange-idp/">Miniorange</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-azure-ad-idp/">Azure AD</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-okta-idp/">Okta</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-on-sso-using-centrify-as-idp/">Centrify</option>
                                <option value="https://plugins.miniorange.com/joomla-single-sign-sso-using-bitium-idp/">Bitium</option>
                            </select>
							
                        </td>
                    </tr>
                    <tr id="sp_entity_id_idp">
                        <td><b>IdP Entity ID*&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        <td><input type="text" name="idp_entity_id" style="width: 88%;" placeholder="Identity Provider Entity ID or Issuer" value="<?php echo $idp_entity_id;?>" required />
                        <br>    <b>Note :</b> You can find the EntityID in Your IdP-Metadata XML file enclosed in <code>EntityDescriptor</code> tag having attribute as <code>entityID</code></td>
                    </tr>
                    <tr id="sp_saml_request_idp">
                        <td><b>Sign SAML Request</b></td>
                        <td><input type="checkbox" name="saml_request_sign" disabled><b> <a href='#' class='premium'><b>[Standard</b></a>, <a href='#' class='premium'><b>Premium</b></a>,  <a href='#' class='premium'><b>Enterprise]</b></a></b></td>
                    </tr>
                    <tr id="sp_nameid_format_idp">
                        <td><b>NameID Format</b></td>
                        <td>
                            <select id="name_id_format" name="name_id_format" style="width: 88%;">
                                <option value="urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified" <?php if ($name_id_format== 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified')  echo 'selected = "selected"'; ?>>urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified</option>
                                <option value="urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress" <?php if($name_id_format == 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress')  echo 'selected = "selected"'; ?> disabled>urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress[PREMIUM]</option>
                                <option value="urn:oasis:names:tc:SAML:1.1:nameid-format:transient" <?php if ($name_id_format== 'urn:oasis:names:tc:SAML:1.1:nameid-format:transient')  echo 'selected = "selected"'; ?> disabled >urn:oasis:names:tc:SAML:1.1:nameid-format:transient[PREMIUM]</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="sp_binding_type">
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <input type="radio" name="miniorange_saml_idp_sso_binding" value="HttpRedirect" checked=1 aria-invalid="false" disabled> Use HTTP-Redirect Binding for SSO<br>
                            <input type="radio"  name="miniorange_saml_idp_sso_binding" value="HttpPost" aria-invalid="false" disabled> Use HTTP-POST Binding for SSO <b><a href='#' class='premium'><b>[Standard</b></a>, <a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise]</b></a></b>
                        </td>
                    </tr>
                    <tr id="sp_sso_url_idp">
                        <td><b>Single Sign-On Service Url* &nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        <td><input class="mo_saml_table_textbox" type="url" placeholder="Single Sign-On Service URL (Http-Redirect) binding of your IdP" name="single_signon_service_url" style="width:88%;" value="<?php echo $single_signon_service_url;?>" required />
                            <br> <b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleSignOnService</code> tag (Binding type: HTTP-Redirect)
                        </td>
                    </tr>
                    <tr id="sp_slo_idp">
                        <td><b>Single Logout Service URL</b></td>
                        <td><input class="mo_saml_table_textbox" type="text" name="single_logout_url" placeholder="Single Logout Service URL" style="width: 88%;" disabled>
                            <br>    <b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleLogoutService</code> tag <b><a href='#' class='premium'><b>[Premium</b></a> and <a href='#' class='premium'><b>Enterprise]</b></a></b>
                        </td>
                    </tr>
                    <tr id="sp_certificate_idp" >
                        <td><b>X.509 Certificate&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        <td><textarea rows="5" cols="80" name="certificate" style="width: 88%;" placeholder="Copy and Paste the content from the downloaded certificate or copy the content enclosed in 'X509Certificate' tag (has parent tag 'KeyDescriptor use=signing') in IdP-Metadata XML file"><?php echo $certificate;?></textarea>
                        <br><b>NOTE:</b> Format of the certificate:<br>
                        -----BEGIN CERTIFICATE-----<br>
                        XXXXXXXXXXXXXXXXXXXXXXXXXXX<br>
                        -----END CERTIFICATE-----</td>
                    </tr>
                    <tr>
                        <td colspan=1></td>
                        <td colspan=1>
                        <input id="sp_save_idp" type="submit" class="btn btn-medium btn-success" value="Save"/>
                        <input  type="button" id='test-config' <?php if($idp_entity_id) echo "enabled"; else echo "disabled"; ?> title='You can only test your configuration after saving your Identity Provider Settings. 'class='btn btn-primary' onclick='showTestWindow()' style="margin-left:10px" value="Test Configuration">
                        </td>
                    </tr>
                  
                    <br>
                </table>
            </form>
            <script>
                function restart_touridp() {
                    touridp.restart();
                }
            </script>
            <script>
                
				function showTestWindow() {
                    var testconfigurl = window.location.href;
                    testconfigurl = testconfigurl.substr(0,testconfigurl.indexOf('administrator')) + '?morequest=sso&q=test_config';
                    var myWindow = window.open(testconfigurl, 'TEST SAML IDP', 'scrollbars=1 width=800, height=600');
                }
                function showSAMLRequest(){
                    var myWindow = window.open( "<?php echo mo_saml_get_saml_request_url();?>", "VIEW SAML REQUEST", "scrollbars=1 width=800, height=600");
                }
                function showSAMLResponse(){
                    var myWindow = window.open( "<?php echo mo_saml_get_saml_response_url();?>", "VIEW SAML RESPONSE", "scrollbars=1 width=800, height=600");
                }
                function show_metadata_form() {
                    jQuery('#upload_metadata_form').show();
                    jQuery('#idpdata').hide();
                    jQuery('#tabhead').hide();
                }
                function hide_metadata_form() {
                    jQuery('#upload_metadata_form').hide();
                    jQuery('#idpdata').show();
                    jQuery('#tabhead').show();
                }
            </script>
			 <script>
                var homepath = window.location.href;
                var homepath =  homepath.substr(0,homepath.indexOf('administrator'));
                basepath = homepath + 'plugins/authentication/miniorangesaml/';
                jQuery(document).ready(function() {
                    jQuery('#metadata-link').attr('href',homepath+'?morequest=metadata');
                });
            </script>

    <?php
}


function mo_saml_get_saml_request_url(){
      
       $url = '?morequest=sso&q=sso';
        return $url;

}

function mo_saml_get_saml_response_url(){
      
     $url ='?morequest=sso&RelayState=response';
        return $url;

}

function Licensing_page() { 


							
							$db = JFactory::getDbo();
							$query = $db->getQuery(true);
							$query->select('*');
							$query->from($db->quoteName('#__miniorange_saml_customer_details'));
							$query->where($db->quoteName('id')." = 1");

							$db->setQuery($query);
							$useremail = $db->loadAssoc();
							
							
							if(isset($useremail))
							$user_email =$useremail['email'];
						else
							$user_email="xyz";
							
							
							
    ?>
	
	<h4> <div style="text-align:center;" >
                    miniOrange SSO using SAML 2.0</div></h4>
                   
                    <!-- span style="float:right;">
                    <a  class="add-new-h2 add-new-hover" style="font-size: 16px; color: #000;" data-toggle="modal" data-target="#standardPremiumModalCenter" ><span class="dashicons dashicons-warning" style="vertical-align: bottom;"></span> Help me choose the right plan</a></span -->
                  <div style="text-align:center; color: rgb(233, 125, 104); ">You are currently on the Free version of the plugin<span style="font-size: 16px; margin-bottom: 0Px;"><li style="margin-bottom: 0px;margin-top: 0px;">Free version is recommended for setting up Proof of Concept (PoC)</li><li style="margin-bottom: 0px;margin-top: 0px;">Try it to test the SSO connection with your SAML 2.0 compliant IdP</li><li style="margin-bottom: 0px;margin-top: 0px;">Works with NameId Attribute which should contain Email Address</li>
                    <li style="color: dimgray; margin-top: 0px;list-style-type: none;">
						 <a tabindex="0" style="cursor: pointer;"  id="popoverfree" data-toggle="popover" data-trigger="focus" title="<h3>Why should I upgrade to premium plugin?</h3>" data-placement="right" data-html="true"
                               data-content="<p>You should upgrade to seek the support of our SSO expert team.<br /><br />Free version does not support attribute mapping, group mapping, single logout features. <br /><br />Premium version support Signed SAML Request and Encrypted Assertion which are recommended from security point of view.<br /><br />Auto-Redirect to IdP which protect your site with IdP login is a part of premium version of the plugin.<br /><br />Check the features given in the Licensing Plans for more detail.</p>">
                    Why should I upgrade?</a>
                    </li></span></div>

     <div style="text-align: center; font-size: 14px; color: white; padding-top: 4px; padding-bottom: 4px; border-radius: 16px;"></div>
    
    <div class="tab-content" style= "background-color: #DBF3FA;">
        <div class="tab-pane active text-center" id="cloud">
            <div class="cd-pricing-container cd-has-margins"><br>
                             
                <ul class="cd-pricing-list cd-bounce-invert" >
                    <li class="cd-black">

                        <ul class="cd-pricing-wrapper"  style="height: 500px";>

                            <li id="singlesite_tab" data-type="singlesite" class="mosslp is-visible cd-singlesite" style="width: 100%">
                                <header class="cd-pricing-header" style="height: 230px">
                                    <h2 style="margin-bottom: 10px" >Free<br/><br/><br></h2>
                                    <div class="cd-price" >
                                        <br><br>
                                        <b style="font-size: large">You are automatically on this plan</b>

                                    </div>
                                   
                                </header> <!-- .cd-pricing-header -->
                                </a>
                                <footer class="cd-pricing-footer">
                                    <a class="cd-select" style="font-size: 85.5%;" >Current Active Plan</a>
                                </footer><br>
                                <!--                                <b style="color: coral;">See the Standard Plugin features list below</b>-->
                                <div class="cd-pricing-body">
						
                                    <ul class="cd-pricing-features">
                                        <li style="font-size: medium">Unlimited Authentications</li>
                                        <li style="font-size: medium">  Basic Attribute Mapping(User Name , Email)</li>
                                        <li style="font-size: medium">Basic Role Mapping</li>
                                        <li style="font-size: medium"> Proxy Server Setup</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata XML File</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata URL</li>
                                        <li style="font-size: medium">Step-by-Step Guide to setup SP</li>
                                        <li style="font-size: medium"> Export Configuration<br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"> <br><br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"><br></li>
                                    <li style="font-size: medium"> <br><br></li>
                                     <li style="font-size: medium"> <br></li>
									 <li style="font-size: medium"> <br></li>
                                    <li style="font-size: medium"> <br></li>
                                    <li style="font-size: medium"><br><br></li>
                                    <li style="font-size: medium"><br></li>
                                    <li style="font-size: medium"><br><br></li>
                                    <li style="font-size: medium"><br></li>
                                    <li style="font-size: medium"><br><br></li>
                                    <li style="font-size: medium"><br><br></li>
                                    <li style="font-size: medium"><br></li>
                                    <li style="font-size: medium"><br><br><br><br></li>
                                    
                                    
                                    </ul>

                                </div>
                            </li>

                     </ul> <!-- .cd-pricing-wrapper -->
                    </li>
                    <li class="cd-black">

                        <ul class="cd-pricing-wrapper"  style="height: 500px";>

                            <li id="singlesite_tab" data-type="singlesite" class="mosslp is-visible cd-singlesite" style="width: 100%">
                                <header class="cd-pricing-header" style="height: 230px">
                                    <h2 style="margin-bottom: 10px" >Standard<br/></h2>(Auto-Redirect to IdP, Relay State)<br/><br>
                                    <div class="cd-price" ><br><br><br>
									<span id="plus_total_price" style="font-weight: bolder;font-size: xx-large">$249*</span>
                                        <br><br>
                                        <b style="font-size: large"></b>

                                    </div>
                                   
                                </header> <!-- .cd-pricing-header -->
                                </a>
                                <footer class="cd-pricing-footer">
                                    
									<a class="cd-select" style="font-size: 85.5%; cursor: pointer;"  onclick= "<?php if(! Mo_Saml_Local_Util::is_customer_registered()){ echo " window.location.href='index.php?option=com_miniorange_saml&tab=account' "; } else { echo " window.open('https://login.xecurify.com/moas/login?username=".$user_email."&redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_saml_sso_standard_plan')"; } ?>" >UPGRADE NOW</a>
								</footer><br>
                                <!--                                <b style="color: coral;">See the Standard Plugin features list below</b>-->
                                <div class="cd-pricing-body">
                                    <ul class="cd-pricing-features">
                                        <li style="font-size: medium"> Unlimited Authentications</li>
                                        <li style="font-size: medium"> Basic Attribute Mapping(User Name , Email)</li>
                                        <li style="font-size: medium"> Basic Role Mapping</li>
                                        <li style="font-size: medium"> Proxy Server Setup</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata XML File</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata URL</li>
                                        <li style="font-size: medium"> Step-by-Step Guide to setup SP</li>
                                        <li style="font-size: medium"> Export Configuration<br></li>
                                        <li style="font-size: medium"> Import configuration<br></li>
                                        <li style="font-size: medium"> Options to select SAML Request binding type<br></li>
                                        <li style="font-size: medium"> Auto-Redirect to IdP<br></li>
                                        <li style="font-size: medium"> Default redirect Url after Login<br></li>
                                        <li style="font-size: medium"> Integrated Windows Authentication(With ADFS) <br></li>
                                        <li style="font-size: medium"> <br></li>
                                        <li style="font-size: medium"> <br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"><br><br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"><br><br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"><br><br></li>
                                        <li style="font-size: medium"><br><br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"> <b>Add-Ons **</b><br>
Purchase Separately<br><a style="color:blue;" href="https://www.miniorange.com/contact" target='_blank'><br><b>Contact us</b></a><br></li>
                                    
                                    
                                    
                                    </ul>

                                </div>
                            </li>

                     </ul> <!-- .cd-pricing-wrapper -->
                    </li>
                    <li class="cd-black">

                        <ul class="cd-pricing-wrapper">

                            <li id="singlesite_tab" data-type="singlesite" class="mosslp is-visible" style="height=600px; width: 100%; left: 30%; ">
                                <header class="cd-pricing-header" style="height: 230px">
                                    <h2 style="margin-bottom: 10px">Premium<br/></h2>(Single Logout, Custom Attribute Mapping and Role Mapping)<br/>
                                    <div class="cd-price" ><br>
                                        

                                    </div><br>
                                    <div id="plus_no_of_instances_drop_down_div" name="plus_no_of_instances_drop_down_div">
                                        <h3 style="margin-bottom: 10px" > <span id="plus_total_price" style="font-weight: bolder;font-size: xx-large">$349*</span> <br/></h3>
                                        </div>
                                </header> <!-- .cd-pricing-header -->
                                </a>
                                <footer class="cd-pricing-footer">
                                 <a class="cd-select" style="font-size: 85.5%; cursor: pointer;"  onclick= "<?php if(! Mo_Saml_Local_Util::is_customer_registered()){ echo " window.location.href='index.php?option=com_miniorange_saml&tab=account' "; } else { echo " window.open('https://login.xecurify.com/moas/login?username=".$user_email."&redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_saml_sso_premium_plan')"; } ?>" >UPGRADE NOW</a>
                                </footer><br>
                                
                                <div class="cd-pricing-body">
                                    <ul class="cd-pricing-features">
                                        <li style="font-size: medium"> Unlimited Authentications</li>
                                        <li style="font-size: medium"> Basic Attribute Mapping(User Name , Email)</li>
                                        <li style="font-size: medium"> Basic Role Mapping</li>
                                        <li style="font-size: medium"> Proxy Server Setup</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata XML File</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata URL</li>
                                        <li style="font-size: medium"> Step-by-Step Guide to setup SP</li>
                                        <li style="font-size: medium"> Export Configuration<br></li>
                                        <li style="font-size: medium"> Import configuration<br></li>
                                        <li style="font-size: medium"> Options to select SAML Request binding type<br></li>
                                        <li style="font-size: medium"> Auto-Redirect to IdP<br></li>
                                        <li style="font-size: medium"> Default redirect Url after Login<br></li>
                                        <li style="font-size: medium"> Integrated Windows Authentication(With ADFS)<br></li>
										<li style="font-size: medium"> Single Logout<br></li>
                                        <li style="font-size: medium"> Custom Role Mapping<br></li>
                                        <li style="font-size: medium"> Custom Attribute Mapping<br></li>
                                        <li style="font-size: medium"> Backend and Frontend Login for Super Users<br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"><br><br></li>
										<li style="font-size: medium"><br></li>
										<li style="font-size: medium"><br><br></li>
										<li style="font-size: medium"><br><br></li>
										<li style="font-size: medium"><br></li>
										<li style="font-size: medium"> <b>Add-Ons **</b><br>
Purchase Separately<br><a style="color:blue;" href="https://www.miniorange.com/contact" target='_blank'><br><b>Contact us</b></a><br></li>
										

                                    </ul>
                                </div> <!-- .cd-pricing-body -->
                            </li>
                            
                        </ul> <!-- .cd-pricing-wrapper -->
                    </li>

                    <li class="cd-black">
                        <ul class="cd-pricing-wrapper">
                            <li id="singlesite_tab" data-type="singlesite" class="mosslp is-visible" style="width: 100%; left: 60%;">
                                <header class="cd-pricing-header" style="height: 230px">
                                    <h2 style="margin-bottom:10px;">Enterprise<br/></h2>(AutoSync IDP meta-data,Multiple IDP)<br/>
                                    <div class="cd-price" ><br>
                                        


                                    </div><br><br>
                                    <div id="pro_no_of_instances_drop_down_div" name="pro_no_of_instances_drop_down_div">
                                        <h3 style="margin-bottom: 10px" ><span id="pro_total_price" style="font-weight: bolder;font-size: xx-large">$449*</span> <br/><br/><br></h3>
                                    </div>
                                </header> <!-- .cd-pricing-header -->
                                <footer class="cd-pricing-footer">
                                  <a class="cd-select" style="font-size: 85.5%; cursor: pointer;"  onclick= "<?php if(! Mo_Saml_Local_Util::is_customer_registered()){ echo " window.location.href='index.php?option=com_miniorange_saml&tab=account' "; } else { echo " window.open('https://login.xecurify.com/moas/login?username=".$user_email."&redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_saml_sso_enterprise_plan')"; } ?>" >UPGRADE NOW</a>
                                </footer><br>
                                <!--                                <b style="color: coral;">See the Enterprise Plugin features list below</b>-->
                                <div class="cd-pricing-body">
                                    <ul class="cd-pricing-features">
                                        <li style="font-size: medium">Unlimited Authentications</li>
                                        <li style="font-size: medium">  Basic Attribute Mapping(User Name , Email)</li>
                                        <li style="font-size: medium">Basic Role Mapping</li>
                                        <li style="font-size: medium"> Proxy Server Setup</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata XML File</li>
                                        <li style="font-size: medium"> Configure SP Using Metadata URL</li>
                                        <li style="font-size: medium">Step-by-Step Guide to setup SP</li>
                                        <li style="font-size: medium"> Export Configuration<br></li>
                                        <li style="font-size: medium">Import configuration<br></li>
                                        <li style="font-size: medium">Options to select SAML Request binding type<br></li>
                                        <li style="font-size: medium">Auto-Redirect to IdP<br></li>
                                        <li style="font-size: medium">Default redirect Url after Login<br></li>
                                        <li style="font-size: medium">Integrated Windows Authentication(With ADFS)<br></li>
                                        <li style="font-size: medium">Single Logout<br></li>
                                        <li style="font-size: medium">Customized Role Mapping<br></li>
                                        <li style="font-size: medium">Customized Attribute Mapping<br></li>
                                        <li style="font-size: medium">Backend and Frontend Login for Super Users<br></li>
                                        <li style="font-size: medium">Custom SP Certificate<br></li>
                                        <li style="font-size: medium">Auto-sync IdP Configuration from metadata<br></li>
                                        <li style="font-size: medium">Store Multiple IDP certificates<br></li>
                                        <li style="font-size: medium">Multiple IdP Support for Cloud Service Providers<br></li>
                                        <li style="font-size: medium">End to End Identity Provider Configuration ***<br></li>
                                        <li style="font-size: medium"><br></li>
                                        <li style="font-size: medium"> <b>Add-Ons **</b><br>
Purchase Separately<br><a style="color:blue;" href="https://www.miniorange.com/contact" target='_blank'><br><b>Contact us</b></a><br></li>
                                        







                                    </ul>
                                </div> <!-- .cd-pricing-body -->
                                <!-- .cd-pricing-body -->
                            </li>
                            

                        </ul> <!-- .cd-pricing-wrapper -->
                    </li>


                </ul> <!-- .cd-pricing-list -->
            </div> <!-- .cd-pricing-container -->

        </div>

        <!-- Modal -->
        <br/><br/>

        
        <br/><div style="margin-left: 60px">
                <h3>* This is the price for 1 instance. Check our pricing page for full details.</h3>
                <h4>Steps to Upgrade to Premium Plugin -</h4>
                <p>1. You will be redirected to miniOrange Login Console. Enter your username and password with which you created an account with us. After that you will be redirected to payment page.</p>
                <p>2. Enter you card details and complete the payment. On successful payment completion, you will see the link to download the premium plugin.</p>
                <p>3. Once you download the premium plugin, first delete existing plugin then install the premium plugin. <br>
                <h3>** Add-Ons List</h3>
                <p>Page Restriction</p>
                <p>Integration with Community Builder</p>
                <p>User sync with Okta</p>
                <p>User sync with Centrify</p>
                <h3>*** End to End Identity Provider Integration - </h3>
                <p>We will setup a Conference Call / Gotomeeting and do end to end configuration for your IDP as well as plugin. We provide services to do the configuration on your behalf. ( extra charges applicable at $60/hrs) </p>
                <p>If you have any doubts regarding the licensing plans, you can email us at <b>info@xecurify.com</b>.<br><br><br></p>
        </div>
    </div>
	
	
	<style>
	 .cd-black :hover #singlesite_tab.is-visible{
           margin-right : 4px;
           transition : 0.4s;
           -moz-transition : 0.4s;
           -webkit-transition : 0.4s;
           border-radius: 8px;
           transform: scale(1.03);
           -ms-transform: scale(1.03); /* IE 9 */
           -webkit-transform: scale(1.03); /* Safari */

           box-shadow: 0 0 4px 1px rgba(255,165, 0, 0.8);
       }



	h1 {
            margin: .67em 0;
            font-size: 2em;
        }

        ul {
            list-style: none; /* Remove HTML bullets */
            padding: 0;
            margin: 0;
        }
		
		li {
            list-style: none; /* Remove HTML bullets */
            padding: 0;
            margin: 0;
        }
	</style>
	<style>
	.popover-title{
			background: #ffff99;
		}
		.popover-content{ background: #F2F8FA; }
	</style>
	  
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script>
		jQuery(document).ready(function(){
			jQuery('[data-toggle="popover"]').popover();   
		});
</script>
    <?php
}

function group_mapping(){
  

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_saml_role_mapping'));
    $query->where($db->quoteName('id')." = 1");

    $db->setQuery($query);
    $role_mapping = $db->loadAssoc();
    $role_mapping_key_value = array();
    if(isset($role_mapping['mapping_value_default']))
        $mapping_value_default = $role_mapping['mapping_value_default'];
    else
        $mapping_value_default = "";
    $enable_role_mapping = 0;
    if(isset($role_mapping['enable_saml_role_mapping']))
        $enable_role_mapping = $role_mapping['enable_saml_role_mapping'];
    ?>

             <input type="button" id="mo_sp_grp_end_tour" value="Start Tab Tour" onclick="restart_tourgrp();" style= " float: right;" class="btn btn-medium btn-success" />
                 <form action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.saveRolemapping'); ?>" method="post" name="adminForm" id="group_mapping_form">
                    <!--<input id="mo_saml_local_configuration_form_action" type="hidden" name="option1" value="mo_saml_group_mapping" />-->
                    <input id="mo_sp_grp_enable"  type="checkbox" name="enable_role_mapping" value="1" <?php if($enable_role_mapping==1) echo "checked"; ?> style="float: left;margin-right: 10px;"> Enable Group Mapping<br>
                     <table class="mo_saml_settings_table">
                        <tr>
                            <td>
                                Select default group for the new users.&nbsp;&nbsp;
                            </td>
                            <td id="mo_sp_grp_defaultgrp">
                                <select name="mapping_value_default" style="width:100%" id="default_group_mapping">
                                    <?php
                                        $noofroles = 0;
                                    ?>
                                    <?php
                                        $db = JFactory::getDbo();
                                        $db->setQuery($db->getQuery(true)->select('*')->from("#__usergroups"));
                                        $groups = $db->loadRowList();
                                        foreach ($groups as $group) {
                                            if($group[4] != 'Super Users'){
                                                if($mapping_value_default ==  $group[0])
                                                    echo '<option selected="selected" value = "'. $group[0].'">'.$group[4].'</option>';
                                                else
                                                    echo '<option  value = "'. $group[0].'">'.$group[4].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <select style="display:none" id="wp_roles_list">
                                    <?php
                                        $db = JFactory::getDbo();
                                        $db->setQuery('SELECT `title`' .' FROM `#__usergroups`');
                                        $groupNames = $db->loadColumn();
                                        $noofroles = count($groupNames);
                                        for($i = 0; $i < $noofroles;  $i++) {
                                            echo    '<option  value = "'. $groupNames[$i].'">'.$groupNames[$i].'</option>';
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
					
                    </table>
					<input type="checkbox" name="disable_update_existing_users_role" value="1" style="float: left;margin-right: 10px;" disabled> Do not update existing user&#39;s roles. <b> <a href='#' class='premium'><b>[Premium</b></a> and <a href='#' class='premium'><b>Enterprise]</b></a></b><br>
                    <input type="checkbox" name="disable_create_users" value="1" style="float: left;margin-right: 10px;" disabled> Do not auto create users if roles are not mapped. <b> <a href='#' class='premium'><b>[Premium</b></a> and <a href='#' class='premium'><b>Enterprise]</b></a></b><br>
                   
                    <br>
                    <p class='alert alert-info'>NOTE: Customized group mapping options shown below are configurable in the <b><a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a> version of plugin.</p>
                        <table class="mo_saml_settings_table" id="saml_role_mapping_table">
                            <tr>
                                <td style="width:20%"><b>Group Name in Joomla</b></td>
                                <td style="width:50%"><b>Group Name from IDP</b></td>
                            </tr>
                            <?php
                                $user_role=array();
                                $db = JFactory::getDbo();
                                $db->setQuery($db->getQuery(true)->select('*')->from("#__usergroups"));
                                $groups = $db->loadRowList();
                                if(empty($role_mapping_key_value)){
                                    foreach ($groups as $group) {
                                        if($group[4] != 'Super Users'){
                                            echo '<tr><td><b>' . $group[4] .'</b></td><td><input type="text" name="saml_am_group_attr_values_' . $group[0] . '" value= "" placeholder="Semi-colon(;) separated Group/Role value for ' . $group[4] . '"  disabled style="width: 400px;"' . ' /></td></tr><tr><td></td><td></td></tr>';
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                else{
                                    $j = 1;
                                    foreach ($role_mapping_key_value as $mapping_key=>$mapping_value){
                                        ?>
                                        <tr>
                                            <td>
                                                <input class="mo_saml_table_textbox"  type="text" name="mapping_key_<?php echo $j;?>" value="<?php echo $mapping_key;?>"  placeholder="cn=group,dc=domain,dc=com" />
                                            </td>
                                            <td>
                                                <select name="mapping_value_<?php echo $j;?>" id="role" style="width:100%">
                                                     <?php
                                                        $db = JFactory::getDbo();
                                                        $db->setQuery('SELECT `title`' .' FROM `#__usergroups`');
                                                        $groupNames = $db->loadColumn();
                                                        $noofroles = count($groupNames);
                                                        for($i = 0; $i < $noofroles ;  $i++) {
                                                            if( $mapping_value == $groupNames[$i])
                                                                echo    '<option selected="selected" value = "'. $groupNames[$i].'">'.$groupNames[$i].'</option>';
                                                            else
                                                                echo '<option value = "'. $groupNames[$i].'">'.$groupNames[$i].'</option>';
                                                        }
                                                     ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php $j++;
                                    }
                                }
                                ?>
                        </table>
                        <p style = "padding-left:18.3em;"><input id="mo_sp_grp_save" type="submit" class="btn btn-medium btn-success" value="Save"/></p>
                </form>
                <script>
                    function restart_tourgrp() {
                        tourgrp.restart();
                    }
                </script>
                <script>
                    jQuery('#add_mapping').click(function() {
                        var dropdown = jQuery("#wp_roles_list").html();
                        var new_row = '<tr><td><input disabled class="mo_saml_table_textbox" type="text" placeholder="cn=group,dc=domain,dc=com" name="mapping_key_1" value="" /></td><td><select disabled name="mapping_value_1" style="width:100%" id="role">'+dropdown+'</select></td></tr>';
                        jQuery('#saml_role_mapping_table tr:last').after(new_row);
                    });
                   
                </script>

                <?php


}

function import_export(){

    ?>

            <div>
                <div><input type="button" id="mo_sp_exp_end_tour" value="Start Tab Tour" onclick="restart_tourexp();" style= " float: right;" class="btn btn-medium btn-success" />
                    <h3>Import /Export Configuration</h3>
                        <table>
                            <hr>
                            <tr>
                                <p>This tab will help you to transfer your plugin configurations when you change your Joomla instance</p>
                                <p>Example: When you switch from test environment to production. Follow these 3 simple steps to do that:</p>
                                     <ol>
                                        <li>Download plugin configuration file by clicking on the link given below.</li>
                                        <li>Install the plugin on new Joomla instance.</li>
                                        <li>Upload the configuration file in Import Plugin Configurations section.</li>
                                    </ol>
                                <p> And just like that, all your plugin configurations will be transferred! </p>
                                <p>You can also send us this file along with your support query.</p>
                            </tr>
                            <tr><br><h4>Download configuration file</h4></tr>
                            <tr>
                                <form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.importexport');?>">
                                    <input id="mo_sp_exp_exportconfig" type="button" class="btn btn-primary " onclick="submit()"; " value= "Export configuration" />
                                </form>
                            </tr>
                            <hr>
                            <tr>
                                <br><h3>Import Configurations</h3><hr>
                            </tr>
                            <tr>
                                <input type="file" name="configuration_file" disabled="disabled">
                                <input id="mo_sp_exp_importconfig" type="submit" disabled="disabled" name="submit" style="width: auto" class="button button-primary button-large" value="Import"/>
                                <p></p>
								
                                <p> This feature is available in the <a href='#' class='premium'><b>Premium</b></a> version of plugin.</p>
                            </tr>
                        </table>
                </div>
            </div>
            <script>
                function restart_tourexp() {
                    tourexp.restart();
                }
            </script>
    <?php
}



function mo_sso_login(){

			$siteUrl = JURI::root();
			$sp_base_url = $siteUrl;
			?>
			
			<div style="padding: 25px;">
				<input type="button" id="mo_sp_sso_end_tour" value="Start Tab Tour" onclick="restart_toursso();" style= " float: right;" class="btn btn-medium btn-success" />
				<h3>1. Add a link or button on your site login page.</h3>
				<p style='font-weight:normal!important;'>Add a button on your site login page with the following URL:<br></p>

				<code id="mo_sp_sso_link_button">
				<?php echo $sp_base_url.'?morequest=sso';?>
				</code>
			</div>
			<div style="text-align: center;padding: auto;padding: 25px;background: #bababa;font-size: 25px;font-weight: bold;color: white;">Premium Features</div>
			<div class="mo_saml_sso_link_style">
			<p><h3 id="mo_sp_sso_auto_redirect">2. Auto Redirect the user to IDP.</h3>&nbsp;&nbsp; [Available in the <b><a href='#' class='premium'><b>Standard</b></a>, <a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a></b> version]<br><br>

			<p class='alert alert-info' style="color: #696969;">NOTE: Enable this if you want to restrict your site to only logged in users. Enabling this plugin will redirect the users to your IdP if logged in session is not found..</p>
			</p>
			<p><h3 id="mo_sp_sso_backend_login">3. Enable Backend Login for Super Users during Single Sign On.&nbsp;&nbsp;</h3> [Available in the <b><a href='#' class='premium'><b>Premium</b></a> and <a href='#' class='premium'><b>Enterprise</b></a></b> version]<br><br>
			<p class='alert alert-info' style="color: #696969;">NOTE:Enable this feature if you want admin/super user to be logged into admin console after SSO instead of front end of site.</p>
			</p></div><hr>
			<div style="text-align: center;padding: auto;padding: 25px;background: #bababa;font-size: 25px;font-weight: bold;color: white;">Add-Ons	</div>
			<div class="mo_saml_sso_link_style">
			<p ><h3 id="mo_sp_sso_integrity">4. Enable Integration with Community Builder.</h3>
			<p class='alert alert-info' style="color: #696969;">NOTE: Reflecting of user data to Community Builder during SSO.</p>
			</p>
			<p ><h3 id="mo_sp_sso_sync_centrify">5. Sync users from Centrify/Okta in Joomla.</h3>
			<p class='alert alert-info' style="color: #696969;">NOTE: This add-ons sync users from Centrify/Okta to Joomla database.</p>
			</p>
			</div>
			<style>
			 .mo_saml_sso_link_style{
					padding: 25px;
					background-color: #F5FCFF;
					color: #696969;
					}
			</style>
			<script>
			function restart_toursso() {
			toursso.restart();
			}
			</script>
<?php
}

function attribute_mapping(){
    

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_saml_config'));
    $query->where($db->quoteName('id')." = 1");

    $db->setQuery($query);
    $attribute = $db->loadAssoc();
    
    if(isset($attribute['username'])){
        $username_attr = $attribute['username']; 
        $email_attr = $attribute['email']; 
       
        $group_attr = $attribute['grp']; 
        $enable_email = $attribute['enable_email']; 
    }else{
        $username_attr = ""; 
        $email_attr = ""; 
        $name_attr = "";
        $group_attr = ""; 
        $enable_email = 0; 
    }
    ?>
            <a class='collapsed' data-toggle='collapse'  href='#info1' aria-expanded='false'>Click here to know how attribute mapping is useful ?</a>
            <div id='info1' class='collapse'>
                <ol>
                    <li>Attributes are user details that are stored in your Identity Provider.</li>
                    <li>Attribute Mapping helps you to get user attributes from your IdP and map them to Joomla user attributes like firstname, lastname etc.</li>
                    <li>While auto registering the users in your Joomla site these attributes will automatically get mapped to your Joomla user details.</li>
                </ol>
            </div>
            <input type="button" id="mo_sp_attr_end_tour" value="Start Tab Tour" onclick="restart_touratt();" style= " float: right;" class="btn btn-medium btn-success" /><br>
                <form action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.saveConfig'); ?>" method="post" name="adminForm" id="attribute_mapping_form">
                    <input id="mo_saml_local_configuration_form_action" type="hidden" name="option1" value="mo_saml_save_attribute" />Match (Login/Create) Joomla Account By
                        <table id="mo_saml_settings_table" class="mo_saml_settings_table">
                            <tr>
                                <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;<input class="mo_saml_table_textbox" type="radio" name="enable_email" value="1" <?php if($enable_email==1) echo "checked"; ?> />
                                </td>
                                <td><b>Email</b></td>
                            </tr>
                            
                        </table><br>
                        <input type="checkbox" name="disable_update_existing_users_attribute" value="1" style="float: left;margin-right: 10px;" disabled> Do not update existing user&#39;s attributes. <b> <a href='#' class='premium'><b>[Premium</b></a> and <a href='#' class='premium'><b>Enterprise]</b></a></b><br><br>
                            <p class='alert alert-info'>NOTE: Use attribute name NameID if Identity is in the NameIdentifier element of the subject statement in SAML Response.</p>
                                <table id="mo_saml_uname" class="ex1">
								
                                    <tr >
                                        <td><b>Username&nbsp;&nbsp;</b></td>
                                        <td>
                                            <input disabled class="mo_saml_table_textbox" type="text" name="username"required placeholder="NameID" value="NameID" />
                                        </td>
                                    </tr>
                                    <tr id="mo_saml_email">
                                        <td><b>Email&nbsp;&nbsp;</b></td>
                                        <td>
                                            <input disabled class="mo_saml_table_textbox" type="text" name="email"required placeholder="NameID" value="NameID" />
                                        </td>
                                    </tr>
									</table>
									<table class="ex1">
									
                                    <tr id="mo_sp_attr_name">
                                        <td width="70"><b>Name&nbsp;&nbsp;</b></td>
                                        <td><input  disabled class="mo_saml_table_textbox" type="text" name="name"  placeholder="Enter Attribute Name for Name" /></td>
                                    </tr>
                                    <tr >
                                        <td><b>Group&nbsp;&nbsp;</b></td>
                                        <td><input disabled class="mo_saml_table_textbox" type="text" name="grp" value="<?php echo $group_attr; ?>" placeholder="Enter Attribute Name for Group" /></td>
                                    </tr>
									
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td id="mo_sp_attr_save_attr"><input disabled type="submit" class="btn btn-medium btn-success" value="Save Attribute Mapping"/>&nbsp;&nbsp; </td>
                                    </tr>
                                </table>
                            </form>
                            <p class='alert alert-info'>NOTE: Customized attribute mapping options shown above are configurable in the <a href='#' class='premium'><b>Premium </a> and <a href='#' class='premium'> <b>Enterprise</b></a> versions of plugin.</p>
                            <script>
                                function restart_touratt() {
                                    touratt.restart();
                                }
                            </script>
    <?php
}   

function proxy_setup() {
        
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_saml_proxy_setup'));
    $query->where($db->quoteName('id')." = 1");

    $db->setQuery($query);
    $proxy = $db->loadAssoc();
    
    $proxy_host_name = isset($proxy['proxy_host_name'])? $proxy['proxy_host_name'] : '';
    $port_number = isset($proxy['port_number'])? $proxy['port_number'] : '';
    $username = isset($proxy['username'])? $proxy['username'] : '';
    $password = isset($proxy['password'])? base64_decode($proxy['password']) : '';
        
    ?>

            
                <table  id="mo_sp_proxy_config" style="width:50%;">
                  <form  style="background-color:#FFFFFF; border:1px solid #CCCCCC; padding:0px 0px 0px 10px;" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.proxyConfig');?>" name="proxy_form" method="post">
                        <input type="hidden" name="option1" value="mo_saml_save_proxy_setting" />
                            <tr>
                                <td colspan="2">
                                    <h3>Configure Proxy Server</h3>
									
                                </td>
                            </tr>
							<tr>
							<p><b>( If your organization dont allow you to connect to internet directly and if you need to login to your proxy server please configure following details.)</b></p>
							</tr>
                            <tr>
                                <td colspan="3">Enter the information to setup the proxy server.<br /><br /></td>
                            </tr>
                        <tr id="mo_sp_proxy_host_name" >
                            <td style="width:200px;"><strong>Proxy Host Name:<span style="color: #FF0000">*</span></strong></td>
                            <td colspan="3"><input type="text" name="mo_proxy_host" placeholder="Enter the host name" style="width: 95%;" value="<?php echo $proxy_host_name ?>" required/></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
						 
                        <tr id="mo_sp_port_number">
                            <td><strong>Port Number:<span style="color: #FF0000">*</span></strong></td>
                            <td colspan="3"><input type="number" name="mo_proxy_port" placeholder="Enter the port number of the proxy" style="width: 95%;" value="<?php echo $port_number ?>" required/></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr id="mo_sp_proxy_username">
                            <td><strong>Username:</strong></td>
                            <td colspan="3"><input type="text" name="mo_proxy_username" placeholder="Enter the username of proxy server" style="width: 95%;" value="<?php echo $username ?>" /></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr id="mo_sp_proxy_password">
                            <td><strong>Password:</strong></td>
                            <td colspan="3"><input type="password" name="mo_proxy_password" placeholder="Enter the password of proxy server" style="width: 95%;" value="<?php echo $password ?>"></td>
                        </tr>
                        <tr ><td>&nbsp;</td></tr>
                        <tr>
                            <td>&nbsp;</td>
							 
                            <td id="mo_sp_proxy_save" width="5%"><br /><input type="button" style="width:100px;" value="Save" onclick='submit();' class="btn btn-medium btn-success" /></td>
                            </form>
							<td>&nbsp;</td>
							
                            <form   style="background-color:#FFFFFF; " action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.proxyConfigReset');?>" name="proxy_form1" method="post">
                                <td id="mo_sp_proxy_reset" ><br /><input type="button" style="width:100px;" value="Reset" onclick='submit();' class="btn btn-medium btn-success" /> <br/></td>
                            </form>
                        </tr>
                    
                </table>
                <script>
                    function restart_tourproxy() {
                        tourprx.restart();
                    }
                </script>
                </script>

        <?php   
}   

function help(){
    
    $siteUrl = JURI::root();
    $sp_base_url = $siteUrl;
    ?>

            <a class='collapsed faqheading' data-toggle='collapse'  href='#faq1' aria-expanded='false'>How to setup this SAML SSO Plugin.</a>
            <div id='faq1' class='collapse faqcontent'>Setup your Identity Provider by following these steps:<br><br>
                Step 1: Download X.509 certificate from your Identity Provider.<br><br>
                Step 2: Enter appropriate values in the Identity Provider settings Tab. <a href='https://plugins.miniorange.com/step-by-step-guide-for-joomla-single-sign-on-sso/' target='_blank'>Click here</a> to see sample values for some of the IdPs.<br><br>
                Step 3: After saving your configuration. Go to template manager to add saml login link to your login page.<br><br>
                <a href='https://plugins.miniorange.com/step-by-step-guide-for-joomla-single-sign-on-sso/' target='_blank'>Click here</a> for detailed documentaion to setup the plugin.
            </div>
            <a class='collapsed faqheading' data-toggle='collapse'  href='#faq5' aria-expanded='false'>How to add login link or button to my joomla site login page.</a>
            <div id='faq5' class='collapse faqcontent'>
                <p style='font-weight:normal!important;'>Add a button on your site login page with the following URL:<br></p>
                <code>
                   <?php echo $sp_base_url.'?morequest=sso';?>
                </code>
                <br>
            </div>
            <a class='collapsed faqheading' data-toggle='collapse'  href='#faq2' aria-expanded='false'>I'm getting a 404 error page when I click on saml login link to login.</a>
            <div id='faq2' class='collapse faqcontent'>This could mean that you have not entered the correct SAML Single Sign On Url. Please enter the correct SAML Login URL (with HTTP-Redirect binding) provided by your Identity Provider and try again.
                If the problem persists, please contact us at info@xecurify.com or <a href='http://miniorange.com/contact' target='_blank'>click here</a> to contact us for support. It would be helpful if you could share your Identity Provider details with us.
            </div>
            <a class='collapsed faqheading' data-toggle='collapse'  href='#faq3' aria-expanded='false'>I clicked on login link but I cannot see the login page of my Identity Provider.</a>
            <div id='faq3' class='collapse faqcontent'>This could mean that you have not entered the correct SAML Single Sign On Url. Please enter the correct SAML Single Sign On URL (with HTTP-Redirect binding) provided by your Identity Provider and try again.
                If the problem persists, please contact us at info@xecurify.com or <a href='http://miniorange.com/contact' target='_blank'>click here</a> to contact us for support. It would be helpful if you could share your Identity Provider details with us.
            </div>
            <a class='collapsed faqheading' data-toggle='collapse'  href='#faq4' aria-expanded='false'>I logged in to my Identity Provider and it redirected me to Joomla site, but I'm not logged in.</a>
            <div id='faq4' class='collapse faqcontent'>Here are the some frequent errors that can occur:<br><br>
                <b>INVALID_ISSUER</b> : This means that you have NOT entered the correct Issuer or Entity ID value provided by your Identity Provider. You'll see in the error message what was the expected value (that you have configured) and what actually found in the SAML Response.<br><br>
                <b>INVALID_AUDIENCE</b> : This means that you have NOT configured Audience URL in your Identity Provider correctly. It must be set to <b>https://path-to-joomla-site/plugins/authentication/miniorangesaml/</b> in your Identity Provider.<br><br>
                <b>INVALID_DESTINATION</b> : This means that you have NOT configured Destination URL in your Identity Provider correctly. It must be set to <b>https://path-to-joomla-site/plugins/authentication/miniorangesaml/saml2/acs.php</b> in your Identity Provider.<br><br>
                <b>INVALID_SIGNATURE</b> : This means that the certificate you provided did not match the certificate found in the SAML Response. Make sure you provide the same certificate that you downloaded from your IdP. If you have your IdP's Metadata XML file then make sure you provide certificate enclosed in X509 Certificate tag which has an attribute use="signing".<br><br>
                <b>INVALID_CERTIFICATE</b> : This means that the certificate you provided is not in proper format. Make sure you have copied the entire certificate provided by your IdP. If coiped from IdP's Metadata XML file, make sure that you copied the entire value.<br><br>
                    If you need help resolving the issue, you can contact us at info@xecurify.com or <a href='http://miniorange.com/contact' target='_blank'>click here</a> to contact us for support. We will get back to you shortly.
            </div>
            For any other query/problem/request, please feel free to contact us at info@xecurify.com or <a href='http://miniorange.com/contact' target='_blank'>click here</a> to submit a query.  We will get back to you as soon as possible.

        <?php
    }
        
function mo_saml_local_account_page() {
  

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_saml_customer_details'));
    $query->where($db->quoteName('id')." = 1");
    $db->setQuery($query);
    $result = $db->loadAssoc();
    $email = $result['email'];
    $customer_key = $result['customer_key'];
    $api_key = $result['api_key'];
    $customer_token = $result['customer_token'];
    $hostname = Mo_Saml_Local_Util::getHostname();
	
							
    ?>
    <div class="mo_saml_table_layout_1">
    <div class="mo_saml_table_layout mo_saml_container">
    <div id="cum_pro"  style="background-color:#FFFFFF; border:1px solid #CCCCCC; padding:0px 0px 0px 10px; width:98%;height:344px">
        
		
            <div class="mo_saml_welcome_message"><h4>Thank You for registering with miniOrange.</h4></div><br><br>
            <h3>Your Profile</h3>
            <table border="1" style="background-color:#FFFFFF; border:1px solid #CCCCCC; border-collapse: collapse; padding:0px 0px 0px 10px; margin:2px; width:85%">
                <tr>
                    <td style="width:45%; padding: 10px;">Username/Email</td>
                    <td style="width:55%; padding: 10px;"><?php echo $email?></td>
                </tr>
                <tr>
                    <td style="width:45%; padding: 10px;">Customer ID</td>
                    <td style="width:55%; padding: 10px;"><?php echo $customer_key?></td>
                </tr>

            </table>
        
    </div>
	<div id="sp_proxy_setup">
			<input id="sp_proxy" type="button" class='btn btn-primary' onclick='show_proxy_form()' value="Configure Proxy"/></a>
	</div>
	<div border="1" id="submit_proxy" style="background-color:#FFFFFF; border:2px solid #CCCCCC; padding:1px 1px 1px 10px; display:none ;" >
			
			                         <span style="float:right;margin-right:25px;">
                                     <input type="button" class="btn btn-medium btn-danger" value="Cancel" onclick = "hide_proxy_form()"/></a>
									 </span>
                                <br>
			<?php proxy_setup()?>
	</div>
	</div>
	
    <form id="forgot_password_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.forgotPassword');?>">
        <input type="hidden" name="option1" value="user_forgot_password" />
    </form>
	 <div id="mo_saml_support_help" class="mo_saml_table_layout_support_1">
            <?php echo mo_saml_local_support(); ?>
	</div>
    </div>
    <script>
        jQuery('a[href=#cancel_link]').click(function(){
            jQuery('#cancel_form').submit();
        });
        jQuery('a[href=#mo_saml_local_forgot_password_link]').click(function(){
            jQuery('#forgot_password_form').submit();
        });
    </script>
	<script>
	function show_proxy_form() {
                    jQuery('#submit_proxy').show();
                    jQuery('#cum_pro').hide();
                    jQuery('#sp_proxy_setup').hide();
                }
			function hide_proxy_form() {
                    jQuery('#submit_proxy').hide();
                    jQuery('#cum_pro').show();
                    jQuery('#sp_proxy_setup').show();
                }
				
	</script>
	



       

    <?php
}

/* Show OTP verification page*/
function mo_saml_local_show_otp_verification(){
    ?>
    <div class="mo_saml_table_layout_1">

        <div class="mo_saml_table_layout mo_saml_container">
            <div id="panel2">
                <table class="mo_saml_settings_table" style="width:100%">
        <!-- Enter otp -->
                    <form name="f" method="post" id="saml_form" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.validateOtp');?>">
                        <input type="hidden" name="option1" value="mo_saml_local_validate_otp" />
                        <h3>Verify Your Email</h3>
                        <tr>
                            <td><b><font color="#FF0000">*</font>Enter OTP:</b></td>
                            <td colspan="2"><input class="mo_saml_table_textbox" autofocus="true" type="text" name="otp_token" required placeholder="Enter OTP" style="width:61%;" />
                             &nbsp;&nbsp;<a style="cursor:pointer;" onclick="document.getElementById('resend_otp_form').submit();">Resend OTP over Email</a></td>
                        </tr>
                        <tr><td colspan="3"></td></tr>
                    <tr>
                    <td></td>
                    <td>
                        <input type="button" value="Back" id="back_btn" class="btn btn-medium btn-primary" />
                        <input type="submit" value="Validate OTP" class="btn btn-medium btn-success" />
                    </td>
                    </form>
                        <td>
                            <form method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.cancelform');?>" id="mo_saml_cancel_form">
                                <input type="hidden" name="option1" value="mo_saml_local_cancel" />
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form name="f" id="resend_otp_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.resendOtp');?>">
                                <input type="hidden" name="option1" value="mo_saml_local_resend_otp"/>
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <hr>

                <h3>I did not recieve any email with OTP . What should I do ?</h3>
                <form id="phone_verification" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.phoneVerification');?>">
                    <input type="hidden" name="option1" value="mo_saml_local_phone_verification" />
                     If you can't see the email from miniOrange in your mails, please check your <b>SPAM Folder</b>. If you don't see an email even in SPAM folder, verify your identity with our alternate method.
                     <br><br>
                        <b>Enter your valid phone number here and verify your identity using one time passcode sent to your phone.</b><br><br><input class="mo_saml_table_textbox" required="true" pattern="[\+]\d{1,3}\d{10}" autofocus="true" type="text" name="phone_number" id="phone" placeholder="Enter Phone Number" style="width:40%;"  title="Enter phone number without any space or dashes."/>
                        <br><br><input type="submit" value="Send OTP on Phone" class="btn btn-medium btn-primary" />
                
                </form>
            </div>
        </div>
        </div>
        <script>
    //jQuery("#phone").intlTelInput();
    jQuery('#back_btn').click(function(){
            jQuery('#mo_saml_cancel_form').submit();
    });
    
</script>
<?php
}
/* End Show OTP verification page*/

/* Create Customer function */
function mo_saml_local_registration_page(){
    //update_option ( 'mo_saml_local_new_registration', 'true' );
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
     // Fields to update.
    $fields = array(
        $db->quoteName('new_registration') . ' = ' . $db->quote(true)
    );
     
    // Conditions for which records should be updated.
    $conditions = array(
        $db->quoteName('id') . ' = 1'
    );
     
    $query->update($db->quoteName('#__miniorange_saml_customer_details'))->set($fields)->where($conditions);
    $db->setQuery($query);
    $result = $db->execute();
    ?>

<!--Register with miniOrange-->
<div class="mo_saml_table_layout_1">

    <div class="mo_saml_table_layout mo_saml_container">
	   
	   <div border="1" id="submit_proxy" style="background-color:#FFFFFF; border:2px solid #CCCCCC; padding:1px 1px 1px 10px; display:none ;" >
			
			                         <span style="float:right;margin-right:25px;  margin-top:5px;">
                                     <input type="button" class="btn btn-medium btn-danger" value="Cancel" onclick = "hide_proxy_form()"/></a>
									 </span>
                                <br>
			<?php proxy_setup()?>
		</div>
	   
        <div id="panel1">
		<form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_saml&task=myaccount.registerCustomer');?>">
        <input type="hidden" name="option1" value="mo_saml_local_register_customer" />
        <input type="button" id="sprg_end_tour" value="Start Tab Tour" onclick="restart_tourrg();" style= " float: right;" class="btn btn-medium btn-success" />
        <h3>Why should I register?</h3>
		  <p class='alert alert-info'>You should register so that in case you need help, we can help you with step by step instructions. We support all known IdPs - ADFS, Okta, Salesforce, Shibboleth, SimpleSAMLphp, OpenAM, Centrify, Ping, RSA, IBM, Oracle, OneLogin, Bitium, WSO2 etc. <b>You will also need a miniOrange account to upgrade to the premium version of the plugins</b>. We do not store any information except the email that you will use to register with us.</p>
            <h3>Register with miniOrange</h3>
                <table class="mo_saml_settings_table">
                    <tr id="spemail">
                        <td><b><font color="#FF0000">*</font>Email:</b></td>
                        <td>
                        <?php   $current_user =  JFactory::getUser();
                                $db = JFactory::getDbo();
                                $query = $db->getQuery(true);
                                $query->select('*');
                                $query->from($db->quoteName('#__miniorange_saml_customer_details'));
                                $query->where($db->quoteName('id')." = 1");

                                $db->setQuery($query);
                                $result = $db->loadAssoc();
                                $admin_email = $result['email'];
                                $admin_phone = $result['admin_phone'];
                                if($admin_email==''){
                                    $admin_email = $current_user->email;
                                }
								

                                 ?>
                        <input class="mo_saml_table_textbox" type="email" name="email"
                             placeholder="person@example.com"
                            value="<?php echo $admin_email;?>"  /></td>
                    </tr>

                    <tr id="sprg_phone">
                        <td><b>Phone number:</b></td>
                        <td><input class="mo_saml_table_textbox" type="tel" id="phone"
                            pattern="[\+]\d{11,14}|[\+]\d{1,4}([\s]{0,1})(\d{0}|\d{9,10})" name="phone"
                            title="Phone with country code eg. +1xxxxxxxxxx"
                            placeholder="Phone with country code eg. +1xxxxxxxxxx"
                            value="<?php echo $admin_phone;?>" />
                            <i>We will call only if you call for support</i><br><br></td>
                    </tr>
                    <tr id="sprg_passwd">
                        <td><b><font color="#FF0000">*</font>Password:</b></td>
                        <td><input class="mo_saml_table_textbox"  type="password"
                            name="password" placeholder="Choose your password (Min. length 6)" />
                        </td>
                    </tr>
                    <tr id="rg_repasswd">
                        <td><b><font color="#FF0000">*</font>Confirm Password:</b></td>
                        <td><input class="mo_saml_table_textbox" type="password"
                            name="confirmPassword" placeholder="Confirm your password" />
                            </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Save" class="btn btn-medium btn-success" /></td>
                    </tr>
                </table>
			
			</div>
			<div id="sp_proxy_setup"><br>
			 <b>If your organization dont allow you to connect to internet directly and if you need to login to your proxy server please configure following details</b>
			<input id="sp_proxy" type="button" class='btn btn-primary' onclick='show_proxy_form()' value="Configure Proxy"/></a>
			</div>
			
        </div>
	</form>
        <div id="mo_saml_support_help" class="mo_saml_table_layout_support_1">
            <?php echo mo_saml_local_support(); ?>
    </div>
    </div>

<script>
			function show_proxy_form() {
                    jQuery('#submit_proxy').show();
                    jQuery('#panel1').hide();
                    jQuery('#sp_proxy_setup').hide();
                }
			function hide_proxy_form() {
                    jQuery('#submit_proxy').hide();
                    jQuery('#panel1').show();
                    jQuery('#sp_proxy_setup').show();
                }
				
				
				</script>
<script>


 var base_url = '<?php echo JURI::root();?>';
   
 
    
        
            var tabtour = new Tour({
				
                name: "tabtour",
                steps: [
					
                 {
                        element: "#idptab",
                        title: "IDP Configuration",
                        content: "Configure this tab using IDP information which you get form IDP-Metadata XML",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){         
							jQuery('.nav-tabs a[href=#identity-provider]').tab('show');
                            
                        },
                        
                        

                    }, {
                        element: "#mo_saml_support_idp",
                        title: "Contact Us",
                        content: "Feel free to contact us for any queries or issues regarding plugin. We will help you with configuration too.",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){
							
							jQuery('.nav-tabs a[href=#description]').tab('show');  
						}
                        
                    },  {
                        element: "#descriptiontab",
                        title: "Service Provider Info",
                        content: "This tab provides details to configure your IDP.",
                        backdrop:'body',
                        backdropPadding:'6',
                        onPrev: function(){
                            jQuery('.nav-tabs a[href=#identity-provider]').tab('show');   
                        },
						onNext: function(){
                            jQuery('.nav-tabs a[href=#service-provider]').tab('show');   
                        }

                    },{
                        element: "#ssotab",
                        title: "Single Sign on Settings",
                        content: "You will get the information like SSO link, auto redirect option and more",
                        backdrop:'body',
                        backdropPadding:'6',
                        onNext: function(){
                            jQuery('.nav-tabs a[href=#licensing-plans]').tab('show');   
                        },
                        onPrev: function(){                         
                            jQuery('.nav-tabs a[href=#description]').tab('show');   
                        }


                    },{
                        element: "#licensingtab",
                        title: "Licensing.",
                        content: " You can find premium features and could upgrade to our premium plans.",
                        backdrop:'body',
                        backdropPadding:'6',
                        onPrev: function(){                         
                            jQuery('.nav-tabs a[href=#service-provider]').tab('show');   
                        }
                        
                    },{
                        element: "#sprg_end_tour",
                        title: "Tab Tour",
                        content: "You could find the start tour button on each tab which will help you to configure the tab /get the inforamtion from that tab.",
                        backdrop:'body',
                        backdropPadding:'6',
                      
                    },{
                        element: "#sp_ot_tourend",
                        title: "Overall Tour Button",
                        content: "Click on this button to know what each tab does.",
                        backdrop:'body',
                        backdropPadding:'6',
                       
                    },
                    ]
                    
                });
                
        tabtour.init();
        tabtour.start();    


</script>
<script>

function restart_tourrg() {
                tourrg.restart();
            }

            var tourrg = new Tour({
                name: "tour",
                steps: [
					{
                        element: "#spregister",
                        title: "Email Address",
                        content: "Please enter your email address here.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
					{
                        element: "#spemail",
                        title: "Email Address",
                        content: "Please enter your email address here.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#sprg_phone",
                        title: "Phone",
                        content: "We dont use your number untill you want us to contact.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#sprg_passwd",
                        title: "Password",
                        content: "Please enter your password for login purpose.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },
                     {
                        element: "#rg_repasswd",
                        title: "ReEnter Password",
                        content: "Please ReEnter password which provided above.",
                        backdrop:'body',
                        backdropPadding:'6'
                    },                              
                     {
                        element: "#sprg_end_tour",
                        title: "Tour ends",
                        content: "Click here to restart tour",
                        backdrop:'body',
                        backdropPadding:'6'
                    }

                ]});

            
    //  tourrg.init();
        //tourrg.start();
</script>
					

<?php
}
/* End of Create Customer function */
?>