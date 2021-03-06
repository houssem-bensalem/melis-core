<?php 

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCore\Model\Tables;

use Zend\Db\TableGateway\TableGateway;

class MelisBOEmailsTable extends MelisGenericTable
{
    public function __construct(TableGateway $tableGateway)
    { 
        parent::__construct($tableGateway);
        $this->idField = 'boe_id';
    }
}