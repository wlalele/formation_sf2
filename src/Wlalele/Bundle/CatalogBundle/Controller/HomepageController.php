<?php

namespace Wlalele\Bundle\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
        $show_product_form = $this->createShowProductForm();

        return array(
            'entity'      => $entity,
            'articles'    => $articles,
            'show_product_form' => $show_product_form->createView(),
        );
    }

    private function createShowProductForm()
    {
        $form = $this->createForm(new ShowProductType());


        return $form;
    }
}