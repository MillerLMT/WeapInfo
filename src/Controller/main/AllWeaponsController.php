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
 * @Route("/allweapons")
 */
class AllWeaponsController extends BaseController
{
    /**
     * @Route("/", name="main_allweapons")
     */
    public function allweaponsAction(Request $request)
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
        $qb = $this->em->getRepository(Weapon::class)->createQueryBuilder('w');
        $qb->setFirstResult($before);
        $qb->setMaxResults($after);
        $weapons = $qb->getQuery()->getResult();
        $count = $this->em->getRepository(Weapon::class)->count([]);
        $totalPageSize = ceil($count / $pageSize);

        $maxPageOnScreen = 3;
        if ($totalPageSize == $maxPageOnScreen) {
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
            'weapons' => $weapons,
            'pageSize' => $pageSize,
            'page' => $page,
            'totalPageSize' => $totalPageSize,
            'pageNumbers' => $pageNumbers
        ];
        return $this->render('main/allweapons.html.twig', $params);
    }



    /**
     * @Route("/weapon", name="weapon")
     * @param Request $request
     */

   public function weaponName(Request $request)
   {
        $weaponId = $request->get('id');
        $weapon = $this->em->getRepository(Weapon::class)->find($weaponId);
        if ($weapon) {
            $params = [
                'weapon' => $weapon
            ];
            if ($spec = $this->em->getRepository(Spec::class)->findOneBy(['weapon' => $weapon])) {
                $params['spec'] = $spec;
            }
            return $this->render('main/weapon.html.twig', $params);
        }
        return $this->render('404.html.twig');
    }

    public function newMethod() {
       return null;
    }
}



