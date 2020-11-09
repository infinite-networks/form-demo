<?php

namespace App\Controller;

use App\Entity\Country;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Infinite\FormBundle\Form\Type\EntitySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class CountryController extends AbstractController
{
    /**
     * @Route("/country/", name="country")
     * @param Request $request
     */
    public function countryAction(Request $request)
    {
        // Verify that there are some countries in the database.
        // If not, prompt the user to click a button to create them.
        $firstCountry = $this->getDoctrine()->getRepository(Country::class)->findOneBy([]);

        if (null === $firstCountry) {
            $this->addFlash('country_not_defined', '');
        }

        $form = $this->createForm(EntitySearchType::class, null, [
            'class' => Country::class,
            'name' => 'name',
            'attr' => ['placeholder' => 'Start typing to search for a country ...'],
            'search_route' => 'country_search_json',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('Country/success.html.twig', [
                'country' => $form->getData(),
            ]);
        }

        return $this->render('Country/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/country/setup", name="country_setup")
     * @return Response
     */
    public function loadCountriesAction(Request $request)
    {
        $expectedToken = $this->get('security.csrf.token_manager')->getToken('country_setup')->getValue();

        if (!hash_equals($expectedToken, $request->request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->executeUpdate(sprintf('DELETE FROM %s', $em->getClassMetadata(Country::class)->getTableName()));

        foreach (Countries::getNames('en') as $countryName) {
            $em->persist($country = new Country());
            $country->setName($countryName);
        }

        $em->flush();

        return $this->redirect($request->headers->get('referer', $this->generateUrl('home')));
    }

    /**
     * @Route("/country/search.json", name="country_search_json")
     *
     * @return Response
     */
    public function countrySearchJson(Request $request)
    {
        $query = $request->query->get('query');

        /** @var EntityRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Country::class);

        $qb = $repo->createQueryBuilder('c');
        $qb->andWhere('c.name LIKE :match');
        $qb->setParameter('match', '%' . strtr($query, [' ' => '%']) . '%');
        $qb->setMaxResults(20);

        $results = [];

        foreach ($qb->getQuery()->getResult() as $country) {
            /** @var Country $country */
            $results[] = [
                'id' => $country->getId(),
                'name' => $country->getName(),
            ];
        }

        return new JsonResponse(['results' => $results]);
    }
}
