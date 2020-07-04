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

class TypeAdapter extends \Magetrend\PdfTemplates\Model\TypeAbstract
{
    const PDF_TEMPLATE_TYPE = 'cart2quote';

    /**
     * @var \Magetrend\PdfCart2Quote\Helper\Data
     */
    public $helper;

    /**
     * @var \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory
     */
    public $quoteCollectionFactory;

    /**
     * @var \Cart2Quote\Quotation\Api\QuoteRepositoryInterface
     */
    public $quoteRepository;

    /**
     * @var Filter
     */
    public $filter;

    /**
     * TypeAdapter constructor.
     * @param \Magetrend\PdfCart2Quote\Helper\Data $helper
     * @param \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory
     */
    public function __construct(
        \Magetrend\PdfTemplates\Helper\Data $moduleHelper,
        \Magetrend\PdfCart2Quote\Helper\Data $helper,
        \Cart2Quote\Quotation\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Cart2Quote\Quotation\Api\QuoteRepositoryInterface $quoteRepository,
        \Magetrend\PdfCart2Quote\Model\Filter $filter,
        \Magetrend\PdfTemplates\Model\Pdf\QuoteFactory $zendProcessor,
        \Magetrend\PdfTemplates\Model\Adapter\TcPdf\QuoteFactory $tcpdfProcessor
    ) {
        $this->helper = $helper;
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->quoteRepository = $quoteRepository;
        $this->filter = $filter;
        $this->zendProcessor = $zendProcessor;
        $this->tcpdfProcessor = $tcpdfProcessor;
        parent::__construct($moduleHelper);
    }

    public function getCollection()
    {
        return $this->quoteCollectionFactory->create();
    }

    public function getObjectById($objectId)
    {
        return $this->quoteRepository->get($objectId);
    }

    public function getType()
    {
        return self::PDF_TEMPLATE_TYPE;
    }

    public function getTypeLabel()
    {
        return (string)__('Cart2Quote Quotation');
    }

    public function getModuleName()
    {
        return 'Magetrend_PdfCart2Quote';
    }
}
