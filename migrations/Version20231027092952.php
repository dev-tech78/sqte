<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027092952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_image (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_image_image (categorie_image_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_D86A6FF5226407 (categorie_image_id), INDEX IDX_D86A6FF3DA5256D (image_id), PRIMARY KEY(categorie_image_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE festival (id INT AUTO_INCREMENT NOT NULL, titel VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_image_image ADD CONSTRAINT FK_D86A6FF5226407 FOREIGN KEY (categorie_image_id) REFERENCES categorie_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_image_image ADD CONSTRAINT FK_D86A6FF3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_image_image DROP FOREIGN KEY FK_D86A6FF5226407');
        $this->addSql('ALTER TABLE categorie_image_image DROP FOREIGN KEY FK_D86A6FF3DA5256D');
        $this->addSql('DROP TABLE categorie_image');
        $this->addSql('DROP TABLE categorie_image_image');
        $this->addSql('DROP TABLE festival');
        $this->addSql('DROP TABLE image');
    }
}
