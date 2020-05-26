<?php
namespace Isobar\DiscountPackage\Api;
interface PostManagementInterface {
    /**
     * GET for Post api
     * @param string $package_name
     * @return string
     */
    public function customGetMethod($package_name);
    /**
     * GET for Post api
     * @param string $product_category
     * @param string $package_name
     * @param string $discount_code
     * @return string
     */
    public function customPostMethod($product_category,$package_name,$discount_code);
}