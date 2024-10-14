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

class Subtotal
{
    public $scopeConfig;

    /**
     * @var \Magento\Tax\Helper\Data
     */
    public $taxHelper;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Tax\Helper\Data $taxHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->taxHelper = $taxHelper;
    }

    public function afterGetTotalsForDisplay($subject, $result)
    {
        $showAdjustment = $this->scopeConfig->getValue(
            \Cart2Quote\Quotation\Block\Quote\Totals::XML_PATH_CART2QUOTE_QUOTATION_GLOBAL_SHOW_QUOTE_ADJUSTMENT
        );

        $helper = $this->taxHelper;
        $store = $subject->getSource()->getStore();
        $nextIndex = 0;


        if ($showAdjustment && ($subject->getQuote()->getSubtotal() != $subject->getQuote()->getOriginalSubTotal())) {
            if ($helper->displaySalesSubtotalBoth($store)) {
                $result[0]['source_field'] = 'original_subtotal_1';
                $result[1]['source_field'] = 'original_subtotal_2';
                $nextIndex = 2;
            } elseif ($helper->displaySalesSubtotalInclTax($store)) {
                $result[0]['source_field'] = 'original_subtotal_0';
                $nextIndex = 1;
            } else {
                $result[0]['source_field'] = 'original_subtotal_0';
                $nextIndex = 1;
            }
        }

        if ($helper->displaySalesSubtotalBoth($store)) {
            $result[$nextIndex]['source_field'] = 'subtotal_1';
            $nextIndex++;
            $result[$nextIndex]['source_field'] = 'subtotal_2';
            $nextIndex++;

        } elseif ($helper->displaySalesSubtotalInclTax($store)) {
            $result[$nextIndex]['source_field'] = 'subtotal_0';
            $nextIndex++;

        } else {
            $result[$nextIndex]['source_field'] = 'subtotal_0';
            $nextIndex++;
        }

        return $result;
    }
}