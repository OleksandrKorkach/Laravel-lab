<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatisticsController extends Controller
{
    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index(): View
    {
        return view('statistics');
    }

    public function show($projectId): View
    {
        $projectStatistics = $this->statisticsService->getProjectStatistics($projectId);
        return view('statistics.show', [
            'statistics' => $projectStatistics,
        ]);
    }




}
