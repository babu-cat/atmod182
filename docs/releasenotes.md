## Release 1.5.7 (2024-01-18)

- Show summary results table on the 182 report when validates
- Update AEAT PHP library from 1.5.6 to [1.5.7](https://github.com/babu-cat/AEAT/releases/tag/1.5.7)
- Fix wrong application of autonomous deduction for organizations on 182 report

## Release 1.5.6 (2024-01-17)

- Change column name "Importe contribución 2024" to "Incremento sugerido con el mismo coste para el donante (nueva ley de mecenazgo)"
- Update AEAT PHP library from 1.5.5 to [1.5.6](https://github.com/babu-cat/AEAT/releases/tag/1.5.6)

## Release 1.5.5 (2024-01-16)

- Update AEAT PHP library from 1.5.4 to [1.5.5](https://github.com/babu-cat/AEAT/releases/tag/1.5.5)
- Add column "Importe desgravado" to Model182 report to reflect an estimation of the tax deductible amount for the donor
- Add column "Importe real" to Model182 report to reflect an estimation of ther real donation cost amount for the donor
- Add column "Importe desgravado normativa 2024" to Model182 report to reflect an estimation of the tax deductible amount for the donor according to the new 2024 regulation
- Add column "Importe real normativa 2024" to Model182 report to reflect an estimation of ther real donation cost amount for the donor according to the new 2024 regulation
- Add column "Importe contribución 2024" to Model182 report to estimate the increase in donation that the donor can make in 2024 compared to 2023 without incurring an extra cost
- Fix unnecessary postal code validations
- Add information for donations of donors without a registered postal code on the "statistics table" of Model182 report
- Force normalization for declarant name on 993 outputfile
- Prioritize fiscal address before the primary
- PHP 8.0 compatibility