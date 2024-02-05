<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130092819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_festival (id INT AUTO_INCREMENT NOT NULL, festival_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_8A8C79218AEBAF57 (festival_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_festival ADD CONSTRAINT FK_8A8C79218AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_festival DROP FOREIGN KEY FK_8A8C79218AEBAF57');
        $this->addSql('DROP TABLE image_festival');
    }
}
