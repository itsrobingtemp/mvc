<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604211321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__health_disease AS SELECT id, type, country, year, data FROM health_disease');
        $this->addSql('DROP TABLE health_disease');
        $this->addSql('CREATE TABLE health_disease (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, year INTEGER NOT NULL, data DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO health_disease (id, type, country, year, data) SELECT id, type, country, year, data FROM __temp__health_disease');
        $this->addSql('DROP TABLE __temp__health_disease');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__health_disease AS SELECT id, type, country, year, data FROM health_disease');
        $this->addSql('DROP TABLE health_disease');
        $this->addSql('CREATE TABLE health_disease (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, year INTEGER NOT NULL, data INTEGER NOT NULL)');
        $this->addSql('INSERT INTO health_disease (id, type, country, year, data) SELECT id, type, country, year, data FROM __temp__health_disease');
        $this->addSql('DROP TABLE __temp__health_disease');
    }
}
