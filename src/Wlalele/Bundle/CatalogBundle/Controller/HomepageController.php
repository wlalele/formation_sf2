<?php

namespace Wlalele\Bundle\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Wlalele\Bundle\CatalogBundle\Entity\ChoiceArticle;
use Wlalele\Bundle\CatalogBundle\Entity\Product;
use Wlalele\Bundle\CatalogBundle\Form\ShowProductType;

/**
 * Class HomepageController
 * @package Wlalele\Bundle\CatalogBundle\Controller
 *
 * @Route("/")
 */
class HomepageController extends Controller
{
    /**
     * Lists all Product entities randomly.
     *
     * @Route("/", name="product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WlaleleCatalogBundle:Product')->findRandomly();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Show Product
     *
     * @Route("/product/{id}", name="homepage_product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WlaleleCatalogBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $articles = $em->getRepository('WlaleleCatalogBundle:Article')->getArticlesByProductId($id);
        $show_product_form = $this->createShowProductForm($entity);

        return array(
            'entity'      => $entity,
            'articles'    => $articles,
            'show_product_form' => $show_product_form->createView(),
        );
    }

    private function createShowProductForm($entity)
    {
        $form = $this->createForm(new ShowProductType(), new ChoiceArticle($entity), array(
            'action' => $this->generateUrl('basket_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add to basket'));

        return $form;
    }

    /**
     * @var request
     * @Route("/basket/add", name="basket_add")
     * @Method("POST")
     * @Template()
     */
    public function addToBasketAction(Request $request)
    {
        $entity = new ChoiceArticle(new Product());

        $article_form = $this->createForm(new ShowProductType(), $entity, array());
        $article_form->handleRequest($request);

        if (!$this->get('session')->has('basket')) {
            $basket = [$entity];
        } else {
            $basket[] = $entity;
        }

        $this->get('session')->set('basket', $basket);

        return $this->redirect($request->headers->get('referer'));
    }
}