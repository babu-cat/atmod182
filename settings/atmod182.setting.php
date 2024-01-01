<?php
use CRM_Atmod182_ExtensionUtil as E;

// see https://docs.civicrm.org/dev/en/latest/framework/setting/

return array(
  'atmod182_declarantDenomination' => array(
    'name' => 'atmod182_declarantDenomination',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'text',
    'add' => '5.3',
    'title' => E::ts('Denomination'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_natureField' => array(
    'name' => 'atmod182_natureField',
    'quick_form_type' => 'Element',
    'type' => 'Integer',
    'html_type' => 'Select',
    'default' => 3,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getDeclarantNatureOptions',
    ),
    'add' => '5.3',
    'title' => E::ts('Nature'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_declarantNif' => array(
    'name' => 'atmod182_declarantNif',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Text',
    'add' => '5.3',
    'title' => E::ts('NIF'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_personContact' => array(
    'name' => 'atmod182_personContact',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Text',
    'add' => '4.7',
    'title' => E::ts('Contact Person'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_tel' => array(
    'name' => 'atmod182_tel',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Text',
    'add' => '4.7',
    'title' => E::ts('Contact Phone'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_catalonia_deduction_percentage' => array(
    'name' => 'atmod182_catalonia_deduction_percentage',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Text',
    'add' => '5.43.2',
    'title' => E::ts('Deduction Percentage for Catalonia'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
  ),
  'atmod182_dniField' => array(
    'name' => 'atmod182_dniField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '4.7',
    'title' => E::ts('NIF'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getTextCustomFieldsRequired',
    ),
  ),
  'atmod182_cifField' => array(
    'name' => 'atmod182_cifField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '4.7',
    'title' => E::ts('CIF'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getTextCustomFieldsRequired',
    ),
  ),
  'atmod182_financialTypeField' => array(
    'name' => 'atmod182_financialTypeField',
    'quick_form_type' => 'Element',
    'type' => 'Array',
    'html_type' => 'Select',
    'html_attributes'=>array(
      'multiple' => 1,
      'class' => 'crm-select2'
    ),
    'add' => '4.7',
    'title' => E::ts('Financial Type'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getFinancialTypeOptions',
    ),
  ),
  'atmod182_financialTypeSpeciesField' => array(
    'name' => 'atmod182_financialTypeSpeciesField',
    'quick_form_type' => 'Element',
    'type' => 'Array',
    'html_type' => 'Select',
    'html_attributes'=>array(
        'multiple' => 1,
        'class' => 'crm-select2'
    ),
    'add' => '4.7',
    'title' => E::ts('Financial Species Type'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getFinancialTypeOptions',
    ),
  ),
  'atmod182_anonymousIndividual' => array(
    'name' => 'atmod182_AnonymousIndividual',
    'quick_form_type' => 'EntityRef',
    'type' => 'Integer',
    'html_type' => 'entity_reference',
    'html_attributes'=>array(
      'class' => 'crm-select2'
    ),
    'add' => '5.13',
    'title' => E::ts('Anonymous Contact'),
    'is_domain' => 1,
    'is_contact' => 0,
    'help_text' => NULL,
  ),
  'atmod182_fiscalNameField' => array(
    'name' => 'atmod182_fiscalNameField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Fiscal Person Name'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getTextCustomFieldsOptional',
    ),
  ),
  'atmod182_fiscalLastNameField' => array(
    'name' => 'atmod182_fiscalLastNameField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Fiscal Person Last Name'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getTextCustomFieldsOptional',
    ),
  ),
  'atmod182_organitationFiscalNameField' => array(
    'name' => 'atmod182_organitationFiscalNameField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Organization Fiscal Name'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getTextCustomFieldsOptional',
    ),
  ),
  'atmod182_countryField' => array(
    'name' => 'atmod182_countryField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'html_attributes'=>array(
      'class' => 'crm-select2'
    ),
    'add' => '4.7',
    'title' => E::ts('Select Spain'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getCountryOptions',
    ),
  ),
  'atmod182_fiscalRelationshipField' => array(
    'name' => 'atmod182_fiscalRelationshipField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Fiscal Relationship'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getFiscalRelationship',
    ),
  ),
  'atmod182_declare182' => array(
    'name' => 'atmod182_declare182',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Declare 182'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getCheckBoxStringFields',
    ),
  ),
  'atmod182_declaredAportation' => array(
    'name' => 'atmod182_',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Declared Aportation'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getBooleanFields',
    ),
  ),
  'atmod182_locationTypeField' => array(
    'name' => 'atmod182_locationTypeField',
    'quick_form_type' => 'Element',
    'type' => 'String',
    'html_type' => 'Select',
    'add' => '5.3',
    'title' => E::ts('Tax Residence'),
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => NULL,
    'help_text' => NULL,
    'pseudoconstant' => array(
      'callback' => 'CRM_Atmod182_Form_ATMod182Admin::getLocationTypeOptions',
    ),
  ),
);