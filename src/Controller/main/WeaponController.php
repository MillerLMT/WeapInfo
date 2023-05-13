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
 * @Route("/weapon(id")
 */
class WeaponController extends BaseController

{
    /**
     * @Route("/index", name="main_weapon")
     * @Template()
     */
     public function WeaponAction(){

     }
}
