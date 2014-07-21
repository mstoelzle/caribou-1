<?php
/**
 * Created by IntelliJ IDEA.
 * User: natronite
 * Date: 19/07/14
 * Time: 19:27
 */

namespace Natronite\Caribou\Controller;

use Natronite\Caribou\Model\Table;
use Natronite\Caribou\Utils\Connection;

class TableMigration
{

    /** @var  Table */
    private $table;

    public function migrateTable()
    {
        // Test if table exists
        if (Connection::tableExists($this->table->getName())) {

            $current = Connection::getTable($this->table->getName());
            $alter = Table::computeAlter($current, $this->table);
            if ($alter) {
                echo "Migrating table " . $this->table->getName() . "\n";
                Connection::query($alter);
            }

        } else {
            // create table
            echo "Creating table " . $this->table->getName() . "\n";
            Connection::query($this->table->getSql());
        }
    }

    public function createIndexes()
    {

    }

    public function createReferences()
    {

    }

    public function dropIndexes()
    {

    }

    public function dropReferences()
    {

    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

} 