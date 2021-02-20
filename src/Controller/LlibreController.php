<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Llibre;
use App\Entity\Editorial;

class LlibreController extends AbstractController
{
    private $llibres;
    /**
     * @Route("/llibre/inserir", name="inserir_llibre")
    */
    public function inserir(){
        /*$entityManager = $this->getDoctrine()->getManager();
        $llibre = new Llibre();
        $llibre->setIsbn("7777SSSS");
        $llibre->setTitol("Noruega");
        $llibre->setAutor("Rafa Lahuerta");
        $llibre->setPagines(387);
        $entityManager->persist($llibre);
        try {
            $entityManager->flush();
            return new Response("Llibre inserit amb isbn ".$llibre->getIsbn());
        } catch (\Exception $e) {
            return new Response("Error inserint llibre amb isbn ".$llibre->getIsbn());
        }*/
        //$entityManager = $this->getDoctrine()->getManager();
        $llibres = array(
            'llibre1' => array(
                'isbn' => "6666FFFF",
                'titol' => "La sombra de la serpiente",
                'autor' => "Rick Riordan",
                'pagines' => 400
            ),
            'llibre2' => array(
                'isbn' => "5555GGGG",
                'titol' => "El trono de fuego",
                'autor' => "Rick Riordan",
                'pagines' => 250
            ),
            'llibre3' => array(
                'isbn' => "4444HHHH",
                'titol' => "Bat Pat",
                'autor' => "No me acuerdo",
                'pagines' => 789
            )
        );
        $llibre;
        $isbns = "";
        try {
        foreach ($llibres as $elem) {
            $llibre = new Llibre();
            $entityManager = $this->getDoctrine()->getManager();
            $isbns .= $elem["isbn"]." ";
            $llibre->setIsbn($elem["isbn"]);
            $llibre->setTitol($elem["titol"]);
            $llibre->setAutor($elem["autor"]);
            $llibre->setPagines($elem["pagines"]);
            $entityManager->persist($llibre);
            $entityManager->flush();
        }
            return new Response("Llibres inserits amb isbns ".$isbns);
        } catch (\Exception $e) {
            return new Response("Error inserint llibre amb isbn ".$isbns);
        }
    }
/**
     * @Route("/llibre/inserirAmbEditorial", name="inserir_llibre_amb_editorial")
    */
    public function inserirAmbEditorial(){
            $repositori = $this->getDoctrine()->getRepository(Editorial::class);
            $entityManager = $this->getDoctrine()->getManager();
            $nomEditorial = "Bromera";
            $editorial = $repositori->findBy(['nom' => $nomEditorial]);
            if (!$editorial) {
                $editorial = new Editorial();
                $editorial->setNom($nomEditorial);
                $entityManager->persist($editorial);
            }
            $llibre = new Llibre();
            $llibre->setIsbn("9999MMMM");
            $llibre->setTitol("La pirámide roja");
            $llibre->setAutor("Rick Riordan");
            $llibre->setPagines(398);
            $llibre->setEditorial($editorial[0]);
            $entityManager->persist($llibre);
        try {
            $entityManager->flush();
            return new Response("Llibre i editorial inserits amb isbn ".$llibre->getIsbn());
        } catch (\Exception $e) {
            return new Response("Error inserint llibre i editorial amb isbn ".$llibre->getIsbn());
        }
    }
    

    /**
    * @Route("/llibre/{isbn}", name="fitxa_llibre")
    */
    public function fitxa($isbn)
    {
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibre = $repositori->find($isbn);
        if ($llibre) {
            return $this->render('fitxa_llibre.html.twig', array('llibre' => $llibre));
        } else {
            return $this->render('fitxa_llibre.html.twig', array('llibre' => null));
        }
        
    }

    /**
    * @Route("/llibre/pagines/{pagines}", name="pagines_llibres")
    */
    public function filtrarPagines($pagines)
    {
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $qb = $repositori->findByPagines($pagines);
        if ($qb) {
            return $this->render('inici.html.twig', array('llibres' => $qb));
        } else {
            return $this->render('inici.html.twig', array('llibres' => null));
        }
    }
}
?>