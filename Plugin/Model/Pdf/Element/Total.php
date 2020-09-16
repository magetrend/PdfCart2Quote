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

namespace Magetrend\PdfCart2Quote\Plugin\Model\Pdf\Element;

/**
 * Class Total
 * @package Magetrend\PdfCart2Quote\Plugin\Model\Pdf\Element
 */
class Total
{
    /**
     * @param $subject
     * @param $result
     * @return mixed
     */
    public function afterGetQuoteTotalData($subject, $result)
    {
        $totals = $result;
        $arrayKey = 0;

        // Remove quote profit data from totals
        foreach ($totals as $total) {
            if ($total['code'] == 'quote_profit') {
                unset($totals[$arrayKey]);
            }
            $arrayKey += 1;
        }

        return $totals;
    }
}
