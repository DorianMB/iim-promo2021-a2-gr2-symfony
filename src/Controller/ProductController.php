<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product/{id}", name="product")
     * @param $id
     * @return Response
     */
    public function product($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(Product::class)->findOneBy(['id'=>$id]);

        return $this->render('product.html.twig', [
            'repo' => $repo,
            'id' => $id,
        ]);
    }
}
