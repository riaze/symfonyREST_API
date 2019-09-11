<?php

namespace App\Controller;

use PDO;
use App\Entity\TaskList;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DbController extends AbstractController
{
    private $host = '172.17.0.2:3306';
    private $db_name = 'restful';
    private $username = 'root';
    private $password = 'riazeahamed143';
    private $conn;
    
    /**
     * @Route("/db", name="db")
     */
    public function index()
    {
        $this->conn= null;
        try{
             phpinfo();die();
            
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username, $this->password);
            echo "goof";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     
        }
        catch(PDOException $e){
            echo 'connection Error' . $e->getMessage();
        }
    }

    /**
     
     * @Route("/postttt", name="post")
     */
    public function Lists()
    {
        $em = $this->getDoctrine()->getManager();
        $title = 'hai';
        $number = 5;

        if($title){
            
            $list = new TaskList();
            $list->setTitle($title);
            $em->persist($list);
            $em->flush();
            return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
            );
        }
        
    
    return new Response(
        '<html><body>Lucky number: wrong </body></html>'
    );    
    //return $this->view(['title' => 'This is not nullable' ], Response::HTTP_BAD_REQUEST);

    }

    /**
     * @return Response
     * @Route("/count", name="count")
     */
    public function Home(Request $request): Response
    {
        $list=$this->getDoctrine()
                      ->getRepository(TaskList::class)->findAll();
        return $this->render('db_connection/index.html.twig', ['list'=>$list
        ]);

    }
    /**
    *  @Route("/curl/{title}", name="curl")
    */
    public function curlPost(){
        $title = 'this new title';
         
        
         
        // Prepare new cURL resource
        $ch = curl_init('http://172.22.0.1:82/api/lists');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $title);
         
        // Set HTTP Header for POST request 
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Content-Length: ' . strlen($title))
        // );
         
        // Submit the POST request
        $result = curl_exec($ch);
         
        // Close cURL session handle
        curl_close($ch);
         
        
    }

    /**
     * 
     * @RequestParam(name="title", description="Note for the task", nullable=true)
     * @param ParamFetcher $paramFetcher
     * @Route("/test", name="test")
     * @return \FOS\RestBundle\View\View
     */    

    public function test(ParamFetcher $paramFetcher)
    {
        $title = $paramFetcher->get('title');
        
        return $this->render('db_connection/getUsers.html.twig', ['var' => $title] );
    }
}
