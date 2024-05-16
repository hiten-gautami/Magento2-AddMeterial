<?php
namespace Threadcheck\Meterial\Model\ResourceModel;

/**
 * Material resource
 */
class Material extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    // Table Name and Primary Key column
    public function _construct()
    {
        $this->_init('material', 'id');
    }
}
