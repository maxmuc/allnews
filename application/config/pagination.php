<?php defined('BASEPATH') OR exit('No direct script access allowed');

//$config['base_url'] = '/ci/blog/index';
//$config['total_rows'] = ceil($this->main_model->rows('blog')/$limit);
$config['per_page'] = 1; //шаг через один, обязательно всегда

$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
$config['full_tag_close'] = '</ul></nav>';

$config['first_link'] = false;
$config['last_link'] = false;

$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';


$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['cur_tag_open'] = ' <li class="active"><a href="#">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';