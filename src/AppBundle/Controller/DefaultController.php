<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/test/setup", name="test_setup")
     */
    public function setupAction()
    {
        $product = new Product();
        $product->setName('Product '.time());

        $category1 = new Category();
        $category1->setName('Category 1-'.time());

        $category2 = new Category();
        $category2->setName('Category 2-'.time());

        $product->addCategory($category1);
        $product->addCategory($category2);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->persist($category1);
        $em->persist($category2);
        $em->flush();

        return $this->redirectToRoute('test_run', array(
            'id' => $product->getId(),
        ));
    }

    /**
     * @Route("/test/run/{id}", name="test_run")
     */
    public function runAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Product');
        /** @var \AppBundle\Entity\Product $product */
        $product = $repo->find($id);

        if (!$id) {
            throw $this->createNotFoundException('Product not found.');
        }

        foreach ($product->getCategories() as $category) {
            $category->removeProduct($product);
        }

        return $this->redirectToRoute('test_check', array(
            'id' => $product->getId(),
        ));
    }

    /**
     * @Route("/test/check/{id}/check", name="test_check")
     */
    public function checkAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Product');
        /** @var \AppBundle\Entity\Product $product */
        $product = $repo->find($id);

        if (!$id) {
            throw $this->createNotFoundException('Product not found.');
        }

        if ($product->getCategories()->count() < 1) {
            die('How is this empty? We never flushed!');
        }

        die('Good!');
    }
}
