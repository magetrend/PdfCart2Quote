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

namespace Magetrend\PdfCart2Quote\Plugin\Block\Adminhtml;

class SourceField
{
    /**
     * Add additional button option
     * @param $subject
     * @param $return
     * @return mixed
     */
    public function afterAddAdditionalOptions($subject, $return)
    {
        $subject->addOption('quote_grand_total_tax', 'Quote Grand Total Tax');
        $subject->addOption('quote_tax', 'Quote Tax');

        return $return;
    }
}
