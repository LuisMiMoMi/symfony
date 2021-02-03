<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class LlibreController
{
    private $llibres = array(
    array("isbn"  =>  "A111B3",  "titol"  =>  "El   joc   d'Ender",  "autor"=>"Orson Scott Card", "pàgines" => 350),
    array("isbn"  =>  "A222B3",  "titol"  =>  "Shrek",  "autor"=>"No ho se", "pàgines" => 1000),
    array("isbn"  =>  "A333B3",  "titol"  =>  "Harry Potter",  "autor"=>"Patatuela", "pàgines" => 23345632)
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
            $resposta = "";
            $resultat = array_shift($resultat);
            $resposta .= "<ul><li>Titol: " . $resultat["titol"] . "</li>" .
            "<li>Autor/a: " . $resultat["autor"] . "</li>" .
            "<li>Pàgines: " . $resultat["pàgines"] . "</li></ul>";
            return new Response("<html><body>$resposta</body></html>");
        } else {
            return new Response("Llibre no trobat");
        }
        return new Response("Dades del llibre amb isbn $isbn");
    }
}
?>