<?php
/**
 * MB "Vienas bitas" (Magetrend.com)
 *
 * @category MageTrend
 * @package  Magetend/PdfTemplates
 * @author   Edvstu <edwin@magetrend.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.magetrend.com/magento-2-pdf-invoice-pro
 */

namespace Magetrend\PdfCart2Quote\Observer;

use Magento\Framework\Event\Observer;

class Vars implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Adds increment id and id additioanl variables for PDF
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getSource();
        $observer->getVariableList()->setData('quote_id', $quote->getId());
        $observer->getVariableList()->setData('quote_no', $quote->getIncrementId());
    }
}