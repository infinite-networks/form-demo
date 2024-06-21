<?php

namespace App\Controller;

use App\Entity\Appliance;
use App\Form\Type\ApplianceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplianceController extends AbstractController
{
	public function __construct(
		private readonly ManagerRegistry $doctrine,
	)
	{
	}

	#[Route('/appliance/', name: 'appliance_list')]
    public function listAction(): Response
    {
        return $this->render('Appliance/list.html.twig', [
            'appliances' => $this->doctrine->getRepository(Appliance::class)->findAll(),
        ]);
    }

    #[Route('/appliance/add', name: 'appliance_add')]
    public function addAction(Request $request): Response
    {
        $appliance = new Appliance;
        $form = $this->createForm(ApplianceType::class, $appliance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($appliance);
            $em->flush();

            return $this->redirectToRoute('appliance_list');
        }

        return $this->render('Appliance/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/appliance/{id}/edit', name: 'appliance_edit', requirements: ['id' => '\d+'])]
    public function editAction(Request $request, #[MapEntity] Appliance $appliance): Response
    {
        $em = $this->doctrine->getManager();
        $form = $this->createForm(ApplianceType::class, $appliance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($appliance);
            $em->flush();

            return $this->redirectToRoute('appliance_list');
        }

        $em->refresh($appliance); // Makes the page title accurate. (But only safe if Appliance::$manual doesn't cascade refresh)

        return $this->render('Appliance/edit.html.twig', [
            'appliance' => $appliance,
            'form' => $form->createView(),
        ]);
    }
}
