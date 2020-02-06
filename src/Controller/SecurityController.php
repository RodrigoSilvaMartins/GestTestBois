<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('landing_page');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void {}

    //TODO: @IsGranted("ROLE_ADMIN")

    /**
     * @route("/secured/register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, ValidatorInterface $validator): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User;
        $user->setUsername($request->request->get('username'));
        $user->setPassword($userPasswordEncoder->encodePassword($user, $request->request->get('password', '')));
        $user->setRoles($request->request->get('roles'));

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string)$errors;

            return new Response($errorsString);
        }

        $em->persist($user);
        $em->flush();

        //TODO: Redirect to next page
        return new Response('Saved new user with id ' . $user->getId());
    }
}
