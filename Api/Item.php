<?php

namespace Sulu\Bundle\Sales\CoreBundle\Api;

use JMS\Serializer\Annotation\VirtualProperty;
use Sulu\Bundle\Sales\CoreBundle\Entity\Item as Entity;
use Sulu\Bundle\Sales\CoreBundle\Entity\ItemAttribute;
use Sulu\Component\Rest\ApiWrapper;
use Hateoas\Configuration\Annotation\Relation;
use JMS\Serializer\Annotation\SerializedName;
use DateTime;

/**
 * The item class which will be exported to the API
 * @package Sulu\Bundle\Sales\CoreBundle\Api
 */
class Item extends ApiWrapper
{
    /**
     * @param Entity $item The item to wrap
     * @param string $locale The locale of this item
     */
    public function __construct(Entity $item, $locale) {
        $this->entity = $item;
        $this->locale = $locale;
    }

    /**
     * Returns the id of the entity
     * @return int
     * @VirtualProperty
     * @SerializedName("id")
     */
    public function getId()
    {
        return $this->entity->getId();
    }

    /**
     * @return string
     * @VirtualProperty
     * @SerializedName("name")
     */
    public function getName()
    {
        return $this->entity->getName();
    }

    /**
     * @param $name
     * @return Item
     */
    public function setName($name)
    {
        $this->entity->setName($name);
        return $this;
    }

    /**
     * @return int
     * @VirtualProperty
     * @SerializedName("number")
     */
    public function getNumber()
    {
        return $this->entity->getNumber();
    }

    /**
     * @param $number
     * @return Item
     */
    public function setNumber($number)
    {
        $this->entity->setNumber($number);
        return $this;
    }

    /**
     * @return int
     * @VirtualProperty
     * @SerializedName("created")
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->entity->getCreated();
    }

    /**
     * @param DateTime $created
     * @return Item
     */
    public function setCreated(DateTime $created)
    {
        $this->entity->setCreated($created);
        return $this;
    }

    /**
     * @return int
     * @VirtualProperty
     * @SerializedName("changed")
     * @return DateTime
     */
    public function getChanged()
    {
        return $this->entity->getChanged();
    }

    /**
     * @param DateTime $changed
     * @return Item
     */
    public function setChanged(DateTime $changed)
    {
        $this->entity->setChanged($changed);
        return $this;
    }

    /**
     * Set changer
     *
     * @param \Sulu\Bundle\SecurityBundle\Entity\User $changer
     * @return Item
     */
    public function setChanger(\Sulu\Bundle\SecurityBundle\Entity\User $changer = null)
    {
        $this->entity->setChanger($changer);

        return $this;
    }

    /**
     * Get changer
     *
     * @return \Sulu\Bundle\SecurityBundle\Entity\User
     * @VirtualProperty
     * @SerializedName("changer")
     */
    public function getChanger()
    {
        return $this->entity->getChanger();
    }

    /**
     * Set creator
     *
     * @param \Sulu\Bundle\SecurityBundle\Entity\User $creator
     * @return Item
     */
    public function setCreator(\Sulu\Bundle\SecurityBundle\Entity\User $creator = null)
    {
        $this->entity->setCreator($creator);

        return $this;
    }

    /**
     * Get creator
     *
     * @return \Sulu\Bundle\SecurityBundle\Entity\User
     * @VirtualProperty
     * @SerializedName("creator")
     */
    public function getCreator()
    {
        return $this->entity->getCreator();
    }

    /**
     * Set status
     * @param ItemStatus
     * @return Item
     */
    public function setStatus($status)
    {
        $this->entity->setStatus($status);

        return $this;
    }

    /**
     * Get status
     * @return ItemStatus
     * @VirtualProperty
     * @SerializedName("changed")
     */
    public function getStatus()
    {
        return new ItemStatus($this->entity->getStatus(), $this->locale);
    }

    /**
     * @param float
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->entity->setQuantity($quantity);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("quantity")
     */
    public function getQuantity()
    {
        return $this->entity->getQuantity();
    }

    /**
     * @param string
     * @return Item
     */
    public function setQuantityUnit($quantityUnit)
    {
        $this->entity->setQuantityUnit($quantityUnit);

        return $this;
    }

    /**
     * @return string
     * @VirtualProperty
     * @SerializedName("quantityUnit")
     */
    public function getQuantityUnit()
    {
        return $this->entity->getQuantityUnit();
    }


    /**
     * @param bool
     * @return Item
     */
    public function setUseProductsPrice($useProductsPrice)
    {
        $this->entity->setUseProductsPrice($useProductsPrice);

        return $this;
    }

    /**
     * @return bool
     * @VirtualProperty
     * @SerializedName("useProductsPrice")
     */
    public function getUseProductsPrice()
    {
        return $this->entity->getUseProductsPrice();
    }

    /**
     * @param float
     * @return Item
     */
    public function setTax($tax)
    {
        $this->entity->setTax($tax);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("tax")
     */
    public function getTax()
    {
        return $this->entity->getTax();
    }

    /**
     * @param float
     * @return Item
     */
    public function setPrice($value)
    {
        $this->entity->setPrice($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("price")
     */
    public function getPrice()
    {
        return $this->entity->getPrice();
    }

    /**
     * @param float
     * @return Item
     */
    public function setDiscount($value)
    {
        $this->entity->setDiscount($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("discount")
     */
    public function getDiscount()
    {
        return $this->entity->getPrice();
    }

    /**
     * @param string
     * @return Item
     */
    public function setDescription($value)
    {
        $this->entity->setDescription($value);

        return $this;
    }

    /**
     * @return string
     * @VirtualProperty
     * @SerializedName("description")
     */
    public function getDescription()
    {
        return $this->entity->getDescription();
    }

    /**
     * @param float
     * @return Item
     */
    public function setWeight($value)
    {
        $this->entity->setWeight($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("weight")
     */
    public function getWeight()
    {
        return $this->entity->getWeight();
    }

    /**
     * @param float
     * @return Item
     */
    public function setWidth($value)
    {
        $this->entity->setWidth($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("width")
     */
    public function getWidth()
    {
        return $this->entity->getWidth();
    }

    /**
     * @param float
     * @return Item
     */
    public function setHeight($value)
    {
        $this->entity->setHeight($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("height")
     */
    public function getHeight()
    {
        return $this->entity->getHeight();
    }

    /**
     * @param float
     * @return Item
     */
    public function setLength($value)
    {
        $this->entity->setWeight($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("length")
     */
    public function getLenght()
    {
        return $this->entity->getLength();
    }

    /**
     * @param string
     * @return Item
     */
    public function setSupplierName($value)
    {
        $this->entity->setSupplierName($value);

        return $this;
    }

    /**
     * @return float
     * @VirtualProperty
     * @SerializedName("supplierName")
     */
    public function getSupplierName()
    {
        return $this->entity->getSupplierName();
    }

    /**
     * @param ItemAttribute $value
     * @return $this
     */
    public function addAttribute(ItemAttribute $value)
    {
        $this->entity->addAttribute($value);

        return $this;
    }

    /**
     * @return ItemAttribute
     * @VirtualProperty
     * @SerializedName("attributes")
     */
    public function getAttributes()
    {
        return $this->entity->getAttributes();
    }
}