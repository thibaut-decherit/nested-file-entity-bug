<?php


namespace App\Controller;


use App\Entity\Company;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller
 */
class CompanyController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/new", name="new", methods={"GET", "POST"})
     * @return Response
     */
    public function new(Request $request): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return new RedirectResponse('new');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
