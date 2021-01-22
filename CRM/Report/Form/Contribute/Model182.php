<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 */
require_once 'CRM/Atmod182/Form/ATMod182Admin.php';
require_once 'CRM/Atmod182/utils.php';

use CRM_Atmod182_ExtensionUtil as E;

class CRM_Report_Form_Contribute_Model182 extends CRM_Report_Form_Contribute_Repeat {
  const PAIS_ESPANYA = 1198;

  protected $_customGroupExtends = array(
    'Contact',
    'Individual',
    'Organization',
  );

  // Global Settings

  protected $_declarantDenomination = array();
  protected $_natureField = array();
  protected $_declarantNIF = array();
  protected $_personContact = array();
  protected $_tel = array();

  // Custom Fields Mapping

  protected $_dniFilesField = 0;
  protected $_dniAlias = '';
  protected $_cifFilesField = 0;
  protected $_CIFAlias = '';
  protected $_anonymousField = 0;
  protected $_fiscalNameField = 0;
  protected $_fiscalNameAlias = '';
  protected $_fiscalLastNameField = 0;
  protected $_fiscalLastNameAlias = '';
  protected $_organitationFiscalNameField = 0;
  protected $_organizationFiscalNameAlias = '';
  protected $_fiscalRelationshipField = '';
  protected $_financialTypesField = 0;
  protected $_financialTypesSpeciesField = 0;
  protected $_countryField = 0;
  protected $_declaredAportationField = 0;
  protected $_declareField = 0;

  protected $_configErrors = array();
  protected $_integrityErrors = array();
  protected $_warningErrors = array();

  public $_validate182Submitted = false;
  public $_export182Submitted = false;

  /**
   * Class constructor.
   */
  public function __construct() {
    parent::__construct();

    if ( !$this->_declarantDenomination = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declarantDenomination')) {
      $this->_configErrors[] = E::ts('Denomination not defined');
    }
    if ( !$this->_natureField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_natureField')) {
      $this->_configErrors[] = E::ts('Nature not defined');
    }
    if ( !$this->_declarantNIF = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declarantNif')) {
      $this->_configErrors[] = E::ts('NIF not defined');
    }
    if ( !$this->_personContact = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_personContact')) {
      $this->_configErrors[] = E::ts('Contact Person not defined');
    }
    if ( !$this->_tel = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_tel')) {
      $this->_configErrors[] = E::ts('Contact Phone not defined');
    }
    if ( !$this->_dniFilesField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_dniField')) {
      $this->_configErrors[] = E::ts('DNI not defined');
    }
    else {
      $this->_dniAlias = getCustomFieldAlias($this->_dniFilesField);
    }
    if ( !$this->_cifFilesField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_cifField')) {
      $this->_configErrors[] = E::ts('CIF not defined');
    }
    else {
      $this->_CIFAlias = getCustomFieldAlias($this->_cifFilesField);
    }

    if ($this->_anonymousField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_anonymousIndividual')) {
      $this->assign('anonymousConfigured', 1);
    }

    if ( !$this->_financialTypesField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_financialTypeField')) {
      $this->_configErrors[] = E::ts('Financial Types not defined');
    }
    if ( !$this->_countryField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_countryField')) {
      $this->_configErrors[] = E::ts('Country not defined');
    }
    $this->_financialTypesSpeciesField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_financialTypeSpeciesField');
    if ( $this->_fiscalNameField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_fiscalNameField') ) {
      $this->_fiscalNameAlias = getCustomFieldAlias($this->_fiscalNameField);
    }
    if ( $this->_fiscalLastNameField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_fiscalLastNameField') ) {
      $this->_fiscalLastNameAlias = getCustomFieldAlias($this->_fiscalLastNameField);
    }
    if ( $this->_organitationFiscalNameField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_organitationFiscalNameField') ) {
      $this->_organizationFiscalNameAlias = getCustomFieldAlias($this->_organitationFiscalNameField);
    }
    $this->_fiscalRelationshipField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_fiscalRelationshipField');
    $this->_declaredAportationField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declaredAportationField');
    if ($this->_declareField = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declare182') ){
      $this->assign('declareConfigured', 1);
    }

    $this->_columns['civicrm_address']['fields']['postal_code']['required'] = TRUE;
    $this->_columns['civicrm_contact']['fields']['sort_name']['required'] = TRUE;
    $this->_columns['civicrm_contact']['fields']['contact_type']['required'] = TRUE;
    $this->_columns['civicrm_contact']['fields']['exposed_id']['required'] = TRUE;
    $this->_columns['civicrm_contact']['fields']['id']['no_display'] = FALSE;

    if (is_numeric($this->_dniFilesField)) {
      $this->_columns[getTableName($this->_dniFilesField)]['fields']['custom_'.$this->_dniFilesField ]['required'] = TRUE;
    }
    if (is_numeric($this->_cifFilesField)) {
      $this->_columns[getTableName($this->_cifFilesField)]['fields']['custom_'.$this->_cifFilesField ]['required'] = TRUE;
    }
    if ($this->_fiscalNameField) {
      $this->_columns[getTableName($this->_fiscalNameField)]['fields']['custom_'.$this->_fiscalNameField ]['required'] = TRUE;
    }
    if ($this->_fiscalLastNameField) {
      $this->_columns[getTableName($this->_fiscalLastNameField)]['fields']['custom_'.$this->_fiscalLastNameField ]['required'] = TRUE;
    }
    if ($this->_organitationFiscalNameField) {
      $this->_columns[getTableName($this->_organitationFiscalNameField)]['fields']['custom_'.$this->_organitationFiscalNameField ]['required'] = TRUE;
    }
    $this->_columns['civicrm_contribution']['filters']['total_amount1']['default_op'] = 'nnll';
    $this->_columns['civicrm_contribution']['filters']['financial_type_id']['default'] = $this->_financialTypesField;
    $this->_columns['civicrm_contribution']['filters']['receive_date2']['default'] = 'previous_before.year';
    $this->_columns['civicrm_address']['filters']['country_id']['default'] = self::PAIS_ESPANYA;
    // Declaration Data

    $this->assign('declarantDenomination', $this->_declarantDenomination);
    $this->assign('declarantNature', $this->_natureField);
    $this->assign('declarantCIF', $this->_declarantNIF);
    $this->assign('declarantContactPerson', $this->_personContact);
    $this->assign('declarantContactTel', $this->_tel);

    $this->assign("configErrors", $this->_configErrors);

    $this->assign('filterDate', $this->_columns['civicrm_contribution']['filters']['receive_date1']['default']);

  }

  /**
   * @param string $replaceAliasWith
   *
   * @return mixed|string
   */
  public function fromContribution($replaceAliasWith = 'contribution1') {
    $from = parent::fromContribution($replaceAliasWith);
    if ($this->_declareField) {
      $table_declare182 = getTableName($this->_declareField);
      $column_declare182 = getColumnName($this->_declareField);
      if ($replaceAliasWith == 'contribution1') {
        $from .= "LEFT JOIN $table_declare182 contribution1_declare
                    ON contribution1.id = contribution1_declare.entity_id AND
                       contribution1_declare.$column_declare182 <> '' ";
      }
    }
    return $from;
  }

  /**
   * @param string $replaceAliasWith
   *
   * @return mixed|string
   */
  public function whereContribution($replaceAliasWith = 'contribution1') {
    $whereClause = parent::whereContribution($replaceAliasWith);
    if ($this->_declareField) {
      if ($replaceAliasWith == 'contribution1') {
        $whereClause .= " AND contribution1_declare.entity_id IS NULL";
      }
    }
    return $whereClause;
  }

  public function where() {
    parent::where();
    $clauses = array();
    $clauses[] = "( contact_civireport.contact_type IN ( 'Organization' ) AND " . $this->_aliases[getTableName($this->_cifFilesField)] . "." . getColumnName($this->_cifFilesField) . " IS NOT NULL )";
    $clauses[] = "( contact_civireport.contact_type IN ( 'Individual' ) AND ". $this->_aliases[getTableName($this->_dniFilesField)] . "." . getColumnName($this->_dniFilesField) . " IS NOT NULL )";
    $this->_where .= !empty($clauses) ? " AND ( " . implode(' OR ', $clauses) . " )" : '';
  }

  /**
   * @param array $fields
   * @param array $files
   * @param CRM_Core_Form $self
   *
   * @return array
   */
  public static function formRule($fields, $files, $self) {
    $errors = parent::formRule($fields, $files, $self);
    // Sin esta línea no deja crear el informe
    unset($errors['fields']);
    return $errors;
  }

 /**
   * @param $rows
   *
   * @return array
   */
  public function statistics(&$rows) {
    // @todo ver que hacer con las estadísticas, si las podemos aprovechar o no
    $statistics = parent::statistics($rows);

    $statistics['no_taxable_nif_donors'] = 0;
    $statistics['no_taxable_nif_donation_amount'] = 0;

    $statistics['total_donors'] = 0;
    $statistics['total_donations_amount'] = 0;
    $statistics['total_donations_count'] = 0;

    $statistics['taxable_donors'] = 0;
    $statistics['taxable_donation_amount'] = 0;
    $statistics['taxable_donation_count'] = 0;

    if ($this->_anonymousField != 0) {
      $statistics['anonymous_donations_amount'] = 0;
      $statistics['anonymous_donations_count'] = 0;
    }

    $previousYear = date("Y") - 1;
    $startPreviousYear = '01-01-' . $previousYear;
    $endPreviousYear = '31-12-' . $previousYear;
    $contacts_no_declarant = array();

    if ($this->_declareField) {

      $statistics['no_taxable_no_declare_donation_count'] = 0;
      $statistics['no_taxable_no_declare_donation_amount'] = 0;
      $statistics['no_taxable_no_declare_donors'] = 0;

      //@todo Se deberia añadir en la API que el País fuera Espanya
      $idContributionNoDeclare = civicrm_api3('Contribution', 'get', [
        'sequential' => 1,
        'return' => ["total_amount"],
        'custom_'.$this->_declareField => 1,
        'receive_date' => ['BETWEEN' => ['' . $startPreviousYear . '', '' . $endPreviousYear . '']],
        'financial_type_id' => $this->_financialTypesField,
        'contribution_status_id' => "Completed",
        'options' => ['limit' => 0],
      ]);

      foreach ($idContributionNoDeclare['values'] as $row => $value ) {
        array_push($contacts_no_declarant, $value['contact_id']);
        $statistics['no_taxable_no_declare_donation_count']++;
        $statistics['no_taxable_no_declare_donation_amount'] += $value['total_amount'];
      }

      $statistics['no_taxable_no_declare_donors'] = count(array_unique($contacts_no_declarant));

    }

    $sql = "{$this->_select} {$this->_from} {$this->_where}";
    $dao = $this->executeReportQuery($sql);

    $dniAlias = $this->_dniAlias;
    $CIFAlias = $this->_CIFAlias;

    while ($dao->fetch()) {
      // Contactos sin NIF o CIF
      if ( (empty($dao->$CIFAlias) && $dao->contact_civireport_contact_type == "Organization")
        || (empty($dao->$dniAlias) && $dao->contact_civireport_contact_type == "Individual") ) {
        if ( $dao->contact_civireport_id == $this->_anonymousField ) {
          $statistics['anonymous_donations_amount'] += $dao->contribution1_total_amount_sum;
          $statistics['anonymous_donations_count'] += $dao->contribution1_total_amount_count;
        }
        else {
          $statistics['no_taxable_nif_donors']++;
          $statistics['no_taxable_nif_donation_amount'] += $dao->contribution1_total_amount_sum;
        }
      }
      else {
        $statistics['taxable_donors']++;
        $statistics['taxable_donation_amount'] += $dao->contribution1_total_amount_sum;
        $statistics['taxable_donation_count'] += $dao->contribution1_total_amount_count;
      }
      $statistics['total_donors']++;
      $statistics['total_donations_amount'] += $dao->contribution1_total_amount_sum;
      $statistics['total_donations_count'] += $dao->contribution1_total_amount_count;
    }

    return $statistics;
  }

  /**
   * Alter display of rows.
   *
   * Iterate through the rows retrieved via SQL and make changes for display purposes,
   * such as rendering contacts as links.
   *
   * @param array $rows
   *   Rows generated by SQL, with an array for each row.
   */
  public function alterDisplay(&$rows) {

    parent::alterDisplay($rows);

    require_once 'includes/nif-nie-cif.php';

    $llista = array();

    // Eliminamos registros sin CIF NIF
    foreach ( $rows as $rowNum => $row ) {
      $nif_cif = ($row['contact_civireport_contact_type'] == 'Individual') ? $this->_dniAlias : $this->_CIFAlias;

      // si el contacto no tiene nif o cif, no se incluye en el informe
      if ( empty($row[$nif_cif]) ) {
        // @todo Esto no se podría definir como filtro?
        unset($rows[$rowNum]);
      }
      else {
        $llista[$row['contact_civireport_id']] = 1;
      }
    }

    $twoYearBefore = date("Y", strtotime("-3 year"));

    $this->_columnHeaders += array('contribution1_total_amount' => array('title' => "January 1st, " . date("Y", strtotime("-1 year")) . " - December 31st, " . date("Y", strtotime("-1 year")), 'type' => 1));
    $this->_columnHeaders += array('contribution2_total_amount' => array('title' => "January 1st, " . date("Y", strtotime("-2 year")) . " - December 31st, " . date("Y", strtotime("-2 year")), 'type' => 1));
    $this->_columnHeaders += array('contribution3_total_amount' => array('title' => "January 1st, $twoYearBefore - December 31st, $twoYearBefore", 'type' => 1));

    $contribucions3 = array();
    if ( !empty($llista) ) {
      // llama a la api que retorna las contribuciones de hace 2 años de los contactos anteriormente introducidos en el array
      $result = civicrm_api3('Contribution', 'get', array(
        'sequential' => 1,
        'return' => array('total_amount'),
        'contact_id' => array('IN' => array_keys($llista)),
        'receive_date' => array('BETWEEN' => array($twoYearBefore . '/01/01', $twoYearBefore . '/12/31')),
        'financial_type_id' => array('IN' => $this->_financialTypesField),
        'contribution_status_id'=> 'Completed',
        'options' => array('limit' => 0),
      ));

      // agrupa todas las contribuciones de un mismo contacto
      foreach ($result['values'] as $rowNum => $value) {
        if ( isset($contribucions3[$value['contact_id']]) ) {
          $contribucions3[$value['contact_id']] += $value['total_amount'];
        }
        else {
          $contribucions3[$value['contact_id']] = $value['total_amount'];
        }
      }
    }

    $this->_columnHeaders += array('civicrm_contact_identificador_fiscal' => array('title' => 'Identificador fiscal', 'type' => 2));
    $this->_columnHeaders += array('civicrm_contact_percentatge_deduccio' => array('title' => 'Porcentaje deducción', 'type' => 2));
    $this->_columnHeaders += array('civicrm_contact_id_seu_fiscal' => array('title' => 'Identificador sede fiscal', 'type' => 2));
    $this->_columnHeaders += array('civicrm_contact_clave' => array('title' => 'Clave', 'type' => 1));
    $this->_columnHeaders += array('civicrm_recurrencia_donatius' => array('title' => 'Recurrencia de Donativos', 'type' => 1));

    foreach ( $rows as $rowNum => $row ) {
      // si el contacto existe en el array, se le asigna su contribución de hace 2 años
      if ( array_key_exists($row['contact_civireport_id'], $contribucions3)) {
        $rows[$rowNum]['contribution3_total_amount'] = $contribucions3[$row['contact_civireport_id']];
      }
      else {
        $rows[$rowNum]['contribution3_total_amount'] = 0;
      }

      $fiscalId = ($row['contact_civireport_contact_type'] == 'Individual') ? $row[$this->_dniAlias] : $row[$this->_CIFAlias];
      $rows[$rowNum]['civicrm_contact_identificador_fiscal'] = strtoupper($fiscalId);

      // No haría falta una vez ya validado en el momento de exportar
      // @todo mover dentro de la librería AEAT182 y comprobar sólo al validar 182
      if ( $row['contact_civireport_contact_type'] == 'Individual' && ( !isValidNIF($fiscalId) && !isValidNIE($fiscalId) )){
        $this->_integrityErrors[] = "El NIF/NIE " . $fiscalId . " del contacto con identificador <a href='/civicrm/contact/view?reset=1&cid=" . $row['contact_civireport_id'] . "'>" . $row['contact_civireport_id'] . "</a> no es válido.";
      }
      elseif ( $row['contact_civireport_contact_type'] == 'Organization' && !isValidCIF($fiscalId) ){
        $this->_integrityErrors[] = "El CIF " . $fiscalId . " del contacto con identificador <a href='/civicrm/contact/view?reset=1&cid=" . $row['contact_civireport_id'] . "'>" . $row['contact_civireport_id'] . "</a> no es válido.";
      }

      // @todo mover dentro de la librería AEAT182 y comprobar sólo al validar 182
      if ( !checkPostalCode($row['address_civireport_postal_code']) ) {
        $this->_integrityErrors[] = "El Codigo Postal del contacto con identificador <a href='/civicrm/contact/view?reset=1&cid=" . $row['contact_civireport_id'] . "'>" . $row['contact_civireport_id'] . "</a> no es correcto.";
      }

      if ($this->_fiscalRelationshipField != '' ) {
        if ( $row['contact_civireport_contact_type'] == 'Organization' ) {
          $rows[$rowNum]['civicrm_contact_id_seu_fiscal'] = $this->getTaxBase( $row['contact_civireport_id'] );
        }
      }
    }

    // @todo tratamiento sin sedes fiscales (separar en un array, a poder ser ya agrupados, las sedes fiscales para tratarlas a posteriori)
    $seus_fiscals = array();
    foreach ($rows as $key => $row) {
      if (!empty($row['civicrm_contact_id_seu_fiscal'])) {
        // @todo a ver si lo podemos hacer de otro modo
        $row['key'] = $key;
        if ($row['civicrm_contact_id_seu_fiscal'] == $row['contact_civireport_id']) {
          $seus_fiscals[$row['civicrm_contact_id_seu_fiscal']]['seu_fiscal'] = $row;
        }
        else {
          $seus_fiscals[$row['civicrm_contact_id_seu_fiscal']]['filial'][] = $row;
        }
      }
    }

    // @todo tratamiento de las sedes fiscales (sobre el array separado en el paso anterior)
    // @todo priorizar la sede fiscal al cif. Es decir, agrupar por relaciones aunque tengan diferente CIF incluso si no lo tienen

    // 1. si la sede ya está en el listado hacer el calculo de todas sus filiales y añadirla como declarante
    $filialSenseSeu = 0;
    foreach ($seus_fiscals as $id_seu => $row) {
      if ( isset($row['seu_fiscal']) ) {
        foreach ( $row['filial'] as $key => $filial) {
          $rows[$seus_fiscals[$id_seu]['seu_fiscal']['key']]['contribution1_total_amount_sum'] = sumaImportes($rows[$seus_fiscals[$id_seu]['seu_fiscal']['key']]['contribution1_total_amount_sum'], $filial['contribution1_total_amount_sum']);
          $rows[$seus_fiscals[$id_seu]['seu_fiscal']['key']]['contribution2_total_amount_sum'] = sumaImportes($rows[$seus_fiscals[$id_seu]['seu_fiscal']['key']]['contribution2_total_amount_sum'], $filial['contribution2_total_amount_sum']);
          $rows[$seus_fiscals[$id_seu]['seu_fiscal']['key']]['contribution3_total_amount']     += $filial['contribution3_total_amount'];
          unset($rows[$filial['key']]);
        }
      } else {
        // 2. si la sede no está en el listado la tenemos que consultar via api y añadirla al modelo como declarante haciendo el cálculo de todas sus filiales
        $filialSenseSeu++;
      }
    }

    if ($filialSenseSeu > 0) {
      $this->_integrityErrors[] = "Hay " . $filialSenseSeu . " filiales que se declaran que no son sedes fiscales.";
    }

    $columnNameFiscalName = $this->_fiscalNameAlias;
    $columnNameFiscalLastName = $this->_fiscalLastNameAlias;
    $columnNameOrganitationFiscalName = $this->_organizationFiscalNameAlias;

    $idFiscales = array();

    foreach ( $rows as $rowNum => $row ) {
      // sustituye carácteres que no le gustan a hacienda por sus homonimos correctos
      // http://www.boe.es/buscar/doc.php?id=BOE-A-2015-11596 -> 184
      // http://www.boe.es/buscar/doc.php?id=BOE-A-2013-13798 -> 182

      if ( $row['contact_civireport_contact_type'] == 'Individual' && ($this->_fiscalLastNameField != '' || $this->_fiscalNameField != '' )) {
        if ( !empty( $row[$columnNameFiscalName] )) {
          $rows[$rowNum]['contact_civireport_sort_name'] = $row[$columnNameFiscalLastName] . " " . $row[$columnNameFiscalName];
        }
      }
      elseif ($row['contact_civireport_contact_type'] == 'Organization' && $this->_organitationFiscalNameField !='' ) {
        if ( !empty( $row[$columnNameOrganitationFiscalName] ) ){
          $rows[$rowNum]['contact_civireport_sort_name'] = $row[$columnNameOrganitationFiscalName];
        }
      }

      // encuentra la deducción y la recurrencia para cada contacto

      // Los importes del año de la declaración y del anterior tienen entre paréntesis el número de aportaciones realizadas,
      // hay que quitarlos para poderlos tratar correctamente
      list($cleanThisYearAmount) = explode(' ', $row['contribution1_total_amount_sum']);
      list($cleanLastYearAmount) = explode(' ', $row['contribution2_total_amount_sum']);

      require_once 'includes/AEAT182.php';

      $contactType = NULL;
      if ($row['contact_civireport_contact_type'] == "Individual") {
        $contactType = AEAT182::NATURAL_PERSON;
      }
      else if ($row['contact_civireport_contact_type'] == "Organization") {
        $contactType = AEAT182::SOCIETIES;
      }
      else {
        // No deberia de entrar aqui
      }

      $result = AEAT182::getDeductionPercentAndDonationsRecurrence(
        $contactType,
        $cleanThisYearAmount,
        $cleanLastYearAmount,
        $row['contribution3_total_amount']
      );
      $rows[$rowNum]['civicrm_contact_clave'] = "A";
      $rows[$rowNum]['civicrm_contact_percentatge_deduccio'] = $result['percentage'];
      $rows[$rowNum]['civicrm_recurrencia_donatius'] = $result['recurrence'];

      $rows[$rowNum]['contribution1_total_amount'] = normalizeMoney($row['contribution1_total_amount_sum']);
      $rows[$rowNum]['contribution2_total_amount'] = normalizeMoney($row['contribution2_total_amount_sum']);
      $rows[$rowNum]['contribution3_total_amount'] = normalizeMoney($row['contribution3_total_amount']);

      array_push($idFiscales, $rows[$rowNum]['civicrm_contact_identificador_fiscal']);
    }

    // @todo mover dentro de la librería AEAT182 y comprobar sólo al validar 182
    $idFiscalDuplicado = checkIdFiscal($idFiscales);
    if ( !empty($idFiscalDuplicado) ) {
      foreach ($idFiscalDuplicado as $id => $count) {
        $this->_warningErrors[] = "Hay " . $count . " ocurrencias en el identificador fiscal " . $id . ". Revisa los registros antes de presentar el Modelo.";
      }
    }

    // elimina las columnas cif y nif ya que ya estan en la columna de identificador fiscal
    unset($this->_columnHeaders[$this->_dniAlias]);
    unset($this->_columnHeaders[$this->_CIFAlias]);
    // elimina las columnes name, last name y organization ya que ya estan en la columna del nombre
    unset($this->_columnHeaders[$columnNameFiscalName]);
    unset($this->_columnHeaders[$columnNameFiscalLastName]);
    unset($this->_columnHeaders[$columnNameOrganitationFiscalName]);

  }

  /**
   * End post processing.
   *
   * @param array|null $rows
   */
  public function endPostProcess(&$rows = NULL) {
    parent::endPostProcess($rows);

    if ($this->_export182Submitted || $this->_validate182Submitted) {
      require_once 'includes/AEAT182.php';

      $model = new AEAT182();

      $declarant = array(
        "exercise" => date("Y", strtotime("-1 year")),
        "NIFDeclarant" => CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declarantNif'),
        "declarantName" => CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_declarantDenomination'),
        "supportType" => "T",
        "contactPerson" => CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_tel') . CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_personContact'),
        "declarationID" => "182",
        "lastIdDeclaration" => "0000000000000",
        "nature" => CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_natureField'),
      );

      $model->setDeclarant($declarant);

      foreach ($rows as $row) {
        $paramsDeclared = $this->normalizeDeclared($row, $declarant);
        $model->addDeclared($paramsDeclared);
      }

      if ($this->_validate182Submitted) {
        $this->assign('validate182', 1);
        $output = $model->check182();
        $errors = array();
        foreach ($output[1] as $cid => $error) {
            $errors[$error[0][0]][] = array($cid, $error[0][1]);
        }
        $this->assign('errors', $output[1]);
        $warnings = array();
        foreach ($output[0] as $cid => $warning) {
          $warnings[$warning[0][0]][] = array($cid, $warning[0][1]);
        }
        $this->assign('warnings', $warnings);
        if (empty($output[1])) {
          $this->assign('noerrors', 1);
        }
        // Quitamos los resultados para que sólo se visualizen los avisos y errores
        $this->assign('rows', NULL);
      }

      if ($this->_export182Submitted) {
        $model->saveFile();
      }
    }
  }

  public function postProcess() {
    parent::postProcess();

    // Revisa i avisa si hay donativos en especie este pasado año

    if ($this->_submitValues && $this->_financialTypesSpeciesField) {
      $filterDate = $this->_submitValues['receive_date1_relative'];
      if ($filterDate == 'previous.year') {
        $previousYear = date("Y") - 1;
        $startPreviousYear = '01-01-' . $previousYear;
        $endPreviousYear = '31-12-' . $previousYear;
        if ( count($this->_financialTypesSpeciesField) > 0 ) {
          $result = civicrm_api3('Contribution', 'getcount', [
            'financial_type_id' => $this->_financialTypesSpeciesField,
            'receive_date' => ['BETWEEN' => ['' . $startPreviousYear . '', '' . $endPreviousYear . '']],
            'contribution_status_id' => "Completed",
          ]);
          $this->assign('species', $result);
        }
        $this->assign('previousYear', $previousYear);
        $this->assign('integrityErrors', $this->_integrityErrors);
        $this->assign('warningErrors', $this->_warningErrors);
      }
    }

  }

  /**
   * Get the tax base organization of an organization
   *
   * @param int $id Id of the organization
   *
   * @return int Id of the tax base organization of the organization (if exists)
   */
  function getTaxBase($id) {
    // Check if exist a tax base organization
    $result = civicrm_api3('Relationship', 'get', [
      'sequential' => 1,
      'return' => ["contact_id_a"],
      'relationship_type_id' => $this->_fiscalRelationshipField,
      'contact_id_b' => $id,
    ]);
    if ( ($result['is_error'] == 0) && ($result['count'] > 0) ) {
      return $result['values'][0]['contact_id_a'];
    }
    else {
      // Check if tax base organization is itself
      $result = civicrm_api3('Relationship', 'get', [
        'sequential' => 1,
        'return' => ["contact_id_a"],
        'relationship_type_id' => $this->_fiscalRelationshipField,
        'contact_id_a' => $id,
      ]);
      if ( ($result['is_error'] == 0) && ($result['count'] > 0) ) {
        return $result['values'][0]['contact_id_a'];
      }
      else {
        // There is no tax base organization
        return NULL;
      }
    }
  }

  /**
   * Get the tax base organization of an organization
   *
   * @param array $row the declared values
   * @param array $declarant array with the declarant values
   *
   * @return array with the declared params set
   */
  function normalizeDeclared($row, $declarant) {
    $nifID = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_dniField');
    $cifID = CRM_Core_BAO_Setting::getItem(CRM_Atmod182_Form_ATMod182Admin::ADMOD182_PREFERENCES_NAME, 'atmod182_cifField');
    $nifcif = ($row['contact_civireport_contact_type'] == 'Individual') ? $row[getCustomFieldAlias($nifID)] : $row[getCustomFieldAlias($cifID)];
    $nature = ($row['contact_civireport_contact_type'] == 'Individual') ? 'F' : 'J';
    $declared = array(
      "exercise" => $declarant['exercise'],
      "NIFDeclarant" => $declarant['NIFDeclarant'],
      "externalId" => $row['contact_civireport_id'],
      "NIFDeclared" => $nifcif,
      "declaredName" => $row['contact_civireport_sort_name'],
      "provinceCode" => substr( $row['address_civireport_postal_code'], 0, 2 ),
      "key" => $row['civicrm_contact_clave'],
      "deduction" => $row['civicrm_contact_percentatge_deduccio'],
      "donationImport" => $row['contribution1_total_amount_sum'],
      "recurrenceDonations" => $row['civicrm_recurrencia_donatius'],
      "nature" => $nature
    );
    return $declared;
  }

}
