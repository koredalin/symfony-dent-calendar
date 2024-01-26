<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125193436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id_at_9 INT DEFAULT NULL, user_id_at_10 INT DEFAULT NULL, user_id_at_11 INT DEFAULT NULL, user_id_at_12 INT DEFAULT NULL, user_id_at_13 INT DEFAULT NULL, user_id_at_14 INT DEFAULT NULL, user_id_at_15 INT DEFAULT NULL, user_id_at_16 INT DEFAULT NULL, user_id_at_17 INT DEFAULT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_42C84955AA9E377A (date), INDEX IDX_42C84955402D446D (user_id_at_9), INDEX IDX_42C84955F416588 (user_id_at_10), INDEX IDX_42C849557846551E (user_id_at_11), INDEX IDX_42C84955E14F04A4 (user_id_at_12), INDEX IDX_42C8495596483432 (user_id_at_13), INDEX IDX_42C8495582CA191 (user_id_at_14), INDEX IDX_42C849557F2B9107 (user_id_at_15), INDEX IDX_42C84955E622C0BD (user_id_at_16), INDEX IDX_42C849559125F02B (user_id_at_17), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955402D446D FOREIGN KEY (user_id_at_9) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F416588 FOREIGN KEY (user_id_at_10) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557846551E FOREIGN KEY (user_id_at_11) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E14F04A4 FOREIGN KEY (user_id_at_12) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495596483432 FOREIGN KEY (user_id_at_13) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495582CA191 FOREIGN KEY (user_id_at_14) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557F2B9107 FOREIGN KEY (user_id_at_15) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E622C0BD FOREIGN KEY (user_id_at_16) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559125F02B FOREIGN KEY (user_id_at_17) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955402D446D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F416588');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557846551E');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E14F04A4');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495596483432');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495582CA191');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557F2B9107');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E622C0BD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559125F02B');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE user');
    }
}
