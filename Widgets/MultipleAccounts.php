<?php
/*
  * This file is part of the Sulu CMS.
  *
  * (c) MASSIVE ART WebServices GmbH
  *
  * This source file is subject to the MIT license that is bundled
  * with this source code in the file LICENSE.
  */

namespace Sulu\Bundle\Sales\CoreBundle\Widgets;

use Sulu\Bundle\AdminBundle\Widgets\WidgetInterface;
use Sulu\Bundle\AdminBundle\Widgets\WidgetParameterException;
use Sulu\Bundle\AdminBundle\Widgets\WidgetEntityNotFoundException;
use Doctrine\ORM\EntityManager;
use Sulu\Bundle\ContactBundle\Entity\Account;
use Sulu\Bundle\ContactBundle\Entity\Address;
use Sulu\Bundle\ContactBundle\Entity\Contact;
/**
 * SimpleAccount widget
 *
 * @package Sulu\Bundle\Sales\CoreBundle\Widgets
 */
class MultipleAccounts implements WidgetInterface
{
    protected $em;

    protected $widgetName = 'MultipleAccounts';
    protected $accountEntityName = 'SuluContactBundle:Account';

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * return name of widget
     *
     * @return string
     */
    public function getName()
    {
        return 'multiple-accounts';
    }

    /**
     * returns template name of widget
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'SuluSalesCoreBundle:Widgets:core.multiple.accounts.html.twig';
    }

    /**
     * returns data to render template
     *
     * @param array $options
     * @throws WidgetEntityNotFoundException
     * @throws WidgetParameterException
     * @return array
     */
    public function getData($options)
    {
        if (!empty($options) &&
            array_key_exists('accountIds', $options) &&
            !empty($options['accountIds'])
        ) {
            $data = array();

            $accountIds = explode(',', $options['accountIds']);
            foreach ($accountIds as $id) {
                $account = $this->em->getRepository($this->accountEntityName)->find($id);
                if (!$account) {
                    throw new WidgetEntityNotFoundException(
                        'Entity ' . $this->accountEntityName . ' with id ' . $id . ' not found!',
                        $this->widgetName,
                        $id
                    );
                }
                $data[] = $this->parseAccount($account);
            }

            return $data;
        } else {
            throw new WidgetParameterException(
                'Required parameter contact not found or empty!',
                $this->widgetName,
                'account'
            );
        }
    }

    /**
     * Parses the account data
     *
     * @param Account $account
     * @return array
     */
    protected function parseAccount(Account $account)
    {
        if ($account) {
            $data = [];
            $data['id'] = $account->getId();
            $data['name'] = $account->getName();
            $data['phone'] = $account->getMainPhone();
            $data['email'] = $account->getMainEmail();
            $data['url'] = $account->getMainUrl();
            // get main contact
            if ($mainContact = $account->getMainContact()) {
                $data['contact'] = $account->getMainContact()->getFullName();
            }

            /* @var Address $accountAddress */
            $accountAddress = $account->getMainAddress();

            if ($accountAddress) {
                $data['address']['street'] = $accountAddress->getStreet();
                $data['address']['number'] = $accountAddress->getNumber();
                $data['address']['zip'] = $accountAddress->getZip();
                $data['address']['city'] = $accountAddress->getCity();
                $data['address']['country'] = $accountAddress->getCountry(
                )->getName();
            }

            return $data;
        } else {
            return null;
        }
    }
}