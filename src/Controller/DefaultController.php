<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index():Response
    {
        $performances = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        if (!$performances) {
            throw $this->createNotFoundException(
                'No performance found in performance\'s table.'
            );
        }
        return $this->render('wild/index.html.twig', [
            'performances' => $performances,
        ]);
    }

}
