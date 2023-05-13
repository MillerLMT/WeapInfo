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
 * @Route("/category")
 */
class CategoryController extends BaseController
{
    /**
     * @Route("/", name="main_category")
     */

    public function allCategoriesAction(Request $request)
    {
        $categories = $this->em->getRepository(Category::class)->findAll();
        $params = ['categories' => $categories];
        return $this->render('main/categories.html.twig', $params);
    }

    /**
     * @Route("/category", name="category")
     * @param Request $request
     */
    public function categoryAction(Request $request)
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

        $category = $this->em->getRepository(Category::class)->find($request->get('id'));
        $weapons = $this->em->getRepository(Weapon::class)->findBy(['category' => $category]);
        $qb = $this->em->getRepository(Weapon::class)->createQueryBuilder('w');
        $qb->andWhere("w.category = :category");
        $qb->setParameters([
            'category' => $category
        ]);
        $qb->setFirstResult($before);
        $qb->setMaxResults($after);

        $weapons = $qb->getQuery()->getResult();

        $count = $this->em->getRepository(Weapon::class)->count(['category' => $category]);
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
            'category' => $category,
            'weapons' => $weapons,
            'pageSize' => $pageSize,
            'page' => $page,
            'totalPageSize' => $totalPageSize,
            'pageNumbers' => $pageNumbers
        ];
        return $this->render('main/category.html.twig', $params);
    }
}