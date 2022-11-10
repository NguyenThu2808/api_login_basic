<?php

namespace thunt\api_login\Database;

use thunt\api_login\Base\BaseCore;
use thunt\api_login\Database\Traits\SignatureTable;
use nguyenanhung\MyDatabase\Model\BaseModel;

/**
 * Class Database
 *
 * @package   thunt\api_login\Database
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Database extends BaseCore
{
    use SignatureTable;

    /** @var array $database */
    protected $database;

    /** @var array $table */
    protected $table;

    /**
     * Database constructor.
     *
     * @param array $options
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
        $this->logger->setLoggerSubPath(__CLASS__);
    }

    /**
     * Function setDatabase
     *
     * @param $database
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 22/06/2022 38:16
     */
    public function setDatabase($database): Database
    {
        $this->database = $database;

        return $this;
    }

    /**
     * Function connection
     *
     * @return \nguyenanhung\MyDatabase\Model\BaseModel
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 22/06/2022 40:58
     */
    public function connection(): BaseModel
    {
        $DB                      = new BaseModel();
        $DB->debugStatus         = $this->options['debugStatus'];
        $DB->debugLevel          = $this->options['debugLevel'];
        $DB->debugLoggerPath     = $this->options['loggerPath'];
        $DB->debugLoggerFilename = 'Log-' . date('Y-m-d') . '.log';
        $DB->setDatabase($this->database);
        $DB->__construct($this->database);

        return $DB;
    }

    public function initTable($table): BaseModel
    {
        $DB = $this->connection();
        $DB->setTable($table);

        return $DB;
    }

    /**
     * Function checkExitsRecord
     *
     * @param $wheres
     * @param $tableName
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/08/2022 13:25
     */
    public function checkExitsRecord($wheres, $tableName): bool
    {
        $DB = $this->connection();
        $DB->setTable($tableName);
        $result = $DB->checkExists($wheres);
        $DB->disconnect();
        unset($DB);

        return $result === 1;
    }
}
