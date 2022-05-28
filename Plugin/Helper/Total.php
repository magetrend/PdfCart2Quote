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

use Magetrend\PdfCart2Quote\Model\TypeAdapter;

class Total
{
    public $registry;

    public function __construct(
        \Magetrend\PdfCart2Quote\Model\Registry $registry
    ) {
        $this->registry = $registry;
    }

    public function beforeGetQuoteTotalData($subject, $attributes, $quote, $template)
    {
        $this->registry->isQuote = true;
        return [$attributes, $quote, $template];
    }

    public function beforeGetOrderTotalData($subject, $attributes, $order, $source, $template)
    {
        if ($source instanceof \Cart2Quote\Quotation\Model\Quote) {
            $subject->disableFullTaxSummary = true;
        }

        return [$attributes, $order, $source, $template];
    }

    public function afterGetAvailableTotals($subject, $totals)
    {
        $totals['original_subtotal_1'] = [];
        $totals['original_subtotal_1']['title'] = 'Original Subtotal (Excl. Tax):';
        $totals['original_subtotal_1']['source_field'] = 'original_subtotal_1';

        $totals['original_subtotal_2'] = [];
        $totals['original_subtotal_2']['title'] = 'Original Subtotal (Incl. Tax):';
        $totals['original_subtotal_2']['source_field'] = 'original_subtotal_2';

        $totals['original_subtotal_0'] = [];
        $totals['original_subtotal_0']['title'] = 'Original Subtotal:';
        $totals['original_subtotal_0']['source_field'] = 'original_subtotal_0';

        $totals['quote_discount_0'] = [];
        $totals['quote_discount_0']['title'] = 'Quote Discount:';
        $totals['quote_discount_0']['source_field'] = 'quote_discount_0';

        $totals['quote_adjustment_0'] = [];
        $totals['quote_adjustment_0']['title'] = 'Quote Adjustment:';
        $totals['quote_adjustment_0']['source_field'] = 'quote_adjustment_0';

        return $totals;
    }
}
