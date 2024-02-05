<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128105308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F350709A4');
        $this->addSql('DROP INDEX IDX_C53D045F350709A4 ON image');
        $this->addSql('ALTER TABLE image CHANGE lien_image_id fiction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FFF905AC2 FOREIGN KEY (fiction_id) REFERENCES fiction (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FFF905AC2 ON image (fiction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FFF905AC2');
        $this->addSql('DROP INDEX IDX_C53D045FFF905AC2 ON image');
        $this->addSql('ALTER TABLE image CHANGE fiction_id lien_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F350709A4 FOREIGN KEY (lien_image_id) REFERENCES fiction (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F350709A4 ON image (lien_image_id)');
    }
}
