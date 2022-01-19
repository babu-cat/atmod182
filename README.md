# CiviCRM ATMod182

ATMod182 allows extraction of files to present the 182 form to the *Agencia Estatal de Administración Tributaria (AEAT)* of Spain.

[Form 182](https://sede.agenciatributaria.gob.es/Sede/en_gb/procedimientoini/GI02.shtml) is a information return about donations and contributions received in organizations like foundations and associations declared of public utility

## Usage

- Once the extension has been installed and before you create the first report you need to configure it through the menu `Administer > CiviContribute > ATMod182`.

- Go to **Administer > CiviReport > Create New Report from Template** and select **ATMod182**

- From the ATMod182 generated Report you can validate donations relative data clicking the **Validate 182** button

- Once data is validated, a 182 formatted file can be exported clicking the **Export 182** button  

## Included Libraries

- [AEAT](https://github.com/babu-cat/AEAT) 1.4.1
- [nif-nie-cif](https://github.com/amnesty/dataquality/blob/0227798/src/php/nif-nie-cif.php) from [Data Quality](https://github.com/amnesty/dataquality)

## Requirements

- CiviCRM 5.43

## Design Documentation

- [Registry Design](https://sede.agenciatributaria.gob.es/Sede/en_gb/ayuda/disenos-registro/modelos-100-199.html)
- [Registry designs.Brief guidelines](https://sede.agenciatributaria.gob.es/Sede/en_gb/ayuda/disenos-registro/ayuda.html)

## Roadmap

- Create a specific report for ATMod182 that does not depend on the Contribution Repeat core report
