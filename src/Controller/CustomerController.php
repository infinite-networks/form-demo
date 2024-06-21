<?php

namespace App\Controller;

use App\Form\Type\CustomerType;
use App\Model\Address;
use App\Model\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'customer')]
    public function addAction(Request $request): Response
    {
        $customer = new Customer();
        $customer->name = 'John Smith';

        $customer->addresses[] = $address = new Address();

        $address->line1 = '220 East Cord Road';
        $address->line2 = 'Birchwood';
        $address->postcode = '6161';

        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('Customer/success.html.twig', [
                'customer' => $customer,
            ]);
        }

        return $this->render('Customer/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
