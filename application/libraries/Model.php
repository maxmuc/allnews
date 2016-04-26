<?php
class Model{
    //$this->db->delete('content', ['id' => $id]);

    public static function read($table, $arr = false){
        /* по умолчанию показывает первую строку
         * Пр: $model = Model::read('contant', ['orderBy' => 'id asc']);
         * Пр: $model = Model::read('contant', ['where' => ['id' => 8], 'column' => ['id', 'dataC']]);
         * */
        $CI = &get_instance();

        if(isset($arr['where']))
            $CI->db->where($arr['where']);

        if(isset($arr['column']))
            $CI->db->select($arr['column']);

        if(isset($arr['orderBy']))
            $CI->db->order_by($arr['orderBy']);

        if(isset($arr['selectMax']))
            $CI->db->select_max($arr['selectMax']);

        $query = $CI->db->get($table);
        if($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    public static function readAll($table, $arr = false){
        // distinct - без повторов = 'distinct' => true
        // Пр: $model = Model::readAll('users', ['where' => ['id' => 23], 'column' => ['fname', 'name'], 'orderBy' => 'id asc', 'limit' => '1,2'], 'like' => ['title' => $match, 'page1' => $match]);
        $CI = &get_instance();

        if(isset($arr['where']))
            $CI->db->where($arr['where']);

        if(isset($arr['column']))
            $CI->db->select($arr['column']);

        if(isset($arr['orderBy']))
            $CI->db->order_by($arr['orderBy']);

        if(isset($arr['limit'])){
            $lim = explode(',', $arr['limit']);
            if(isset($lim[1]))
                $CI->db->limit($lim[0], $lim[1]);
            else
                $CI->db->limit($lim[0]);
        }

        if(isset($arr['like']))
            $CI->db->like($arr['like']);
        if(isset($arr['or_like']))
            $CI->db->or_like($arr['or_like']);

        if(isset($arr['distinct']))
            $CI->db->distinct();

        $query = $CI->db->get($table);
        if($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    public static function save($table, $data, $where = false){
        //Model::save('users', ['onoff' => 0], ['id' => Ci::user()['id']]);
        $CI = &get_instance();
        if($where)
            $CI->db->update($table, $data, $where);
        else
            $CI->db->insert($table, $data);
    }

}