<?php

namespace App\Controller\main;

use App\Controller\BaseController;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Spec;
use App\Entity\Weapon;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use function PHPUnit\Framework\throwException;

/**
 * @Route("/contact")
 */
class ContactController extends BaseController
{
    /**
     * @Route("/", name="main_contact")
     */

    public function contactAction(Request $request)
    {
        return $this->render('main/contact.html.twig');
    }
}