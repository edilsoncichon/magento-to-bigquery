<?php

namespace ToBigQuery;

final class MagentoOrdersToBigQueryTransformer
{
    public static function handle(array $item)
    {
        foreach ($item as $key => $value) {
            if (is_array($value)) {
                unset($item[$key]);
            }
        }

        $formatted['entity_id'] = $item['entity_id'] ?? null;
        $formatted['increment_id'] = $item['increment_id'] ?? null;
        $formatted['is_virtual'] = isset($item['is_virtual']) ? !!$item['is_virtual'] : null;
        $formatted['applied_rule_ids'] = $item['applied_rule_ids'] ?? null;
        $formatted['base_currency_code'] = $item['base_currency_code'] ?? null;
        $formatted['base_discount_amount'] = $item['base_discount_amount'] ?? null;
        $formatted['base_discount_canceled'] = $item['base_discount_canceled'] ?? null;
        $formatted['base_discount_invoiced'] = $item['base_discount_invoiced'] ?? null;
        $formatted['base_discount_refunded'] = $item['base_discount_refunded'] ?? null;
        $formatted['base_discount_tax_compensation_amount'] = $item['base_discount_tax_compensation_amount'] ?? null;
        $formatted['base_discount_tax_compensation_invoiced'] = $item['base_discount_tax_compensation_invoiced'] ?? null;
        $formatted['base_discount_tax_compensation_refunded'] = $item['base_discount_tax_compensation_refunded'] ?? null;
        $formatted['base_grand_total'] = $item['base_grand_total'] ?? null;
        $formatted['base_shipping_amount'] = $item['base_shipping_amount'] ?? null;
        $formatted['base_shipping_incl_tax'] = $item['base_shipping_incl_tax'] ?? null;
        $formatted['base_shipping_tax_amount'] = $item['base_shipping_tax_amount'] ?? null;
        $formatted['base_subtotal'] = $item['base_subtotal'] ?? null;
        $formatted['base_subtotal_incl_tax'] = $item['base_subtotal_incl_tax'] ?? null;
        $formatted['base_tax_amount'] = $item['base_tax_amount'] ?? null;
        $formatted['base_total_due'] = $item['base_total_due'] ?? null;
        $formatted['base_to_global_rate'] = $item['base_to_global_rate'] ?? null;
        $formatted['base_to_order_rate'] = $item['base_to_order_rate'] ?? null;
        $formatted['billing_address_id'] = $item['billing_address_id'] ?? null;
        $formatted['customer_id'] = $item['customer_id'] ?? null;
        $formatted['customer_group_id'] = $item['customer_group_id'] ?? null;
        $formatted['customer_email'] = $item['customer_email'] ?? null;
        $formatted['customer_firstname'] = $item['customer_firstname'] ?? null;
        $formatted['customer_is_guest'] = $item['customer_is_guest'] ? !!$item['customer_is_guest'] : null;
        $formatted['discount_amount'] = $item['discount_amount'] ?? null;
        $formatted['discount_canceled'] = $item['discount_canceled'] ?? null;
        $formatted['discount_invoiced'] = $item['discount_invoiced'] ?? null;
        $formatted['discount_refunded'] = $item['discount_refunded'] ?? null;
        $formatted['discount_tax_compensation_amount'] = $item['discount_tax_compensation_amount'] ?? null;
        $formatted['discount_tax_compensation_invoiced'] = $item['discount_tax_compensation_invoiced'] ?? null;
        $formatted['discount_tax_compensation_refunded'] = $item['discount_tax_compensation_refunded'] ?? null;
        $formatted['email_sent'] = $item['email_sent'] ? !!$item['email_sent'] : null;
        $formatted['global_currency_code'] = $item['global_currency_code'] ?? null;
        $formatted['grand_total'] = $item['grand_total'] ?? null;
        $formatted['order_currency_code'] = $item['order_currency_code'] ?? null;
        $formatted['protect_code'] = $item['protect_code'] ?? null;
        $formatted['quote_id'] = $item['quote_id'] ?? null;
        $formatted['remote_ip'] = $item['remote_ip'] ?? null;
        $formatted['shipping_amount'] = $item['shipping_amount'] ?? null;
        $formatted['shipping_canceled'] = $item['shipping_canceled'] ?? null;
        $formatted['shipping_description'] = $item['shipping_description'] ?? null;
        $formatted['shipping_discount_amount'] = $item['shipping_discount_amount'] ?? null;
        $formatted['shipping_discount_tax_compensation_amount'] = $item['shipping_discount_tax_compensation_amount'] ?? null;
        $formatted['shipping_incl_tax'] = $item['shipping_incl_tax'] ?? null;
        $formatted['shipping_invoiced'] = $item['shipping_invoiced'] ?? null;
        $formatted['shipping_refunded'] = $item['shipping_refunded'] ?? null;
        $formatted['shipping_tax_amount'] = $item['shipping_tax_amount'] ?? null;
        $formatted['shipping_tax_refunded'] = $item['shipping_tax_refunded'] ?? null;
        $formatted['state'] = $item['state'] ?? null;
        $formatted['status'] = $item['status'] ?? null;
        $formatted['store_currency_code'] = $item['store_currency_code'] ?? null;
        $formatted['store_id'] = $item['store_id'] ?? null;
        $formatted['store_name'] = $item['store_name'] ?? null;
        $formatted['store_to_base_rate'] = $item['store_to_base_rate'] ?? null;
        $formatted['store_to_order_rate'] = $item['store_to_order_rate'] ?? null;
        $formatted['subtotal'] = $item['subtotal'] ?? null;
        $formatted['subtotal_canceled'] = $item['subtotal_canceled'] ?? null;
        $formatted['subtotal_incl_tax'] = $item['subtotal_incl_tax'] ?? null;
        $formatted['subtotal_invoiced'] = $item['subtotal_invoiced'] ?? null;
        $formatted['subtotal_refunded'] = $item['subtotal_refunded'] ?? null;
        $formatted['tax_amount'] = $item['tax_amount'] ?? null;
        $formatted['tax_canceled'] = $item['tax_canceled'] ?? null;
        $formatted['tax_invoiced'] = $item['tax_invoiced'] ?? null;
        $formatted['tax_refunded'] = $item['tax_refunded'] ?? null;
        $formatted['total_canceled'] = $item['total_canceled'] ?? null;
        $formatted['total_due'] = $item['total_due'] ?? null;
        $formatted['total_invoiced'] = $item['total_invoiced'] ?? null;
        $formatted['total_item_count'] = $item['total_item_count'] ?? null;
        $formatted['total_offline_refunded'] = $item['total_offline_refunded'] ?? null;
        $formatted['total_online_refunded'] = $item['total_online_refunded'] ?? null;
        $formatted['total_paid'] = $item['total_paid'] ?? null;
        $formatted['total_qty_ordered'] = $item['total_qty_ordered'] ?? null;
        $formatted['total_refunded'] = $item['total_refunded'] ?? null;
        $formatted['weight'] = $item['weight'] ?? null;
        $formatted['created_at'] = $item['created_at'] ?? null;
        $formatted['updated_at'] = $item['updated_at'] ?? null;

        return $formatted;
    }
}
