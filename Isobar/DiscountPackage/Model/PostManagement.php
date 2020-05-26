<?php
//https://magecomp.com/blog/create-custom-rest-api-in-magento-2/
namespace Isobar\DiscountPackage\Model;
use Isobar\DiscountPackage\Api\PostManagementInterface;
class PostManagement implements PostManagementInterface
{
    /**
     * {@inheritdoc}
     */
	 protected $_collectionFactory;
	 protected $jsonHelper;
	 
	public function __construct(
			\Isobar\DiscountPackage\Model\ResourceModel\Custom\Collection $collectionFactory,
			\Magento\Framework\Json\Helper\Data $jsonHelper
	) {
		$this->jsonHelper = $jsonHelper;
		$this->_collectionFactory = $collectionFactory;
	} 	  
    public function customGetMethod($package_name)
    {
		$collection = $this->_collectionFactory->load();
		/* $collection->addAttributeToSelect('*');
		$collection->addAttributeToFilter([
			
			[
				'attribute' => 'package_name',
				'like' => $package_name]
		]);  */
		//print_r($collection->getData());die;
        try{
             /* $response = [
                    'package_name' =>$package_name
            ]; */
			$response = $this->jsonHelper->jsonEncode($collection->getData());
        }catch(\Exception $e) {
            $response=['error' => $e->getMessage()];
        }

        return json_encode($response);
    }
    /**
     * {@inheritdoc}
     */
    public function customPostMethod($product_category,$package_name,$discount_code)
    {
        try{
            $response = [
                'product_category' => $product_category,
                'package_name' =>$package_name,
                'discount_code'=>$discount_code
            ];
        }catch(\Exception $e) {
            $response=['error' => $e->getMessage()];
        }
        return json_encode($response);
    }
}