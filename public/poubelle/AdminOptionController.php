<?php
//
//namespace App\Controller\Admin;
//
//use App\Entity\Option;
//use App\Form\OptionCreationType;
//use App\Repository\OptionRepository;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
//use function PHPUnit\Framework\throwException;
//
//
//class AdminOptionController extends AbstractController
//{
//    public function index(OptionRepository $optionRepository): Response
//    {
//        return $this->render('admin/option/index.html.twig', [
//            'options' => $optionRepository->findAll(),
//        ]);
//    }
//
//    public function new(Request $request): Response
//    {
//        $option = new Option();
//        $form = $this->createForm(OptionCreationType::class, $option);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($option);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('admin/option/new.html.twig', [
//            'option' => $option,
//            'form' => $form,
//        ]);
//    }
//
//
//    public function edit(Request $request, Option $option): Response
//    {
//        $form = $this->createForm(OptionCreationType::class, $option);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('admin/option/edit.html.twig', [
//            'option' => $option,
//            'form' => $form,
//        ]);
//    }
//
//
//    public function delete(Request $request, Option $option): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($option);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('admin.option.index', [], Response::HTTP_SEE_OTHER);
//    }
//}
