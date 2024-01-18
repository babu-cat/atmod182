{*
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
*}

{if count($configErrors) > 0}
  <div class="messages error no-popup">
    <h2>El módulo ATMod182 no se ha configurado correctamente. Por favor revise la <a href="/civicrm/admin/atmod182">configuración</a>.</h2>
    <p><strong>Errores encontrados:</strong></p>
    <ul>
    {foreach from=$configErrors item=configError_id}
      <li>
        <span>{$configError_id}</span>
      </li>
    {/foreach}
    </ul>
  </div>
{else}
  <table class="crm-info-panel" width=50%>
    <tr class="columnheader-dark">
      <th colspan=2>{ts domain="cat.babu.atmod182"}Datos del declarante{/ts}</th>
    </tr>
    <tr>
      <th>{ts domain="cat.babu.atmod182"}Denominación{/ts}</th>
      <td><strong>{$declarantDenomination}</strong></td>
    </tr>
    <tr>
      <th>{ts domain="cat.babu.atmod182"}Naturaleza{/ts}</th>
      <td><strong>{$declarantNature}</strong></td>
    </tr>
    <tr>
      <th>{ts domain="cat.babu.atmod182"}NIF del declarante{/ts}</th>
      <td><strong>{$declarantCIF}</strong></td>
    </tr>
    <tr>
      <th>{ts domain="cat.babu.atmod182"}Nombre y apellidos de la persona con quien relacionarse{/ts}</th>
      <td><strong>{$declarantContactPerson}</strong></td>
    </tr>
    <tr>
      <th>{ts domain="cat.babu.atmod182"}Teléfono de la persona con quien relacionarse{/ts}</th>
      <td><strong>{$declarantContactTel}</strong></td>
    </tr>
  </table>
  <p><small><i>* {ts domain="cat.babu.atmod182"}Los datos reflejados del declarante serán los que se añadirán en la generación del fichero a presentar a hacienda. Si hay algún error contacte con el administrador del sitio para que lo corrija.{/ts}</i></small></p>

  {if $noerrors == 1}
  <table class="crm-info-panel" width=50%>
    <tr class="columnheader-dark">
      <th  style="background-color: #4d90eb" colspan=2>{ts domain="cat.babu.atmod182"}Resumen de los datos incluidos en la declaración{/ts}</th>
    </tr>
    <tr>
      <th width=30% >{ts domain="cat.babu.atmod182"}Número total de declarados{/ts}</th>
      <td style="font-weight:bold;text-align: center;background-color: #c8dfff;font-size: 2em;padding: 1em;"></td>
    </tr>
    <tr>
      <th width=30%>{ts domain="cat.babu.atmod182"}Importe total a declarar{/ts}</th>
      <td style="font-weight:bold;text-align: center;background-color: #c8dfff;font-size: 2em;padding: 1em;";></td>
    </tr>
  </table>
  {/if}

  {if $cataloniaDeductionPercentage}
    <div class="messages warning no-popup">
      Se ha configurado un <strong>porcentaje de deducción para las personas físicas residentes en Catalunya del {$cataloniaDeductionPercentage}%</strong>. Comprueba que tu entidad está dada de alta en el <a href="https://llengua.gencat.cat/ca/serveis/entitats/cens-entitats">Censo de entidades de fomento de la lengua catalana</a>. En caso contrario es necesario cambiar la <a href="/civicrm/admin/atmod182">configuración del módulo 182</a>. Si no sabes cómo o no tienes permisos, contacta con el administrador del sitio.
      {if $enable_993 == 0}
        <p style='margin-bottom:0em'>Para generar el <strong>modelo 993</strong>, antes deben de aplicarse los siguientes filtros:
          <ul>
            <li>Tipo de contacto: <strong>{ts}Individual{/ts}</strong></li>
            <li>Estado/provincia: <strong>Barcelona, Girona, Lleida y Tarragona</strong></li>
          </ul>
        </p>
      {/if}
    </div>


  {/if}

  {if $filterDate == 'previous.year'}
	  {if $species > 0}
	    <div class="messages error no-popup">
		  <fieldset><legend>{ts domain="cat.babu.atmod182"}Aportaciones en especies{/ts}</legend>
		  {if $species == 1}
  			<strong>{ts domain="cat.babu.atmod182"}Atención!{/ts}</strong> Hay {$species} contacto con un donativo en especie durante el año {$previousYear}.
	  	{else}
		  	<strong>{ts domain="cat.babu.atmod182"}Atención!{/ts}</strong> Hay {$species} contactos con, por lo menos, un donativo en especie durante el año {$previousYear}.
		  {/if}
		  Estos donativos se tienen que presentar a Hacienda manualmente y también gestionar su certificado fiscal a parte.
		  </fieldset>
	  </div>
	  {/if}
  {else}
	  <div class="messages error no-popup">
		  <strong>Atención!</strong> No se ha seleccionado 'Año anterior' como filtro del primer rango de fechas.
	  </div>
  {/if}
  {if $warningErrors && count($warningErrors) > 0}
  	<div class="messages warning no-popup">
  	  {foreach from=$warningErrors item=warning}
  	   	<li>
          <span>{$warning}</span>
        </li>
      {/foreach}
  	</div>
  {/if}
  {if (($errors && count($errors) > 0)) || ($integrityErrors && (count($integrityErrors) > 0))}
    <div id="errors">
      <div class="messages error no-popup">
        <h3 class="nobackground">
          <i class="crm-i fa-exclamation-triangle"></i>
          <strong>{ts domain="cat.babu.atmod182"}Atención! Se han detectado errores que deben ser corregidos antes de poder exportar el fichero 182{/ts}</strong>
        </h3>
        <hr>
        <strong>{ts domain="cat.babu.atmod182"}{/ts}</strong>
        <ul>
          {foreach from=$errors item=error key=key}
            {if count($error) > 0}
              <li>
                {if is_numeric($key)}
                  {crmAPI var='result' entity='Contact' action='get' return="display_name" id=$key}
    			  		  {foreach from=$result.values item=contact}
      			  	  	{$contact.some_field}
    				    	{/foreach}
                  <p> El contacto: <a href="/civicrm/contact/view?reset=1&cid={$key}">{$result.values.0.display_name}</a>, tiene estos errores:</p>
                {else}
                  <p> Los datos del <a href="/civicrm/admin/atmod182">declarante</a>, tiene estos errores:</p>
                {/if}
                {foreach from=$error item=error_id}
                  <ul>
                    <li>
                      <p class="messages status crm-error no-popup"> {$error_id.1} </p>
                    </li>
                  </ul>
                {/foreach}
              </li>
            {/if}
          {/foreach}
          {if count($integrityErrors) > 0}
            {foreach from=$integrityErrors item=warning}
              <li>
                <span>{$warning}</span>
              </li>
            {/foreach}
          {/if}
        </ul>
      </div>
    </div>
  {/if}
  {if $warnings && count($warnings) > 0}
    <div id="errors">
      <div class="messages status crm-warning no-popup">
        <h3 class="nobackground">
          <i class="crm-i fa-exclamation-triangle"></i>
          {ts domain="cat.babu.atmod182"}<strong>Avisos</strong>{/ts}
        </h3>
        <hr>
        {foreach from=$warnings item=warningsType key=key}
          <br>
          <h4><strong>{$key}</strong></h4>
          <br>
          {foreach from=$warningsType item=warning}
            <ul>
              <li>
                {if is_numeric($warning.0)}
                  {crmAPI var='result' entity='Contact' action='get' return="display_name" id=$warning.0}
  						    {foreach from=$result.values item=contact}
    							  {$contact.some_field}
  						    {/foreach}
                  <span> <a href="/civicrm/contact/view?reset=1&cid={$warning.0}">{$result.values.0.display_name}</a> - </span> {$warning.1}
                {else}
                  <span> Los datos del <a href="/civicrm/admin/atmod182">declarante</a>, tiene estos errores:</span><br>
                {/if}
              </li>
            </ul>
          {/foreach}
        {/foreach}
      </div>
    </div>
  {/if}
  
  <br>

  <p><strong><span style="color:red">ATENCIÓN!</span> El resumen numérico que sigue puede contener imprecisiones y solo se muestra para poder contrastar algunos números.</strong></p>

  <table class="report-layout statistics-table" width=50%>
  <tbody
	  <tr>
		  <th colspan=2></th>
		  <th>{ts}Núm. donantes{/ts}</th>
      <th>{ts}Núm. donativos{/ts}</th>
		  <th>{ts}Suma donativos{/ts}</th>
	  </tr>

	  <tr>
		  <th colspan=2>{ts}Declarables{/ts}</th>
		  <td>{$statistics.taxable_donors}</td>
		  <td>{$statistics.taxable_donation_count}</td>
		  <td>{$statistics.taxable_donation_amount}</td>
	  </tr>

	  <tr>
	    {if $declareConfigured == 1 }
		  <th rowspan=3>{ts}No declarables{/ts}</th>
		  {else}
		  <th rowspan=2>{ts}No declarables{/ts}</th>
		  {/if}
		  <th>{ts}Falta NIF/CIF{/ts}</th>
		  <td>{$statistics.no_taxable_nif_donors}</td>
		  <td></td>
		  <td>{$statistics.no_taxable_nif_donation_amount}</td>
	  </tr>

	  {if $declareConfigured == 1 }
	  <tr>
		  <th>{ts}Falta código postal{/ts}</th>
		  <td>{$statistics.no_taxable_postal_code_donors}</td>
		  <td>{$statistics.no_taxable_postal_code_donation_count}</td>
		  <td>{$statistics.no_taxable_postal_code_donation_amount}</td>
	  </tr>
	  {/if}

	  {if $declareConfigured == 1 }
	  <tr>
		  <th>{ts}Contr. marcadas "No declarar"{/ts}</th>
		  <td>{$statistics.no_taxable_no_declare_donors}</td>
		  <td>{$statistics.no_taxable_no_declare_donation_count}</td>
		  <td>{$statistics.no_taxable_no_declare_donation_amount}</td>
	  </tr>
	  {/if}

    {if $anonymousConfigured == 1 }
	  <tr>
		  <th>{ts}Anónimos{/ts}</th>
		  <td>1</th>
		  <td>{$statistics.anonymous_donations_count}</td>
		  <td>{$statistics.anonymous_donations_amount}</td>
	  </tr>
	  {/if}

	  <tr>
		  <th colspan=2><strong>{ts}Totales{/ts}</strong></th>
		  <td><strong>{ts}{$statistics.total_donors}{/ts}</strong></th>
		  <td><strong>{ts}{$statistics.total_donations_count}{/ts}</strong></th>
		  <td><strong>{ts}{$statistics.total_donations_amount}{/ts}</strong></th>
	  </tr>
	  </tbody>
  </table>


  {include file="CRM/Report/Form.tpl"}

  {* The nbps; are a mimic of what other buttons do in templates/CRM/Report/Form/Actions.tpl *}
  {assign var=validate182 value="_qf_"|cat:$form.formName|cat:"_submit_validate182"}
  {$form.$validate182.html}&nbsp;&nbsp;

  {if $noerrors == 1}
    {if $enable_993 == 0}
      {assign var=export182 value="_qf_"|cat:$form.formName|cat:"_submit_export182"}
      {$form.$export182.html}&nbsp;&nbsp;
    {else}
      {assign var=export993 value="_qf_"|cat:$form.formName|cat:"_submit_export993"}
      {$form.$export993.html}&nbsp;&nbsp; 
    {/if}
  {/if}

  {literal}
    <script>
      CRM.$(function($) {
        var button_export_182 = '{/literal}{$form.$export182.id}{literal}';
        var button_validate_182 = '{/literal}{$form.$validate182.id}{literal}';
        var button_export_993 = '{/literal}{$form.$export993.id}{literal}';{/literal}
          {literal}
            if ($('.crm-report-field-form-block .crm-submit-buttons').size() > 0) {
              $("button[id='" + button_validate_182 + "']").appendTo('.crm-report-field-form-block .crm-submit-buttons');{/literal}
              {if $noerrors == 1}
                {literal}$("button[id='" + button_export_182 + "']").appendTo('.crm-report-field-form-block .crm-submit-buttons');{/literal}
                {if $enable_993 == 1}
                  {literal}$("button[id='" + button_export_993 + "']").appendTo('.crm-report-field-form-block .crm-submit-buttons');{/literal}
                {/if}
              {/if}{literal}
            }
            else {
              // Do not show the button when running in a dashlet
              // FIXME: we should probably just not add the HTML in the first place.
              $("button[id='" + button_validate_182 + "']").hide();
              $("button[id='" + button_export_182 + "']").hide();
              $("button[id='" + button_export_993 + "']").hide();
            }
          {/literal}
        {literal}
      });
    </script>
  {/literal}
{/if}
