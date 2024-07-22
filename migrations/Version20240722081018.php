<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722081018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, img_url VARCHAR(255) NOT NULL, INDEX IDX_C53D045F549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, listing_title VARCHAR(255), listing_description LONGTEXT, start_date DATETIME COMMENT \'(DC2Type:datetime_immutable)\', end_date DATETIME COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(20), INDEX IDX_CB0048D4549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_mutation VARCHAR(255) DEFAULT NULL, nature_mutation VARCHAR(255) DEFAULT NULL, valeur_fonciere INT DEFAULT NULL, no_voie VARCHAR(255) DEFAULT NULL, b_t_q VARCHAR(255) DEFAULT NULL, type_voie VARCHAR(255) DEFAULT NULL, code_voie VARCHAR(255) DEFAULT NULL, voie VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, code_departement VARCHAR(255) DEFAULT NULL, code_commune VARCHAR(255) DEFAULT NULL, section VARCHAR(255) DEFAULT NULL, nb_lots INT DEFAULT NULL, code_type_local VARCHAR(255) DEFAULT NULL, type_local VARCHAR(255) DEFAULT NULL, surface_reelle_bati INT DEFAULT NULL, nb_pieces INT DEFAULT NULL, surface_terrain INT DEFAULT NULL, INDEX IDX_8BF21CDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_features (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type_of_rooms VARCHAR(50) DEFAULT NULL, number_of_bedrooms INT DEFAULT NULL, floor INT DEFAULT NULL, property_condition VARCHAR(50) DEFAULT NULL, energy_class VARCHAR(50) DEFAULT NULL, elevator TINYINT(1) DEFAULT NULL, balcony TINYINT(1) DEFAULT NULL, parking TINYINT(1) DEFAULT NULL, heating_type VARCHAR(50) DEFAULT NULL, air_condition TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_E147E857549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, phone_number INT DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D4549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property_features ADD CONSTRAINT FK_E147E857549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F549213EC');
        $this->addSql('ALTER TABLE listing DROP FOREIGN KEY FK_CB0048D4549213EC');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA76ED395');
        $this->addSql('ALTER TABLE property_features DROP FOREIGN KEY FK_E147E857549213EC');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE listing');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_features');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
