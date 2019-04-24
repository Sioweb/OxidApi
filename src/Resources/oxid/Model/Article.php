<?php

namespace Sioweb\Oxid\Api\Legacy\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Application\Model\Article AS OxidArticle;

class Article extends Article_parent
{
    
    public function fetch($sOXID)
    {
        if($sOXID === null) {
            $sOXID = $this->getId();
        }

        $config = $this->getConfig();
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $ArticleView = $ViewNameGenerator->getViewName('oxarticles');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->getRow("SELECT " . implode(', ', $this->getFetchableFields()) . " FROM $ArticleView WHERE OXID = ?", (array)$sOXID);

        $Article = oxNew(OxidArticle::class);
        $Article->assign($rs);

        $index = 0;
        foreach($Article->getFetchableFields() as $fieldName) {
            $longFieldName = $Article->_getFieldLongName($fieldName);
            if(!empty($Article->{$longFieldName}->value)) {
                yield $fieldName => $Article->{$longFieldName}->value;
            }
        }

        foreach($config->getConfigParam('aDetailImageSizes') as $type => $size) {
            if(empty($Article->{'oxarticles__' . $type}->rawValue)) {
                continue;
            }
            yield $type => iterator_to_array($this->getRawPicture($Article, $index));
            $index++;
        }

        yield 'link' => $Article->getLink();
        yield 'oxprice' => iterator_to_array($this->getRawPrice($Article->getPrice()));

        if(!empty($Article->oxarticles__oxvendorid->value) && $Article->getVendor() !== null) {
            yield 'oxvendorid' => $Article->getVendor()->fetch();
        }
        if(!empty($Article->oxarticles__oxmanufacturerid->value) && $Article->getManufacturer() !== null) {
            yield 'oxmanufacturerid' => $Article->getManufacturer()->fetch();
        }
    }

    protected function getRawPrice(&$Price)
    {
        yield 'netto' => $Price->getNettoPrice();
        yield 'brutto' => $Price->getBruttoPrice();
        yield 'vat' => $Price->getVat();
        yield 'discount' => $Price->calculateDiscount();
    }

    protected function getRawPicture(&$Article, &$index)
    {
        yield 'zoom' => $Article->getZoomPictureUrl($index+1);
        yield 'thumbnail' => $Article->getThumbnailUrl($index);
        yield 'icon' => $Article->getIconUrl($index);
    }

    public function fetchAll()
    {
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $ArticleView = $ViewNameGenerator->getViewName('oxarticles');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->select("SELECT OXID FROM $ArticleView LIMIT 0, 100");

        if ($rs != false && $rs->count() > 0) {
            while (!$rs->EOF) {
                yield iterator_to_array($this->fetch($rs->getFields()['OXID']), true);
                $rs->fetchRow();
            }
        }
    }

    protected function getFetchableFields()
    {
        return [
            'oxid',
            'oxparentid',
            'oxactive',
            'oxactivefrom',
            'oxactiveto',
            'oxmpn',
            'oxtitle',
            'oxshortdesc',
            'oxprice',
            'oxtprice',
            'oxpic1',
            'oxpic2',
            'oxpic3',
            'oxpic4',
            'oxpic5',
            'oxpic6',
            'oxpic7',
            'oxpic8',
            'oxpic9',
            'oxpic10',
            'oxpic11',
            'oxpic12',
            'oxsort',
            'oxvendorid',
            'oxmanufacturerid',
            'oxmindeltime',
            'oxmaxdeltime',
            'oxdeltimeunit',
            'spglobalartnum',
        ];
    }
}