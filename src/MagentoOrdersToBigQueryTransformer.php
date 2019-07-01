<?php

namespace ToBigQuery;

class MagentoOrdersToBigQueryTransformer
{
    public static function handle(array $item)
    {
        return [
            'entity_id' => $item['increment_id'],
            'customer_name' => $item['customer_name'] ?? 'null',
            'customer_email' => $item['customer_email'] ?? 'null',
        ];
    }
}
