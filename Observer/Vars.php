<?php

namespace Magetrend\PdfCart2Quote\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class Vars
 * @package Magetrend\PdfCart2Quote\Observer
 */
class Vars implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Cart2Quote\Quotation\Model\QuoteFactory
     */
    private $quoteFactory;

    /**
     * @var \Magento\User\Model\UserFactory
     */
    public $userFactory;

    /**
     * Vars constructor.
     * @param \Cart2Quote\Quotation\Model\QuoteFactory $quoteFactory
     * @param \Magento\CurrencySymbol\Model\System\Currencysymbol $currencySymbol
     */
    public function __construct(
        \Cart2Quote\Quotation\Model\QuoteFactory $quoteFactory,
        \Magento\Framework\Locale\CurrencyInterface $localeCurrency,
        \Magento\User\Model\UserFactory $userFactory
    ) {
        $this->quoteFactory = $quoteFactory;
        $this->localeCurrency = $localeCurrency;
        $this->userFactory = $userFactory;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getVariableList();

        $quote = $this->quoteFactory->create()->load($quote->getQuoteId())->getData();
        if (!empty($quote['increment_id'])) {
            $observer->getVariableList()->setData('c2q_increment_id', $quote['increment_id']);
            $observer->getVariableList()->setData('c2q_expiry_date', $quote['expiry_date']);
            $observer->getVariableList()->setData('c2q_base_custom_price_total', number_format($quote['base_subtotal_with_discount'], 2));
            $observer->getVariableList()->setData('c2q_custom_price_total', number_format($quote['custom_price_total'], 2));
            $observer->getVariableList()->setData('c2q_subtotal', number_format($quote['subtotal'], 2));
            $observer->getVariableList()->setData('c2q_base_subtotal', number_format($quote['base_subtotal'], 2));
            $observer->getVariableList()->setData('c2q_subtotal_with_discount', number_format($quote['subtotal_with_discount'], 2));
            $observer->getVariableList()->setData('c2q_base_subtotal_with_discount', number_format($quote['base_subtotal_with_discount'], 2));
            $observer->getVariableList()->setData('c2q_base_currency_code', $this->localeCurrency->getCurrency($quote['base_currency_code'])->getSymbol());
            $observer->getVariableList()->setData('c2q_store_currency_code', $this->localeCurrency->getCurrency($quote['base_currency_code'])->getSymbol());
            $observer->getVariableList()->setData('c2q_quote_currency_code', $this->localeCurrency->getCurrency($quote['base_currency_code'])->getSymbol());
        }

        $adminCreatorId = $quote['admin_creator_id'];
        $observer->getVariableList()->setData('c2q_created_by', '');
        if (is_numeric($adminCreatorId)) {
            $adminUser = $this->userFactory->create()
                ->load($adminCreatorId);

            if ($adminUser->getId()) {
                $observer->getVariableList()
                    ->setData('c2q_created_by', $adminUser->getFirstname().' '.$adminUser->getLastname());
            }
        }
    }
}
