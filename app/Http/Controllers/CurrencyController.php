<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class CurrencyController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request): JsonResponse
    {
        $day = DateTime::createFromFormat('Y-m-d', $request->get('day', ''));

        if ($day === false) {
            $day = new DateTime();
        }

        $day->setTime(0, 0);

        $key = implode('\\', [self::class, $day->format('Y-m-d'), $id]);

        $currency = Cache::get($key, fn () => (new CurrencyService())->get($id, $day));

        return response()->json($currency);
    }
}
