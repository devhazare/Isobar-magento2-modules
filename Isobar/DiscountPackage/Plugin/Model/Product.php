<?php
namespace Isobar\DiscountPackage\Plugin\Model;
 
class Product
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {	$data = array();
		 //500
		$product_id = $subject->getId();
		$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
		$orderDatamodel = $objectManager->get('Isobar\DiscountPackage\Model\Custom')->getCollection();
				
				foreach($orderDatamodel as $orderDatamodel1){
					$data = $orderDatamodel1->toArray();
					$product_category = $data['product_category'];
					$from_date = $data['from_date'];
					$to_date = $data['to_date'];
					$discount_percentage = $data['discount_percentage']; //3%
			
					if($product_category==$product_id){
						//$TodayDate = strtotime(date("Y-m-d"));
						//$contractDateBegin = date('Y-m-d',strtotime($from_date));
						//$contractDateEnd = date('Y-m-d',strtotime($to_date));

						//if($TodayDate > $contractDateBegin && $TodayDate < $contractDateEnd) {
							$result = $result - (($discount_percentage/100)*$result);
						//} 
						break;
					}	
				}
				
			
        
        return $result;
    }
}