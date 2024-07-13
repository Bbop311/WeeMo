<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240713160050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, date_mutation VARCHAR(255) DEFAULT NULL, nature_mutation VARCHAR(255) DEFAULT NULL, valeur_fonciere INT DEFAULT NULL, no_voie VARCHAR(255) DEFAULT NULL, b_t_q VARCHAR(255) DEFAULT NULL, type_voie VARCHAR(255) DEFAULT NULL, code_voie VARCHAR(255) DEFAULT NULL, voie VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, code_departement VARCHAR(255) DEFAULT NULL, code_commune VARCHAR(255) DEFAULT NULL, section VARCHAR(255) DEFAULT NULL, nb_lots INT DEFAULT NULL, code_type_local VARCHAR(255) DEFAULT NULL, type_local VARCHAR(255) DEFAULT NULL, surface_reelle_bati INT DEFAULT NULL, nb_pieces INT DEFAULT NULL, surface_terrain INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE property');
    }
}
