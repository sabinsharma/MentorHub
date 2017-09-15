<?php
class ExchangeInfo
{
    public $Id, $Is_offer, $Traders_id, $Title, $Description, $Item_id, $Post_date, $Image, $Is_private;

    public function getId()
    {
        return $this->Id;
    }
    public function setId($Id)
    {
        $this->Id = $Id;
    }
    public function getIsOffer()
    {
        return $this->Is_offer;
    }
    public function setIsOffer($Is_offer)
    {
        $this->Is_offer = $Is_offer;
    }
    public function getTradersId()
    {
        return $this->Traders_id;
    }
    public function setTradersId($Traders_id)
    {
        $this->Traders_id = $Traders_id;
    }
    public function getTitle()
    {
        return $this->Title;
    }
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }
    public function getDesc()
    {
        return $this->Description;
    }
    public function setDesc($Description)
    {
        $this->Description = $Description;
    }
    public function getItemId()
    {
        return $this->Item_id;
    }
    public function setItemId($Item_id)
    {
        $this->Item_id = $Item_id;
    }
    public function getPostDate()
    {
        return $this->Post_date;
    }
    public function setPostDate($Post_date)
    {
        $this->Post_date = $Post_date;
    }
    public function getImage()
    {
        return $this->Image;
    }
    public function setImage($Image)
    {
        $this->Image = $Image;
    }
    public function getIsPrivate()
    {
        return $this->Is_private;
    }
    public function setIsPrivate($Is_Private)
    {
        $this->Is_private = $Is_Private;
    }
}