<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130151234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cat_soutien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, soustitre VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD cat_soutien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27608B6218 FOREIGN KEY (cat_soutien_id) REFERENCES cat_soutien (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27608B6218 ON produit (cat_soutien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27608B6218');
        $this->addSql('DROP TABLE cat_soutien');
        $this->addSql('DROP INDEX IDX_29A5EC27608B6218 ON produit');
        $this->addSql('ALTER TABLE produit DROP cat_soutien_id');
    }
}
