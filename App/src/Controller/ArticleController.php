<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ArticleController extends AbstractFOSRestController
{


     /**
     * Get an Article resource
     * @Rest\Get("api/articles")
     * @param Request $request
     * @return Response
     */
    public function getArticleAction()
    {
        $repository=$this->getDoctrine()->getRepository(Article::class);
        $article=$repository->findall();
        return$this->handleView($this->view($article));

    }
     /**
     * Creates an Article resource
     * @Rest\Post("api/article")
     * @param Request $request
     * @return Response
     */
   
    public function postArticleAction(Request $request)
    {
        $article = new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        return$this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));}
        return$this->handleView($this->view($form->getErrors()));
    
}
}
