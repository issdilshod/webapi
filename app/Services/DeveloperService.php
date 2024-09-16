<?php

namespace App\Services;

use App\Models\Developer;

class DeveloperService extends Service{

    // Получить по имени
    public function findByName($name){
        $developer = Developer::where('name', $name)->first();

        if (!$developer){
            $developer = $this->create([
                'name' => $name
            ]);
        }

        return $developer;
    }

    // Создать разработчика
    public function create($developer){
        $developer = Developer::create($developer);
        return $developer;
    }

}
