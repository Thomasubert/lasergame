<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703124033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advantages (id INT AUTO_INCREMENT NOT NULL, discount INT DEFAULT NULL, free_games INT DEFAULT NULL, goodies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, code_center INT NOT NULL, code_card INT NOT NULL, checksum INT NOT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', number_of_games INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, score INT DEFAULT NULL, victory TINYINT(1) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('ALTER TABLE user ADD address_id INT DEFAULT NULL, ADD card_id INT DEFAULT NULL, ADD birthdate DATE DEFAULT NULL, DROP roles');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F5B7AF75 ON user (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494ACC9A20 ON user (card_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494ACC9A20');
        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL COLLATE latin1_swedish_ci, value CHAR(88) NOT NULL COLLATE latin1_swedish_ci, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci, username VARCHAR(200) NOT NULL COLLATE latin1_swedish_ci, UNIQUE INDEX series_UNIQUE (series), PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE advantages');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP INDEX IDX_8D93D649F5B7AF75 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D6494ACC9A20 ON user');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', DROP address_id, DROP card_id, DROP birthdate');
    }
}
