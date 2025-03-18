<?php
/*
*  @author      Maria Foteini Troupi
*/

class AdditionalInfoUpdateModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
    }

    public function postProcess()
    {
        $material_and_care = $_POST['material_and_care'];
        $sustainability = $_POST['sustainability'];
        $point_of_origin = $_POST['point_of_origin'];
        $language_id = $_POST['language_id'];
        $product_id = $_POST['product_id'];
        $result = Db::getInstance()->execute(
            'UPDATE `' . _DB_PREFIX_ . 'product_lang` 
                SET `material_and_care`="' . $material_and_care . '", `point_of_origin`="' . $point_of_origin . '", `sustainability`="' . $sustainability . 
                '" WHERE `id_product`=' . $product_id . 
            ' AND `id_lang`=' . $language_id
        );


        header('Content-Type: application/json');
        $json = array(
            'result' => $result
        );
        die(Tools::jsonEncode($json));
    }
}
