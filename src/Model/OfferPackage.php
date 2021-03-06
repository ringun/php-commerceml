<?php


namespace Zenwalker\CommerceML\Model;


use Zenwalker\CommerceML\ORM\Model;

/**
 * Class OfferPackage
 *
 * @package Zenwalker\CommerceML\Model
 * @property Offer[] offers
 * @property string Артикул
 * @property string Наименование
 * @property string Количество
 */
class OfferPackage extends Model
{
    /**
     * @var Offer[]
     */
    protected $offers = [];

    public function loadXml()
    {
        if ($this->owner->offersXml) {
            return $this->owner->offersXml->ПакетПредложений;
        } else {
            return null;
        }
    }

    /**
     * @return Offer[]
     */
    public function getOffers()
    {
        if (!$this->offers && $this->xml && $this->xml->Предложения) {
            foreach ($this->xml->Предложения->Предложение as $offer) {
                $this->offers[] = new Offer($this->owner, $offer);
            }
        }
        return $this->offers;
    }

    /**
     * @param $id
     * @return null|Offer
     */
    public function getOfferById($id)
    {
        foreach ($this->getOffers() as $offer) {
            if ($offer->getClearId() == $id) {
                return $offer;
            }
        }
        return null;
    }
}