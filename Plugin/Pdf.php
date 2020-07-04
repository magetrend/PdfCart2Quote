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

namespace Magetrend\PdfCart2Quote\Plugin;

class Pdf
{
    /**
     * @var \Magetrend\PdfTemplates\Helper\Data
     */
    public $moduleHelper;

    /**
     * @var \Magetrend\PdfTemplates\Model\TemplateFactory
     */
    public $pdfTemplate;

    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    /**
     * @var \Magento\Framework\Filesystem
     */
    public $filesystem;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * @var \Magetrend\PdfCart2Quote\Helper\Data
     */
    public $helper;

    /**
     * Invoice constructor.
     *
     * @param \Magetrend\PdfTemplates\Helper\Data $moduleHelper
     * @param \Magetrend\PdfTemplates\Model\TemplateFactory $pdfTemplateFactory
     */
    public function __construct(
        \Magetrend\PdfCart2Quote\Helper\Data $helper,
        \Magetrend\PdfTemplates\Helper\Data $moduleHelper,
        \Magetrend\PdfTemplates\Model\Template $pdfTemplate,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->helper = $helper;
        $this->moduleHelper = $moduleHelper;
        $this->pdfTemplate = $pdfTemplate;
        $this->registry = $registry;
        $this->filesystem = $filesystem;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Overwrite Quote2Cart PDF rendering
     * @param $subject
     * @param callable $parent
     * @param array $quotes
     * @return string
     */
    public function aroundCreateQuotePdf($subject, callable $parent, array $quotes)
    {
        $storeId = $this->getStoreId($quotes);
        if (!$this->moduleHelper->isActive($storeId)
            || $this->registry->registry(\Magetrend\PdfTemplates\Helper\Data::REGISTRY_IGNORE_KEY)) {
            return $parent($quotes);
        }

        $templateId = $this->helper->getTemplateId($storeId);
        if ($templateId < 1) {
            return $parent($quotes);
        }

        $fileName = $this->helper->getFileName($quotes, count($quotes)==1?'single':'multiple', $storeId);
        $path = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::TMP)
            ->getAbsolutePath($fileName);

        $pdf = $this->pdfTemplate->getPdf($quotes, $templateId);
        $pdf->save($path);

        return $path;
    }

    /**
     * Returns quote store id
     *
     * @param $invoices
     * @return int
     */
    public function getStoreId($quotes)
    {
        foreach ($quotes as $quote) {
            if ($quote->getStoreId()) {
                return $quote->getStoreId();
            }
        }

        return 0;
    }
}
