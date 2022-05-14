<?php
namespace App\Models;

class MovieModel extends Model
{
    public function __construct() {
        $this->table = "movie";
        $this->fields= [
            'title',
            'year',
            'picture'
        ];
        $this->pk = 'movie_id';
    }
}