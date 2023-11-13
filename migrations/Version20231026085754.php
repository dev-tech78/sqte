<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026085754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, catatelier_id INT DEFAULT NULL, titel VARCHAR(255) NOT NULL, discription LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, programme VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E1BB182320295647 (catatelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182320295647 FOREIGN KEY (catatelier_id) REFERENCES categorie_atelier (id)');
        $this->addSql('ALTER TABLE ateleir DROP FOREIGN KEY FK_4414AE4B921B7B3D');
        $this->addSql('DROP TABLE ateleir');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ateleir (id INT AUTO_INCREMENT NOT NULL, catateleir_id INT DEFAULT NULL, titel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, discription LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, author VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, programme VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_4414AE4B921B7B3D (catateleir_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ateleir ADD CONSTRAINT FK_4414AE4B921B7B3D FOREIGN KEY (catateleir_id) REFERENCES categorie_atelier (id)');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182320295647');
        $this->addSql('DROP TABLE atelier');
    }
}
