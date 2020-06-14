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
namespace Magetrend\PdfCart2Quote\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Module helper class
 * @package Magetrend\PdfCart2Quote\Helper
 */
class Data
{
    const XML_PATH_PDF_TEMPLATE_PATH = 'pdftemplates/cart2quote/template';

    const XML_PATH_PDF_NAME_SINGLE_PATH = 'pdftemplates/cart2quote/name_quote';

    const XML_PATH_PDF_NAME_MULTIPLE_PATH = 'pdftemplates/cart2quote/name_quote_collection';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * @var \Magetrend\PdfTemplates\Helper\Data
     */
    public $moduleHelper;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magetrend\PdfTemplates\Helper\Data $moduleHelper
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magetrend\PdfTemplates\Helper\Data $moduleHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->moduleHelper = $moduleHelper;
    }

    /**
     * Returns Quote PDF template ID
     * @param null $storeId
     * @return mixed
     */
    public function getTemplateId($storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PDF_TEMPLATE_PATH, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Retrun file name for PDF
     * @param array $quotes
     * @param string $type
     * @param null $storeId
     * @return \Magento\Framework\Phrase
     */
    public function getFileName($quotes = [], $type = 'single', $storeId = null)
    {
        switch ($type) {
            case 'single':
                $fileName = $this->scopeConfig->getValue(
                    self::XML_PATH_PDF_NAME_SINGLE_PATH,
                    ScopeInterface::SCOPE_STORE,
                    $storeId
                );
                break;
            case 'multiple':
                $fileName = $this->scopeConfig->getValue(
                    self::XML_PATH_PDF_NAME_MULTIPLE_PATH,
                    ScopeInterface::SCOPE_STORE,
                    $storeId
                );
        }

        $vars = [
            'date' => date('Y-m-d')
        ];
        if (!empty($quotes)) {
            if ($type = 'single') {
                $quote = end($quotes);
                $vars['id'] = $quote->getId();
            }
        }

        return __($fileName, $vars);
    }
}
