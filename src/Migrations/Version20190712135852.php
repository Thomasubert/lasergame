<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712135852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('ALTER TABLE card CHANGE status status VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE user ADD street_number INT DEFAULT NULL, ADD street_name VARCHAR(255) DEFAULT NULL, ADD zip VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD country VARCHAR(255) DEFAULT NULL, ADD username VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE latin1_swedish_ci, value CHAR(88) NOT NULL COLLATE latin1_swedish_ci, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci, username VARCHAR(200) NOT NULL COLLATE latin1_swedish_ci, UNIQUE INDEX series_UNIQUE (series), PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE card CHANGE status status LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE user DROP street_number, DROP street_name, DROP zip, DROP city, DROP country, DROP username');
    }
}
