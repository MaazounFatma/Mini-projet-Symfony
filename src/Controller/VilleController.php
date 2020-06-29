<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VilleRepository;
use App\Entity\Destination;
use App\Entity\Ville;
use App\Entity\Circuit;

class VilleController extends AbstractController{
   
  
     /**
     * @Route("/ville/{id}", name="ville")
     * @param Destination $dest
     */


    public function index(Destination $dest)
      {     
              $listDest=$this->getDoctrine()->getRepository(Destination::class)->findAll();
         $listVille=$this->getDoctrine()->getRepository(Ville::class)->findBy(['code_dest'=>$dest]);


        return $this->render('ville/index.html.twig', ['villes'=>$listVille,'dest'=>$listDest]);
        }



   /**
   * @Route("/AddVille",name="NewVille")
   */
  public function AddVille(Request $request)
  {$addVille=new Ville();
   $formaddd=$this->createForm('App\Form\VilleType',$addVille);
   $formaddd->handleRequest($request);
   if(($formaddd->isSubmitted())&&($formaddd->isValid()))
   { $man_add=$this->getDoctrine()->getManager();
     $man_add->persist($addVille);
     $man_add->flush();
     $this->addFlash('success', 'La Ville a bien été enregistrée.');
   
     
     return $this->redirectToRoute('NewVille');}

   return $this->render('ville/addville.html.twig',['Ville'=>$addVille,'form'=>$formaddd->createView()]);

  }







  /**
   * @Route("/DeleteVille/{id}",name="DeleteVille")
   * @param Ville $delete
   * @param Request $request
   */
 
  public function delete(Ville $delete,Request $request)
  {   
      $em = $this->getDoctrine()->getManager();
      $em->remove($delete);
      $em->flush();
      return $this->redirectToRoute('Destinations');
      
  }




  


  /**
   * @Route("/EditVille/{id}",name="EditVille")
   * @param Ville $Ville
   * @return Response
   
*/
public function edit(Ville $Ville,Request $request)
{ 
  $man_ville=$this->getDoctrine()->getManager();
  $formville=$this->createForm('App\Form\VilleType',$Ville);
  $formville->handleRequest($request);
  if(($formville->isSubmitted())&&($formville->isValid()))
  {
     $man_ville->flush();
     return $this->redirectToRoute('Destinations');
  }
  return $this->render('ville/EditVille.html.twig',['Ville'=>$Ville,'form'=>$formville->createView()]);
}
    
}
