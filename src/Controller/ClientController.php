<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client", name="client.")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="consultAll")
     * @param ClientRepository $clientRepository
     * @return Response
     */
    public function index(ClientRepository $clientRepository)
    {
        // Fetch all the clients
        $clients = $clientRepository->findAll();

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/ajouter" , name="add")
     * @Route("/modifier/{idClient}" , name="update" )
     * @param Request $request
     * @param Client|null $client
     * @return Response
     */
    public function add(Request $request, Client $client = null) {
        // create client
        if (!$client){
            $client = new Client();
        }
        //
        //create a form
        $form = $this->createForm(ClientType::class , $client);


        $form->handleRequest($request);
        dump($client);

        if ($form->isSubmitted() && $form->isValid()) {
            // create the manager
            $e_m = $this->getDoctrine()->getManager();

            // Pass some conditions on the client

            // Add other attributes to $client
            $idClient = "";
            $client->setIdClient($idClient);

            // Prepare + Push
            $e_m->persist($client);
            $e_m->flush();

            // Return to client single page
            return $this->render('' , [
                'idClient'  =>$client->getIdClient()
            ]);

        }

        return $this->render('client/consult.html.twig',[
            "form_client"      =>$form->createView()
        ]);
    }

    /**
     * @Route("/consulter/{idClient}", name="consultOne")
     * @param Client $client
     * @return Response
     */
    public function consultOne(Client $client) {
        // We have already have $client from paramConverter

        return $this->render('client/consult.html.twig', [
            'client'      =>$client
        ]);
    }

    /**
     * @Route("supprimer/{idClient}", name="delete")
     * @param Client $client
     * @return Response
     */
    public function deleteOne(Client $client){

        // We have already $client to delete

        //Check if $client not null
        if($client){

            // import doctrine manager
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);

            // Push to the database
            $em->flush();
        }
        return $this->redirect($this->generateUrl('client.consultAll'));
    }

    /**
     * @Route("/consulter/{idClient}/factures" , name="consultFactures")
     */
    public function consultFactures() {
        return $this->render('', [

        ]);
    }
}
