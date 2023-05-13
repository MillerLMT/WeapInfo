<?php

namespace App\Controller\main;

use App\Controller\BaseController;
use App\Entity\brand;
use App\Entity\category;
use App\Entity\spec;
use App\Entity\Weapon;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use function PHPUnit\Framework\throwException;

/**
 * @Route("/main")
 */
class MainController extends BaseController
{
    /**
     * @Route("/index", name="main")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('main/index.html.twig');
    }

  //  #[Route('/category', name: 'main_category')]
  //  public function catAction(Request $request)
  //  {
  //      return $this->render('main/categories.html.twig');
  //  }
//    #[Route('/brand', name: 'main_brand')]
  //  public function brandAction(Request $request)
  //  {
   //     $brands = $this->em->getRepository(Brand::class)->findAll();
    //    $params = ['brands' => $brands];
    //    return $this->render('main/brand.html.twig', $params);
   // }
   // #[Route('/allweapons', name: 'main_allweapons')]
  //  public function allweaponsAction(Request $request)
  //  {
//        print_r('gagag');die();
   //     $weapons = $this->em->getRepository(Weapon::class)->findAll();
//        print_r($weapons);die();
   //     $params = ['weapons' => $weapons];
   //     return $this->render('main/allweapons.html.twig', $params);
  //  }

 //   #[Route('/allweapons', name: 'weapon')]
 //  public function weaponName(Request $request) {
  //      $weaponId = $request->get('id');
  //      $weapon = $this->em->getRepository(Weapon::class)->find($weaponId);
  //     $spec = $this->em->getRepository(Spec::class)->findOneBy(['weapon' => $weapon]);
  //      $params = [
  //          'weapon' => $weapon,
  //         'spec' => $spec
    //   ];
   //     return $this->render('main/allweapons.html.twig', $params);
  //  }

 //   #[Route('/contact', name: 'main_contact')]
  //  public function contactAction(Request $request)
  //  {
  //      return $this->render('main/contact.html.twig');
  //  }

 //   #[Route('/weapon', name: 'gun')]
 //   public function weaponsName(Request $request)
  //  {
   //     $weaponId = $request->get('id');
   //     $weapon = $this->em->getRepository(Weapon::class)->find($weaponId);
   //     $spec = $this->em->getRepository(Spec::class)->findOneBy(['weapon' => $weapon]);
   //     $params = [
     //       'weapon' => $weapon,
    //        'spec' => $spec
    //    ];
    //    return $this->render('main/weapon.html.twig');
 //   }
}

