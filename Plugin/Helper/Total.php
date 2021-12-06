<?php
/**
 * MB "Vienas bitas" (Magetrend.com)
 *
 * @category MageTrend
 * @package  Magetend/PdfCart2Quote
 * @author   Edvstu <edwin@magetrend.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.magetrend.com/magento-2-pdf-invoice-pro
 */

namespace Magetrend\PdfCart2Quote\Plugin\Helper;

class Total
{
    public function aroundGetTotalsConfig($subject, callable $parent, $store = null, $type = null, $sort = true)
    {
        $totals = $parent($store, $type, $sort);

        if (!in_array($type, ['cart2quote', 'all'])) {
            return $totals;
        }

        $totals['original_subtotal_0'] = [
            'sort_order' => 5,
            'title' => 'Original Subtotal',
            'source_field' => 'original_subtotal_0',
            'dummy_value' => '$0.00'
        ];

        $totals['quote_adjustment_0'] = [
            'sort_order' => 6,
            'title' => 'Quote Adjustment',
            'source_field' => 'quote_adjustment_0',
            'dummy_value' => '$0.00'
        ];

        $totals['quote_profit_0'] = [
            'sort_order' => 7,
            'title' => 'Quote Profit',
            'source_field' => 'quote_profit_0',
            'dummy_value' => '$0.00'
        ];

        return $totals;
    }

}
