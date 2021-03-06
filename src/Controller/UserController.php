<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */

     public function registration(Request $request,EntityManagerInterface $entityManager,UserPasswordEncoderInterface $encoder)
     {   $user=new User();
         $form=$this->createForm(RegistrationType::class,$user);
         $form->handleRequest($request);
         if(($form->isSubmitted())&&($form->isValid()))
         {  $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $entityManager->persist($user);
         $entityManager->flush();
         return $this->redirectToRoute('login');}
         return $this->render('user/index.html.twig',['form'=>$form->createView()]); }
    
    
     /**
     * @Route("/connexion", name="login")
     */

    public function login(AuthenticationUtils $authenticationUtils)
    {  // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
      

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    
        
    }

     /**
     * @Route("/deconnexion", name="logout")
     */

     public function logout(){}
}