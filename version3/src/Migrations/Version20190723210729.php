<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190723210729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE denuncias ADD incidencia_id INT NOT NULL');
        $this->addSql('ALTER TABLE denuncias ADD CONSTRAINT FK_296DA1DE1605BE2 FOREIGN KEY (incidencia_id) REFERENCES incidencia (id)');
        $this->addSql('CREATE INDEX IDX_296DA1DE1605BE2 ON denuncias (incidencia_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE denuncias DROP FOREIGN KEY FK_296DA1DE1605BE2');
        $this->addSql('DROP INDEX IDX_296DA1DE1605BE2 ON denuncias');
        $this->addSql('ALTER TABLE denuncias DROP incidencia_id');
    }
}
