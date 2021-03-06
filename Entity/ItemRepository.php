<?php

namespace Sulu\Bundle\Sales\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Item|null
     */
    public function findById($id)
    {
        try {
            $qb = $this->createQueryBuilder('item')
                ->andWhere('item.id = :itemId')
                ->setParameter('itemId', $id);

            return $qb->getQuery()->getSingleResult();
        } catch (NoResultException $exc) {
            return null;
        }
    }

    /**
     * Returns all items in the given locale
     * @param string $locale The locale of the item to load
     * @return Item[]|null
     */
    public function findAllByLocale($locale)
    {
        try {
            return $this->getItemQuery($locale)->getQuery()->getResult();
        } catch (NoResultException $exc) {
            return null;
        }
    }

    /**
     * Returns all items and filters them
     * @param $locale
     * @param array $filter
     * @return Item[]|null
     */
    public function findByLocaleAndFilter($locale, array $filter)
    {
        try {
            $qb = $this->getItemQuery($locale);

            foreach ($filter as $key => $value) {
                switch ($key) {
                    case 'status':
                        $qb->andWhere('status.id = :' . $key);
                        $qb->setParameter($key, $value);
                        break;
                }
            }

            $query = $qb->getQuery();
            return $query->getResult();
        } catch (NoResultException $ex) {
            return null;
        }
    }

    /**
     * Finds an item by id and locale
     * @param $id
     * @param $locale
     * @return Item|null
     */
    public function findByIdAndLocale($id, $locale)
    {
        try {
            $qb = $this->getItemQuery($locale);
            $qb->andWhere('item.id = :itemId');
            $qb->setParameter('itemId', $id);

            return $qb->getQuery()->getSingleResult();
        } catch (NoResultException $exc) {
            return null;
        }
    }

    /**
     * Returns query for items
     * @param string $locale The locale to load
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getItemQuery($locale)
    {
        $qb = $this->createQueryBuilder('item')
            ->setParameter('locale', $locale);
        return $qb;
    }
}
