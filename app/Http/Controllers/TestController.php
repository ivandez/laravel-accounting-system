<?php

namespace App\Http\Controllers;

use App\Services\GetBalanceService;

class TestController extends Controller
{

    private GetBalanceService $getBalanceService;

    public function __construct(GetBalanceService $getBalanceService)
    {
        $this->getBalanceService = $getBalanceService;
    }

    public function getGanaciasTotales(){
        return $this->getBalanceService->getTotalEarnings();
    }

    public function getTotalExpenses(){
        return $this->getBalanceService->getTotalExpenses();
    }

    public function utilidad(){
        return $this->getBalanceService->getTotalUtility();
    }
}
