<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122191957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, start_at_9 INT DEFAULT NULL, start_at_10 INT DEFAULT NULL, start_at_11 INT DEFAULT NULL, start_at_12 INT DEFAULT NULL, start_at_13 INT DEFAULT NULL, start_at_14 INT DEFAULT NULL, start_at_15 INT DEFAULT NULL, start_at_16 INT DEFAULT NULL, start_at_17 INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE registration');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, start_at_9 INT DEFAULT NULL, start_at_10 INT DEFAULT NULL, start_at_11 INT DEFAULT NULL, start_at_12 INT DEFAULT NULL, start_at_13 INT DEFAULT NULL, start_at_14 INT DEFAULT NULL, start_at_15 INT DEFAULT NULL, start_at_16 INT DEFAULT NULL, start_at_17 INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE reservation');
    }
}
