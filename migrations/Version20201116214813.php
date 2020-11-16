<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116214813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD vat_percentage NUMERIC(8, 2) DEFAULT \'7.7\' NOT NULL, ADD bulk_discount_percentage NUMERIC(8, 2) DEFAULT \'3\' NOT NULL, ADD bulk_discount_threshold INT DEFAULT 300 NOT NULL, ADD spring_discount_active TINYINT(1) DEFAULT 0 NOT NULL, ADD spring_discount_percentage NUMERIC(8, 2) DEFAULT \'5\' NOT NULL, ADD cash_discount_percentage NUMERIC(8, 2) DEFAULT \'3\' NOT NULL, ADD vat_number VARCHAR(255) NOT NULL, ADD iban VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP vat_percentage, DROP bulk_discount_percentage, DROP bulk_discount_threshold, DROP spring_discount_active, DROP spring_discount_percentage, DROP cash_discount_percentage, DROP vat_number, DROP iban');
    }
}
