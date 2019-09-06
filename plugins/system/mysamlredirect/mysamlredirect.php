<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemMysamlredirect extends JPlugin
{
    public function onAfterInitialise()
    {
        $jinput = JFactory::getApplication()->input;

        $get = $jinput->get->getArray();
        $post = $jinput->post->getArray();

        if (isset($get['simplesamlphp']) && $get['simplesamlphp'] === 'sso') {
            require_once('/var/simplesamlphp/lib/_autoload.php');

            $as = new SimpleSAML_Auth_Simple('default-sp');

            // $as->requireAuth();



            $as->requireAuth([
                'ReturnTo' => 'joomla.local',
                'KeepPost' => FALSE,
            ]);

            $attributes = $as->getAttributes();

            print_r($attributes);

            die();
        }
    }
}