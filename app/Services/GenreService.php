<?php

namespace App\Services;

use App\Models\Genre;

class GenreService extends Service{

    // Получить по имени
    public function findByName($name){
        $genre = Genre::where('name', $name)->first();

        if (!$genre){
            $genre = $this->create([
                'name' => $name
            ]);
        }

        return $genre;
    }

    // Создать жанр
    public function create($genre){
        $genre = Genre::create($genre);
        return $genre;
    }

}
