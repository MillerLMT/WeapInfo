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
 * @Route("/brand")
 */
class BrandController extends BaseController
{
    /**
     * @Route("/", name="main_brand")
     */

    public function allBrandsAction(Request $request)
    {
        $brands = $this->em->getRepository(Brand::class)->findAll();
        $params = ['brands' => $brands];
        return $this->render('main/brands.html.twig', $params);
    }

    /**
     * @Route("/brand", name="brand")
     * @param Request $request
     */
    public function brandAction(Request $request)
    {
        $pageSize = 4;
        $page = 1;

        if ($request->get('pageSize')) {
            $pageSize = $request->get('pageSize');
        }
        if ($request->get('page')) {
            $page = $request->get('page');
        }
        $before = ($page - 1) * $pageSize;
        $after = $pageSize;

        $brand = $this->em->getRepository(Brand::class)->find($request->get('id'));
//        $weapons = $this->em->getRepository(Weapon::class)->findBy(['brand' => $brand]);
        $qb = $this->em->getRepository(Weapon::class)->createQueryBuilder('w');
        $qb->andWhere("w.brand = :brand");
        $qb->setParameters([
            'brand' => $brand
        ]);
        $qb->setFirstResult($before);
        $qb->setMaxResults($after);
        $weapons = $qb->getQuery()->getResult();

        $count = $this->em->getRepository(Weapon::class)->count(['brand' => $brand]);
        $totalPageSize = ceil($count / $pageSize);

        $maxPageOnScreen = 3;
        if ($totalPageSize <= 1) {
            $pageNumbers = [1];
        } elseif ($totalPageSize == 2) {
            $pageNumbers = [1, 2];
        }elseif ($totalPageSize == $maxPageOnScreen) {
            $pageNumbers = [1, 2, 3];
        } else {
            $pageNumbers = [$page];
            $minPage = $page - 1;
            $maxPage = $page + 1;
            if ($minPage == 0) {
                $minPage = $maxPage + 1;
            }
            if ($maxPage > $totalPageSize) {
                $maxPage = $minPage - 1;
            }
            $pageNumbers[] = $minPage;
            $pageNumbers[] = $maxPage;
        }

        asort($pageNumbers);

        $params = [
            'brand' => $brand,
            'weapons' => $weapons,
            'pageSize' => $pageSize,
            'page' => $page,
            'totalPageSize' => $totalPageSize,
            'pageNumbers' => $pageNumbers
        ];
        return $this->render('main/brand.html.twig', $params);
    }

  //  /**
 //    * @Route("/brand", name="weapon")
  //   * @param Request $request
  //   */
  //  public function weaponAction(Request $request)
  //  {

  //      $weapon = $this->em->getRepository(Weapon::class)->find($request->get('id'));
  //      $weapon = $this->em->getRepository(Spec::class)->findBy(['weapon' => $weapon]);
  //      $params = [
  //          'weapon' => $weapon,
 //           'spec' => $spec
  //      ];
  //      return $this->render('main/weapon.html.twig', $params);
 //   }
}