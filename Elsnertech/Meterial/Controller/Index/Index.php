<?php
namespace Elsnertech\Meterial\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $materialFactory;
    protected $resultJsonFactory;
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Elsnertech\Meterial\Model\Material $materialFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_request = $context->getRequest();
        $this->materialFactory = $materialFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultPageFactory = $resultPageFactory;
    } 

    public function execute()
    {
        // $result = $this->resultJsonFactory->create();
        $postdata = $this->_request->getPost();
        $title = json_decode($postdata['titlearr']);
        $colorcodesarr = json_decode($postdata['colorcodesarr']);
        $perarr = json_decode($postdata['perarr']);
        $productId = $postdata['productId'];

        $materialModel= $this->materialFactory;
        $materialCollection =$materialModel->getCollection()
                ->addFieldToFilter('product_id',array('eq' => $productId));
        if(count($materialCollection) == 0){
          $materialModel->setData(
              array(
               'product_id'=>$productId,
               'title'=>serialize($title),
               'color'=>serialize($colorcodesarr),
               'percentage'=>serialize($perarr),
               ));
          $materialModel->save();            
        }else{
            foreach($materialCollection as $materials){            
                $materialModeldata = $this->materialFactory;
                $materialModeldata->load($materials->getId());

                // print_r($materialModeldata->getId());exit;
                $materialModeldata->setData(
                  array(
                   'id'=>$materials->getId(),
                   'product_id'=>$materials->getProductId(),
                   'title'=>serialize($title),
                   'color'=>serialize($colorcodesarr),
                   'percentage'=>serialize($perarr)
                ));
                $materialModeldata->save();
            }
        }
        $result = $this->resultJsonFactory->create();

        $result->setData(
        [
            'status'=>true
        ]);                
        return $result;
    }
}
