<?php

namespace App\Controller;

use App\Entity\Salesman;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
	public function __construct(
		private readonly ManagerRegistry $doctrine,
	)
	{
	}

    #[Route('/', name: 'home')]
    public function indexAction(Request $request): Response
    {
        $salesmen = $this->doctrine->getRepository(Salesman::class)->findBy([], ['name' => 'ASC']);

        return $this->render('dashboard.html.twig', ['salesmen' => $salesmen]);
    }
}
