<?php
/**
 * Created by PhpStorm.
 * User: ravgus
 * Date: 07.02.19
 * Time: 10:25
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        /*if ($this->getUser() !== null) {*/
        if ($this->getUser() instanceof User) {
            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }
}