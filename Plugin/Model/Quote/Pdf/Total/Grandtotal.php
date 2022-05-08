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

class Grandtotal
{
    public function afterGetTotalsForDisplay($subject, $result)
    {
        if (!$result || !is_array($result)) {
            return $result;
        }

        foreach ($result as $key => $value) {
            if (empty($value['amount'])) {
                unset($result[$key]);
            }
        }

        if (count($result) == 1) {
            $result[0]['source_field'] = 'grand_total_0';
            $result[0]['is_grand_total'] = 1;
            return $result;
        }
        $lines = count($result);

        foreach ($result as $key => $value) {
            $result[$key]['is_grand_total'] = 1;
            $result[$key]['source_field'] = 'grand_total_3';
        }

        $result[0]['source_field'] = 'grand_total_1';
        $result[$lines-1]['source_field'] = 'grand_total_4';

        return $result;
    }
}