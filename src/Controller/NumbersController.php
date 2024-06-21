<?php

namespace App\Controller;

use App\Form\Type\NumbersType;
use App\Model\Numbers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumbersController extends AbstractController
{
    #[Route('/numbers', name: 'numbers')]
    public function numbersAction(Request $request): Response
    {
        $numbers = new Numbers();
        $numbers->numbers[] = 5;

        $form = $this->createForm(NumbersType::class, $numbers);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('Numbers/success.html.twig', [
                'numbers' => $numbers,
            ]);
        }

        return $this->render('Numbers/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
