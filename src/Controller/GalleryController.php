<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\Type\GalleryType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
	public function __construct(
		private readonly ManagerRegistry $doctrine,
	)
	{
	}

    #[Route('/gallery/', name: 'gallery_list')]
    public function listAction(): Response
    {
        return $this->render('Gallery/list.html.twig', [
            'galleries' => $this->doctrine->getRepository(Gallery::class)->findAll(),
        ]);
    }

    #[Route('/gallery/add', name: 'gallery_add')]
    public function addAction(Request $request): Response
    {
        $gallery = new Gallery;
        $form = $this->createForm(GalleryType::class, $gallery);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('gallery_list');
        }

        return $this->render('Gallery/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/gallery/{id}/edit', name: 'gallery_edit', requirements: ['id' => '\d+'])]
    public function editAction(Request $request, #[MapEntity] Gallery $gallery): Response
    {
        $em = $this->doctrine->getManager();
        $form = $this->createForm(GalleryType::class, $gallery);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('gallery_list');
        }

        $em->refresh($gallery);

        return $this->render('Gallery/edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form->createView(),
        ]);
    }
}
