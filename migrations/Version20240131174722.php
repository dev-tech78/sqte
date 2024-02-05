<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131174722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soutien (id INT AUTO_INCREMENT NOT NULL, relat_soutien_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_99A7D3212260896E (relat_soutien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3212260896E FOREIGN KEY (relat_soutien_id) REFERENCES cat_soutien (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3212260896E');
        $this->addSql('DROP TABLE soutien');
    }
}
