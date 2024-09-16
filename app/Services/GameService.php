<?php

namespace App\Services;

use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\GameDeveloper;
use App\Models\GameGenre;

class GameService extends Service{

    protected int $id;
    protected DeveloperService $developerService;
    protected GenreService $genreService;

    public function __construct(){
        $this->developerService = new DeveloperService();
        $this->genreService = new GenreService();
    }

    // Получить список игр
    public function findAll(){
        $games = Game::paginate();
        return GameResource::collection($games);
    }

    // Получить игру
    public function find($id) {
        $game = Game::find($id);
        return new GameResource($game);
    }

    // Создать игру
    public function create($game){
        $gameOrg = Game::create($game);
        $this->id = $gameOrg->id;

        // Синхронизация жанр|разработчик
        if (isset($game['genres']))
            $this->syncGenres($game['genres']);

        if (isset($game['developers']))
            $this->syncDevelopers($game['developers']);

        return new GameResource($game);
    }

    // Обновить игру
    public function update($game, $id){
        $gameOrg = Game::find($id);
        $this->id = $gameOrg->id;

        $gameOrg->update($game);

        // Синхронизация жанр|разработчик
        if (isset($game['genres']))
            $this->syncGenres($game['genres']);

        if (isset($game['developers']))
            $this->syncDevelopers($game['developers']);

        return new GameResource($game);
    }

    // Удалить игру
    public function delete($id){
        $this->id = $id;

        // Удалить записи жанр и разработчик
        $this->deleteGameGenres();
        $this->deleteGameDevelopers();

        Game::find($id)->delete();

        return true;
    }

    // Удалить записи жанр игры
    private function deleteGameGenres():void{
        GameGenre::where('game_id', $this->id)->delete();
    }

    // Удалить записи разработчик игры
    private function deleteGameDevelopers():void{
        GameDeveloper::where('game_id', $this->id)->delete();
    }

    // Синхронизация жанр
    private function syncGenres($genres){
        foreach ($genres as $genre){
            $tmpGenre = $this->genreService->findByName($genre);

            // Синхронизовать
            $this->syncGameGenre($tmpGenre->id);
        }
    }

    // Синхронизация разработчик
    private function syncDevelopers($developers){
        foreach ($developers as $developer){
            $tmpDeveloper = $this->developerService->findByName($developer);

            // Синхронизовать
            $this->syncGameDeveloper($tmpDeveloper->id);
        }
    }

    // Синхронизовать жанр игры
    public function syncGameGenre($genreId):void{
        $gameGenre = GameGenre::where('game_id', $this->id)
                            ->where('genre_id', $genreId)
                            ->first();

        if (!$gameGenre){
            $gameGenre = GameGenre::create([
                'game_id' => $this->id,
                'genre_id' => $genreId
            ]);
        }
    }

    // Синхронизовать разработчика игры
    public function syncGameDeveloper($developerId):void{
        $gameDeveloper = GameDeveloper::where('game_id', $this->id)
                            ->where('developer_id', $developerId)
                            ->first();

        if (!$gameDeveloper){
            $gameDeveloper = GameDeveloper::create([
                'game_id' => $this->id,
                'genre_id' => $developerId
            ]);
        }
    }
}
