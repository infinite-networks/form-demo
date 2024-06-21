<?php

namespace App\Controller;

use App\Form\Type\SalesmanType;
use Doctrine\ORM\EntityManager;
use App\Entity\Area;
use App\Entity\Product;
use App\Entity\Salesman;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Routing\Annotation\Route;

class SalesmanController extends AbstractController
{
	public function __construct(
		private readonly ManagerRegistry $doctrine,
	)
	{
	}

    #[Route('/salesman/add', name: 'salesman_add')]
    public function addSalesmanAction(Request $request): Response
    {
        return $this->editSalesmanAction(new Salesman, $request);
    }

    #[Route('/salesman/{id}/edit', name: 'salesman_edit', requirements: ['id' => '\d+'])]
    public function editSalesmanAction(#[MapEntity] Salesman $salesman, Request $request): Response
    {
        // Verify that some products and areas are defined.
        // This is for demonstration purposes and not part of the normal code path.
        $firstProduct = $this->doctrine->getRepository(Product::class)->findOneBy([]);
        $firstArea = $this->doctrine->getRepository(Area::class)->findOneBy([]);

        if (null === $firstProduct || null === $firstArea) {
            $this->addFlash('product_or_area_not_defined', '');
        }

        $form = $this->createForm(SalesmanType::class, $salesman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($salesman);
            $em->flush();

            $this->addFlash('success', 'Salesman saved.');

            return $this->redirectToRoute('home');
        }

        return $this->render('Salesman/edit.html.twig', [
            'form' => $form->createView(),
            'salesman' => $salesman,
        ]);
    }

    #[Route('/salesman/setup', name: 'salesman_setup')]
    public function loadDefaultsAction(Request $request): Response
    {
        if (!$this->isCsrfTokenValid('salesman_setup', $request->request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();
        $em->getConnection()->executeStatement(sprintf('DELETE FROM %s', $em->getClassMetadata(Product::class)->getTableName()));
        $em->getConnection()->executeStatement(sprintf('DELETE FROM %s', $em->getClassMetadata(Area::class)->getTableName()));

        foreach (['Chair', 'Desk', 'Table'] as $productName) {
            $em->persist($product = new Product);
            $product->setName($productName);
            $product->setCost(100);
            $product->setSellPrice(150);
        }

        foreach (['North side', 'East side', 'Inner north', 'Inner south'] as $areaName) {
            $em->persist($area = new Area());
            $area->setName($areaName);
        }

        $em->flush();

        return $this->redirect($request->headers->get('referer', $this->generateUrl('home')));
    }
}
