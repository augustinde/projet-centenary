<?php

namespace App\Controller;

use App\Entity\Centenary;
use App\Form\CentenaryType;
use App\Repository\CentenaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/centenary')]
class CentenaryController extends AbstractController
{
    #[Route('/', name: 'app_centenary_index', methods: ['GET'])]
    public function index(CentenaryRepository $centenaryRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
		$dql = "SELECT c FROM App:Centenary c";
		$query = $em->createQuery($dql);

		$pagination = $paginator->paginate(
			$query,
			$request->query->getInt('page',1),
			1
		);

        return $this->render('centenary/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_centenary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CentenaryRepository $centenaryRepository): Response
    {
        $centenary = new Centenary();
        $form = $this->createForm(CentenaryType::class, $centenary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

			$centenary->setUpdatedAt(new \DateTimeImmutable('now'));
			$centenary->setUser($this->getUser());
            $centenaryRepository->add($centenary, true);

            return $this->redirectToRoute('app_centenary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centenary/new.html.twig', [
            'centenary' => $centenary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centenary_show', methods: ['GET'])]
    public function show(Centenary $centenary): Response
    {
        return $this->render('centenary/show.html.twig', [
            'centenary' => $centenary,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centenary_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Centenary $centenary, CentenaryRepository $centenaryRepository): Response
    {
        $form = $this->createForm(CentenaryType::class, $centenary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centenaryRepository->add($centenary, true);

            return $this->redirectToRoute('app_centenary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('centenary/edit.html.twig', [
            'centenary' => $centenary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centenary_delete', methods: ['POST'])]
    public function delete(Request $request, Centenary $centenary, CentenaryRepository $centenaryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centenary->getId(), $request->request->get('_token'))) {
            $centenaryRepository->remove($centenary, true);
        }

        return $this->redirectToRoute('app_centenary_index', [], Response::HTTP_SEE_OTHER);
    }
}
