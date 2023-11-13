<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030183553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD categorie_atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB18231C2B0599 FOREIGN KEY (categorie_atelier_id) REFERENCES categorie_atelier (id)');
        $this->addSql('CREATE INDEX IDX_E1BB18231C2B0599 ON atelier (categorie_atelier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB18231C2B0599');
        $this->addSql('DROP TABLE categorie_atelier');
        $this->addSql('DROP INDEX IDX_E1BB18231C2B0599 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP categorie_atelier_id');
    }
}
