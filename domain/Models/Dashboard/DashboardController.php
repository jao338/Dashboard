<?php

namespace Domain\Models\Dashboard;

use Domain\BaseController;
use Domain\Models\Dashboard\Resources\ColumnsChartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardController extends BaseController {

    public function __construct(protected DashboardService $service){}

    public function getColumnsChart(): JsonResource
    {
        $row = $this->service->getColumnsChart();

        return ColumnsChartResource::collection($row);
    }
}
