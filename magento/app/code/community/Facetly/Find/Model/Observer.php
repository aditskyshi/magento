<?php
/**
 * Our class name should follow the directory structure of
 * our Observer.php model, starting from the namespace,
 * replacing directory separators with underscores.
 * i.e. app/code/local/SmashingMagazine/
 *                     LogProductUpdate/Model/Observer.php
 */
class Facetly_Find_Model_Observer
{
    /**
     * Magento passes a Varien_Event_Observer object as
     * the first parameter of dispatched events.
     */
    public function logUpdate(Varien_Event_Observer $observer)
    {
		//print_r(Mage::getModel('catalog/product')->getSmallImageUrl(200,200));
        $product = $observer->getEvent()->getProduct();
        $status = $product->getStatus();
		
		if($status == 1){
			$data = $product->getData();
			$id = $data['entity_id'];
			$product = Mage::getModel('find/custom');
			$loaded_data = $product->loadProductById($id);
			$message = $product->pushItem($loaded_data);
		}else{
			$data = $product->getData();
			$id = $data['entity_id'];
			$product = Mage::getModel('find/custom');
			$message = $product->deleteItem($id);
		}
		//print_r($loaded_data);
		
		//echo 'ganteng banget oke coooong';
       // exit;
        
        // $name = $product->getName();
        // $sku = $product->getSku();
        // Mage::log(
            // "{$name} ({$sku}) updated",
            // null, 
            // 'product-updates.log'
        // );
    }
	
	 public function logDelete(Varien_Event_Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        //print_r($product->getData());
		$data = $product->getData();
		$id = $data['entity_id'];
		$product = Mage::getModel('find/custom');
		$message = $product->deleteItem($id);

		
        // $name = $product->getName();
        // $sku = $product->getSku();
        // Mage::log(
            // "{$name} ({$sku}) updated",
            // null, 
            // 'product-updates.log'
        // );
    }
}