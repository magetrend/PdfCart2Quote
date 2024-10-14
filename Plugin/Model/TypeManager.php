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

namespace Magetrend\PdfCart2Quote\Plugin\Model;

class TypeManager
{
    public $typeAdapter;

    public function __construct(
        \Magetrend\PdfCart2Quote\Model\TypeAdapter $typeAdapter
    ) {
        $this->typeAdapter = $typeAdapter;
    }

    public function aroundGetAdapter($subject, callable $parent, $source = null)
    {
        $adapter = $parent($source);

        if ($source === null
            && $subject->getTemplateType() == \Magetrend\PdfCart2Quote\Model\TypeAdapter::PDF_TEMPLATE_TYPE) {
            return $this->typeAdapter;
        }

        if ($source !== null
            && $source instanceof \Cart2Quote\Quotation\Model\Quote) {
            return $this->typeAdapter;
        }

        return $adapter;
    }
}
