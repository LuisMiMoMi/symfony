<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Llibre;
use App\Entity\Editorial;

class IniciController extends AbstractController{

    private $llibres;
    /**
    * @Route("/", name="inici")
    */
    public function inici()
    {
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibres = $repositori->findAll();
        return $this->render('inici.html.twig', array('llibres' => $llibres));
    }
}
?>