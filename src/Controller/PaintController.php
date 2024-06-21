<?php

namespace App\Controller;

use App\Form\Type\PaintsType;
use App\Model\Paints;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintController extends AbstractController
{
    #[Route('/paint', name: 'paint')]
    public function paintAction(Request $request): Response
    {
        $paints = new Paints;
        $paints->paints[] = ['color' => 'white', 'finish' => 'high_gloss'];

        $form = $this->createForm(PaintsType::class, $paints);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('Paints/success.html.twig', [
                'paints' => $paints,
            ]);
        }

        return $this->render('Paints/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
