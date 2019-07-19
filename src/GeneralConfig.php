<?php

namespace bihuo;


use Hanson\Foundation\AbstractAPI;
use Hanson\Foundation\Foundation;

class GeneralConfig extends Foundation
{
    private $config;
    public function __construct($config)
    {
        if (!isset($config['database'])) {
            $config['database'] = config('database', 'default');
        }
        $this->config = $config;
        parent::__construct($this->config);
    }

    public function getConfigs($params)
    {
        if (!isset($this['config']['database'])) {
            return [];
        }
        $dbConfig = $this['config']['database'];
        $db = database($dbConfig);
        switch (isset($params['option']) ? $params['option'] : 'select') {
            case 'select':
                $data = $this->select($db, $params['table'],
                    isset($params['join']) ? $params['join'] : [],
                    isset($params['column']) ? $params['column'] : '*',
                    isset($params['where']) ? $params['where'] : []
                );
                break;
            case 'get':
                $data = $this->get($db, $params['table'],
                    isset($params['join']) ? $params['join'] : [],
                    isset($params['column']) ? $params['column'] : '*',
                    isset($params['where']) ? $params['where'] : []
                );
                break;
            default:
                $data = [];
                break;
        }
        return $data;
    }

    public function select($db, $table, $join,  $column, $where)
    {
        if ($join) {
            return $db->select($table, $join, $column, $where);
        } else {
            return $db->select($table, $column, $where);
        }
       
    }

    public function get($db, $table, $join, $column, $where)
    {
        if ($join) {
            return $db->get($table, $join, $column, $where);
        } else {
            return $db->get($table, $column, $where);
        }
    }
}