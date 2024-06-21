<?php

namespace App\Controller;

use App\Form\Type\InvoiceType;
use App\Model\Invoice;
use App\Model\InvoiceFreightLine;
use App\Model\InvoiceProductLine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice/', name: 'invoice_add')]
    public function invoiceCreateAction(Request $request): Response
    {
        $invoice = new Invoice();
        $invoice->recipient = 'John Smith';

        $invoice->lines[] = $productLine = new InvoiceProductLine();
        $productLine->setProductName('New Atlas 2016 Edition');
        $productLine->setQuantity(2);
        $productLine->setUnitPrice(104.95);

        $invoice->lines[] = $freightLine = new InvoiceFreightLine();
        $freightLine->setUnitPrice(15);
        $freightLine->setCourier('Overnight Couriers');

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('Invoice/success.html.twig', [
                'invoice' => $invoice,
            ]);
        }

        return $this->render('Invoice/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
