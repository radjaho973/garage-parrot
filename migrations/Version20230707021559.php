<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707021559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE open_hours (id INT AUTO_INCREMENT NOT NULL, fk_day_id INT NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, is_closed TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C1A79D8B296C29B6 (fk_day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonials (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, note SMALLINT NOT NULL, pending_verification TINYINT(1) NOT NULL, is_validated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE week_day (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE open_hours ADD CONSTRAINT FK_C1A79D8B296C29B6 FOREIGN KEY (fk_day_id) REFERENCES week_day (id)');
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204C1B6CC10');
        $this->addSql('DROP INDEX IDX_90937204C1B6CC10 ON image_collection');
        $this->addSql('ALTER TABLE image_collection CHANGE fk_car_id fk_car_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204C1B6CC10 FOREIGN KEY (fk_car_id_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_90937204C1B6CC10 ON image_collection (fk_car_id_id)');
        $this->addSql('ALTER TABLE options DROP FOREIGN KEY FK_D035FA87C1B6CC10');
        $this->addSql('DROP INDEX IDX_D035FA87C1B6CC10 ON options');
        $this->addSql('ALTER TABLE options CHANGE fk_car_id fk_car_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE options ADD CONSTRAINT FK_D035FA87C1B6CC10 FOREIGN KEY (fk_car_id_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_D035FA87C1B6CC10 ON options (fk_car_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE open_hours DROP FOREIGN KEY FK_C1A79D8B296C29B6');
        $this->addSql('DROP TABLE open_hours');
        $this->addSql('DROP TABLE testimonials');
        $this->addSql('DROP TABLE week_day');
        $this->addSql('ALTER TABLE image_collection DROP FOREIGN KEY FK_90937204C1B6CC10');
        $this->addSql('DROP INDEX IDX_90937204C1B6CC10 ON image_collection');
        $this->addSql('ALTER TABLE image_collection CHANGE fk_car_id_id fk_car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_collection ADD CONSTRAINT FK_90937204C1B6CC10 FOREIGN KEY (fk_car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_90937204C1B6CC10 ON image_collection (fk_car_id)');
        $this->addSql('ALTER TABLE options DROP FOREIGN KEY FK_D035FA87C1B6CC10');
        $this->addSql('DROP INDEX IDX_D035FA87C1B6CC10 ON options');
        $this->addSql('ALTER TABLE options CHANGE fk_car_id_id fk_car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE options ADD CONSTRAINT FK_D035FA87C1B6CC10 FOREIGN KEY (fk_car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D035FA87C1B6CC10 ON options (fk_car_id)');
    }
}
