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

namespace Magetrend\PdfCart2Quote\Plugin\Model\Pdf\Element\Items\Column\Renderer;

class Subtotal
{
    /**
     * @var \Cart2Quote\Quotation\Block\Quote\TierItem
     */
    public $tierItemBlock;

    /**
     * @var \Magetrend\PdfTemplates\Helper\Data
     */
    public $moduleHelper;

    /**
     * Subtotal constructor.
     * @param \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock
     * @param \Magetrend\PdfTemplates\Helper\Data $moduleHelper
     */
    public function __construct(
        \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock,
        \Magetrend\PdfTemplates\Helper\Data $moduleHelper
    ) {
        $this->tierItemBlock = $tierItemBlock;
        $this->moduleHelper = $moduleHelper;
    }

    /**
     * Added quotation tier price
     * @param $subject
     * @param $data
     * @return mixed
     */
    public function afterGetPdfData($subject, $data)
    {
        $item = $subject->getItem();
        $tierPrices = $this->tierItemBlock->setItemData($item, true);

        if (empty($tierPrices)) {
            return $data;
        }

        $extraLine = 0;
        foreach ($tierPrices as $tier) {
            $extraLine++;
            $data['text']['subtotal']['text'][] = $tier[0]['subtotal'];
        }

        $attributes = $subject->getAttributes();
        $lineHeight = $this->moduleHelper->removePx($attributes['table_row_product_line_2_line_height']);
        $data['height'] += ($lineHeight * $extraLine);
        return $data;
    }
}
