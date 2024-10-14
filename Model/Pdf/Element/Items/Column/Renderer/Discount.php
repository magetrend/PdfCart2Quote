<?php
/**
 * MB "Vienas bitas" (Magetrend.com)
 *
 * @category MageTrend
 * @package  Magetend/PdfCart2Quote
 * @author   Edwin <edwin@magetrend.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.magetrend.com/magento-2-pdf-invoice-pro
 */

namespace Magetrend\PdfCart2Quote\Model\Pdf\Element\Items\Column\Renderer;

/**
 *  Discount column renderer
 */
class Discount extends \Magetrend\PdfTemplates\Model\Pdf\Element\Items\Column\DefaultRenderer
{
    /**
     * @var \Cart2Quote\Quotation\Block\Quote\TierItem
     */
    public $tierItemBlock;

    /**
     * Discount constructor.
     * @param \Magetrend\PdfTemplates\Helper\Data $moduleHelper
     * @param \Magetrend\PdfTemplates\Model\Pdf\Element $element
     * @param \Magetrend\PdfTemplates\Model\Pdf\Decorator $decorator
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock
     * @param array $data
     */
    public function __construct(
        \Magetrend\PdfTemplates\Helper\Data $moduleHelper,
        \Magetrend\PdfTemplates\Model\Pdf\Element $element,
        \Magetrend\PdfTemplates\Model\Pdf\Decorator $decorator,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock,
        array $data = []
    ) {
        $this->tierItemBlock = $tierItemBlock;
        parent::__construct($moduleHelper, $element, $decorator, $scopeConfig, $data);
    }

    /**
     * Return discount percentage value
     * @return mixed
     */

    public function getRowValue()
    {
        $item = $this->getItem();
        $tierPrices = $item->getTierItems();

        if (empty($tierPrices)) {
            return '-';
        }

        $rowValue = '';
        foreach ($tierPrices as $tierPrice) {
            $price = $tierPrice->getOriginalPrice();
            $customPrice = $tierPrice->getCustomPrice();

            if ($price == $customPrice) {
                $rowValue .= '-';
            } elseif ($price == 0) {
                $rowValue .= '-';
            } else {
                $discountValue = number_format(100 - ($customPrice * 100 / $price), 2).'%';
                $rowValue .= ($discountValue.'{br}');
            }
        }

        return $rowValue;
    }
}
