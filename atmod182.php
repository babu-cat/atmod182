<?php

require_once 'atmod182.civix.php';
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
  require_once $autoload;
}

use CRM_Atmod182_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function atmod182_civicrm_config(&$config) {
  _atmod182_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function atmod182_civicrm_install() {
  _atmod182_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function atmod182_civicrm_enable() {
  _atmod182_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function atmod182_civicrm_navigationMenu(&$menu) {
  _atmod182_civix_insert_navigation_menu($menu, 'Administer/CiviContribute', array(
    'label' => E::ts('ATMod182'),
    'name' => 'ATMod182',
    'url' => 'civicrm/admin/atmod182',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 2,
  ));
  _atmod182_civix_navigationMenu($menu);
}

function atmod182_civicrm_buildForm($formName, &$form) {
  // Adding report buttons to export 182 similar as the [Export To Native Excel](https://civicrm.org/extensions/export-native-excel) extension did

  if ($formName == 'CRM_Report_Form_Contribute_Model182') {
    $form->_182errorButtonName = $form->getButtonName('submit', 'validate182');
    $label = ts('Validate');
    $form->addElement('xbutton', $form->_182errorButtonName, $label,
    [
      'type' => 'submit',
      'class' => "crm-button crm-form-submit crm-button",
    ]);

    $form->_182ButtonName = $form->getButtonName('submit', 'export182');
    $label = ts('Export to 182');
    $form->addElement('xbutton', $form->_182ButtonName, $label,
    [
      'type' => 'submit',
      'class' => "crm-button crm-form-submit crm-button",
    ]);

    $form->_993ButtonName = $form->getButtonName('submit', 'export993');
    $label = ts('Export to 993');
    $form->addElement('xbutton', $form->_993ButtonName, $label,
    [
      'type' => 'submit',
      'class' => "crm-button crm-form-submit crm-button",
    ]);

    // This hook also gets called when we click on a submit button,
    // so we can handle that part here too.
    $buttonName = $form->controller->getButtonName();

    $output = CRM_Utils_Request::retrieve('output', 'String');

    if ( ($form->_182ButtonName == $buttonName || $output == 'export182') ||
         ($form->_182errorButtonName == $buttonName || $output == 'validate182') ||
         ($form->_993ButtonName == $buttonName || $output == 'export993')) {

      if ($form->_182ButtonName == $buttonName || $output == 'export182') {
        $form->_export182Submitted = true;
        $form->setAddPaging(false);
      }

      if ($form->_182errorButtonName == $buttonName || $output == 'validate182') {
        $form->_validate182Submitted = true;
        $form->setAddPaging(false);
      }

      if ($form->_993ButtonName == $buttonName || $output == 'export993') {
        $form->_export993Submitted = true;
        $form->setAddPaging(false);
      }
    }
  }

}
