<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameWithUserResourceCollection;
use App\Models\Game;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function index() {
        $games = Game::orderBy('score', 'desc')->take(10)->get();
        return new GameWithUserResourceCollection($games);
    }

    public function store(
        StoreGameRequest $request,
    ) {
        $user = auth()->user();
        $data = $request->validated();

        $game = Game::create([
            'word' => $data['word'],
            'score' => 0,
            'is_over' => false,
            'user_id' => $user->id,
        ]);

        return new GameResource($game);
    }

    public function update(
        UpdateGameRequest $request,
        Game $game,
    ) {
        $user = auth()->user();
        $data = $request->validated();
        if ($game->user_id !== $user->id) {
            throw new NotFoundHttpException();
        }

        if (!$game->is_over) {
            if ($data['word'] === $game->word) {
                $uniqueLetters = array_unique(str_split($game->word));
                $uniqueCount = count($uniqueLetters);
                $score = $uniqueCount * 1000 / $data['game_time'];
                $game->update([
                    'score' => round($score),
                    'game_time' => $data['game_time'],
                    'is_over' => 1,
                ]);
            } else {
                $game->update([
                    'game_time' => $data['game_time'],
                    'is_over' => 1,
                ]);
            }
        }

        return new GameResource($game);
    }

    public function usersGames() {
        $user = auth()->user();
        $games = Game::whereUserId($user->id)
            ->orderBy('score', 'desc')
            ->take(10)
            ->get();
        return new GameWithUserResourceCollection($games);
    }
}
