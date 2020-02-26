<?php

namespace App\Controller\Front;

Use App\Entity\Level;
use App\Repository\LevelRepository;
use App\Repository\QuestionRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="landing_page")
     */
    public function landingPage()
    {
        return $this->render('landingPage.html.twig', ['hello' => 'VIKI', 'title'=>'Nom de données']);
    }
//    /**
//     * @Route("/questions", name ="questions_page")
//     */
//    public function  questionsPage(){
//        return $this->render('questions.html.twig', ['title' => 'Questions' ]);
//    }

    /**
     * @Route("/question", name="questions_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of questions",
     *     @Model(type=QuestionView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Questions filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="questionsId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="subChaptersId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Questions")
     */
    public function questionsPage(Request $request, QuestionRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('questionsId'),
            $request->request->get('subChaptersId')
        ), 'json'));

        return $this->render('questions.html.twig', ['title' => 'Questions', 'questions'=>json_decode($response->getContent(), true)]);
    }


    /**
     * @Route("/niveau", name="level_Page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of level",
     *     @Model(type=LevelView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Levels filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="levelsId", type="array", @SWG\Items(type="integer")),
     *
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Levels")
     */
    public function levelPage(Request $request, LevelRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('levelId')
        ), 'json'));

        return $this->render('levels.html.twig', ['title' => 'Niveaux', 'levels'=>json_decode($response->getContent(), true)]);
    }
}