<?php

namespace App\Http\Controllers;

use App\Http\Services\ManageElasticsearchIndexService;
use Illuminate\Http\Request;

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

        $response = $this->manageElasticsearchIndexService->createIndex('post', $indexSettings, $mappingProperties);

        return response()->json([
            'succes' => true,
            'data' => $response,
        ]);
    }
}
