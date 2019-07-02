<?php
declare(strict_types=1);

namespace ToBigQuery;

final class MagentoOrdersToBigQueryTransformer
{
    public static function handle(array $orderRaw)
    {
        $bigQueryOrder['entity_id'] = $orderRaw['entity_id'] ?? null;
        $bigQueryOrder['increment_id'] = $orderRaw['increment_id'] ?? null;
        $bigQueryOrder['is_virtual'] = isset($orderRaw['is_virtual']) ? !!$orderRaw['is_virtual'] : null;
        $bigQueryOrder['applied_rule_ids'] = $orderRaw['applied_rule_ids'] ?? null;
        $bigQueryOrder['base_currency_code'] = $orderRaw['base_currency_code'] ?? null;
        $bigQueryOrder['base_discount_amount'] = $orderRaw['base_discount_amount'] ?? null;
        $bigQueryOrder['base_discount_canceled'] = $orderRaw['base_discount_canceled'] ?? null;
        $bigQueryOrder['base_discount_invoiced'] = $orderRaw['base_discount_invoiced'] ?? null;
        $bigQueryOrder['base_discount_refunded'] = $orderRaw['base_discount_refunded'] ?? null;
        $bigQueryOrder['base_discount_tax_compensation_amount'] = $orderRaw['base_discount_tax_compensation_amount'] ?? null;
        $bigQueryOrder['base_discount_tax_compensation_invoiced'] = $orderRaw['base_discount_tax_compensation_invoiced'] ?? null;
        $bigQueryOrder['base_discount_tax_compensation_refunded'] = $orderRaw['base_discount_tax_compensation_refunded'] ?? null;
        $bigQueryOrder['base_grand_total'] = $orderRaw['base_grand_total'] ?? null;
        $bigQueryOrder['base_shipping_amount'] = $orderRaw['base_shipping_amount'] ?? null;
        $bigQueryOrder['base_shipping_incl_tax'] = $orderRaw['base_shipping_incl_tax'] ?? null;
        $bigQueryOrder['base_shipping_tax_amount'] = $orderRaw['base_shipping_tax_amount'] ?? null;
        $bigQueryOrder['base_subtotal'] = $orderRaw['base_subtotal'] ?? null;
        $bigQueryOrder['base_subtotal_incl_tax'] = $orderRaw['base_subtotal_incl_tax'] ?? null;
        $bigQueryOrder['base_tax_amount'] = $orderRaw['base_tax_amount'] ?? null;
        $bigQueryOrder['base_total_due'] = $orderRaw['base_total_due'] ?? null;
        $bigQueryOrder['base_to_global_rate'] = $orderRaw['base_to_global_rate'] ?? null;
        $bigQueryOrder['base_to_order_rate'] = $orderRaw['base_to_order_rate'] ?? null;
        $bigQueryOrder['billing_address_id'] = $orderRaw['billing_address_id'] ?? null;
        $bigQueryOrder['customer_id'] = $orderRaw['customer_id'] ?? null;
        $bigQueryOrder['customer_group_id'] = $orderRaw['customer_group_id'] ?? null;
        $bigQueryOrder['customer_email'] = $orderRaw['customer_email'] ?? null;

        if (isset($orderRaw['customer_firstname'])) {
            $bigQueryOrder['customer_full_name'] =
                "{$orderRaw['customer_firstname']} {$orderRaw['customer_lastname']}";
        }
        $bigQueryOrder['customer_is_guest'] = !!$orderRaw['customer_is_guest'];
        $bigQueryOrder['discount_amount'] = $orderRaw['discount_amount'] ?? null;
        $bigQueryOrder['discount_canceled'] = $orderRaw['discount_canceled'] ?? null;
        $bigQueryOrder['discount_invoiced'] = $orderRaw['discount_invoiced'] ?? null;
        $bigQueryOrder['discount_refunded'] = $orderRaw['discount_refunded'] ?? null;
        $bigQueryOrder['discount_tax_compensation_amount'] = $orderRaw['discount_tax_compensation_amount'] ?? null;
        $bigQueryOrder['discount_tax_compensation_invoiced'] = $orderRaw['discount_tax_compensation_invoiced'] ?? null;
        $bigQueryOrder['discount_tax_compensation_refunded'] = $orderRaw['discount_tax_compensation_refunded'] ?? null;
        $bigQueryOrder['email_sent'] = isset($orderRaw['email_sent']) ? !!$orderRaw['email_sent'] : null;
        $bigQueryOrder['global_currency_code'] = $orderRaw['global_currency_code'] ?? null;
        $bigQueryOrder['grand_total'] = $orderRaw['grand_total'] ?? null;
        $bigQueryOrder['order_currency_code'] = $orderRaw['order_currency_code'] ?? null;

        if (isset($orderRaw['payment'])) {
            $bigQueryOrder['payment_method'] = $orderRaw['payment']['method'];
        }

        $bigQueryOrder['protect_code'] = $orderRaw['protect_code'] ?? null;
        $bigQueryOrder['quote_id'] = $orderRaw['quote_id'] ?? null;
        $bigQueryOrder['remote_ip'] = $orderRaw['remote_ip'] ?? null;

        $bigQueryOrder['shipping_amount'] = $orderRaw['shipping_amount'] ?? null;
        $bigQueryOrder['shipping_canceled'] = $orderRaw['shipping_canceled'] ?? null;
        $bigQueryOrder['shipping_discount_amount'] = $orderRaw['shipping_discount_amount'] ?? null;
        $bigQueryOrder['shipping_discount_tax_compensation_amount'] = $orderRaw['shipping_discount_tax_compensation_amount'] ?? null;
        $bigQueryOrder['shipping_incl_tax'] = $orderRaw['shipping_incl_tax'] ?? null;
        $bigQueryOrder['shipping_invoiced'] = $orderRaw['shipping_invoiced'] ?? null;
        $bigQueryOrder['shipping_refunded'] = $orderRaw['shipping_refunded'] ?? null;
        $bigQueryOrder['shipping_tax_amount'] = $orderRaw['shipping_tax_amount'] ?? null;
        $bigQueryOrder['shipping_tax_refunded'] = $orderRaw['shipping_tax_refunded'] ?? null;

        if (isset($orderRaw['extension_attributes']['shipping_assignments'][0]['shipping'])) {
            $firstShipping = $orderRaw['extension_attributes']['shipping_assignments'][0]['shipping'];
            $bigQueryOrder['shipping_method'] = $firstShipping['method'];
            $bigQueryOrder['shipping_city'] = $firstShipping['address']['city'];
            $bigQueryOrder['shipping_region'] = $firstShipping['address']['region'];
            $bigQueryOrder['shipping_region_code'] = $firstShipping['address']['region_code'];
            $bigQueryOrder['shipping_country_code'] = $firstShipping['address']['country_id'];
        }

        $bigQueryOrder['state'] = $orderRaw['state'] ?? null;
        $bigQueryOrder['status'] = $orderRaw['status'] ?? null;
        $bigQueryOrder['store_currency_code'] = $orderRaw['store_currency_code'] ?? null;
        $bigQueryOrder['store_id'] = $orderRaw['store_id'] ?? null;
        $bigQueryOrder['store_name'] = $orderRaw['store_name'] ?? null;
        $bigQueryOrder['store_to_base_rate'] = $orderRaw['store_to_base_rate'] ?? null;
        $bigQueryOrder['store_to_order_rate'] = $orderRaw['store_to_order_rate'] ?? null;
        $bigQueryOrder['subtotal'] = $orderRaw['subtotal'] ?? null;
        $bigQueryOrder['subtotal_canceled'] = $orderRaw['subtotal_canceled'] ?? null;
        $bigQueryOrder['subtotal_incl_tax'] = $orderRaw['subtotal_incl_tax'] ?? null;
        $bigQueryOrder['subtotal_invoiced'] = $orderRaw['subtotal_invoiced'] ?? null;
        $bigQueryOrder['subtotal_refunded'] = $orderRaw['subtotal_refunded'] ?? null;
        $bigQueryOrder['tax_amount'] = $orderRaw['tax_amount'] ?? null;
        $bigQueryOrder['tax_canceled'] = $orderRaw['tax_canceled'] ?? null;
        $bigQueryOrder['tax_invoiced'] = $orderRaw['tax_invoiced'] ?? null;
        $bigQueryOrder['tax_refunded'] = $orderRaw['tax_refunded'] ?? null;
        $bigQueryOrder['total_canceled'] = $orderRaw['total_canceled'] ?? null;
        $bigQueryOrder['total_due'] = $orderRaw['total_due'] ?? null;
        $bigQueryOrder['total_invoiced'] = $orderRaw['total_invoiced'] ?? null;
        $bigQueryOrder['total_item_count'] = $orderRaw['total_item_count'] ?? null;
        $bigQueryOrder['total_offline_refunded'] = $orderRaw['total_offline_refunded'] ?? null;
        $bigQueryOrder['total_online_refunded'] = $orderRaw['total_online_refunded'] ?? null;
        $bigQueryOrder['total_paid'] = $orderRaw['total_paid'] ?? null;
        $bigQueryOrder['total_qty_ordered'] = $orderRaw['total_qty_ordered'] ?? null;
        $bigQueryOrder['total_refunded'] = $orderRaw['total_refunded'] ?? null;
        $bigQueryOrder['weight'] = $orderRaw['weight'] ?? null;
        $bigQueryOrder['created_at'] = $orderRaw['created_at'] ?? null;
        $bigQueryOrder['updated_at'] = $orderRaw['updated_at'] ?? null;

        foreach ($orderRaw as $key => $value) {
            if (is_array($value)) {
                unset($orderRaw[$key]);
            }
        }

        return $bigQueryOrder;
    }
}
