<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260331101951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expense_line (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, expense_date DATETIME NOT NULL, expense_label VARCHAR(255) NOT NULL, kilometers INTEGER DEFAULT NULL, transport_amount DOUBLE PRECISION DEFAULT NULL, other_amount DOUBLE PRECISION DEFAULT NULL, expense_report_id INTEGER NOT NULL, CONSTRAINT FK_65B3FA948F758FBA FOREIGN KEY (expense_report_id) REFERENCES expense_report (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_65B3FA948F758FBA ON expense_line (expense_report_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE expense_line');
    }
}
