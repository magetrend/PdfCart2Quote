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

namespace Magetrend\PdfCart2Quote\Plugin\Model\Sales\Order;

class Pdf
{
    public $quotePdf;

    public function __construct(
        \Magetrend\PdfCart2Quote\Model\Quote\Pdf $quotePdf
    ) {
        $this->quotePdf = $quotePdf;
    }

    public function aroundGetTotalsList($subject, callable $parent, $source)
    {
        if ($source instanceof \Cart2Quote\Quotation\Model\Quote) {
            return $this->quotePdf->getTotalsList();
        }

        return $parent($source);
    }
}