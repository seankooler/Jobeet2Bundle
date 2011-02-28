<?php

namespace Application\Jobeet2Bundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryController extends ContainerAware
{
	private $request;
    private $repository;
    private $router;
    private $templating;
	
	/**
     * Constructor.
     *
     * @param Request               $request
     * @param EntityRepository    $repository
     * @param UrlGeneratorInterface $router
     * @param EngineInterface       $templating
     */
    public function __construct(Request $request, EntityRepository $repository, UrlGeneratorInterface $router, EngineInterface $templating)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->router = $router;
        $this->templating = $templating;
    }
    
    
    public function indexAction()
    {
    }

    public function showAction($slug)
    {      
        
        $category = $this->repository->findOneBySlug($slug);
        
        if (!$category) {
            throw new NotFoundHttpException('The Category does not exist.');
        }
        
        $page = $this->request->query->get('page', 1);
   
        return $this->templating->renderResponse('Jobeet2Bundle:Category:show.html.twig',
            array('category'    => $category,
                  'page'        => $page));
        
    }
}
