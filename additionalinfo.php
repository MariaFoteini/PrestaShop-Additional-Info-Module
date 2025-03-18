<?php
/*
*  @author      Maria Foteini Troupi
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class AdditionalInfo extends Module
{
    public function __construct()
    {
        $this->name = 'additionalinfo';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Maria Foteini Troupi';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Additional Information');
        $this->description = $this->l('Creates three additional information fields, "Materials & Care", "Sustainability" and "Points of origin". They can be edited by a new admin tab "Additional Information" and the are displayed on the product page.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if (
            !parent::install() ||
            !$this->_alterTable('add') ||
            !$this->registerHook('displayAdminProductsExtra') ||
            !$this->registerHook('displayFooterProduct')

        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (
            !parent::uninstall() ||
            !$this->_alterTable('remove')
        ) {
            return false;
        }
        return true;
    }

    protected function _alterTable($method)
    {
        switch ($method) {
            case 'add':
                return Db::getInstance()->execute('ALTER TABLE ' . _DB_PREFIX_ . 'product_lang ADD `material_and_care` TEXT NOT NULL , ADD `sustainability` TEXT NOT NULL, ADD `point_of_origin` TEXT NOT NULL');
            case 'remove':
                return Db::getInstance()->execute('ALTER TABLE ' . _DB_PREFIX_ . 'product_lang DROP COLUMN  `material_and_care`, DROP COLUMN `sustainability`, DROP COLUMN `point_of_origin`');
        }
    }

    public function prepareNewTabs()
    {
        $id_product = (int)Tools::getValue('id_product');
        $language_id =  $this->context->language->id;
        $additional_fields = Db::getInstance()->executeS('SELECT `material_and_care`, `sustainability`, `point_of_origin` FROM `' . _DB_PREFIX_ . 'product_lang` WHERE `id_product`=' . $id_product . ' AND `id_lang`=' . $language_id);
        $this->context->smarty->assign(array(
            'additional_fields' => $additional_fields[0],
            'controller_link'        => $this->context->link->getModuleLink('additionalinfo', 'update'),
            'language_id'            => $language_id,
            'product_id'             => $id_product
        ));
    }

    public function hookDisplayAdminProductsExtra()
    {
        if (Validate::isLoadedObject($product = new Product((int)Tools::getValue('id_product')))) {
            $this->prepareNewTabs();
            return $this->display(__FILE__, 'additionalinfoedit.tpl');
        }
    }

    public function hookDisplayFooterProduct()
    {
        $id_product = (int)Tools::getValue('id_product');
        $language_id =  $this->context->language->id;
        $additional_fields = Db::getInstance()->executeS('SELECT `material_and_care`, `sustainability`, `point_of_origin` FROM `' . _DB_PREFIX_ . 'product_lang` WHERE `id_product`=' . $id_product . ' AND `id_lang`=' . $language_id);
        $cols_num = 0;
        foreach ($additional_fields[0] as $value) {
            if ($value != NULL) {
                $cols_num++;
            }
        }
        $grid_col_class = "";
        if ($cols_num == 1) {
            $grid_col_class = "col-xs-12";
        } elseif ($cols_num == 2) {
            $grid_col_class = "col-xs-12 col-sm-6";
        } elseif ($cols_num == 3) {
            $grid_col_class = "col-xs-12 col-sm-6 col-lg-4";
        }

        $this->context->smarty->assign(array(
            'additional_fields' => $additional_fields[0],
            'grid_col_class' => $grid_col_class,
            "img_path" => $this->_path."views/img",
        ));
        $this->context->controller->addCSS($this->_path . 'css/additionalinfo.css');
        return $this->display(__FILE__, 'additionalinfoshow.tpl');
    }
}
