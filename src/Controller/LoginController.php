<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login.html.twig',
            array('error' => $error, 'lastUsername' => $lastUsername));
    }

    /*public function register(UserPasswordEncoderInterface $encoder)
    {
        $usuari = new App\Entity\Usuari();
        $password= $usuari->getPassword();
        $passwordCodificat = $encoder->encodePassword($usuari, $password);
        $usuari->setPassword($passwordCodificat);
    }*/
}

?>