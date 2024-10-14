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

namespace Magetrend\PdfCart2Quote\Plugin\Model\Quote\Pdf\Total;

class QuoteAdjustment
{
    public function afterGetTotalsForDisplay($subject, $result)
    {
        if (empty($result)) {
            return $result;
        }

        $result[0]['source_field'] = 'quote_adjustment_0';
        return $result;
    }
}