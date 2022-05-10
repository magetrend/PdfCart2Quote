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

namespace Magetrend\PdfCart2Quote\Model\Quote;

class Pdf extends \Cart2Quote\Quotation\Model\Quote\Pdf\Quote
{
   public function getTotalsList()
   {
       return $this->_getTotalsList();
   }
}
