<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    public function landingPage()
    {
        //$this->new();
        //return $this->render('base.html.twig', ['hello' => 'VIKI']);

    }
    /**
     * @Route("/")
     */
    public function new(Request $request)
    {
        // create a user object
        $user = new User();
        $user->setUsername('');
        $user->setPassword('');
        $user->setRoles([]);

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('connect', SubmitType::class, ['label' => 'Connexion'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            //return $this->redirectToRoute('user_success');
        }
        return $this->render('base.html.twig', [
           'form' => $form->createView()
        ]);
    }
}
