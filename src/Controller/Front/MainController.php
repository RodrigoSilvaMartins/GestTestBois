<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="landing_page")
     */
    public function landingPage()
    {
        return $this->render('landingPage.html.twig', ['hello' => 'VIKI', 'title'=>'Nom de données']);
    }
    /**
     * @Route("/questions", name ="questions_page")
     */
    public function  questionsPage(){
        return $this->render('questions.html.twig', ['title' => 'Questions' ]);
    }
}