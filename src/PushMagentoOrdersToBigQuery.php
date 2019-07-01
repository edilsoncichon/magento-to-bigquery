<?php
declare(strict_types=1);

namespace ToBigQuery;

use Exception;
use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\BigQuery\Dataset;
use Google\Cloud\BigQuery\Table;

final class PushMagentoOrdersToBigQuery
{
    protected const TABLE_ID = 'orders';
    /**
     * @var BigQueryClient
     */
    protected $client;
    /**
     * @var Table
     */
    protected $table;
    protected $projectId;
    protected $datasetId;
    protected $keyFilePath;

    public function __construct(
        string $projectId,
        string $datasetId,
        string $keyFilePath
    ) {
        $this->projectId = $projectId;
        $this->datasetId = $datasetId;
        $this->keyFilePath = $keyFilePath;
    }

    public function prepare()
    {
        $this->client = new BigQueryClient([
            'projectId' => $this->projectId,
            'keyFilePath' => $this->keyFilePath,
        ]);
        $dataset = $this->client->dataset($this->datasetId);
        $this->table = $this->createTableIfNotExists($dataset);
    }

    /**
     * @param array $rows
     * @return string
     * @throws Exception
     */
    public function push(array $rows)
    {
        $insertResponse = $this->table->insertRows($rows, ['templateSuffix' => '_data']);

        if ($insertResponse->isSuccessful()) {
            return 'Data streamed into BigQuery successfully';
        }

        $errors = '';
        foreach ($insertResponse->failedRows() as $row) {
            foreach ($row['errors'] as $error) {
                $errors .= sprintf('%s: %s' . PHP_EOL, $error['reason'], $error['message']);
            }
        }
        throw new Exception($errors);
    }

    /**
     * @param Dataset $dataset
     * @return Table
     */
    private function createTableIfNotExists(Dataset $dataset)
    {
        $table = $dataset->table(self::TABLE_ID);
        if (! $table->exists()) {
            $table = $dataset->createTable(self::TABLE_ID, [
                'metadata' => [
                    'schema' => [
                        'fields' => [
                            //TODO ESPEFICICAR SCHEMA!
                            ['name' => 'entity_id', 'type' => 'integer'],
                            ['name' => 'customer_name', 'type' => 'string'],
                            ['name' => 'customer_email', 'type' => 'string'],
                        ]
                    ]
                ]
            ]);
        }
        return $table;
    }
}
