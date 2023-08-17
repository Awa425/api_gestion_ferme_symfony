<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511103147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capteur (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, type_capteur_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_5B4A16958E962C16 (animal_id), INDEX IDX_5B4A1695A0B740C (type_capteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_capteur (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE capteur ADD CONSTRAINT FK_5B4A16958E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE capteur ADD CONSTRAINT FK_5B4A1695A0B740C FOREIGN KEY (type_capteur_id) REFERENCES type_capteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE capteur DROP FOREIGN KEY FK_5B4A16958E962C16');
        $this->addSql('ALTER TABLE capteur DROP FOREIGN KEY FK_5B4A1695A0B740C');
        $this->addSql('DROP TABLE capteur');
        $this->addSql('DROP TABLE type_capteur');
    }
}
