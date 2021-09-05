<?php

namespace App\Controller;



use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;

    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index() : Response
    {
        // Ajouter un bien dans la BDD :
//        $property = new Property();
//        $property->setTitle('Mon premier bien')
//            ->setPrice(250000)
//            ->setRooms(4)
//            ->setBedrooms(3)
//            ->setDescription('Une petite description')
//            ->setSurface(60)
//            ->setFloor(4)
//            ->setHeat(1)
//            ->setCity('Mayenne')
//            ->setAdress('15 place de l\'église')
//            ->setPostalCode('53000');
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($property);
//        $em->flush();

//        $repository = $this->getDoctrine()->getRepository(Property::class);
//        dump($repository);

//        $property = $this->repository->findAllVisible();
//        $property[0]->setSold(true);
//        $this->em->flush();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @return Response
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}