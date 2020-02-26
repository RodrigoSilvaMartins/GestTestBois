<?php

namespace App\Controller\Front;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
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
    public function  questionsPage()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://localhost:8000/api/question.list');
        //$response = $httpClient->request('GET', 'http://localhost:8000/api/question.list', ['timeout'=>10]);
        return $this->render('questions.html.twig', ['title' => 'Questions']);
    }
}
