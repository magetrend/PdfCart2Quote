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

namespace Magetrend\PdfCart2Quote\Model;

class Filter extends \Magetrend\PdfTemplates\Model\Pdf\Filter\Quote
{
    public function getData()
    {
        $quote = $this->getSource();
        $currencyCode = $this->moduleHelper->getCurrencyCode($quote->getStoreId());
        $data = [
            'quote_id' => $quote->getId(),
            'quote_no' => $quote->getIncrementId(),
            'quote_date' => $this->moduleHelper->formatDate($quote->getCreatedAt(), $quote->getStoreId()),
            'grand_total' => $this->moduleHelper->formatPrice($currencyCode, $quote->getGrandTotal()),
        ];

        $data['customer_note'] = '';
        if ($customerNote = $quote->getCustomerNote()) {
            $data['customer_note'] = $customerNote;
        }

        $data = $this->addBillingData($data);
        $data = $this->addShippingData($data);
        $data = $this->addPaymentMethod($data);
        $data = $this->addShippingMethod($data);
        $data = $this->addTotals($data);
        $data = $this->addAdditionalData($data, 'cart2quote');

        return $data;
    }
}
