<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504151557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, ferme_id INT DEFAULT NULL, fermier_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, is_etat TINYINT(1) DEFAULT NULL, date_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6AAB231F18981132 (ferme_id), INDEX IDX_6AAB231FB8CB1F8 (fermier_id), INDEX IDX_6AAB231F5C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT NOT NULL, ferme_id INT DEFAULT NULL, fermier_id INT DEFAULT NULL, INDEX IDX_F804D3B918981132 (ferme_id), INDEX IDX_F804D3B9B8CB1F8 (fermier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ferme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, is_etat TINYINT(1) DEFAULT NULL, data_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ferme_fermier (id INT AUTO_INCREMENT NOT NULL, ferme_id INT DEFAULT NULL, fermier_id INT DEFAULT NULL, INDEX IDX_12B01D7018981132 (ferme_id), INDEX IDX_12B01D70B8CB1F8 (fermier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ferme_veterinaire (id INT AUTO_INCREMENT NOT NULL, ferme_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, INDEX IDX_14B6AA0118981132 (ferme_id), INDEX IDX_14B6AA015C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fermier (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, is_etat TINYINT(1) DEFAULT NULL, date_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', matricule VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT NOT NULL, fermier_id INT DEFAULT NULL, INDEX IDX_E9D962B8B8CB1F8 (fermier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F18981132 FOREIGN KEY (ferme_id) REFERENCES ferme (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB8CB1F8 FOREIGN KEY (fermier_id) REFERENCES fermier (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F5C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B918981132 FOREIGN KEY (ferme_id) REFERENCES ferme (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9B8CB1F8 FOREIGN KEY (fermier_id) REFERENCES fermier (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ferme_fermier ADD CONSTRAINT FK_12B01D7018981132 FOREIGN KEY (ferme_id) REFERENCES ferme (id)');
        $this->addSql('ALTER TABLE ferme_fermier ADD CONSTRAINT FK_12B01D70B8CB1F8 FOREIGN KEY (fermier_id) REFERENCES fermier (id)');
        $this->addSql('ALTER TABLE ferme_veterinaire ADD CONSTRAINT FK_14B6AA0118981132 FOREIGN KEY (ferme_id) REFERENCES ferme (id)');
        $this->addSql('ALTER TABLE ferme_veterinaire ADD CONSTRAINT FK_14B6AA015C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE fermier ADD CONSTRAINT FK_86EADB64BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8B8CB1F8 FOREIGN KEY (fermier_id) REFERENCES fermier (id)');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BF396750');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F18981132');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB8CB1F8');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F5C80924');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B918981132');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9B8CB1F8');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9BF396750');
        $this->addSql('ALTER TABLE ferme_fermier DROP FOREIGN KEY FK_12B01D7018981132');
        $this->addSql('ALTER TABLE ferme_fermier DROP FOREIGN KEY FK_12B01D70B8CB1F8');
        $this->addSql('ALTER TABLE ferme_veterinaire DROP FOREIGN KEY FK_14B6AA0118981132');
        $this->addSql('ALTER TABLE ferme_veterinaire DROP FOREIGN KEY FK_14B6AA015C80924');
        $this->addSql('ALTER TABLE fermier DROP FOREIGN KEY FK_86EADB64BF396750');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8B8CB1F8');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8BF396750');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE ferme');
        $this->addSql('DROP TABLE ferme_fermier');
        $this->addSql('DROP TABLE ferme_veterinaire');
        $this->addSql('DROP TABLE fermier');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE veterinaire');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
