<?php
namespace Elsnertech\Meterial\Model\ResourceModel\Material;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'id';
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Elsnertech\Meterial\Model\Material', 'Elsnertech\Meterial\Model\ResourceModel\Material');
    }
}
