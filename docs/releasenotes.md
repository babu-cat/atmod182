# Release Notes

## Release 1.6.4 (2025-01-16)

- Update AEAT PHP Library to 1.6.2

## Release 1.6.3 (2025-01-15)

- Update AEAT PHP Library to 1.6.1

## Release 1.6.2 (2025-01-09)

- Smarty 4 compatibility fixes

## Release 1.6.1 (2024-12-29)

- Fix display issues for new Reverlea theme

## Release 1.6.0 (2024-12-20)

- Remove code related to obsoleted normative

## Release 1.5.13 (2024-11-22)

- Floor decimal rounding for results in "Set More Donation At Same Cost" SearchKit Action

## Release 1.5.12 (2024-11-21)

- Fix wrong calculation for custom fields on "Set More Donation At SameCost" SearchKit Action

## Release 1.5.11 (2024-11-20)

- Fix for decimal amounts on "Set More Donation At SameCost" SearchKit Action

## Release 1.5.10 (2024-11-20)

- Update AEAT PHP library from 1.5.9 to [1.5.10](https://github.com/babu-cat/AEAT/releases/tag/1.5.10)
- Add new SearchKit Action "Set More Donation At SameCost" to fill custom fields related to 2024 new spanish tax advantages

## Release 1.5.9 (2024-03-14)

- Update AEAT PHP library from 1.5.8 to [1.5.9](https://github.com/babu-cat/AEAT/releases/tag/1.5.9)

## Release 1.5.8 (2024-02-07)

- Update AEAT PHP library from 1.5.7 to [1.5.8](https://github.com/babu-cat/AEAT/releases/tag/1.5.8)
- Add range intervals columns for tax calculator imports
- Include AEAT PHP library via composer

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
