<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Controller\BaseController;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\InformationEntry;
use AppBundle\Form\InformationEntryType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Admin controller.
 *
 * @Route("/admin")
 */
class AdminContoller extends BaseController
{
    /**
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/makeAdmin/{username}", name="make_admin")
     * @Method("GET")
     */
    public function makeAdminAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user->addRole('ROLE_ADMIN');
        $userManager->updateUser($user);

        return new Response("User successfully granted ROLE_ADMIN");
    }

    /**
     * @Route("/removeAdmin/{username}", name="remove_admin")
     * @Method("GET")
     */
    public function removeAdminAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user->removeRole('ROLE_ADMIN');
        $userManager->updateUser($user);

        return new Response("User successfully removed ROLE_ADMIN");
    }

    /**
     * @Route("/settings/{name}/{value}", name="change_setting")
     * @Method("GET")
     */
    public function changeSetting($name, $value) {
        $this->get('craue_config')->set($name, $value);
        $this->addFlash('notice', 'Successfully edited value');
        return $this->redirectToRoute('admin_index');
    }
}