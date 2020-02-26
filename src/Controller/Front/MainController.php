<?php

namespace App\Controller\Front;

use App\Repository\ChapterRepository;
use App\Repository\LevelRepository;
use App\Repository\QuestionRepository;
use App\Repository\SubChapterRepository;
use App\Repository\SubjectRepository;
use App\Repository\ThemeRepository;
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
     * @Route("/level", name="levels_Page", methods={"GET"})
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

    /**
     * @Route("/chapter", name="chapters_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of questions",
     *     @Model(type=ChapterView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Chapters filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="chapterId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="themeId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Chapters")
     */
    public function ChaptersPage(Request $request, ChapterRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('questionsId'),
            $request->request->get('subChaptersId')
        ), 'json'));

        return $this->render('chapters.html.twig', ['title' => 'Chapitres', 'chapters'=>json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/subChapter", name="subChapters_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of subchapter",
     *     @Model(type=SubChapterView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Subchapters filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="subChapterId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="chapterId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="themeId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="SubChapters")
     */
    public function SubChaptersPage(Request $request, SubChapterRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('questionsId'),
            $request->request->get('subChaptersId')
        ), 'json'));

        return $this->render('chapters.html.twig', ['title' => 'Chapitres', 'chapters'=>json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/theme", name="themes_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of themes",
     *     @Model(type=themeView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Themes filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="themeId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="subjectId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="SubChapters")
     */
    public function ThemesPage(Request $request, ThemeRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('themeId'),
            $request->request->get('subjectId')
        ), 'json'));

        return $this->render('themes.html.twig', ['title' => 'Thèmes', 'themes'=>json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/subject", name="subjects_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of subjects",
     *     @Model(type=themeView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Themes filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="subjectId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Subjects")
     */
    public function SubjectsPage(Request $request, SubjectRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('subjectId')
        ), 'json'));

        return $this->render('subjects.html.twig', ['title' => 'Sujet', 'subjects'=>json_decode($response->getContent(), true)]);
    }
}