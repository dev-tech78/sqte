<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215090518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE froute (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, animateur VARCHAR(255) DEFAULT NULL, producteur VARCHAR(255) DEFAULT NULL, technicien VARCHAR(255) DEFAULT NULL, temps_direct TIME DEFAULT NULL, temps_enregistrement TIME DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, theme LONGTEXT DEFAULT NULL, format VARCHAR(120) DEFAULT NULL, qui VARCHAR(120) DEFAULT NULL, durée_total TIME DEFAULT NULL, notes LONGTEXT DEFAULT NULL, image VARCHAR(120) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date DATE DEFAULT NULL, invite_principal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE froute');
    }
}
