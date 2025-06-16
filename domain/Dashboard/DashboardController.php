<?php

namespace Domain\Dashboard;

use Domain\BaseController;
use Domain\Dashboard\Resources\ColumnsChartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardController extends BaseController {

    public function __construct(protected DashboardService $service){}

    public function getColumnsChart(): JsonResource
    {
        $row = $this->service->getColumnsChart();

        return ColumnsChartResource::collection($row);
    }
}
