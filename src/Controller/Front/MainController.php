<?php

namespace App\Controller\Front;

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

}
