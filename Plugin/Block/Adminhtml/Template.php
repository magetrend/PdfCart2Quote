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

class Template
{
    /**
     * Add additional button option
     * @param $subject
     * @param $return
     * @return mixed
     */
    public function afterGetAddButtonOptions($subject, $return)
    {
        $return[] = [
            'label' => __('Cart2Quote Quotation'),
            'onclick' => "setLocation('" . $subject->getNewEntityUrl(\Magetrend\PdfCart2Quote\Model\TypeAdapter::PDF_TEMPLATE_TYPE) . "')"
        ];

        return $return;
    }
}
