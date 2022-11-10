<?php

namespace thunt\api_login\Database\Traits;

use nguyenanhung\MyDatabase\Model\BaseModel;
/**
 * Trait SignatureTable
 *
 * @package   thunt\api_login\Database\Traits
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait UserTable
{
    /**
     * Connect to user table in database.
     */
    protected function initUserTable(): BaseModel
    {
        return $this->initTable('user');
    }
}
