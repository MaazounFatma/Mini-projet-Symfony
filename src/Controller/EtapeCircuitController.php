<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Circuit;
use App\Entity\EtapeCircuit;
class EtapeCircuitController extends AbstractController
{
    /**
     * @Route("/etape/circuit/{id}", name="etape_circuit")
     * @param Circuit $circuit;
     */

    public function index(Circuit $circuit)
    {     
       $listetape=$this->getDoctrine()->getRepository(EtapeCircuit::class)->findBy(['code_circuit'=>$circuit]);

       return $this->render('etape_circuit/index.html.twig', [
        'controller_name' => 'EtapeCircuitController','etapes'=>$listetape
    ]);
      }
 
   /**
   * @Route("/AddEtape",name="NewEtape")
   */
  public function AddEtape(Request $request)
  {$addEtape=new EtapeCircuit();
   $formaddd=$this->createForm('App\Form\EtapeCircuitType',$addEtape);
   $formaddd->handleRequest($request);
   if(($formaddd->isSubmitted())&&($formaddd->isValid()))
   { $man_add=$this->getDoctrine()->getManager();
     $man_add->persist($addEtape);
     $man_add->flush();
     $this->addFlash('success', 'L"étape a bien été enregistrée.');
   
     
     return $this->redirectToRoute('NewEtape');}

   return $this->render('etape_circuit/addetape.html.twig',['Etape'=>$addEtape,'form'=>$formaddd->createView()]);

  }
  
  /**
   * @Route("/EditEtape/{id}",name="EditEtape")
   * @param EtapeCircuit $Etape
   * @return Response
   
*/
public function edit(EtapeCircuit $Etape ,Request $request)
{ 
  $man_etape=$this->getDoctrine()->getManager();
  $formetape=$this->createForm('App\Form\EtapeCircuitType',$Etape);
  $formetape->handleRequest($request);
  if(($formetape->isSubmitted())&&($formetape->isValid()))
  {
     $man_etape->flush();
     return $this->redirectToRoute('circuit');
  }
  return $this->render('etape_circuit/EditEtape.html.twig',['Etape'=>$Etape,'form'=>$formetape->createView()]);
}

  /**
   * @Route("/DeleteEtape/{id}",name="DeleteEtape")
   * @param EtapeCircuit $delete
   * @param Request $request
   */
 
  public function delete(EtapeCircuit $delete,Request $request)
  {   
      $em = $this->getDoctrine()->getManager();
      $em->remove($delete);
      $em->flush();
      return $this->redirectToRoute('circuit');
      
  }




}
