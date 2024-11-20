<?php

namespace Civi\Api4\Action\Contact;

use Civi;
use babucat\AEAT\AEAT182;

class SetMoreDonationAtSameCost extends \Civi\Api4\Generic\BasicBatchAction
{

  protected function doTask($item)
  {
    $autonomousDeduction = false;
    if ($cataloniaDeductionPercentage = \Civi::settings()->get('atmod182_catalonia_deduction_percentage')) {
      if ($cataloniaDeductionPercentage != '') {
        $autonomousDeduction = true;
      }
    }

    $spain = \Civi::settings()->get('atmod182_countryField');
    $financialTypes = \Civi::settings()->get('atmod182_financialTypeField');
    
    $donationAmount2024FieldId = \Civi::settings()->get('atmod182_2024TotalField');
    $moreDonationSameCostFieldId = \Civi::settings()->get('atmod182_moreDonationSameCostField');
    $beforeMinDonationDevolutionFieldId = \Civi::settings()->get('atmod182_beforeMinDonationDevolutionField');
    $currentMinDonationDevolutionFieldId = \Civi::settings()->get('atmod182_currentMinDonationDevolutionField');
    $realMaxDonationCostFieldId = \Civi::settings()->get('atmod182_realMaxDonationCostField');

    $donationAmount2024Field = \Civi\Api4\CustomField::get()->addSelect('name', 'custom_group_id:name')->addWhere('id', '=', $donationAmount2024FieldId)->execute();
    $donationAmount2024Field = $donationAmount2024Field[0]['custom_group_id:name'] . '.' . $donationAmount2024Field[0]['name'];
    
    $moreDonationSameCostField = \Civi\Api4\CustomField::get()->addSelect('name', 'custom_group_id:name')->addWhere('id', '=', $moreDonationSameCostFieldId)->execute();
    $moreDonationSameCostField = $moreDonationSameCostField[0]['custom_group_id:name'] . '.' . $moreDonationSameCostField[0]['name'];

    $beforeMinDonationDevolutionField = \Civi\Api4\CustomField::get()->addSelect('name', 'custom_group_id:name')->addWhere('id', '=', $beforeMinDonationDevolutionFieldId)->execute();
    $beforeMinDonationDevolutionField = $beforeMinDonationDevolutionField[0]['custom_group_id:name'] . '.' . $beforeMinDonationDevolutionField[0]['name'];

    $currentMinDonationDevolutionField = \Civi\Api4\CustomField::get()->addSelect('name', 'custom_group_id:name')->addWhere('id', '=', $currentMinDonationDevolutionFieldId)->execute();
    $currentMinDonationDevolutionField = $currentMinDonationDevolutionField[0]['custom_group_id:name'] . '.' . $currentMinDonationDevolutionField[0]['name'];

    $realMaxDonationCostField = \Civi\Api4\CustomField::get()->addSelect('name', 'custom_group_id:name')->addWhere('id', '=', $realMaxDonationCostFieldId)->execute();
    $realMaxDonationCostField = $realMaxDonationCostField[0]['custom_group_id:name'] . '.' . $realMaxDonationCostField[0]['name'];


    foreach ($item as $key => $contact_id) {

      $contactData = \Civi\Api4\Contact::get(TRUE)
        ->addSelect(
          'contact_type',
          'SUM(contribution24.total_amount)',
          'SUM(contribution23.total_amount)',
          'SUM(contribution22.total_amount)',
          'address_primary.postal_code',
          'address_primary.country_id'
        )
        ->addJoin(
          'Contribution AS contribution24',
          'LEFT',
          ['contribution24.receive_date', '>=', "'2024-01-01'"],
          ['contribution24.receive_date', '<=', "'2024-12-31'"],
          ['contribution24.financial_type_id', 'IN', $financialTypes],
          ['contribution24.contribution_status_id', '=', 1]
        )
        ->addJoin(
          'Contribution AS contribution23',
          'LEFT',
          ['contribution23.receive_date', '>=', "'2023-01-01'"],
          ['contribution23.receive_date', '<=', "'2023-12-31'"],
          ['contribution23.financial_type_id', 'IN', $financialTypes],
          ['contribution23.contribution_status_id', '=', 1]
        )
        ->addJoin(
          'Contribution AS contribution22',
          'LEFT',
          ['contribution22.receive_date', '>=', "'2022-01-01'"],
          ['contribution22.receive_date', '<=', "'2022-12-31'"],
          ['contribution22.financial_type_id', 'IN', $financialTypes],
          ['contribution22.contribution_status_id', '=', 1]
        )
        ->addWhere('id', '=', $contact_id)
        ->execute();

      foreach ($contactData as $contact) {

        if ($contact["address_primary.country_id"] != $spain) {
          break; // Only Spanish residents
        }
  
        switch ($contact['contact_type']) {
          case "Individual":
            $contactType = AEAT182::NATURAL_PERSON;
            break;
          case "Organization":
            $contactType = AEAT182::SOCIETIES;
            break;
        }

        $totalAmount24 = $contact['SUM:contribution24.total_amount'];
        if ($totalAmount24 === null) {
          $totalAmount24 = 0;
        }
        $totalAmount23 = $contact['SUM:contribution23.total_amount'];
        if ($totalAmount23 === null) {
          $totalAmount23 = 0;
        }
        $totalAmount22 = $contact['SUM:contribution22.total_amount'];
        if ($totalAmount22 === null) {
          $totalAmount22 = 0;
        }

        $aeat = new AEAT182(autonomousDeduction: $autonomousDeduction);
        $result = $aeat->getDeductionPercentAndDonationsRecurrence(
          $contactType,
          $totalAmount24,
          $totalAmount23,
          $totalAmount22,
          $contact['address_primary.postal_code'],
          FALSE
        );
        
        //print_r(json_encode($result));die;
        
        $donationAmount2024FieldValue = floatval(str_replace(',', '.', str_replace('.', '', $contact['SUM:contribution24.total_amount'])));
        $moreDonationSameCostFieldValue = floatval(str_replace(',', '.', str_replace('.', '', $contact['SUM:contribution24.total_amount']))) +
                                          floatval(str_replace(',', '.', str_replace('.', '', $result['contribution_new_min'])));
        $beforeMinDonationDevolutionFieldValue = floatval(str_replace(',', '.', str_replace('.', '', $result['reduction_min'])));
        $currentMinDonationDevolutionFieldValue = floatval(str_replace(',', '.', str_replace('.', '',  $contact['SUM:contribution24.total_amount']))) +
                                                  floatval(str_replace(',', '.', str_replace('.', '', $result['contribution_new_min']))) -
                                                  floatval(str_replace(',', '.', str_replace('.', '', $result['actual_amount_max'])));
        $realMaxDonationCostFieldValue = floatval(str_replace(',', '.', str_replace('.', '', $result['actual_amount_max'])));

        $results = \Civi\Api4\Contact::update(TRUE)
        ->addValue($donationAmount2024Field, $donationAmount2024FieldValue)
        ->addValue($moreDonationSameCostField, $moreDonationSameCostFieldValue)
        ->addValue($beforeMinDonationDevolutionField, $beforeMinDonationDevolutionFieldValue)
        ->addValue($currentMinDonationDevolutionField, $currentMinDonationDevolutionFieldValue)
        ->addValue($realMaxDonationCostField, $realMaxDonationCostFieldValue)
        ->addWhere('id', '=', $contact_id)
        ->execute();

      }

    }

    return $item;
  }
}
