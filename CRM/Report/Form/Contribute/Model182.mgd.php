<?php
/**
 * @file
 * Provides entity definition for registering the atmod182 report template
 */

return array(
  0 => array(
    'name' => 'ATMod182',
    'entity' => 'ReportTemplate',
    'params' => array(
      'version' => 3,
      'label' => 'ATMod182',
      'description' => 'Form 182 report',
      'class_name' => 'CRM_Report_Form_Contribute_Model182',
      'report_url' => 'contribute/182',
      'component' => 'CiviContribute',
    ),
  ),
);
