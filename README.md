# Troglos — notes de frais

Application Symfony pour saisir une note de frais en ligne : lignes de dépenses, indemnités kilométriques, justificatifs, et choix entre remboursement et abandon des frais en don.

## Stack

PHP 8.4 · Symfony 8 · Doctrine ORM · Twig · SQLite

## Fonctionnalités

- Formulaire en quatre parties : informations générales, lignes de frais, abandon ou remboursement, justificatifs
- Plusieurs lignes de frais par note (kilomètres, transport, autres dépenses)
- Calculs automatiques dans `ExpenseCalculator` : montant kilométrique, total, réduction d'impôt de 66 % sur la part abandonnée en don, montant à rembourser
- Envoi de justificatifs (PDF, JPG, PNG, WEBP), renommés de façon sûre à l'enregistrement

## Lancer le projet

Prérequis : PHP 8.4, Composer, et la [CLI Symfony](https://symfony.com/download) (facultative).

```bash
git clone https://github.com/marylineb/troglos-ndf.git
cd troglos-ndf
composer install
php bin/console doctrine:migrations:migrate
symfony serve   # ou : php -S localhost:8000 -t public
```

La base SQLite est créée dans `var/data.db`. Pour changer de base ou mettre une vraie valeur à `APP_SECRET`, créer un fichier `.env.local` (ignoré par Git) plutôt que de modifier `.env`.

## Structure

```text
src/
├── Controller/ExpenseReportController.php   # formulaire, upload, enregistrement
├── Entity/                                  # ExpenseReport, ExpenseLine, Attachment
├── Form/                                    # ExpenseReportType, ExpenseLineType
└── Service/ExpenseCalculator.php            # tous les calculs
templates/expense_report/                    # formulaire et page de confirmation
```

## Auteure

Maryline Biloa · [Portfolio](https://marylinebiloa.com)
