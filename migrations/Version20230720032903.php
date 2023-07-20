<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720032903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204C1B6CC10');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204C1B6CC10 FOREIGN KEY (fk_car_id_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204C1B6CC10');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204C1B6CC10 FOREIGN KEY (fk_car_id_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
