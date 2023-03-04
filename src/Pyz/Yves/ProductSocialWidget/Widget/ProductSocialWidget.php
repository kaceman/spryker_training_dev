<?php

namespace Pyz\Yves\ProductSocialWidget\Widget;

use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

class ProductSocialWidget extends AbstractWidget
{

    public const PARAMETER_PRODUCT_NAME = 'product_name';
    public const PARAMETER_PRODUCT_URL = 'product_url';
    public const PARAMETER_SOCIAL_ICONS = 'social_icons';


    /**
     * @param string $productName
     * @param string $productUrl
     * @param array $socialIcons
     */
    public function __construct(string $productName, string $productUrl, array $socialIcons)
    {
        $this->addProductNameParameter($productName);
        $this->addProductUrlParameter($productUrl);
        $this->addProductSocialIconsParameter($socialIcons);
    }

    public static function getName(): string
    {
        return 'ProductSocialWidget';
    }

    public static function getTemplate(): string
    {
        return '@ProductSocialWidget/views/product-social-widget/product-social-widget.twig';
    }

    /**
     * @param string $productName
     * @return void
     */
    public function addProductNameParameter(string $productName): void
    {
        $this->addParameter(static::PARAMETER_PRODUCT_NAME, $productName);
    }

    /**
     * @param string $productUrl
     * @return void
     */
    public function addProductUrlParameter(string $productUrl): void
    {
        $this->addParameter(static::PARAMETER_PRODUCT_URL, $productUrl);
    }

    /**
     * @param array $socialIcons
     * @return void
     */
    public function addProductSocialIconsParameter(array $socialIcons): void
    {
        $this->addParameter(static::PARAMETER_SOCIAL_ICONS, $socialIcons);
    }
}
