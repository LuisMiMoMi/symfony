<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Jenssegers\Date\Date;
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
        Date::setLocale('ca');
        $date = Date::now()->format('l j \de F Y\, \c\a\r\r\e\g\a\t \a \l\e\s h:i:s');
        $date = ucfirst($date);
        return $this->render('inici.html.twig', array('llibres' => $llibres, 'date' => $date));
    }
}
?>