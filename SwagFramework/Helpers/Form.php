<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 28/12/14
 * Time: 20:31
 */

namespace SwagFramework\Helpers;


use SwagFramework\Config\DatabaseConfig;
use SwagFramework\Database\Database;
use SwagFramework\Exceptions\TableNotFoundDatabaseException;
use SwagFramework\Form\Field\Input;

class Form
{
    /**
     * @var database
     */
    private $db;

    /**
     * default constructor
     */
    function __construct()
    {
        $this->db = new Database(DatabaseConfig::parseFromFile());
    }

    private function getType($type)
    {
        $tmp = explode('(', $type);
        if (!empty($tmp)) {
            $type = $tmp[0];
        }
        return $type;
    }

    /**
     * convert type mysql to input type
     * if primary key -> hidden
     * default text
     * @param $att
     * @return string
     */
    private function convertAttributeType($att)
    {
        $type = $this->getType($att['Type']);
        if ($att['Key'] == 'PRI') {
            return 'hidden';
        }
        return 'text';
    }

    /**
     * generate form for table
     * @param $table table
     * @param $action action
     * @param string $method method form (default = POST)
     * @return \SwagFramework\Form\Form
     * @throws TableNotFoundDatabaseException
     */
    public function generate($table, $action, $method = 'POST')
    {
        $sql = 'SHOW FIELDS '
            . 'FROM ?';

        $res = $this->db->execute($sql, $table);

        if (empty($res)) {
            throw new TableNotFoundDatabaseException($table);
        }

        $form = new \SwagFramework\Form\Form();

        foreach ($res as $value) {
            $field = new Input($value['Field']);
            $field->addAttribute('type', $this->convertAttributeType($value));
            $form->addField($field);
        }

        echo $form;
    }
}