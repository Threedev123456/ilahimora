<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Formulaire;
use App\Entity\ImageTopBlog;
use App\Entity\ImageTopHome;
use App\Entity\News;
use App\Entity\Produits;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ilahimora');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Admin', 'fas fa-user-lock', User::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user-plus', News::class);
        yield MenuItem::linkToCrud('Commande-list','fas fa-address-book',Formulaire::class);
        yield MenuItem::linkToCrud('Message','fas fa-sms',Contact::class);
        yield MenuItem::linkToCrud('Image Top Home', 'fas fa-image', ImageTopHome::class);
        yield MenuItem::linkToCrud('Category','fas fa-archive',Category::class);
        yield MenuItem::linkToCrud('Production','fas fa-couch',Produits::class);
        yield MenuItem::linkToCrud('Image-Top-Blog','fas fa-image',ImageTopBlog::class);
        yield MenuItem::linkToCrud('Blog','fas fa-receipt',Blog::class);
        yield MenuItem::linkToCrud('About','fas fa-receipt',About::class);
    }
}
