<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\EditorialCrudController;
use App\Controller\Admin\LlibreCrudController;
use App\Controller\Admin\UsuariCrudController;
use App\Entity\Editorial;
use App\Entity\Usuari;
use App\Entity\Llibre;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->
            setController(LlibreCrudController::class, 
            EditorialCrudController::class,
            UsuariCrudController::class)->
            generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LibrosLuis');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoCrud('Llibres', 'fas fa-list', Llibre::class);
        yield MenuItem::linktoCrud('Editorials', 'fas fa-list', Editorial::class);
        yield MenuItem::linktoCrud('Usuaris', 'fas fa-list', Usuari::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
