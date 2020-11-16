<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116200448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, address1 VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, paid_cash TINYINT(1) NOT NULL, cash_discount NUMERIC(8, 2) DEFAULT \'0\' NOT NULL, bulk_discount NUMERIC(8, 2) DEFAULT \'0\' NOT NULL, bulk_discount_threshold INT DEFAULT 300 NOT NULL, spring_discount NUMERIC(8, 2) DEFAULT \'0\' NOT NULL, vat_percentage NUMERIC(8, 2) NOT NULL, vat_amount NUMERIC(8, 2) NOT NULL, shipping_cost NUMERIC(8, 2) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invoice');
    }
}
