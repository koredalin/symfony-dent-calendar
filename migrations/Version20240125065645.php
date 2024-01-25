<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125065645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD user_id_at_9 INT DEFAULT NULL, ADD user_id_at_10 INT DEFAULT NULL, ADD user_id_at_11 INT DEFAULT NULL, ADD user_id_at_12 INT DEFAULT NULL, ADD user_id_at_13 INT DEFAULT NULL, ADD user_id_at_14 INT DEFAULT NULL, ADD user_id_at_15 INT DEFAULT NULL, ADD user_id_at_16 INT DEFAULT NULL, ADD user_id_at_17 INT DEFAULT NULL, DROP start_at_9, DROP start_at_10, DROP start_at_11, DROP start_at_12, DROP start_at_13, DROP start_at_14, DROP start_at_15, DROP start_at_16, DROP start_at_17');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955402D446D FOREIGN KEY (user_id_at_9) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F416588 FOREIGN KEY (user_id_at_10) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557846551E FOREIGN KEY (user_id_at_11) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E14F04A4 FOREIGN KEY (user_id_at_12) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495596483432 FOREIGN KEY (user_id_at_13) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495582CA191 FOREIGN KEY (user_id_at_14) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557F2B9107 FOREIGN KEY (user_id_at_15) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E622C0BD FOREIGN KEY (user_id_at_16) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559125F02B FOREIGN KEY (user_id_at_17) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955402D446D ON reservation (user_id_at_9)');
        $this->addSql('CREATE INDEX IDX_42C84955F416588 ON reservation (user_id_at_10)');
        $this->addSql('CREATE INDEX IDX_42C849557846551E ON reservation (user_id_at_11)');
        $this->addSql('CREATE INDEX IDX_42C84955E14F04A4 ON reservation (user_id_at_12)');
        $this->addSql('CREATE INDEX IDX_42C8495596483432 ON reservation (user_id_at_13)');
        $this->addSql('CREATE INDEX IDX_42C8495582CA191 ON reservation (user_id_at_14)');
        $this->addSql('CREATE INDEX IDX_42C849557F2B9107 ON reservation (user_id_at_15)');
        $this->addSql('CREATE INDEX IDX_42C84955E622C0BD ON reservation (user_id_at_16)');
        $this->addSql('CREATE INDEX IDX_42C849559125F02B ON reservation (user_id_at_17)');
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
        $this->addSql('DROP INDEX IDX_42C84955402D446D ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955F416588 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849557846551E ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955E14F04A4 ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495596483432 ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495582CA191 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849557F2B9107 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955E622C0BD ON reservation');
        $this->addSql('DROP INDEX IDX_42C849559125F02B ON reservation');
        $this->addSql('ALTER TABLE reservation ADD start_at_9 INT DEFAULT NULL, ADD start_at_10 INT DEFAULT NULL, ADD start_at_11 INT DEFAULT NULL, ADD start_at_12 INT DEFAULT NULL, ADD start_at_13 INT DEFAULT NULL, ADD start_at_14 INT DEFAULT NULL, ADD start_at_15 INT DEFAULT NULL, ADD start_at_16 INT DEFAULT NULL, ADD start_at_17 INT DEFAULT NULL, DROP user_id_at_9, DROP user_id_at_10, DROP user_id_at_11, DROP user_id_at_12, DROP user_id_at_13, DROP user_id_at_14, DROP user_id_at_15, DROP user_id_at_16, DROP user_id_at_17');
    }
}
