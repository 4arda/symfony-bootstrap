<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class DefaultController
 *
 *
 * @RouteResource("Default")
 * @package ApiBundle\Controller
 */
class DefaultController extends RestController
{

    public function cgetAction(){

        /** @var User $user */
        $user = $this->getUser();

        $data = array("hello" => $user->getUsername());
        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getAction($username){

        throw $this->createException('no_access');
    }
}
