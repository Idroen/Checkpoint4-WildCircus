<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Performance;
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
    public function index(): Response
    {
        $performance = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findAll();
        if (!$performance) {
            throw $this->createNotFoundException(
                'No performance found in performance\'s table.'
            );
        }
        return $this->render('wild/index.html.twig', [
            'performance' => $performance,
        ]);
    }

    /**
     *@param string $slug The slugger
     * @Route("/show/{slug}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in performance\'s table .');
        }
        $performance = $this->getDoctrine()
            ->getRepository(Performance::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$performance) {
            throw $this
                ->createNotFoundException('No performance with ' . $slug . ' has been sent to find a program in performance\'s table .');
        }
        return $this->render('wild/show.html.twig', [
            'performance' => $performance,
            'slug' => $slug,
        ]);
    }

    /**
     * @Route("/category/{slug}", defaults={"slug" = null}, name="category")
     * @return Response
     */
    public function showByCategory(string $categoryName): Response
    {
        if (!$categoryName) {
            throw $this
                ->createNotFoundException('No category has been sent to find a category in category\'s table.');

            $category = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findOneBy(['name' => mb_strtolower($categoryName)]);
            if (!$category) {
                throw $this->createNotFoundException('No category with ' . $categoryName . 'found in category\'s table.');
            }
            return $this->render('wild/show.html.twig', [
                'performance' => $performance,
                'category' => $category,
            ]);
        }
    }
}
