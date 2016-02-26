<?php

namespace AppBundle\Controller;


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
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminContoller extends Controller
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
}