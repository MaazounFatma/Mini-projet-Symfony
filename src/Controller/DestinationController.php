<?php
namespace App\Controller;
use App\Entity\Circuit;
use App\Entity\Destination;
use App\Entity\EtapeCircuit;
use App\Entity\Ville;
use App\Repository\DestinationRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController {
  
  /**
   * @Route("/Destinations",name="Destinations")
   
*/
 
  public function index(){
    $listDest=$this->getDoctrine()->getRepository(Destination::class)->findAll();
     
    return $this->render('Destination/indx.html.twig',['destination'=>$listDest
    ]);}







 /**
   * @Route("/edit/{id}",name="Destination")
   * @param Destination $Destination
   * @return Response
   
*/
  public function edit(Destination $Destination,Request $request)
  { 
    $man_dest=$this->getDoctrine()->getManager();
    $formDest=$this->createForm('App\Form\DestinationEditType',$Destination);
    $formDest->handleRequest($request);
    if(($formDest->isSubmitted())&&($formDest->isValid()))
    {
       $man_dest->flush();
       return $this->redirectToRoute('Destinations');
    }
    return $this->render('Destination/edit.html.twig',['Destination'=>$Destination,'form'=>$formDest->createView()]);
  }




  /**
   * @Route("/Add",name="NewDestination")
   */
  public function Add(Request $request)
  {$adddest=new Destination();
   $formaddd=$this->createForm('App\Form\DestinationEditType',$adddest);
   $formaddd->handleRequest($request);
   if(($formaddd->isSubmitted())&&($formaddd->isValid()))
   { $man_add=$this->getDoctrine()->getManager();
     $man_add->persist($adddest);
     $man_add->flush();
     return $this->redirectToRoute('Destinations');

   }
   return $this->render('Destination/add.html.twig',['Destination'=>$adddest,'form'=>$formaddd->createView()]);
}







 /**
   * @Route("/delete/{id}",name="delete")
   * @param Destination $delete
   * @param Request $request
   */
 
    public function delete(Destination $delete,Request $request)
    {   
        $em = $this->getDoctrine()->getManager();
        $em->remove($delete);
        $em->flush();
        return $this->redirectToRoute('Destinations');
    }
  
}
