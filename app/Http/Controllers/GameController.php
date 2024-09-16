<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Services\GameService;

class GameController extends Controller
{
    protected GameService $gameService;

    public function __construct(){
        $this->gameService = new GameService();
    }

    // Получить список игр
    public function index(){
        $games = $this->gameService->findAll();
        return response()->json([
            'success' => true,
            'data' => $games
        ]);
    }

    // Создать игру
    public function store(GameRequest $request){
        $game = $request->validated();
        $game = $this->gameService->create($game);
        return response()->json([
            'success' => true,
            'data' => $game
        ]);
    }

    // Получить игру
    public function show($id){
        $game = $this->gameService->find($id);
        return response()->json([
            'success' => true,
            'data' => $game
        ]);
    }

    // Обновить игру
    public function update(GameRequest $request, $id){
        $game = $request->validated();
        $game = $this->gameService->update($game, $id);
        return response()->json([
            'success' => true,
            'data' => $game
        ]);
    }

    // Удалить игру
    public function destroy($id){
        $this->gameService->delete($id);
        return response()->json([
            'success' => true
        ]);
    }

}
