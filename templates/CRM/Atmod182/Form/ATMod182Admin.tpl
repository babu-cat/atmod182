{crmScope extensionKey='cat.babu.atmod182'}

<div class="help">
  {ts domain="cat.babu.atmod182"}These settings are used to configure ATMod182 CiviCRM Extension. Fill all required fields to ensure the extension functionality.{/ts}
</div>
<div class="crm-block crm-form-block crm-atmod182-form-block">
  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
  <div>
    <h3>{ts domain="cat.babu.atmod182"}Declarant Data{/ts}</h3>
    <table class="form-layout">
      <tr class="crm-atmod182-form-block-atmod182_declarantDenomination">
        <td class="label">
          {$form.atmod182_declarantDenomination.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_declarantDenomination.html}<br />
          <span class="description">{ts domain="cat.babu.atmod182"}Full name of the organization{/ts}</span>
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_natureField">
        <td class="label">
          {$form.atmod182_natureField.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_natureField.html} {help id='atmod182-nature-id'}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_declarantNif">
        <td class="label">
          {$form.atmod182_declarantNif.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_declarantNif.html}<br />
          <span class="description">{ts domain="cat.babu.atmod182"}NIF of the declarant{/ts}</span>
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_personContact">
        <td class="label">
          {$form.atmod182_personContact.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_personContact.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_tel">
        <td class="label">
          {$form.atmod182_tel.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_tel.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_catalonia_deduction_percentage">
        <td class="label">
          {$form.atmod182_catalonia_deduction_percentage.label}
        </td>
        <td>
          {$form.atmod182_catalonia_deduction_percentage.html}
        </td>
      </tr>
    </table>
  </div>

  <div>
    <h3>{ts domain="cat.babu.atmod182"}ATMOD182 Integration{/ts}</h3>
    <table class="form-layout">
      <tr class="crm-atmod182-form-block-atmod182_dniField">
        <td class="label">
          {$form.atmod182_dniField.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_dniField.html} {help id=atmod182-dni-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_cifField">
        <td class="label">
          {$form.atmod182_cifField.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_cifField.html} {help id=atmod182-cif-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_anonymousIndividual">
        <td class="label">
          {$form.atmod182_anonymousIndividual.label}
        </td>
        <td>
          {$form.atmod182_anonymousIndividual.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_financialTypeField">
        <td class="label">
          {$form.atmod182_financialTypeField.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_financialTypeField.html} {help id=atmod182-financialTypeField-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_financialTypeSpeciesField">
        <td class="label">
          {$form.atmod182_financialTypeSpeciesField.label}
        </td>
        <td>
          {$form.atmod182_financialTypeSpeciesField.html} {help id=atmod182-financialTypeSpeciesField-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_countryField">
        <td class="label">
          {$form.atmod182_countryField.label}
          <span class="crm-marker" title="{ts domain="cat.babu.atmod182"}This field is required.{/ts}">*</span>
        </td>
        <td>
          {$form.atmod182_countryField.html} {help id=atmod182-countryField-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_fiscalNameField">
        <td class="label">
          {$form.atmod182_fiscalNameField.label}
        </td>
        <td>
          {$form.atmod182_fiscalNameField.html}<br />
          </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_fiscalLastNameField">
        <td class="label">
          {$form.atmod182_fiscalLastNameField.label}
        </td>
        <td>
          {$form.atmod182_fiscalLastNameField.html}<br />
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_organitationFiscalNameField">
        <td class="label">
          {$form.atmod182_organitationFiscalNameField.label}
        </td>
        <td>
          {$form.atmod182_organitationFiscalNameField.html}<br />
          </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_fiscalRelationshipField">
        <td class="label">
          {$form.atmod182_fiscalRelationshipField.label}
        </td>
        <td>
          {$form.atmod182_fiscalRelationshipField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_declare182">
        <td class="label">
          {$form.atmod182_declare182.label}
        </td>
        <td>
          {$form.atmod182_declare182.html} {help id=atmod182-declare182-id}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_declaredAportation">
        <td class="label">
          {$form.atmod182_declaredAportation.label}
        </td>
        <td>
          {$form.atmod182_declaredAportation.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_locationTypeField">
        <td class="label">
          {$form.atmod182_locationTypeField.label}
        </td>
        <td>
          {$form.atmod182_locationTypeField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_2024TotalField">
        <td class="label">
          {$form.atmod182_2024TotalField.label}
        </td>
        <td>
          {$form.atmod182_2024TotalField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_moreDonationSameCostField">
        <td class="label">
          {$form.atmod182_moreDonationSameCostField.label}
        </td>
        <td>
          {$form.atmod182_moreDonationSameCostField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_beforeMinDonationDevolutionField">
        <td class="label">
          {$form.atmod182_beforeMinDonationDevolutionField.label}
        </td>
        <td>
          {$form.atmod182_beforeMinDonationDevolutionField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_currentMinDonationDevolutionField">
        <td class="label">
          {$form.atmod182_currentMinDonationDevolutionField.label}
        </td>
        <td>
          {$form.atmod182_currentMinDonationDevolutionField.html}
        </td>
      </tr>
      <tr class="crm-atmod182-form-block-atmod182_realMaxDonationCostField">
        <td class="label">
          {$form.atmod182_realMaxDonationCostField.label}
        </td>
        <td>
          {$form.atmod182_realMaxDonationCostField.html}
        </td>
      </tr>

    </table>
  </div>

  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div>

</div>

{/crmScope}
