<?php
class Content_model extends CI_Model {

    private function name($key){
        $arr = [
            'title' => 'Название статьи',
            'text'  => 'Статья',
            'desc' => 'Описание страницы',
            'keywords' => 'Ключевые слова'
        ];
        return $arr[$key];
    }

    public function items($key){
        $arr = [
            'title' => ['type' => 'text', 'name' => self::name('title'), 'required' => true],
            'text'  => ['type' => 'textarea', 'name' => self::name('text'), 'required' => true],
            'desc'  => ['type' => 'textarea', 'name' => self::name('desc'), 'required' => false],
            'keywords'  => ['type' => 'textarea', 'name' => self::name('keywords'), 'required' => false],
        ];
        return $arr[$key];
    }

    public function rules($items){
        $rez = [];

        $data = [
            'title' => [
                'field' => 'Content[title]',
                'label' => self::name('title'),
                'rules' => 'trim|required'
            ],
            'text' => [
                'field' => 'Content[text]',
                'label' => self::name('text'),
                'rules' => 'trim|required'
            ],
        ];

        foreach($items as $row){
            $rez[$row] = $data[$row];
        }

        return $rez;
    }
}