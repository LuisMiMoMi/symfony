<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class LlibreController extends AbstractController
{
    private $llibres = array(
    array("isbn"  =>  "A111B3",  "titol"  =>  "El   joc   d'Ender",  "autor"=>"Orson Scott Card", "pagines" => 350),
    array("isbn"  =>  "A222B3",  "titol"  =>  "Shrek",  "autor"=>"No ho se", "pagines" => 1000),
    array("isbn"  =>  "A333B3",  "titol"  =>  "Harry Potter",  "autor"=>"Patatuela", "pagines" => 23345632)
    );
    /**
    * @Route("/llibre/{isbn}", name="fitxa_llibre")
    */
    public function fitxa($isbn)
    {
        $resultat = array_filter($this->llibres,
        function($llibre) use ($isbn)
        {
            return $llibre["isbn"] == $isbn;
        });
        if (count($resultat) > 0) {
            return $this->render('fitxa_llibre.html.twig', array('llibre' => array_shift($resultat)));
        } else {
            return $this->render('fitxa_llibre.html.twig', array('llibre' => null));
        }
    }
}
?>