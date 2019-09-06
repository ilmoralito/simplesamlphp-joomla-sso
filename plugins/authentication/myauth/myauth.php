<?php

defined('_JEXEC') or die();

class plgAuthenticationMyAuth extends JPlugin
{
    public function onUserAuthenticate($credentials, $options, &$response)
    {
        // require_once('/var/simplesamlphp/lib/_autoload.php');

        // $auth = new SimpleSAML_Auth_Simple('default-sp');

        // $as->requireAuth();

        // $attributes = $as->getAttributes();

        // print_r($attributes);

        $userId = $this->getUserId($credentials['username']);

        if (!$userId) {
            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = 'User does not exist';

            return;
        }

        if ($credentials['username'] !== strrev($credentials['password'])) {
            $response->status = JAuthentication::STATUS_FAILURE;
            $response->error_message = 'Invalid username or password';

            return;
        }

        $email = JUser::getInstance($userId);

        $response->email = $email;
        $response->status = JAutentication::STATUS_SUCCESS;

        return true;
    }

    private function getUserId($username)
    {
        $dbo = JFactory::getDbo();

        $query = $dbo->getQuery(true);

        $query
            ->select('id')
            ->from('#__users')
            ->where("username = '{$username}'");

        $dbo->setQuery($query);

        return $dbo->loadResult();
    }
}