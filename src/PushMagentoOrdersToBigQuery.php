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
                $errors .= sprintf('[%s] %s: %s' . PHP_EOL, $error['location'], $error['reason'], $error['message']);
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

                            ['name' => 'entity_id', 'type' => 'string'],

                            ['name' => 'increment_id', 'type' => 'string'],

                            ['name' => 'is_virtual', 'type' => 'boolean'],

                            ['name' => 'applied_rule_ids', 'type' => 'string'],

                            ['name' => 'base_currency_code', 'type' => 'string'],

                            ['name' => 'base_discount_amount', 'type' => 'float'],

                            ['name' => 'base_discount_canceled', 'type' => 'float'],

                            ['name' => 'base_discount_invoiced', 'type' => 'float'],

                            ['name' => 'base_discount_refunded', 'type' => 'float'],

                            ['name' => 'base_discount_tax_compensation_amount', 'type' => 'float'],

                            ['name' => 'base_discount_tax_compensation_invoiced', 'type' => 'float'],

                            ['name' => 'base_discount_tax_compensation_refunded', 'type' => 'float'],

                            ['name' => 'base_grand_total', 'type' => 'float'],

                            ['name' => 'base_shipping_amount', 'type' => 'float'],

                            ['name' => 'base_shipping_incl_tax', 'type' => 'float'],

                            ['name' => 'base_shipping_tax_amount', 'type' => 'float'],

                            ['name' => 'base_subtotal', 'type' => 'float'],

                            ['name' => 'base_subtotal_incl_tax', 'type' => 'float'],

                            ['name' => 'base_tax_amount', 'type' => 'float'],

                            ['name' => 'base_total_due', 'type' => 'float'],

                            ['name' => 'base_to_global_rate', 'type' => 'float'],

                            ['name' => 'base_to_order_rate', 'type' => 'float'],

                            ['name' => 'billing_address_id', 'type' => 'integer'],

                            ['name' => 'customer_id', 'type' => 'integer'],

                            ['name' => 'customer_group_id', 'type' => 'integer'],

                            ['name' => 'customer_email', 'type' => 'string'],

                            ['name' => 'customer_full_name', 'type' => 'string'],

                            ['name' => 'customer_is_guest', 'type' => 'boolean'],

                            ['name' => 'discount_amount', 'type' => 'float'],

                            ['name' => 'discount_canceled', 'type' => 'float'],

                            ['name' => 'discount_invoiced', 'type' => 'float'],

                            ['name' => 'discount_refunded', 'type' => 'float'],

                            ['name' => 'discount_tax_compensation_amount', 'type' => 'float'],

                            ['name' => 'discount_tax_compensation_invoiced', 'type' => 'float'],

                            ['name' => 'discount_tax_compensation_refunded', 'type' => 'float'],

                            ['name' => 'email_sent', 'type' => 'boolean'],

                            ['name' => 'global_currency_code', 'type' => 'string'],

                            ['name' => 'grand_total', 'type' => 'float'],

                            ['name' => 'order_currency_code', 'type' => 'string'],

                            ['name' => 'payment_method', 'type' => 'string'],

                            ['name' => 'protect_code', 'type' => 'string'],

                            ['name' => 'quote_id', 'type' => 'integer'],

                            ['name' => 'remote_ip', 'type' => 'string'],

                            ['name' => 'shipping_amount', 'type' => 'float'],

                            ['name' => 'shipping_canceled', 'type' => 'float'],

                            ['name' => 'shipping_discount_amount', 'type' => 'float'],

                            ['name' => 'shipping_discount_tax_compensation_amount', 'type' => 'float'],

                            ['name' => 'shipping_incl_tax', 'type' => 'float'],

                            ['name' => 'shipping_invoiced', 'type' => 'float'],

                            ['name' => 'shipping_refunded', 'type' => 'float'],

                            ['name' => 'shipping_tax_amount', 'type' => 'float'],

                            ['name' => 'shipping_tax_refunded', 'type' => 'float'],

                            ['name' => 'shipping_method', 'type' => 'string'],

                            ['name' => 'shipping_city', 'type' => 'string'],

                            ['name' => 'shipping_region', 'type' => 'string'],

                            ['name' => 'shipping_region_code', 'type' => 'string'],

                            ['name' => 'shipping_country_code', 'type' => 'string'],

                            ['name' => 'state', 'type' => 'string'],

                            ['name' => 'status', 'type' => 'string'],

                            ['name' => 'store_currency_code', 'type' => 'string'],

                            ['name' => 'store_id', 'type' => 'integer'],

                            ['name' => 'store_name', 'type' => 'string'],

                            ['name' => 'store_to_base_rate', 'type' => 'float'],

                            ['name' => 'store_to_order_rate', 'type' => 'float'],

                            ['name' => 'subtotal', 'type' => 'float'],

                            ['name' => 'subtotal_canceled', 'type' => 'float'],

                            ['name' => 'subtotal_incl_tax', 'type' => 'float'],

                            ['name' => 'subtotal_invoiced', 'type' => 'float'],

                            ['name' => 'subtotal_refunded', 'type' => 'float'],

                            ['name' => 'tax_amount', 'type' => 'float'],

                            ['name' => 'tax_canceled', 'type' => 'float'],

                            ['name' => 'tax_invoiced', 'type' => 'float'],

                            ['name' => 'tax_refunded', 'type' => 'float'],

                            ['name' => 'total_canceled', 'type' => 'float'],

                            ['name' => 'total_due', 'type' => 'float'],

                            ['name' => 'total_invoiced', 'type' => 'float'],

                            ['name' => 'total_item_count', 'type' => 'integer'],

                            ['name' => 'total_offline_refunded', 'type' => 'float'],

                            ['name' => 'total_online_refunded', 'type' => 'float'],

                            ['name' => 'total_paid', 'type' => 'float'],

                            ['name' => 'total_qty_ordered', 'type' => 'integer'],

                            ['name' => 'total_refunded', 'type' => 'float'],

                            ['name' => 'weight', 'type' => 'integer'],

                            ['name' => 'created_at', 'type' => 'datetime'],

                            ['name' => 'updated_at', 'type' => 'datetime'],
                        ]
                    ]
                ]
            ]);
        }
        return $table;
    }
}
