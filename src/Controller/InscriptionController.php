<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{   
    
    private $entityManagers;


    public function __construct( EntityManagerInterface $entityManager,)
    {

        $this->entityManagers=$entityManager;
    }

    
    #[Route('/inscription', name: 'app_inscription')]
    

  
    public function index(Request $request,UserPasswordHasherInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $password=$encoder-> hashPassword($user,$user->getPassword());
            // dd($password);
            $user->setPassword($password);
            $this->entityManagers->persist($user);
             $this->entityManagers->flush();
        }


        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
