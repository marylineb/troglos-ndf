<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260331100119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expense_report (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, requester_name VARCHAR(255) NOT NULL, request_date DATETIME NOT NULL, expense_reason CLOB NOT NULL, budget VARCHAR(255) NOT NULL, total_km INTEGER NOT NULL, mileage_rate DOUBLE PRECISION NOT NULL, total_km_amount DOUBLE PRECISION NOT NULL, total_transport_amount DOUBLE PRECISION NOT NULL, total_other_amount DOUBLE PRECISION NOT NULL, total_amount DOUBLE PRECISION NOT NULL, donation_amount DOUBLE PRECISION DEFAULT NULL, tax_deduction_amount DOUBLE PRECISION DEFAULT NULL, real_cost_after_deduction DOUBLE PRECISION DEFAULT NULL, reimbursed_amount DOUBLE PRECISION NOT NULL, iban VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, signature_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE expense_report');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
