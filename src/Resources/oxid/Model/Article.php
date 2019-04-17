<?php

namespace Sioweb\Oxid\Api\Legacy\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

class Article extends Article_parent
{

    public function fetch($oxid)
    {

    }

    public function fetchAll()
    {
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $ArticleView = $ViewNameGenerator->getViewName('oxarticle');
        $Database = DatabaseProvider::getDb();
        $rs = $Database->select("SELECT OXID FROM $ArticleView LIMIT 0, 100");
        die('<pre>' . print_r($rs->fetchAll(), true));
    }
}