<?php

namespace App\Controller;

use App\Entity\ListOfItems;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListOfItemController extends AbstractController
{
    /**
     * @Route("/", name="list_of_item")
     */
    public function index()
    {
        $alertMessageType = '';
        $alertMessage = '';
        $listItems = $this->getAllItems();
        if (empty($listItems)) {
            $alertMessage = 'there is no items';
            $alertMessageType = 'warning';
        }
        return $this->render('list_of_item/index.html.twig', [
            'listItems' => $listItems,
            'alertMessageType' => $alertMessageType,
            'alertMessage' => $alertMessage,
        ]);
    }

    /**
     * @Route("/createNewItem", name="createNewItem")
     */
    public function createNewItem()
    {

        if (!$_POST)
            return $this->render('list_of_item/index.html.twig', [
                'listItems' => $this->getAllItems(),
                'alertMessageType' => "danger",
                'alertMessage' => "Your item is not created",

            ]);

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $item = new ListOfItems();
        if (isset($_POST['txtItem']) && !empty($_POST['txtItem'])) {
            $newItem = str_replace('  ', ' ', $_POST['txtItem']);
            if (!empty($newItem)) {
                $item->setName($newItem);
                $item->setCreateDate(new \DateTime());
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($item);
                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            }
        }


        return $this->render('list_of_item/index.html.twig', [
            'listItems' => $this->getAllItems(),
            'alertMessageType' => "success",
            'alertMessage' => "Your new item is created",

        ]);
    }

    /**
     * @Route("/delteItem", name="delteItem")
     */
    public function delteItem()
    {

        if (!$_POST)
            return $this->render('list_of_item/index.html.twig', [
                'listItems' => $this->getAllItems(),
                'alertMessageType' => "danger",
                'alertMessage' => "Your item is not Deleted",

            ]);

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $itemsSelected = $_POST['itemsSelected'];
        $itemsSelected = explode(',', $itemsSelected);
        foreach ($itemsSelected as $item) {
            $item = $this->getDoctrine()->getRepository(ListOfItems::class)->find($item);
            if (empty($item))
                break;
            $entityManager->remove($item);
//             actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        }


        return $this->render('list_of_item/index.html.twig', [
            'listItems' => $this->getAllItems(),
            'alertMessageType' => "success",
            'alertMessage' => "Your new item is delted",

        ]);
    }

    protected function getAllItems()
    {
        return $this->getDoctrine()->getRepository(ListOfItems::class)->findAll();
    }
}
