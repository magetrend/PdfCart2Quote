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

class ProductName
{
    /**
     * Added item remarks
     * @param $subject
     * @param $data
     * @return mixed
     */
    public function afterGetPdfData($subject, $data)
    {
        $item = $subject->getItem();
        $itemDescription = $item->getDescription();
        if (empty($itemDescription)) {
            return $data;
        }

        $itemDescription = str_replace(['<br/>', '<br>', '</br>', "\n"], '{br}', $itemDescription);
        $itemDescription = explode('{br}', $itemDescription);
        foreach ($itemDescription as $line) {
            $data['text']['product_option']['text'][] = $line;
        }

        $data['height'] += ($data['text']['product_option']['line_height']*count($itemDescription));
        return $data;
    }
}
