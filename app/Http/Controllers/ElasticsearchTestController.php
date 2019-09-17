<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\ElasticsearchClient;
use App\Http\Services\ManageElasticsearchIndexService;

class ElasticsearchTestController extends Controller
{
    public $manageElasticsearchIndexService;

    public function __construct(ManageElasticsearchIndexService $manageElasticsearchIndexService)
    {
        $this->manageElasticsearchIndexService = $manageElasticsearchIndexService;
    }

    public function createIndex(Request $request)
    {
        $indexSettings = [
            'number_of_shards' => 1,
            'number_of_replicas' => 1,
        ];

        $mappingProperties = [
            'title' => [
                'type' => 'keyword',
            ],
            'description' => [
                'type' => 'text',
            ],
        ];

        $response = $this->manageElasticsearchIndexService->createIndex('post3', $indexSettings, $mappingProperties);

        return response()->json([
            'succes' => true,
            'data' => $response,
        ]);
    }
}
