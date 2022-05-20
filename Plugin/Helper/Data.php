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

class Data
{
    public $registry;

    public function __construct(
        \Magetrend\PdfCart2Quote\Model\Registry $registry
    ) {
        $this->registry = $registry;
    }

    public function afterGetTotalsSorting($subject, $result)
    {
        if ($this->registry->isQuote) {
            if (isset($result['quote_grand_total_tax']) && !empty($result['quote_grand_total_tax'])) {
                $result['grand_total_3'] = $result['quote_grand_total_tax'];
            }

            if (isset($result['quote_tax']) && !empty($result['quote_tax'])) {
                $result['tax_amount_0'] = $result['quote_tax'];
            }
        }

        return $result;
    }
}
