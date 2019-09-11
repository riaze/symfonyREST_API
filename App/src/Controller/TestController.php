<?php

namespace App\Controller;

use App\Entity\TaskList;
use App\Repository\TaskListRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\FileParam;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractFOSRestController
{
     /**
     * @taskListRepository
     */
    private $taskListRepository;
    /**
     * @EntityManagerInterface
     */ 
    private $entityManager;
    
    public function __contruct(TaskListRepository $taskListRepository, 
                                EntityManagerInterface $entityManager)
    {
        $this->taskListRepository = $taskListRepository;
        $this->entityManager = $entityManager;

        }
    /**
    * @return \FOS\RestBundle\View\View
    */ 
    public function getListsAction() {
        
        $data = $this->taskListRepository->findAll();
        // $normalizer  = [ new ObjectNormalizer(),];
        // $encoders = [ new JsonEncoder(),];
        // $serializer = new Serializer($normalizer, $encoders);
        // $serializedDate = $serializer->serialize($data, 'json');
    //   response = new JsonResponse(json_encode($data));
    //   $response->headers->set('Content-Type', 'application/json') 
        // return $this->json($serializedDate, 200);
        return $this->view($data, Response::HTTP_OK);
    }

    public function getListAction(int $id){
        $repository = $this->getDoctrine()->getRepository(TaskList::class);
        $data = $repository->findOneBy(['id' => $id]);
        //$data = $this->taskListRepository->findOneBy(['id' => $id]);
        return $this->view($data, Response::HTTP_OK);

        }
    /**
     * 
     * @RequestParam(name="title", description="Note for the task", nullable=true)
     * @param ParamFetcher $paramFetcher
     * 
     * @return \FOS\RestBundle\View\View
     */    

    public function postListsAction(ParamFetcher $paramFetcher)
    {
    
    $title = 'riaze';
    $em = $this->getDoctrine()->getManager();
    
    if($title){
        $list = new TaskList();
        $list->setTitle($title);
        $em->persist($list)->flush();
        
        return $this->view($list, Response::HTTP_OK);
    }
        
        return $this->view(['title' => 'This is not nullable' ], Response::HTTP_BAD_REQUEST);

    }
    public function getListsTaskAction(int $id){
        

    }
    public function putListsAction(){

    }
    public function patchListsAction(int $id){

    }
    /**
     * @FileParam(name="image", description="the backgroud of the list, nullable=fasle, image=true")
     * @param Request request
     * @param ParamFetcher $paramFetcher
     * @param TaskList $list
     * @return \FOS\RESTBundle\View\View
     */
   public function backgroundListAction(Request $resquest, ParamFetcher $paramFetcher, $id){
    $list = $this->taskListRepository->findOneBy(['id'=> $id]);
    $currentBackground = $list->getBackground();
    if(!is_null($currentBackground)){
        $filesystem = new Filesystem();
        $filesystem->remove($this->getUploadDir(). $currentBackground);
    }

    $file = ($paramFetcher->get('image'));

    if($file){
        $filename = mdS(uniqid()) .'.' . $file->guessClientExtension();
        $file->move($this->getUploadsDir().$filename);
    
    $list->setBackground($filename);
    $list->setBackgroundPath('/uploads/'. $filename);
    $this->entityManager->persist($list);
    $this->entityManager->flush();
    $data = $resquest->getUriForPath($list->getBackgroundPath());
    return $this->view($data, Response::HTTP_OK);
   }
   return $this->view($data, Response::HTTP_BAD_REQUEST);
   
}   
    private function getUploadsDir(){
        return $this->getParameter('uploads_dir');
    }
}