<?php

function getTableName($id) {
  $getField = civicrm_api3('CustomField', 'get', [
    'sequential' => 1,
    'id' => $id,
  ]);
  $getGroup = civicrm_api3('CustomGroup', 'get', [
    'sequential' => 1,
    'id' => $getField['values']['0']['custom_group_id'],
  ]);
  return $getGroup['values']['0']['table_name'];
}

function getColumnName($id) {
  $getColumn = civicrm_api3('CustomField', 'get', [
    'sequential' => 1,
    'id' => $id,
  ]);
  return $getColumn['values']['0']['column_name'];
}

function getCustomFieldAlias($id) {
  $result = civicrm_api3('CustomField', 'get', [
      'sequential' => 1,
      'id' => $id,
      'return' => ["column_name", "custom_group_id.table_name"],
  ]);
  $customFieldColumnName = $result['values']['0']['column_name'];
  $customGroupTableName = $result['values']['0']['custom_group_id.table_name'];
  $customGroupTableAlias = str_replace('civicrm_', '', $customGroupTableName);
  return $customGroupTableAlias . '_civireport_' . $customFieldColumnName;
}

/**
 * Función que comprueba si el codigo postal añadido corresponde a España
 *
 * @param string $postalCode
 *
 * @return boolean
 *
 */
function checkPostalCode ($postalCode) {
  if (validaPostal($postalCode) ) {
    $postalCode = intval( mb_substr($postalCode,0,2) );
    if ( $postalCode >= 1 && $postalCode <= 52 ) {
      return true;
    }
    else return false;
  }
  else {
    return false;
  }
}

/**
 * Función que comprueba si hay algun identificador fiscal repetido
 *
 * @param array $idFiscales
 *
 * @return array
 *
 */
function checkIdFiscal ($idFiscales) {
  $checkArray = array_count_values($idFiscales);

  $return = array();
  foreach ($checkArray as $id => $count) {
    if ($count > 1) {
      $return[$id] = $count;
    }
  }
  return $return;
}

/**
 * Función que comprueba si se ha añadido correctamente el codigo postal
 *
 * @param string $cadena
 *
 * @return boolean
 *
 */
function validaPostal ($cadena) {
  // Comprobamos que realmente se ha añadido el formato correcto
  if ( preg_match('/^[0-9]{5}$/i', $cadena) ) {
    // La instruccion se cumple
    return true;
  }
  else {
    // Contiene carácteres no validos
    return false;
  }
}

/**
 * Función que formatea el importe de la forma 0,00 €
 *
 * @param string $amount
 *
 * @return string
 *
 */
function normalizeMoney ($amount) {
  $amount = explode(" ", $amount);
  $amount = CRM_Utils_Money::format($amount[0], 'EUR');
  return $amount;
}

/**
 * Función que suma los importes dados
 *
 * @param string $importe1 Forma: '22,00 (1) €'
 * @param string $importe2 Forma: '22,00 (1) €'
 *
 * @return string
 *
 */
function sumaImportes ($importe1, $importe2) {
  $numberContributions = 0;

  $amount1 = explode(" ", $importe1);
  $amount2 = explode(" ", $importe2);
  $totalAmount = $amount1[0] + $amount2[0];

  $amount1[1] = str_replace(array("(",")"),"",$amount1[1]);
  $amount2[1] = str_replace(array("(",")"),"",$amount2[1]);
  $numberContributions = intval($amount1[1]) + intval($amount2[1]);

  return $totalAmount . " (" . $numberContributions .")";
}
