<?php
namespace Isobar\DiscountPackage\Block\Adminhtml\Custom\Edit\Tab;
class Validity extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
		$this->collectionFactory = $collectionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('discountpackage_custom');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Validity')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'from_date',
            'date',
            array(
                'name' => 'from_date',
                'label' => __('from date'),
                'title' => __('from date'),
				'format' => 'yy-mm-dd',
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'to_date',
            'date',
            array(
                'name' => 'to_date',
                'label' => __('to date'),
                'title' => __('to date'),
				'format' => 'yy-mm-dd',
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'product_category',
            'select',
            array(
                'name' => 'product_category',
                'label' => __('product category'),
                'title' => __('product category'),
				'values' => $this->getProductList(),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'status',
            'text',
            array(
                'name' => 'status',
                'label' => __('status'),
                'title' => __('status'),
                /*'required' => true,*/
            )
        );
		/*{{CedAddFormField}}*/
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Validity');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Validity');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
	
	public function getProductList(){
		
		 // Use factory to create a new product collection
    $productCollection = $this->collectionFactory->create();
    /** Apply filters here */
    $productCollection->addAttributeToSelect('*');
    // Don't have to do this
    // $productCollection->load();

		foreach ($productCollection as $product){
			 $result[$product->getId()]=$product->getName();
			 
		}
		return 	$result;
	}
}
