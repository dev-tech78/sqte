<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129093046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_musique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE musique ADD categorie_musique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BCBB2B9E0D FOREIGN KEY (categorie_musique_id) REFERENCES categorie_musique (id)');
        $this->addSql('CREATE INDEX IDX_EE1D56BCBB2B9E0D ON musique (categorie_musique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musique DROP FOREIGN KEY FK_EE1D56BCBB2B9E0D');
        $this->addSql('DROP TABLE categorie_musique');
        $this->addSql('DROP INDEX IDX_EE1D56BCBB2B9E0D ON musique');
        $this->addSql('ALTER TABLE musique DROP categorie_musique_id');
    }
}
