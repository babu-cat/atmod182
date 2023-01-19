<?php

require_once 'atmod182.civix.php';

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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function atmod182_civicrm_xmlMenu(&$files) {
  _atmod182_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function atmod182_civicrm_postInstall() {
  _atmod182_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function atmod182_civicrm_uninstall() {
  _atmod182_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function atmod182_civicrm_enable() {
  _atmod182_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function atmod182_civicrm_disable() {
  _atmod182_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function atmod182_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _atmod182_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function atmod182_civicrm_managed(&$entities) {
  _atmod182_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function atmod182_civicrm_caseTypes(&$caseTypes) {
  _atmod182_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function atmod182_civicrm_angularModules(&$angularModules) {
  _atmod182_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function atmod182_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _atmod182_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function atmod182_civicrm_entityTypes(&$entityTypes) {
  _atmod182_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function atmod182_civicrm_preProcess($formName, &$form) {

} // */

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
    $label = ts('Validate 182');
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
