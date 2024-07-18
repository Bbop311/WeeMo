<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717085244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE71AD5033');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE71AD5033 ON property');
        $this->addSql('ALTER TABLE property DROP property_features_id');
        $this->addSql('ALTER TABLE property_features ADD property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property_features ADD CONSTRAINT FK_E147E857549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E147E857549213EC ON property_features (property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD property_features_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE71AD5033 FOREIGN KEY (property_features_id) REFERENCES property_features (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE71AD5033 ON property (property_features_id)');
        $this->addSql('ALTER TABLE property_features DROP FOREIGN KEY FK_E147E857549213EC');
        $this->addSql('DROP INDEX UNIQ_E147E857549213EC ON property_features');
        $this->addSql('ALTER TABLE property_features DROP property_id');
    }
}
