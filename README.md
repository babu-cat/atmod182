# ATMod182

ATMod182 allows extraction of files to present the 182 form to the *Agencia Estatal de Administración Tributaria (AEAT)* of Spain.

[Form 182](https://www.agenciatributaria.gob.es/AEAT.sede/en_gb/procedimientoini/GI02.shtml) is a information return about donations and contributions received in organizations like foundations and associations declared of public utility

## Usage

- Once the extension has been installed and before you create the first report you need to configure it through the menu `Administer > CiviContribute > ATMod182`.

- Go to **Administer > CiviReport > Create New Report from Template** and select **ATMod182**

- From the ATMod182 generated Report you can validate donations relative data clicking the **Validate 182** button 

- Once data is validated, a 182 formatted file can be exported clicking the **Export 182** button  

## Included Libraries

- [AEAT](https://github.com/babu-cat/AEAT) 1.3
- [nif-nie-cif](https://github.com/amnesty/dataquality/blob/0227798/src/php/nif-nie-cif.php) from [Data Quality](https://github.com/amnesty/dataquality)

## Requirements

- CiviCRM 5.13

## Design Documentation

- [Registry Design](https://www.agenciatributaria.es/AEAT.internet/en_gb/Inicio/Ayuda/Disenos_de_registro/Disenos_de_registro.shtml)
- [Registry designs.Brief guidelines](https://www.agenciatributaria.es/AEAT.internet/en_gb/Inicio/Ayuda/Disenos_de_registro/Manuales_tecnicos_de_ayuda__Instrucciones_de_uso_/Manuales_tecnicos_de_ayuda__Instrucciones_de_uso_.shtml)

## Roadmap

- Create a specific report for ATMod182 that does not depend on the Contribution Repeat core report
