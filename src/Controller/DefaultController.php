<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="start")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function start(){
        return $this->redirect('/home/1');
    }
    /**
     * @Route(path="home/{id}", name="homepage")
     * @param $id
     * @return Response
     */
    public function homepage(int $id)
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $repo */
        $limit = 12;
        $offset = ($id-1)*12;
        $repo = $manager->getRepository(Product::class)->findBy([], null, $limit, $offset);

        $repos = $manager->getRepository(Product::class)->findAll();
        $count = count($repos)/12;
        $count = round($count, 0, PHP_ROUND_HALF_UP);

        /*for ($i=101; $i<=100;$i++) {
            $prod = new Product();
            $prod
                ->setName('prod ' . $i)
                ->setDescription('le produit n°' . $i);
            $manager->persist($prod);
        }
        $manager->flush();
        $manager->clear();*/

        /*$prod = new User();
        $prod
            ->setUsername('user')
            ->setEmail('user@user.fr')
            ->setPlainPassword('user');
        $manager->persist($prod);
        $manager->flush();*/

        return $this->render('homepage.html.twig', [
            'repo' => $repo,
            'id' => $id,
            'count' => $count,
        ]);
    }
}