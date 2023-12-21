<?php

use CRM_Atmod182_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Atmod182_Form_ATMod182Admin extends CRM_Admin_Form_Setting {

  const ADMOD182_PREFERENCES_NAME = 'ATMOD182 Preferences';

  protected $_settings = array(
    'atmod182_declarantDenomination' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_natureField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_declarantNif' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_personContact' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_tel' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_catalonia_deduction_percentage' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_dniField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_cifField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_anonymousIndividual' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_fiscalNameField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_fiscalLastNameField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_organitationFiscalNameField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_fiscalRelationshipField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_financialTypeField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_financialTypeSpeciesField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_countryField' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_declare182' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_declaredAportation' => self::ADMOD182_PREFERENCES_NAME,
    'atmod182_locationTypeField' => self::ADMOD182_PREFERENCES_NAME,
  );

  /**
   * Build the form object.
   */
  public function buildQuickForm() {
    parent::buildQuickForm();

  }

  /**
   * Get the declarant nature options
   *
   * @return array
   */
  public static function getDeclarantNatureOptions() {
    static $nature = NULL;
    if (!$nature) {
      $nature = array('' => ts('- select -')) + array("1" => "1", "2" => "2", "3" => "3", "4" => "4");
    }
    return $nature;
  }

  /**
   * Call the api and returns all posible financial types
   *
   * @return array
   */
  public static function getFinancialTypeOptions() {
    $financialTypes = array();
    $financialType = civicrm_api3('FinancialType', 'get', ['sequential' => 1,]);
    foreach ($financialType['values'] as $values) {
      $financialTypes[$values['id']] = $values['name'];
    }
    return $financialTypes;
  }

  /**
     * Call the api and returns the values of the text custom field
     *
     * @return array
   */
  public static function getNullSelectOption($required = FALSE) {
    if($required == TRUE){
      return array ('' => ts('- select -'));
    }
    else{
      return array ('' => ts('- Undefined -'));
    }
  }

  public static function getTextCustomFields() {
    $customTextFields = civicrm_api3('CustomField', 'get', [
     'sequential' => 1,
     'options' => ['limit' => 0],
     'data_type' => "String",
     'html_type' => "Text",
     'is_active' => 1,
     'is_searchable' => 1,
    ]);
    foreach ($customTextFields['values'] as $values) {
      $customTextFieldsNames[$values['id']] = $values['name'];
    }
    return $customTextFieldsNames;
  }

  public static function getTextCustomFieldsRequired(){
    return CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(TRUE)+CRM_Atmod182_Form_ATMod182Admin::getTextCustomFields();
  }

  public static function getTextCustomFieldsOptional(){
    return CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(FALSE)+CRM_Atmod182_Form_ATMod182Admin::getTextCustomFields();
  }

  /**
    * Call the api and returns all the countries
    *
    * @return array
  */
  public static function getCountryOptions() {
    $countryOptions = CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(TRUE);
    $country = civicrm_api3('Country', 'get', ['sequential' => 1,'options' => ['limit' => 0],]);
    foreach ($country['values'] as $values) {
      $countryOptions[$values['id']] = $values['name'];
    }
    return $countryOptions;
  }

  public static function getFiscalRelationship() {
    $relationshipTypeOptions = CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(FALSE);
    $relationshipType = civicrm_api3('RelationshipType', 'get', [
      'sequential' => 1,
      'options' => ['limit' => 0],
      'return' => ["name_a_b", "name_b_a"],
      'contact_type_a' => "Organization",
      'contact_type_b' => "Organization",
    ]);
    foreach ($relationshipType['values'] as $values) {
      $relationshipTypeOptions[$values['id']] = $values['name_a_b'].'/'.$values['name_b_a'];
    }
    return $relationshipTypeOptions;
  }

  public static function getBooleanFields() {
    $customBooleanFieldsNames = CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(FALSE);
    $customBooleanFields = civicrm_api3('CustomField', 'get', [
      'sequential' => 1,
      'options' => ['limit' => 0],
      'data_type' => "Boolean",
      'is_active' => 1,
      'is_searchable' => 1,
    ]);
    foreach ($customBooleanFields['values'] as $values) {
      $customBooleanFieldsNames[$values['id']] = $values['label'];
    }
    return $customBooleanFieldsNames;
  }

   // @todo Crear una función que busque solo seleccionables de 1 sola opción: getSingleCheckBoxStringFields
   public static function getCheckBoxStringFields() {
     $customStringFieldsNames = CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(FALSE);
     $customStringFields = civicrm_api3('CustomField', 'get', [
       'sequential' => 1,
       'return' => ["name"],
       'is_searchable' => 1,
       'is_active' => 1,
       'data_type' => "String",
       'html_type' => "CheckBox",
       'options' => ['limit' => 0],
     ]);

     foreach ($customStringFields['values'] as $values) {
       $customStringFieldsNames[$values['id']] = $values['name'];
     }
     return $customStringFieldsNames;
   }

   public static function getLocationTypeOptions() {
    $locationTypeOptions = CRM_Atmod182_Form_ATMod182Admin::getNullSelectOption(TRUE);
    $locationType = civicrm_api3('LocationType', 'get', ['sequential' => 1]);
    foreach ($locationType['values'] as $values) {
      $locationTypeOptions[$values['id']] = $values['display_name'];
    }
    return $locationTypeOptions;
  }

}
