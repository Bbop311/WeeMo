<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716120118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proprety_features (id INT AUTO_INCREMENT NOT NULL, type_of_rooms VARCHAR(50) NOT NULL, number_of_bedrooms INT NOT NULL, proprety_condition VARCHAR(50) NOT NULL, energy_class VARCHAR(50) NOT NULL, elevator TINYINT(1) NOT NULL, balcony TINYINT(1) NOT NULL, parking TINYINT(1) NOT NULL, air_condition TINYINT(1) NOT NULL, heating_type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE proprety_features');
    }
}
