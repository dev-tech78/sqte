<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026084817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ateleir (id INT AUTO_INCREMENT NOT NULL, catateleir_id INT DEFAULT NULL, titel VARCHAR(255) NOT NULL, discription LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, programme VARCHAR(255) DEFAULT NULL, INDEX IDX_4414AE4B921B7B3D (catateleir_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ateleir ADD CONSTRAINT FK_4414AE4B921B7B3D FOREIGN KEY (catateleir_id) REFERENCES categorie_atelier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ateleir DROP FOREIGN KEY FK_4414AE4B921B7B3D');
        $this->addSql('DROP TABLE ateleir');
        $this->addSql('DROP TABLE categorie_atelier');
    }
}
