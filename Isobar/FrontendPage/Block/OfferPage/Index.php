<?php
/**
 * Copyright © 2015 Isobar . All rights reserved.
 */
namespace Isobar\FrontendPage\Block\OfferPage;
use Isobar\FrontendPage\Block\BaseBlock;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Json\Helper\Data as jsondata;

class Index extends \Magento\Catalog\Block\Product\ListProduct
{
	public $hello='Hello World';
	protected $_collectionFactory;
	
	public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
		\Isobar\DiscountPackage\Model\ResourceModel\Custom\Collection $collectionFactory,
        array $data = [],
        jsondata $jsonHelper
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->_catalogLayer = $layerResolver->get();
        $this->_postDataHelper = $postDataHelper;
        $this->categoryRepository = $categoryRepository;
        $this->urlHelper = $urlHelper;
		$this->_collectionFactory = $collectionFactory;
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data

        );
    }


 public function getProductCollectinJsonData()
    {
        /* $_productCollection = $this->getLoadedProductCollection()->addTierPriceData();
        $i                  = 0;
        $ProductData        = array();
        foreach ($_productCollection as $product) {
            if ($product->getTypeId() == 'simple') {
                $ProductData[$i]['Product Name'] = $product->getName();
                if ($product->getTierPrice()) {
                    $tierPriceList = $product->getTierPrice();
                    if (count($tierPriceList) > 0) {
                        $ProductData[$i]['1-' . (intval($tierPriceList[0]['price_qty'])) . ' Packs'] = $tierPriceList[0]['price'];
                    }
                    $count = 0;
                    foreach ($tierPriceList as $key => $trList) {
                        if ($count == (count($tierPriceList) - 1)) {
                            $ProductData[$i][intval($trList['price_qty']) . '+ Packs'] = number_format($trList['price'], 2);
                        } else {
                            $ProductData[$i][intval($trList['price_qty'] + 1) . '-' . (intval($tierPriceList[$key + 1]['price_qty'])) . ' Packs'] = number_format($trList['price'], 2);
                        }

                        $count++;
                    }
                }
                $i++;
            }
        } */
		$collection =$this->_collectionFactory->load();
        return $this->jsonHelper->jsonEncode($collection->getData());
    }

}
