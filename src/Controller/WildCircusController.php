<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wild", name="wild_")
 */
class WildCircusController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index() :Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Circus',
        ]);
    }
    /**
     * @Route("/show/{page}",
     *     requirements={"page"="\d+"},
     *     defaults={"page"=1},
     *     name="show"
     * )
     */
    public function show(int $page): Response
    {
        return $this->render('wild/show.html.twig', ['page' => $page]);
    }
}
