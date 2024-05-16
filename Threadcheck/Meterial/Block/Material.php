<?php
namespace Threadcheck\Meterial\Block;
use Magento\Framework\View\Element\Template;
class Material extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry = null;
    protected $_registry;
    protected $_productRepository;
    public function __construct(
        Template\Context $context,
        \Threadcheck\Meterial\Model\Material $materialFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
    
        $this->_productRepository = $productRepository;
        $this->_registry = $registry;
        $this->materialFactory = $materialFactory;
        parent::__construct($context, $data);
       
    }
    public function getCurrentProduct()
    {       
        return $this->_registry->registry('current_product');
    }   
  
    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function getSavedMaterial()
    {
        $productId = $this->getCurrentProduct()->getId();
        $materialModel= $this->materialFactory;
        $materialCollection =$materialModel->getCollection()
                ->addFieldToFilter('product_id',array('eq' => $productId));
        $materialDataValue = [];
        if(count($materialCollection) != 0){
            $materialData = $materialCollection->getData()[0];
            $materialDataValue['title'] = unserialize($materialData['title']);
            $materialDataValue['color'] = unserialize($materialData['color']);
            $materialDataValue['per'] = unserialize($materialData['percentage']);
        }
        return $materialDataValue;

    }

}
 