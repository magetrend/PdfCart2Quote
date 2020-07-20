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

class Price
{
    /**
     * @var \Cart2Quote\Quotation\Block\Quote\TierItem
     */
    public $tierItemBlock;

    /**
     * Price constructor.
     * @param \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock
     */
    public function __construct(
        \Cart2Quote\Quotation\Block\Quote\TierItem $tierItemBlock
    ) {
        $this->tierItemBlock = $tierItemBlock;
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

        foreach ($tierPrices as $tier) {//print_r($tier);exit;
            $data['text']['subtotal']['text'][] = $tier[0]['price'];
        }

        return $data;
    }
}
