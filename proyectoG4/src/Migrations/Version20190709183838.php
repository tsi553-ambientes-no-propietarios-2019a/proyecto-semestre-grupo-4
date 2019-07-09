<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709183838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, sobrenombre VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, telefono VARCHAR(10) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE denuncia ADD usuarios_id INT NOT NULL');
        $this->addSql('ALTER TABLE denuncia ADD CONSTRAINT FK_F4236796F01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id)');
        $this->addSql('CREATE INDEX IDX_F4236796F01D3B25 ON denuncia (usuarios_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE denuncia DROP FOREIGN KEY FK_F4236796F01D3B25');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('DROP INDEX IDX_F4236796F01D3B25 ON denuncia');
        $this->addSql('ALTER TABLE denuncia DROP usuarios_id');
    }
}
