<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Llibre;
use App\Entity\Editorial;
use App\Form\LlibreType;

class LlibreController extends AbstractController
{
    private $llibres;
    /**
     * @Route("/llibre/inserir", name="inserir_llibre")
    */
    public function inserir(){ 
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
    * @Route("/llibre/nou", name="nou_llibre")
    */
    public function nou(Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acces denied');
        $llibre = new Llibre();
        $formulari = $this->createForm(LlibreType::class, $llibre);
        $formulari->handleRequest($request);
        if ($formulari->isSubmitted() && $formulari->isValid()) {
            $llibre = $formulari->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($llibre);
            try {
                $entityManager->flush();
                return $this->redirectToRoute('inici');
            } catch (\Exception $e) {
                return $this->render('nou.html.twig', array('formulari' => $formulari->createView()));
            }
            
        }
        return $this->render('nou.html.twig', array('formulari' => $formulari->createView()));
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

    /**
    * @Route("/llibre/editar/{isbn}", name="editar_llibre")
    */
    public function editar(Request $request, $isbn){
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accés restringit a administradors');
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibre = $repositori->find($isbn);
        $formulari = $this->createForm(LlibreType::class, $llibre);
        $formulari->handleRequest($request);
        if ($formulari->isSubmitted() && $formulari->isValid()) {
            $llibre = $formulari->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($llibre);
            try {
                $entityManager->flush();
                return $this->redirectToRoute('inici');
            } catch (\Exception $e) {
                return $this->render('nou.html.twig', array('formulari' => $formulari->createView()));
            }
            
        }
        return $this->render('nou.html.twig', array('formulari' => $formulari->createView()));
    }
}
?>