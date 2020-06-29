<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CircuitType;
use App\Entity\Circuit;

class CircuitController extends AbstractController
{
    /**
     * @Route("/circuit", name="circuit")
     */


    
    public function index()
    {   $listCircuit=$this->getDoctrine()->getRepository(Circuit::class)->findAll();
        return $this->render('circuit/index.html.twig', [
            'controller_name' => 'CircuitController','circuits'=>$listCircuit
        ]);
    }
    
  /**
   * @Route("/AddCircuit",name="AddCircuit")
   */
  public function Add(Request $request)
  {$addCircuit=new Circuit();
   $formaddd=$this->createForm('App\Form\CircuitType',$addCircuit);
   $formaddd->handleRequest($request);
   if(($formaddd->isSubmitted())&&($formaddd->isValid()))
   { $man_add=$this->getDoctrine()->getManager();
     $man_add->persist($addCircuit);
     $man_add->flush();
     return $this->redirectToRoute('circuit');

   }
   return $this->render('circuit/addCircuit.html.twig',['circuits'=>$addCircuit,'form'=>$formaddd->createView()]);
}

 /**
   * @Route("/EditCircuit/{id}",name="EditCircuit")
   * @param Circuit $Circuit
   * @return Response
   
*/
public function edit(Circuit $Circuit,Request $request)
{ 
  $man_circuit=$this->getDoctrine()->getManager();
  $formcircuit=$this->createForm('App\Form\CircuitType',$Circuit);
  $formcircuit->handleRequest($request);
  if(($formcircuit->isSubmitted())&&($formcircuit->isValid()))
  {
     $man_circuit->flush();
     return $this->redirectToRoute('circuit');
  }
  return $this->render('circuit/EditCircuit.html.twig',['Circuit'=>$Circuit,'form'=>$formcircuit->createView()]);
}
/**
   * @Route("/deletecircuit/{id}",name="deletecircuit")
   * @param Circuit $delete
   * @param Request $request
   */
 
  public function delete(Circuit $delete,Request $request)
  {   
      $em = $this->getDoctrine()->getManager();
      $em->remove($delete);
      $em->flush();
      return $this->redirectToRoute('circuit');
  }

}
